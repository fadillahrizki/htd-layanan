
create table profile(
    id int AUTO_INCREMENT PRIMARY KEY,
    user_id int DEFAULT NULL,
    nama_lengkap varchar(100),
    email varchar(100) DEFAULT NULL,
    NIK varchar(100) DEFAULT NULL,
    jenis_kelamin varchar(100) DEFAULT NULL,
    agama varchar(100) DEFAULT NULL,
    tempat_lahir varchar(100) DEFAULT NULL,
    tanggal_lahir DATE DEFAULT NULL,
    alamat TEXT DEFAULT NULL,
    dusun varchar(100) DEFAULT NULL,
    desa varchar(100) DEFAULT NULL,
    kecamatan varchar(100) DEFAULT NULL,
    kode_pos varchar(100) DEFAULT NULL,
    no_hp varchar(100) DEFAULT NULL,
    pekerjaan varchar(100) DEFAULT NULL,
    status varchar(100) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_profile_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);