<?php

return [
    'tblname'    => [
        'field1','field2'
    ],
    'ahli_waris' => [
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'nama_lengkap',
        'hubungan_keluarga',
        'NIK',
        'jenis_kelamin',
        'agama',
        'alamat',
        'dusun',
        'desa',
        'kecamatan',
    ]
];