<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use View;
use Validator;
use Redirect;
use App\Models\RPZConsumer;
use App\Models\User;

class RPZController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rpz = RPZConsumer::all();

        $rpz = RPZConsumer::selectRaw('rpz_consumers.*, users.name as user_name')
                        ->join('users', 'rpz_consumers.id_user', 'users.id')
                        ->get();

        if(auth()->user()->role != 'admin'){
            $rpz = RPZConsumer::selectRaw('rpz_consumers.*, users.name as user_name')
            ->join('users', 'rpz_consumers.id_user', 'users.id')
            ->whereRaw("users.id = ".auth()->user()->id)
            ->get();
        }

        return View::make('rpz.index')->with('rpz', $rpz);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return View::make('rpz.create')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $rpz = new RPZConsumer;

        $validator = Validator::make($input, [
            'ipv4address' => 'required|ipv4',
            'note' => 'string|max:255',
        ]);

        if($validator->fails()){
            return Redirect::route('rpz.create')->with('errors', $validator->errors());
        }

        $rpz->ipv4address = $input['ipv4address'];
        $rpz->note = $input['note'];
        $rpz->active = $input['active_ip'];

        if(auth()->user()->role == 'admin'){
            $rpz->id_user = $input['id_user'];
        }else{
            $rpz->id_user = auth()->user()->id;
        }
        $rpz->save();

        return redirect('rpz');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rpz = RPZConsumer::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rpz = RPZConsumer::find($id);
        $users = User::All();
        return View::make('rpz.edit')->with('rpz', $rpz)->with('users', $users);
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

        $rpz = RPZConsumer::find($id);

        $validator = Validator::make($input, [
            'ipv4address' => 'required|ipv4',
            'note' => 'string|max:255',
        ]);

        if($validator->fails()){
            return View::make('rpz.create')->with('errors', $validator->errors());
        }

        $rpz->ipv4address = $input['ipv4address'];
        $rpz->note = $input['note'];
        if(auth()->user()->role == 'admin'){
            $rpz->id_user = $input['id_user'];
        }else{
            $rpz->id_user = auth()->user()->id;
        }
        $rpz->active = $input['active_ip'];
        $rpz->save();

        return redirect('rpz');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rpz = RPZConsumer::find($id);
        $rpz->delete();
        return redirect('rpz');
    }
}
