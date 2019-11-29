<?php date_default_timezone_set('Asia/Jakarta'); session_start();?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR -
        <?php echo $web->identitas_website;?>
    </title>
    <meta name="description" content="<?php echo $web->identitas_deskripsi;?>" />
    <meta name="keywords" content="<?php echo $web->identitas_keyword;?>" />
    <meta name="author" content="<?php echo $web->identitas_author;?>" />
    <link rel="shortcut icon" type="image/x-icon" href="http://localhost/ukmapp/assets/<?php echo $web->identitas_favicon;?>"
        sizes="16x16" />
    <link href="<?php echo base_url();?>templates/admin/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>templates/admin/fonts/font-awesome-4/css/font-awesome.min.css" rel="stylesheet" />
    <link href='<?php echo base_url();?>templates/admin/fonts/css/fonts.css' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url();?>templates/admin/js/jquery.nanoscroller/nanoscroller.css" rel="stylesheet" type="text/css"
    />
    <link href="<?php echo base_url();?>templates/admin/css/style.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>templates/admin/js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/date/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/date/jquery-ui-1.8.17.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/behaviour/general.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.ui/jquery-ui.js"></script>
</head>

<body>
    <!-- ==================== Navbar ==================== -->
    <div id="head-nav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="fa fa-gear"></span>
                </button>
                <a class="navbar-brand" href="#"><span><?php echo $web->identitas_website;?></span></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav left-nav">
                    <li class="active"><a href="<?php echo base_url();?>pages"><i class="fa fa-home"></i></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right user-nav">
                    <li class="dropdown profile_menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php if($this->session->userdata('logged_in') == TRUE) { ?>
                            <?php if ($admin->admin_photo){?>
                            <img height=30 src="<?php echo base_url();?>assets/images/avatar/<?php echo $admin->admin_photo ?>" alt="Avatar" />
                            <?php } else {?>
                            <img height=30 src="<?php echo base_url();?>assets/images/avatar1_50.jpg" alt="Avatar" />
                            <?php } ?>
                            <?php } else {?>
                            <img height=30 src="<?php echo base_url();?>assets/images/avatar1_50.jpg" alt="Avatar" />
                            <?php } ?>
                            <span>
                                <?php if($this->session->userdata('logged_in') == TRUE) { ?>
                                  <?php echo $admin->admin_nama; ?>
                                  <?php } else {?>
                            Visitor
                            <?php } ?>
                                </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if($this->session->userdata('logged_in') == TRUE) { ?>
                            <li><a href="<?php echo site_url();?>pages">Beranda</a></li>
                            <li><a href="<?php echo site_url();?>pages/edit_password">Edit Password</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url();?>wp_login/keluar">Logout</a></li>
                            <?php } else {?>
                            <li><a href="<?php echo site_url();?>pages">Beranda</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url();?>wp_login">Login</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right not-nav"></ul>
            </div>
        </div>
    </div>
    <div id="cl-wrapper" class="fixed-menu">
        <div class="cl-sidebar" data-position="right">
            <div class="cl-toggle"><i style="color: white;" class="fa fa-bars"></i><span style="font-size: 16px;color: white;margin-left: 6px;">Menu </span>                </div>
            <div class="cl-navblock">
                <div class="menu-space">
                    <div class="content">
                        <div class="side-user">
                            <?php if($this->session->userdata('logged_in') == TRUE) { ?>
                            <?php if ($admin->admin_photo){?>
                            <div class="avatar">
                                <img width=50 src="<?php echo base_url();?>assets/images/avatar/<?php echo $admin->admin_photo ?>" alt="Avatar" />
                            </div>
                            <?php } else {?>
                            <div class="avatar">
                                <img width=50 src="<?php echo base_url();?>assets/images/avatar1_50.jpg" alt="Avatar" />
                            </div>
                            <?php } ?>
                            <?php } else {?>
                            <div class="avatar">
                                <img src="<?php echo base_url();?>assets/images/avatar1_50.jpg" alt="Avatar" />
                            </div>
                            <?php } ?>
                            <div class="info">
                                <a href="#">
                                    <?php if($this->session->userdata('logged_in') == TRUE) { ?>
                                    <?php echo $admin->admin_nama; ?>
                                    <?php } else {?> Visitor
                                    <?php } ?>
                                </a>
                                <img src="<?php echo base_url();?>templates/admin/images/state_online.png" alt="Status" />
                                <span>Online</span>
                            </div>
                        </div>
                        <ul class="cl-vnavigation">
                            <li>
                                <a href="<?php echo site_url();?>pages"><i class="fa fa-suitcase"></i> <span>Produk</span></a>
                            </li>
                            <?php if($this->session->userdata('logged_in') == TRUE) { ?>
                            <li>
                                <a href="<?php echo site_url();?>pages/myaccount"><i class="fa fa-user"></i> <span>Profil Saya</span></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url();?>pages/toko"><i class="fa fa-shopping-bag"></i> <span>Toko</span></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url();?>pages/transaksi"><i class="fa fa-shopping-cart"></i> <span>Transaksi</span></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url();?>pages/pesanan"><i class="fa fa-shopping-cart"></i> <span>Pesanan Saya</span></a>
                            </li>
                            <?php } ?>
                            <li>
                                <a href="<?php echo site_url();?>pages/keranjang"><i class="fa fa-shopping-cart"></i> <span>Keranjang Belanja</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="text-center collapse-button" style="padding:7px 9px;">
                    <button id="sidebar-collapse" class="btn btn-default" style="">
                            <i class="fa fa-angle-left"></i>
                        </button>
                </div>
            </div>
        </div>
        <!-- ==================== Content ==================== -->
        <div class="container-fluid" id="pcont">
            <?php $this->load->view($content);?>
        </div>
        <!-- ==================== End Content ==================== -->
    </div>
    <script>
        $(function () {
            $('#modal-konfirmasi').on('show.bs.modal', function (event) {
                var div = $(event.relatedTarget)
                var id = div.data('id')
                var modal = $(this);
                modal.find('#hapus-komentar').attr("href","<?php echo site_url();?>pages/produk_detail//hapus/" + id);
                modal.find('#hapus-produk').attr("href","<?php echo site_url();?>pages/toko/hapus/" + id);
                modal.find('#hapus-kategori').attr("href","<?php echo site_url();?>website/kategori/hapus/" + id);
                modal.find('#hapus-menu').attr("href", "<?php echo site_url();?>pengaturan/menu/hapus/" + id);
                modal.find('#hapus-pengguna').attr("href", "<?php echo site_url();?>pengaturan/pengguna/hapus/" + id);
                modal.find('#hapus-kelompok_pengguna').attr("href","<?php echo site_url();?>pengaturan/kelompok_pengguna/hapus/" + id);
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            App.init();
            App.dashBoard();

            introJs().setOption('showBullets', false).start();
        });
    </script>
    <script src="<?php echo base_url();?>templates/admin/js/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.flot/jquery.flot.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.flot/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.flot/jquery.flot.labels.js"></script>
</body>

</html>