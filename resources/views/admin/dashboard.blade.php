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
                    Total Users: <strong>{{ $users->count() }}</strong> |
                    @foreach($c as $b)
                        @if($b->role_id == 2)

                        Students: <strong>{{ $b->count }}</strong> 
                        @elseif($b->role_id == 1)
                        
                        Teachers: <strong>{{ $b->count }}</strong> |
                        @endif
                    @endforeach
                </div>
            </div>
        </div>        
    </div>
    <div class="mt-3"></div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Teachers</div>
                <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table">                        
                        <tr>
                            <th>Name</th>
                            <th>Email</th> 
                            <th>Department</th>
                            <th>Operations</th>
                        </tr>                        
                            @foreach($users as $user)
                                @if($user->role_id == 1)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td> 
                                        <td>{{ $user->dpt_name }}</td>
                                        <td>
                                            {!! Form::open(['action' => ['Admin\DashboardController@destroy', $user->id], 'method' => 'POST']) !!}

                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>                            
                                @endif
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Students</div>
                <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table">                        
                        <tr>
                            <th>Name</th>
                            <th>Email</th> 
                            <th>Department</th>
                            <th>Operations</th>
                        </tr>                        
                            @foreach($users as $user)
                                @if($user->role_id == 2)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td> 
                                        <td>{{ $user->dpt_name }}</td>
                                        <td>                                            
                                            {!! Form::open(['action' => ['Admin\DashboardController@destroy', $user->id], 'method' => 'POST']) !!}

                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
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
    <div class="mt-3"></div>
    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true">Add User</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="department-tab" data-toggle="tab" href="#department" role="tab" aria-controls="department" aria-selected="false">Add Department</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active offset-md-3" id="user" role="tabpanel" aria-labelledby="user-tab">
        <div class="mt-3"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New User</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/admin/register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                <select name="department" id="dpt" class="form-control">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="form-check offset-md-2">
                                  <input class="form-check-input" type="checkbox" value="1" id="role" name="role_id">
                                  <label class="form-check-label" for="role">
                                    Teacher
                                  </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
      <div class="tab-pane fade offset-md-4" id="department" role="tabpanel" aria-labelledby="department-tab">
        <div class="mt-3"></div>
        <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Add Department</div>
                    <div class="card-body">
                        <form method="POST" action="/admin/department" autocomplete="off">
                            @csrf
                                <label for="name" class="">{{ __('Name:') }}</label>
                                <input name="name" id="name" class="form-control" type="text">           
                                <button type="submit" class="btn btn-success mt-4 offset-md-5">
                                    {{ __('Add') }}
                                </button>       
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
