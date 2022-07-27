<?php

$conn = conn();
$db   = new Database($conn);

$data = $db->single('users',[
    'id' => auth()->user->id
]);

$pemohon = $db->single('profile',[
    'user_id' => auth()->user->id
]);

$success_msg = get_flash_msg('success');

if(request() == 'POST')
{
    if(empty($_POST['users']['password']))
        $_POST['users']['password'] = $data->password;
    else
        $_POST['users']['password'] = md5($_POST['users']['password']);
    $db->update('users',$_POST['users'],[
        'id' => auth()->user->id
    ]);

    if($pemohon){
        $db->update('pemohon',$_POST['pemohon'],[
            'id'=>$pemohon->id
        ]);
    }else{
        $_POST['pemohon']['user_id'] = auth()->user->id;
        $db->insert('pemohon',$_POST['pemohon']);
    }

    set_flash_msg(['success'=>'Profil berhasil diupdate']);
    header('location:'.routeTo('default/profile'));
}

return compact('data','pemohon','success_msg');