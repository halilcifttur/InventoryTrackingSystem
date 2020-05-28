@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kullanıcı Paneli</div>

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
        <div class="col-md-8">
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
                                        {!! Form::open(['action' => ['Calisan\DashboardController@destroy', $urun->id], 'method' => 'POST']) !!}

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
    </div>
    <div class="mt-3"></div>
    <div class="row justify-content-center">        
        <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Ürün Ekle</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/calisan/urun') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="isim" class="col-md-4 col-form-label text-md-right">{{ __('İsim') }}</label>

                                <div class="col-md-6">
                                    <input id="isim" type="text" class="form-control @error('isim') is-invalid @enderror" name="isim" value="{{ old('isim') }}" required autocomplete="isim" autofocus>

                                    @error('isim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="adet" class="col-md-4 col-form-label text-md-right">{{ __('Adet') }}</label>

                                <div class="col-md-6">
                                    <input id="adet" type="numeric" class="form-control @error('adet') is-invalid @enderror" name="adet" value="{{ old('adet') }}" required autocomplete="adet" autofocus>

                                    @error('adet')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="depo" class="col-md-4 col-form-label text-md-right">{{ __('Depo') }}</label>

                                <div class="col-md-6">
                                    <select name="depo" id="dpt" class="form-control">
                                        @foreach($depos as $depo)
                                            @if(Auth::user()->sirket_id == $depo->sirket_id)
                                                <option value="{{$depo->id}}">{{$depo->depo_adı}}</option>
                                            @endif
                                        @endforeach
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
@endsection
