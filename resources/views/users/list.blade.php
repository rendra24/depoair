<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
<body>
   <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card my-3">
                <div class="card-header">
                    <div class="row">
                      <div class="col-md-10">
                        <h3>Data User</h3>
                      </div>
                      <div class="col-md-2 float-right">
                        <a href="{{ route('users.create') }}" class="btn btn-primary color-white">Tambahkan User</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No Kendaraan</th>
                                <th>No Kartu</th>
                                <th>Telp</th>
                                <th>Saldo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $row)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->nomor_kendaraan }}</td>
                                <td>{{ $row->nomor_kartu }}</td>
                                <td>{{ $row->telp }}</td>
                                <td>{{ $row->saldo }}</td>
                                <td><a href="{{ route('users.edit', $row->id) }}" class="btn btn-info btn-sm text-color-white">Edit</a></td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    @include('sweetalert::alert')
  </body>
</html>