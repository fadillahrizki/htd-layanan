<?php

$table = 'ahli_waris';
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

    $surat_pernyataan_ahli_waris = $_FILES['surat_pernyataan_ahli_waris'];
    $surat_kuasa_ahli_waris = $_FILES['surat_kuasa_ahli_waris'];
    $surat_kematian_dari_desa = $_FILES['surat_kematian_dari_desa'];
    $kk_pewaris = $_FILES['kk_pewaris'];
    $ktp_ahli_waris = $_FILES['ktp_ahli_waris'];

    $target_dir = "uploads/ahli-waris/";

    $target_file_sp = $target_dir . time() . "-SPAW-" . basename($surat_pernyataan_ahli_waris["name"]);
    $target_file_sk = $target_dir . time() . "-SKAW-" . basename($surat_kuasa_ahli_waris["name"]);
    $target_file_skdd = $target_dir . time() . "-SKDD-" . basename($surat_kematian_dari_desa["name"]);
    $target_file_kk = $target_dir . time() . "-KKP-" . basename($kk_pewaris["name"]);
    $target_file_ktp = $target_dir . time() . "-KTPAW-" . basename($ktp_ahli_waris["name"]);

    if(
        move_uploaded_file($surat_pernyataan_ahli_waris["tmp_name"], $target_file_sp) &&
        move_uploaded_file($surat_kuasa_ahli_waris["tmp_name"], $target_file_sk) &&
        move_uploaded_file($surat_kematian_dari_desa["tmp_name"], $target_file_skdd) &&
        move_uploaded_file($kk_pewaris["tmp_name"], $target_file_kk) &&
        move_uploaded_file($ktp_ahli_waris["tmp_name"], $target_file_ktp)
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

        $_POST['surat_pernyataan_ahli_waris']['pemohon_id'] = $pemohon->id;
        $_POST['surat_pernyataan_ahli_waris']['tipe'] = "SURAT PERNYATAAN AHLI WARIS";
        $_POST['surat_pernyataan_ahli_waris']['nama_file'] = $target_file_sp;
        
        $_POST['surat_kuasa_ahli_waris']['pemohon_id'] = $pemohon->id;
        $_POST['surat_kuasa_ahli_waris']['tipe'] = "SURAT KUASA AHLI WARIS";
        $_POST['surat_kuasa_ahli_waris']['nama_file'] = $target_file_sk;

        $_POST['surat_kematian_dari_desa']['pemohon_id'] = $pemohon->id;
        $_POST['surat_kematian_dari_desa']['tipe'] = "SURAT KEMATIAN DARI DESA";
        $_POST['surat_kematian_dari_desa']['nama_file'] = $target_file_skdd;

        $_POST['kk_pewaris']['pemohon_id'] = $pemohon->id;
        $_POST['kk_pewaris']['tipe'] = "KK PEWARIS";
        $_POST['kk_pewaris']['nama_file'] = $target_file_kk;

        $_POST['ktp_ahli_waris']['pemohon_id'] = $pemohon->id;
        $_POST['ktp_ahli_waris']['tipe'] = "KTP AHLI WARIS";
        $_POST['ktp_ahli_waris']['nama_file'] = $ktp_ahli_waris;

        $db->insert('berkas',$_POST['surat_pernyataan_ahli_waris']);
        $db->insert('berkas',$_POST['surat_kuasa_ahli_waris']);
        $db->insert('berkas',$_POST['surat_kematian_dari_desa']);
        $db->insert('berkas',$_POST['kk_pewaris']);
        $db->insert('berkas',$_POST['ktp_ahli_waris']);

        $_POST['pewaris']['pemohon_id'] = $pemohon->id;
    
        $pewaris = $db->insert('pewaris',$_POST['pewaris']);

        $insert = $db->insert($table,$_POST[$table]);
    }
    
    if(file_exists('../actions/'.$table.'/after-insert.php'))
        require '../actions/'.$table.'/after-insert.php';

    set_flash_msg(['success'=>$table.' berhasil ditambahkan']);
    header('location:'.routeTo('pemohon/ahli-waris/index',['table'=>$table]));
}

return compact('user_pemohon','table','error_msg','old');