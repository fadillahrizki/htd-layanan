<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Edit <?=_ucwords($table)?> : <?=$data->nama??''?></h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data <?=_ucwords($table)?></h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <button class="btn btn-success mr-2 btn-round" onclick="printContent()">Cetak</button>
                        <a href="<?=routeTo('pemohon/ahli-waris/index',['table'=>$table])?>" class="btn btn-warning btn-round">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row row-card-no-pd print">
                    <div class="col-12">
                        <div class="card card-body">
                            <?php if($error_msg): ?>
                                <div class="alert alert-danger"><?=$error_msg?></div>
                            <?php endif ?>

                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Pemohon</h4>
                                <?php if($user_pemohon): ?>
                                <button type="button" class="btn btn-success" onclick="asPemohon()">Sebagai Pemohon</button>
                                <?php endif ?>
                            </div>

                            <?php 
                            foreach(config('fields')['pemohon'] as $key => $field): 
                                $label = $field;
                                $type  = "text";
                                if(is_array($field))
                                {
                                    $field_data = $field;
                                    $field = $key;
                                    $label = $field_data['label'];
                                    if(isset($field_data['type']))
                                    $type  = $field_data['type'];
                                }
                                $label = _ucwords($label);
                                if($label == "User" || $label == "Nama Layanan" || $label == "Tanggal Pernikahan" || $label == "Saksi 1" || $label == "Saksi 2"){
                                    continue;
                                }
                            ?>
                            <div class="form-group">
                                <label for=""><?=$label?></label>
                                <?= Form::input($type, "pemohon[$field]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$pemohon->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd print">
                    <div class="col-12">
                        <div class="card card-body">
                            <h4>Pewaris</h4>
                            <?php 
                            foreach(config('fields')['pewaris'] as $key => $field): 
                                $label = $field;
                                $type  = "text";
                                if(is_array($field))
                                {
                                    $field_data = $field;
                                    $field = $key;
                                    $label = $field_data['label'];
                                    if(isset($field_data['type']))
                                    $type  = $field_data['type'];
                                }
                                $label = _ucwords($label);
                                if($label == "Pemohon"){
                                    continue;
                                }
                            ?>
                            <div class="form-group">
                                <label for=""><?=$label?></label>
                                <?= Form::input($type, "pewaris[$field]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$pewaris->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd print">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Ahli Waris</h4>
                                    <!-- <button type="button" class="btn btn-success" onclick="addAhliWaris()">Tambah</button> -->
                                </div>
                                
                                <div id="ahli-waris">
                                    <div>
                                        <hr>

                                        <h5>Ahli Waris 1</h5>

                                        <?php
                                        foreach(config('fields')[$table] as $key => $field): 
                                            $label = $field;
                                            $type  = "text";
                                            if(is_array($field))
                                            {
                                                $field_data = $field;
                                                $field = $key;
                                                $label = $field_data['label'];
                                                if(isset($field_data['type']))
                                                $type  = $field_data['type'];
                                            }
                                            $label = _ucwords($label);
                                            if($label == "Pemohon"){
                                                continue;
                                            }
                                        ?>
                                        <div class="form-group">
                                            <label for=""><?=$label?></label>
                                            <?= Form::input($type, $table."[$field]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$data->{$field}]) ?>
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Berkas Persyaratan</h4>
                                <div class="form-group">
                                    <label for="">Surat Pernyataan Ahli Waris</label>
                                    <input type="file" name="surat_pernyataan_ahli_waris" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Surat Kuasa Ahli Waris</label>
                                    <input type="file" name="surat_kuasa_ahli_waris" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Surat Kematian dari Desa</label>
                                    <input type="file" name="surat_kematian_dari_desa" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">KK Pewaris</label>
                                    <input type="file" name="kk_pewaris" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">KTP Ahli Waris</label>
                                    <input type="file" name="ktp_ahli_waris" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-12">
                        <div class="card card-body">
                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>

<script>
    
    function asPemohon(){
        var user_pemohon = JSON.parse(JSON.stringify(<?=json_encode($user_pemohon)?>))

        var nama_lengkap = document.querySelector("[name='pemohon[nama_lengkap]']")
        var alamat = document.querySelector("[name='pemohon[alamat]']")
        var dusun = document.querySelector("[name='pemohon[dusun]']")
        var desa = document.querySelector("[name='pemohon[desa]']")
        var kecamatan = document.querySelector("[name='pemohon[kecamatan]']")
        var kode_pos = document.querySelector("[name='pemohon[kode_pos]']")
        var no_hp = document.querySelector("[name='pemohon[no_hp]']")
        var email = document.querySelector("[name='pemohon[email]']")
        var NIK = document.querySelector("[name='pemohon[NIK]']")
        var jenis_kelamin = document.querySelector("[name='pemohon[jenis_kelamin]']")
        var agama = document.querySelector("[name='pemohon[agama]']")
        var tempat_lahir = document.querySelector("[name='pemohon[tempat_lahir]']")
        var tanggal_lahir = document.querySelector("[name='pemohon[tanggal_lahir]']")
        var pekerjaan = document.querySelector("[name='pemohon[pekerjaan]']")
        var status = document.querySelector("[name='pemohon[status]']")

        nama_lengkap.value = user_pemohon.nama_lengkap
        alamat.value = user_pemohon.alamat
        dusun.value = user_pemohon.dusun
        desa.value = user_pemohon.desa
        kecamatan.value = user_pemohon.kecamatan
        kode_pos.value = user_pemohon.kode_pos
        no_hp.value = user_pemohon.no_hp
        email.value = user_pemohon.email
        NIK.value = user_pemohon.NIK
        jenis_kelamin.value = user_pemohon.jenis_kelamin
        agama.value = user_pemohon.agama
        tempat_lahir.value = user_pemohon.tempat_lahir
        tanggal_lahir.value = user_pemohon.tanggal_lahir
        pekerjaan.value = user_pemohon.pekerjaan
        status.value = user_pemohon.status
    }

    function printContent(){
        var win = window.open('','','left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status =0');
        var content = `<html>
                        <head>
                            <link rel="stylesheet" href="<?=asset('assets/css/bootstrap.min.css')?>">
                            <link rel="stylesheet" href="<?=asset('assets/css/atlantis.min.css')?>">
                        </head>`
        content += "<body onload=\"window.print(); window.close();\">";

        var contents = document.querySelectorAll(".print")
        contents.forEach(ctn=>{
            content += ctn.innerHTML ;
        })
        content += "</body>";
        content += "</html>";
        win.document.write(content);
        win.document.close();
    }
    
</script>