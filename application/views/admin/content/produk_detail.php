<style>
    .title {
        margin-bottom: 20px;
        text-align: center;
        font-size: 18px;
    }

    .judul {
        font-size: 14px;
        text-align: center;
    }

    .sub-title {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .ikon {
        text-align: center;
        margin-top: 10px;
    }

    .ikon i {
        font-size: 48px;
    }

    .produk-photo {
        text-align: center;
    }

    .produk-photo img {
        width: 200px;
    }

    .produk-username {
        margin-top: 20px;
    }

    .sub-title i {
        margin-left: 10px;
    }

    .produk-user i {
        margin-right: 10px;
    }

    .produk-user2 i {
        margin-right: 12px;
    }

    .pagings {
        margin-top: -15px !important;
    }

    .bottom-foot {
        margin-bottom: 50px !important;
    }

    .produk-penjual {
        color: blue;
    }

    .nama {
        font-size: 14px;
    }

    .nama2 {
        font-size: 14px;
        margin-bottom: 20px;
    }

    .stock {
        font-size: 14px;
        margin-top: 10px;
    }

    .harga {
        font-size: 14px;
        margin: 10px 0px 10px 0px;
    }
</style>
<!-- ================================================== Detail ================================================== -->
<?php if ($action == 'detail' || empty($action)){ ?>
<div class="cl-mcont" style="margin-top: 0px !important">
    
<!-- ========== Flashdata ========== -->
    <?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
    <?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check sign"></i>
        <?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php } else if ($this->session->flashdata('warning')) { ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check sign"></i>
        <?php echo $this->session->flashdata('warning'); ?>
    </div>
    <?php } else { ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-warning sign"></i>
        <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php } ?>
    <?php } ?>
    <!-- ========== End Flashdata ========== -->

    <div class='row'>
        <div class="col-xs-12 col-md-12">
            <div class="title"> Produk
                <?php echo $produk->produk_nama ?>
            </div>
            <div class="col-xs-12 col-md-12">
                <div class="block-flat">
                    <div class="produk-photo"><img src="<?php echo base_url();?>assets/images/produk/<?php echo $produk->produk_photo;?>"></div>
                </div>
            </div>

            <div class="col-xs-12 col-md-6">
                <div class="block-flat">
                    <div class="sub-title">Deskripsi Produk</div>
                    <div class="produk-description">
                        <?php echo $produk->produk_deskripsi ?>
                    </div>
                    <div class="produk-category">Kategori:
                        <?php echo $kategori->kategori_jenis ?>
                    </div>
                    <?php if ($produk->produk_stock > 0) { ?>
                    <div class="produk-stock">Stock : <?php echo $produk->produk_stock;?>
                    </div>
                    <?php } else { ?>
                    <div class="produk-stock">Stock Habis</div>
                    <?php } ?>
                    <div class="produk-price">Harga : Rp<?php echo number_format($produk->produk_harga,0,',','.'); ?>,00</div>
                    <?php $tanggal = dateIndo($produk->produk_created); ?>
                    <div class="produk-price">Dipost : <?php echo $tanggal  ?> </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-6">
                <div class="block-flat">
                    <div class="sub-title">Deskripsi Toko <i class="fa fa-shopping-bag"></i></div>
                    <div class="produk-description">Nama Toko : <?php echo $toko->toko_nama ?> </div>
                    <div class="produk-price">Deskripsi Toko : <?php echo $toko->toko_deskripsi ?> </div>
                    
                    <?php 
                        $where_admin['admin_user']	= $produk->admin_user;
                        foreach ($this->ADM->grid_all_admin2('', 'admin_user', 'ASC', "1", "", $where_admin, "") as $penjual){
                        ?>
                    <div class="produk-user produk-username"><i class="fa fa-user"></i> Penjual : <?php echo $penjual->admin_nama ?></div>
                    <div class="produk-user2"><i class="fa fa-map-marker"></i> Alamat : <?php echo $penjual->admin_alamat ?></div>
                    <div class="produk-user"><i class="fa fa-phone"></i> No Telp : <?php echo $penjual->admin_telepon ?></div>
                    <?php } ?>
                </div>
            </div>

            <?php 
                        $where_adminbank['admin_level_kode']	= 1;
                        foreach ($this->ADM->grid_all_admin4('', 'admin_user', 'ASC', "1", "", $where_adminbank, "") as $adminbank){

                            $where_toko['admin_user']	= $adminbank->admin_user;   
                        foreach ($this->ADM->grid_all_toko('', 'toko_id', 'ASC', "1", "", $where_toko, "") as $tokoadmin){
                        ?>
            <div class="col-xs-12 col-md-6">
                <div class="block-flat">
                    <div class="sub-title">Pembayaran <i class="fa fa-money"></i></div>
                    <div class="produk-description">Bank : <?php echo $tokoadmin->toko_bank ?></div>
                    <div class="produk-price">No Rek : <?php echo $tokoadmin->toko_norek ?></div>
                    <div class="produk-atasnama">Atas Nama : <?php echo $tokoadmin->toko_atasnama ?></div>
                </div>
            </div>
                        <?php } } ?>

            <?php if($this->session->userdata('logged_in') == TRUE) { ?>
            <div class="col-xs-12 col-md-6">
                <div class="block-flat">
                    <div class="sub-title">Komentar</div>
                    <form role="form" class="form-horizontal" action="<?php echo site_url();?>pages/produk_detail/detail" method="post" enctype="multipart/form-data"
                        parsley-validate novalidate>
                        <table class="table no-border hover">
                            <tbody class="no-border-y">
                                <tr>
                                    <td>
                                        <input name="produk_id" type="hidden" class="form-control input-sm" value="<?php echo $produk->produk_id;?>" />
                                        <textarea name="komentar_deskripsi" type="text" id="komentar_deskripsi" size="30" maxlength="255" required class="form-control input-sm" placeholder="Masukan Komentar" /></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class='center'>
                            <input class="btn btn-primary btn-block" type="submit" name="simpan" value="Komen">
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xs-12 col-md-6">
                <?php
	                $where_produk['produk_id']	= $produk->produk_id;
	                $like_komentar[$cari]			= $q;
	                    if ($jml_data > 0){
	                        foreach ($this->ADM->grid_all_komentar('', 'komentar_id', 'ASC', $batas, $page, $where_produk, $like_komentar) as $data){
	                        ?>
                    <div class="block-flat">
                        <?php 
                        $where_admin['admin_user']	= $data->admin_user;
                        foreach ($this->ADM->grid_all_admin2('', 'admin_user', 'ASC', "1", "", $where_admin, "") as $row){
                        ?>

                        <?php if ($data->admin_user == $produk->admin_user ) { ?>
                        <div class="produk-penjual">Penjual Produk :
                            <?php echo $row->admin_user;?> </div>
                        <?php } else {?>
                        <div class="produk-name">
                            <?php echo $row->admin_user;?> </div>
                        <?php } ?>
                        <?php } ?>

                        <div class="produk-name"><?php echo $data->komentar_deskripsi;?> </div>
                        <div class="produk-name"><i class="fa fa-clock-o"></i> <?php echo dateIndo($data->komentar_created);?> </div>

                        <?php if ($data->admin_user == $admin->admin_user ) { ?>
                        <a style="margin-top: 10px;" class="btn btn-danger btn-block btn-produk btn-sm" href="javascript:;" data-id="<?php echo $data->komentar_id;?>"
                            data-toggle="modal" data-target="#modal-konfirmasi">Hapus Komentar</a>
                        <?php } ?>
                        
                    </div>
                    <?php } ?>
                    <div class="block-flat">
                        <div id='pagination' class="pagings">
                            <div class='pagination-left'>Total :
                                <?php echo $jml_data;?>
                            </div>
                            <div class='pagination-right'>
                                <ul class="pagination">
                                    <?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'pages/produk_detail/detail/'.$produk->produk_id.'', $id=""); }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php      
                    } else {
                    ?>
                    <div class="block-flat">
                        <div class="content2">
                            Belum ada data!.
                        </div>
                    </div>
                    <?php } ?>
            </div>
        </div>
        <?php } ?>

        <!-- ========== Modal Konfirmasi ========== -->
        <div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Konfirmasi</h4>
                    </div>

                    <div class="modal-body" style="background:#d9534f;color:#fff">
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>

                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-danger" id="hapus-komentar">Ya</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- ========== End Modal Konfirmasi ========== -->

        <div class="col-xs-12 col-md-12 bottom-foot">
            <?php if ($produk->produk_stock > 0) { ?>
            <a style="margin-top: 10px" class="btn btn-primary btn-block btn-produk" data-toggle="modal" data-target="#mod-info" type="button"
                href="<?php echo site_url();?>pages/produkdetail_beli/<?php echo $produk->produk_id;?>" rel="detail" title="Detail <?php echo $produk->produk_nama; ?>"><i class="fa fa-shopping-cart"></i> Beli</a>
            <?php } else { ?>
            <?php } ?>
            <input style="margin-top: 10px" class="btn btn-default btn-block" type="reset" name="batal" value="Kembali" onclick="location.href='<?php echo site_url(); ?>pages'">
        </div>
    </div>
