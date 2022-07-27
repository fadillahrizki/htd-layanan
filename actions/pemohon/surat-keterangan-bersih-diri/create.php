<?php

$table = 'surat_keterangan_bersih_diri';
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

    $KTP = $_FILES['KTP'];
    $KK = $_FILES['KK'];
    $surat_pengantar_dari_desa = $_FILES['surat_pengantar_dari_desa'];
    $target_dir = "uploads/surat-keterangan-bersih-diri/";

    $target_file_ktp = $target_dir . time() . "-KTP-" . basename($KTP["name"]);
    $target_file_kk = $target_dir . time() . "-KK-". basename($KK["name"]);
    $target_file_spdd = $target_dir . time() . "-SPDD-" . basename($surat_pengantar_dari_desa["name"]);

    if(
        move_uploaded_file($KTP["tmp_name"], $target_file_ktp) &&
        move_uploaded_file($KK["tmp_name"], $target_file_kk) &&
        move_uploaded_file($surat_pengantar_dari_desa["tmp_name"], $target_file_spdd)
    ){

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

        $_POST['KTP']['pemohon_id'] = $pemohon->id;
        $_POST['KTP']['tipe'] = "KTP";
        $_POST['KTP']['nama_file'] = $target_file_ktp;
        
        $_POST['KK']['pemohon_id'] = $pemohon->id;
        $_POST['KK']['tipe'] = "KK";
        $_POST['KK']['nama_file'] = $target_file_kk;

        $_POST['SURAT PENGANTAR DARI DESA']['pemohon_id'] = $pemohon->id;
        $_POST['SURAT PENGANTAR DARI DESA']['tipe'] = "SURAT PENGANTAR DARI DESA";
        $_POST['SURAT PENGANTAR DARI DESA']['nama_file'] = $target_file_spdd;

        $db->insert('berkas',$_POST['KTP']);
        $db->insert('berkas',$_POST['KK']);
        $db->insert('berkas',$_POST['SURAT PENGANTAR DARI DESA']);

        $_POST['data_ayah']['pemohon_id'] = $pemohon->id;
        $_POST['data_ibu']['pemohon_id'] = $pemohon->id;
        $_POST['data_anak']['pemohon_id'] = $pemohon->id;
        
        $ayah = $db->insert('data_ayah',$_POST['data_ayah']);
        $ibu = $db->insert('data_ibu',$_POST['data_ibu']);
        $anak = $db->insert('data_anak',$_POST['data_anak']);
        
        $_POST[$table]['pemohon_id'] = $pemohon->id;
        $_POST[$table]['data_ayah_id'] = $ayah->id;
        $_POST[$table]['data_ibu_id'] = $ibu->id;
        $_POST[$table]['data_anak_id'] = $anak->id;

        $insert = $db->insert($table,$_POST[$table]);
    }    

    if(file_exists('../actions/'.$table.'/after-insert.php'))
        require '../actions/'.$table.'/after-insert.php';

    set_flash_msg(['success'=>$table.' berhasil ditambahkan']);
    header('location:'.routeTo('pemohon/surat-keterangan-bersih-diri/index',['table'=>$table]));
}

return compact('user_pemohon','table','error_msg','old');