@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users List to Approve</div>

                    <div class="card-body">

                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <table class="table">
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th> Handle</th>
                                <th></th>
                            </tr>
                            @php
                                $i = 0;
                            @endphp
                            @forelse ($users as $user)
                                @php
                                    $i++;
                                @endphp
                                <tr>

                                    <td>{{ $i }}</td>
                                    <td>{{ $user->name }}</td>

                                    <td><a href="{{ route('admin.users.approve', $user->id) }}"
                                            class="btn btn-primary btn-sm">accept</a></td>
                                    <td><a href="{{ route('admin.users.approve', $user->id) }}"
                                            class="btn btn-danger btn-sm">deny</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No users found.</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
