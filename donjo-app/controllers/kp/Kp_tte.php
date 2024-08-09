<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 *  File ini:
 *
 * Controller untuk modul Surat Keluar
 *
 * donjo-app/controllers/Keluar.php
 *
 */
/*
 *  File ini bagian dari:
 *
 * OpenSID
 *
 * Sistem informasi desa sumber terbuka untuk memajukan desa
 *
 * Aplikasi dan source code ini dirilis berdasarkan lisensi GPL V3
 *
 * Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * Hak Cipta 2016 - 2020 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 *
 * Dengan ini diberikan izin, secara gratis, kepada siapa pun yang mendapatkan salinan
 * dari perangkat lunak ini dan file dokumentasi terkait ("Aplikasi Ini"), untuk diperlakukan
 * tanpa batasan, termasuk hak untuk menggunakan, menyalin, mengubah dan/atau mendistribusikan,
 * asal tunduk pada syarat berikut:
 *
 * Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam
 * setiap salinan atau bagian penting Aplikasi Ini. Barang siapa yang menghapus atau menghilangkan
 * pemberitahuan ini melanggar ketentuan lisensi Aplikasi Ini.
 *
 * PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, BAIK TERSURAT MAUPUN
 * TERSIRAT. PENULIS ATAU PEMEGANG HAK CIPTA SAMA SEKALI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU
 * KEWAJIBAN APAPUN ATAS PENGGUNAAN ATAU LAINNYA TERKAIT APLIKASI INI.
 *
 * @package	OpenSID
 * @author	Tim Pengembang OpenDesa
 * @copyright	Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * @copyright	Hak Cipta 2016 - 2020 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 * @license	http://www.gnu.org/licenses/gpl.html	GPL V3
 * @link 	https://github.com/OpenSID/OpenSID
 */

class Kp_tte extends Admin_Controller
{

	private $list_session = ['cari', 'tahun', 'bulan', 'jenis', 'nik'];

	public function __construct()
	{
		parent::__construct();
		$this->load->model('keluar_model');
		$this->load->model('surat_model');

		$this->load->helper('download');
		$this->load->helper('form');
		$this->load->model('pamong_model');
		$this->load->model('config_model');
		$this->modul_ini = 4;
		$this->sub_modul_ini = 332;
	}

	public function index()
	{
		$user_id = intval($this->session->userdata('user'));


		$get_pamong_id = $this->db
			->where('user_id', $user_id)
			->get('akp_user_pamong')->row();

		$penandatangan_id = $get_pamong_id->pamong_id;

		$get_data_surat_ditandatangani = $this->db
			->where('penandatangan_id', $penandatangan_id)
			->order_by('id', 'desc')
			->get('akp_surat_tte')->result_array();
		
		$data['main'] = $get_data_surat_ditandatangani;

			
		$data['list_data'] = [];
		$this->render('kp/surat/surat_keluar_tte', $data);
	}

