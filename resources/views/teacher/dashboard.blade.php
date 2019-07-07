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
        <div class="col-md-9">
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
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Add Appointment</div>
                <div class="card-body">
                    <form method="POST" action="/teacher/appointment" autocomplete="off">
                        @csrf
                            <label for="date" class="">{{ __('Date:') }}</label>
                            <input name="date" id="date" class="form-control" type="date">
                            <label for="start_time" class="">{{ __('Start at:') }}</label>
                            <input name="start_time" id="start_time" class="form-control" type="time">
                            <label for="end_time" class="">{{ __('End at:') }}</label>
                            <input name="end_time" id="end_time" class="form-control" type="time">           
                            <button type="submit" class="btn btn-success mt-2">
                                {{ __('Add') }}
                            </button>       
                    </form>
                </div>
            </div>
        </div>        
    </div>   
</div>
@endsection
