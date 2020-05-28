@extends('layouts.app')
@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" action="/admin/kaydet/companyID" autocomplete="off" id="companyUpdate">
        @csrf
            <div class="form-group row mr-4">
                <label for="isim" class="col-md-4 col-form-label text-md-right">{{ __('İsim') }}</label>

                <div class="col-md-6">
                    <input id="sname2" type="text" class="form-control @error('sname') is-invalid @enderror" name="sname" value="{{ old('sname') }}" required autocomplete="sname" autofocus>

                    @error('sname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

                <div class="form-group row mr-4">
                    <label for="il" class="col-md-4 col-form-label text-md-right">{{ __('İl') }}</label>

                    <div class="col-md-6">
                        <select name="il" id="il3" class="form-control">
                            <option>Bir il seçiniz</option>
                            @foreach($iller as $il)
                                <option value="{{ $il->il_no }}">{{ $il->isim }}</option>
                            @endforeach
                        </select>
                    </div>                                
                </div>

                <div class="form-group row mr-4">
                    <label for="ilce" class="col-md-4 col-form-label text-md-right">{{ __('İlçe') }}</label>

                    <div class="col-md-6">
                        <select name="ilce" id="ilc3" class="form-control">
                        </select>
                    </div>                                
                </div>
        </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary kaydet" data-id="">Kaydet</button>
          </div>
          </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" action="/admin/kaydet/userID" autocomplete="off" id="userUpdate">
        @csrf
            <div class="form-group row mr-4">
                <label for="isim" class="col-md-4 col-form-label text-md-right">{{ __('İsim') }}</label>

                <div class="col-md-6">
                    <input id="sname3" type="text" class="form-control @error('sname') is-invalid @enderror" name="sname" value="{{ old('sname') }}" required autocomplete="sname" autofocus>

                    @error('sname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mr-4">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail ') }}</label>

                <div class="col-md-6">
                    <input id="email2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mr-4">
                <label for="il" class="col-md-4 col-form-label text-md-right">{{ __('İl') }}</label>

                <div class="col-md-6">
                    <select name="il" id="il4" class="form-control">
                        <option>Bir il seçiniz</option>
                        @foreach($iller as $il)
                            <option value="{{ $il->il_no }}">{{ $il->isim }}</option>
                        @endforeach
                    </select>
                </div>                                
            </div>
            <div class="form-group row mr-4">
                    <label for="ilce" class="col-md-4 col-form-label text-md-right">{{ __('İlçe') }}</label>

                    <div class="col-md-6">
                        <select name="ilce" id="ilc4" class="form-control">
                        </select>
                    </div>                                
            </div>               
        </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary kaydet2" data-id="">Kaydet</button>
          </div>
          </div>
    </div>
  </div>
</div>


<div class="container">    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Yönetici Paneli</div>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Şirketler</div>
                <div class="card-body table-wrapper-scroll-y custom-scrollbar">
                    <table class="table">                        
                        <tr>
                            <th>İsim</th>
                            <th>Şehir</th>
                            <th>İlçe</th>
                            <th>Sil</th>
                            <th>Düzenle</th>
                        </tr>                        
                   <div id="dialog-form" title="Sil">Emin Misiniz</div>
                            @foreach($sirkets as $sirket)                                
                                <tr id="company-list-item-{{$sirket->id}}">
                                    <td class="company-list-name">{{ $sirket->name }}</td>
                                    <td class="company-list-province">{{ $sirket->il_isim }}</td>
                                    <td class="company-list-distinct">{{ $sirket->ilce_isim }}</td>
                                    <td>
                                        {!! Form::open(['action' => ['Admin\AdminController@destroy', $sirket->id], 'method' => 'POST']) !!}

                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Sil', ['class' => 'btn btn-danger silme'])}}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                       <button type="button" class="btn btn-primary company" data-toggle="modal" data-target="#exampleModal" updateId="{{$sirket->id}}" data-whatever="@mdo">Edit</button>
                                    </td>
                                </tr>      

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
                <div class="card-header">Kullanıcılar</div>
                <div class="mt-1"></div>                                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table">                        
                                <tr>
                                    <th>İsim</th>
                                    <th>E-Mail</th>
                                    <th>Şehir</th>
                                    <th>İlçe</th>
                                    <th>İşlem</th>
                                </tr>                        
                                    @foreach($users as $user)
                                        @if($user->role_id == 1)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->il_isim }}</td>
                                                <td>{{ $user->ilce_isim }}</td>
                                                <td>
                                                    {!! Form::open(['action' => ['Admin\AdminController@destroy2'], 'method' => 'POST']) !!}

                                                        {{Form::hidden('user_id', $user->id )}}
                                                        {{Form::submit('Sil', ['class' => 'btn btn-danger silme'])}}
                                                    {!! Form::close() !!}
                                                </td>
                                                <td>
                                          <button type="button" class="btn btn-primary user" data-toggle="modal" data-target="#exampleModal2" updateId2="{{$user->id}}" data-whatever="@mdo">Edit</button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                            </table>
                        </div>
                        <div class="col-md-6 table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table">                        
                                <tr>
                                    <th>İsim</th>
                                    <th>E-Mail</th>
                                    <th>Şehir</th>
                                    <th>İlçe</th>
                                    <th>İşlem</th>
                                </tr>                        
                                    @foreach($users as $user)
                                        @if($user->role_id == 2)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->il_isim }}</td>
                                                <td>{{ $user->ilce_isim }}</td>
                                                <td>
                                                    {!! Form::open(['action' => ['Admin\AdminController@destroy2'], 'method' => 'POST']) !!}

                                                        {{Form::hidden('user_id', $user->id )}}
                                                        {{Form::submit('Sil', ['class' => 'btn btn-danger silme'])}}
                                                    {!! Form::close() !!}
                                                </td>
                                                <td>
                                                <button type="button" class="btn btn-primary user" data-toggle="modal" data-target="#exampleModal2" updateId2="{{$user->id}}" data-whatever="@mdo">Edit</button>
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
    </div>
    <div class="mt-3"></div>
    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true">Kullanıcı ekle</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="sirket-tab" data-toggle="tab" href="#sirket" role="tab" aria-controls="sirket" aria-selected="false">Şirket ekle</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active offset-md-3" id="user" role="tabpanel" aria-labelledby="user-tab">
            <div class="mt-3"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Kullanıcı Ekle</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/admin/register') }}">
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
                                <label for="sirket" class="col-md-4 col-form-label text-md-right">{{ __('Şirket') }}</label>

                                <div class="col-md-6">
                                    <select name="sirket" id="dpt" class="form-control">
                                        @foreach($sirkets as $sirket)
                                            <option value="{{ $sirket->id }}">{{ $sirket->name }}</option>
                                        @endforeach
                                    </select>
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

                            <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="form-check offset-md-2">
                                      <input class="form-check-input" type="checkbox" value="1" id="role" name="role_id">
                                      <label class="form-check-label" for="role">
                                        Şirket
                                      </label>
                                    </div>
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
                    <div class="card-header">Şirket Ekle</div>
                    <div class="card-body">
                        <form method="POST" action="/admin/sirket" autocomplete="off">
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

