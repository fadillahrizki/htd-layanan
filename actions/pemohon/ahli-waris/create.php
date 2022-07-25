<?php

$table = 'ahli_waris';
Page::set_title('Tambah '.ucwords($table));
$error_msg = get_flash_msg('error');
$old = get_flash_msg('old');

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    if(file_exists('../actions/'.$table.'/before-insert.php'))
        require '../actions/'.$table.'/before-insert.php';

    $pemohon = $db->insert('pemohon',$_POST['pemohon']);
    
    $_POST[$table]['pemohon_id'] = $pemohon->id;
    $_POST['pewaris']['pemohon_id'] = $pemohon->id;
    
    $pewaris = $db->insert('pewaris',$_POST['pewaris']);
    $insert = $db->insert($table,$_POST[$table]);

    if(file_exists('../actions/'.$table.'/after-insert.php'))
        require '../actions/'.$table.'/after-insert.php';

    set_flash_msg(['success'=>$table.' berhasil ditambahkan']);
    header('location:'.routeTo('pemohon/ahli-waris/index',['table'=>$table]));
}

return compact('table','error_msg','old');