<html>

<head>
	<title>Print Surat Permohonan Akta Lahir</title>
	<link rel="stylesheet" href="<?= base_url() ?>template-surat-kp/print/print.css">
</head>

<body>
	<table>
		<tr>
			<td>
				<?php include "./template-surat-kp/print/kop.php"; ?>
			</td>
		</tr>
		<tr>
			<td>
				<h4 style="text-align: center">
					<u>SURAT PERMOHONAN AKTA LAHIR</u>
					<br />
					Nomor : <?= $data['no_surat'] ?>
				</h4>
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td>
				Yang bertanda tangan dibawah ini menerangkan dengan sebenarnya bahwa :
			</td>
		</tr>
	</table>
	<div class="menjorok_ke_dalam">
		<table width="100%">
			<tr>
				<td width="37%">Nama Lengkap</td>
				<td width="2%">:</td>
				<td width="61%"><?= unpenetration($data['nama']) ?></td>
			</tr>
			<tr>
				<td>Nomor KTP</td>
				<td>:</td>
				<td><?= $data['nik'] ?></td>
			</tr>
			<tr>
				<td>Tempat dan Tgl. Lahir </td>
				<td>:</td>
				<td><?= ($data['tempatlahir']) ?>, <?= tgl_indo($data['tanggallahir']) ?> </td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td><?= $data['sex'] ?></td>
			</tr>
			<tr>
				<td style="vertical-align: top">Alamat / Tempat Tinggal</td>
				<td style="vertical-align: top">:</td>
				<td style="vertical-align: top">RT. <?= $data['no_rt'] ?>, RW. <?= $data['no_rw'] ?>, Pedukuhan <?= underscore(unpenetration($data['alamat_sekarang'])) ?>, <?= ucwords($this->setting->sebutan_desa) ?> <?= unpenetration($desa['nama_desa']) ?>, <?= ucwords($this->setting->sebutan_kecamatan_singkat) ?> <?= strtoupper(unpenetration($desa['nama_kecamatan'])) ?>, <?= ucwords($this->setting->sebutan_kabupaten_singkat) ?> <?= unpenetration($desa['nama_kabupaten']) ?></td>
			</tr>
			<tr>
				<td>Agama</td>
				<td>:</td>
				<td><?= $data['agama'] ?></td>
			</tr>
			<tr>
				<td>Status</td>
				<td>:</td>
				<td><?= $data['status_kawin'] ?></td>
			</tr>
			<tr>
				<td>Pendidikan</td>
				<td>:</td>
				<td><?= $data['pendidikan'] ?></td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td>:</td>
				<td><?= $data['pekerjaan'] ?></td>
			</tr>
			<tr>
				<td>Kewarganegaraan </td>
				<td>:</td>
				<td><?= $data['warganegara'] ?></td>
			</tr>
		</table>
	</div>

	<table>
		<tr>
			<td>Mengajukan permohonan untuk diterbitkan penetapan Pengadilan Negeri sebagai persyaratan pencatatan peristiwa kelahiran dan penerbitan kutipan Akta Kelahiran atas nama :</td>
		</tr>
	</table>

	<div class="menjorok_ke_dalam">
		<table width="100%">
			<tr>
				<td width="37%">Nama</td>
				<td width="2%">:</td>
				<td width="61%"><?= $log_surat_detil['nama_anak'] ?></td>
			</tr>
			<tr>
				<td>Tempat dan Tgl. Lahir </td>
				<td>:</td>
				<td><?= ($log_surat_detil['tempatlahir_anak']) ?>, <?= tgl_indo($log_surat_detil['tanggallahir_anak']) ?> </td>
			</tr>
			<tr>
				<td>Hari Lahir</td>
				<td>:</td>
				<td><?= $log_surat_detil['harilahir_anak'] ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><?= $log_surat_detil['alamat_anak'] ?></td>
			</tr>
			<tr>
				<td>Nama Orang Tua</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Nama Ayah</td>
				<td>:</td>
				<td><?= $log_surat_detil['nama_ayah'] ?></td>
			</tr>
			<tr>
				<td>Nama Ibu</td>
				<td>:</td>
				<td><?= $log_surat_detil['nama_ibu'] ?></td>
			</tr>
			<tr>
				<td>Alamat Orang Tua </td>
				<td>:</td>
				<td><?= $log_surat_detil['nama_ortu'] ?></td>
			</tr>
		</table>
	</div>

	<table>
		<tr>
			<td>Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</td>
		</tr>
	</table>

	<?php include "./template-surat-kp/print/ttd.php"; ?>

</body>

</html>