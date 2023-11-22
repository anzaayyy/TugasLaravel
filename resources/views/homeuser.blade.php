@extends('layouts.app1')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3 class="text-center my-4">Data Bunga</h3>
                    <hr>
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th scope="col">Nama Bunga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bunga as $bunga)
                            <tr>
                                <td>{{ $bunga->nama }}</td>
                                <td>{{ $bunga->jumlah }}</td>
                                <td>Rp.{{ $bunga->harga }}</td>
                                <td>
                                        @if($bunga->image)
                                        <img src="{{ asset('storage/images/' . $bunga->image) }}" alt="Gambar" style="max-width: 200px; max-height: 200px;">

                                        @else
                                        <p>Tidak ada gambar yang tersedia</p>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('bunga.detail', $bunga->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">
                                    <div class="alert alert-danger">
                                        Data produk belum tersedia.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
