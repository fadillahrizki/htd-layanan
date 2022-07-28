<?php

$table = 'surat_keterangan_bersih_diri';
$conn = conn();
$db   = new Database($conn);

if(file_exists('../actions/'.$table.'/before-delete.php'))
    require '../actions/'.$table.'/before-delete.php';

$db->update($table,['status'=>'Sudah Diverifikasi'],[
    'id' => $_GET['id']
]);

if(file_exists('../actions/'.$table.'/after-delete.php'))
    require '../actions/'.$table.'/after-delete.php';

set_flash_msg(['success'=>$table.' berhasil diverifikasi']);
header('location:'.routeTo('pemohon/surat-keterangan-bersih-diri/index',['table'=>$table]));
die();