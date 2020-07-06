<?php
$is_preprint_started      = format_datetime($print_order->preprint_start_date);
?>
<section
    id="preprint-progress-wrapper"
    class="card"
>
    <div id="preprint-progress">
        <header class="card-header">
            <div class="d-flex align-items-center"><span class="mr-auto">Pra Cetak</span>
                <div class="card-header-control">
                    <button
                        id="btn-start-preprint"
                        title="Mulai proses pra cetak"
                        type="button"
                        class="d-inline btn <?= !$is_preprint_started ? 'btn-warning' : 'btn-secondary'; ?> <?= $is_preprint_started ? 'btn-disabled' : ''; ?>"
                        <?= $is_preprint_started ? 'disabled' : ''; ?>
                    ><i class="fas fa-play"></i><span class="d-none d-lg-inline"> Mulai</span></button>
                    <button
                        id="btn-finish-preprint"
                        title="Selesai proses pra cetak"
                        type="button"
                        class="d-inline btn btn-secondary"
                        <?= !$is_preprint_started ? 'disabled' : '' ?>
                    ><i class="fas fa-stop"></i><span class="d-none d-lg-inline"> Selesai</span></button>
                </div>
            </div>
        </header>

        <div
            class="list-group list-group-flush list-group-bordered"
            id="list-group-preprint"
        >
            <div class="list-group-item justify-content-between">
                <span class="text-muted">Status</span>
                <span class="font-weight-bold">
                    <?php if ($print_order->is_preprint) : ?>
                        <span class="text-success">
                            <i class="fa fa-check"></i>
                            <span>Pracetak Selesai</span>
                        </span>
                    <?php elseif (!$print_order->is_preprint && $print_order->preprint_start_date) : ?>
                        <span class="text-primary">
                            <span>Sedang Diproses</span>
                        </span>
                    <?php endif ?>
                </span>
            </div>

            <div class="list-group-item justify-content-between">
                <span class="text-muted">Tanggal mulai</span>
                <strong>
                    <?= format_datetime($print_order->preprint_start_date); ?></strong>
            </div>

            <div class="list-group-item justify-content-between">
                <span class="text-muted">Tanggal selesai</span>
                <strong>
                    <?= format_datetime($print_order->preprint_end_date); ?></strong>
            </div>

            <div class="list-group-item justify-content-between">
                <?php if (is_admin()) : ?>
                    <a
                        href="#"
                        id="btn-modal-deadline-preprint"
                        title="Ubah deadline"
                        data-toggle="modal"
                        data-target="#modal-deadline-preprint"
                    >Deadline <i class="fas fa-edit fa-fw"></i></a>
                <?php else : ?>
                    <span class="text-muted">Deadline</span>
                <?php endif ?>
            </div>

            <hr class="m-0">
        </div>

        <div class="card-body">
            <div class="card-button">
                <!-- button tanggapan edit -->
                <button
                    type="button"
                    class="btn btn-outline-success"
                    data-toggle="modal"
                    data-target="#modal-preprint"
                >Catatan</button>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    const print_order_id = '<?= $print_order->print_order_id ?>'

    // // inisialisasi segment
    // reload_review_segment()

    // // ketika load segment, re-initialize call function-nya
    // function reload_review_segment() {
    //     $('#review-progress-wrapper').load(' #review-progress', function() {
    //         // reinitiate modal after load
    //         initFlatpickrModal()
    //     });
    // }

    // mulai pracetak
    $('#preprint-progress-wrapper').on('click', '#btn-start-preprint', function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('print_order/api_start_progress/'); ?>" + print_order_id,
            datatype: "JSON",
            data: {
                progress: 'preprint'
            },
            success: function(res) {
                showToast(true, res.data);
            },
            error: function(err) {
                showToast(false, err.responseJSON.message);
            },
            complete: function() {
                // reload segmen review
                // reload_review_segment()
                // reload progress
                $('#progress-list-wrapper').load(' #progress-list');
                // reload data draft
                $('#print-data-wrapper').load(' #print-data');
                // reload preprint
                $('#preprint-progress-wrapper').load(' #preprint-progress');
            },
        })
    })

    // selesai pracetak
    $('#preprint-progress-wrapper').on('click', '#btn-finish-preprint', function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('print_order/api_finish_progress/'); ?>" + print_order_id,
            datatype: "JSON",
            data: {
                progress: 'preprint'
            },
            success: function(res) {
                showToast(true, res.data);
            },
            error: function(err) {
                showToast(false, err.responseJSON.message);
            },
            complete: function() {
                // reload segmen review
                // reload_review_segment()
                // reload progress
                $('#progress-list-wrapper').load(' #progress-list');
                // reload data draft
                $('#print-data-wrapper').load(' #print-data');
                // reload preprint
                $('#preprint-progress-wrapper').load(' #preprint-progress');
            },
        })
    })
})
</script>