@section('javascripts')

<script>

     $("#dialog-form").hide();

       $(".silme").click(function() { 
             
            var form = $(this);

            event.preventDefault();

                  var deneme=true;

                if(deneme==true)
                  $( function() {
                    $( "#dialog-form" ).dialog({
                
                      resizable: false,
                      height: "auto",
                      width: 400,
                      modal: true,
                      buttons: {
                        "Delete all items": function() {
                          $( this ).dialog( "close" );
                          form.parent('form').submit();
                        },
                        Cancel: function() {
                          $( this ).dialog( "close" );
                        }
                      }
                    });
                  });
                });
    </script>
<script>    

 var companyID;

 $(".company").click(function() { 
  
    event.preventDefault();

    companyID=$(this).attr('updateId');


        $.ajax({

            url:'getSirket/'+companyID,
            type: 'GET',
            datatype: 'json',
            success: function(data) {
            var data = JSON.parse(data);

            $('#sname2').attr('value',data.name);

            $('#il3 option[value='+data.il_id+']').attr('selected','selected');
            
            if (data.il_id) {

                    $.ajax({

                        url:'/'+_ajaxProvince+'/getIlce/'+data.il_id,
                        type: 'GET',
                        datatype: 'json',
                        success: function(data2) {

                            $('#ilc3').html('');

                            $.each(JSON.parse(data2), function(key, values) {

                                if(key == data.ilce_id)
                                $('#ilc3').append("<option value="+key+" selected>"+ values +"</option>");
                                else
                                $('#ilc3').append("<option value="+key+">"+ values +"</option>");
                            });
                        }
                    });
                } else {

                    $('#ilc3').empty();
                }
                
            }
        });
              
    $(".kaydet").click(function(e) { 
    
    e.preventDefault();

    $.ajax({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/admin/kaydet/'+companyID,
        type: 'post',
        data : $('#companyUpdate').serialize(),

        success: function(update) {
             
               var response = JSON.parse(update);

               console.log(response);

               if(response.status)  /*tabloda hepsine farklı id verdik aynı anda değişmesi için*/
               {
                  $('#company-list-item-'+ response.data.id +' .company-list-name').html(response.data.name);
                  $('#company-list-item-'+ response.data.id +' .company-list-province').html($('#il3 option:selected').text());
                  $('#company-list-item-'+ response.data.id +' .company-list-distinct').html($('#ilc3 option:selected').text());
               }         
        }
    })
     
 });

 });

  </script>
<script>

 var userID;

 $(".user").click(function() { 
  
    event.preventDefault();

    userID=$(this).attr('updateId2');


        $.ajax({

            url:'getUser/'+userID,
            type: 'GET',
            datatype: 'json',
            success: function(data) {
                console.log($('email2').attr('value',data.email));

                var data = JSON.parse(data);

               // console.log(data);

            $('#sname3').attr('value',data.name);
            $('#email2').attr('value',data.email);
            $('#il4  option[value='+data.il_id+']').attr('selected','selected');

               if (data.il_id) {

                    $.ajax({

                        url:'/'+_ajaxProvince+'/getIlce/'+data.il_id,
                        type: 'GET',
                        datatype: 'json',
                        success: function(data2) {

                            $('#ilc4').html('');

                            $.each(JSON.parse(data2), function(key, values) {

                                if(key == data.ilce_id)
                                $('#ilc4 ').append("<option value="+key+" selected>"+ values +"</option>");
                                else
                                $('#ilc4 ').append("<option value="+key+">"+ values +"</option>");
                            });
                        }
                    });
                } else {

                    $('#ilc4 ').empty();
                }
       }
    });

    $(".kaydet2").click(function(e) { 
    
    e.preventDefault();

    $.ajax({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/admin/userKaydet/'+userID,
        type: 'post',
        data : $('#userUpdate').serialize(),

        success: function(update) {
             
              var user =JSON.parse(update);

              console.log(user);  // console.log(user); bunun içindeki userla controller update teki aynı olmalı
        


        }
    })
     
 });    
});

</script>
 

@endsection

