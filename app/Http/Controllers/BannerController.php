<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.banner', [
            'banner' => Banner::paginate(5),
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
            'banner' => 'image|file',
        ]);

        if($request->file('banner')){
            $validatedData['banner'] = $request->file('banner')->store('gambar-slider'); 
        }

        Banner::create($validatedData);

        return redirect('/admin/dashboard')->with('success' , 'Slider baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'banner' => 'image|file',
        ];
    
        $validatedData = $request->validate($rules);
    
        $banner = Banner::findOrFail($id);
    
        // Check if a new image file is uploaded
        if ($request->file('banner')) {
            // Delete old image if it exists
            if ($banner->banner) {
                Storage::delete($banner->banner);
            }
            // Store new image
            $validatedData['banner'] = $request->file('banner')->store('gambar-slider');
        }
    
        // Update the category with validated data
        $banner->update($validatedData);
        // dd($kategoriMakanan);
    
        return redirect('/admin/dashboard')->with('success', 'Slider berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        Storage::delete($banner->banner);

    
        $banner->delete();

        //redirect to index
        return redirect('/admin/dashboard')->with(['success' => 'Banner Berhasil Dihapus!']);
    }
}
