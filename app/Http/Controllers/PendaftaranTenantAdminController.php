<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\PendaftaranTenant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PendaftaranTenantAdminController extends Controller
{
    public function index()
    {
        $pendaftaran = PendaftaranTenant::paginate(6);
        return view('admin.pendaftaran.index', compact('pendaftaran'));
    }
    public function verifikasi($id)
    {
        // Ambil data tenant berdasarkan ID
        $tenant = PendaftaranTenant::find($id);
    
        // Jika data tidak ditemukan, kembalikan pesan error
        if (!$tenant) {
            return redirect()->back()->with('error', 'Data tenant tidak ditemukan.');
        }
    
        // Ubah status menjadi 1 untuk menandakan verifikasi
        $tenant->status = 1;
        $tenant->save();
    
        // Detail tenant untuk pesan WhatsApp
        $phone = $tenant->phone;
        $name = $tenant->name;
        $pemilik = $tenant->pemilik;
        $alamat = $tenant->alamat;
        $brand = $tenant->brand;
        $kategori = $tenant->kategori ? $tenant->kategori->name : 'Tidak Diketahui';
        $priceRange = number_format($tenant->priceRange, 0, ',', '.');
    
        // Pesan WhatsApp yang lebih detail
        $message = "Pendaftaran Anda telah diverifikasi!\n\n"
                 . "Detail Tenant\n\n"
                 . "Nama Pemilik Tenant: {$pemilik}\n"
                 . "Nama Tenant: {$name}\n"
                 . "Nama Brand: {$brand}\n"
                 . "Alamat: {$alamat}\n"
                 . "Jenis Makanan: {$kategori}\n"
                 . "Kisaran Harga: Rp. {$priceRange}\n\n"
                 . "Selamat dan semoga sukses!";
    
        // URL WhatsApp menggunakan deep link
        $whatsappLink = "https://wa.me/{$phone}?text=" . urlencode($message);
    
        // Redirect ke link WhatsApp dan tampilkan pesan sukses
        return Redirect::to($whatsappLink)->with('success', 'Pendaftaran berhasil diverifikasi.');
    }

public function tolak($id)
{
    // Ambil data tenant berdasarkan ID
    $tenant = PendaftaranTenant::find($id);

    // Jika data tidak ditemukan, kembalikan pesan error
    if (!$tenant) {
        return redirect()->back()->with('error', 'Data tenant tidak ditemukan.');
    }

        // Detail tenant untuk pesan WhatsApp
        $phone = $tenant->phone;
        $name = $tenant->name;
        $pemilik = $tenant->pemilik;
        $alamat = $tenant->alamat;
        $brand = $tenant->brand;
        $kategori = $tenant->kategori ? $tenant->kategori->name : 'Tidak Diketahui';
        $priceRange = number_format($tenant->priceRange, 0, ',', '.');
    
        // Pesan WhatsApp yang lebih detail
        $message = "Maaf , pendaftaran tenant Anda telah ditolak!\n\n"
                 . "Detail Tenant\n\n"
                 . "Nama Pemilik Tenant: {$pemilik}\n"
                 . "Nama Tenant: {$name}\n"
                 . "Nama Brand: {$brand}\n"
                 . "Alamat: {$alamat}\n"
                 . "Jenis Makanan: {$kategori}\n"
                 . "Kisaran Harga: Rp. {$priceRange}\n\n"
                 . "Terimakasih telah mendaftar.";

    // URL WhatsApp menggunakan deep link
    $whatsappLink = "https://wa.me/{$phone}?text=" . urlencode($message);


    // Redirect ke link WhatsApp dan tampilkan pesan sukses
    return Redirect::to($whatsappLink)->with('success', 'Pendaftaran ditolak!');
}
    // public function downloadPdf($id)
    // {
    //     // Cari tenant berdasarkan ID
    //     $tenant = PendaftaranTenant::find($id);
        
    //     // dd($tenant);
    //     // Jika tenant atau file tidak ditemukan, kembalikan pesan error
    //     if (!$tenant || !$tenant->fileimage || !Storage::disk('public')->exists($tenant->fileimage)) {
    //         return redirect()->back()->with('loginError', 'File tidak ditemukan.');
    //     }

    //     // Buat view khusus untuk PDF dan berikan data tenant
    //     $pdf = PDF::loadView('pdf.tenant_details', ['tenant' => $tenant]);
        

    //     // Tentukan nama file PDF dan tambahkan file tenant dari storage
    //     $pdfFileName = 'Tenant_' . $tenant->name . '.pdf';

    //     // Buat PDF dan lampirkan file tenant
    //     return $pdf->stream($pdfFileName);
    // }
    public function downloadPdf($id)
{
    // Cari tenant berdasarkan ID
    $tenant = PendaftaranTenant::find($id);

    // Jika tenant atau file tidak ditemukan, kembalikan pesan error
    if (!$tenant || !$tenant->fileimage || !Storage::disk('public')->exists($tenant->fileimage)) {
        return redirect()->back()->with('loginError', 'File tidak ditemukan.');
    }

    // Cek ekstensi file
    $filePath = storage_path('app/public/' . $tenant->fileimage);
    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

    // Tentukan apakah file adalah gambar atau PDF
    $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']);
    $isPdf = strtolower($fileExtension) === 'pdf';

    // Buat view khusus untuk PDF dan berikan data tenant serta jenis file
    $pdf = PDF::loadView('pdf.tenant_details', [
        'tenant' => $tenant,
        'filePath' => $filePath,
        'isImage' => $isImage,
        'isPdf' => $isPdf,
    ]);

    // Tentukan nama file PDF
    $pdfFileName = 'Tenant_' . $tenant->name . '.pdf';

    // Buat PDF dan lampirkan file tenant
    return $pdf->stream($pdfFileName);
}

}
