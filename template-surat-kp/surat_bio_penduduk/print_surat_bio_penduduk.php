<html>

<head>
    <title>Print Surat Pengantar</title>
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
                    <u>SURAT KETERANGAN BIODATA PENDUDUK</u>
                    <br />
                    Nomor : <?= $data['no_surat'] ?>
                </h4>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="5%">I</td>
            <td width="95%">DATA KELUARGA</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table width="100%">
                    <tr>
                        <td width="40%">Nama Kepala Keluarga</td>
                        <td width="2%">:</td>
                        <td width="58%"><?= unpenetration($data_kk['nama_kepala_kk']); ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Kartu Keluarga</td>
                        <td>:</td>
                        <td><?= unpenetration($data_kk['no_kk']); ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Alamat Keluarga</td>
                        <td style="vertical-align: top">:</td>
                        <td style="vertical-align: top">Pedukuhan <?= unpenetration($data_kk['alamat_kk']); ?>, <?= ucwords($this->setting->sebutan_desa) ?> <?= unpenetration($desa['nama_desa']) ?>, <?= ucwords($this->setting->sebutan_kecamatan_singkat) ?> <?= strtoupper(unpenetration($desa['nama_kecamatan'])) ?>, <?= ucwords($this->setting->sebutan_kabupaten_singkat) ?> <?= unpenetration($desa['nama_kabupaten']) ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>II</td>
            <td>DATA INDIVIDU</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table width="100%">
                    <tr>
                        <td width="37%">Nama Lengkap</td>
                        <td width="2%">:</td>
                        <td width="61%"><?= unpenetration($data['nama']) ?></td>
                    </tr>
                    <tr>
                        <td>NIK</td>
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
            </td>
        </tr>
    </table>

    <?php include "./template-surat-kp/print/ttd.php"; ?>

</body>

</html>