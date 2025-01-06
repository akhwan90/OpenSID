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
                    <u>SURAT KETERANGAN BEDA IDENTITAS</u>
                    <br />
                    Nomor : <?= $data['no_surat'] ?>
                </h4>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="2">Yang bertanda tangan dibawah ini menerangkan dengan sebenarnya bahwa:</td>
        </tr>
        <tr>
            <td width="2%">I.</td>
            <td width="98%">Identitas Yang Terdaftar di Kependudukan</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table width="100%">
                    <tr>
                        <td width="30%">Nama Lengkap</td>
                        <td width="2%">:</td>
                        <td width="68%"><?= unpenetration($data['nama']) ?></td>
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
                        <td style="vertical-align: top">RT. <?= $data['no_rt'] ?>, RW. <?= $data['no_rw'] ?>, Padukuhan <?= ununderscore(unpenetration($data['alamat_sekarang'])) ?>, <?= ucwords($this->setting->sebutan_desa) ?> <?= unpenetration($desa['nama_desa']) ?>, <?= ucwords($this->setting->sebutan_kecamatan_singkat) ?> <?= strtoupper(unpenetration($desa['nama_kecamatan'])) ?>, <?= ucwords($this->setting->sebutan_kabupaten_singkat) ?> <?= unpenetration($desa['nama_kabupaten']) ?></td>
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
        <?php if (!empty($log_surat_detil['kartu1'])) : ?>
            <tr>
                <td width="2%">II.</td>
                <td width="98%">Identitas dalam <?= $log_surat_detil['kartu1']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="30%">Nama Lengkap</td>
                            <td width="2%">:</td>
                            <td width="68%"><?= unpenetration($log_surat_detil['perbedaan1']) ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $data['nik'] ?></td>
                        </tr>
                        <tr>
                            <td>Tempat dan Tgl. Lahir </td>
                            <td>:</td>
                            <td><?= ($log_surat_detil['tempatlahir1']) ?>, <?= tgl_indo($log_surat_detil['tanggallahir1']) ?> </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top">Alamat</td>
                            <td style="vertical-align: top">:</td>
                            <td style="vertical-align: top">RT. <?= $data['no_rt'] ?>, RW. <?= $data['no_rw'] ?>, Padukuhan <?= ununderscore(unpenetration($data['alamat_sekarang'])) ?>, <?= ucwords($this->setting->sebutan_desa) ?> <?= unpenetration($desa['nama_desa']) ?>, <?= ucwords($this->setting->sebutan_kecamatan_singkat) ?> <?= strtoupper(unpenetration($desa['nama_kecamatan'])) ?>, <?= ucwords($this->setting->sebutan_kabupaten_singkat) ?> <?= unpenetration($desa['nama_kabupaten']) ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php endif ?>
        <?php if (!empty($log_surat_detil['kartu2'])) : ?>
            <tr>
                <td width="2%">III.</td>
                <td width="98%">Identitas dalam <?= $log_surat_detil['kartu2']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="30%">Nama Lengkap</td>
                            <td width="2%">:</td>
                            <td width="68%"><?= unpenetration($log_surat_detil['perbedaan2']) ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $data['nik'] ?></td>
                        </tr>
                        <tr>
                            <td>Tempat dan Tgl. Lahir </td>
                            <td>:</td>
                            <td><?= ($log_surat_detil['tempatlahir2']) ?>, <?= tgl_indo($log_surat_detil['tanggallahir2']) ?> </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top">Alamat</td>
                            <td style="vertical-align: top">:</td>
                            <td style="vertical-align: top">RT. <?= $data['no_rt'] ?>, RW. <?= $data['no_rw'] ?>, Padukuhan <?= ununderscore(unpenetration($data['alamat_sekarang'])) ?>, <?= ucwords($this->setting->sebutan_desa) ?> <?= unpenetration($desa['nama_desa']) ?>, <?= ucwords($this->setting->sebutan_kecamatan_singkat) ?> <?= strtoupper(unpenetration($desa['nama_kecamatan'])) ?>, <?= ucwords($this->setting->sebutan_kabupaten_singkat) ?> <?= unpenetration($desa['nama_kabupaten']) ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php endif ?>
        <?php if (!empty($log_surat_detil['kartu3'])) : ?>
            <tr>
                <td width="2%">III.</td>
                <td width="98%">Identitas dalam <?= $log_surat_detil['kartu3']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="30%">Nama Lengkap</td>
                            <td width="2%">:</td>
                            <td width="68%"><?= unpenetration($log_surat_detil['perbedaan3']) ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?= $data['nik'] ?></td>
                        </tr>
                        <tr>
                            <td>Tempat dan Tgl. Lahir </td>
                            <td>:</td>
                            <td><?= ($log_surat_detil['tempatlahir3']) ?>, <?= tgl_indo($log_surat_detil['tanggallahir3']) ?> </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top">Alamat</td>
                            <td style="vertical-align: top">:</td>
                            <td style="vertical-align: top">RT. <?= $data['no_rt'] ?>, RW. <?= $data['no_rw'] ?>, Padukuhan <?= ununderscore(unpenetration($data['alamat_sekarang'])) ?>, <?= ucwords($this->setting->sebutan_desa) ?> <?= unpenetration($desa['nama_desa']) ?>, <?= ucwords($this->setting->sebutan_kecamatan_singkat) ?> <?= strtoupper(unpenetration($desa['nama_kecamatan'])) ?>, <?= ucwords($this->setting->sebutan_kabupaten_singkat) ?> <?= unpenetration($desa['nama_kabupaten']) ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php endif ?>
        <tr>
            <td colspan="2">
                Adalah benar-benar warga desa kami, adapun perbedaan identitas tersebut disebabkan karena
                <?php if (!empty($log_surat_detil['sebab3'])) {
                    echo $log_surat_detil['sebab1'] . ', ' . $log_surat_detil['sebab2'] . ', ' . $log_surat_detil['sebab3'];
                } elseif (!empty($log_surat_detil['sebab2'])) {
                    echo $log_surat_detil['sebab1'] . ', ' . $log_surat_detil['sebab2'];
                } else {
                    echo $log_surat_detil['sebab1'];
                } ?>
                namun kedua data tersebut menerangkan identitas orang yang sama.
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php include "./template-surat-kp/print/ttd.php"; ?>
            </td>
        </tr>
    </table>


</body>

</html>