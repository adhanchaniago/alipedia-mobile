<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}

	//Fungsi Index Awal
	public function index()
	{
		redirect("pages/produk");
	}

	//Fungsi Produk
	public function produk($filter1='', $filter2='', $filter3='')
	{
		$where_admin['admin_user']	= $this->session->userdata('admin_user');
		$data['admin']				= $this->ADM->get_admin('',$where_admin);
		$data['web']				= $this->ADM->identitaswebsite();
		$data['dashboard_info']		= TRUE;
		$data['breadcrumb']         = 'Home';
		$data['content']			= 'admin/content/produk';
		$data['menu_terpilih']		= '1';
		$data['submenu_terpilih']	= '1';
		$data['batas2']				= 20;
		$data['jml_data2']			= $this->ADM->count_all_kategori("", "");
		$data['action']				= (empty($filter1))?'view':$filter1;
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('produk_nama'=>'Nama Produk');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'produk_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 4;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_produk[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_produk("", $like_produk);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			}
		$this->load->vars($data);
		$this->load->view('admin/home');
	}

	//Fungsi Detail Produk	 
	public function produk_detail($filter1='', $filter2='', $filter3='')
	{
		$where_admin['admin_user']		= $this->session->userdata('admin_user');
		$data['admin']					= $this->ADM->get_admin('',$where_admin);
		$data['web']					= $this->ADM->identitaswebsite();
		$data['dashboard_info']			= TRUE;
     	$data['breadcrumb']             = 'Home';
		$data['content']				= 'admin/content/produk_detail';
		$data['menu_terpilih']			= '1';
		$data['submenu_terpilih']		= '1';
		$data['action']				= (empty($filter1))?'detail':$filter1;
		if ($data['action'] == 'detail') {
			$data['onload']					= 'komentar_deskripsi';
			$where_produk['produk_id']= $filter2;
			$data['cari']					= ($this->input->post('cari'))?$this->input->post('cari'):'komentar_deskripsi';
			$data['q']						= ($this->input->post('q'))?$this->input->post('q'):'';
			$data['halaman']				= (empty($filter3))?1:$filter3;
			$data['batas']					= 4;
			$data['page']					= ($data['halaman']-1) * $data['batas'];
			$like_komentar[$data['cari']]	= $data['q'];
			$data['jml_data']				= $this->ADM->count_all_komentar($where_produk, $like_komentar);
			$data['jml_halaman'] 			= ceil($data['jml_data']/$data['batas']);
				
			$data['produk'] 				= $this->ADM->get_produk('*', $where_produk);
			$where_kategori['kategori_id']= $data['produk']->kategori_id;
			$data['kategori'] 				= $this->ADM->get_kategori('*', $where_kategori);
			$where_toko['toko_id']			= $data['produk']->toko_id;
			$data['toko'] 					= $this->ADM->get_toko('*', $where_toko);
			$data['produk_id']				= ($this->input->post('produk_id'))?$this->input->post('produk_id'):'';
			$data['komentar_deskripsi']		= ($this->input->post('komentar_deskripsi'))?$this->input->post('komentar_deskripsi'):'';
			
			$simpan							= $this->input->post('simpan');
				if ($simpan){
					$insert['komentar_deskripsi']	= validasi_sql($data['komentar_deskripsi']);
					$insert['komentar_created']		= date("Y-m-d H:i:s");
					$insert['admin_user']			= $this->session->userdata('admin_user');
					$insert['produk_id']			= validasi_sql($data['produk_id']);
					$this->ADM->insert_komentar($insert);
					$this->session->set_flashdata('success','komentar telah berhasil ditambahkan!,');
					redirect("pages/produk_detail/detail/".$data['produk_id']."");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_delete['komentar_id']		= validasi_sql($filter2);
				$row = $this->ADM->get_komentar('*', $where_delete);

				$this->ADM->delete_komentar($where_delete);
				$this->session->set_flashdata('warning','Komentar telah berhasil dihapus!,');
				redirect("pages/produk_detail/detail/".$row->produk_id."");
			}
		$this->load->vars($data);
		$this->load->view('admin/home');
	 }

	//Fungsi Beli Produk di Page Produk
	 public function produk_beli($produk_id="")
	 {
		$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
		$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
		$data['web']				= $this->ADM->identitaswebsite();
		$where_produk['produk_id']	= $produk_id;
		$data['produk'] 			= $this->ADM->get_produk('*', $where_produk);
		$data['action']				= 'detail';

		$data['transaksi_jumlah']	= ($this->input->post('transaksi_jumlah'))?$this->input->post('transaksi_jumlah'):'';
		$data['transaksi_bukti']	= ($this->input->post('transaksi_bukti'))?$this->input->post('transaksi_bukti'):'';
		$data['produk_stock']		= ($this->input->post('produk_stock'))?$this->input->post('produk_stock'):'';
			
		$simpan					= $this->input->post('simpan');
		if ($simpan){
			if ($data['produk_stock'] >= $data['transaksi_jumlah']) {
				$data = array(
				   'id'      => $produk_id,
				   'qty'     => validasi_sql($data['transaksi_jumlah']),
				   'price'   => $data['produk']->produk_harga,
				   'name'   => $data['produk'] ->produk_nama
				);
				$this->cart->insert($data);
				$this->session->set_flashdata('success','Pembelian sudah dimasukan ke keranjang belanja');
				redirect("pages/produk");
			} else {
				$this->session->set_flashdata('warning','Stock yang tersedia kurang!');
				redirect("pages/produk");
			}
		}
		$this->load->vars($data);
		$this->load->view('admin/content/produk');
	 }

	//Fungsi Beli Produk di Page Detail Produk
	public function produkdetail_beli($produk_id="")
	{
	   $where_admin['admin_user'] 	= $this->session->userdata('admin_user');
	   $data['admin'] 				= $this->ADM->get_admin('',$where_admin);
	   $data['web']				= $this->ADM->identitaswebsite();
	   $where_produk['produk_id']	= $produk_id;
	   $data['produk'] 			= $this->ADM->get_produk('*', $where_produk);
	   $data['action']				= 'beli';

	   $data['transaksi_jumlah']	= ($this->input->post('transaksi_jumlah'))?$this->input->post('transaksi_jumlah'):'';
	   $data['transaksi_bukti']	= ($this->input->post('transaksi_bukti'))?$this->input->post('transaksi_bukti'):'';
	   $data['produk_stock']		= ($this->input->post('produk_stock'))?$this->input->post('produk_stock'):'';
		   
	   $simpan					= $this->input->post('simpan');
	   if ($simpan){
		   if ($data['produk_stock'] >= $data['transaksi_jumlah']) {
			   $data = array(
				  'id'      => $produk_id,
				  'qty'     => validasi_sql($data['transaksi_jumlah']),
				  'price'   => $data['produk']->produk_harga,
				  'name'   => $data['produk'] ->produk_nama
			   );
			   $this->cart->insert($data);
			   $this->session->set_flashdata('success','Pembelian sudah dimasukan ke keranjang belanja');
			   redirect("pages/produk_detail/detail/".$produk_id."");
		   } else {
			   $this->session->set_flashdata('warning','Stock yang tersedia kurang!');
			   redirect("pages/produk_detail/detail/".$produk_id."");
		   }
	   }
	   $this->load->vars($data);
	   $this->load->view('admin/content/produk_detail');
	}


	//Fungsi Beli Produk di Page Kategori Produk
	public function produkkategori_beli($produk_id="")
	{
		$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
		$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
		$data['web']				= $this->ADM->identitaswebsite();
		$where_produk['produk_id']	= $produk_id;
		$data['produk'] 			= $this->ADM->get_produk('*', $where_produk);
		$data['action']				= 'beli';
 
		$data['transaksi_jumlah']	= ($this->input->post('transaksi_jumlah'))?$this->input->post('transaksi_jumlah'):'';
		$data['transaksi_bukti']	= ($this->input->post('transaksi_bukti'))?$this->input->post('transaksi_bukti'):'';
		$data['produk_stock']		= ($this->input->post('produk_stock'))?$this->input->post('produk_stock'):'';
			
		$simpan					= $this->input->post('simpan');
		if ($simpan){
			if ($data['produk_stock'] >= $data['transaksi_jumlah']) {
				$data = array(
				   'id'      => $produk_id,
				   'qty'     => validasi_sql($data['transaksi_jumlah']),
				   'price'   => $data['produk']->produk_harga,
				   'name'   => $data['produk'] ->produk_nama
				);
				$this->cart->insert($data);
				$this->session->set_flashdata('success','Pembelian sudah dimasukan ke keranjang belanja');
				redirect("pages/produk");
			} else {
				$this->session->set_flashdata('warning','Stock yang tersedia kurang!');
				redirect("pages/produk");
			}
		}
		$this->load->vars($data);
		$this->load->view('admin/content/kategori');
	}

	//Fungsi Keranjang
	public function keranjang($filter1='', $filter2='', $filter3='')
	{
		$where_admin['admin_user']	= $this->session->userdata('admin_user');
		$data['admin']				= $this->ADM->get_admin('',$where_admin);
		$data['web']				= $this->ADM->identitaswebsite();
		$data['dashboard_info']		= TRUE;
		$data['breadcrumb']         = 'Keranjang Belanja';
		$data['content']			= 'admin/content/keranjang';
		$data['menu_terpilih']		= '1';
		$data['submenu_terpilih']	= '1';
		$data['action']				= (empty($filter1))?'view':$filter1;
			if ($data['action'] == 'view'){
			}
		$this->load->vars($data);
		$this->load->view('admin/home');
	}
		
	public function update_cart(){
        $cart_info =  $_POST['cart'] ;
 		foreach( $cart_info as $id => $cart)
		{	
                    $rowid = $cart['rowid'];
                    $price = $cart['price'];
                    $amount = $price * $cart['qty'];
                    $qty = $cart['qty'];
                    
            $data = array(
				'rowid'   => $rowid,
                'price'   => $price,
                'amount' =>  $amount,
				'qty'     => $qty
			);
             
			$this->cart->update($data);
		}
		redirect('pages/keranjang');        
	}	
	
	function remove($rowid) {
		if ($rowid==="all"){
			$this->cart->destroy();
		}else{
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
			$this->cart->update($data);
		}
		redirect('pages/keranjang');
	}

	public function clear_cart()
	{
		$this->cart->destroy();
		redirect(base_url());
	}


	//Fungsi Kategori
	public function kategori($filter1='', $filter2='', $filter3='')
	{
		$where_admin['admin_user']		= $this->session->userdata('admin_user');
		$data['admin']					= $this->ADM->get_admin('',$where_admin);
		$data['web']					= $this->ADM->identitaswebsite();
		$data['dashboard_info']			= TRUE;
		$data['breadcrumb']             = 'Home';
		$data['content']				= 'admin/content/kategori';
		$data['menu_terpilih']			= '1';
		$data['submenu_terpilih']		= '1';
		$data['action']				= (empty($filter1))?'view':$filter1;
		if ($data['action'] == 'detail') {
			$data['onload']					= 'kategori_jenis';
			$where_kategori['kategori_id']= $filter2;
			$data['kategori'] 			= $this->ADM->get_kategori('*', $where_kategori);

			$data['berdasarkan']		= array('produk_nama'=>'Nama Produk');
			$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'produk_nama';
			$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
			$data['halaman']			= (empty($filter3))?1:$filter3;
			$data['batas']				= 4;
			$data['page']				= ($data['halaman']-1) * $data['batas'];
			$like_produk[$data['cari']]	= $data['q'];
			$data['jml_data']			= $this->ADM->count_all_produk($where_kategori, $like_produk);
			$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
		}
		$this->load->vars($data);
		$this->load->view('admin/home');
	}
	 
	//Fungsi Ubah Kata Sandi
	public function edit_password($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user']			= $this->session->userdata('admin_user');
			$data['web']					= $this->ADM->identitaswebsite();
			$data['admin']						= $this->ADM->get_admin('',$where_admin);
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']			= FALSE;
			$data['content']					= 'admin/content/edit_password';
			$data['menu_terpilih']				= '1';
			$data['submenu_terpilih']			= '';
			$data['validasi']					= array('admin_pass_recent'=>'Password Sekarang','admin_pass'=>'Password Baru','admin_pass_ulang'=>'Password Baru');

			$data['admin_user']				= $this->session->userdata('admin_user');
			$data['admin_pass_recent']			= ($this->input->post('admin_pass_recent'))?$this->input->post('admin_pass_recent'):'';
			$data['admin_pass']				= ($this->input->post('admin_pass'))?$this->input->post('admin_pass'):'';
			$data['admin_pass_ulang']			= ($this->input->post('admin_pass_ulang'))?$this->input->post('admin_pass_ulang'):'';
			$data['admin_pass2']				= ($this->input->post('admin_pass2'))?$this->input->post('admin_pass2'):'';

			$simpan							= $this->input->post('simpan');
			if($simpan){
				if(do_hash($data['admin_pass_recent'], 'md5') == $data['admin']->admin_pass) {
					if($data['admin_pass'] == $data['admin_pass_ulang']) {
						$where_edit['admin_user']	= validasi_sql($data['admin_user']);
						if($data['admin_pass'] <> '') {
							$edit['admin_pass']		= validasi_sql(do_hash(($data['admin_pass']), 'md5'));
							$edit['admin_pass2']		= validasi_sql($data['admin_pass']);
						}
						$this->ADM->update_admin($where_edit, $edit);
						$this->session->set_flashdata('success','Password Berhasil Diubah!,');
						redirect("pages/edit_password");
					} else {
						$this->session->set_flashdata('error','Password Tidak Sesuai!,');
						redirect("pages/edit_password");
					}
				} else {
					$this->session->set_flashdata('warning','Password Sekarang Salah!,');
					redirect("pages/edit_password");
				}
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	//Fungsi Profile	 
	public function myaccount($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			$data['dashboard_info']			= TRUE;
			$data['breadcrumb']             = 'Home';
			$data['content']				= 'admin/content/myaccount';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '1';
			$data['action']				= (empty($filter1))?'view':$filter1;
			if ($data['action'] == 'view') {
				
			} 
			else if ($data['action'] == 'edit') {
				$where['admin_user']		= $filter2;
				$data['validate']			= array('admin_user'=>'Pengguna',
													'admin_nama'=>'Nama Lengkap',
													'admin_alamat'=>'Alamat');
				$data['onload']					= 'admin_user';
				error_reporting(0);
				$where_admin['admin_user']		= $filter2;
				$admin							= $this->ADM->get_admin('*', $where_admin);
				$data['admin_user']				= ($this->input->post('admin_user'))?$this->input->post('admin_user'):$admin->admin_user;
				$data['admin_pass']				= ($this->input->post('admin_pass'))?$this->input->post('admin_pass'):$admin->admin_pass;
				$data['admin_nama']				= ($this->input->post('admin_nama'))?$this->input->post('admin_nama'):$admin->admin_nama;
				$data['admin_alamat']			= ($this->input->post('admin_alamat'))?$this->input->post('admin_alamat'):$admin->admin_alamat;
				$data['admin_telepon']			= ($this->input->post('admin_telepon'))?$this->input->post('admin_telepon'):$admin->admin_telepon;
				$data['admin_photo']			= ($this->input->post('admin_photo'))?$this->input->post('admin_photo'):$admin->admin_photo;
				$simpan							= $this->input->post('simpan');
				if ($simpan){
					$gambar	= upload_image("admin_photo", "./assets/images/avatar/", "400x400");
					$data['admin_photo']	= $gambar;
					$where_edit['admin_user']	= validasi_sql($data['admin_user']);
					if ($data['admin_pass'] <> '') {
						$edit['admin_pass']			= validasi_sql(do_hash(($data['admin_pass']), 'md5')); 
						$edit['admin_pass2']		= validasi_sql($data['admin_pass']);
					}
					$edit['admin_nama']			= validasi_sql($data['admin_nama']);
					$edit['admin_alamat']		= validasi_sql($data['admin_alamat']);
					$edit['admin_telepon']		= validasi_sql($data['admin_telepon']);
					if ($data['admin_photo']) { 
						$row = $this->ADM->get_admin('*', $where_edit);
						@unlink('./assets/images/avatar/'.$row->admin_photo);
						@unlink('./assets/images/avatar/kecil_'.$row->admin_photo);
						$edit['admin_photo']	= $data['admin_photo']; 
					}
				$this->ADM->update_admin($where_edit, $edit);
				$this->session->set_flashdata('success','Pengguna telah berhasil diedit!,');
				redirect("pages/myaccount");
				}
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	//Fungsi Toko
	public function toko($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			$data['dashboard_info']			= TRUE;
			$data['breadcrumb']             = 'Home';
			$data['content']				= 'admin/content/toko';
			@date_default_timezone_set('Asia/Jakarta');
			$where_toko['admin_user']= $this->session->userdata('admin_user');
			$data['toko'] 			= $this->ADM->get_toko('*', $where_toko);
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '1';
			$data['action']				= (empty($filter1))?'view':$filter1;
			if ($data['action'] == 'view'){
				$data['jml_data2']			= $this->ADM->count_all_toko("", $where_toko);
			  	$data['berdasarkan']		= array('produk_nama'=>'Nama Produk');
			  	$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'produk_nama';
			  	$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
			  	$data['halaman']			= (empty($filter2))?1:$filter2;
			  	$data['batas']				= 6;
			  	$data['page']				= ($data['halaman']-1) * $data['batas'];
			  	$like_produk[$data['cari']]	= $data['q'];
			  	$data['jml_data']			= $this->ADM->count_all_produk($where_toko, $like_produk);
			  	$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				$data['toko_nama']	= ($this->input->post('toko_nama'))?$this->input->post('toko_nama'):'';
				$data['toko_deskripsi']	= ($this->input->post('toko_deskripsi'))?$this->input->post('toko_deskripsi'):'';
				$data['toko_bank']	= ($this->input->post('toko_bank'))?$this->input->post('toko_bank'):'';
				$data['toko_norek']	= ($this->input->post('toko_norek'))?$this->input->post('toko_norek'):'';
				$data['toko_atasnama']	= ($this->input->post('toko_atasnama'))?$this->input->post('toko_atasnama'):'';
				$simpan						= $this->input->post('simpan');
				$update						= $this->input->post('update');
				if ($simpan){
					$insert['toko_nama']			= validasi_sql($data['toko_nama']);
					$insert['toko_deskripsi']		= validasi_sql($data['toko_deskripsi']);
					$insert['toko_bank']			= validasi_sql($data['toko_bank']);
					$insert['toko_norek']		= validasi_sql($data['toko_norek']);
					$insert['toko_atasnama']		= validasi_sql($data['toko_atasnama']);
					$insert['toko_created']		= date("Y-m-d H:i:s");
					$insert['admin_user']		= $this->session->userdata('admin_user');
					$this->ADM->insert_toko($insert);
					$this->session->set_flashdata('success','toko baru telah berhasil ditambahkan!,');
					redirect("pages/toko");
				}
				if ($update){
					$where_edit['admin_user']= $this->session->userdata('admin_user');
					$edit['toko_nama']		= validasi_sql($data['toko_nama']);
					$edit['toko_deskripsi']		= validasi_sql($data['toko_deskripsi']);
					$edit['toko_bank']		= validasi_sql($data['toko_bank']);
					$edit['toko_norek']		= validasi_sql($data['toko_norek']);
					$edit['toko_atasnama']		= validasi_sql($data['toko_atasnama']);
					$this->ADM->update_toko($where_edit, $edit);
					$this->session->set_flashdata('warning','Toko telah berhasil diedit!,');
					redirect("pages/toko");
				}
			} elseif ($data['action'] == 'tambah'){
				$data['kategori_id']	= ($this->input->post('kategori_id'))?$this->input->post('kategori_id'):'';
				$data['produk_nama']	= ($this->input->post('produk_nama'))?$this->input->post('produk_nama'):'';
				$data['produk_deskripsi']	= ($this->input->post('produk_deskripsi'))?$this->input->post('produk_deskripsi'):'';
				$data['produk_stock']	= ($this->input->post('produk_stock'))?$this->input->post('produk_stock'):'';
				$data['produk_harga']	= ($this->input->post('produk_harga'))?$this->input->post('produk_harga'):'';
				$data['produk_photo']	= ($this->input->post('produk_photo'))?$this->input->post('produk_photo'):'';
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$gambar	= upload_image("produk_photo", "./assets/images/produk/", "400x400");
					$data['produk_photo']			= $gambar;
					$insert['kategori_id']			= validasi_sql($data['kategori_id']);
					$insert['toko_id']				= $data['toko']->toko_id;
					$insert['produk_nama']			= validasi_sql($data['produk_nama']);
					$insert['produk_deskripsi']		= validasi_sql($data['produk_deskripsi']);
					$insert['produk_stock']			= validasi_sql($data['produk_stock']);
					$insert['produk_harga']			= validasi_sql($data['produk_harga']);
					$insert['produk_created']		= date("Y-m-d H:i:s");
					if ($data['produk_photo']) { 
						$insert['produk_photo']	= $data['produk_photo']; 
					}
					$insert['admin_user']		= $this->session->userdata('admin_user');
					$this->ADM->insert_produk($insert);
					$this->session->set_flashdata('success','Produk baru telah berhasil ditambahkan!,');
					redirect("pages/toko");
				}
			} elseif ($data['action'] == 'edit'){
				$where['produk_id']	= $filter2;
				$data['onload']					= 'produk_nama';
				$where_produk['produk_id']	= $filter2;
				$produk				= $this->ADM->get_produk('*', $where_produk);
				$data['produk_id']			= ($this->input->post('produk_id'))?$this->input->post('produk_id'):$produk->produk_id;
				$data['kategori_id']		= ($this->input->post('kategori_id'))?$this->input->post('kategori_id'):$produk->kategori_id;
				$data['produk_nama']		= ($this->input->post('produk_nama'))?$this->input->post('produk_nama'):$produk->produk_nama;
				$data['produk_deskripsi']	= ($this->input->post('produk_deskripsi'))?$this->input->post('produk_deskripsi'):$produk->produk_deskripsi;
				$data['produk_harga']		= ($this->input->post('produk_harga'))?$this->input->post('produk_harga'):$produk->produk_harga;
				$data['produk_stock']		= ($this->input->post('produk_stock'))?$this->input->post('produk_stock'):$produk->produk_stock;
				$data['produk_photo']		= ($this->input->post('produk_photo'))?$this->input->post('produk_photo'):$produk->produk_photo;
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$where_edit['produk_id']	= $data['produk_id'];
					$edit['kategori_id']		= $data['kategori_id'];
					$edit['produk_nama']		= $data['produk_nama'];
					$edit['produk_deskripsi']	= $data['produk_deskripsi'];
					$edit['produk_stock']		= $data['produk_stock'];
					$edit['produk_harga']		= $data['produk_harga'];
					$gambar	= upload_image("produk_photo", "./assets/images/produk/", "400x400");
					$data['produk_photo']		= $gambar;
					if ($data['produk_photo']) { 
						$row = $this->ADM->get_produk('*', $where_edit);
						@unlink('./assets/images/produk/'.$row->produk_photo);
						@unlink('./assets/images/produk/kecil_'.$row->produk_photo);
						$edit['produk_photo']	= $data['produk_photo']; 
					}
					$this->ADM->update_produk($where_edit, $edit);
					$this->session->set_flashdata('success','Produk telah berhasil diedit!,');
					redirect("pages/toko");
				}
			} elseif ($data['action'] == 'hapus'){
				$where_delete['produk_id']		= validasi_sql($filter2);
				$row = $this->ADM->get_produk('*', $where_delete);
				@unlink('./assets/images/produk/'.$row->produk_photo);
				@unlink('./assets/images/produk/kecil_'.$row->produk_photo);

				$this->ADM->delete_produk($where_delete);
				$this->session->set_flashdata('warning','Produk telah berhasil dihapus!,');
				redirect("pages/toko");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	public function konfirmasi()
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			date_default_timezone_set('Asia/Jakarta');
			$admin_user = $this->session->userdata('admin_user');
			$invoice_subtotal  = $this->cart->total();
			$invoice = array(
						'invoice_date'		=> date('Y-m-d'),
	                	'admin_user'=> $admin_user,
	                	'invoice_subtotal' => $invoice_subtotal,
						'invoice_confirm'	=> 'false',
						'invoice_status'	=> 'unpaid'
			);
			$this->db->insert('invoice', $invoice);
			$pesanan_invoice = $this->db->insert_id();
			$tanggal_sekarang = date('Y-m-d');

			if($cart = $this->cart->contents() ):
			foreach($cart as $item):
				$where_produk['produk_id']	= $item['id'];
				$data['produk'] 			= $this->ADM->get_produk('*', $where_produk);
				$data = array(
					'invoice_id'	=> $pesanan_invoice,
					'produk_id'		    => $item['id'],
					'toko_id'	=>  $data['produk']->toko_id,
					'produk_nama'		=> $item['name'],
					'transaksi_jumlah'		=> $item['qty'],
					'transaksi_harga'		=> $item['price'],
	                'transaksi_totalharga'  => $item['subtotal'],
					'transaksi_confirm'	=> 'false',
					'transaksi_status'	=> 'unpaid',
	                'transaksi_created'	=> $tanggal_sekarang,
	                'admin_user'=> $admin_user
				);
				$this->db->insert('transaksi', $data);
			endforeach;
			endif;
			$this->cart->destroy();
			$this->session->set_flashdata('success','Terimakasih telah melakukan pesanan!');
			redirect('pages/pesanan');
		} else {
		  redirect("wp_login");
		}
	}

	//Fungsi Pesanan
	public function pesanan($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			$data['dashboard_info']			= TRUE;
     		$data['breadcrumb']             = 'Home';
			$data['content']				= 'admin/content/pesanan';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '1';
			$data['action']				= (empty($filter1))?'view':$filter1;
			if ($data['action'] == 'view') {
				$data['berdasarkan']		= array('invoice_id'=>'No Invoice');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'invoice_id';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 4;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_invoice[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_invoice($where_admin, $like_invoice);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	
	//Fungsi Konfirmasi Pembayaran
	public function konfirmasipembayaran($invoice_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 			= $this->session->userdata('admin_user');
			$data['admin'] 						= $this->ADM->get_admin('',$where_admin);
			$data['web']						= $this->ADM->identitaswebsite();
			$where_invoice['invoice_id']	= $invoice_id;
			$data['invoice'] 					= $this->ADM->get_invoice('*', $where_invoice);
			$data['action']						= 'detail';
			 
			$data['invoice_bukti']	= ($this->input->post('invoice_bukti'))?$this->input->post('invoice_bukti'):'';
			$simpan					= $this->input->post('simpan');
			if ($simpan){
				$gambar	= upload_image("invoice_bukti", "./assets/images/transaksi/", "400x400");
				$data['invoice_bukti']	= $gambar;
				if ($data['invoice_bukti']) { 
					$edit['invoice_bukti']	= $data['invoice_bukti']; 
				}
				$edit['invoice_status']	= "paid";
				$this->ADM->update_invoice($where_invoice, $edit);

				$edit2['transaksi_status']	= "paid";
				$edit2['transaksi_statusadmin']	= "unpaid";
				$this->ADM->update_transaksi($where_invoice, $edit2);

				$this->session->set_flashdata('success','Pembelian Produk telah berhasil, Tunggu penjual Mengkonfirmasi Pembelian Anda!');
				redirect("pages/pesanan");
			}
			$this->load->vars($data);
			$this->load->view('admin/content/pesanan');
		} else {
			redirect("wp_login");
		}
	}

	//Fungsi Konfirmasi Admin
	public function konfirmasipembayaranadmin($transaksi_id="")
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 			= $this->session->userdata('admin_user');
			$data['admin'] 						= $this->ADM->get_admin('',$where_admin);
			$data['web']						= $this->ADM->identitaswebsite();
			$where_transaksi['transaksi_id']	= $transaksi_id;
			$data['transaksi'] 					= $this->ADM->get_transaksi('*', $where_transaksi);

			
			$where_produk['produk_id']			= $data['transaksi']->produk_id;
			$data['produk'] 					= $this->ADM->get_produk('*', $where_produk);

			$data['action']						= 'detail';
			 
			$data['transaksi_resi']	= ($this->input->post('transaksi_resi'))?$this->input->post('transaksi_resi'):'';
			$simpan					= $this->input->post('simpan');
			if ($simpan){
				$gambar	= upload_image("transaksi_resi", "./assets/images/resi/", "400x400");
				$data['transaksi_resi']	= $gambar;
				if ($data['transaksi_resi']) { 
					$edit['transaksi_resi']	= $data['transaksi_resi']; 
				}
				$edit['transaksi_confirm']	= "true";
				$edit['transaksi_end']	= "false";
				$this->ADM->update_transaksi($where_transaksi, $edit);

				$edit2['produk_stock']	= $data['produk']->produk_stock - $data['transaksi']->transaksi_jumlah;
				$this->ADM->update_produk($where_produk, $edit2);

				$this->session->set_flashdata('success','Konfirmasi Pembayaran telah berhasil');
				redirect("pages/transaksi");
			}
			$this->load->vars($data);
			$this->load->view('admin/content/transaksi');
		} else {
			redirect("wp_login");
		}
	}

	//Fungsi Transaksi
	public function transaksi($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			$data['dashboard_info']			= TRUE;
			$data['breadcrumb']             = 'Home';
			$data['content']				= 'admin/content/transaksi';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '1';
			$data['action']				= (empty($filter1))?'view':$filter1;
			if ($data['action'] == 'view') {
				$where_toko['admin_user']= $this->session->userdata('admin_user');
				$data['jml_data2']			= $this->ADM->count_all_toko("", $where_toko);
				if ($data['jml_data2'] >= 1) {
				$data['toko'] 			= $this->ADM->get_toko('*', $where_toko);
				$where_produk['admin_user']= $data['toko']->admin_user;
				$data['jml_produk']			= $this->ADM->count_all_produk("", $where_produk);
				if ($data['jml_produk'] >= 1) {
				$data['produk'] 			= $this->ADM->get_produk('*', $where_produk);
				$where_transaksi['toko_id']= $data['produk']->toko_id;
				$data['berdasarkan']		= array('transaksi_id'=>'No Transaksi');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'transaksi_id';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$like_transaksi[$data['cari']]	= $data['q'];
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['jml_data']			= $this->ADM->count_all_transaksi($where_transaksi, $like_transaksi);
				$data['batas']				= 4;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} else {
					$where_transaksi['toko_id']= "belum ada";
					$data['berdasarkan']		= array('transaksi_id'=>'No Transaksi');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'transaksi_id';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$like_transaksi[$data['cari']]	= $data['q'];
					$data['jml_data']			= $this->ADM->count_all_transaksi($where_transaksi, $like_transaksi);
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 4;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
					
				}

				}
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			 redirect("wp_login");
		}
	}
}