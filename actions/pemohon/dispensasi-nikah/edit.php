<?php

$table = 'dispensasi_nikah';
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

$pria = $db->single('data_mempelai',[
    'id' => $data->data_mempelai_pria_id
]);

$wanita = $db->single('data_mempelai',[
    'id' => $data->data_mempelai_wanita_id
]);

$ayah_pria = $db->single('data_ayah',[
    'id' => $data->data_ayah_mempelai_pria_id
]);

$ibu_pria = $db->single('data_ibu',[    
    'id' => $data->data_ibu_mempelai_pria_id
]);

$ayah_wanita = $db->single('data_ayah',[
    'id' => $data->data_ayah_mempelai_wanita_id
]);

$ibu_wanita = $db->single('data_ibu',[
    'id' => $data->data_ibu_mempelai_wanita_id
]);

$kematian_suami = $db->single('data_kematian',[
    'id' => $data->data_kematian_suami_id
]);

$kematian_istri = $db->single('data_kematian',[
    'id' => $data->data_kematian_istri_id
]);

$user_pemohon = $db->single('profile',[
    'user_id'=>auth()->user->id
]);

$spdd = $db->single('berkas',[
    'pemohon_id' => $data->pemohon_id,
    'tipe'=>'SURAT PENGANTAR DARI DESA'
]);

$kkmp = $db->single('berkas',[
    'pemohon_id' => $data->pemohon_id,
    'tipe'=>'KK MEMPELAI PRIA'
]);

$KTPMP = $db->single('berkas',[
    'pemohon_id' => $data->pemohon_id,
    'tipe'=>'KTP MEMPELAI PRIA'
]);

$PFMP = $db->single('berkas',[
    'pemohon_id' => $data->pemohon_id,
    'tipe'=>'PAS FOTO MEMPELAI PRIA'
]);

$KKMW = $db->single('berkas',[
    'pemohon_id' => $data->pemohon_id,
    'tipe'=>'KK MEMPELAI WANITA'
]);

$KTPMW = $db->single('berkas',[
    'pemohon_id' => $data->pemohon_id,
    'tipe'=>'KTP MEMPELAI WANITA'
]);

$PFMW = $db->single('berkas',[
    'pemohon_id' => $data->pemohon_id,
    'tipe'=>'PAS FOTO MEMPELAI WANITA'
]);

$SPBM = $db->single('berkas',[
    'pemohon_id' => $data->pemohon_id,
    'tipe'=>'SURAT PERNYATAAN BELUM MENIKAH'
]);

$ACSI = $db->single('berkas',[
    'pemohon_id' => $data->pemohon_id,
    'tipe'=>'AKTE CERAI SUAMI ISTRI'
]);

$SKSI = $db->single('berkas',[
    'pemohon_id' => $data->pemohon_id,
    'tipe'=>'SURAT KEMATIAN SUAMI ISTRI'
]);


