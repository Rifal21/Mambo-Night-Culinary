<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tenant.index', [
            'tenant' => Tenant::paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'alamat' => 'required',
            'gambar' => 'image|file',
        ]);

        if($request->file('gambar')){
            $validatedData['gambar'] = $request->file('gambar')->store('gambar-tenant'); 
        }

        Tenant::create($validatedData);

        return redirect('/admin/tenant')->with('success' , 'Tenant baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:255',
            'alamat' => 'required',
            'gambar' => 'image|file',
        ];
    
        $validatedData = $request->validate($rules);
    
        $tenant = Tenant::findOrFail($id);
    
        // Check if a new image file is uploaded
        if ($request->file('gambar')) {
            // Delete old image if it exists
            if ($tenant->gambar) {
                Storage::delete($tenant->gambar);
            }
            // Store new image
            $validatedData['gambar'] = $request->file('gambar')->store('gambar-tenant');
        }
    
        // Update the category with validated data
        $tenant->update($validatedData);
        // dd($kategoriMakanan);
    
        return redirect('/admin/tenant')->with('success', 'Tenant berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);

        Storage::delete($tenant->gambar);

    
        $tenant->delete();

        //redirect to index
        return redirect('/admin/tenant')->with(['success' => 'Tenant Berhasil Dihapus!']);
    }
}
