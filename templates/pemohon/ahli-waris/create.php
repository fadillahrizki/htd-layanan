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
                    <a href="<?=routeTo('pemohon/ahli-waris/index',['table'=>$table])?>" class="btn btn-warning btn-round">Kembali</a>
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
                                    <?= Form::input($type, "pemohon[$field]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??'']) ?>
                                </div>
                                <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
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
                                <?= Form::input($type, "pewaris[$field]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??'']) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="row row-card-no-pd">
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
                                            <?= Form::input($type, $table."[$field]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??'']) ?>
                                        </div>
                                        <?php endforeach ?>
                                    </div>
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

function addAhliWaris(){
    var length = document.querySelector("#ahli-waris").childElementCount
    let data = `<div>
                    <hr>
                    <h5>Ahli Waris ${length+1}</h5>

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
                        <?= Form::input($type, $table."[1][$field]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??'']) ?>
                    </div>
                    <?php endforeach ?>
                </div>`

    document.querySelector("#ahli-waris").innerHTML += data

    
}    

</script>