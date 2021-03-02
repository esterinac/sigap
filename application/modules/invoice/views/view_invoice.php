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
                <a href="<?= base_url('invoice'); ?>">Faktur</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-muted">
                    <?= $lData->number ?></a>
            </li>
        </ol>
    </nav>
</header>

<div class="page-section">
    <section
        id="data-invoice"
        class="card"
    >
        <!-- <header class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a
                        class="nav-link active show"
                        data-toggle="tab"
                        href="#logistic-data"
                    ><i class="fa fa-info-circle"></i> Detail Invoice</a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#stock-data"
                    ><i class="fa fa-poll"></i> Stok Logistik</a>
                </li>
            </ul>
        </header> -->
        <div class="card-body">
            <?php //=isset($input->draft_id) ? form_hidden('draft_id', $input->draft_id) : ''; ?>
            <div class="tab-content">
                <!-- book-data -->
                <div
                    class="tab-pane fade active show"
                    id="logistic-data"
                >
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <td width="200px"> Nomor Faktur </td>
                                    <td><strong><?= $lData->number ?></strong> </td>
                                </tr>
                                <tr>
                                    <td width="200px"> Tipe </td>
                                    <td><?= $lData->type ?></td>
                                </tr>
                                <tr>
                                    <td width="200px"> Nama Customer </td>
                                    <td><?= $lData->customer_name ?></td>
                                </tr>
                                <tr>
                                    <td width="200px"> Nomor Customer </td>
                                    <td><?= $lData->customer_number ?></td>
                                </tr>
                                <tr>
                                    <td width="200px"> Tanggal Jatuh Tempo </td>
                                    <td><?= $lData->due_date ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php if($level == 'superadmin' || $level == 'admin_gudang'): ?>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <td width="200px"> Tanggal di buat </td>
                                    <td>$lData->date_created</td>
                                </tr>
                                <tr>
                                    <td width="200px"> User </td>
                                    <td>$lData->user_created</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <?php endif; ?>
                </div>

                <table class="table table-striped mb-0">
                    <thead>
                        <tr class="text-center">
                            <th
                                scope="col"
                                style="width:2%;"
                            >No</th>
                            <th
                                scope="col"
                                style="width:30%;"
                            >Judul Buku</th>
                            <th
                                scope="col"
                                style="width:20%;"
                            >Nama Penulis</th>
                            <th
                                scope="col"
                                style="width:15%;"
                            >Harga</th>
                            <th
                                scope="col"
                                style="width:10%;"
                            >Jumlah</th>
                            <th
                                scope="col"
                                style="width:15%;"
                            >Total</th>
                            <th
                                scope="col"
                                style="width:8%;"
                            >&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="align-middle pl-4">
                                1
                            </td>
                            <td class="align-middle">
                                Judul Buku
                            </td>
                            <td class="align-middle">
                                Penulis
                            </td>
                            <td class="align-middle">
                                Rp 100.000
                            </td>
                            <td class="align-middle">
                                99
                            </td>
                            <td class="align-middle">
                                Rp 9.900.000
                            </td>
                            <td class="align-middle">
                                Button
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </section>
</div>
