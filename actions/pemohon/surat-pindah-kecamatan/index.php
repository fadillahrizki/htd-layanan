<?php

$table = 'surat_keterangan_pindah';
Page::set_title(ucwords($table));
$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$user = auth()->user;
$role = $db->single('user_roles',[
    'user_id'=>$user->id
]);
$role = $db->single('roles',[
    'id'=>$role->role_id
]);
if($role->name == "pemohon"){
    $db->query = "select id from pemohon where user_id=$user->id";
    $pemohon = $db->exec('all');

    $data = [];

    if($pemohon)
    {
        $ids = [];
        foreach($pemohon as $p){
            $ids[] = $p->id;
        }
        
        $db->query = "select * from $table where pemohon_id in (". implode(',', $ids) .")";
        $data = $db->exec('all');
    }
}else{
    $data = $db->all($table);
}

return [
    'datas' => $data,
    'table' => $table,
    'success_msg' => $success_msg
];