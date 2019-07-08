@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome <strong>{{ Auth::user()->name }}</strong>!
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3"></div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Appointments</div>
                <div class="card-body table-wrapper-scroll-y custom-scrollbar">
                    <table class="table"> 

                        <th>Date</th>
                        <th>Start at</th> 
                        <th>End at</th>
                        <th>Status</th>
                        <th>Operations</th>

                            @foreach($apps as $app)
                            @if(Auth::user()->std_dpt->dpt_id == $app->dpt_id)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($app->date)) }}</td>
                                <td>{{ $app->start_at }}</td>
                                <td>{{ $app->end_at }}</td>
                                @if($app->status == false)
                                <td style="color: green;">Empty</td>
                                @else
                                <td style="color: red;">Taken</td>
                                @endif
                                <td>
                                    {!! Form::open(['action' => ['Student\DashboardController@update', $app->id], 'method' => 'POST']) !!}

                                        {{Form::hidden('_method', 'PUT')}}
                                        @if($app->status == false)
                                            {{Form::submit('Take', ['class' => 'btn btn-success'])}}
                                            @if(Auth::user()->id == $app->std_id)
                                                {{Form::submit('Drop', ['class' => 'btn btn-danger', 'disabled' => 'disabled'])}}
                                            @endif
                                        @else
                                            {{Form::submit('Take', ['class' => 'btn btn-success', 'disabled' => 'disabled'])}}
                                            @if(Auth::user()->id == $app->std_id)
                                                {{Form::submit('Drop', ['class' => 'btn btn-danger'])}}
                                            @endif
                                        @endif
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endif
                            @endforeach        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
