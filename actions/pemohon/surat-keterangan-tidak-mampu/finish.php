<?php

$table = 'surat_keterangan_tidak_mampu';
$conn = conn();
$db   = new Database($conn);

if(file_exists('../actions/'.$table.'/before-delete.php'))
    require '../actions/'.$table.'/before-delete.php';

$db->update($table,['status'=>'Selesai'],[
    'id' => $_GET['id']
]);

if(file_exists('../actions/'.$table.'/after-delete.php'))
    require '../actions/'.$table.'/after-delete.php';

set_flash_msg(['success'=>$table.' telah selesai']);
header('location:'.routeTo('pemohon/surat-keterangan-tidak-mampu/index',['table'=>$table]));
die();