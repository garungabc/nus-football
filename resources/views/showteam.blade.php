@extends('layouts.master')

@section('content')
<div class="main-content container mt-3 pl-0 mb-4">
	<a class="btn btn-sm btn-danger"  href="{{ route('prepare.team') }}">Back</a>
	<h5 class="text-center">SET TEAM TOOL</h5>
	<div class=""><p>Tổng số: {{ $sum }} người</p></div>
	<div class="row">
		@if(!empty($team))
			@for($i = 1; $i <= 4; $i++)
				@php
					switch ($i) {
						case '1':
							$bg_color = '#27ae60';
							break;
						case '2':
							$bg_color = '#3498db';
							break;
						case '3':
							$bg_color = '#e74c3c';
							break;
						case '4':
							$bg_color = '#f1c40f';
							break;
						
						default:
							break;
					}
				@endphp
				
				@if(isset($team[$i]))
					<div class="col col-3 pr-0 {{ ($i != 1) ? 'pl-0' : '' }}">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center" style="background-color: {{ $bg_color }};">Team {{ $i }} ({{ isset($team[$i]) ? count($team[$i]) : 0 }})</th>
								</tr>
							</thead>
							@if(isset($team[$i]) && !empty($team[$i]))
								@foreach($team[$i] as $item)
								<tr>
									<td class="text-center">{{ $item['name'] }}</td>
								</tr>
								@endforeach
								@if(count($team[$i]) < $max_row)
									@for($row = 1; $row <= $max_row - count($team[$i]); $row++)
									<tr>
										<td class="text-center" style="height: 49px;"></td>
									</tr>
									@endfor
								@endif
							@endif
						</table>
					</div>
				@else
					<div class="col col-3 pr-0">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center" style="background-color: {{ $bg_color }};">Team {{ $i }}</th>
								</tr>
							</thead>
							@for($j = 0; $j < floor($sum / 4); $j++)
							<tr>
								<td class="text-center"></td>
							</tr>
							@endfor
						</table>
					</div>
				@endif
			@endfor
		@endif
	</div>
	<a class="btn btn-sm btn-success"  href="javascript:location.reload(true)">Refresh</a>
</div>

@endsection