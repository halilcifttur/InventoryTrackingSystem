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

                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($appointment->date)) }}</td>
                                <td>{{ $appointment->start_at }}</td>
                                <td>{{ $appointment->end_at }}</td>
                                @if($appointment->status == false)
                                <td>Empty</td>
                                @else
                                <td>Full</td>
                                @endif
                                <td>
                                    {!! Form::open(['action' => ['Student\DashboardController@update', $appointment->id], 'method' => 'POST']) !!}

                                        {{Form::hidden('_method', 'PUT')}}
                                        @if($appointment->status == false)
                                            {{Form::submit('Take', ['class' => 'btn btn-success'])}}
                                        @else
                                            {{Form::submit('Take', ['class' => 'btn btn-success', 'disabled' => 'disabled'])}}
                                        @endif
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
