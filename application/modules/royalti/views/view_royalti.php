<?php
$level              = check_level();
?>
<header class="page-title-bar mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>"><span class="fa fa-home"></span></a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('royalti'); ?>">Royalti</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-muted">
                    echo nama Penulis
                </a>
            </li>
        </ol>
    </nav>
</header>

<div class="page-section">
    <div class="row">
        <div class="col-12 d-flex flex-row-reverse">
            <div class="col-12 col-lg-3 d-flex flex-row-reverse">
                <button class="btn btn-success" type="submit" id="excel" name="excel" value="1">Excel</button>	
            </div>
        </div>
        <header class="col-12 card-header">
            <div class="text-center">
                <h6 class=""> Penghitungan Royalti </h6>
                <h6 class=""> Periode Januari - Juni 2020 </h6>
                <h4 class="mt-3 mb-0">  Alva Edi Tontowi </h4>
            </div>
        </header>
        <div class="col-12">
            <div class="card card-fluid">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Terjual</th>
                                    <th scope="col">Stok Awal</th>
                                    <th scope="col">Stok Akhir</th>
                                    <th scope="col">Royalti</th>
                                    <th scope="col">Jumlah Royalti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle text-center">1</td>
                                    <td class="align-middle text-left">Desain Produk Inovatif</td>
                                    <td class="align-middle text-center">Rp 85.000</td>
                                    <td class="align-middle text-center">23</td>
                                    <td class="align-middle text-center">23</td>
                                    <td class="align-middle text-center">0</td>
                                    <td class="align-middle text-center">15%</td>
                                    <td class="align-middle text-center">Rp 293.250</td>
                                </tr>
                                <tr>
                                    <td class="align-middle text-center">2</td>
                                    <td class="align-middle text-left">Laser Sintering</td>
                                    <td class="align-middle text-center">Rp 75.000</td>
                                    <td class="align-middle text-center">0</td>
                                    <td class="align-middle text-center">593</td>
                                    <td class="align-middle text-center">593</td>
                                    <td class="align-middle text-center">15%</td>
                                    <td class="align-middle text-center">Rp 0</td>
                                </tr>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td class="align-middle text-left font-weight-bold">Jumlah</td>
                                    <td class="align-middle text-left">Rp 293.250</td>
                                </tr>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td class="align-middle text-left font-weight-bold">PPh 15%</td>
                                    <td class="align-middle text-left">Rp 43.987</td>
                                </tr>
                                <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td class="align-middle text-left font-weight-bold">Netto</td>
                                    <td class="align-middle text-left">Rp 249.263</td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