	public function detil_surat($id_akp_surat_tte)
	{
		$detil_surat = $this->db
			->where('id', $id_akp_surat_tte)
			->get('akp_surat_tte')->row_array();

		// cek file 
		if (!empty($detil_surat)) {
			$ret = [
				'success'=>true,
				'filesurat' => base_url('index.php/kp_tte/lihat_file_surat/'.$detil_surat['id_log_surat']),
				'message'=>'OK',
			];
		} else {
			$ret = [
				'success'=>false,
				'message'=>'Surat tidak ditemukan'
			];
		}


		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($ret));
	}

	public function detil_surat_signed($id_akp_surat_tte)
	{
		$detil_surat = $this->db
		->where('id', $id_akp_surat_tte)
		->get('akp_surat_tte')->row_array();

		// cek file 
		if (!empty($detil_surat)) {
			$ret = [
				'success' => true,
				'filesurat' => base_url('index.php/kp_tte/lihat_file_surat/'.$detil_surat['id_log_surat']),
				'message' => 'OK',
			];
		} else {
			$ret = [
				'success' => false,
				'message' => 'Surat tidak ditemukan'
			];
		}


		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($ret));
	}

	public function tte_ok()
	{
		$p = $this->input->post();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('passphrase', 'Passphrase', 'required');
		$this->form_validation->set_rules('id_akp_surat_tte', 'ID Surat', 'required');

		if ($this->form_validation->run() == FALSE) {
			$ret = [
				'success' => false,
				'message' => validation_errors('', "\n"),
			];
		} else {
			$id_akp_surat_tte = intval($p['id_akp_surat_tte']);

			// get file 
			$get_file = $this->db 
				->where('id', $id_akp_surat_tte)
				->get('akp_surat_tte')->row();

			if (is_file('./desa/upload/dokumen/'.$get_file->file_surat)) {

				$file_surat = "./desa/upload/dokumen/".$get_file->file_surat;
				$img_ttd = "./assets/images/tte_stamp.png";

				$user_id_penandatangan = intval($this->session->userdata('user'));

				// get detil penandatangan 
				$get_detil_penandatangan = $this->db 
				->where('user_id', $user_id_penandatangan)
				->get('akp_user_pamong')->row();

				// get detil log surat
				$get_detil_log_surat = $this->db
				->where('id_log_surat', $get_file->id_log_surat)
				->get('akp_log_surat_detil')->row();

				$esign_username = $get_detil_penandatangan->esign_username;

				$post_data_field = [
					"nik" => $esign_username,
					"passphrase" => $p['passphrase'],
					"tampilan" => 'visible',
					"page" => 1,
					"image" => true,
					"xAxis" => -600,
					"yAxis" => 0,
					"width" => 1190,
					"height" => 50,
					"text" => '',
					"file"=>new CURLFile($file_surat, 'application/pdf', 'file'),
					"imageTTD"=>new CURLFile($img_ttd, 'image/png', 'imageTTD'),
				];

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, config_item('tte_uri'));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_MAXREDIRS, 30);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data_field);
				curl_setopt($ch, CURLOPT_USERPWD, config_item('tte_auth_userpass'));
				
				$result = curl_exec($ch);

				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

				if ($httpcode == 200) {
					$fp = fopen('./desa/upload/dokumen/signed_' . $get_file->file_surat, 'w');
					fwrite($fp, $result);
					fclose($fp);

					$this->db
						->where('id', $id_akp_surat_tte)
						->update('akp_surat_tte', [
							'is_ttd'=>1,
							'waktu_ttd'=>date('Y-m-d H:i:s'),
						]);
					
					$this->db
						->where('id_log_surat', $get_file->id_log_surat)
						->update('akp_log_surat_detil', [
							'is_ttd'=>1,
							'waktu_ttd'=>date('Y-m-d H:i:s'),
						]);

					if (intval($get_detil_log_surat->is_dari_layanan_mandiri) == 1) {
						$this->db
							->where('id', $get_detil_log_surat->id_permohonan_surat)
							->update('permohonan_surat', [
								'status'=>3
							]);
						log_message('error', $this->db->last_query());
					} else {
						log_message('error', 'TIDAK MENGUBAH STATUS PERMOHONAN'.json_encode($get_detil_log_surat));
					}

					$ret = [
						'success' => true,
						'message' => 'Berhasil ditandatangani..',
					];

					$result_text = 'Berhasil ditandatangani..';
				} else {
					$ret = [
						'success' => false,
						'message' => $result,
					];
					$result_text = $result;
				}

				$this->db->insert('akp_log_tte', [
					'username'=> $esign_username,
					'status'=> $httpcode,
					'status_keterangan'=>$result_text,
					'waktu'=>date('Y-m-d H:i:s'),
					'id_surat_tte'=> $id_akp_surat_tte
				]);

				curl_close($ch);
			} else {
				$ret = [
					'success' => false,
					'message' => 'Surat tidak ditemukan',
				];
			}


		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($ret));
	}

	

	public function lihat_file_surat($id_surat)
	{
		$get_file_surat = $this->db 
		->where('id_log_surat', $id_surat)
		->get('akp_surat_tte')->row();
		
		if (!empty($get_file_surat)) {
			if ($get_file_surat->is_ttd == 0) {
				if (is_file('./desa/upload/dokumen/' . $get_file_surat->file_surat)) {
					$content_file_surat = file_get_contents('./desa/upload/dokumen/' . $get_file_surat->file_surat);
					$this->output
					->set_content_type('application/pdf')
					->set_output($content_file_surat);
				}
			} else {
				if (is_file('./desa/upload/dokumen/signed_' . $get_file_surat->file_surat)) {
					$content_file_surat = file_get_contents('./desa/upload/dokumen/signed_' . $get_file_surat->file_surat);
					$this->output
						->set_content_type('application/pdf')
						->set_output($content_file_surat);
				}
			}
		}

		
	}
}
