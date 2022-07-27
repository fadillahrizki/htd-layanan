<?php

$table = 'surat_keterangan_pindah';
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

$user_pemohon = $db->single('profile',[
    'user_id'=>auth()->user->id
]);


if(request() == 'POST')
{
    if(file_exists('../actions/'.$table.'/before-edit.php'))
        require '../actions/'.$table.'/before-edit.php';

    $pemohon = $db->update('pemohon',$_POST['pemohon'],[
        'id'=>$pemohon->id
    ]);

    $edit = $db->update($table,$_POST[$table],[
        'id' => $_GET['id']
    ]);

    $target_dir = "uploads/surat-pindah-kecamatan/";

    if($_FILES['KTP']['size'] > 0){

        $ktp_db = $db->single('berkas',[
            'pemohon_id' => $data->pemohon_id,
            'tipe'=>'KTP'
        ]);

        $KTP = $_FILES['KTP'];
        $target_file_ktp = $target_dir . time() . "-KTP-" . basename($KTP["name"]);
        move_uploaded_file($KTP["tmp_name"], $target_file_ktp);

        $_POST['KTP']['nama_file'] = $target_file_ktp;

        $db->update('berkas',$_POST['KTP'],[
            'id'=>$ktp_db->id
        ]);
    }

    if($_FILES['KK']['size'] > 0){

        $kk_db = $db->single('berkas',[
            'pemohon_id' => $data->pemohon_id,
            'tipe'=>'KK'
        ]);

        $KK = $_FILES['KK'];
        $target_file_KK = $target_dir . time() . "-KK-" . basename($KK["name"]);
        move_uploaded_file($KK["tmp_name"], $target_file_KK);
        
        $_POST['KK']['nama_file'] = $target_file_KK;

        $db->update('berkas',$_POST['KK'],[
            'id'=>$kk_db->id
        ]);
    }
    
    if($_FILES['surat_pengantar_dari_desa']['size'] > 0){

        $spdd_db = $db->single('berkas',[
            'pemohon_id' => $data->pemohon_id,
            'tipe'=>'SURAT PENGANTAR DARI DESA'
        ]);

        $surat_pengantar_dari_desa = $_FILES['surat_pengantar_dari_desa'];
        $target_file_surat_pengantar_dari_desa = $target_dir . time() . "-SP-" . basename($surat_pengantar_dari_desa["name"]);
        move_uploaded_file($surat_pengantar_dari_desa["tmp_name"], $target_file_surat_pengantar_dari_desa);
        
        $_POST['SURAT PENGANTAR DARI DESA']['nama_file'] = $target_file_surat_pengantar_dari_desa;

        $db->update('berkas',$_POST['SURAT PENGANTAR DARI DESA'],[
            'id'=>$spdd_db->id
        ]);
    }

    if(file_exists('../actions/'.$table.'/after-edit.php'))
        require '../actions/'.$table.'/after-edit.php';

    set_flash_msg(['success'=>$table.' berhasil diupdate']);
    header('location:'.routeTo('pemohon/surat-pindah-kecamatan/index',['table'=>$table]));
}

return [
    'data' => $data,
    'user_pemohon' => $user_pemohon,
    'pemohon' => $pemohon,
    'error_msg' => $error_msg,
    'old' => $old,
    'table' => $table
];