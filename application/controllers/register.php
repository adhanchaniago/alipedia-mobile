<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login', 'LOG', TRUE);
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}

	public function index()
	{
        if ($this->session->userdata('logged_in') == TRUE){
            redirect('admin/','refresh');
        } else {
		$data['web']	= $this->ADM->identitaswebsite();
		$this->load->vars($data);
		$this->load->view('admin/register');
		}
	}

	public function daftar()
	{
		$data['admin_user']				= ($this->input->post('admin_user'))?$this->input->post('admin_user'):'';
		$data['admin_pass']				= ($this->input->post('admin_pass'))?$this->input->post('admin_pass'):'';
		$data['admin_nama']				= ($this->input->post('admin_nama'))?$this->input->post('admin_nama'):'';
		$data['admin_alamat']			= ($this->input->post('admin_alamat'))?$this->input->post('admin_alamat'):'';
		$data['admin_telepon']			= ($this->input->post('admin_telepon'))?$this->input->post('admin_telepon'):'';
		$where_admin['admin_user']		= $data['admin_user'];
		$admin							= $this->ADM->get_admin('*', $where_admin);
		$jml_pengguna					= $this->ADM->count_all_admin($where_admin);
		if($jml_pengguna > 0)
		{
			$this->session->set_flashdata('warning','Username sudah terdaftar');
			redirect("register");
		} else {
			$insert['admin_user']		= validasi_sql($data['admin_user']);
			$insert['admin_pass']		= validasi_sql(do_hash(($data['admin_pass']), 'md5'));
			$insert['admin_pass2']		= validasi_sql($data['admin_pass']);
			$insert['admin_nama']		= validasi_sql($data['admin_nama']);
			$insert['admin_alamat']		= validasi_sql($data['admin_alamat']);
			$insert['admin_telepon']	= validasi_sql($data['admin_telepon']);
			$insert['admin_level_kode']	= validasi_sql(6);
			$insert['admin_status']	= validasi_sql('A');
			$this->ADM->insert_admin($insert);
			$this->session->set_flashdata('success','Berhasil terdaftar!,');
			redirect("register");
		}
	}
}
