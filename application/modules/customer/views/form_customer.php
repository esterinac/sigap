<?php
$is_add_customer = $this->uri->segment(2) == 'add';
?>

<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url(); ?>"><span class="fa fa-home"></span></a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('customer'); ?>">Customer</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-muted">Form</a>
            </li>
        </ol>
    </nav>
</header>
<div class="page-section">
    <div class="row">
        <div class="col-lg-8">
            <section class="card">
                <div class="card-body">
                    <?= form_open($form_action, 'id="form_customer" novalidate=""'); ?>
                    <fieldset>
                        <legend>Form Customer</legend>
                        <?= isset($input->customer_id) ? form_hidden('customer_id', $input->customer_id) : ''; ?>
                        <div class="form-group">
                            <label for="name">
                                <?= $this->lang->line('form_customer_name'); ?>
                                <abbr title="Required">*</abbr>
                            </label>
                            <?= form_input('name', $input->name, 'class="form-control" id="name"'); ?>
                            <?= form_error('name'); ?>
                        </div>
                        <div class="form-group">
                            <label for="address">
                                <?= $this->lang->line('form_customer_address'); ?>
                                <abbr title="Required">*</abbr>
                            </label>
                            <?= form_input('address', $input->address, 'class="form-control" id="address"'); ?>
                            <?= form_error('address'); ?>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">
                                <?= $this->lang->line('form_customer_phone_number'); ?>
                                <abbr title="Required">*</abbr>
                            </label>
                            <?= form_input('phone_number', $input->phone_number, 'class="form-control" id="phone_number"'); ?>
                            <?= form_error('phone_number'); ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <?= $this->lang->line('form_customer_type'); ?>
                                        <abbr title="Required">*</abbr>
                                    </label>
                                    <?php foreach (get_customer_types() as $type) : ?>
                                        <div class="custom-control custom-radio">
                                            <?= form_radio('type', $type, isset($input->type) && ($input->type == $type) ? true : false, ' class="custom-control-input" id="' . $type . '"'); ?>
                                            <label
                                                class="custom-control-label"
                                                for="<?= $type; ?>"
                                            ><?= ucwords(str_replace('_', ' ', $type)); ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                    <?= form_error('type'); ?>
                                </div>
                            </div>
                            <!-- <?php if (!$is_add_user) : ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <?= $this->lang->line('form_user_is_blocked'); ?>
                                            <abbr title="Required">*</abbr>
                                        </label>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <?= form_radio('is_blocked', 'n', isset($input->is_blocked) && ($input->is_blocked == 'n') ? true : false, ' class="custom-control-input" id="category_status1"'); ?>
                                                <label
                                                    class="custom-control-label"
                                                    for="category_status1"
                                                >Aktif</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <?= form_radio('is_blocked', 'y', isset($input->is_blocked) && ($input->is_blocked == 'y') ? true : false, 'class="custom-control-input" id="category_status2"'); ?>
                                                <label
                                                    class="custom-control-label"
                                                    for="category_status2"
                                                >Nonaktif</label>
                                            </div>
                                            <?= form_error('is_blocked'); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?> -->
                        </div>
                        <hr>
                    </fieldset>
                    <hr>
                    <div class="form-actions">
                        <button
                            class="btn btn-primary ml-auto"
                            type="submit"
                        >Submit</button>
                    </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- <script>
$(document).ready(function() {
    loadValidateSetting();

    isAddUser = '<?= $is_add_user ?>'
    $("#form_user").validate({
            rules: {
                username: {
                    crequired: true,
                    username: true,
                },,
                type: "crequired"
            },
            errorElement: "span",
            errorPlacement: validateErrorPlacement
        },
        validateSelect2()
    );
    console.log(isAddUser);
})
</script> -->
