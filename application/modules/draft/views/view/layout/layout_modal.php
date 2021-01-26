<?php $level = check_level() ?>
<div
    class="modal fade"
    id="modal-layout"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modal-layout"
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
                id="layout-tab-wrapper"
                role="tablist"
            >
                <li class="nav-item">
                    <a
                        class="nav-link active"
                        id="layout-file-tab"
                        data-toggle="tab"
                        href="#layout-file-tab-content"
                        role="tab"
                        aria-controls="layout-file-tab-content"
                        aria-selected="true"
                    ><i class="far fa-file-alt"></i> File</a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="layout-comment-tab"
                        data-toggle="tab"
                        href="#layout-comment-tab-content"
                        role="tab"
                        aria-controls="layout-comment-tab-content"
                        aria-selected="false"
                    ><i class="far fa-comments"></i> Tanggapan</a>
                </li>
            </ul>

            <div class="modal-body py-3">
                <div
                    class="tab-content"
                    id="layout-tab-content-wrapper"
                >
                    <div
                        class="tab-pane fade show active"
                        id="layout-file-tab-content"
                        role="tabpanel"
                        aria-labelledby="layout-file-tab"
                    >
                        <?php $this->load->view('draft/view/common/file_section', ['progress' => 'layout']) ?>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="layout-comment-tab-content"
                        role="tabpanel"
                        aria-labelledby="layout-comment-tab"
                    >
                        <div id="layout-comment-info">
                            <fieldset>
                                <!-- CATATAN LAYOUTER UNTUK STAFF/ADMIN/AUTHOR -->
                                <?php if ($level != 'author') : ?>
                                    <div class="form-group">
                                        <label
                                            for="layouter-layout-notes"
                                            class="badge badge-primary"
                                        >Catatan Layouter</label>
                                        <?php
                                        if (!is_admin() && $level != 'layouter' || $is_final) {
                                            echo "<div>" . $input->layout_notes . "</div>";
                                        } else {
                                            echo form_textarea([
                                                'name'  => "layouter-layout-notes",
                                                'class' => 'form-control',
                                                'id'    => "layouter-layout-notes",
                                                'rows'  => '6',
                                                'value' => $input->layout_notes
                                            ]);
                                        }
                                        ?>
                                    </div>
                                    <hr class="my-3">
                                <?php endif; ?>

                                <!-- CATATAN AUTHOR UNTUK STAFF/ADMIN -->
                                <div class="form-group">
                                    <label
                                        for="author-layout-notes"
                                        class="badge badge-primary"
                                    >Catatan Penulis</label>
                                    <?php
                                    if (!is_admin() && ($level != 'author' || $author_order != 1) || $is_final) {
                                        echo "<div>" . $input->layout_notes_author . "</div>";
                                    } else {
                                        echo form_textarea([
                                            'name'  => "author-layout-notes",
                                            'class' => 'form-control',
                                            'id'    => "author-layout-notes",
                                            'rows'  => '6',
                                            'value' => $input->layout_notes_author
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
                                <?php if (!$is_final) : ?>
                                    <button
                                        id="btn-submit-layout"
                                        class="btn btn-primary"
                                        type="button"
                                    >Submit</button>
                                <?php endif ?>
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
    $('#layout-progress-wrapper').on('shown.bs.modal', `#modal-layout`, function() {
        initSummernote()

        // reload ketika modal diclose
        $(`#modal-layout`).off('hidden.bs.modal').on('hidden.bs.modal', function(e) {
            $('#layout-progress-wrapper').load(' #layout-progress', function() {
                // reinitiate flatpickr modal after load
                initFlatpickrModal()
            });
        })
    })

    // submit progress layout
    $('#layout-progress-wrapper').on('click', `#btn-submit-layout`, function() {
        const $this = $(this);

        const layoutData = {
            [`layout_notes`]: $(`#layouter-layout-notes`).val(),
            [`layout_notes_author`]: $(`#author-layout-notes`).val(),
        }

        $this.attr("disabled", "disabled").html("<i class='fa fa-spinner fa-spin '></i>");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('draft/api_update_draft/'); ?>" + draftId,
            datatype: "JSON",
            data: layoutData,
            success: function(res) {
                $(`#layout-comment-tab-content`).load(` #layout-comment-info`, function() {
                    showToast(true, res.data);
                    initSummernote()
                })
            },
            error: function(err) {
                console.log(err);
                showToast(false, err.responseJSON.message);
            },
        });
    });

    function initSummernote() {
        // inisiasi summernote
        $(`#layouter-layout-notes`).summernote(summernoteConfig)
        $(`#author-layout-notes`).summernote(summernoteConfig)
    }
})
</script>
