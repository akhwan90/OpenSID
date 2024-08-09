<?php 
class Surat_masuk_suratku_model extends CI_Model {
    // Konfigurasi untuk library 'upload'
    protected $uploadConfig = array();

    public function __construct() {
        parent::__construct();
        $this->uri_suratku = config_item('suratku_base_uri');
        $this->suratku_api = config_item('suratku');
    }

    public function get_dashboard($username) {
        
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
        ];

        $ch = curl_init($this->uri_suratku.'get_dashboard');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode != 200) {
            return false;
        } else {
            return json_decode($response, true);
        }
        return false;
    }

    public function get_list_surat_masuk($username, $tahun) {
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
        ];

        $url = $this->suratku_api[$tahun]['surat_masuk'];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        

        if ($httpcode != 200) {
            return $response;
        } else {
            return json_decode($response, true);
        }
    }

    public function get_list_surat_masuk_detil($username, $params, $tahun) {
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
            'id_surat'=>$params['id_surat'],
            'penerima_id_instansi'=>$params['penerima_id_instansi'],
            'penerima_id_user'=>$params['penerima_id_user'],
            'is_tembusan'=>$params['is_tembusan'],
        ];

        $url = $this->suratku_api[$tahun]['detil_surat'];


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode != 200) {
            return false;
        } else {
            return json_decode($response, true);
        }
    }

    public function set_status_baca($username, $params, $tahun) {
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
            'id_surat'=>$params['id_surat'],
            'penerima_id_instansi'=>$params['penerima_id_instansi'],
            'penerima_id_user'=>$params['penerima_id_user'],
            'is_tembusan'=>$params['is_tembusan'],
        ];

        $url = $this->suratku_api[$tahun]['status_baca'];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode != 200) {
            return $response;
        } else {
            return json_decode($response, true);
        }
    }

    public function set_status_berinomor($username, $params, $tahun="") {
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
            'id_surat'=>$params['id_surat'],
            'penerima_id_instansi'=>$params['penerima_id_instansi'],
            'penerima_id_user'=>$params['penerima_id_user'],
            'is_tembusan'=>$params['is_tembusan'],
        ];

        $url = $this->suratku_api[$tahun]['status_berinomor'];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode != 200) {
            return false;
        } else {
            return json_decode($response, true);
        }
    }

    public function get_list_opd($username, $tahun)
    {
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
        ];

        $url = $this->suratku_api[$tahun]['list_opd'];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode != 200) {
            return $response;
        } else {
            return json_decode($response, true);
        }
    }

    public function kirim_surat($username, $tahun, $data)
    {
        $post = [
            'username' => $username,
            'password' => $username,
        ];

        $post = array_merge($post, $data);
        if (is_file('./desa/upload/surat_keluar/'.$data['berkas_scan'])) {
            $file_surat_keluar = './desa/upload/surat_keluar/' . $data['berkas_scan'];
            $post['filenya'] = new CURLFile($file_surat_keluar);
        }

        $url = $this->suratku_api[$tahun]['send_surat'];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 30);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        return [
            'status'=>$httpcode,
            'response'=>json_decode($response),
            'error'=>$curl_error
        ];
    }

    public function insert()
    {
        // Ambil semua data dari var. global $_POST
        $data = $this->input->post(NULL);
        unset($data['mdl_detil_surat_id_surat']);
        unset($data['mdl_detil_surat_penerima_id_instansi']);
        unset($data['mdl_detil_surat_penerima_id_user']);
        unset($data['mdl_detil_surat_penerima_is_tembusan']);
        $data['isi_singkat'] = substr($data['isi_singkat'], 0, 196);

        // file_put_contents("Tmpfile.zip", fopen("http://someurl/file.zip", 'r'));

        // Berkas lampiran
        // $data['berkas_scan'] = ;

        // penerapan transcation karena insert ke 2 tabel
        $this->db->trans_start();

        // $indikatorSukses = is_null($uploadError) && $this->db->insert('surat_masuk', $data);
        $indikatorSukses = $this->db->insert('surat_masuk', $data);

        $insert_id = $this->db->insert_id();

        // insert ke tabel disposisi surat masuk
        // $this->insert_disposisi_surat_masuk($insert_id, $jabatan);

        // transaction selesai
        $this->db->trans_complete();

        // set status sudah diberi nomor..

        $ret = [
            'success' => $indikatorSukses,
            'message' => "Surat berhasil disimpan", 
        ];
        return $ret;

        // Set session berdasarkan hasil operasi
        // $_SESSION['success'] = $indikatorSukses ? 1 : -1;
        // $_SESSION['error_msg'] = $_SESSION['success'] === 1 ? NULL : ' -> '.$uploadError;
    }

    public function get_file($username, $tahun, $idSurat) {
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
        ];

        $url = $this->suratku_api[$tahun]['get_file_surat'].'/'.$idSurat;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($httpcode != 200) {
            log_message('error', "Error get file surat ".$url." : ".$httpcode);
            return false;
        } else {
            return $response;
        }
    }


    public function get_file_lampiran($username, $tahun, $idSurat, $idLampiran) {
        // set post fields
        $post = [
            'username' => $username,
            'password' => $username,
        ];

        $url = $this->suratku_api[$tahun]['get_file_surat_lampiran'].'/'.$idSurat.'/'.$idLampiran;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
// 

        if ($httpcode != 200) {
            log_message('error', "Error get file surat lampiran" . $url . " : " . $httpcode);
            return false;
        } else {
            return $response;
        }
    }
}
