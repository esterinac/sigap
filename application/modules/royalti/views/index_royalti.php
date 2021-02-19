<?php
$level              = check_level();
$per_page           = 10;
$keyword            = $this->input->get('keyword');
$page               = $this->uri->segment(2);
$i                  = isset($page) ? $page * $per_page - $per_page : 0;
?>

<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>"><span class="fa fa-home"></span></a>
            </li>
            <li class="breadcrumb-item active">
                <a class="text-muted">Royalti</a>
            </li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title"> Royalti </h1>
            <span class="badge badge-info">Total : echo $total</span>
        </div>
        <a
            href="<?= base_url("$pages/add"); ?>"
            class="btn btn-primary btn-sm"
        ><i class="fa fa-plus fa-fw"></i> Tambah</a>
    </div>
</header>
<div class="page-section">
    <div class="row">
        <div class="col-12">
            <section class="card card-fluid">
                <div class="card-body p-0">
                    <div class="p-3">
                        <?= form_open($pages, ['method' => 'GET']); ?>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <label for="per_page">Data per halaman</label>
                                <?= form_dropdown('per_page', get_per_page_options(), $per_page, 'id="per_page" class="form-control custom-select d-block" title="List per page"'); ?>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="date_year">Tahun</label>
                                <select name="date_year" id="date_year" class="form-control custom-select d-block" title="Filter Tahun Cetak">
                                    <option value="" selected="selected">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="date_month">Periode</label>
                                <select name="date_month" id="date_month" class="form-control custom-select d-block" title="Filter Bulan Cetak">
                                    <option value="" selected="selected">January - June</option>
                                    <option value="" selected="">July - December</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="print_order_status">Status</label>
                                <select name="print_order_status" id="print_order_status" class="form-control custom-select d-block" title="Filter Status Cetak">
                                    <option value="" selected="selected">- Filter Status -</option>
                                    <option value="waiting">Aktif</option>
                                    <option value="preprint">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-9">
                                <label for="status">Pencarian</label>
                                <?= form_input('keyword', $keyword, 'placeholder="Cari berdasarkan Judul Buku, Nama Penulis" class="form-control"'); ?>
                            </div>
                            <div class="col-12 col-lg-3">
                                <label>&nbsp;</label>
                                <div
                                    class="btn-group btn-block"
                                    role="group"
                                    aria-label="Filter button"
                                >
                                    <button
                                        class="btn btn-secondary"
                                        type="button"
                                        onclick="location.href = '<?= base_url($pages); ?>'"
                                    > Reset</button>
                                    <button
                                        class="btn btn-primary"
                                        type="submit"
                                        value="Submit"
                                    ><i class="fa fa-filter"></i> Filter</button>
                                </div>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col" style="width:2%;" class="pl-4 align-middle text-center">No</th>
                                <th scope="col" style="width:20%" class="align-middle text-center">Nama Penulis</th>
                                <th scope="col" style="width:25%;" class="align-middle text-center">Judul Buku</th>
                                <th scope="col" style="width:13%;" class="align-middle text-center">Harga/Eks</th>
                                <th scope="col" style="width:5%;" class="align-middle text-center">Status</th>
                                <th scope="col" style="width:5%;" class="align-middle text-center">Terjual</th>
                                <th scope="col" style="width:5%;" class="align-middle text-center">Stok Awal</th>
                                <th scope="col" style="width:5%;" class="align-middle text-center">Stok Akhir</th>
                                <th scope="col" style="width:5%;" class="align-middle text-center">Royalti</th>
                                <th scope="col" style="width:15%;" class="align-middle text-center">Jumlah Royalti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle text-center pl-4">1</td>
                                <td class="align-middle text-left">
                                    <a href="<?= base_url("$pages/view/1"); ?>" class="font-weight-bold">A. Hardjono</a>
                                </td>
                                <td class="align-middle text-center">Teknologi Minyak Bumi</td>
                                <td class="align-middle text-center">Rp 53.000</td>
                                <td class="align-middle text-center">Aktif</td>
                                <td class="align-middle text-center">0</td>
                                <td class="align-middle text-center">0</td>
                                <td class="align-middle text-center">0</td>
                                <td class="align-middle text-center">15%</td>
                                <td class="align-middle text-center">Rp 0</td>
                            </tr>
                            <tr>
                                <td class="align-middle text-center pl-4">2</td>
                                <td class="align-middle text-left">
                                    <a href="" class="font-weight-bold">Abdul Ghofur Anshori</a>
                                </td>
                                <td class="align-middle text-center">Gadai Syariah di Indonesia</td>
                                <td class="align-middle text-center">Rp 55.000</td>
                                <td class="align-middle text-center">Aktif</td>
                                <td class="align-middle text-center">25</td>
                                <td class="align-middle text-center">425</td>
                                <td class="align-middle text-center">400</td>
                                <td class="align-middle text-center">15%</td>
                                <td class="align-middle text-center">Rp 206.250</td>
                            </tr>
                            <tr>
                                <td class="align-middle text-center pl-4">3</td>
                                <td class="align-middle text-left">
                                    <a href="" class="font-weight-bold">Abdul Ghofur Anshori</a>
                                </td>
                                <td class="align-middle text-center">Filsafat Hukum</td>
                                <td class="align-middle text-center">Rp 55.000</td>
                                <td class="align-middle text-center">Aktif</td>
                                <td class="align-middle text-center">25</td>
                                <td class="align-middle text-center">350</td>
                                <td class="align-middle text-center">325</td>
                                <td class="align-middle text-center">15%</td>
                                <td class="align-middle text-center">Rp 206.250</td>
                            </tr>
                            <tr>
                                <td class="align-middle text-center pl-4">4</td>
                                <td class="align-middle text-left">
                                    <a href="" class="font-weight-bold">Abdul Ghofur Anshori</a>
                                </td>
                                <td class="align-middle text-center">Hukum Perjanjian Islam</td>
                                <td class="align-middle text-center">Rp 55.000</td>
                                <td class="align-middle text-center">Aktif</td>
                                <td class="align-middle text-center">25</td>
                                <td class="align-middle text-center">425</td>
                                <td class="align-middle text-center">400</td>
                                <td class="align-middle text-center">15%</td>
                                <td class="align-middle text-center">Rp 206.250</td>
                            </tr>
                            <tr>
                                <td class="align-middle text-center pl-4">5</td>
                                <td class="align-middle text-left">
                                    <a href="" class="font-weight-bold">Alva Edi Tontowi</a>
                                </td>
                                <td class="align-middle text-center">Desain Produk Inovatif</td>
                                <td class="align-middle text-center">Rp 85.000</td>
                                <td class="align-middle text-center">Aktif</td>
                                <td class="align-middle text-center">23</td>
                                <td class="align-middle text-center">23</td>
                                <td class="align-middle text-center">0</td>
                                <td class="align-middle text-center">15%</td>
                                <td class="align-middle text-center">Rp 293.250</td>
                            </tr>
                            <tr>
                                <td class="align-middle text-center pl-4">6</td>
                                <td class="align-middle text-left">
                                    <a href="" class="font-weight-bold">Alva Edi Tontowi</a>
                                </td>
                                <td class="align-middle text-center">Laser Sintering</td>
                                <td class="align-middle text-center">Rp 75.000</td>
                                <td class="align-middle text-center">Tidak Aktif</td>
                                <td class="align-middle text-center">0</td>
                                <td class="align-middle text-center">593</td>
                                <td class="align-middle text-center">593</td>
                                <td class="align-middle text-center">15%</td>
                                <td class="align-middle text-center">Rp 0</td>
                            </tr>
                        </tbody>
                    </table>
                    <?= $pagination ?? null; ?>
                </div>
            </section>
        </div>
    </div>
</div>
