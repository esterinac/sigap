<?php
$username      = ucwords($this->session->userdata('username'));
$level         = check_level();
$level_to_text = ucwords(str_replace('_', ' ', $level));
$level_native  = $this->session->userdata('level_native');
?>

<header class="app-header app-header-dark">
    <div class="top-bar">
        <div class="top-bar-brand">
            <a href="<?php echo base_url(); ?>">
                <span
                    class="badge badge-warning"
                    style="font-size: 0.8em"
                >SIGAP <small>v2</small></span>
            </a>
        </div>

        <div class="top-bar-list">
            <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
                <button
                    class="hamburger hamburger-squeeze"
                    type="button"
                    data-toggle="aside"
                    aria-label="toggle menu"
                ><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
            </div>
            <div class="top-bar-item top-bar-item-right px-0">
                <ul class="header-nav nav">
                    <!-- <li class="nav-item dropdown header-nav-dropdown has-notified">
                        <a
                            class="nav-link has-badge"
                            href="#"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        ><span class="badge badge-pill badge-warning">1</span> <span class="fa fa-bell"></span></a>
                        <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
                            <div class="dropdown-arrow"></div>
                            <h6 class="dropdown-header stop-propagation">
                                <span>Notifikasi <span class="badge">(1)</span></span>
                            </h6>
                            <div class="dropdown-scroll perfect-scrollbar">
                                <a
                                    href="#"
                                    class="dropdown-item unread"
                                >
                                    <div class="user-avatar">
                                        <img src="<?= base_url('assets/images/avatars/profile.jpg'); ?>">
                                    </div>
                                    <div class="dropdown-item-body">
                                        <p class="text"> placeholder notifikasi </p><span class="date">Just now</span>
                                    </div>
                                </a>
                            </div>
                            <a
                                href="#"
                                class="dropdown-footer"
                            >Semua notifikasi <i class="fas fa-fw fa-long-arrow-alt-right"></i></a>
                        </div>
                    </li> -->
                    <!-- <li class="nav-item dropdown header-nav-dropdown">
                        <a
                            class="nav-link"
                            href="#"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        ><span class="fa fa-grip-horizontal"></span></a>
                        <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
                            <div class="dropdown-arrow"></div>
                            <div class="dropdown-sheets">
                                <div class="dropdown-sheet-item">
                                    <a
                                        href="#"
                                        class="tile-wrapper"
                                    ><span class="tile tile-lg bg-indigo"><i class="fa fa-users"></i></span> <span class="tile-peek">Teams</span></a>
                                </div>
                            </div>
                        </div>
                    </li> -->
                </ul>

                <div class="dropdown d-none d-sm-flex">
                    <button
                        class="btn-account"
                        type="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <span class="user-avatar user-avatar-md">
                            <img
                                src="<?= base_url('assets/images/avatars/profile.jpg'); ?>"
                                alt=""
                            >
                        </span>
                        <span class="account-summary pr-md-4 d-none d-md-block">
                            <span class="account-name"><?= $username; ?></span>
                            <span class="account-description"><?= $level_to_text; ?></span>
                        </span>
                    </button>
                    <div class="dropdown-menu">
                        <div
                            class="dropdown-arrow d-lg-none"
                            x-arrow=""
                        ></div>
                        <div class="dropdown-arrow ml-3 d-none d-lg-block"></div>
                        <h6 class="dropdown-header d-none d-sm-block d-md-none"> <?= $username; ?> </h6>

                        <?php if ($level_native == 'author_reviewer') : ?>
                            <?php if ($level == 'author') : ?>
                                <a
                                    class="dropdown-item"
                                    href="<?= base_url('auth/multilevel/reviewer'); ?>"
                                >
                                    <span class="dropdown-icon fa fa-sign-in-alt"></span> Masuk sebagai Reviewer</a>
                            <?php else : ?>
                                <a
                                    class="dropdown-item"
                                    href="<?= base_url('auth/multilevel/author'); ?>"
                                >
                                    <span class="dropdown-icon fa fa-sign-in-alt"></span> Masuk sebagai Author</a>
                            <?php endif; ?>
                            <div class="dropdown-divider"></div>
                        <?php endif; ?>

                        <a
                            class="dropdown-item"
                            href="<?= base_url('auth/change_email'); ?>"
                        >
                            <span class="dropdown-icon fa fa-envelope"></span> Ubah Email</a>
                        <a
                            class="dropdown-item"
                            href="<?= base_url('auth/change_password'); ?>"
                        >
                            <span class="dropdown-icon fa fa-cog"></span> Ubah Password</a>
                        <a
                            class="dropdown-item"
                            href="<?= base_url('auth/logout'); ?>"
                        >
                            <span class="dropdown-icon fa fa-sign-out-alt"></span> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
