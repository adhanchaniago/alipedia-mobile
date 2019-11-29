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
        text-align:center;
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
</style>
<!-- ================================================== View ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<div class="cl-mcont" style="margin-top: 0px !important">
    <div class='row'>
        <div class="col-xs-12 col-md-12">
            <div class="title"> Toko </div>
        </div>
        <!-- ================================================== Jika Sudah Punya Toko ================================================== -->
        <?php 
        if ($jml_data2 > 0) { ?>
        <div class="col-md-12">

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

            <div class="block-flat">
                <div class="content">
                    <form role="form" class="form-horizontal" action="<?php echo site_url();?>pages/toko/view" method="post" enctype="multipart/form-data"
                        parsley-validate novalidate>
                        <div class="table-responsive">
                            <table class="table no-border hover">
                                <tbody class="no-border-y">
                                    <tr>
                                        <td width="130">
                                            <label for="toko_nama" class="control-label">Nama Toko <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="toko_nama" type="text" required class="form-control input-sm" id="toko_nama" size="" placeholder="Nama Toko" value="<?php echo $toko->toko_nama ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="toko_deskripsi" class="control-label">Deskripsi Toko <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="toko_deskripsi" type="text" required class="form-control input-sm" id="toko_deskripsi" size="" placeholder="Deskripsi Toko" value="<?php echo $toko->toko_deskripsi ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="toko_bank" class="control-label">Bank <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="toko_bank" type="text" required class="form-control input-sm" id="toko_bank" size="" placeholder="Bank" value="<?php echo $toko->toko_bank ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="toko_norek" class="control-label">No Rek Bank <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="toko_norek" type="text" required class="form-control input-sm" id="toko_norek" size="" placeholder="No Rek Bank" value="<?php echo $toko->toko_norek ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="toko_atasnama" class="control-label">Atas Nama <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="toko_atasnama" type="text" required class="form-control input-sm" id="toko_atasnama" size="" placeholder="Atas Nama" value="<?php echo $toko->toko_atasnama ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class='center'>
                            <input class="btn btn-primary btn-block btn-block" type="submit" name="update" value="Update Toko">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="content">
                            <form action="<?php echo base_url();?>pages/toko" method="post" id="form">
                                <div class='btn-navigation'>
                                    <div class='pull-right'>
                                        <a class="btn btn-primary" href="<?php echo site_url();?>pages/toko/tambah"><i class="fa fa-plus-circle"></i> Tambah Produk</a>
                                    </div>
                                    <div class='pull-right'>
                                        <a class="btn btn-primary" href="<?php echo site_url();?>pages/toko"><i class="fa fa-times-circle"></i> Bersihkan Pencarian</a>
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
	                        $where_produk['admin_user']	= $admin->admin_user;
	                        $like_produk[$cari]			= $q;
	                        if ($jml_data > 0){
	                            foreach ($this->ADM->grid_all_produk('', 'produk_id', 'DESC', $batas, $page, $where_produk, $like_produk) as $row){
	                            ?>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="block-flat">
                                    <div class="content">
                                        <div class="produk-image">
                                            <img src="<?php echo base_url();?>assets/images/produk/<?php echo $row->produk_photo;?>">
                                        </div>
                                        <div class="produk-name"><?php echo $row->produk_nama;?> </div>

                                        <?php if ($row->produk_stock > 0) { ?>
                                        <div class="produk-stock">Stock : <?php echo $row->produk_stock;?>
                                        </div>
                                        <?php } else { ?>
                                        <div class="produk-stock">Stock Habis</div>
                                        <?php } ?>
                                        <div class="produk-price">Rp<?php echo number_format($row->produk_harga,0,',','.'); ?>,00</div>

                                        <a class="btn btn-primary btn-block btn-produk btn-sm" href="<?php echo site_url();?>pages/toko/edit/<?php echo $row->produk_id; ?>" title="Edit">Edit</a>
                                        <a class="btn btn-primary btn-block btn-produk btn-sm" href="javascript:;" data-id="<?php echo $row->produk_id;?>" data-toggle="modal" data-target="#modal-konfirmasi" title="Hapus <?php echo $row->produk_nama; ?>">Hapus</a>
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
                                    <?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'pages/toko/view', $id=""); }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                <a href="javascript:;" class="btn btn-danger" id="hapus-produk">Ya</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            </div>

        </div>
    </div>
</div>
<!-- ========== End Modal Konfirmasi ========== -->

<!-- ================================================== Jika Belum Punya Toko ================================================== -->
<?php } else { ?>
<div class="col-md-12">
    
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

    <div class="block-flat">
        <div class="content">
            <form role="form" class="form-horizontal" action="<?php echo site_url();?>pages/toko/view" method="post" enctype="multipart/form-data"
                parsley-validate novalidate>
                <div class="table-responsive">
                    <table class="table no-border hover">
                        <tbody class="no-border-y">
                            <tr>
                                <td width="130">
                                    <label for="toko_nama" class="control-label">Nama Toko <span class="required">*</span></label>
                                </td>
                                <td>
                                    <input name="toko_nama" type="text" required class="form-control input-sm" id="toko_nama" size="" placeholder="Nama Toko" />
                                </td>
                            </tr>
                            <tr>
                                <td width="130">
                                    <label for="toko_deskripsi" class="control-label">Deskripsi Toko <span class="required">*</span></label>
                                </td>
                                <td>
                                    <input name="toko_deskripsi" type="text" required class="form-control input-sm" id="toko_deskripsi" size="" placeholder="Deskripsi Toko" />
                                </td>
                            </tr>
                            <tr>
                                <td width="130">
                                    <label for="toko_bank" class="control-label">Bank <span class="required">*</span></label>
                                </td>
                                <td>
                                    <input name="toko_bank" type="text" required class="form-control input-sm" id="toko_bank" size="" placeholder="Bank" />
                                </td>
                            </tr>
                            <tr>
                                <td width="130">
                                    <label for="toko_norek" class="control-label">No Rek Bank <span class="required">*</span></label>
                                </td>
                                <td>
                                    <input name="toko_norek" type="text" required class="form-control input-sm" id="toko_norek" size="" placeholder="No Rek Bank" />
                                </td>
                            </tr>
                            <tr>
                                <td width="130">
                                    <label for="toko_atasnama" class="control-label">Atas Nama <span class="required">*</span></label>
                                </td>
                                <td>
                                    <input name="toko_atasnama" type="text" required class="form-control input-sm" id="toko_atasnama" size="" placeholder="Atas Nama" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class='center'>
                    <input class="btn btn-primary btn-block btn-block" type="submit" name="simpan" value="Buka Toko">
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>
<!-- ================================================== END VIEW ================================================== -->

<!-- ================================================== TAMBAH ================================================== -->
<?php } elseif ($action == 'tambah') { ?>
<div class="cl-mcont" style="margin-top: 0px !important">
    <div class='row'>
        <div class="col-xs-12 col-md-12">
            <div class="title"> Tambah Produk </div>
        </div>
        <div class="col-md-12">
            <div class="block-flat">
                <div class="content">
                    <form role="form" class="form-horizontal" action="<?php echo site_url();?>pages/toko/tambah" method="post" enctype="multipart/form-data"
                        parsley-validate novalidate>
                        <div class="table-responsive">
                            <table class="table no-border hover">
                                <tbody class="no-border-y">
                                    <tr>
                                        <td width="130">
                                            <label for="kategori_id" class="control-label">Kategori Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <select name="kategori_id" type="text" required class="form-control input-sm" id="kategori_id" size="" />
                                                <?php 
                                                foreach ($this->ADM->grid_all_kategori('', 'kategori_jenis', 'ASC', 100, '', '', '') as $row){ ?>
                                                <option value="<?php echo $row->kategori_id ?>">
                                                   <?php echo $row->kategori_jenis ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="produk_nama" class="control-label">Nama Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="produk_nama" type="text" required class="form-control input-sm" id="produk_nama" size="" placeholder="Nama Produk" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="produk_deskripsi" class="control-label">Deskripsi Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="produk_deskripsi" type="text" required class="form-control input-sm" id="produk_deskripsi" size="" placeholder="Deskripsi Produk" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="produk_stock" class="control-label">Stock Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="produk_stock" type="number" required class="form-control input-sm" id="produk_stock" size="" placeholder="Stock Produk" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="produk_harga" class="control-label">Harga Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="produk_harga" type="number" required class="form-control input-sm" id="produk_harga" size="" placeholder="Harga Produk" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="produk_photo" class="control-label">Foto Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="file" name="produk_photo" id="produk_photo" required class="form-control btn-sm input-sm" />
                                            <div class="ket">Max. data 4MB</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class='center'>
                            <input class="btn btn-primary btn-block" type="submit" name="simpan" value="Simpan">
                            <input class="btn btn-default btn-block" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>pages/toko'" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================================================== END TAMBAH ================================================== -->

<!-- ================================================== EDIT ================================================== -->
<?php } elseif ($action == 'edit') { ?>
<div class="cl-mcont" style="margin-top: 0px !important">
    <div class='row'>
        <div class="col-xs-12 col-md-12">
            <div class="title"> Edit Produk </div>
        </div>
        <div class="col-md-12">
            <div class="block-flat">
                <div class="content">
                    <form role="form" class="form-horizontal" action="<?php echo site_url();?>pages/toko/edit" method="post" enctype="multipart/form-data"
                        parsley-validate novalidate>
                        <input value="<?php echo $produk_id; ?>" name="produk_id" type="hidden" />
                        <div class="table-responsive">
                            <table class="table no-border hover">
                                <tbody class="no-border-y">
                                    <tr>
                                        <td width="130">
                                            <label for="kategori_id" class="control-label">Kategori Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <?php $this->ADM->combo_box("SELECT * FROM kategori ORDER BY kategori_id ASC", 'kategori_id', 'kategori_id', 'kategori_jenis', $kategori_id);?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="produk_nama" class="control-label">Nama Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input value="<?php echo $produk_nama; ?>" name="produk_nama" type="text" required class="form-control input-sm" id="produk_nama" size="" placeholder="Nama Produk" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="produk_deskripsi" class="control-label">Deskripsi Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input value="<?php echo $produk_deskripsi; ?>" value="<?php echo $produk_deskripsi; ?>" name="produk_deskripsi" type="text" required class="form-control input-sm" id="produk_deskripsi" size="" placeholder="Deskripsi Produk" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="produk_harga" class="control-label">Harga Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input value="<?php echo $produk_harga; ?>" name="produk_harga" type="number" required class="form-control input-sm" id="produk_harga" size="" placeholder="Harga Produk" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="produk_stock" class="control-label">Stock Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input value="<?php echo $produk_stock; ?>" name="produk_stock" type="number" required class="form-control input-sm" id="produk_stock" size="" placeholder="Stock Produk" />
                                        </td>
                                    </tr>
                                    <?php if ($produk_photo){?>
                                    <tr>
                                        <td>
                                            <label for="produk_photo" class="control-label">Foto Produk</label>
                                        </td>
                                        <td>
                                            <input readonly="" type="text" value="<?php echo $produk_photo; ?>" class="form-control input-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="produk_photo" class="control-label">Edit Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="file" name="produk_photo" id="produk_photo" class="form-control btn-sm input-sm" />
                                            <div class="ket">Max. data 4MB</div>
                                        </td>
                                    </tr>
                                    <?php } else {?>
                                    <tr>
                                        <td>
                                            <label for="produk_photo" class="control-label">Foto Produk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="file" name="produk_photo" id="produk_photo" required class="form-control btn-sm input-sm" />
                                            <div class="ket">Max. data 4MB</div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class='center'>
                            <input class="btn btn-primary btn-block" type="submit" name="simpan" value="Simpan">
                            <input class="btn btn-default btn-block" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>pages/toko'" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!-- ================================================== END EDIT ================================================== -->

<!-- Include More Js For This Content -->
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.nestable/jquery.nestable.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.slider/js/bootstrap-slider.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.icheck/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- For Validation -->
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.parsley/parsley.js"></script>