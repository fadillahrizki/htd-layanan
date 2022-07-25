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
                        <a href="<?=routeTo('pemohon/surat-keterangan-bersih-diri/index',['table'=>$table])?>" class="btn btn-warning btn-round">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <form action="" method="post">
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
                                if($label == "User" || $label == "Nama Layanan" || $label == "Tanggal Pernikahan" || $label == "Saksi 1" || $label == "Saksi 2"){
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

                            <h4>Data Ayah</h4>
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
                                <?= Form::input($type, "data_ayah[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$ayah->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-12">
                        <div class="card card-body">

                            <h4>Data Ibu</h4>
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
                                <?= Form::input($type, "data_ibu[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$ibu->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-12">
                        <div class="card card-body">

                            <h4>Data Anak</h4>
                            <?php 
                            foreach(config('fields')['data_anak'] as $key => $field): 
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
                                <?= Form::input($type, "data_anak[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$anak->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
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