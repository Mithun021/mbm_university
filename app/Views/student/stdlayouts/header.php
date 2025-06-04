<?php
$sessionData = session()->get('loggedStudentData');
if ($sessionData) {
    $LoggedStudentName = $sessionData['loggedstudentName'];
    $loggedstudentId = $sessionData['loggedstudentId'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>NIPER - <?= $title ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="NIPER" name="description" />
    <meta content="Dcode Materials" name="author" />
    <meta content="Dcode Materials" name="developer" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>public/assets/images/favicon.png">
    <!-- Dropify css -->
    <link href="<?= base_url() ?>public/admin/plugins/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="<?= base_url() ?>public/admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>public/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>public/admin/assets/css/theme1.min.css" rel="stylesheet" type="text/css" />

    <!-- Plugins css -->
    <link href="<?= base_url() ?>public/admin/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>public/admin/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>public/admin/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>public/admin/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- jQuery UI Stylesheet (for sortable styling) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Include the Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred {
                height: 250px;
            } */
        form span {
            color: #000;
            font-weight: 400;
        }

        #addServicetable #stockTbody #stockTrow:first-child td:last-child button {
            display: none;
        }

        ul#tableList {
            margin: 0;
            padding: 0;
        }

        .select2-container {
            width: 100% !important;
            /* Make the Select2 container take 100% width */
        }

        .select2-selection {
            height: 30px !important;
            /* Set the height of the selected item */
            line-height: 30px;
            /* Adjust line-height to vertically center the text */
        }

        .select2-selection__rendered {
            padding-top: 7px;
            /* Adjust padding to ensure text is centered */
        }

        .select2-container--default .select2-selection--single {
            border-radius: 4px;
            /* Optional: Add border radius for styling */
            border: 1px solid #ccc;
            /* Optional: Border styling */
        }

        .select2-dropdown {
            max-width: 100% !important;
            /* Make the dropdown width 100% */
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #000000;
            border: 1px solid #000000;
            border-radius: 4px;
            cursor: default;
            float: left;
            margin-right: 5px;
            margin-top: 1px;
            padding: 0 5px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <span id="base_url" class="d-none"><?= base_url() ?></span>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <div class="header-border"></div>
        <header id="page-topbar">
            <div class="navbar-header">

                <div class="d-flex align-items-left">
                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>


                </div>

                <div class="d-flex align-items-center">
                    <div class="dropdown d-inline-block ml-2">
                        <button type="button" class="btn header-item waves-effect"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="<?= base_url() ?>public/assets/image/avatar.png"
                                alt="Header Avatar">
                            <span class="d-none d-sm-inline-block ml-1"><?php if ($sessionData) {
                                                                            echo $LoggedStudentName;
                                                                        }  ?></span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                <span>Profile</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="<?= base_url() ?>student/logout">
                                <span>Log Out</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <div class="navbar-brand-box">
                    <a href="<?= base_url() ?>admin/" class="logo">
                        <img src="<?= base_url() ?>public/assets/images/logo-main.png" alt="" height="50">
                        <!-- <span>
                                    TANA BHAGAT CLG
                                </span> -->
                    </a>
                </div>

                <!--- Sidemenu -->

                <?= view('student/stdlayouts/sidebar') ?>

                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">NIPER</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active"><?= $title ?></li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->