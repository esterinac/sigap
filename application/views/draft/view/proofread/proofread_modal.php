<?php $level = check_level() ?>
<div
    class="modal fade"
    id="modal-proofread"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modal-proofread"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-overflow">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Progress Layout</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <ul
                class="nav nav-tabs"
                id="proofread-tab-wrapper"
                role="tablist"
            >
                <li class="nav-item">
                    <a
                        class="nav-link active"
                        id="proofread-file-tab"
                        data-toggle="tab"
                        href="#proofread-file-tab-content"
                        role="tab"
                        aria-controls="proofread-file-tab-content"
                        aria-selected="true"
                    >File</a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="proofread-comment-tab"
                        data-toggle="tab"
                        href="#proofread-comment-tab-content"
                        role="tab"
                        aria-controls="proofread-comment-tab-content"
                        aria-selected="false"
                    >Tanggapan</a>
                </li>
            </ul>

            <div class="modal-body py-3">
                <div
                    class="tab-content"
                    id="proofread-tab-content-wrapper"
                >
                    <div
                        class="tab-pane fade show active"
                        id="proofread-file-tab-content"
                        role="tabpanel"
                        aria-labelledby="proofread-file-tab"
                    >
                        <?php $this->load->view('draft/view/common/file_section', ['progress' => 'proofread']) ?>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="proofread-comment-tab-content"
                        role="tabpanel"
                        aria-labelledby="proofread-comment-tab"
                    >
                        <div id="proofread-comment-info">
                            <fieldset>
                                <!-- CATATAN LAYOUTER UNTUK STAFF/ADMIN/AUTHOR -->
                                <?php if ($level != 'author') : ?>
                                    <div class="form-group">
                                        <label
                                            for="proofreader-proofread-notes"
                                            class="font-weight-bold"
                                        >Catatan Layouter untuk Admin</label>
                                        <?php
                                        if (!is_admin() && $level != 'proofreader') {
                                            echo "<div class='font-italic' id='proofreader-proofread-notes'>" . $input->proofread_notes . "</div>";
                                        } else {
                                            echo form_textarea([
                                                'name'  => "proofreader-proofread-notes",
                                                'class' => 'form-control summernote-basic',
                                                'id'    => "proofreader-proofread-notes",
                                                'rows'  => '6',
                                                'value' => $input->proofread_notes
                                            ]);
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>

                                <hr class="my-3">

                                <!-- CATATAN AUTHOR UNTUK STAFF/ADMIN -->
                                <div class="form-group">
                                    <label
                                        for="author-proofread-notes"
                                        class="font-weight-bold"
                                    >Catatan Penulis</label>
                                    <?php
                                    if (!is_admin() && ($level != 'author' || $author_order != 1)) {
                                        echo "<div class='font-italic' id='author-proofread-notes'>" . $input->proofread_notes_author . "</div>";
                                    } else {
                                        echo form_textarea([
                                            'name'  => "author-proofread-notes",
                                            'class' => 'form-control summernote-basic',
                                            'id'    => "author-proofread-notes",
                                            'rows'  => '6',
                                            'value' => $input->proofread_notes_author

                                        ]);
                                    }
                                    ?>
                                </div>
                            </fieldset>

                            <div class="d-flex justify-content-end">
                                <button
                                    type="button"
                                    class="btn btn-light ml-auto"
                                    data-dismiss="modal"
                                >Close</button>
                                <button
                                    id="btn-submit-proofread"
                                    class="btn btn-primary"
                                    type="button"
                                >Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const draftId = $('[name=draft_id]').val();

    // reload segmen ketika modal diclose
    $('#proofread-progress-wrapper').on('shown.bs.modal', `#modal-proofread`, function() {
        // reload ketika modal diclose
        $(`#modal-proofread`).off('hidden.bs.modal').on('hidden.bs.modal', function(e) {
            $('#proofread-progress-wrapper').load(' #proofread-progress', function() {
                // reinitiate flatpickr modal after load
                init_flatpickr_modal()
            });
        })
    })

    // submit progress proofread
    $('#proofread-progress-wrapper').on('click', `#btn-submit-proofread`, function() {
        const $this = $(this);

        const proofreadData = {
            [`proofread_notes`]: $(`#proofreader-proofread-notes`).val(),
            [`proofread_notes_author`]: $(`#author-proofread-notes`).val(),
        }

        $this.attr("disabled", "disabled").html("<i class='fa fa-spinner fa-spin '></i>");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('draft/api_update_draft/'); ?>" + draftId,
            datatype: "JSON",
            data: proofreadData,
            success: function(res) {
                console.log(res);
                show_toast(true, res.data);
                $(`#proofread-comment-tab-content`).load(` #proofread-comment-info`)
            },
            error: function(err) {
                console.log(err);
                show_toast(false, err.responseJSON.message);
            },
        });
    });
})
</script>
