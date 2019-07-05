@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Appointment</div>
                <div class="card-body">
                    <div style="position: relative">
                        <form method="POST" action="/teacher/appointment" autocomplete="off">
                            @csrf
                            <div class="col-md-3">                            
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date:') }}</label>
                                <input name="date" id="date" class="date form-control date-size" type="text">
                            </div>
                            <div class="col-md-3">
                                <label for="start_time" class="col-md-5 col-form-label text-md-right">{{ __('Start at:') }}</label>
                                <input name="start_time" id="start_time" class="timepicker form-control time-size" type="text">
                            </div>
                            <div class="col-md-3">
                                <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('End at:') }}</label>
                                <input name="end_time" id="end_time" class="timepicker form-control time-size" type="text">
                            </div>
                            <div class="col-md-3">                            
                                <button type="submit" class="btn btn-success">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3"></div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Appointments</div>
                <div class="card-body">
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
                                {!! Form::open(['action' => ['Teacher\DashboardController@destroy', $appointment->id], 'method' => 'POST']) !!}

                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
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
