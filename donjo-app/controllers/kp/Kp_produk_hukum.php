<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kp_produk_hukum extends CI_Controller
{
    // public function index() {
    //     j(["success"=>true,"message"=>"API SID berjalan"]);
    // }

    public function index()
    {
        // $where = array('id' => $id);
        // $url = 'http://tawangsari-pengasih.desa.id/index.php/Api_perdes/get_perdes';
        $this->db->where_in('kategori', [2, 3]);
        $json_data = $this->db->get('dokumen')->result();
        $arr = array();
        foreach ($json_data as $result) {
            $j = json_decode($result->attr);
            $keterangan = $j->uraian;
            $no_ditetapkan = $j->no_ditetapkan;
            $tahun_ditetapkan = $j->tahun_ditetapkan;
            $id = $j->id;
            $arr[] = array(
                'file' => $result->satuan,
                'judul' => $result->nama,
                // 'kategori' => $result->kategori,
                'keterangan' => $keterangan,
                'no_ditetapkan' => $no_ditetapkan,
                'tahun_ditetapkan' => $tahun_ditetapkan,
                'url' => base_url('/desa/upload/dokumen/' . $file)
            );
        }
        $data = json_encode($arr);
        // echo $data;
        echo "{" . $data . "}";
        // echo "{\"perdes\":" . $data . "}";
    }
}
