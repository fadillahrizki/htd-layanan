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

    if(file_exists('../actions/'.$table.'/after-insert.php'))
        require '../actions/'.$table.'/after-insert.php';

    set_flash_msg(['success'=>$table.' berhasil ditambahkan']);
    header('location:'.routeTo('pemohon/dispensasi-nikah/index',['table'=>$table]));
}

return compact('table','error_msg','old');