<!-- resources/views/detail.blade.php -->

@extends('layouts.app1') {{-- You can adjust the layout based on your application's structure --}}

@section('content')
    <div class="container">
        <h2>Detail Bunga</h2>
        <div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">Nama</th>
                        <td>{{ $bunga->nama }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Warna</th>
                        <td>{{ $bunga->warna }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jenis</th>
                        <td>{{ $bunga->jenis }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Tinggi</th>
                        <td>{{ $bunga->tinggi }} cm</td>
                    </tr>
                    <tr>
                        <th scope="row">Harga</th>
                        <td>Rp.{{ $bunga->harga }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah</th>
                        <td>{{ $bunga->jumlah }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Gambar</th>
                        <td>
                            @if ($bunga->image)
                                <img src="{{ asset('storage/images/' . $bunga->image) }}" alt="Bunga Image" style="max-width: 200px; max-height: 200px;">
                            @else
                                <p>No image available</p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('homeuser') }}" class="btn btn-primary">Kembali</a>

            <form action="{{ route('bunga.beli', $bunga->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin akan membeli {{ $bunga->nama }}?')">
                @csrf
                <button type="submit" class="btn btn-success">Beli</button>
           </form>
        </div>
    </div>
@endsection
