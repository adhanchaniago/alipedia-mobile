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

    .ikon {
        text-align: center;
        margin-top: 10px;
    }

    .ikon i {
        font-size: 48px;
    }

    .produk-image {
        text-align: center;
    }

    .produk-image img {
        height: 50px;
        width: 50px;
    }

    .produk-name {
        margin: 5px 0px 3px 0px;
        text-align: center;
    }

    .produk-price {
        margin: 0px 0px 8px 0px;
        text-align: center;
    }

    .produk-stock {
        margin: 0px 0px 5px 0px;
        text-align: center;
    }

    #pagination {
        margin-top: -15px;
    }

    .content2 {
        margin-top: 0px;
        text-align: center;
    }

    .blocks {
        cursor: default;
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
<!-- ================================================== DETAIL ================================================== -->
<?php if ($action == 'detail' || empty($action)){ ?>
<div class="cl-mcont" style="margin-top: 0px !important">
    <div class='row'>
        <div class="col-xs-12 col-md-12">
            <div class="title"> Kategori <?php echo $kategori->kategori_jenis ?> </div>
            <a style="margin-top: 10px;margin-bottom: 30px !important;" class="btn btn-primary btn-block btn-produk" href="<?php echo site_url();?>pages">Semua Produk</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="block-flat">
                <div class="content">
                    <form action="<?php echo base_url();?>pages/kategori/detail/<?php echo $kategori->kategori_id ?>" method="post" id="form">
                        <div class='btn-navigation'>
                            <div class='pull-right'>
                                <a class="btn btn-primary" href="<?php echo site_url();?>pages/kategori/detail/<?php echo $kategori->kategori_id ?>"><i class="fa fa-times-circle"></i> Bersihkan Pencarian</a>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='btn-search'>Cari Berdasarkan :</div>
                            <div class='col-md-3 col-sm-12'>
                                <div class='button-search'>
                                    <?php array_pilihan('cari', $berdasarkan, $cari);?>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-12'>
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" value="<?php echo $q;?>" />
                                    <span class="input-group-btn">
                                        <button type="submit" name="kirim" class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- ========== End Button ========== -->
            <!-- ========== Table ========== -->
            <div class="row">
                <?php
	                $where_produk['kategori_id']	= $kategori->kategori_id;
	                $like_produk[$cari]			= $q;
	                if ($jml_data > 0){
	                foreach ($this->ADM->grid_all_produk('', 'produk_id', 'DESC', $batas, $page, $where_produk, $like_produk) as $row){
	                ?>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="block-flat">
                            <div class="content">
                                <div class="produk-image">
                                    <img src="<?php echo base_url();?>assets/images/produk/<?php echo $row->produk_photo;?>">
                                </div>
                                <div class="produk-name"><?php echo $row->produk_nama;?> </div>
                                
                                <?php if ($row->produk_stock > 0) { ?>
                                    <div class="produk-stock">Stock :<?php echo $row->produk_stock;?>
                                </div>
                                    <?php } else { ?>
                                <div class="produk-stock">Stock Habis</div>
                                <?php } ?>

                                <div class="produk-price">Rp<?php echo number_format($row->produk_harga,0,',','.'); ?>,00</div>
                                <a class="btn btn-default btn-block btn-produk btn-sm" href="<?php echo site_url();?>pages/produk_detail/detail/<?php echo $row->produk_id;?>" title="Edit"><i class="fa fa-eye"></i> Detail</a>
                                    <?php if ($row->produk_stock > 0) { ?>
                                    <a style="margin-top: 10px" class="btn btn-primary btn-block btn-produk btn-sm" data-toggle="modal" data-target="#mod-info" type="button" href="<?php echo site_url();?>pages/produkkategori_beli/<?php echo $row->produk_id;?>" rel="detail" title="Detail <?php echo $row->produk_nama; ?>"><i class="fa fa-shopping-cart"></i> Beli</a>
                                <?php } else { ?>
                                    <a style="margin-top: 10px" class="blocks btn btn-danger btn-block btn-produk btn-sm" type="button">Stock Sudah Habis</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php }
	                } else {
                    ?>
                    <div class="col-sm-12 col-md-12">
                        <div class="block-flat">
                            <div class="content2">
                                Belum ada data!.
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
            <div class="block-flat">
                <div id='pagination'>
                    <div class='pagination-left'>Total :
                        <?php echo $jml_data;?>
                    </div>
                    <div class='pagination-right'>
                        <ul class="pagination">
                            <?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'pages/kategori/detail/'.$kategori->kategori_id.'', $id=""); }?>
                        </ul>
                    </div>
                </div>
            </div>
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
    <form role="form" class="form-horizontal" action="<?php echo site_url();?>pages/produkkategori_beli/<?php echo $produk->produk_id; ?>"
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
        <a type="button" class="btn btn-default" href="<?php echo site_url();?>pages/produk">Kembali</a>
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