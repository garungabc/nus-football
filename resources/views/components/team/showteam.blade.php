@extends('layouts.master')

@section('styles')
<style>
    input[type="text"] {
        background: none !important;
    }
</style>
@endsection

@section('content')
<div class="main-content container mt-3 pl-0 mb-4">
	<h5 class="text-center">SET TEAM TOOL</h5>
    <div class=""><p>Tổng số: {{ $sum }} người</p></div>
    <form action="{{ route('save.setup.team') }}" method="POST">
        @csrf
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
                                        <th class="text-center text-white" style="background-color: {{ $bg_color }};">Team {{ $i }}</th>
                                    </tr>
                                </thead>
                                @if(isset($team[$i]) && !empty($team[$i]))
                                    @foreach($team[$i] as $item)
                                    <tr>
                                        <td class="text-center p-2"><input type="text" class="border-0" name="team_{{ $i }}[]" value="{{ $item['name'] }}"></td>
                                    </tr>
                                    @endforeach
                                    @if(count($team[$i]) < $max_row)
                                        @for($row = 1; $row <= $max_row - count($team[$i]); $row++)
                                        <tr>
                                            <td class="text-center p-2">
                                                <input type="text" class="border-0" name="team_{{ $i }}[]" value="">
                                            </td>
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
                                        <th class="text-center text-white" style="background-color: {{ $bg_color }};">Team {{ $i }}</th>
                                    </tr>
                                </thead>
                                @for($j = 0; $j < $max_row; $j++)
                                <tr>
                                    <td class="text-center p-2">
                                        <input type="text" class="border-0" name="team_{{ $i }}[]" value="">
                                    </td>
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
                        <td class="p-0"><input type="text" name="come_late[]" class="text-center border-0 w-100"></td>
                        <td class="p-0"><input type="text" name="leave_early[]" class="text-center border-0 w-100"></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <input type="hidden" name="max_row" value="{{ $max_row }}">
        <input type="hidden" name="sum" value="{{ $sum }}">
        <a class="btn btn-sm btn-success"  href="javascript:location.reload(true)">Refresh</a>
        <button class="btn btn-sm btn-primary" type="submit">Save</button>
    </form>
	{!! $image !!}
</div>

@endsection
