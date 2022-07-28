<?php

$table = 'ahli_waris';
$conn = conn();
$db   = new Database($conn);

if(file_exists('../actions/'.$table.'/before-delete.php'))
    require '../actions/'.$table.'/before-delete.php';

$db->update($table,['status'=>'Disetujui'],[
    'id' => $_GET['id']
]);

if(file_exists('../actions/'.$table.'/after-delete.php'))
    require '../actions/'.$table.'/after-delete.php';

set_flash_msg(['success'=>$table.' berhasil disetujui']);
header('location:'.routeTo('pemohon/ahli-waris/index',['table'=>$table]));
die();