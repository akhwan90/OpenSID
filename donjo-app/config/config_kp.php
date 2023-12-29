<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Halaman Layanan Mandiri
// Auth
$route['layanan-mandiri-kp/masuk'] = 'kp/layanan_mandiri/masuk';
$route['layanan-mandiri-kp/cek'] = 'kp/layanan_mandiri/masuk/cek';
$route['layanan-mandiri-kp/masuk_ektp'] = 'kp/layanan_mandiri/masuk_ektp';
$route['layanan-mandiri-kp/cek_ektp'] = 'kp/layanan_mandiri/masuk_ektp/cek_ektp';
// Beranda
$route['layanan-mandiri-kp'] = 'kp/layanan_mandiri/beranda';
$route['layanan-mandiri-kp/pendapat/(:num)'] = 'kp/layanan_mandiri/beranda/pendapat/$1';
// Profil
$route['layanan-mandiri-kp/profil'] = 'kp/layanan_mandiri/beranda/profil';
$route['layanan-mandiri-kp/cetak-biodata'] = 'kp/layanan_mandiri/beranda/cetak_biodata';
$route['layanan-mandiri-kp/ganti-pin'] = 'kp/layanan_mandiri/beranda/ganti_pin';
$route['layanan-mandiri-kp/proses-ganti-pin'] = 'kp/layanan_mandiri/beranda/proses_ganti_pin';
$route['layanan-mandiri-kp/unduh-berkas/(:num)'] = 'kp/layanan_mandiri/beranda/unduh_berkas/$1';
$route['layanan-mandiri-kp/cetak-kk'] = 'kp/layanan_mandiri/beranda/cetak_kk';
$route['layanan-mandiri-kp/keluar'] = 'kp/layanan_mandiri/beranda/keluar';
// Pesan
$route['layanan-mandiri-kp/pesan-masuk'] = 'kp/layanan_mandiri/pesan/index/2';
$route['layanan-mandiri-kp/pesan-keluar'] = 'kp/layanan_mandiri/pesan/index/1';
$route['layanan-mandiri-kp/pesan/tulis'] = 'kp/layanan_mandiri/pesan/tulis';
$route['layanan-mandiri-kp/pesan/balas'] = 'kp/layanan_mandiri/pesan/tulis';
$route['layanan-mandiri-kp/pesan/kirim'] = 'kp/layanan_mandiri/pesan/kirim';
$route['layanan-mandiri-kp/pesan/baca/(:num)/(:num)'] = 'kp/layanan_mandiri/pesan/baca/$1/$2';
// Surat
$route['layanan-mandiri-kp/arsip-surat'] = 'kp/layanan_mandiri/surat/index/2';
$route['layanan-mandiri-kp/permohonan-surat'] = 'kp/layanan_mandiri/surat/index/1';
$route['layanan-mandiri-kp/surat/buat'] = 'kp/layanan_mandiri/surat/buat';
$route['layanan-mandiri-kp/surat/buat/(:num)'] = 'kp/layanan_mandiri/surat/buat/$1';
$route['layanan-mandiri-kp/surat/form'] = 'kp/layanan_mandiri/surat/form';
$route['layanan-mandiri-kp/surat/form/(:num)'] = 'kp/layanan_mandiri/surat/form/$1';
// Bantuan
$route['layanan-mandiri-kp/bantuan'] = 'kp/layanan_mandiri/bantuan';
$route['layanan-mandiri-kp/download-surat-tte/(:num)'] = 'kp/layanan_mandiri/surat/download_surat_tte/$1';


// tambahan kulon progo
$kp = ['kp_surat', 'kp_keluar', 'kp_tte', 'kp_setting_tte', 'kp_permohonan_surat_admin','kp_suratku_surat_masuk', 'kp_suratku_surat_keluar'];
foreach ($kp as $menu) {
	$route["{$menu}/([a-z_]+)/(:any)/(:any)/(:any)/(:any)"] = "kp/{$menu}/$1/$2/$3/$4/$5";
	$route["{$menu}/([a-z_]+)/(:any)/(:any)/(:any)"] = "kp/{$menu}/$1/$2/$3/$4";
	$route["{$menu}/([a-z_]+)/(:any)/(:any)"] = "kp/{$menu}/$1/$2/$3";
	$route["{$menu}/([a-z_]+)/(:any)"] = "kp/{$menu}/$1/$2";
	$route["{$menu}/([a-z_]+)"] = "kp/{$menu}/$1";
	$route["{$menu}"] = "kp/{$menu}";
}

//tambahan kulon progo (eb)
$buku_umum = ['ekspedisi', 'lembaran_desa', 'pengurus', 'surat_keluar', 'surat_masuk'];

foreach ($buku_umum as $menu) {
    $route["{$menu}/([a-z_]+)/(:any)/(:any)/(:any)"] = "kp/buku_umum/{$menu}/$1/$2/$3/$4";
    $route["{$menu}/([a-z_]+)/(:any)/(:any)"]        = "kp/buku_umum/{$menu}/$1/$2/$3";
    $route["{$menu}/([a-z_]+)/(:any)"]               = "kp/buku_umum/{$menu}/$1/$2";
    $route["{$menu}/([a-z_]+)"]                      = "kp/buku_umum/{$menu}/$1";
    $route["{$menu}"]                                = "kp/buku_umum/{$menu}";
}
