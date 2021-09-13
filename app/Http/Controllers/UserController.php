<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use View;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return View::make('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'fullname' => 'required|string|max:255',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 404);
            return View::make('user.create')->with('errors', $validator->errors());
        }

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->fullname = $input['fullname'];
        $user->password = Hash::make($input['password']);
        $user->role = $input['role'];
        $user->active = $input['active'];
        $user->save();

        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return View::make('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $user = User::find($id);

        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'fullname' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return View::make('user.create')->with('errors', $validator->errors());
        }

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->fullname = $input['fullname'];
        $user->active = $input['active_user'];
        $user->role = $input['role'];
        $user->save();

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('users');
    }
    
    /**
     * Return a json of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $users = User::all();
        if($search = $request->input('q')){
            $users = User::whereRaw("name Like'%".$search."%'")->get();
        }
        return response()->json($users, 200);
    }
}
