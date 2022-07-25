<?php

$table = 'surat_keterangan_bersih_diri';
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

    if(file_exists('../actions/'.$table.'/after-insert.php'))
        require '../actions/'.$table.'/after-insert.php';

    set_flash_msg(['success'=>$table.' berhasil ditambahkan']);
    header('location:'.routeTo('pemohon/surat-keterangan-bersih-diri/index',['table'=>$table]));
}

return compact('table','error_msg','old');