<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Edit <?=_ucwords($table)?></h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data <?=_ucwords($table)?></h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="<?=routeTo('pemohon/dispensasi-nikah/index',['table'=>$table])?>" class="btn btn-warning btn-round">Kembali</a>
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

                            <h4>Pemohon</h4>
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
                                if($label == "User" || $label == "Nama Layanan"){
                                    continue;
                                }
                            ?>
                            <div class="form-group">
                                <label for=""><?=$label?></label>
                                <?= Form::input($type, "pemohon[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$pemohon->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-12">
                        <div class="card card-body">

                            <h4>Data Mempelai Pria</h4>
                            <?php 
                            foreach(config('fields')['data_mempelai'] as $key => $field): 
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
                                <?= Form::input($type, "data_mempelai_pria[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$pria->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-12">
                        <div class="card card-body">

                            <h4>Data Mempelai Wanita</h4>
                            <?php 
                            foreach(config('fields')['data_mempelai'] as $key => $field): 
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
                                <?= Form::input($type, "data_mempelai_wanita[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$wanita->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-12">
                        <div class="card card-body">

                            <h4>Data Ayah Mempelai Pria</h4>
                            <?php 
                            foreach(config('fields')['data_ayah'] as $key => $field): 
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
                                <?= Form::input($type, "data_ayah_mempelai_pria[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$ayah_pria->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-12">
                        <div class="card card-body">

                            <h4>Data Ibu Mempelai Pria</h4>
                            <?php 
                            foreach(config('fields')['data_ibu'] as $key => $field): 
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
                                <?= Form::input($type, "data_ibu_mempelai_pria[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$ibu_pria->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-12">
                        <div class="card card-body">

                            <h4>Data Ayah Mempelai Wanita</h4>
                            <?php 
                            foreach(config('fields')['data_ayah'] as $key => $field): 
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
                                <?= Form::input($type, "data_ayah_mempelai_wanita[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$ayah_wanita->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-12">
                        <div class="card card-body">

                            <h4>Data Ibu Mempelai Wanita</h4>
                            <?php 
                            foreach(config('fields')['data_ibu'] as $key => $field): 
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
                                <?= Form::input($type, "data_ibu_mempelai_wanita[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$ibu_wanita->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Berkas Persyaratan</h4>
                                <div class="form-group">
                                    <label for="">Surat Pengantar dari Desa</label>
                                    <input type="file" name="surat_pengantar_dari_desa" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">KK Mempelai Pria</label>
                                    <input type="file" name="kk_mempelai_pria" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">KTP Mempelai Pria</label>
                                    <input type="file" name="ktp_mempelai_pria" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Pas Foto Mempelai Pria</label>
                                    <input type="file" name="pas_foto_mempelai_pria" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">KK Mempelai Wanita</label>
                                    <input type="file" name="kk_mempelai_wanita" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">KTP Mempelai Wanita</label>
                                    <input type="file" name="ktp_mempelai_wanita" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Pas Foto Mempelai Wanita</label>
                                    <input type="file" name="pas_foto_mempelai_wanita" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Surat Pernyataan Belum Menikah</label>
                                    <input type="file" name="surat_pernyataan_belum_menikah" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Akte Cerai Suami / Istri</label>
                                    <input type="file" name="akte_cerai_suami_istri" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Surat Kematian Suami / Istri</label>
                                    <input type="file" name="surat_kematian_suami_istri" class="form-control">
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