@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/users">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">Edit User</div>
                <div class="card-body">
                    <form method="POST" action="/users/{{ $user->id }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="fullname">Full name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $user->fullname }}">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" name="password">
                                <option>...</option>
                                <option value="user" {{ $user->role == "user" ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role == "admin" ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="active_user">Status</label>
                            <select class="form-control" name="active_user" id="active_user" autocomplete="off">
                                <option value="1" {{ $user->active == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $user->active == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection