@extends('layouts.master')

@section('content')
<div class="main-card mb-3 card">
    <div class="card-body"><h5 class="card-title">Users</h5>
        <table class="mb-0 table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
                @if(!empty($users))
                    @foreach($users as $key => $user)
                        <tr>
                            <th scope="row">{{ $key }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->slug }}</td>
                            <td>{{ $user->status }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
