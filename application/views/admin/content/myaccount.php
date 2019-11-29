<style>
    .title {
        margin-bottom: 20px;
        text-align: center;
        font-size: 18px;
    }

    .no-border {
        border: 0px;
    }

    .no-border tr {
        border: 0px;
    }

    .no-border td {
        border: 0px;
    }

    .avatar2 {
        text-align: center;
    }

    .avatar2 img {
        width: 100px;
    }
</style>
<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<div class="cl-mcont" style="margin-top: 0px !important">
    <div class='row'>
        <div class="col-xs-12 col-md-12">
            <div class="title"> Profile Saya </div>

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
                <?php if ($admin->admin_photo){?>
                <div class="avatar2">
                    <img src="<?php echo base_url();?>assets/images/avatar/<?php echo $admin->admin_photo ?>" alt="Avatar" />
                </div>
                <?php } else {?>
                <div class="avatar2">
                    <img src="<?php echo base_url();?>assets/images/avatar1_50.jpg" alt="Avatar" />
                </div>
                <?php } ?>
                <table class="no-border">
                    <tr>
                        <td width=80>Username</td>
                        <td width=30>:</td>
                        <td>
                            <?php echo $admin->admin_user; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width=80>Password</td>
                        <td width=30>:</td>
                        <td>*****</td>
                    </tr>
                    <tr>
                        <td width=80>Nama</td>
                        <td width=30>:</td>
                        <td>
                            <?php echo $admin->admin_nama; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width=80>Alamat</td>
                        <td width=30>:</td>
                        <td>
                            <?php echo $admin->admin_alamat; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width=80>No Telepon</td>
                        <td width=30>:</td>
                        <td>
                            <?php echo $admin->admin_telepon; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <a class="btn btn-block btn-primary" href="<?php echo site_url();?>pages/myaccount/edit/<?php echo $admin->admin_user;?>"> Ubah Profile </a>
        </div>
    </div>
</div>
<!-- ================================================== END VIEW ================================================== -->

<!-- ================================================== EDIT ================================================== -->
<?php } elseif ($action == 'edit') { ?>
<!-- Content -->
<div class="cl-mcont" style="margin-top: 0px !important">
    <div class="row">
        <div class="col-md-12">
            <div class="title"> Ubah Data Profile </div>
            <div class="block-flat">
                <div class="content">
                    <form role="form" class="form-horizontal" action="<?php echo site_url();?>pages/myaccount/edit" method="post" enctype="multipart/form-data"
                        parsley-validate novalidate>
                        <input type="hidden" name="admin_user" value="<?php echo $admin_user;?>" />
                        <div class="table-responsive">
                            <table class="table no-border hover">
                                <tbody class="no-border-y">
                                    <tr>
                                        <td>
                                            <label for="admin_user" class="control-label">Username <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="admin_user" type="text" required class="form-control input-sm" id="admin_user" value="<?php echo $admin_user; ?>" readonly="readonly" placeholder="Masukan Username" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="admin_pass" class="control-label">Password</label>
                                        </td>
                                        <td>
                                            <input name="admin_pass" type="password" class="form-control input-sm" id="admin_pass" value="" placeholder="Masukan Password Bila diubah" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="admin_nama" class="control-label">Nama Lengkap <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="admin_nama" type="text" required class="form-control input-sm" id="admin_nama" value="<?php echo $admin_nama; ?>" size="" placeholder="Masukan Nama Lengkap" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="admin_alamat" class="control-label">Alamat <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="admin_alamat" type="text" required class="form-control input-sm" id="admin_alamat" value="<?php echo $admin_alamat; ?>" size="50" maxlength="255" placeholder="Masukan Alamat" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="admin_telepon" class="control-label">Telepon <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="admin_telepon" type="text" required class="form-control input-sm" id="admin_telepon" value="<?php echo $admin_telepon; ?>" placeholder="Masukan No.Telepon" />
                                        </td>
                                    </tr>
                                    <?php if ($admin_photo){?>
                                    <tr>
                                        <td>
                                            <label for="admin_photo" class="control-label">Foto</label>
                                        </td>
                                        <td>
                                            <input readonly="" type="text" value="<?php echo $admin_photo; ?>" class="form-control input-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="admin_photo" class="control-label">Edit Foto</label>
                                        </td>
                                        <td>
                                            <input type="file" name="admin_photo" id="admin_photo" class="form-control btn-sm input-sm" />
                                            <div class="ket">Max. data 4MB</div>
                                        </td>
                                    </tr>
                                    <?php } else {?>
                                    <tr>
                                        <td>
                                            <label for="admin_photo" class="control-label">Foto <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="file" name="admin_photo" id="downadmin_photoload_file" required class="form-control btn-sm input-sm" />
                                            <div class="ket">Max. data 4MB</div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class='center'>
                            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data">
                            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>pages/myaccount'" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
<?php }  ?>
<!-- ================================================== END EDIT ================================================== -->