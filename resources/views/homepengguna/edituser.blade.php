<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Document</title>
</head>
<body>
    @include('template.navbar')
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <h2 class="text-center mt-3">Edit User</h2>
                <form action="{{ route('postEditUser', $pengguna->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Nama</label>
                    <input type="text" required value="{{ $pengguna->name }}" name="name" class="form-control">
                    <label for="email">email</label>
                    <input type="text" required value="{{ $pengguna->email }}" name="email" class="form-control">
                    <label for="role">role</label>
                    <input type="text" required value="{{ $pengguna->role }}" name="role" class="form-control">
                    <label for="no_hp">Kontak</label>
                    <input type="text" required value="{{ $pengguna->no_hp }}" name="no_hp" class="form-control">
                    <label for="alamat">alamat</label>
                    <input type="text" required value="{{ $pengguna->alamat }}" name="alamat" class="form-control">
                    
                    <button class="btn btn-success mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
