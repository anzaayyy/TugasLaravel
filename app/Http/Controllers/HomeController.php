<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bunga;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index() : View
    {
        $bunga = Bunga::get();

        return view('home_page', compact('bunga'));
    }

    public function index1() : View
    {
        $bunga = Bunga::get();
        return view('home', compact('bunga'));
    }
    public function index2() : View
    {
        $bunga = Bunga::get();
        return view('homeuser', compact('bunga'));
    }

    public function create() : View
    {
        return view ('create');
    }

    public function store(Request $request) : RedirectResponse
    {
    $this->validate($request,[
        'nama' => 'required',
        'jumlah' => 'required',
        'harga' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('images', $imageName, 'public');
    } else {
        $imageName = null; // No image uploaded
    }

    Bunga::create([
        'nama' => $request->nama,
        'warna' => $request->warna,
        'jenis' => $request->jenis,
        'tinggi' => $request->tinggi,
        'harga' => $request->harga,
        'jumlah' => $request->jumlah,
        'image' => $imageName,
    ]);

    return redirect()->route('bunga.home')->with(['succes' => 'Data Berhasil Disimpan']);
    }

        public function edit(string $id) : View
    {
        $bunga = Bunga::findOrFail($id);

        return view('edit', compact('bunga'));
    }

    public function destroy(string $id) : RedirectResponse
    {
        $bunga = Bunga::findOrFail($id);
        $bunga->delete();
        return redirect()->route('bunga.home')->with(['succes'=>'Data Berhasil Dihapus']);
    }

    public function update(Request $request, $id) :RedirectResponse
    {
    $this->validate($request, [
        'nama' => 'required',
        'jumlah' => 'required',
        'harga' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
     ]);

    $bunga = Bunga::findOrFail($id);

    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($bunga->image) {
            Storage::delete('public/images/' . $bunga->image);
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('images', $imageName, 'public');

        $bunga->image = $imageName; // Update the image file name in the database
    }

    $bunga->jumlah = $request->jumlah;
    $bunga->nama = $request->nama;
    $bunga->harga = $request->harga;
    $bunga->save();

    return redirect()->route('bunga.home')->with('success', 'Bunga berhasil diperbarui.');
    }

    public function show(string $id) : View
    {
        $bunga = DB::table('bungas')->where('id', $id)->first();

        return view('detail', compact('bunga'));
    }
    public function beli($id)
{
    $bunga = Bunga::findOrFail($id);

    if ($bunga->jumlah > 0) {
        $bunga->jumlah -= 1;
        $bunga->save();

        // Tambahkan log pembelian atau transaksi di sini jika diperlukan

        return redirect()->route('homeuser')->with('success', 'Bunga berhasil dibeli.');
    } else {
        return redirect()->back()->with('error', 'Maaf, stok bunga habis.');
    }
}

}

