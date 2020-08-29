@extends('layouts.master')

@section('content')
<div class="main-content container mt-3 pl-0 mb-4">
	<h5 class="text-center">History - Setup Team Weekly</h5>
    @if(!empty($histories))
        @foreach ($histories as $key_team => $item)
            <div class="row">
                <div class="col col-12"><p class="text-center">{{ $item['daysofweek'] . ', ' . $item['date'] }}</p></div>
                <div class="col col-12"><p>Tổng số: {{ $item['sum'] }} người</p></div>
                @if(!empty($item['team']))
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

                        @if(isset($item['team']['team_' . $i]))
                            @php
                                $team = $item['team']['team_' . $i];
                            @endphp
                            <div class="col col-3 pr-0 {{ ($i != 1) ? 'pl-0' : '' }}">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-white" style="background-color: {{ $bg_color }};">Team {{ $i }}</th>
                                        </tr>
                                    </thead>
                                    @if(!empty($team))
                                        @foreach($team as $name)
                                        <tr>
                                            <td class="text-center p-2">{{ $name }}</td>
                                        </tr>
                                        @endforeach
                                        @if(count($team) < $item['max_row'])
                                            @for($row = 1; $row <= $item['max_row'] - count($team); $row++)
                                            <tr>
                                                <td class="text-center" style="height: 41px;"></td>
                                            </tr>
                                            @endfor
                                        @endif
                                    @endif
                                </table>
                            </div>
                        @else
                            <div class="col col-3 pr-0 {{ ($i != 1) ? 'pl-0' : '' }}">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="background-color: {{ $bg_color }};">Team {{ $i }}</th>
                                        </tr>
                                    </thead>
                                    @for($j = 0; $j < $item['max_row']; $j++)
                                    <tr>
                                        <td class="text-center"  style="height: 41px;"></td>
                                    </tr>
                                    @endfor
                                </table>
                            </div>
                        @endif
                    @endfor
                @endif
            </div>
            <div class="row ml-0">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="1" style="background-color: #c0392b" class="text-center text-white">Đến muộn</th>
                            <th colspan="1" style="background-color: #e67e22" class="text-center text-white">Về sớm</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < 4; $i++)
                        <tr>
                            <td class="p-0"><input type="text" value="{{ isset($item['come_late'][$i]) && !empty($item['come_late'][$i]) ? $item['come_late'][$i] : '' }}" class="text-center border-0 w-100"></td>
                            <td class="p-0"><input type="text" value="{{ isset($item['leave_early'][$i]) && !empty($item['leave_early'][$i]) ? $item['leave_early'][$i] : '' }}" class="text-center border-0 w-100"></td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <br><br><hr style="">
        @endforeach
    @endif
</div>
@endsection
