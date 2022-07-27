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
        'jenis_kelamin'=>[
            'label'=>"Jenis Kelamin",
            'type'=>'options:Laki-Laki|Perempuan'
        ],
        'agama',
        'alamat',
        'dusun',
        'desa',
        'kecamatan',
    ],
    'pewaris' => [
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'nama_lengkap',
        'NIK',
        'jenis_kelamin'=>[
            'label'=>"Jenis Kelamin",
            'type'=>'options:Laki-Laki|Perempuan'
        ],
        'agama',
        'tempat_lahir',
        'tanggal_lahir'=>[
            'label'=>"Tanggal Lahir",
            'type'=>'date'
        ],
        'alamat',
        'dusun',
        'desa',
        'kecamatan',
        'no_surat_kematian',
        'tanggal_meninggal'=>[
            'label'=>"Tanggal Meninggal",
            'type'=>'date'
        ],
    ],
    'pemohon' => [
        'user_id' => [
            'label' => 'User',
            'type' => 'options-obj:users,id,name',
        ],
        'nama_layanan',
        'nama_lengkap',
        'hubungan_keluarga',
        'email',
        'NIK',
        'jenis_kelamin'=>[
            'label'=>"Jenis Kelamin",
            'type'=>'options:Laki-Laki|Perempuan'
        ],
        'agama',
        'tempat_lahir',
        'tanggal_lahir'=>[
            'label'=>"Tanggal Lahir",
            'type'=>'date'
        ],
        'alamat',
        'dusun',
        'desa',
        'kecamatan',
        'kode_pos',
        'no_hp',
        'pekerjaan',
        'status',
        'tanggal_pernikahan'=>[
            'label'=>"Tanggal Pernikahan",
            'type'=>'date'
        ],
        'saksi_1',
        'saksi_2',
    ],
    'profile' => [
        'user_id' => [
            'label' => 'User',
            'type' => 'options-obj:users,id,name',
        ],
        'nama_lengkap',
        'email',
        'NIK',
        'jenis_kelamin'=>[
            'label'=>"Jenis Kelamin",
            'type'=>'options:Laki-Laki|Perempuan'
        ],
        'agama',
        'tempat_lahir',
        'tanggal_lahir'=>[
            'label'=>"Tanggal Lahir",
            'type'=>'date'
        ],
        'alamat',
        'dusun',
        'desa',
        'kecamatan',
        'kode_pos',
        'no_hp',
        'pekerjaan',
        'status'
    ],
    'surat_keterangan_pindah' => [
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'alamat_tujuan',
        'dusun_tujuan',
        'desa_tujuan',
        'kecamatan_tujuan',
    ],
    'surat_keterangan_tidak_mampu' => [
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'no_surat',
        'keperluan_surat',
    ],
    'berkas' => [
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'tipe',
        'nama_file',
    ],
    'data_ayah' => [
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'nama_lengkap',
        'NIK',
        'agama',
        'pekerjaan',
        'tempat_lahir',
        'tanggal_lahir'=>[
            'label'=>"Tanggal Lahir",
            'type'=>'date'
        ],
        'alamat',
    ],
    'data_ibu' => [
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'nama_lengkap',
        'NIK',
        'agama',
        'pekerjaan',
        'tempat_lahir',
        'tanggal_lahir'=>[
            'label'=>"Tanggal Lahir",
            'type'=>'date'
        ],
        'alamat',
    ],
    'data_anak' => [
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'nama_lengkap',
        'NIK',
        'jenis_kelamin'=>[
            'label'=>"Jenis Kelamin",
            'type'=>'options:Laki-Laki|Perempuan'
        ],
        'agama',
        'pekerjaan',
        'tempat_lahir',
        'tanggal_lahir'=>[
            'label'=>"Tanggal Lahir",
            'type'=>'date'
        ],
        'alamat',
    ],
    'lapor' => [
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'judul_laporan',
        'isi_laporan',
        'tanggal_kejadian'=>[
            'label'=>'Tanggal Kejadian',
            'type'=>'date'
        ],
        'lokasi_kejadian',
        'desa',
    ],
    'surat_keterangan_bersih_diri' => [
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'data_ayah_id' => [
            'label' => 'Data Ayah',
            'type' => 'options-obj:data_ayah,id,nama_lengkap',
        ],
        'data_ibu_id' => [
            'label' => 'Data Ibu',
            'type' => 'options-obj:data_ibu,id,nama_lengkap',
        ],
        'data_anak_id' => [
            'label' => 'Data Anak',
            'type' => 'options-obj:data_anak,id,nama_lengkap',
        ],
    ],
    'data_mempelai'=>[
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'nama_lengkap',
        'kewarganegaraan',
        'NIK',
        'jenis_kelamin'=>[
            'label'=>"Jenis Kelamin",
            'type'=>'options:Laki-Laki|Perempuan'
        ],
        'agama',
        'pekerjaan',
        'dusun',
        'desa',
        'kecamatan',
        'no_hp',
        'no_kk',
        'status_perkawinan',
        'tempat_lahir',
        'tanggal_lahir'=>[
            'label'=>'Tanggal Lahir',
            'type'=>'date'
        ],
        'alamat',
    ],
    'dispensasi_nikah' => [
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'data_mempelai_pria_id' => [
            'label' => 'Data Mempelai Pria',
            'type' => 'options-obj:data_mempelai,id,nama_lengkap',
        ],
        'data_mempelai_wanita_id' => [
            'label' => 'Data Mempelai Wanita',
            'type' => 'options-obj:data_mempelai,id,nama_lengkap',
        ],
        'data_ayah_mempelai_pria_id' => [
            'label' => 'Data Ayah Mempelai Pria',
            'type' => 'options-obj:data_ayah,id,nama_lengkap',
        ],
        'data_ibu_mempelai_pria_id' => [
            'label' => 'Data Ibu Mempelai Pria',
            'type' => 'options-obj:data_ibu,id,nama_lengkap',
        ],
        'data_ayah_mempelai_wanita_id' => [
            'label' => 'Data Ayah Mempelai Wanita',
            'type' => 'options-obj:data_ayah,id,nama_lengkap',
        ],
        'data_ibu_mempelai_wanita_id' => [
            'label' => 'Data Ibu Mempelai Wanita',
            'type' => 'options-obj:data_ibu,id,nama_lengkap',
        ],
        'data_kematian_suami_id' => [
            'label' => 'Data Kematian Suami',
            'type' => 'options-obj:data_kematian,id,nama',
        ],
        'data_kematian_istri_id' => [
            'label' => 'Data Kematian Istri',
            'type' => 'options-obj:data_kematian,id,nama',
        ],
    ],
    'data_kematian'=>[
        'pemohon_id' => [
            'label' => 'Pemohon',
            'type' => 'options-obj:pemohon,id,nama_lengkap',
        ],
        'nama',
        'jenis_kelamin'=>[
            'label'=>"Jenis Kelamin",
            'type'=>'options:Laki-Laki|Perempuan'
        ],
        'tempat_lahir',
        'tanggal_lahir'=>[
            'label'=>'Tanggal Lahir',
            'type'=>'date'
        ],
        'kewarganegaraan',
        'agama',
        'pekerjaan',
        'tempat_tinggal_wafat'
    ],
];