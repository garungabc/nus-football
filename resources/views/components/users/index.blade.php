@extends('layouts.master')

@section('content')
<div class="main-card mb-3 card">
    <div class="card-body"><h5 class="card-title">Users</h5>
        <button class="btn btn-danger mb-2" type="submit" name="bulk-delete" form="bulk-delete-form">Bulk Delete</button>
        <button class="btn btn-danger mb-2 pull-right" type="submit" name="force-delete" value="1" form="bulk-delete-form">Force Delete</button>
        <table class="mb-0 table table-hover">
            <thead>
            <tr>
                <th>
                    <label class="form-check-label">
                        # <input type="checkbox" class="" id="delete_all">
                    </label>
                </th>
                <th>Name</th>
                <th>Slug</th>
                <th>Index</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @if(!empty($users))
                    <form id="bulk-delete-form" action="{{ route('user.destroy') }}" method="POST">
                        @csrf
                        @foreach($users as $key => $user)
                            <tr>
                                <th scope="row">
                                    <label class="form-check-label">
                                        #{{ $key + 1 }} <input type="checkbox" class="" name="delete_user_ids[]" value="{{ $user->id }}">
                                    </label>
                                </th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->slug }}</td>
                                <td>{{ $user->index }}</td>
                                <td>{!! $user->getStatusText() !!}</td>
                                <td>
                                    <a target="_blank" class="btn btn-info" href="{{ route('user.edit', ['id' => $user->id]) }}"><i class="pe-7s-edit"></i> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </form>
                @endif
            </tbody>
        </table>
        <hr>
        <button class="btn btn-danger mb-2" type="submit" name="bulk-delete" form="bulk-delete-form">Bulk Delete</button>
        <button class="btn btn-danger mb-2 pull-right" type="submit" name="force-delete" value="1" form="bulk-delete-form">Force Delete</button>
    </div>
</div>
@endsection
