@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        @if(auth()->user()->role == 'admin')
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Users List</h3>
                                    <a href="{{ route('users.index') }}" class="btn btn-primary">Open</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">IP Addresses List</h3>
                                    <a href="{{ route('rpz.index') }}" class="btn btn-primary">Open</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
