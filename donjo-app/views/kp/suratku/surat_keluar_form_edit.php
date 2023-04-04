<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Surat Keluar</h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('hom_sid') ?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Edit Surat Keluar</li>
        </ol>
    </section>
    <section class="content" id="maincontent">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        Edit Surat Keluar
                    </div>
                    <div class="box-body">
                        <?= $this->session->flashdata('info'); ?>
                        <?= form_open_multipart(site_url('kp_suratku_surat_keluar/update')); ?>
                        <?=form_hidden('id_surat', $detil_surat_keluar->id);?>
                        <div class="form-group">
                            <label for="">Nomor Urut</label>
                            <?= form_input('nomor_urut', $detil_surat_keluar->nomor_urut, 'class="form-control input-sm" required'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">File</label>
                            <div class="input-group input-group-sm col-sm-12">
                                <input type="text" class="form-control" id="file_path">
                                <input type="file" class="hidden" id="file" name="satuan">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" id="file_browser"><i class="fa fa-search"></i> Browse</button>
                                </span>
                            </div>
                            <p class="help-block text-red small">File wajib PDF, dengan ukuran kurang dari 1500 Kb. Kosongkan jika file tidak diubah</p>
                        </div>
                        <div class="form-group">
                            <label for="">Pilih OPD</label>
                            <?= form_dropdown('opd_tujuan', $p_list_opd, $detil_surat_keluar_tujuan->kode_tambahan, 'class="form-control select2" id="opd_tujuan" onchange="return getLabel()" required'); ?>
                            <input type="hidden" name="opd_tujuan_nama" value="" id="opd_tujuan_nama">
                        </div>
                        <div class="form-group">
                            <label for="">Klasifikasi Surat</label>
                            <?= form_dropdown('kode_surat', $p_list_klasifikasi, $detil_surat_keluar->kode_surat, 'class="form-control select2" required'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Pemeriksa</label>
                            <?= form_dropdown('pemeriksa', $p_list_user_penandatangan, $detil_surat_keluar_pemeriksa->pemeriksa_id, 'class="form-control select2" required'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Surat</label>
                            <?= form_input('nomor_surat', $detil_surat_keluar->nomor_surat, 'class="form-control input-sm" required'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Surat</label>
                            <input type="date" value="<?= $detil_surat_keluar->tanggal_surat;?>" name="tanggal_surat" class="form-control input-sm" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Perihal Surat</label>
                            <?= form_textarea('isi_singkat', $detil_surat_keluar->isi_singkat, 'class="form-control input-sm required" placeholder="Isi Singkat/Perihal" rows="2" style="resize:none; height: 50px !important"'); ?>
                        </div>
                        <div class='form-group'>
                            <!-- <button type='reset' class='btn btn-social btn-flat btn-danger btn-sm'><i class='fa fa-times'></i> Batal</button> -->
                            <button type='submit' class='btn btn-flat btn-info'><i class='fa fa-check'></i> Simpan</button>
                            <a href="<?= site_url('kp_suratku_surat_keluar'); ?>" class="btn btn-warning btn-flat"><i class="fa fa-arrow-left"></i> Batal</a>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('global/confirm_delete'); ?>


<script type="text/javascript">
    getLabel();

    function getLabel() {
        let isi = $("#opd_tujuan option:selected").text();
        $("#opd_tujuan_nama").val(isi);
    }
</script>