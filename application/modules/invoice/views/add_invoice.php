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
                    <?php echo form_open('invoice/add_invoice'); ?>
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
                    <!-- <div class="form-group">
                        <label
                            for="customer-name"
                            class="font-weight-bold"
                        >Nama Customer<abbr title="Required">*</abbr></label>
                        <input
                            type="text"
                            name="customer-name"
                            id="customer-name"
                            class="form-control"
                        />
                    </div> -->
                    <div class="form-group">
                        <label
                            for="customer-id"
                            class="font-weight-bold"
                        >No HP Customer<abbr title="Required">*</abbr></label>
                        <input
                            type="text"
                            name="customer-id"
                            id="customer-id"
                            class="form-control"
                        />
                    </div>
                    <div class="form-group">
                        <label
                            for="due-date"
                            class="font-weight-bold"
                        >
                            Jatuh Tempo
                            <abbr title="Required">*</abbr></label>
                        <div class="input-group mb-3">
                            <input
                                name="due-date"
                                id="due-date"
                                class="form-control dates"
                            />
                            <div class="input-group-append">
                                <button
                                    class="btn btn-outline-secondary"
                                    type="button"
                                    id="due_clear"
                                >Clear</button>
                            </div>
                        </div>
                        <?= form_error('due_date'); ?>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="form-group col-md-8">
                            <!-- <input
                                            type="text"
                                            name="book-title"
                                            id="book-title"
                                            class="form-control"
                                            placeholder="Cari judul buku"
                                        />
                                        <input
                                            type="hidden"
                                            name="book-id"
                                            id="book-id"
                                            class="form-control"
                                            value='0'
                                        /> -->
                            <label
                                for="book_id"
                                class="font-weight-bold"
                            >Judul buku</label>
                            <?= form_dropdown('book_id', get_dropdown_list_book(), 0, 'id="book-id" class="form-control custom-select d-block"'); ?>
                        </div>
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
                                value="1"
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

    $("#book-id").select2({
        placeholder: '-- Pilih --',
        allowClear: true,
        dropdownParent: $('#app-main')
    });

    function add_book_to_invoice() {
        var bookId = document.getElementById('book-id');

        html = '<tr class="text-center">';

        // Judul option yang di select
        html += '<td class="align-middle text-left font-weight-bold">' + bookId.options[bookId.selectedIndex].text;
        html += '<input type="text" hidden disabled name="book_id[]" class="form-control" value="' + bookId.value + '"/>';
        html += '</td>';

        html += '<td class="align-middle">Harga</td>';

        html += '<td class="align-middle">' + document.getElementById('amount').value;
        html += '<input type="number" hidden disabled name="amount[]" class="form-control" value="' + document.getElementById('amount').value + '"/>';
        html += '</td>';

        html += '<td class="align-middle">Total</td>';

        html += '<td class="align-middle"><button type="button" class="btn btn-danger remove">Hapus</button></td></tr>';

        $('#invoice_items').append(html);
    }

    function reset_book() {

        document.getElementById('amount').value = 1;
        $("#book-id").val('').trigger('change')

    }

    $(document).on('click', '#add_item', function() {
        // Judul buku harus dipilih
        if (document.getElementById('book-id').value === '') {
            alert("Silakan Pilih Judul Buku!");
            return
        }
        // Jumlah buku harus diisi
        if (!(document.getElementById('amount').value > 0)) {
            alert("Jumlah Buku Minimal = 1!");
            return
        } else {
            add_book_to_invoice();
            reset_book();
        }
    });

    $(document).on('click', '.remove', function() {
        $(this).closest("tr").remove();
    });

    const $flatpickr = $('.dates').flatpickr({
        altInput: true,
        altFormat: 'j F Y',
        dateFormat: 'Y-m-d',
        enableTime: false
    });

    $("#due_clear").click(function() {
        $flatpickr.clear();
    })

});
</script>
