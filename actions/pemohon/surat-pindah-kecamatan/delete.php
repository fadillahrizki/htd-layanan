<?php

$table = 'surat_pindah_kecamatan';
$conn = conn();
$db   = new Database($conn);

if(file_exists('../actions/'.$table.'/before-delete.php'))
    require '../actions/'.$table.'/before-delete.php';

$db->delete($table,[
    'id' => $_GET['id']
]);

if(file_exists('../actions/'.$table.'/after-delete.php'))
    require '../actions/'.$table.'/after-delete.php';

set_flash_msg(['success'=>$table.' berhasil dihapus']);
header('location:'.routeTo('pemohon/surat-pindah-kecamatan/index',['table'=>$table]));
die();