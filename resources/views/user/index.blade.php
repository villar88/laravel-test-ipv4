@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">Users List
                    <a href="users/create" class="btn btn-primary float-right">Add User</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                    @if ($users)
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Fullame</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->fullname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                @if($user->active)
                                    <i class="fas fa-check-circle text-success"></i>
                                @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="users/{{ $user->id }}/edit" class="btn btn-primary">Edit</a>
                                        @if($user->id != 1)
                                        <form method="POST" action="/users/{{ $user->id }}">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="button" class="btn btn-danger delete-user" type="submit">Delete</button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.delete-user').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>
@endsection