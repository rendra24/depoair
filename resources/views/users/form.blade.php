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
                <div class="card-body">
                    <form action="{{ isset($user) ? route('users.update',$user->id) : route('users.store')  }}" method="post">
                        @csrf
                        @if(isset($user))
                                @method('PUT')
                            @endif
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group my-2">
                                    <label for="namaInput">Nama</label>
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" value="{{ old('nama', $user->nama ?? '') }}">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group my-2">
                                    <label for="namaInput">Telp</label>
                                    <input type="number" name="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="Telp" value="{{ old('telp', $user->telp ?? '') }}">
                                    @error('telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                @if(!isset($user))
                                <div class="form-group my-2">
                                    <label for="namaInput">Username</label>
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username">
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group my-2">
                                    <label for="namaInput">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <div class="form-group my-2">
                                    <label for="namaKendaraan">Nomor Kendaraan</label>
                                    <input type="text" name="nomor_kendaraan" class="form-control @error('nomor_kendaraan') is-invalid @enderror" placeholder="Nomor Kendaraan" value="{{ old('nomor_kendaraan', $user->nomor_kendaraan ?? '') }}">
                                    @error('nomor_kendaraan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                @if(!isset($user))
                                <div class="form-group my-2">
                                    
                                    <label for="namaKartu">Nomor Kartu</label>
                                    <select name="nomor_kartu" class="form-control @error('nomor_kartu') is-invalid @enderror">
                                        <option value="">Pilih Kartu</option>
                                        @foreach($kartu as $key => $row)
                                            <option value="{{ $row->nomor_kartu }}">{{ $row->nomor_kartu }}</option>
                                        @endforeach
                                    </select>
                                    
                                    @error('nomor_kartu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                @endif
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>