
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
