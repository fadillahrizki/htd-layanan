<?php

$success_msg = get_flash_msg('success');
$error_msg = get_flash_msg('error');

if(request() == 'POST')
{
    $conn  = conn();
    $db    = new Database($conn);

    $userFound = $db->single('users',[
        'username'=>$_POST['username']
    ]);

    if($userFound){
        set_flash_msg(['error'=>'Daftar Gagal! Nama Pengguna sudah terpakai']);
        header('location:'.routeTo('auth/register'));
        die();
    }

    $user = $db->insert('users',[
        'name' => $_POST['profile']['nama_lengkap'],
        'username' => $_POST['username'],
        'password' => md5($_POST['password']),
    ]);

    $_POST['profile']['user_id'] = $user->id;
    $profile = $db->insert('profile',$_POST['profile']);
    $role = $db->single('roles',['name'=>'pemohon']);
    $user_roles = $db->insert('user_roles',[
        'user_id'=>$user->id,
        'role_id'=>$role->id
    ]);
    
    if($user && $profile && $user_roles)
    {
        Session::set(['user_id'=>$user->id]);
        header('location:'.base_url());
        die();
    }

    set_flash_msg(['error'=>'Daftar Gagal!']);
    header('location:'.routeTo('auth/register'));
    die();
}

return [
    'success_msg' => $success_msg,
    'error_msg' => $error_msg,
];