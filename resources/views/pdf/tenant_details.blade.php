<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Details</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f4f6f8;
            margin: 0;
            padding: 20px;
        }
        .content { 
            background-color: #fff;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            border-bottom: 2px solid #00aaff;
            padding-bottom: 10px;
        }
        .section {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
        .section:last-child {
            border-bottom: none;
        }
        .section strong {
            color: #555;
            font-weight: 600;
            width: 40%;
        }
        .section .value {
            color: #333;
            width: 60%;
            text-align: right;
        }
        .image-container, .pdf-container {
            margin-top: 20px;
            text-align: center;
        }
        .image-container img {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .pdf-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #00aaff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .pdf-container a:hover {
            background-color: #007acc;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Detail Tenant</h2>
        
        <div class="section">
            <strong>Nama Pemilik Tenant:</strong>
            <span class="value">{{ $tenant->pemilik }}</span>
        </div>
        
        <div class="section">
            <strong>Nama Tenant:</strong>
            <span class="value">{{ $tenant->name }}</span>
        </div>
        
        <div class="section">
            <strong>Brand:</strong>
            <span class="value">{{ $tenant->brand }}</span>
        </div>
        
        <div class="section">
            <strong>No. Telepon:</strong>
            <span class="value">{{ $tenant->phone }}</span>
        </div>
        
        <div class="section">
            <strong>Email:</strong>
            <span class="value">{{ $tenant->email }}</span>
        </div>
        
        <div class="section">
            <strong>Alamat:</strong>
            <span class="value">{{ $tenant->alamat }}</span>
        </div>
        
        <div class="section">
            <strong>Kisaran Harga:</strong>
            <span class="value">Rp. {{ number_format($tenant->priceRange, 0, ',', '.') }}</span>
        </div>
        
        <div class="section">
            <strong>Jenis Makanan:</strong>
            <span class="value">{{ $tenant->kategori ? $tenant->kategori->name : 'Tidak Diketahui' }}</span>
        </div>
        
        <div class="section">
            <strong>Status:</strong>
            <span class="value">{{ $tenant->status === 1 ? 'Sudah Verifikasi' : 'Belum Verifikasi' }}</span>
        </div>

        @if ($isImage)
            <div class="image-container">
                <h3>Gambar Tenant</h3>
                <img src="{{ $filePath }}" alt="Tenant Image">
            </div>
        @elseif ($isPdf)
            <div class="pdf-container">
                <h3>File Tenant</h3>
                <p>File tenant ini adalah PDF. Anda dapat mengunduhnya melalui tautan berikut:</p>
                <a href="{{ $filePath }}" target="_blank">Unduh PDF Tenant</a>
            </div>
        @else
            <p style="color: #999; text-align: center;">File tenant tidak dapat ditampilkan.</p>
        @endif
    </div>
</body>
</html>
