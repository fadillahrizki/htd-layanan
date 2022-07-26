<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Buat <?=_ucwords($table)?> Baru</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data <?=_ucwords($table)?></h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                    <a href="<?=routeTo('pemohon/surat-pindah-kecamatan/index',['table'=>$table])?>" class="btn btn-warning btn-round">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row row-card-no-pd">
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
                                <?= Form::input($type, "pemohon[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??'']) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Surat Keterangan Pindah</h4>
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
                                    <?= Form::input($type, $table."[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??'']) ?>
                                </div>
                                <?php endforeach ?>
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
                                    <label for="">KTP</label>
                                    <input type="file" name="KTP" class="form-control" required>
                                </div>
                               <div class="form-group">
                                    <label for="">KK</label>
                                    <input type="file" name="KK" class="form-control" required>
                                </div>
                               <div class="form-group">
                                    <label for="">Surat Pengantar dari Desa</label>
                                    <input type="file" name="surat_pengantar_dari_desa" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
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

        var nama_lengkap = document.querySelector("input[name='pemohon[nama_lengkap]']")
        var hubungan_keluarga = document.querySelector("input[name='pemohon[hubungan_keluarga]']")
        var alamat = document.querySelector("input[name='pemohon[alamat]']")
        var dusun = document.querySelector("input[name='pemohon[dusun]']")
        var desa = document.querySelector("input[name='pemohon[desa]']")
        var kecamatan = document.querySelector("input[name='pemohon[kecamatan]']")
        var kode_pos = document.querySelector("input[name='pemohon[kode_pos]']")
        var no_hp = document.querySelector("input[name='pemohon[no_hp]']")

        nama_lengkap.value = user_pemohon.nama_lengkap
        hubungan_keluarga.value = user_pemohon.hubungan_keluarga
        alamat.value = user_pemohon.alamat
        dusun.value = user_pemohon.dusun
        desa.value = user_pemohon.desa
        kecamatan.value = user_pemohon.kecamatan
        kode_pos.value = user_pemohon.kode_pos
        no_hp.value = user_pemohon.no_hp
    }
</script>