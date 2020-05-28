@extends('layouts.app')

@section('content')
<div class="mt-3"></div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <table id="datatable__id" class="display">
                    <thead>
                        <tr>
                            <th>Şirket Adı</th>
                            <th>İl</th>
                            <th>İlçe</th>
                            <th>Çalışan Adı</th>
                            <th>Çalışan Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>        
</div>
@endsection

@section('javascripts')
    <script>
        $(document).ready( function() {

            $('#datatable__id').DataTable({

                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('api.customers.index')}}",
                "columns": [

                    {"data": "sirket_isim"},
                    {"data": "il_isim"},
                    {"data": "ilce_isim"},
                    {"data": "calisan_isim"},
                    {"data": "calisan_email"}
                ] 
            });
        });
    </script>
@endsection