<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>"><span class="fa fa-home"></span></a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('invoice'); ?>">Faktur</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-muted">Form</a>
            </li>
        </ol>
    </nav>
</header>
<div class="page-section">
    <div class="row">
        <div class="col-md-12">
            <section class="card">
                <div class="card-body">
                    <form
                        action="<?= base_url("invoice/add_invoice"); ?>"
                        method="post"
                    >
                        <fielsdet>
                            <legend>Form Tambah Faktur</legend>
                            <div class="form-group">
                                <label
                                    for="number"
                                    class="font-weight-bold"
                                >Nomor Faktur<abbr title="Required">*</abbr></label>
                                <input
                                    type="text"
                                    name="number"
                                    id="number"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label
                                    for="customer_name"
                                    class="font-weight-bold"
                                >Nama Customer<abbr title="Required">*</abbr></label>
                                <input
                                    type="text"
                                    name="customer_name"
                                    id="customer_name"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label
                                    for="customer_number"
                                    class="font-weight-bold"
                                >No HP Customer<abbr title="Required">*</abbr></label>
                                <input
                                    type="text"
                                    name="customer_number"
                                    id="customer_number"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label
                                    for="due_date"
                                    class="font-weight-bold"
                                >Jatuh Tempo<abbr title="Required">*</abbr></label>
                                <input
                                    type="text"
                                    name="due_date"
                                    id="due_date"
                                    class="form-control"
                                />
                            </div>
                            </fieldset>
                            <hr class="my-4">
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <div id="prefetch">
                                        <label
                                            for="book_title"
                                            class="font-weight-bold"
                                        >Judul buku</label>
                                        <input
                                            type="text"
                                            name="book_title"
                                            id="book_title"
                                            class="form-control"
                                            placeholder="Cari judul buku"
                                        />
                                        <input
                                            type="hidden"
                                            name="book_id"
                                            id="book_id"
                                            class="form-control"
                                            value='0'
                                        />
                                    </div>
                                </div>
                                <script
                                    language="JavaScript"
                                    type="text/javascript"
                                    src="<?php echo base_url(); ?>assets/autocomplete/jquery.min.js"
                                ></script><!-- JQuery JS -->
                                <script
                                    language="JavaScript"
                                    type="text/javascript"
                                    src="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.min.js"
                                ></script><!-- JQuery UI JS -->
                                <script>
                                $(document).ready(function() {
                                    $("#book_title").autocomplete({
                                        source: function(request, response) {
                                            // Fetch data
                                            $.ajax({
                                                url: "<?php echo base_url("$pages/ac_book_id"); ?>",
                                                type: 'post',
                                                dataType: "json",
                                                data: {
                                                    search: request.term
                                                },
                                                success: function(data) {
                                                    response(data);
                                                }
                                            });
                                        },
                                        select: function(event, ui) {
                                            // Set selection
                                            $('#book_title').val(ui.item.label); // display the selected text
                                            $('#book_id').val(ui.item.value); // save selected id to input
                                            return false;
                                        }
                                    });
                                });
                                </script>
                                <div class="form-group col-md-2">
                                    <label
                                        for="amount"
                                        class="font-weight-bold"
                                    >Jumlah</label>
                                    <input
                                        type="number"
                                        min="1"
                                        name="amount"
                                        id="amount"
                                        class="form-control"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label
                                        for="add_item"
                                        class="font-weight-bold"
                                    >Tambah Barang</label>
                                    <button
                                        type="button"
                                        id="add_item"
                                        name="add_item"
                                        class="form-control btn btn-primary text-white"
                                    >Tambah Barang</button>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th
                                                scope="col"
                                                style="width:40%;"
                                            >Judul Buku</th>
                                            <th
                                                scope="col"
                                                style="width:15%;"
                                            >Harga</th>
                                            <th
                                                scope="col"
                                                style="width:15%;"
                                            >Jumlah</th>
                                            <th
                                                scope="col"
                                                style="width:15%;"
                                            >Total</th>
                                            <th
                                                scope="col"
                                                style="width:15%;"
                                            >&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody id="invoice_items">
                                        <!-- Items -->
                                    </tbody>
                                </table>
                            </div>

                            <!-- button -->
                            <input
                                type="submit"
                                class="btn btn-primary"
                                value="Submit"
                            />
                            <a
                                class="btn btn-secondary"
                                href="<?= base_url($pages); ?>"
                                role="button"
                            >Back</a>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // var count = 0;

    function dynamic_field() {
        html = '<tr class="text-center">';
        //html += '<td>' + count + '</td>';
        html += '<td><input type="text" disabled name="book_title[]" class="form-control" value="' + document.getElementById('book_title').value + '"/>'
        html += '<input type="text" hidden disabled name="book_id[]" class="form-control" value="' + document.getElementById('book_id').value + '"/></td>'
        html += '<td>Harga</td>';
        html += '<td><input type="number" disabled name="amount[]" class="form-control" value="' + document.getElementById('amount').value + '"/></td>';
        html += '<td>Total</td>';
        html += '<td><button type="button" class="btn btn-danger remove">Hapus</button></td></tr>';

        $('#invoice_items').append(html);
    }

    $(document).on('click', '#add_item', function() {
        // count++;
        // alert("NGAWUR");
        dynamic_field();
    });

    $(document).on('click', '.remove', function() {
        // count--;
        // alert("GOBLOG");
        $(this).closest("tr").remove();
    });

});
</script>
