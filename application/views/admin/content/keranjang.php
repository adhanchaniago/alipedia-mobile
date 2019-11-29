<style>
    .title {
        margin-bottom: 20px;
        text-align: center;
        font-size: 18px;
    }

    .blocks {
        cursor: default;
    }
</style>
<script type="text/javascript">
    function clear_cart() {
        var result = confirm('Hapus Semua Pesanan di keranjang?');

        if (result) {
            window.location = "<?php echo base_url(); ?>pages/remove/all";
        } else {
            return false; 
        }
    }
</script>

<!-- ================================================== DETAIL ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<div class="cl-mcont" style="margin-top: 0px !important">
    <div class='row'>
        <div class="col-xs-12 col-md-12">
            <div class="title"> Keranjang Belanja</div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="block-flat">
                <div class="content">
                    <?php   if($this->cart->total_items() == 0 ) { ?>
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-check sign"></i> Keranjang anda kosong, silakan berbelanja.
                    </div>
                    <?php } else { ?>
                    <div class="table-responsive">
                        <table class="hover">
                            <thead class="primary-emphasis">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Sub Total</th>
                                    <th width=30>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="<?php echo site_url();?>pages/update_cart" method='POST' accept-charset="utf-8">
                                    <?php
                                    $grand_total = 0;
                                    $i = 1;
                                    foreach ($this->cart->contents() as $item):
                                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $i++; ?> </td>
                                            <td>
                                                <?php echo $item['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="1" class="form-control"'); ?>
                                            </td>
                                            <td align="right">Rp
                                                <?php echo number_format($item['price'],0,',','.'); ?>,00</td>
                                            <td align="right">Rp
                                                <?php echo number_format($item['subtotal'],0,',','.') ?>,00</td>
                                            <td><a class="btn btn-danger btn-block" href="<?php echo site_url();?>pages/remove/<?php echo $item['rowid'];?>"
                                                    class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>

                                        <tr>
                                            <td align="right" colspan="4">Total </td>
                                            <td align="right"><b>Rp<?php echo number_format($this->cart->total(),0,',','.'); ?>,00</b></td>
                                            <td align="right"> </td>
                                        </tr>

                                        <tr>
                                            <td colspan="6">
                                                <input type="button" style="margin-top:10px !important" class='btn btn-danger btn-block' value="Bersihkan Keranjang Belanja"
                                                 onclick="clear_cart()">
                                                <input style="margin-top:10px !important;" type="submit" class='btn btn-default btn-block' value="Update Keranjang Belanja">
                                                <?php if($this->session->userdata('logged_in') == TRUE) { ?>
                                                <a href="<?php echo site_url();?>pages/konfirmasi"><input style="margin-top:10px !important;"  class='btn btn-success btn-block' value='Selesai Pembelian'></a>
                                                <?php } else { ?>
                                                <a style="margin-top:20px !important;" class='blocks btn btn-warning btn-block btn-sm'>Login Terlebih dahulu</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <div class="end"></div>
    <!-- ================================================== END VIEW ================================================== -->
    <?php } ?>