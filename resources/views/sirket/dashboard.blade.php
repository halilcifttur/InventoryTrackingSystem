@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Şirket Yönetim Paneli</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Merhaba {{Auth::user()->name}}
                </div>
            </div>
        </div>        
    </div>
    <div class="mt-3"></div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Çalışanlar</div>
                <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table">                        
                        <tr>
                            <th>İsim</th>
                            <th>Mail</th>
                            <th>Şehir</th>
                            <th>İlçe</th>
                            <th>İşlem</th>
                        </tr>                        
                            @foreach($users as $user)
                                @if(Auth::user()->sirket_id == $user->sirket_id && $user->role_id == 2)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->il_isim }}</td>
                                        <td>{{ $user->ilce_isim }}</td>
                                        <td>
                                            {!! Form::open(['action' => ['Sirket\DashboardController@destroy', $user->id], 'method' => 'POST']) !!}

                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Sil', ['class' => 'btn btn-danger'])}}
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
                <div class="card-header">Depolar</div>
                <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table">                        
                        <tr>
                            <th>İsim</th>
                            <th>Şehir</th>
                            <th>İlçe</th>
                            <th>İşlem</th>
                        </tr>                        
                            @foreach($depos as $depo)
                                @if(Auth::user()->sirket_id == $depo->sirket_id)
                                    <tr>
                                        <td>{{ $depo->depo_adı }}</td>
                                        <td>{{ $depo->il_isim }}</td>
                                        <td>{{ $depo->ilce_isim }}</td>
                                        <td>
                                            {!! Form::open(['action' => ['Sirket\DashboardController@destroy2'], 'method' => 'POST']) !!}

                                                {{Form::hidden('depo_id', $depo->id )}}
                                                {{Form::submit('Sil', ['class' => 'btn btn-danger'])}}
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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ürün Listesi</div>
                <div class="card-body">
                    <table class="table">                        
                        <tr>
                            <th>İsim</th>
                            <th>Adet</th>
                            <th>Depo</th>
                            <th>İşlem</th>
                        </tr>                        
                            @foreach($uruns as $urun)
                                @if(Auth::user()->sirket_id == $urun->sirket_id)
                                <tr>
                                    <td>{{ $urun->name }}</td>
                                    <td>{{ $urun->adet }}</td>
                                    <td>{{ $urun->depo_adı }}</td>
                                    <td>
                                        {!! Form::open(['action' => ['Sirket\DashboardController@destroy3'], 'method' => 'POST']) !!}

                                            {{Form::hidden('urun_id', $urun->id )}}
                                            {{Form::submit('Sil', ['class' => 'btn btn-danger'])}}
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
            <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true">Çalışan ekle</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="sirket-tab" data-toggle="tab" href="#sirket" role="tab" aria-controls="sirket" aria-selected="false">Depo ekle</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active offset-md-3" id="user" role="tabpanel" aria-labelledby="user-tab">
            <div class="mt-3"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Çalışan Ekle</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/sirket/register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="isim" class="col-md-4 col-form-label text-md-right">{{ __('İsim') }}</label>

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
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail ') }}</label>

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
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Şifre') }}</label>

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
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Şifre tekrar') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="il" class="col-md-4 col-form-label text-md-right">{{ __('İl') }}</label>

                                <div class="col-md-6">
                                    <select name="il" id="il" class="form-control">
                                        <option>Bir il seçiniz</option>
                                        @foreach($iller as $il)
                                            <option value="{{ $il->il_no }}">{{ $il->isim }}</option>
                                        @endforeach
                                    </select>
                                </div>                                
                            </div>

                            <div class="form-group row">
                                <label for="ilce" class="col-md-4 col-form-label text-md-right">{{ __('İlçe') }}</label>

                                <div class="col-md-6">
                                    <select name="ilce" id="ilc" class="form-control">
                                    </select>
                                </div>                                
                            </div>
                            
                            <div class="form-group row mb-0 justify-content-center">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Ekle') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade offset-md-3" id="sirket" role="tabpanel" aria-labelledby="sirket-tab">
        <div class="mt-3"></div>
        <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Depo Ekle</div>
                    <div class="card-body">
                        <form method="POST" action="/sirket/depo" autocomplete="off">
                            @csrf
                            <div class="form-group row">
                                    <label for="isim" class="col-md-4 col-form-label text-md-right">{{ __('İsim') }}</label>

                                    <div class="col-md-6">
                                        <input id="sname" type="text" class="form-control @error('sname') is-invalid @enderror" name="sname" value="{{ old('sname') }}" required autocomplete="sname" autofocus>

                                        @error('sname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="il" class="col-md-4 col-form-label text-md-right">{{ __('İl') }}</label>

                                    <div class="col-md-6">
                                        <select name="il" id="il2" class="form-control">
                                            <option>Bir il seçiniz</option>
                                            @foreach($iller as $il)
                                                <option value="{{ $il->il_no }}">{{ $il->isim }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                
                                </div>

                                <div class="form-group row">
                                    <label for="ilce" class="col-md-4 col-form-label text-md-right">{{ __('İlçe') }}</label>

                                    <div class="col-md-6">
                                        <select name="ilce" id="ilc2" class="form-control">
                                        </select>
                                    </div>                                
                                </div>

                                <div class="form-group row mb-0 justify-content-center">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Ekle') }}
                                        </button>
                                    </div>
                                </div>       
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
