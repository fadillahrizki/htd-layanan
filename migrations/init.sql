CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE role_routes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    route_path VARCHAR(100) NOT NULL,
    CONSTRAINT fk_role_routes_role_id FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE user_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    CONSTRAINT fk_user_roles_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_user_roles_role_id FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE application (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE migrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(100) NOT NULL,
    execute_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create table pemohon(
    id int AUTO_INCREMENT PRIMARY KEY,
    user_id int NOT NULL,
    nama_layanan varchar(100),
    nama_lengkap varchar(100),
    hubungan_keluarga varchar(100) DEFAULT NULL,
    alamat TEXT DEFAULT NULL,
    dusun varchar(100) DEFAULT NULL,
    desa varchar(100) DEFAULT NULL,
    kecamatan varchar(100) DEFAULT NULL,
    kode_pos varchar(100) DEFAULT NULL,
    no_hp varchar(100) DEFAULT NULL,
    tanggal_pernikahan varchar(100) DEFAULT NULL,
    saksi_1 varchar(100) DEFAULT NULL,
    saksi_2 varchar(100) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_pemohon_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

create table pewaris(
    id int AUTO_INCREMENT PRIMARY KEY,
    pemohon_id int NOT NULL,
    nama_lengkap varchar(100),
    NIK varchar(100),
    jenis_kelamin varchar(100),
    agama varchar(100),
    tempat_lahir varchar(100),
    tanggal_lahir DATE,
    alamat TEXT,
    dusun varchar(100),
    desa varchar(100),
    kecamatan varchar(100),
    no_surat_kematian varchar(100),
    tanggal_meninggal DATE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_pewaris_pemohon_id FOREIGN KEY (pemohon_id) REFERENCES pemohon(id) ON DELETE CASCADE
);

create table ahli_waris(
    id int AUTO_INCREMENT PRIMARY KEY,
    pemohon_id int NOT NULL,
    nama_lengkap varchar(100),
    hubungan_keluarga varchar(100),
    NIK varchar(100),
    jenis_kelamin varchar(100),
    agama varchar(100),
    alamat TEXT,
    dusun varchar(100),
    desa varchar(100),
    kecamatan varchar(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_ahli_waris_pemohon_id FOREIGN KEY (pemohon_id) REFERENCES pemohon(id) ON DELETE CASCADE
);

create table berkas(
    id int AUTO_INCREMENT PRIMARY KEY,
    pemohon_id int NOT NULL,
    tipe varchar(100),
    nama_file varchar(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_berkas_pemohon_id FOREIGN KEY (pemohon_id) REFERENCES pemohon(id) ON DELETE CASCADE
);

create table surat_keterangan_pindah(
    id int AUTO_INCREMENT PRIMARY KEY,
    pemohon_id int NOT NULL,
    alamat_tujuan varchar(100),
    dusun_tujuan varchar(100),
    desa_tujuan varchar(100),
    kecamatan_tujuan varchar(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_surat_keterangan_pindah_pemohon_id FOREIGN KEY (pemohon_id) REFERENCES pemohon(id) ON DELETE CASCADE
);

create table data_ayah(
    id int AUTO_INCREMENT PRIMARY KEY,
    pemohon_id int NOT NULL,
    nama_lengkap varchar(100),
    NIK varchar(100),
    agama varchar(100),
    pekerjaan varchar(100),
    tempat_lahir varchar(100),
    tanggal_lahir DATE,
    alamat TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_data_ayah_pemohon_id FOREIGN KEY (pemohon_id) REFERENCES pemohon(id) ON DELETE CASCADE
);

create table data_ibu(
    id int AUTO_INCREMENT PRIMARY KEY,
    pemohon_id int NOT NULL,
    nama_lengkap varchar(100),
    NIK varchar(100),
    agama varchar(100),
    pekerjaan varchar(100),
    tempat_lahir varchar(100),
    tanggal_lahir DATE,
    alamat TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_data_ibu_pemohon_id FOREIGN KEY (pemohon_id) REFERENCES pemohon(id) ON DELETE CASCADE
);

create table data_anak(
    id int AUTO_INCREMENT PRIMARY KEY,
    pemohon_id int NOT NULL,
    nama_lengkap varchar(100),
    NIK varchar(100),
    jenis_kelamin varchar(100),
    agama varchar(100),
    pekerjaan varchar(100),
    tempat_lahir varchar(100),
    tanggal_lahir DATE,
    alamat TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_data_anak_pemohon_id FOREIGN KEY (pemohon_id) REFERENCES pemohon(id) ON DELETE CASCADE
);

create table surat_keterangan_tidak_mampu(
    id int AUTO_INCREMENT PRIMARY KEY,
    pemohon_id int NOT NULL,
    no_surat varchar(100),
    keperluan_surat varchar(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_surat_keterangan_tidak_mampu_pemohon_id FOREIGN KEY (pemohon_id) REFERENCES pemohon(id) ON DELETE CASCADE
);

create table lapor(
    id int AUTO_INCREMENT PRIMARY KEY,
    pemohon_id int NOT NULL,
    judul_laporan varchar(100),
    isi_laporan TEXT,
    tanggal_kejadian DATE,
    lokasi_kejadian varchar(100),
    desa varchar(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_lapor_pemohon_id FOREIGN KEY (pemohon_id) REFERENCES pemohon(id) ON DELETE CASCADE
);

create table data_mempelai(
    id int AUTO_INCREMENT PRIMARY KEY,
    pemohon_id int NOT NULL,
    nama_lengkap varchar(100),
    kewarganegaraan varchar(100),
    NIK varchar(100),
    jenis_kelamin varchar(100),
    agama varchar(100),
    pekerjaan varchar(100),
    dusun varchar(100),
    desa varchar(100),
    kecamatan varchar(100),
    no_hp varchar(100),
    no_kk varchar(100),
    status_perkawinan varchar(100),
    tempat_lahir varchar(100),
    tanggal_lahir DATE,
    alamat TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_data_anak_pemohon_id FOREIGN KEY (pemohon_id) REFERENCES pemohon(id) ON DELETE CASCADE
);
