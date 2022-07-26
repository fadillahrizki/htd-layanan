<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-success-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold"><?=_ucwords($table)?></h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data <?=_ucwords($table)?></h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="<?=routeTo('pemohon/ahli-waris/create')?>" class="btn btn-secondary btn-round">Buat <?=_ucwords($table)?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if($success_msg): ?>
                            <div class="alert alert-success"><?=$success_msg?></div>
                            <?php endif ?>
                            <div class="table-responsive table-hover table-sales">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th width="20px">#</th>
                                            <?php 
                                            foreach(config('fields')[$table] as $field): 
                                                $label = $field;
                                                if(is_array($field))
                                                {
                                                    $label = $field['label'];
                                                }
                                                $label = _ucwords($label);
                                            ?>
                                            <th><?=$label?></th>
                                            <?php endforeach ?>
                                            <th>Status</th>
                                            <th class="text-right">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($datas as $index => $data): ?>
                                        <tr>
                                            <td>
                                                <?=$index+1?>
                                            </td>
                                            <?php 
                                            foreach(config('fields')[$table] as $key => $field): 
                                                $label = $field;
                                                if(is_array($field))
                                                {
                                                    $label = $field['label'];
                                                    $data_value = Form::getData($field['type'],$data->{$key});
                                                    $field = $key;
                                                }
                                                else
                                                {
                                                    $data_value = $data->{$field};
                                                }
                                                $label = _ucwords($label);
                                            ?>
                                            <td><?=$data_value?></td>
                                            <?php endforeach ?>
                                            <td><?=$data->status?></td>
                                            <td>
                                                <?php if((get_role(auth()->user->id)->name == 'pemohon' && $data->status == "pengajuan") || get_role(auth()->user->id)->name == 'administrator'): ?>
                                                <a href="<?=routeTo('pemohon/ahli-waris/edit',['id'=>$data->id])?>" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i> Lihat</a>
                                                <?php endif ?>
                                                <?php if($data->status == "pengajuan"):?>
                                                    <?php if(get_role(auth()->user->id)->name == 'pemohon'): ?>
                                                        <a href="<?=routeTo('pemohon/ahli-waris/delete',['id'=>$data->id])?>" onclick="if(confirm('apakah anda yakin akan menghapus data ini ?')){return true}else{return false}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                                                    <?php else : ?>
                                                        <a href="<?=routeTo('pemohon/ahli-waris/verify',['id'=>$data->id])?>" class="btn btn-sm btn-success" onclick="return confirm('Apa anda yakin ?')"><i class="fas fa-check"></i> Verifikasi</a>
                                                    <?php endif ?>
                                                <?php elseif($data->status == "Sudah Diverifikasi" && get_role(auth()->user->id)->name != 'pemohon'):?>
                                                    <a href="<?=routeTo('pemohon/ahli-waris/accept',['id'=>$data->id])?>" class="btn btn-sm btn-success" onclick="return confirm('Apa anda yakin ?')"><i class="fas fa-check"></i> Setuju</a>
                                                <?php elseif($data->status == "Disetujui" && get_role(auth()->user->id)->name != 'pemohon'):?>
                                                    <a href="<?=routeTo('pemohon/ahli-waris/finish',['id'=>$data->id])?>" class="btn btn-sm btn-success" onclick="return confirm('Apa anda yakin ?')"><i class="fas fa-check"></i> Selesai</a>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>