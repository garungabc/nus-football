@extends('layouts.master')

@section('content')
<div class="main-content container mt-3 mb-5">
	<h5 class="text-center">Prepare</h5>
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
					@php
						$flag = 0;
					@endphp
					@foreach($users as $user)
						@if($flag == 0)
							<tr>
						@endif
						<td class="text-center">{{ $user['name'] }}</td>
						<td class="text-center">
							<input type="checkbox" name="u-off[]" value="{{ $user->id }}">
						</td>
						@if($flag == 2)
							</tr>
							@php
								$flag = 0;
							@endphp
						@endif
						@php
							$flag++;
						@endphp
					@endforeach
				</table>
				<button type="submit" class="btn btn-sm btn-success">Submit</button>
			</form>
		</div>
	</div>
</div>

@endsection