</div>
<!-- ========== Modal Detail ========== -->
<div class="modal fade" id="mod-info" tabindex="-1" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">

    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- ========== End Modal Detail ========== -->
<!-- ================================================== END DETAIL ================================================== -->

<!-- ================================================== BELI ================================================== -->
<?php } elseif ($action == 'beli') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css" />
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Beli Produk</h4>
</div>
<form role="form" class="form-horizontal" action="<?php echo site_url();?>pages/produkdetail_beli/<?php echo $produk->produk_id; ?>"
method="post" enctype="multipart/form-data" parsley-validate validate>
<div class="modal-body">

    <!-- ========== Flashdata ========== -->
    <?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
    <?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check sign"></i>
        <?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php } else if ($this->session->flashdata('warning')) { ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check sign"></i>
        <?php echo $this->session->flashdata('warning'); ?>
    </div>
    <?php } else { ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-warning sign"></i>
        <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php } ?>
    <?php } ?>
    <!-- ========== End Flashdata ========== -->
    
    <div class="nama">Nama Produk :
        <?php echo $produk->produk_nama;?>
    </div>
    <div class="stock">Stock :
        <?php echo $produk->produk_stock;?>
    </div>
    <div class="harga">Harga :
        Rp<?php echo number_format($produk->produk_harga,0,',','.'); ?>,00
    </div>
    <input name="produk_stock" type="hidden" value="<?php echo $produk->produk_stock;?>">
    <div class="table-responsive">
        <table class="table no-border hover">
            <tbody class="no-border-y">
                <tr>
                    <td width="180">
                        <label for="transaksi_jumlah" class="control-label">Jumlah Beli <span class="required">*</span></label>
                    </td>
                    <td>
                        <input name="transaksi_jumlah" type="number" required class="form-control input-sm" id="transaksi_jumlah" size="" placeholder="Jumlah Beli" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <input class="btn btn-primary" type="submit" name="simpan" value="Masukan ke keranjang Belanja">
    <a type="button" class="btn btn-default" href="<?php echo site_url();?>pages/produk_detail/detail/<?php echo $produk->produk_id?>">Kembali</a>
</div>
</form>
<!-- ================================================== END BELI ================================================== -->
<?php } ?>
<!-- Include More Js For This Content -->
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.nestable/jquery.nestable.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.slider/js/bootstrap-slider.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.icheck/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- For Validation -->
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.parsley/parsley.js"></script>