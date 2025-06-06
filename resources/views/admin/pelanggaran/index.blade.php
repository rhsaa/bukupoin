<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Data Pelanggaran</title>
</head>

<body>
  <h1>Data Pelanggaran</h1>
  <a href="{{ route('admin/dashboard') }}">Menu Utama</a><br>
  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
  <br><br>
  <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
  </form>
  <br><br>
  <form action="" method="get">
    <label>Cari :</label>
    <input type="text" name="cari">
    <input type="submit" value="Cari">
  </form>
  <br><br>
  <a href="{{ route('pelanggaran.create') }}">Tambah Pelanggaran</a>

  @if(Session::has('success'))
  <div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
  </div>
  @endif

  <table class="tabel">
    <tr>
      <td>Jenis</td>
      <td>Konsekuensi</td>
      <td>Poin</td>
      <td>Aksi</td>
    </tr>
    @forelse ($pelanggarans as $pelanggaran)
    <tr>
      <td>{{ $pelanggaran->jenis }}</td>
      <td>{{ $pelanggaran->konsekuensi }}</td>
      <td>{{ $pelanggaran->poin }}</td>
      <td>
        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pelanggaran.destroy', $pelanggaran->id) }}" method="POST">
          <a href="{{ route('pelanggaran.edit', $pelanggaran->id) }}" class="btn btn-sm btn-primary">EDIT</a>
          @csrf
          @method('DELETE')
          <button type="submit">HAPUS</button>
        </form>
      </td>
    </tr>
    @empty
    <tr>
      <td>
        <p>data tidak ditemukan</p>
      </td>
      <td>
        <a href="{{ route('pelanggaran.index') }}">kembali</a>
      </td>
    </tr>
    @endforelse
  </table>
  {{ $pelanggarans->links() }}
  
</body>

</html>