@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">IPv4</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">IPv4 List
                    <a href="rpz/create" class="btn btn-primary float-right">Add IPv4</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                    @if ($rpz)
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>IP V4 Address</th>
                                <th>User</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($rpz as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->ipv4address }}</td>
                                <td>{{ $item->user_name }} </td>
                                <td>
                                @if($item->active)
                                    <i class="fas fa-check-circle text-success"></i>
                                @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="rpz/{{ $item->id }}/edit" class="btn btn-primary">Edit</a>
                                        <form method="POST" action="/rpz/{{ $item->id }}">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="button" class="btn btn-danger delete-ip" type="submit">Delete</button>
                                        </form>
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
    $('.delete-ip').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>
@endsection