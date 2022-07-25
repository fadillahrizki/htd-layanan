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

    if(file_exists('../actions/'.$table.'/after-edit.php'))
        require '../actions/'.$table.'/after-edit.php';

    set_flash_msg(['success'=>$table.' berhasil diupdate']);
    header('location:'.routeTo('pemohon/dispensasi-nikah/index',['table'=>$table]));
}

return [
    'data' => $data,
    'pria' => $pria,
    'wanita' => $wanita,
    'ayah_pria' => $ayah_pria,
    'ibu_pria' => $ibu_pria,
    'ayah_wanita' => $ayah_wanita,
    'ibu_wanita' => $ibu_wanita,
    'pemohon' => $pemohon,
    'error_msg' => $error_msg,
    'old' => $old,
    'table' => $table
];