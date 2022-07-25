<?php

$table = 'surat_keterangan_bersih_diri';
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

$ayah = $db->single('data_ayah',[
    'pemohon_id' => $data->pemohon_id
]);

$ibu = $db->single('data_ibu',[
    'pemohon_id' => $data->pemohon_id
]);

$anak = $db->single('data_anak',[
    'pemohon_id' => $data->pemohon_id
]);

if(request() == 'POST')
{
    if(file_exists('../actions/'.$table.'/before-edit.php'))
        require '../actions/'.$table.'/before-edit.php';

    $pemohon = $db->update('pemohon',$_POST['pemohon'],[
        'id'=>$pemohon->id
    ]);
    
    $ayah = $db->update('data_ayah',$_POST['data_ayah'],[
        'id'=>$ayah->id
    ]);

    $ibu = $db->update('data_ibu',$_POST['data_ibu'],[
        'id'=>$ibu->id
    ]);

    $anak = $db->update('data_anak',$_POST['data_anak'],[
        'id'=>$anak->id
    ]);

    if(file_exists('../actions/'.$table.'/after-edit.php'))
        require '../actions/'.$table.'/after-edit.php';

    set_flash_msg(['success'=>$table.' berhasil diupdate']);
    header('location:'.routeTo('pemohon/surat-keterangan-bersih-diri/index',['table'=>$table]));
}

return [
    'data' => $data,
    'ayah' => $ayah,
    'ibu' => $ibu,
    'anak' => $anak,
    'pemohon' => $pemohon,
    'error_msg' => $error_msg,
    'old' => $old,
    'table' => $table
];