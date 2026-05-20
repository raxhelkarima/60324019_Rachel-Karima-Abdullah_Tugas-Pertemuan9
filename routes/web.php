<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\KategoriController;

// Route default
Route::get('/', function () {
    return view('welcome');
});

// Route baru - return text
Route::get('/hello', function () {
    return 'Hello dari Laravel!';
});

// Route dengan HTML
Route::get('/info', function () {
    return '<h1>Sistem Perpustakaan</h1><p>Selamat datang!</p>';
});

// Route dengan JSON
Route::get('/buku-json', function () {
    return [
        'judul' => 'Laravel Programming',
        'pengarang' => 'John Doe',
        'harga' => 150000
    ];
});

// Route dengan multiple parameters
Route::get('/search/{kategori}/{keyword}', function ($kategori, $keyword) {
    return "Cari buku kategori: $kategori dengan keyword: $keyword";
});

// Route menggunakan Controller
Route::get('/perpustakaan', [PerpustakaanController::class, 'index']);

Route::get('/buku/{id}', [PerpustakaanController::class, 'show']);

Route::get('/about', [PerpustakaanController::class, 'about']);

// Route test koneksi database
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        
        return "Koneksi database berhasil!<br />Database: <strong>{$dbName}</strong>";
    } catch (\Exception $e) {
        return "Koneksi database gagal!<br />Error: " . $e->getMessage();
    }
});

//route anggota
Route::get('/anggota', function () {

    $anggota_list = [
        [
            'id' => 1,
            'kode' => 'AGT-001',
            'nama' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'telepon' => '081234567890',
            'alamat' => 'Jakarta',
            'status' => 'Aktif'
        ],
        [
            'id' => 2,
            'kode' => 'AGT-002',
            'nama' => 'Siti Nurhaliza',
            'email' => 'siti@email.com',
            'telepon' => '081234567891',
            'alamat' => 'Bandung',
            'status' => 'Aktif'
        ],
        [
            'id' => 3,
            'kode' => 'AGT-003',
            'nama' => 'Ahmad Rizki',
            'email' => 'ahmad@email.com',
            'telepon' => '081234567892',
            'alamat' => 'Surabaya',
            'status' => 'Nonaktif'
        ],
        [
            'id' => 4,
            'kode' => 'AGT-004',
            'nama' => 'Dewi Lestari',
            'email' => 'dewi@email.com',
            'telepon' => '081234567893',
            'alamat' => 'Yogyakarta',
            'status' => 'Aktif'
        ],
        [
            'id' => 5,
            'kode' => 'AGT-005',
            'nama' => 'Rizky Febian',
            'email' => 'rizky@email.com',
            'telepon' => '081234567894',
            'alamat' => 'Semarang',
            'status' => 'Nonaktif'
        ],
    ];

    return view('anggota.index', compact('anggota_list'));
});

Route::get('/anggota/{id}', function ($id) {

    $anggota_list = [
        [
            'id' => 1,
            'kode' => 'AGT-001',
            'nama' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'telepon' => '081234567890',
            'alamat' => 'Jakarta',
            'status' => 'Aktif'
        ],
        [
            'id' => 2,
            'kode' => 'AGT-002',
            'nama' => 'Siti Nurhaliza',
            'email' => 'siti@email.com',
            'telepon' => '081234567891',
            'alamat' => 'Bandung',
            'status' => 'Aktif'
        ],
        [
            'id' => 3,
            'kode' => 'AGT-003',
            'nama' => 'Ahmad Rizki',
            'email' => 'ahmad@email.com',
            'telepon' => '081234567892',
            'alamat' => 'Surabaya',
            'status' => 'Nonaktif'
        ],
        [
            'id' => 4,
            'kode' => 'AGT-004',
            'nama' => 'Dewi Lestari',
            'email' => 'dewi@email.com',
            'telepon' => '081234567893',
            'alamat' => 'Yogyakarta',
            'status' => 'Aktif'
        ],
        [
            'id' => 5,
            'kode' => 'AGT-005',
            'nama' => 'Rizky Febian',
            'email' => 'rizky@email.com',
            'telepon' => '081234567894',
            'alamat' => 'Semarang',
            'status' => 'Nonaktif'
        ],
    ];

    $anggota = collect($anggota_list)->firstWhere('id', $id);

    return view('anggota.show', compact('anggota'));
});

// route kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

Route::get('/kategori/search/{keyword}', [KategoriController::class, 'search'])->name('kategori.search');

Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');