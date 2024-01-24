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

class Kp_suratku_surat_keluar extends Admin_Controller
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
		$this->load->model('kp/surat_masuk_suratku_model', 'suratku_model');
		$this->load->model('klasifikasi_model');
		$this->load->model('surat_keluar_model');
		$this->modul_ini = 4;
		$this->sub_modul_ini = 335;

		$config = $this->config_model->get_data();
		$kode_desa = $config['kode_desa'];

		$this->username = $kode_desa;
	}

	public function index()
	{
		$user_id = intval($this->session->userdata('user'));
		$level = intval($this->session->userdata('grup'));
		
		$get_data_main = $this->db
			->where('surat_keluar.created_by', $this->session->userdata('user'))
			->or_group_start()
			->where('akp_surat_keluar_detil_surat.pemeriksa_id', $this->session->userdata('user'))
			->where('akp_surat_keluar_detil_surat.is_pemeriksa_setuju', 0)
			->group_end()
			->join('akp_surat_keluar_detil_surat', 'surat_keluar.id = akp_surat_keluar_detil_surat.id_surat_keluar');

		if ($level == 6) {
			$get_data_main->where('is_setuju_pembuat', 1)
			->where('is_pemeriksa_setuju', 0);
		}


		$data['main'] = $get_data_main
			->get('surat_keluar')
			->result_array();

		// echo $this->db->last_query();
		// exit;

		$this->render('kp/suratku/surat_keluar', $data);
	}

	public function add()
	{
		$config = $this->config_model->get_data();
		$kode_desa = $config['kode_desa'];
		$username = '003' . $kode_desa;
	
		$get_list_opd = $this->suratku_model->get_list_opd($username, 2022);
		$get_klasifikasi_surat = $this->klasifikasi_model->list_kode();


		$last_surat = $this->penomoran_surat_model->get_surat_terakhir('surat_keluar');
		$data['nomor_urut'] = $last_surat['no_surat'] + 1;

		$p_list_opd = [];
		$p_list_klasifikasi = [''=>'-'];
		if (!empty($get_list_opd['data'])) {
			foreach ($get_list_opd['data'] as $opd) {
				$username_pimpinan = $opd['nip_pimpinan_asli'];
				if (empty($opd['nip_pimpinan_asli'])) {
					$username_pimpinan = $opd['nip_plt'];
				}
				$idx = $opd['instansi_id']."-". $username_pimpinan . "--" . $opd['instansi_nama'];
				$p_list_opd[$idx] = $opd['instansi_nama'];
			}
		}

		if (!empty($get_klasifikasi_surat)) {
			foreach ($get_klasifikasi_surat as $klasifikasi) {
				$idx = $klasifikasi['kode'];
				$p_list_klasifikasi[$idx] = $klasifikasi['kode']." - ".$klasifikasi['nama'];
			}
		}

		$list_user_penandatangan = $this->db
			->where('id_grup', 6)
			->get('user')->result_array();


		$data['p_list_user_penandatangan'] = ['' => '-'];
		if (!empty($list_user_penandatangan)) {
			foreach ($list_user_penandatangan as $lup) {
				$idx = $lup['id'];
				$data['p_list_user_penandatangan'][$idx] = $lup['username'] . " - " . $lup['nama'];
			}
		}

		$data['main'] = [];
		$data['p_list_opd'] = $p_list_opd;
		$data['p_list_klasifikasi'] = $p_list_klasifikasi;

		$this->render('kp/suratku/surat_keluar_form', $data);
	}

	public function edit($id_surat_keluar)
	{
		$config = $this->config_model->get_data();
		$kode_desa = $config['kode_desa'];
		$username = '003' . $kode_desa;

		$get_list_opd = $this->suratku_model->get_list_opd($username, 2022);
		$get_klasifikasi_surat = $this->klasifikasi_model->list_kode();


		$last_surat = $this->penomoran_surat_model->get_surat_terakhir('surat_keluar');
		$data['nomor_urut'] = $last_surat['no_surat'] + 1;

		$p_list_opd = [];
		$p_list_klasifikasi = ['' => '-'];
		if (!empty($get_list_opd['data'])) {
			foreach ($get_list_opd['data'] as $opd) {
				$username_pimpinan = $opd['nip_pimpinan_asli'];
				if (empty($opd['nip_pimpinan_asli'])) {
					$username_pimpinan = $opd['nip_plt'];
				}
				$idx = $opd['instansi_id'] . "-" . $username_pimpinan;
				$p_list_opd[$idx] = $opd['instansi_nama'];
			}
		}

		if (!empty($get_klasifikasi_surat)) {
			foreach ($get_klasifikasi_surat as $klasifikasi) {
				$idx = $klasifikasi['kode'];
				$p_list_klasifikasi[$idx] = $klasifikasi['kode'] . " - " . $klasifikasi['nama'];
			}
		}

		$list_user_penandatangan = $this->db
		->where('id_grup', 6)
		->get('user')->result_array();


		$data['p_list_user_penandatangan'] = ['' => '-'];
		if (!empty($list_user_penandatangan)) {
			foreach ($list_user_penandatangan as $lup) {
				$idx = $lup['id'];
				$data['p_list_user_penandatangan'][$idx] = $lup['username'] . " - " . $lup['nama'];
			}
		}

		$data['main'] = [];
		$data['p_list_opd'] = $p_list_opd;
		$data['p_list_klasifikasi'] = $p_list_klasifikasi;

		$data['detil_surat_keluar'] = $this->db 
		->where('id', $id_surat_keluar)
		->get('surat_keluar')->row();


		$data['detil_surat_keluar_tujuan'] = $this->db
		->where('id_surat_keluar', $id_surat_keluar)
		->get('akp_surat_keluar_detil')->row();
		
		$data['detil_surat_keluar_pemeriksa'] = $this->db
		->where('id_surat_keluar', $id_surat_keluar)
		->get('akp_surat_keluar_detil_surat')->row();

		log_message('error', $this->db->last_query());

		// echo var_dump($data['detil_surat_keluar_tujuan']);
		// exit;

		$this->render('kp/suratku/surat_keluar_form_edit', $data);
	}

	public function insert()
	{
		
		$pdata = $this->input->post(NULL);
		$pdata['tanggal_surat'] = strip_tags($pdata['tanggal_surat']);
		// // Bersihkan data
		$pdata['nomor_surat'] = nomor_surat_keputusan(strip_tags($pdata['nomor_surat']));
		$pdata['isi_singkat'] = strip_tags($pdata['isi_singkat']);

		$this->load->helper('string');
		$this->load->library('upload');
		
		$uploadConfig = array(
			'upload_path' => './desa/upload/surat_keluar/',
			'allowed_types' => 'pdf',
			'max_size' =>2048,
			'encrypt_name'=>true,
		);

		if (count($pdata['opd_tujuan']) < 1) {
			$this->session->set_flashdata('info', '<div class="alert alert-danger">Pilih minimal 1 tujuan surat</div>');
			redirect('kp_suratku_surat_keluar/add');
		}

		$this->upload->initialize($uploadConfig);
		
		if ($this->upload->do_upload('satuan')) {
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];

			$this->db->trans_begin();
			$insert_data = [
				'nomor_urut' => $pdata['nomor_urut'],
				'nomor_surat' => $pdata['nomor_surat'],
				'kode_surat' => $pdata['kode_surat'],
				'tanggal_surat' => $pdata['tanggal_surat'],
				'tanggal_catat' => date('Y-m-d H:i:s'),
				'isi_singkat' => $pdata['isi_singkat'],
				'berkas_scan' => $file_name,
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->user,
				'updated_by' => $this->session->user,
			];
			$insert = $this->db->insert('surat_keluar', $insert_data);
			$insert_id = $this->db->insert_id();

			foreach ($pdata['opd_tujuan'] as $opd_tujuan) {
				$pc_opd_tujuan = explode("--", $opd_tujuan);

				if (count($pc_opd_tujuan) == 2) {
					$instansi_kode = $pc_opd_tujuan[0];
					$instansi_nama = $pc_opd_tujuan[1];

					$insert_detil = $this->db->insert('akp_surat_keluar_detil', [
						'id_surat_keluar' => $insert_id,
						'kode_tambahan' => $instansi_kode,
						'teks' => $instansi_nama,
					]);
				}

			}

			$insert_detil_surat = $this->db->insert('akp_surat_keluar_detil_surat', [
				'id_surat_keluar' => $insert_id,
				'pemeriksa_id' => $pdata['pemeriksa'],
				'is_setuju_pembuat' => 0,
				'is_pemeriksa_setuju' => 0,
				'is_kirim' => 0,
			]);

			if ($this->db->trans_status() === false) {
				$this->session->set_flashdata('info', '<div class="alert alert-danger">Terjadi kesalahan</div>');
				redirect('kp_suratku_surat_keluar/add');
			} else {
				$this->db->trans_commit();	
				redirect('kp_suratku_surat_keluar');
			}
		} else {
			$this->session->set_flashdata('info', '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>');
			redirect('kp_suratku_surat_keluar/add');
		}
	}

	public function update()
	{

		$pdata = $this->input->post(NULL);
		$pdata['tanggal_surat'] = strip_tags($pdata['tanggal_surat']);
		// // Bersihkan data
		$pdata['nomor_surat'] = nomor_surat_keputusan(strip_tags($pdata['nomor_surat']));
		$pdata['isi_singkat'] = strip_tags($pdata['isi_singkat']);

		$id_surat = intval($pdata['id_surat']);


		$this->load->helper('string');
		$this->load->library('upload');

		$uploadConfig = array(
			'upload_path' => './desa/upload/surat_keluar/',
			'allowed_types' => 'pdf',
			'max_size' => 2048,
			'encrypt_name' => true,
		);

		$insert_data = [
			'nomor_urut' => $pdata['nomor_urut'],
			'nomor_surat' => $pdata['nomor_surat'],
			'kode_surat' => $pdata['kode_surat'],
			'tanggal_surat' => $pdata['tanggal_surat'],
			'isi_singkat' => $pdata['isi_singkat'],
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => $this->session->user,
		];


		$this->upload->initialize($uploadConfig);

		if ($this->upload->do_upload('satuan')) {
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
			$insert_data['berkas_scan'] = $file_name;

			// hapus file lama 
			$get_file_lama = $this->db 
			->where('id', $id_surat)
			->get('surat_keluar')->row();

			@unlink('./desa/upload/surat_keluar/'.$get_file_lama->berkas_scan);

		}

		$this->db->trans_begin();
		$update = $this->db->where('id', $id_surat)->update('surat_keluar', $insert_data);


		// hapus data tujuan lama
		$this->db 
		->where('id_surat_keluar', $id_surat)
		->delete('akp_surat_keluar_detil'); 

		$insert_detil = $this->db->insert('akp_surat_keluar_detil', [
			'id_surat_keluar' => $id_surat,
			'kode_tambahan' => $pdata['opd_tujuan'],
			'teks' => 'OPD Suratku',
		]);

		$insert_detil_surat = $this->db
		->where('id_surat_keluar', $id_surat)
		->update('akp_surat_keluar_detil_surat', [
			'pemeriksa_id' => $pdata['pemeriksa'],
			'is_setuju_pembuat' => 0,
			'is_pemeriksa_setuju' => 0,
			'is_kirim' => 0,
		]);

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('info', '<div class="alert alert-danger">Terjadi kesalahan</div>');
			redirect('kp_suratku_surat_keluar/edit/'.$id_surat);
		} else {
			$this->db->trans_commit();
			redirect('kp_suratku_surat_keluar');
		}
	}


	public function update_db()
	{
		$satu = $this->db->query("ALTER TABLE `akp_surat_keluar_detil` ADD FOREIGN KEY (`id_surat_keluar`) REFERENCES `surat_keluar`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;");

	}

	public function to_pemeriksa($id_surat_keluar)
	{
		$this->db
			->where('id_surat_keluar', $id_surat_keluar)
			->update('akp_surat_keluar_detil_surat', [
				'is_setuju_pembuat'=>1,
				'tgl_setuju_pembuat'=>date('Y-m-d H:i:s')
			]);


		// echo $this->db->last_query();
		// exit;

		redirect('kp_suratku_surat_keluar');
	}

	public function detil_surat_keluar($id_surat_keluar)
	{
		$ret = $this->db 
		->where('id', $id_surat_keluar)
		->get('surat_keluar')->row();

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($ret));
	}
	
	public function pemeriksa_ok()
	{
		$p = $this->input->post();
		$id_surat_keluar = intval($p['mdl_detil_surat_id_surat_keluar']);

		$this->db
			->where('id_surat_keluar', $id_surat_keluar)
			->update('akp_surat_keluar_detil_surat', [
				'is_pemeriksa_setuju' => 1,
				'tgl_setuju' => date('Y-m-d H:i:s')
			]);

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode([
			'success'=>true,
			'message'=>'Berhasil disetujui',
		]));

	}

	public function kirim($id_surat_keluar)
	{
		// TODO 
		// Tambah aksi untuk kirim ke suratku 

		$username = $this->username;

		$get_detil_surat_keluar = $this->db 
		->where('id', $id_surat_keluar)
		->get('surat_keluar')->row();
		$file_surat = "";
		if (is_file('./desa/upload/surat_keluar/'.$get_detil_surat_keluar->berkas_scan)) {
			$file_surat = './desa/upload/surat_keluar/' . $get_detil_surat_keluar->berkas_scan;
		}

		if (!empty($file_surat)) {
			$get_tujuan_surat_keluar = $this->db 
				->where('id_surat_keluar', $id_surat_keluar)
				->get('akp_surat_keluar_detil')->result();

			$pdata = [
				'perihal' => $get_detil_surat_keluar->isi_singkat,
				// 'opd_tujuan' => $tujuan,
				'deskripsi' => $get_detil_surat_keluar->isi_singkat,
				'klasifikasi' => $get_detil_surat_keluar->kode_surat,
				'nomor_asal' => $get_detil_surat_keluar->nomor_surat,
				'tgl_asal' => $get_detil_surat_keluar->tanggal_surat,
				'sifat' => 'Biasa',
				'berkas_scan' => $get_detil_surat_keluar->berkas_scan
			];

			$no = 0;
			if (!empty($get_tujuan_surat_keluar)) {
				foreach ($get_tujuan_surat_keluar as $tujuan_surat) {
					$pecah_kode_instansi_tujuan = explode("-", $tujuan_surat->kode_tambahan);
					$pdata['opd_tujuan['.$no.']'] = $pecah_kode_instansi_tujuan[0]; 
					$no++;
				}
			}

			// echo json_encode($pdata);
			// exit;
			
			$send_to_suratku = $this->suratku_model->kirim_surat($username, date('Y'), $pdata);

			dd($send_to_suratku);
			
			if ($send_to_suratku) {
				$this->db
				->where('id_surat_keluar', $id_surat_keluar)
				->update('akp_surat_keluar_detil_surat', [
					'is_kirim'=>1,
					'tgl_kirim'=>date('Y-m-d H:i:s'),
					'id_surat_suratku'=>$send_to_suratku['id_surat'],
				]);

				$this->session->set_flashdata('notif', '<div class="alert alert-success" style="margin-top: 5px">'.$send_to_suratku['message'].'</div>');
				redirect('kp_suratku_surat_keluar');
			}
		
		}

		/* 
		$this->db
			->where('id_surat_keluar', $id_surat_keluar)
			->update('akp_surat_keluar_detil_surat', [
				'is_kirim' => 1,
				'tgl_kirim' => date('Y-m-d H:i:s')
			]);
 		*/

		// echo $this->db->last_query();
		// exit;

		// redirect('kp_suratku_surat_keluar');
	}

	public function detil($id_surat_keluar)
	{
		$detil_surat_keluar = $this->db 
		->where('id', $id_surat_keluar)
		->get('surat_keluar')->row();

		$detil_tujuan_surat = $this->db 
		->where('id_surat_keluar', $id_surat_keluar)
		->get('akp_surat_keluar_detil')->result();
		
		$detil_status_kirim = $this->db 
		->where('akp_surat_keluar_detil_surat.id_surat_keluar', $id_surat_keluar)
		->join('user', 'akp_surat_keluar_detil_surat.pemeriksa_id = user.id')
		->select(
			'
			akp_surat_keluar_detil_surat.*,
			user.nama AS nama_pemeriksa
			'
		)
		->get('akp_surat_keluar_detil_surat')->row();



		$data['main'] = [];
		$data['surat_keluar'] = $detil_surat_keluar;
		$data['detil_tujuan_surat'] = $detil_tujuan_surat;
		$data['detil_status_kirim'] = $detil_status_kirim;

		$this->render('kp/suratku/surat_keluar_detil', $data);
	}

	public function lihat_file_surat_keluar($id_surat_keluar)
	{
		$folder_surat = './desa/upload/surat_keluar/';

		$get_file_surat = $this->db 
		->where('id', $id_surat_keluar)
		->get('surat_keluar')->row();

		if (is_file($folder_surat.$get_file_surat->berkas_scan)) {
			$content_file_surat = file_get_contents($folder_surat . $get_file_surat->berkas_scan);
			$this->output
				->set_content_type('application/pdf')
				->set_output($content_file_surat);
		} else {
			echo "berkas tidak ditemukan";
		}
	}
}
