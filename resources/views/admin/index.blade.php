@extends('layouts.app')
@section('content')

<title>Admin Aspirations Page</title>

    <h1>Histori Aspirasi</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Isi</th>
                <th>Votes</th>
                <th>Pengirim</th>
                <th>Dikirim pada</th>
                <th>Balasan?</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aspirasi as $index => $asp)
                <tr>
                    <td> {{ $index + 1 }} </td>
                    <td> {{ $asp->title }} </td>
                    <td> {{ ucfirst($asp->category) }} </td>
                    <td> {{ $asp->content }} </td>
                    <td> {{ $asp->votes }} </td>
                    <td> 
                        @if($asp->mahasiswa)
                            NIM: {{ $asp->mahasiswa->nim }} <br>
                        @else
                            -
                        @endif
                    </td>
                    <td> {{ $asp->created_at->format('d M Y, H:i') }} </td>
                    <td>
                        @if($asp->reply)
                            Sudah dibalas.
                        @else
                            Belum dibalas.
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('aspiration.reply.form', $asp->id) }}">
                            <button type="button">Balas</button>
                        </a>

                        <form action="{{ route('aspiration.destroy', $asp->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin hapus?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Belum ada Aspirasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <form action="{{ route('aspiration.destroyAll') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Hapus SEMUA Aspirasi?')">
            Delete All
        </button>
    </form>
@endsection