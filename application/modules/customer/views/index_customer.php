<?php
$per_page = $this->input->get('per_page') ?? 10;
$keyword  = $this->input->get('keyword');
$type    = $this->input->get('type');
$status   = $this->input->get('status');
$page     = $this->uri->segment(2);
// data table series number
$i = isset($page) ? $page * $per_page - $per_page : 0;

$type_options = [
    ''                 => '- Semua Type -',
    'superadmin'       => 'Superadmin',
    'admin_penerbitan' => 'Admin Penerbitan',
    'admin_percetakan' => 'Admin Percetakan',
    'admin_gudang'     => 'Admin Gudang',
    'admin_pemasaran'  => 'Admin Pemasaran',
    'admin_keuangan'   => 'Admin Keuangan',
    'staff_percetakan' => 'Staff Percetakan',
    'author'           => 'Author',
    'reviewer'         => 'Reviewer',
    'editor'           => 'Editor',
    'layouter'         => 'Layouter',
    'author_reviewer'  => 'Author dan Reviewer'
];

?>

<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>"><span class="fa fa-home"></span></a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-muted">User</a>
            </li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title"> Akun User </h1>
            <span class="badge badge-info">Total : <?= $total; ?></span>
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
                            <div class="col-12 col-md-2 mb-3">
                                <?= form_dropdown('per_page', get_per_page_options(), $per_page, 'id="per_page" class="form-control custom-select d-block" title="List per page"'); ?>
                            </div>
                            <div class="col-12 col-md-7 mb-3">
                                <?= form_input('keyword', $keyword, ['placeholder' => 'Cari berdasarkan Nama Pengguna', 'class' => 'form-control']); ?>
                            </div>
                            <div class="col-12 col-md-3">
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
                    <?php if ($customers) : ?>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            scope="col"
                                            class="pl-4"
                                        >No</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Status</th>
                                        <th style="width:100px; min-width:100px;"> &nbsp; </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($customers as $customer) : ?>
                                        <tr>
                                            <td class="align-middle pl-4"><?= ++$i; ?></td>
                                            <td class="align-middle"><?= highlight_keyword($customer->name, $keyword); ?></td>
                                            <td class="align-middle"><?= highlight_keyword($customer->address, $keyword); ?></td>
                                            <td class="align-middle"><?= highlight_keyword($customer->phone_number, $keyword); ?></td>
                                            <td class="align-middle"><?= highlight_keyword($customer->type, $keyword); ?></td>
                                            <td class="align-middle text-right">
                                                <a
                                                    href="<?= base_url('customer/edit/' . $customer->customer_id . ''); ?>"
                                                    class="btn btn-sm btn-secondary"
                                                >
                                                    <i class="fa fa-pencil-alt"></i>
                                                    <span class="sr-only">Edit</span>
                                                </a>
                                                <!--<?php if ($user->username != 'superadmin') : ?>
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-danger"
                                                        data-toggle="modal"
                                                        data-target="#modal-hapus-<?= $customer->customer_id; ?>"
                                                    ><i class="fa fa-trash-alt"></i><span class="sr-only">Delete</span></button>
                                                <?php endif; ?>
                                                -->
                                            </td>
                                        </tr>
                                        <div
                                            class="modal modal-alert fade"
                                            id="modal-hapus-<?= $customer->customer_id; ?>"
                                            tabindex="-1"
                                            role="dialog"
                                            aria-labelledby="modal-hapus"
                                            aria-hidden="true"
                                        >
                                            <div
                                                class="modal-dialog"
                                                role="document"
                                            >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <i class="fa fa-exclamation-triangle text-red mr-1"></i> Konfirmasi Hapus</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin akan menghapus customer <span class="font-weight-bold"><?= $customer->name; ?></span>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger"
                                                            onclick="location.href='<?= base_url('customer/delete/' . $customer->customer_id . ''); ?>'"
                                                            data-dismiss="modal"
                                                        >Hapus</button>
                                                        <button
                                                            type="button"
                                                            class="btn btn-light"
                                                            data-dismiss="modal"
                                                        >Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <p class="text-center">Data tidak tersedia</p>
                    <?php endif; ?>
                    <?= $pagination ?? null; ?>
                </div>
            </section>
        </div>
    </div>
</div>
