@extends('layouts.master')

@section('content')
<div class="main-content container mt-3">
	<a class="btn btn-sm btn-danger"  href="{{ route('prepare.team') }}">Back</a>
	<h5 class="text-center">SET TEAM TOOL</h5>
	<div class=""><p>Tổng số: {{ $sum }} người</p></div>
	<div class="row">
		<div class="col col-3 pr-0">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center" style="background-color: #27ae60;">Team 1 ({{ isset($team[1]) ? count($team[1]) : 0 }})</th>
					</tr>
				</thead>
				@if(isset($team[1]) && !empty($team[1]))
					@foreach($team[1] as $item)
					<tr>
						<td class="text-center">{{ $item['name'] }}</td>
					</tr>
					@endforeach
				@endif
			</table>
		</div>
		<div class="col col-3 pr-0 pl-0">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center" style="background-color: #3498db;">Team 2 ({{ isset($team[2]) ? count($team[2]) : 0 }})</th>
					</tr>
				</thead>
				@if(isset($team[2]) && !empty($team[2]))
					@foreach($team[2] as $item)
					<tr>
						<td class="text-center">{{ $item['name'] }}</td>
					</tr>
					@endforeach
				@endif
			</table>
		</div>
		<div class="col col-3 pr-0 pl-0">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center" style="background-color: #e74c3c;">Team 3 ({{ isset($team[3]) ? count($team[3]) : 0 }})</th>
					</tr>
				</thead>
				@if(isset($team[3]) && !empty($team[3]))
					@foreach($team[3] as $item)
					<tr>
						<td class="text-center">{{ $item['name'] }}</td>
					</tr>
					@endforeach
				@endif
			</table>
		</div>
		<div class="col col-3 pl-0">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center" style="background-color: #f1c40f;">Team 4 ({{ isset($team[4]) ? count($team[4]) : 0 }})</th>
					</tr>
				</thead>
				@if(isset($team[4]) && !empty($team[4]))
					@foreach($team[4] as $item)
					<tr>
						<td class="text-center">{{ $item['name'] }}</td>
					</tr>
					@endforeach
				@endif
			</table>
		</div>
	</div>
	<a class="btn btn-sm btn-success"  href="javascript:location.reload(true)">Refresh</a>
</div>

@endsection