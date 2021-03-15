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
                    <?= $invoice->number ?></a>
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
                                    <td><strong><?= $invoice->number ?></strong> </td>
                                </tr>
                                <tr>
                                    <td width="200px"> Tipe </td>
                                    <td><?= $invoice->type ?></td>
                                </tr>
                                <!-- <tr>
                                    <td width="200px"> Nama Customer </td>
                                    <td><?= $invoice->customer_name ?></td>
                                </tr>
								-->
                                <tr>
                                    <td width="200px"> Nomor Customer </td>
                                    <td><?= $invoice->customer_id ?></td>
                                </tr>
                                <tr>
                                    <td width="200px"> Tanggal Jatuh Tempo </td>
                                    <td><?= $invoice->due_date ?></td>
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
                                    <td><?= $invoice->issued_date ?></td>
                                </tr>
                                <tr>
                                    <td width="200px"> User </td>
                                    <td>$invoice->user_created</td>
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
                                style="width:25%;"
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
                                style="width:5%;"
                            >Diskon</th>
                            <th
                                scope="col"
                                style="width:15%;"
                            >Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($invoice_books as $invoice_book) : ?>
                    <?php $i++; ?>
                        <tr class="text-center">
                            <td class="align-middle pl-4">
                                <?= $i ?>
                            </td>
                            <td class="align-middle">
                                <?= $invoice_book->book_title ?>
                            </td>
                            <td class="align-middle">
                                Penulis
                            </td>
                            <td class="align-middle">
                                Rp <?= $invoice_book->harga ?>
                            </td>
                            <td class="align-middle">
                                <?= $invoice_book->qty ?>
                            </td>
                            <td class="align-middle">
                                <?= $invoice_book->discount ?> %
                            </td>
                            <td class="align-middle">
                                Rp <?= $invoice_book->harga * $invoice_book->qty * (1 - $invoice_book->discount/100) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
				<br>
				
                <div class="d-flex justify-content-end">
                    <a class="btn btn-outline-danger" href="<?php echo base_url('invoice/pdf') ?>">Generate PDF<i class="fas fa-file-pdf fa-fw"></i></a>
                    <?php if ($invoice->status == 'waiting') : ?>
                        <?php if($level == 'superadmin' || $level == 'admin_pemasaran'): ?>
                            <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#modal-confirm-invoice">Konfirmasi</button>
                            <!-- Modal -->
                            <div class="modal fade" id="modal-confirm-invoice" role="dialog"aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered"role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Faktur?</h5>
                                        </div>
                                        <div class="modal-body">
                                            <b> Pastikan faktur telah sesuai dengan pesanan! </b> <br>
                                            <br>Faktur yang telah dikonfirmasi tidak dapat diubah lagi dan akan diteruskan ke bagian gudang untuk proses pengambilan buku.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button id="btn-modal-confirm-invoice" data-dismiss="modal" type="button" class="btn btn-primary">Konfirmasi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    const invoice_id = '<?= $invoice->invoice_id ?>'
                                    const status = 'confirm'
                                    $('#data-invoice').on('click', '#btn-modal-confirm-invoice', function(){
                                        //alert("eSTER");
                                        $.ajax({
                                            type: "POST",
                                            url: "<?= base_url('invoice/update_status'); ?>",
                                            data: {
                                                'invoice_id' : invoice_id,
                                                'status' : status
                                            },
                                            success: function(res) {
                                                showToast(true, res.data);
                                                location.reload();
                                            },
                                            error: function(err) {
                                                showToast(false, err.responseJSON.message);
                                            },
                                            complete: function(data)
                                            {
                                                console.log(data);
                                            }
                                        });
                                    })
                                }) 
                            </script>
                        <?php endif ?>
                    <?php endif ?>
                </div>

                
            </div>
        </div>
    </section>
</div>