if(request() == 'POST')
{
    if(file_exists('../actions/'.$table.'/before-edit.php'))
        require '../actions/'.$table.'/before-edit.php';

    $pemohon = $db->update('pemohon',$_POST['pemohon'],[
        'id'=>$pemohon->id
    ]);

    $pria = $db->update('data_mempelai',$_POST['data_mempelai_pria'],[
        'id'=>$pria->id
    ]);

    $wanita = $db->update('data_mempelai',$_POST['data_mempelai_wanita'],[
        'id'=>$wanita->id
    ]);
    
    $ayah_pria = $db->update('data_ayah',$_POST['data_ayah_mempelai_pria'],[
        'id'=>$ayah_pria->id
    ]);
    $ibu_pria = $db->update('data_ibu',$_POST['data_ibu_mempelai_pria'],[
        'id'=>$ibu_pria->id
    ]);
    
    $ayah_wanita = $db->update('data_ayah',$_POST['data_ayah_mempelai_wanita'],[
        'id'=>$ayah_wanita->id
    ]);
    $ibu_wanita = $db->update('data_ibu',$_POST['data_ibu_mempelai_wanita'],[   
        'id'=>$ibu_wanita->id
    ]);

    if(isset($_POST['data_kematian_suami']['nama']) && $_POST['data_kematian_suami']['nama']){
        if($kematian_suami){
            $kematian_suami = $db->update('data_kematian',$_POST['data_kematian_suami'],[
                'id'=>$kematian_suami->id
            ]);
        }else{
            $_POST['data_kematian_suami']['pemohon_id'] = $data->pemohon_id;
            $kematian_suami = $db->insert('data_kematian',$_POST['data_kematian_suami']);
            $_POST[$table]['data_kematian_suami_id'] = $kematian_suami->id;
        }
    }
    
    if(isset($_POST['data_kematian_istri']['nama']) && $_POST['data_kematian_istri']['nama']){
        if($kematian_istri){
            $kematian_istri = $db->update('data_kematian',$_POST['data_kematian_istri'],[
                'id'=>$kematian_istri->id
            ]);
        }else{
            $_POST['data_kematian_istri']['pemohon_id'] = $data->pemohon_id;
            $kematian_istri = $db->insert('data_kematian',$_POST['data_kematian_istri']);
            $_POST[$table]['data_kematian_istri_id'] = $kematian_istri->id;
        }
    }

    $data = $db->update($table,$_POST[$table],[
        'id' => $data->id
    ]);

    $target_dir = "uploads/dispensasi-nikah/";

    if($_FILES['surat_pengantar_dari_desa']['size'] > 0){

        $surat_pengantar_dari_desa = $_FILES['surat_pengantar_dari_desa'];
        $target_file_surat_pengantar_dari_desa = $target_dir . time() . "-SPDD-" . basename($surat_pengantar_dari_desa["name"]);
        move_uploaded_file($surat_pengantar_dari_desa["tmp_name"], $target_file_surat_pengantar_dari_desa);
        
        $_POST['surat_pengantar_dari_desa']['nama_file'] = $target_file_surat_pengantar_dari_desa;

        $db->update('berkas',$_POST['surat_pengantar_dari_desa'],[
            'id'=>$spdd->id
        ]);
    }

    if($_FILES['kk_mempelai_pria']['size'] > 0){

        $kk_mempelai_pria = $_FILES['kk_mempelai_pria'];
        $target_file_kk_mempelai_pria = $target_dir . time() . "-KKMP-" . basename($kk_mempelai_pria["name"]);
        move_uploaded_file($kk_mempelai_pria["tmp_name"], $target_file_kk_mempelai_pria);
        
        $_POST['kk_mempelai_pria']['nama_file'] = $target_file_kk_mempelai_pria;

        $db->update('berkas',$_POST['kk_mempelai_pria'],[
            'id'=>$kkmp->id
        ]);
    }

    if($_FILES['ktp_mempelai_pria']['size'] > 0){

        $ktp_mempelai_pria = $_FILES['ktp_mempelai_pria'];
        $target_file_ktp_mempelai_pria = $target_dir . time() . "-KTPMP-" . basename($ktp_mempelai_pria["name"]);
        move_uploaded_file($ktp_mempelai_pria["tmp_name"], $target_file_ktp_mempelai_pria);
        
        $_POST['ktp_mempelai_pria']['nama_file'] = $target_file_ktp_mempelai_pria;

        $db->update('berkas',$_POST['ktp_mempelai_pria'],[
            'id'=>$KTPMP->id
        ]);
    }

    if($_FILES['pas_foto_mempelai_pria']['size'] > 0){

        $pas_foto_mempelai_pria = $_FILES['pas_foto_mempelai_pria'];
        $target_file_pas_foto_mempelai_pria = $target_dir . time() . "-PFMP-" . basename($pas_foto_mempelai_pria["name"]);
        move_uploaded_file($pas_foto_mempelai_pria["tmp_name"], $target_file_pas_foto_mempelai_pria);
        
        $_POST['pas_foto_mempelai_pria']['pemohon_id'] = $pemohon->id;
        $_POST['pas_foto_mempelai_pria']['tipe'] = 'PAS FOTO MEMPELAI WANITA';
        $_POST['pas_foto_mempelai_pria']['nama_file'] = $target_file_pas_foto_mempelai_pria;

        $db->update('berkas',$_POST['pas_foto_mempelai_pria'],[
            'id'=>$PFMP->id
        ]);
    }

    if($_FILES['kk_mempelai_wanita']['size'] > 0){

        $kk_mempelai_WANITA = $_FILES['kk_mempelai_wanita'];
        $target_file_kk_mempelai_WANITA = $target_dir . time() . "-KKMW-" . basename($kk_mempelai_WANITA["name"]);
        move_uploaded_file($kk_mempelai_WANITA["tmp_name"], $target_file_kk_mempelai_WANITA);
        
        $_POST['kk_mempelai_wanita']['nama_file'] = $target_file_kk_mempelai_WANITA;

        $db->update('berkas',$_POST['kk_mempelai_wanita'],[
            'id'=>$KKMW->id
        ]);
    }

    if($_FILES['ktp_mempelai_wanita']['size'] > 0){

        $ktp_mempelai_WANITA = $_FILES['ktp_mempelai_wanita'];
        $target_file_ktp_mempelai_WANITA = $target_dir . time() . "-KTPMW-" . basename($ktp_mempelai_WANITA["name"]);
        move_uploaded_file($ktp_mempelai_WANITA["tmp_name"], $target_file_ktp_mempelai_WANITA);
        
        $_POST['ktp_mempelai_wanita']['nama_file'] = $target_file_ktp_mempelai_WANITA;

        $db->update('berkas',$_POST['ktp_mempelai_wanita'],[
            'id'=>$KTPMW->id
        ]);
    }

    if($_FILES['pas_foto_mempelai_wanita']['size'] > 0){

        $pas_foto_mempelai_WANITA = $_FILES['pas_foto_mempelai_wanita'];
        $target_file_pas_foto_mempelai_WANITA = $target_dir . time() . "-PFMW-" . basename($pas_foto_mempelai_WANITA["name"]);
        move_uploaded_file($pas_foto_mempelai_WANITA["tmp_name"], $target_file_pas_foto_mempelai_WANITA);
        
        $_POST['pas_foto_mempelai_wanita']['nama_file'] = $target_file_pas_foto_mempelai_WANITA;

        $db->update('berkas',$_POST['pas_foto_mempelai_wanita'],[
            'id'=>$PFMW->id
        ]);
    }

    if($_FILES['surat_pernyataan_belum_menikah']['size'] > 0){

        $surat_pernyataan_belum_menikah = $_FILES['surat_pernyataan_belum_menikah'];
        $target_file_surat_pernyataan_belum_menikah = $target_dir . time() . "-SPBM-" . basename($surat_pernyataan_belum_menikah["name"]);
        move_uploaded_file($surat_pernyataan_belum_menikah["tmp_name"], $target_file_surat_pernyataan_belum_menikah);
        
        $_POST['surat_pernyataan_belum_menikah']['nama_file'] = $target_file_surat_pernyataan_belum_menikah;

        $db->update('berkas',$_POST['surat_pernyataan_belum_menikah'],[
            'id'=>$SPBM->id
        ]);
    }

    if($_FILES['akte_cerai_suami_istri']['size'] > 0){

        $akte_cerai_suami_istri = $_FILES['akte_cerai_suami_istri'];
        $target_file_akte_cerai_suami_istri = $target_dir . time() . "-ACSI-" . basename($akte_cerai_suami_istri["name"]);
        move_uploaded_file($akte_cerai_suami_istri["tmp_name"], $target_file_akte_cerai_suami_istri);
        
        $_POST['akte_cerai_suami_istri']['nama_file'] = $target_file_akte_cerai_suami_istri;

        $db->update('berkas',$_POST['akte_cerai_suami_istri'],[
            'id'=>$ACSI->id
        ]);
    }

    if($_FILES['surat_kematian_suami_istri']['size'] > 0){

        $surat_kematian_suami_istri = $_FILES['surat_kematian_suami_istri'];
        $target_file_surat_kematian_suami_istri = $target_dir . time() . "-SKSI-" . basename($surat_kematian_suami_istri["name"]);
        move_uploaded_file($surat_kematian_suami_istri["tmp_name"], $target_file_surat_kematian_suami_istri);
        
        $_POST['surat_kematian_suami_istri']['nama_file'] = $target_file_surat_kematian_suami_istri;

        $db->update('berkas',$_POST['surat_kematian_suami_istri'],[
            'id'=>$SKSI->id
        ]);
    }

    if(file_exists('../actions/'.$table.'/after-edit.php'))
        require '../actions/'.$table.'/after-edit.php';

    set_flash_msg(['success'=>$table.' berhasil diupdate']);
    header('location:'.routeTo('pemohon/dispensasi-nikah/index',['table'=>$table]));
}

return [
    'data' => $data,
    'user_pemohon' => $user_pemohon,
    'pria' => $pria,
    'wanita' => $wanita,
    'ayah_pria' => $ayah_pria,
    'ibu_pria' => $ibu_pria,
    'ayah_wanita' => $ayah_wanita,
    'ibu_wanita' => $ibu_wanita,
    'kematian_suami' => $kematian_suami,
    'kematian_istri' => $kematian_istri,
    'pemohon' => $pemohon,
    'error_msg' => $error_msg,
    'old' => $old,
    'table' => $table,
    'spdd' => $spdd,
    'kkmp' => $kkmp,
    'ktpmp' => $KTPMP,
    'pfmp' => $PFMP,
    'kkmw' => $KKMW,
    'ktpmw' => $KTPMW,
    'pfmw' => $PFMW,
    'spbm' => $SPBM,
    'acsi' => $ACSI,
    'sksi' => $SKSI,
];