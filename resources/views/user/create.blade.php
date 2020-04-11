@extends('layouts.master')

@section('content')
<div class="main-content container mt-3 pl-0 mb-4">
    <a class="btn btn-sm btn-danger"  href="{{ route('prepare.team') }}">Back</a>
    <div style="display: flex;justify-content: center;">
        <div class="card" style="width: 500px; ">
            <div class="card-body">
                <h5 class="text-center">Create new member</h5>
                <hr>
                <form action="{{ route('user.store') }}" method="post">
                    <div class="row">
                        <div class="col-2">Name</div>
                        <div class="col-10">
                            <input type="text" class="form-control" name="name">
                            <small>Please enter correct format name. Ex: 'Dậu DQ'</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">Index</div>
                        <div class="col-10">
                            <input type="text" class="form-control" name="index" value="1.5">
                            <small>Index of member. Default: 1.5</small>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
