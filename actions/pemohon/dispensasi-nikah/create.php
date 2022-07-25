<?php

$table = 'dispensasi_nikah';
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
    
    $_POST['data_mempelai_pria']['pemohon_id'] = $pemohon->id;
    $_POST['data_mempelai_wanita']['pemohon_id'] = $pemohon->id;

    $_POST['data_ayah_mempelai_pria']['pemohon_id'] = $pemohon->id;
    $_POST['data_ibu_mempelai_pria']['pemohon_id'] = $pemohon->id;

    $_POST['data_ayah_mempelai_wanita']['pemohon_id'] = $pemohon->id;
    $_POST['data_ibu_mempelai_wanita']['pemohon_id'] = $pemohon->id;
    
    $pria = $db->insert('data_mempelai',$_POST['data_mempelai_pria']);
    $wanita = $db->insert('data_mempelai',$_POST['data_mempelai_wanita']);
    
    $ayah_pria = $db->insert('data_ayah',$_POST['data_ayah_mempelai_pria']);
    $ibu_pria = $db->insert('data_ibu',$_POST['data_ibu_mempelai_pria']);
    
    $ayah_wanita = $db->insert('data_ayah',$_POST['data_ayah_mempelai_wanita']);
    $ibu_wanita = $db->insert('data_ibu',$_POST['data_ibu_mempelai_wanita']);
    
    $_POST[$table]['pemohon_id'] = $pemohon->id;

    $_POST[$table]['data_mempelai_pria_id'] = $pria->id;
    $_POST[$table]['data_mempelai_wanita_id'] = $wanita->id;

    $_POST[$table]['data_ayah_mempelai_pria_id'] = $ayah_pria->id;
    $_POST[$table]['data_ibu_mempelai_pria_id'] = $ibu_pria->id;
    
    $_POST[$table]['data_ayah_mempelai_wanita_id'] = $ayah_wanita->id;
    $_POST[$table]['data_ibu_mempelai_wanita_id'] = $ibu_wanita->id;

    $insert = $db->insert($table,$_POST[$table]);

    $target_dir = "uploads/dispensasi-nikah/";

    if($_FILES['surat_pengantar_dari_desa']['size'] > 0){

        $surat_pengantar_dari_desa = $_FILES['surat_pengantar_dari_desa'];
        $target_file_surat_pengantar_dari_desa = $target_dir . time() . "-SPDD-" . basename($surat_pengantar_dari_desa["name"]);
        move_uploaded_file($surat_pengantar_dari_desa["tmp_name"], $target_file_surat_pengantar_dari_desa);
        
        $_POST['surat_pengantar_dari_desa']['pemohon_id'] = $pemohon->id;
        $_POST['surat_pengantar_dari_desa']['tipe'] = 'SURAT PENGANTAR DARI DESA';
        $_POST['surat_pengantar_dari_desa']['nama_file'] = $target_file_surat_pengantar_dari_desa;

        $db->insert('berkas',$_POST['surat_pengantar_dari_desa']);
    }

    if($_FILES['kk_mempelai_pria']['size'] > 0){

        $kk_mempelai_pria = $_FILES['kk_mempelai_pria'];
        $target_file_kk_mempelai_pria = $target_dir . time() . "-KKMP-" . basename($kk_mempelai_pria["name"]);
        move_uploaded_file($kk_mempelai_pria["tmp_name"], $target_file_kk_mempelai_pria);
        
        $_POST['kk_mempelai_pria']['pemohon_id'] = $pemohon->id;
        $_POST['kk_mempelai_pria']['tipe'] = 'KK MEMPELAI PRIA';
        $_POST['kk_mempelai_pria']['nama_file'] = $target_file_kk_mempelai_pria;

        $db->insert('berkas',$_POST['kk_mempelai_pria']);
    }

    if($_FILES['ktp_mempelai_pria']['size'] > 0){

        $ktp_mempelai_pria = $_FILES['ktp_mempelai_pria'];
        $target_file_ktp_mempelai_pria = $target_dir . time() . "-KTPMP-" . basename($ktp_mempelai_pria["name"]);
        move_uploaded_file($ktp_mempelai_pria["tmp_name"], $target_file_ktp_mempelai_pria);
        
        $_POST['ktp_mempelai_pria']['pemohon_id'] = $pemohon->id;
        $_POST['ktp_mempelai_pria']['tipe'] = 'KTP MEMPELAI PRIA';
        $_POST['ktp_mempelai_pria']['nama_file'] = $target_file_ktp_mempelai_pria;

        $db->insert('berkas',$_POST['ktp_mempelai_pria']);
    }

    if($_FILES['pas_foto_mempelai_pria']['size'] > 0){

        $pas_foto_mempelai_pria = $_FILES['pas_foto_mempelai_pria'];
        $target_file_pas_foto_mempelai_pria = $target_dir . time() . "-PFMP-" . basename($pas_foto_mempelai_pria["name"]);
        move_uploaded_file($pas_foto_mempelai_pria["tmp_name"], $target_file_pas_foto_mempelai_pria);
        
        $_POST['pas_foto_mempelai_pria']['pemohon_id'] = $pemohon->id;
        $_POST['pas_foto_mempelai_pria']['tipe'] = 'PAS FOTO MEMPELAI PRIA';
        $_POST['pas_foto_mempelai_pria']['nama_file'] = $target_file_pas_foto_mempelai_pria;

        $db->insert('berkas',$_POST['pas_foto_mempelai_pria']);
    }

    if($_FILES['kk_mempelai_wanita']['size'] > 0){

        $kk_mempelai_WANITA = $_FILES['kk_mempelai_wanita'];
        $target_file_kk_mempelai_WANITA = $target_dir . time() . "-KKMW-" . basename($kk_mempelai_WANITA["name"]);
        move_uploaded_file($kk_mempelai_WANITA["tmp_name"], $target_file_kk_mempelai_WANITA);
        
        $_POST['kk_mempelai_wanita']['pemohon_id'] = $pemohon->id;
        $_POST['kk_mempelai_wanita']['tipe'] = 'KK MEMPELAI WANITA';
        $_POST['kk_mempelai_wanita']['nama_file'] = $target_file_kk_mempelai_WANITA;

        $db->insert('berkas',$_POST['kk_mempelai_wanita']);
    }

    if($_FILES['ktp_mempelai_wanita']['size'] > 0){

        $ktp_mempelai_WANITA = $_FILES['ktp_mempelai_wanita'];
        $target_file_ktp_mempelai_WANITA = $target_dir . time() . "-KTPMW-" . basename($ktp_mempelai_WANITA["name"]);
        move_uploaded_file($ktp_mempelai_WANITA["tmp_name"], $target_file_ktp_mempelai_WANITA);
        
        $_POST['ktp_mempelai_wanita']['pemohon_id'] = $pemohon->id;
        $_POST['ktp_mempelai_wanita']['tipe'] = 'KTP MEMPELAI WANITA';
        $_POST['ktp_mempelai_wanita']['nama_file'] = $target_file_ktp_mempelai_WANITA;

        $db->insert('berkas',$_POST['ktp_mempelai_wanita']);
    }

    if($_FILES['pas_foto_mempelai_wanita']['size'] > 0){

        $pas_foto_mempelai_WANITA = $_FILES['pas_foto_mempelai_wanita'];
        $target_file_pas_foto_mempelai_WANITA = $target_dir . time() . "-PFMW-" . basename($pas_foto_mempelai_WANITA["name"]);
        move_uploaded_file($pas_foto_mempelai_WANITA["tmp_name"], $target_file_pas_foto_mempelai_WANITA);
        
        $_POST['pas_foto_mempelai_wanita']['pemohon_id'] = $pemohon->id;
        $_POST['pas_foto_mempelai_wanita']['tipe'] = 'PAS FOTO MEMPELAI WANITA';
        $_POST['pas_foto_mempelai_wanita']['nama_file'] = $target_file_pas_foto_mempelai_WANITA;

        $db->insert('berkas',$_POST['pas_foto_mempelai_wanita']);
    }

    if($_FILES['surat_pernyataan_belum_menikah']['size'] > 0){

        $surat_pernyataan_belum_menikah = $_FILES['surat_pernyataan_belum_menikah'];
        $target_file_surat_pernyataan_belum_menikah = $target_dir . time() . "-SPBM-" . basename($surat_pernyataan_belum_menikah["name"]);
        move_uploaded_file($surat_pernyataan_belum_menikah["tmp_name"], $target_file_surat_pernyataan_belum_menikah);
        
        $_POST['surat_pernyataan_belum_menikah']['pemohon_id'] = $pemohon->id;
        $_POST['surat_pernyataan_belum_menikah']['tipe'] = 'SURAT PERNYATAAN BELUM MENIKAH';
        $_POST['surat_pernyataan_belum_menikah']['nama_file'] = $target_file_surat_pernyataan_belum_menikah;

        $db->insert('berkas',$_POST['surat_pernyataan_belum_menikah']);
    }

    if($_FILES['akte_cerai_suami_istri']['size'] > 0){

        $akte_cerai_suami_istri = $_FILES['akte_cerai_suami_istri'];
        $target_file_akte_cerai_suami_istri = $target_dir . time() . "-ACSI-" . basename($akte_cerai_suami_istri["name"]);
        move_uploaded_file($akte_cerai_suami_istri["tmp_name"], $target_file_akte_cerai_suami_istri);
        
        $_POST['akte_cerai_suami_istri']['pemohon_id'] = $pemohon->id;
        $_POST['akte_cerai_suami_istri']['tipe'] = 'AKTE CERAI SUAMI ISTRI';
        $_POST['akte_cerai_suami_istri']['nama_file'] = $target_file_akte_cerai_suami_istri;

        $db->insert('berkas',$_POST['akte_cerai_suami_istri']);
    }

    if($_FILES['surat_kematian_suami_istri']['size'] > 0){

        $surat_kematian_suami_istri = $_FILES['surat_kematian_suami_istri'];
        $target_file_surat_kematian_suami_istri = $target_dir . time() . "-SKSI-" . basename($surat_kematian_suami_istri["name"]);
        move_uploaded_file($surat_kematian_suami_istri["tmp_name"], $target_file_surat_kematian_suami_istri);
        
        $_POST['surat_kematian_suami_istri']['pemohon_id'] = $pemohon->id;
        $_POST['surat_kematian_suami_istri']['tipe'] = 'SURAT KEMATIAN SUAMI ISTRI';
        $_POST['surat_kematian_suami_istri']['nama_file'] = $target_file_surat_kematian_suami_istri;

        $db->insert('berkas',$_POST['surat_kematian_suami_istri']);
    }


    if(file_exists('../actions/'.$table.'/after-insert.php'))
        require '../actions/'.$table.'/after-insert.php';

    set_flash_msg(['success'=>$table.' berhasil ditambahkan']);
    header('location:'.routeTo('pemohon/dispensasi-nikah/index',['table'=>$table]));
}

return compact('table','error_msg','old');