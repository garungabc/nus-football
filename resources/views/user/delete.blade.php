@extends('layouts.master')

@section('content')
<div class="main-content container mt-3 mb-5">
	<h5 class="text-center">Delete user</h5>
	<div class="row">
        <div class="col col-12">
            <a class="btn btn-sm btn-danger"  href="{{ route('prepare.team') }}">Back</a>
            <a class="btn btn-primary float-right" href="{{ route('user.create') }}">+ Create new</a>
        </div>
    </div>
    <br>
	<div class="row">
		<div class="col col-12 pr-0">
			<form action="{{ route('user.destroy') }}" method="POST">
				<table class="table table-bordered">
                    @if(!empty($columns))
                        @foreach($columns as $users)
                        <tr>
                            @foreach($users as $user)
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">
                                <input type="checkbox" name="u-off[]" value="{{ $user->id }}">
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    @endif
				</table>
				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
		</div>
	</div>
</div>

@endsection
