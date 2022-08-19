<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-success-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <?php if($role->name == 'administrator'):?>
            <div class="row mt--2">
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Data Rekapitulasi</div>
                            <div class="card-category">Jumlah Permohonan Masuk</div>
                            <div class="row mt-5">
                                <div class="col-6 col-md-4 col-lg-2">
                                    <div class="px-2 pb-2 pb-md-0 text-center">
                                        <div id="circles-1" data-value="<?=$aw->total?>"></div>
                                        <h6 class="fw-bold mt-3 mb-0">Ahli Waris</h6>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <div class="px-2 pb-2 pb-md-0 text-center">
                                        <div id="circles-2" data-value="<?=$spk->total?>"></div>
                                        <h6 class="fw-bold mt-3 mb-0">Surat Pindah Kecamatan</h6>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <div class="px-2 pb-2 pb-md-0 text-center">
                                        <div id="circles-3" data-value="<?=$skbd->total?>"></div>
                                        <h6 class="fw-bold mt-3 mb-0">Surat Keterangan Bersih Diri</h6>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <div class="px-2 pb-2 pb-md-0 text-center">
                                        <div id="circles-4" data-value="<?=$sktm->total?>"></div>
                                        <h6 class="fw-bold mt-3 mb-0">Surat Keterangan Tidak Mampu</h6>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <div class="px-2 pb-2 pb-md-0 text-center">
                                        <div id="circles-5" data-value="<?=$dn->total?>"></div>
                                        <h6 class="fw-bold mt-3 mb-0">Dispensasi Nikah</h6>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <div class="px-2 pb-2 pb-md-0 text-center">
                                        <div id="circles-6" data-value="<?=$lapor->total?>"></div>
                                        <h6 class="fw-bold mt-3 mb-0">Lapor</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif?>
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <h2>SELAMAT DATANG DI SISTEM INFORMASI PELAYANAN KECAMATAN (SINYAMAN)</h2>
                        
                        <h3>JENIS LAYANAN DAN PERSYARATAN :</h3>
                        
                        <ol>
                            <li>
                                <h4>Ahli Waris</h4>
                                <p>Syarat :</p>
                                <ol>
                                    <li>Surat Pernyataan Ahli Waris</li>
                                    <li>Surat Kuasa Ahli Waris</li>
                                    <li>Surat Kematian dari Desa</li>
                                    <li>KK Pewaris</li>
                                    <li>KTP Masing-Masing Ahli Waris</li>
                                </ol>
                                <br>
                            </li>
                            <li>
                                <h4>Surat Pindah Kecamatan</h4>
                                <p>Syarat:</p>
                                <ol>
                                    <li>KTP</li>
                                    <li>KK</li>
                                    <li>Surat Pengantar Dari Desa</li>
                                </ol>
                                <br>
                            </li>
                            <li>
                                <h4>Surat Keterangan Bersih Diri</h4>
                                <p>Syarat:</p>
                                <ol>
                                    <li>KTP</li>
                                    <li>KK</li>
                                    <li>Surat Pengantar Dari Desa</li>
                                </ol>
                                <br>
                            </li>
                            <li>
                                <h4>Surat Keterangan Tidak Mampu</h4>
                                <p>Syarat:</p>
                                <ol>
                                    <li>KTP</li>
                                    <li>KK</li>
                                    <li>Surat Pernyataan</li>
                                    <li>Surat Pengantar Dari Desa</li>
                                </ol>
                                <br>
                            </li>
                            <li>
                                <h4>Dispensasi Nikah</h4>
                                <p>Syarat:</p>
                                <ol>
                                    <li>Surat Pengantar Dari Desa</li>
                                    <li>KK Mempelai</li>
                                    <li>KTP Mempelai</li>
                                    <li>Pas Foto Kedua Mmpelai</li>
                                    <li>Surat Pernyataan Belum menikah</li>
                                    <li>Akte Cerai Suami/Istri *)</li>
                                    <li>Surat Kematian Suami/Istri *)</li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <p align="center">
                Kontak Person : <a href="tel:081225821664">0812 2582 1664</a> - <a href="tel:081362268191">0813 6226 8191</a>
            </p>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>