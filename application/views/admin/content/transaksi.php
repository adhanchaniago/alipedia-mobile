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
        margin-bottom: 10px;
    }

    .produk-image img {
        width: 100px;
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

    .transaksi-tanggal {
        margin-bottom: 10px;
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

    .invoice {
        font-size: 18px;
        text-align: center;
    }

    .invoice-harga {
        color: red;
        margin-top: 10px;
        font-size: 18px;
        text-align: center;
    }

    .harga {
        font-size: 14px;
        margin: 10px 0px 30px 0px;
    }
</style>
<!-- ================================================== View ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<div class="cl-mcont" style="margin-top: 0px !important">
    <div class='row'>
        <div class="col-xs-12 col-md-12">

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
            
            <div class="col-xs-12 col-md-12">
                <div class="title"> Transaksi Ke Toko Anda </div>
            </div>
            <?php 
            if ($jml_data2 < 1) { ?>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="tokoo center">
                            Anda Belum Buka Toko
                        </div>
                    </div>
                    <a href="<?php echo site_url();?>pages/toko" class="btn btn-primary btn-block">Buka Toko</a>
                </div>
            </div>
            <?php } else { ?>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="content">
                            <form action="<?php echo base_url();?>pages/transaksi" method="post" id="form">
                                <div class='btn-navigation'>
                                    <div class='pull-right'>
                                        <a class="btn btn-primary" href="<?php echo site_url();?>pages/transaksi"><i class="fa fa-times-circle"></i> Bersihkan Pencarian</a>
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
                        $where_toko['toko_id']	=  $toko->toko_id;
                        $like_toko[$cari]			= $q;
	                    if ($jml_data > 0){
                            foreach ($this->ADM->grid_all_transaksi('', 'transaksi_id', 'DESC', "100", '',  $where_toko, $like_toko) as $row){ ?>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="block-flat">

                                    <div class="transaksi-name">No Transaksi :
                                        <?php echo $row->transaksi_id;?> </div>
                       
                                    <?php if($row->transaksi_bukti) { ?>
                                        <div class="produk-image">Foto Bukti Pembayaran : <img src="http://localhost/ukmapp/assets/images/transaksi/<?php echo $row->transaksi_bukti;?>"></div>
                                    <?php } ?>
                                    
                                    <?php
                                    $where_admin['admin_user']	=  $row->admin_user;
                                    foreach ($this->ADM->grid_all_admin2('', 'admin_nama', 'ASC', '1', '', $where_admin, '') as $pembeli){
                                    ?>
                                    <div class="transaksi-name">Pembeli :
                                        <?php echo $pembeli->admin_nama;?> </div>
                                    <div class="transaksi-name">Alamat Pembeli :
                                        <?php echo $pembeli->admin_alamat;?> </div>
                                    <?php }

                                    $where_toko['toko_id']	=  $row->toko_id;
                                    foreach ($this->ADM->grid_all_toko('', 'toko_nama', 'ASC', '1', '', $where_toko, '') as $row2){
	                                ?>
                                    <div class="transaksi-name">Toko :
                                        <?php echo $row2->toko_nama;?> </div>
                                    <?php } ?>

                                    <?php
                                    $where_produk['produk_id']	=  $row->produk_id;
                                    foreach ($this->ADM->grid_all_produk('', 'produk_nama', 'ASC', '1', '', $where_produk, '') as $row3){
                               
                                        $where_admin['admin_user']	=  $row3->admin_user;
                                        foreach ($this->ADM->grid_all_admin2('', 'admin_nama', 'ASC', '1', '', $where_admin, '') as $row5){
	                                    ?>
                                        <div class="transaksi-name">Penjual : <?php echo $row5->admin_nama;?> </div>
                                        <?php } ?>

                                        <div class="transaksi-name">Nama Produk : <?php echo $row3->produk_nama;?> </div>
                                        <?php } ?>

                                        <div class="transaksi-name">Jumlah Pembelian : <?php echo $row->transaksi_jumlah;?> </div>
                                        <div class="transaksi-name">Total Harga : Rp <?php echo $row->transaksi_totalharga;?>,00 </div>
                                        <div class="transaksi-tanggal">Tanggal Pembelian : <?php echo  dateIndo($row->transaksi_created); ?> </div>
                                      
                                        <?php if($row->transaksi_confirm === "false" && $row->transaksi_status === "paid" && $row->transaksi_statusadmin === "unpaid") { ?>
                                            <a style="margin-top: 30px;" class="blocks btn btn-danger btn-block btn-produk btn-sm">Menunggu Pembayaran Admin</a>
                                            <?php } else if ($row->transaksi_confirm === "false" && $row->transaksi_status === "paid" && $row->transaksi_statusadmin === "paid") { ?>
                                                <a style="margin-top: 10px;" class="btn btn-success btn-block btn-produk" data-toggle="modal" data-target="#mod-info" type="button" href="<?php echo site_url();?>pages/konfirmasipembayaranadmin/<?php echo $row->transaksi_id;?>" rel="detail"><i class="fa fa-money"></i> Konfirmasi & Kirim No Resi</a>
                                            <?php } else if ($row->transaksi_confirm === "true" && $row->transaksi_status === "paid" && $row->transaksi_statusadmin === "paid" && $row->transaksi_end === "false") { ?>
                                                <a style="margin-top: 30px;" class="blocks btn btn-success btn-block btn-produk btn-sm">Menunggu Konfirmasi Admin</a>
                                            <?php } else if ($row->transaksi_confirm === "true" && $row->transaksi_status === "paid") { ?>
                                            <a style="margin-top: 30px;" class="blocks btn btn-success btn-block btn-produk btn-sm">Sudah Dikonfirmasi</a>
                                        <?php } ?>

                                        <?php if($row->transaksi_status === "unpaid") { ?>
                                            <a style="margin-top: 10px;" class="blocks btn btn-warning btn-block btn-produk"><i class="fa fa-money"></i> Pembeli belum konfirmasi pembayaran</a>
                                            <?php } ?>
                                            </div>    
                                        </div>
                                    <?php } ?>  
                               <?php  } else {
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
                                <?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'pages/transaksi/view', $id=""); }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!-- ================================================== END VIEW ================================================== -->
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
<!-- ================================================== END VIEW ================================================== -->

<!-- ================================================== DETAIL ================================================== -->
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css" />
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Konfirmasi Pembayaran Ke Admin</h4>
</div>
<form role="form" class="form-horizontal" action="<?php echo site_url();?>pages/konfirmasipembayaranadmin/<?php echo $transaksi->transaksi_id; ?>"
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

        <div class="nama">No Transaksi : <?php echo $transaksi->transaksi_id;?></div>
        <div class="harga">Total Bayar : Rp<?php echo number_format($transaksi->transaksi_totalharga,0,',','.') ?>,00</div>

        <div class="table-responsive">
            <table class="table no-border hover">
                <tbody class="no-border-y">
                    <tr>
                        <td>
                            <label for="transaksi_resi" class="control-label">Foto Bukti No Resi <span class="required">*</span></label>
                        </td>
                        <td>
                            <input type="file" name="transaksi_resi" id="transaksi_resi" required class="form-control btn-sm input-sm" />
                            <div class="ket">Max. data 4MB</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <input class="btn btn-primary" type="submit" name="simpan" value="Konfirmasi">
        <a type="button" class="btn btn-default" href="<?php echo site_url();?>pages/transaksi">Kembali</a>
    </div>
</form>
<!-- ================================================== END DETAIL ================================================== -->
<?php } ?>