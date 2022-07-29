<?php

Page::set_title('Dashboard');

$conn = conn();
$db   = new Database($conn);

$db->query = "select count(*) as total from ahli_waris";
$aw = $db->exec('single');

$db->query = "select count(*) as total from surat_keterangan_pindah";
$spk = $db->exec('single');

$db->query = "select count(*) as total from surat_keterangan_bersih_diri";
$skbd = $db->exec('single');

$db->query = "select count(*) as total from surat_keterangan_tidak_mampu";
$sktm = $db->exec('single');

$db->query = "select count(*) as total from dispensasi_nikah";
$dn = $db->exec('single');

$db->query = "select count(*) as total from lapor";
$lapor = $db->exec('single');

$user = auth()->user;
        
$role = $db->single('user_roles',[
    'user_id'=>$user->id
]);

$role = $db->single('roles',[
    'id'=>$role->role_id
]);

return compact('role','aw','spk','skbd','sktm','dn','lapor');