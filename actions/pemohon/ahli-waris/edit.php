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

    $target_dir = "uploads/ahli-waris/";

    if($_FILES['surat_pernyataan_ahli_waris']['size'] > 0){

        $spaw = $db->single('berkas',[
            'pemohon_id' => $data->pemohon_id,
            'tipe'=>'SURAT PERNYATAAN AHLI WARIS'
        ]);

        $surat_pernyataan_ahli_waris = $_FILES['surat_pernyataan_ahli_waris'];
        $target_file_surat_pernyataan_ahli_waris = $target_dir . time() . "-SPAW-" . basename($surat_pernyataan_ahli_waris["name"]);
        move_uploaded_file($surat_pernyataan_ahli_waris["tmp_name"], $target_file_surat_pernyataan_ahli_waris);
        
        $_POST['surat_pernyataan_ahli_waris']['nama_file'] = $target_file_surat_pernyataan_ahli_waris;

        $db->update('berkas',$_POST['surat_pernyataan_ahli_waris'],[
            'id'=>$spaw->id
        ]);
    }

    if($_FILES['surat_kuasa_ahli_waris']['size'] > 0){

        $skaw = $db->single('berkas',[
            'pemohon_id' => $data->pemohon_id,
            'tipe'=>'SURAT KUASA AHLI WARIS'
        ]);

        $surat_kuasa_ahli_waris = $_FILES['surat_kuasa_ahli_waris'];
        $target_file_surat_kuasa_ahli_waris = $target_dir . time() . "-SKAW-" . basename($surat_kuasa_ahli_waris["name"]);
        move_uploaded_file($surat_kuasa_ahli_waris["tmp_name"], $target_file_surat_kuasa_ahli_waris);
        
        $_POST['surat_kuasa_ahli_waris']['nama_file'] = $target_file_surat_kuasa_ahli_waris;

        $db->update('berkas',$_POST['surat_kuasa_ahli_waris'],[
            'id'=>$skaw->id
        ]);
    }

    if($_FILES['surat_kematian_dari_desa']['size'] > 0){

        $skdd = $db->single('berkas',[
            'pemohon_id' => $data->pemohon_id,
            'tipe'=>'SURAT KEMATIAN DARI DESA'
        ]);

        $surat_kematian_dari_desa = $_FILES['surat_kematian_dari_desa'];
        $target_file_surat_kematian_dari_desa = $target_dir . time() . "-SKDD-" . basename($surat_kematian_dari_desa["name"]);
        move_uploaded_file($surat_kematian_dari_desa["tmp_name"], $target_file_surat_kematian_dari_desa);
        
        $_POST['surat_kematian_dari_desa']['nama_file'] = $target_file_surat_kematian_dari_desa;

        $db->update('berkas',$_POST['surat_kematian_dari_desa'],[
            'id'=>$skdd->id
        ]);
    }

    if($_FILES['kk_pewaris']['size'] > 0){

        $kkp = $db->single('berkas',[
            'pemohon_id' => $data->pemohon_id,
            'tipe'=>'KK PEWARIS'
        ]);

        $kk_pewaris = $_FILES['kk_pewaris'];
        $target_file_kk_pewaris = $target_dir . time() . "-KKP-" . basename($kk_pewaris["name"]);
        move_uploaded_file($kk_pewaris["tmp_name"], $target_file_kk_pewaris);
        
        $_POST['kk_pewaris']['nama_file'] = $target_file_kk_pewaris;

        $db->update('berkas',$_POST['kk_pewaris'],[
            'id'=>$kkp->id
        ]);
    }

    if($_FILES['ktp_ahli_waris']['size'] > 0){

        $ktpaw = $db->single('berkas',[
            'pemohon_id' => $data->pemohon_id,
            'tipe'=>'KTP AHLI WARIS'
        ]);

        $ktp_ahli_waris = $_FILES['ktp_ahli_waris'];
        $target_file_ktp_ahli_waris = $target_dir . time() . "-KTPAW-" . basename($ktp_ahli_waris["name"]);
        move_uploaded_file($ktp_ahli_waris["tmp_name"], $target_file_ktp_ahli_waris);
        
        $_POST['ktp_ahli_waris']['nama_file'] = $target_file_ktp_ahli_waris;

        $db->update('berkas',$_POST['ktp_ahli_waris'],[
            'id'=>$ktpaw->id
        ]);
    }

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