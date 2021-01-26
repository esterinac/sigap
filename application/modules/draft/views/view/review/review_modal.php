<?php $level = check_level() ?>
<?php
$all_criteria = [
    [
        'number' => 1,
        'title' => 'Substansi naskah (mencerminkan adanya kontribusi dan inovasi pada pengembangan iptek, seni, dan budaya)'
    ],
    [
        'number' => 2,
        'title' => 'Orisinalitas Karya dan bobot ilmiah'
    ],
    [
        'number' => 3,
        'title' => 'Kemutahiran Pustaka'
    ],
    [
        'number' => 4,
        'title' => 'Kelengkapan unsur (sebagai suatu naskah buku dan keterkaitan antarbab, sistematika)'
    ],
]

?>
<div
    class="modal fade"
    id="modal-<?= $progress ?>"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modal-<?= $progress ?>"
    aria-hidden="true"
>
    <div
        class="modal-dialog modal-lg modal-dialog-overflow"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Progress <?= $progress == 'review1' ? 'Review #1' : 'Review #2' ?> </h5>
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
                id="<?= $progress ?>-tab-wrapper"
                role="tablist"
            >
                <li class="nav-item">
                    <a
                        class="nav-link active"
                        id="<?= $progress ?>-file-tab"
                        data-toggle="tab"
                        href="#<?= $progress ?>-file-tab-content"
                        role="tab"
                        aria-controls="<?= $progress ?>-file-tab-content"
                        aria-selected="true"
                    ><i class="far fa-file-alt"></i> File</a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="<?= $progress ?>-comment-tab"
                        data-toggle="tab"
                        href="#<?= $progress ?>-comment-tab-content"
                        role="tab"
                        aria-controls="<?= $progress ?>-comment-tab-content"
                        aria-selected="false"
                    ><i class="far fa-comments"></i> Tanggapan</a>
                </li>
                <?php if ($level != 'author') : ?>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            id="<?= $progress ?>-score-tab"
                            data-toggle="tab"
                            href="#<?= $progress ?>-score-tab-content"
                            role="tab"
                            aria-controls="<?= $progress ?>-score-tab-content"
                            aria-selected="false"
                        > <i class="fas fa-file-signature"></i> Penilaian</a>
                    </li>
                <?php endif ?>
            </ul>

            <div class="modal-body py-3">
                <div
                    class="tab-content"
                    id="<?= $progress ?>-tab-content-wrapper"
                >
                    <div
                        class="tab-pane fade show active"
                        id="<?= $progress ?>-file-tab-content"
                        role="tabpanel"
                        aria-labelledby="<?= $progress ?>-file-tab"
                    >
                        <!-- $progress review ada dua: review1 dan review2, menggunakan modal review ini  -->
                        <?php $this->load->view('draft/view/common/file_section', ['progress' => $progress]) ?>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="<?= $progress ?>-comment-tab-content"
                        role="tabpanel"
                        aria-labelledby="<?= $progress ?>-comment-tab"
                    >
                        <div id="<?= $progress ?>-comment-section">
                            <fieldset>
                                <!-- CATATAN REVIEWER UNTUK STAFF/ADMIN -->
                                <?php if (is_staff() || $level == 'reviewer') : ?>
                                    <div class="form-group">
                                        <label
                                            for="reviewer-<?= $progress ?>-notes"
                                            class="badge badge-primary"
                                        >Catatan Reviewer</label>
                                        <?php
                                        if (!is_admin() && $level != 'reviewer' || $is_final) {
                                            echo "<div>" . $input->{"{$progress}_notes"} . "</div>";
                                        } else {
                                            echo form_textarea([
                                                'name'  => "reviewer-{$progress}-notes",
                                                'class' => 'form-control',
                                                'id'    => "reviewer-{$progress}-notes",
                                                'rows'  => '6',
                                                'value' => $input->{"{$progress}_notes"},
                                            ]);
                                        }
                                        ?>
                                    </div>
                                    <hr class="my-3">
                                <?php endif; ?>

                                <!-- CATATAN ADMIN UNTUK AUTHOR -->
                                <?php if (is_staff() || $level == 'author') : ?>
                                    <div class="form-group">
                                        <label
                                            for="admin-<?= $progress ?>-notes"
                                            class="badge badge-primary"
                                        >Catatan Admin</label>
                                        <?php
                                        if (!is_admin() && $level != 'reviewer' || $is_final) {
                                            echo "<div>" . $input->{"{$progress}_notes_admin"} . "</div>";
                                        } else {
                                            echo form_textarea([
                                                'name'  => "admin-{$progress}-notes",
                                                'class' => 'form-control',
                                                'id'    => "admin-{$progress}-notes",
                                                'rows'  => '6',
                                                'value' => $input->{"{$progress}_notes_admin"},
                                            ]);
                                        }
                                        ?>
                                    </div>
                                    <hr class="my-3">
                                <?php endif; ?>

                                <?php if (is_staff() || $level == 'author') : ?>
                                    <div class="form-group">
                                        <label
                                            for="author-<?= $progress ?>-notes"
                                            class="badge badge-primary"
                                        >Catatan Penulis</label>
                                        <?php
                                        if (!is_admin() && ($level != 'author' || $author_order != 1) || $is_final) {
                                            echo "<div>" . $input->{"{$progress}_notes_author"} . "</div>";
                                        } else {
                                            echo form_textarea([
                                                'name'  => "author-{$progress}-notes",
                                                'class' => 'form-control',
                                                'id'    => "author-{$progress}-notes",
                                                'rows'  => '6',
                                                'value' => $input->{"{$progress}_notes_author"}
                                            ]);
                                        }
                                        ?>
                                    </div>
                                <?php endif ?>
                            </fieldset>

                            <div class="d-flex justify-content-end">
                                <button
                                    type="button"
                                    class="btn btn-light ml-auto"
                                    data-dismiss="modal"
                                >Close</button>
                                <?php if (!$is_final) : ?>
                                    <button
                                        id="btn-submit-comment-<?= $progress ?>"
                                        class="btn btn-primary"
                                        type="button"
                                    >Submit</button>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($level != 'author') : ?>
                        <div
                            class="tab-pane fade"
                            id="<?= $progress ?>-score-tab-content"
                            role="tabpanel"
                            aria-labelledby="<?= $progress ?>-score-tab"
                        >
                            <div id="<?= $progress ?>-score-section">
                                <p class="font-weight-bold">KONTEN REVIEW</p>
                                <?= isset($input->draft_id) ? form_hidden('draft_id', $input->draft_id) : ''; ?>
                                <?php foreach ($all_criteria as $criteria_key => $criteria) : ?>
                                    <div class="alert alert-info">
                                        <!-- bagian text area -->
                                        <label class="font-weight-bold"><?= $criteria['title'] ?></label>
                                        <?php if (!$is_final) : ?>
                                            <textarea
                                                type="textarea"
                                                name="<?= "criteria{$criteria['number']}-{$progress}" ?>"
                                                id="<?= "criteria{$criteria['number']}-{$progress}" ?>"
                                                class="form-control"
                                                rows="6"
                                            ><?= $input->{"{$progress}_criteria{$criteria['number']}"} ?></textarea>
                                        <?php else : ?>
                                            <?= $input->{"{$progress}_criteria{$criteria['number']}"} ?>
                                        <?php endif ?>

                                        <hr class="my-3">

                                        <!-- bagian nilai -->
                                        <p class="m-0 p-0">Nilai</p>
                                        <?php if (!$is_final) : ?>
                                            <?php for ($j = 1; $j <= 5; $j++) :  ?>
                                                <div class="custom-control custom-control-inline custom-radio">
                                                    <input
                                                        id="<?= "score{$j}-criteria{$criteria['number']}-{$progress}" ?>"
                                                        name="<?= "score-criteria{$criteria['number']}-{$progress}" ?>"
                                                        value="<?= $j ?>"
                                                        type="radio"
                                                        class="custom-control-input"
                                                        <?= $input->{"{$progress}_score"} && $input->{"{$progress}_score"}[$criteria_key] == $j ? 'checked' : '' ?>
                                                    />
                                                    <label
                                                        class="custom-control-label"
                                                        for="<?= "score{$j}-criteria{$criteria['number']}-{$progress}" ?>"
                                                    ><?= $j ?></label>
                                                </div>
                                            <?php endfor ?>
                                        <?php else : ?>
                                            <span class="font-weight-bold"><?= $input->{"{$progress}_score"} ? $input->{"{$progress}_score"}[$criteria_key] : null ?></span>
                                        <?php endif ?>
                                    </div>
                                <?php endforeach ?>

                                <?php if ($input->{"{$progress}_flag"}) : ?>
                                    <div id="nilai-wrapper">
                                        <div class="alert <?= $input->{"{$progress}_total_score"} >= 400 ? 'alert-success' : 'alert-danger' ?>">
                                            <?php
                                            if ($input->{"{$progress}_total_score"} >= 400) {
                                                echo '<p class="badge badge-success">Naskah Lolos Review</p>';
                                            } else {
                                                echo '<p class="badge badge-danger">Naskah Tidak Lolos Review</p>';
                                            }
                                            ?>

                                            <p class="mb-0">
                                                <span>Nilai total :</span>
                                                <strong><?= $input->{"{$progress}_total_score"} ?></strong>
                                            </p>
                                            <p class="mb-0">Passing Grade = 400</p>
                                        </div>
                                    </div>
                                <?php endif ?>

                                <?php if ((is_admin() || $level == 'reviewer') && !$is_final) : ?>
                                    <div class="card-footer-content p-0 m-0">
                                        <div class="mb-1 font-weight-bold">Rekomendasi</div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input
                                                type="radio"
                                                name="<?= $progress ?>-flag"
                                                id="<?= $progress ?>-flag-accept"
                                                class="custom-control-input"
                                                value="y"
                                                <?= $input->{"{$progress}_flag"} == 'y' ? 'checked' : ''  ?>
                                            />
                                            <label
                                                class="custom-control-label"
                                                for="<?= $progress ?>-flag-accept"
                                            >Setuju</label>
                                        </div>

                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input
                                                type="radio"
                                                name="<?= $progress ?>-flag"
                                                id="<?= $progress ?>-flag-decline"
                                                class="custom-control-input"
                                                value="n"
                                                <?= $input->{"{$progress}_flag"} == 'n' ? 'checked' : ''  ?>
                                            />
                                            <label
                                                class="custom-control-label"
                                                for="<?= $progress ?>-flag-decline"
                                            >Tolak</label>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="d-flex justify-content-end">
                                    <button
                                        type="button"
                                        class="btn btn-light ml-auto"
                                        data-dismiss="modal"
                                    >Close</button>
                                    <?php if (!$is_final) : ?>
                                        <button
                                            id="btn-submit-score-<?= $progress ?>"
                                            class="btn btn-primary"
                                            type="button"
                                        >Submit</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // identifier = review1 | review2
    const identifier = '<?= $progress ?>'
    const draftId = $('[name=draft_id]').val();

    // reload segmen ketika modal diclose
    $('#review-progress-wrapper').on('shown.bs.modal', `#modal-${identifier}`, function() {
        initSummernote(identifier)

        // reload ketika modal diclose
        $(`#modal-${identifier}`).off('hidden.bs.modal').on('hidden.bs.modal', function() {
            $('#review-progress-wrapper').load(' #review-progress', function() {
                // reinitiate flatpickr modal after load
                initFlatpickrModal()
            });
        })
    })

    // submit score review
    $('#review-progress-wrapper').on('click', `#btn-submit-score-${identifier}`, function() {
        // nilai kriteria
        let nilai = [];
        for (let k = 1; k <= 4; k++) {
            nilai.push($(`[name=score-criteria${k}-${identifier}]:checked`).val() || 0)
        }
        nilai = nilai.join()

        const reviewData = {
            [`${identifier}_flag`]: $(`[name=${identifier}-flag]:checked`).val(),
            [`${identifier}_criteria1`]: $(`#criteria1-${identifier}`).val(),
            [`${identifier}_criteria2`]: $(`#criteria2-${identifier}`).val(),
            [`${identifier}_criteria3`]: $(`#criteria3-${identifier}`).val(),
            [`${identifier}_criteria4`]: $(`#criteria4-${identifier}`).val(),
            [`${identifier}_score`]: nilai
        }

        sendData(reviewData, 'score', $(this))
    });


    // submit comment review
    $('#review-progress-wrapper').on('click', `#btn-submit-comment-${identifier}`, function() {
        const reviewData = {
            [`${identifier}_notes`]: $(`#reviewer-${identifier}-notes`).val(),
            [`${identifier}_notes_author`]: $(`#author-${identifier}-notes`).val(),
            [`${identifier}_notes_admin`]: $(`#admin-${identifier}-notes`).val(),
        }

        sendData(reviewData, 'comment', $(this))
    });

    // send data ke server
    function sendData(reviewData, type, self) {
        // type: score || comment
        self.attr("disabled", "disabled").html("<i class='fa fa-spinner fa-spin '></i>");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('draft/api_update_draft/'); ?>" + draftId,
            datatype: "JSON",
            data: reviewData,
            success: function(res) {
                $(`#${identifier}-${type}-tab-content`).load(` #${identifier}-${type}-section`, function() {
                    showToast(true, res.data);
                    initSummernote(identifier)
                })
            },
            error: function(err) {
                console.log(err);
                showToast(false, err.responseJSON.message);
                self.removeAttr("disabled").html("Submit");
            },
        });
    }

    function initSummernote(identifier) {
        // inisiasi summernote
        $(`#reviewer-${identifier}-notes`).summernote(summernoteConfig)
        $(`#admin-${identifier}-notes`).summernote(summernoteConfig)
        $(`#author-${identifier}-notes`).summernote(summernoteConfig)
    }
})
</script>
