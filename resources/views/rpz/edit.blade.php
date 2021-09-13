@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/rpz">RPZ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
              </nav>
            <div class="card">
                <div class="card-header">Edit RPZ</div>
                <div class="card-body">
                    <form method="POST" action="/rpz/{{ $rpz->id }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">IPv4 address</label>
                            <input type="text" class="form-control" id="ipv4address" name="ipv4address" value="{{ $rpz->ipv4address }}">
                        </div>
                        <div class="form-group">
                            <label for="note">Note</label>
                            <input type="text" class="form-control" id="note" name="note" value="{{ $rpz->note }}">
                        </div>
                        @if(auth()->user()->role == 'admin')
                        <div class="form-group">
                            <label for="id_user">User</label>
                            <select class="form-control" name="id_user" id="id_user" autocomplete="off">
                                <option>Select an user...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $rpz->id_user ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="active_ip">Status</label>
                            <select class="form-control" name="active_ip" id="active_ip" autocomplete="off">
                                    <option value="1" {{ $rpz->active == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $rpz->active == 0 ? 'selected' : '' }}>Inactive</option>
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