@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/rpz">IPv4</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
              </nav>
            <div class="card">
                <div class="card-header">Create RPZ</div>
                <div class="card-body">
                    <form method="POST" action="/rpz">
                        @csrf
                        <div class="form-group">
                            <label for="ipv4address">IPv4 address</label>
                            <input type="text" class="form-control" id="ipv4address" name="ipv4address">
                        </div>
                        <div class="form-group">
                            <label for="note">Note</label>
                            <input type="text" class="form-control" id="note" name="note">
                        </div>
                        @if(auth()->user()->role == 'admin')
                        <div class="form-group">
                            <label for="fullname">User</label>
                            <select class="form-control usersList" name="id_user" autocomplete="off">
                                <option>Select an user...</option>
                                @if($users)
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="active_ip">Status</label>
                            <select class="form-control" name="active_ip" id="active_ip" autocomplete="off">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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