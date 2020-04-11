@extends('layouts.master')

@section('content')
<div class="main-content container mt-3 mb-5">
	<h5 class="text-center">PREPARE DATE TO SET TEAM</h5>
	<div class="row">
        <div class="col col-12">
            <span class="mr-2"><a class="btn btn-danger float-right" href="{{ route('user.delete') }}">Delete user</a> &nbsp;&nbsp;</span>
            <span><a class="btn btn-primary float-right ml-cus-10" target="_blank" href="{{ route('user.create') }}">+ Create new</a></span>
        </div>
	</div>
	<div class="row">
		<div class="pr-0">
			<form action="{{ route('handle.set.team') }}" method="POST">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">Tên</th>
							<th class="text-center">Báo Nghỉ</th>
						</tr>
                    </thead>
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
				<button type="submit" class="btn btn-sm btn-success">Submit</button>
            </form>
		</div>
	</div>
</div>

@endsection
