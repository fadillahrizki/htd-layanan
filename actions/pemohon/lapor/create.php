<?php

$table = 'lapor';
Page::set_title('Tambah '.ucwords($table));
$error_msg = get_flash_msg('error');
$old = get_flash_msg('old');

$conn = conn();
$db   = new Database($conn);

$user_pemohon = $db->single('profile',[
    'user_id'=>auth()->user->id
]);


if(request() == 'POST')
{

    if(file_exists('../actions/'.$table.'/before-insert.php'))
        require '../actions/'.$table.'/before-insert.php';
    
    $user = auth()->user;
    
    $role = $db->single('user_roles',[
        'user_id'=>$user->id
    ]);
    
    $role = $db->single('roles',[
        'id'=>$role->role_id
    ]);

    if($role->name == "pemohon"){
        $_POST['pemohon']['user_id'] = auth()->user->id;
    }

    $pemohon = $db->insert('pemohon',$_POST['pemohon']);

    $_POST[$table]['pemohon_id'] = $pemohon->id;

    $insert = $db->insert($table,$_POST[$table]);

    if(file_exists('../actions/'.$table.'/after-insert.php'))
        require '../actions/'.$table.'/after-insert.php';

    set_flash_msg(['success'=>$table.' berhasil ditambahkan']);
    header('location:'.routeTo('pemohon/lapor/index',['table'=>$table]));
}

return compact('user_pemohon','table','error_msg','old');