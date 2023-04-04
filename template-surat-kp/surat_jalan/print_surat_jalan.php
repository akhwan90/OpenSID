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
                    <u>SURAT KETERANGAN BEPERGIAN</u>
                    <br />
                    Nomor : <?= $data['no_surat'] ?>
                </h4>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                Yang bertanda tangan dibawah ini menerangkan dengan sebenarnya bahwa:
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td width="30%">Nama</td>
                        <td width="2%">:</td>
                        <td width="68%"><?= unpenetration($data['pamong']) ?></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><?= unpenetration($data['jabatan']) ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>dengan ini menerangkan bahwa :</td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td width="30%">Nama Lengkap</td>
                        <td width="2%">:</td>
                        <td width="68%"><?= unpenetration($data['nama']) ?></td>
                    </tr>
                    <tr>
                        <td>NIK / Nomor KTP</td>
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
                    <tr>
                        <td>Keterangan </td>
                        <td>:</td>
                        <td>Bahwa orang tersebut adalah benar-benar warga kami yang bertempat tinggal di RT. <?= $data['no_rt'] ?>, RW. <?= $data['no_rw'] ?>, Pedukuhan <?= underscore(unpenetration($data['alamat_sekarang'])) ?>, <?= ucwords($this->setting->sebutan_desa) ?> <?= unpenetration($desa['nama_desa']) ?>, <?= ucwords($this->setting->sebutan_kecamatan_singkat) ?> <?= strtoupper(unpenetration($desa['nama_kecamatan'])) ?>, <?= ucwords($this->setting->sebutan_kabupaten_singkat) ?> <?= unpenetration($desa['nama_kabupaten']) ?> tercatat dalam
                            No. KK: <?= $data_kk['no_kk'] ?> dengan NIK: <?= $data['nik'] ?>.</td>
                    </tr>
                    <tr>
                        <td>Keperluan </td>
                        <td>:</td>
                        <td><?= $log_surat_detil['keterangan'] ?></td>
                    </tr>
                    <tr>
                        <td>Berlaku mulai </td>
                        <td>:</td>
                        <td><?= tgl_indo(tgl_indo_in($log_surat_detil['berlaku_dari'])) ?> sampai dengan <?= tgl_indo(tgl_indo_in($log_surat_detil['berlaku_sampai'])) ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <br />
                            Demikian surat keterangan ini dibuat dengan sesungguhnya agar dapat dipergunakan sebagaimana mestinya.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <?php include "./template-surat-kp/print/ttd.php"; ?>

</body>

</html>