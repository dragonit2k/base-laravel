@extends('layouts.app')

@section('title', 'List user')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Danh sách người dùng</h3>
                    <form class="form-control" method="GET" action="{{ route('home') }}">
                        <div class="row">
                            <div class="col-9 d-flex">
                                <label class="form-label col-1 align-self-center" for="name">Tên</label>
                                <input class="form-control col-11"
                                       id="name"
                                       value="{{ $conditions['name'] ?? '' }}"
                                       name="name">
                            </div>
                            <div class="col-3 d-flex justify-content-end">
                                <button class="btn btn-primary w-75" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


