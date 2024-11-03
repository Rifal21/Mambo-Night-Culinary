<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriMakanan;
use App\Models\PendaftaranTenant;
use App\Http\Requests\StorePendaftaranTenantRequest;
use App\Http\Requests\UpdatePendaftaranTenantRequest;

class PendaftaranTenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pendaftaran', [
            'title' => 'List Menu Makanan',
            'kategoriAll' => KategoriMakanan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required',
            'pemilik' => 'required',
            'alamat' => 'required',
            'brand' => 'required',
            'email' => 'required',
            'asli' => 'required',
            'status' => 'nullable',
            'fileimage' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
            'priceRange' => 'required',
            'id_kategori' => 'required',
        ]);


        if($request->file('fileimage')){
            $validatedData['fileimage'] = $request->file('fileimage')->store('fileorimage'); 
        }
        // dump($validatedData);
        PendaftaranTenant::create($validatedData);

        return redirect()->back()->with('success' , 'Pendaftaran tenant berhasil diajukan!');
    }

}
