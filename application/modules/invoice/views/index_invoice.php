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
                <a class="text-muted">Faktur</a>
            </li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title"> Faktur </h1>
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
                            <div class="col-12 col-md-4">
                                <label for="per_page">Data per halaman</label>
                                <?= form_dropdown('per_page', get_per_page_options(), $per_page, 'id="per_page" class="form-control custom-select d-block" title="List per page"'); ?>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="status">Pencarian</label>
                                <?= form_input('keyword', $keyword, 'placeholder="Cari berdasarkan Nama, Tipe, Kategori" class="form-control"'); ?>
                            </div>
                            <div class="col-12 col-lg-4">
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
                    <p class="text-center">Data tidak tersedia</p>
                    <table class="table table-striped mb-0 table-responsive">
                        <thead>
                            <tr class="text-center">
                                <th
                                    scope="col"
                                    class="pl-4"
                                >No</th>
                                <th
                                    scope="col"
                                    style="min-width:500px;"
                                >Nomor Faktur</th>
                                <th
                                    scope="col"
                                    style="min-width:150px;"
                                >Tanggal</th>
                                <th
                                    scope="col"
                                    style="min-width:150px;"
                                >Jatuh Tempo</th>
                                <th
                                    scope="col"
                                    style="min-width:100px;"
                                >Status</th>
                                <!-- <?php if ($level == 'superadmin' || $level == 'admin_gudang') : ?>
                                    <th style="min-width:100px;"> &nbsp; </th>
                                    <?php endif; ?> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($invoice as $lData) : ?>
                                <tr class="text-center">
                                    <td class="align-middle pl-4">
                                        <?= ++$i; ?>
                                    </td>
                                    <td class="text-left align-middle">
                                        <a
                                            href="<?= base_url("$pages/view/$lData->number"); ?>"
                                            class="font-weight-bold"
                                        >
                                            <?= highlight_keyword($lData->number, $keyword); ?>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <?= date("d/m/y", strtotime($lData->issued_date)); ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= date("d/m/y", strtotime($lData->due_date)); ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= highlight_keyword($lData->status, $keyword); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pagination ?? null; ?>
                </div>
            </section>
        </div>
    </div>
</div>
