@extends('layouts.master')

@section('content')
<div class="main-content container mt-3 mb-5">
	<div class="row">
		<div class="col-sm-6 pr-0">
            <form action="{{ route('handle.set.team') }}" method="POST">
                @csrf
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">PREPARE TO ORGANIZATION</h5>
                        <table class="mb-0 table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Off</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td class="">
                                        <label class="form-check-label w-100">
                                            <input type="checkbox" class="form-check-input" name="u-off[]
                                            " value="{{ $user->id }}">
                                            {{ $user->name }}
                                        </label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
				<button type="submit" class="btn btn-sm btn-success">Submit</button>
            </form>
		</div>
	</div>
</div>

@endsection
