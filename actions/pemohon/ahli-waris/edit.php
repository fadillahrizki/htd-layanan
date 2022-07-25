<?php

$table = 'ahli_waris';
Page::set_title('Edit '.ucwords($table));
$conn = conn();
$db   = new Database($conn);
$error_msg = get_flash_msg('error');
$old = get_flash_msg('old');

$data = $db->single($table,[
    'id' => $_GET['id']
]);

$pemohon = $db->single('pemohon',[
    'id' => $data->pemohon_id
]);

$pewaris = $db->single('pewaris',[
    'pemohon_id' => $pemohon->id
]);

if(request() == 'POST')
{
    if(file_exists('../actions/'.$table.'/before-edit.php'))
        require '../actions/'.$table.'/before-edit.php';

    $pemohon = $db->update('pemohon',$_POST['pemohon'],[
        'id'=>$pemohon->id
    ]);

    $pewaris = $db->update('pewaris',$_POST['pewaris'],[
        'id'=>$pewaris->id
    ]);

    $edit = $db->update($table,$_POST[$table],[
        'id' => $_GET['id']
    ]);

    if(file_exists('../actions/'.$table.'/after-edit.php'))
        require '../actions/'.$table.'/after-edit.php';

    set_flash_msg(['success'=>$table.' berhasil diupdate']);
    header('location:'.routeTo('pemohon/ahli-waris/index',['table'=>$table]));
}

return [
    'data' => $data,
    'pemohon' => $pemohon,
    'pewaris' => $pewaris,
    'error_msg' => $error_msg,
    'old' => $old,
    'table' => $table
];