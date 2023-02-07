<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
<style>
 

.btn-login {
  font-size: 0.9rem;
  letter-spacing: 0.05rem;
  padding: 0.75rem 1rem;
}

.btn-google {
  color: white !important;
  background-color: #ea4335;
}

.btn-facebook {
  color: white !important;
  background-color: #3b5998;
}
#bg-home{
    height:100%;
    width:100%;
    text-align:center;
    background:url('bg.jpeg') no-repeat center;
    background-size:cover;
    -webkit-filter: blur(6px);
    -moz-filter: blur(13px);
    -o-filter: blur(13px);
    -ms-filter: blur(13px);
    filter: blur(6px);
    position: absolute;
    left:0;
    top: 0;
}
</style>
<body>
    <div id="bg-home"> </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto mt-5">
          <div class="card border-0 shadow rounded-3 my-5" style="background: #ffffff8a; color:#396e9d;">
            <div class="card-body p-4 p-sm-5"  style="text-align:center">
              <form>
                <h1>Pastikan Saldo Cukup Untuk Pembayaran Air</h2><br>
                <div class="form-group input-group-lg mb-3" style="display: none;">
                  <input type="text" class="form-control form-large input" autofocus>
                 
                </div>
              </form>
            </div>
          </div>

         
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    @include('sweetalert::alert')
    
    <script src="{{ asset('js/sweetalert.all.js') }}"></script>


    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>

      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;
  
      var pusher = new Pusher('4a74d03b30af8e68ef2e', {
        cluster: 'ap1'
      });

    var channel = pusher.subscribe('my-order');
    channel.bind('new-payment', function(data) {
      Swal.fire({ 
            icon: data[0].statusMsg,
            type: data[0].statusMsg, 
            title: data[0].title,
            html: `<h2>Nama : ${data[0].nama}</h2>
                  <h2>Sisa Saldo : ${data[0].saldo}<b></b></h2>`,
            timer: 5000,
         });
    });
    </script>
<script>
 

  $('.input').keypress(function (e) {
  if (e.which == 13) {
      e.preventDefault();
   var nomor_kartu = $(this).val();
    var request = $.ajax({
    url: "{{ route('payment') }}",
    type: "POST",
    data: {"_token": "{{ csrf_token() }}", nomor_kartu : nomor_kartu},
    dataType: "json"
    });

    request.done(function(data) {
        if(data.status){
            Swal.fire({ 
            icon: 'success',
            type: 'success', 
            title: 'Pembayaran berhasil',
            html: '<h2>Sisa Saldo : <b>'+ data.data.saldo +'</b></h2>',
            timer: 5000,
         });
        }else{
            Swal.fire({ 
            icon: 'error',
            type: 'error', 
            title: 'Pembayaran Gagal',
            html: '<h2>Saldo anda tidak cukup!</h2>',
            timer: 5000,
         });
        }
        
        $(this).val('');

    });

    request.fail(function(jqXHR, textStatus) {
        alert( jqXHR.responseJSON.error );
    });   
  }
});
</script>  
</body>
</html>