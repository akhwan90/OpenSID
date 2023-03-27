<html>

<head>
	<title>Print Surat Keterangan Domisili Usaha</title>
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
					<u>SURAT KETERANGAN DOMISILI USAHA</u>
					<br />
					Nomor : <?= $data['no_surat'] ?>
				</h4>
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td>
				<p>Yang bertanda tangan dibawah ini menerangkan dengan sebenarnya bahwa :</p>
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
				<td>NIK/ No. KTP</td>
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
				<td>Pekerjaan</td>
				<td>:</td>
				<td><?= $data['pekerjaan'] ?></td>
			</tr>
			<tr>
				<td>Pendidikan</td>
				<td>:</td>
				<td><?= $data['pendidikan'] ?></td>
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
			<td>Bahwa yang tersebut namanya diatas, memang benar penduduk kami yang memiliki usaha <?= $log_surat_detil['usaha'] ?>, berlokasi di Dusun <?= underscore(unpenetration($data['alamat_sekarang'])) ?>, RT. <?= $data['no_rt'] ?>, <?= unpenetration($data['alamat_sekarang']) ?>, <?= unpenetration($desa['nama_kecamatan']) ?>, <?= unpenetration($desa['nama_kabupaten']) ?>.</td>
		</tr>
	</table>

	<table>
		<tr>
			<td>Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</td>
		</tr>
	</table>

	<?php include "./template-surat-kp/print/ttd.php"; ?>

</body>

</html>