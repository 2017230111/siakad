<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	private $_guru 		=	"guru";
	private $_pegawai	=	"pegawai";
	private $_siswa		=	"siswa";

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->library('form_validation');

		if (!($this->session->userdata('nama')) && ($this->session->userdata('password'))) {
			// JIKA TIDAK ADA SESSION ADMIN
			redirect(base_url('loginadmin'));
		} elseif (!($this->session->userdata('nig')) && ($this->session->userdata('password'))) {
			// JIKA TIDAK ADA SESSION GURU
			redirect(base_url('loginguru'));
		} elseif (!($this->session->userdata('nisn')) && ($this->session->userdata('password'))) {
			// JIKA TIDAK ADA SESSION SISWA
			redirect(base_url('loginsiswa'));
		} else {
			$this->index_login();
		}
	}
	public function index()
	{
		redirect(base_url('login'));
	}

	public function index_login() // HALAMAN SETELAH ADA SESSION
	{
		// $data['judul']  =   "ass";
		$data['judul'] = 'SMAN 4 MACIPO';
		$this->db->order_by('tanggal', 'DESC');
		$this->db->limit(6);
		$data['pengumuman']    =    $this->db->get('pengumuman')->result();

		$this->load->view('template_home/header', $data);
		$this->load->view('template_home/navbar_login');
		$this->load->view('template_home/slider');
		$this->load->view('template_home/index', $data);
		$this->load->view('template_home/footer');
	}

	public function admin() // VIEW LOGIN ADMIN
	{
		$data['judul']	=	'Login Admin';
		$this->load->view('auth/header', $data);
		$this->load->view('auth/login_admin');
		$this->load->view('auth/footer');
	}

	public function siswa() // VIEW LOGIN SISWA
	{
		$data['judul']	=	'Login Siswa';
		$this->load->view('auth/header', $data);
		$this->load->view('auth/login_siswa');
		$this->load->view('auth/footer');
	}

	public function guru() // VIEW LOGIN GURU
	{
		$data['judul']	=	'Login Guru';
		$this->load->view('auth/header', $data);
		$this->load->view('auth/login_guru');
		$this->load->view('auth/footer');
	}

	public function login_admin()
	{
		$this->form_validation->set_rules('nama', 'Username Admin', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->admin();
		} else {
			$nama		=	$this->input->post('nama');
			$password	=	$this->input->post('password');
			$where 		=	"nama";
			$cek		= 	$this->login_model->cek_login($this->_pegawai, $where, $nama, $password);
			if ($cek) {
				$this->session->set_flashdata('message', 'Berhasil login');
				foreach ($cek as $row) {
					$this->session->set_userdata('nama', $row->nama);
					// redirect(base_url("admin")); // localhost/controllerAdmin
					redirect(base_url("admin/index_login"));
				}
			} else {
				$this->session->set_flashdata('message', 'username tidak');
				$this->admin();
			}
		}

		// if ($cek) {
		// 	foreach ($cek as $row) {
		// 		$this->session->set_userdata('nama', $row->nama);
		// 		redirect(base_url("admin")); // localhost/controllerAdmin
		// 	}
		// } else {
		// 	$this->admin();
		// }
	}

	public function login_guru()
	{
		$nig		=	$this->input->post('nig');
		$password	=	$this->input->post('password');
		$where 		=	"nig";
		$cek		= 	$this->login_model->cek_login($this->_guru, $where, $nig, $password);
		var_dump($cek);
		die;
		if ($cek) {
			// DATANYA ADA
			foreach ($cek as $row) {
				$this->session->set_userdata('nig', $row->nig);
				$this->session->set_userdata('nama_siswa', $row->nama_siswa);
				$this->session->set_userdata('jenis_kelamin', $row->jenis_kelamin);
				$this->session->set_userdata('username', $row->username);
				redirect(base_url("siswa")); // localhost/controllerSiswa
			}
		} else {
			$this->guru();
		}
	}

	public function login_siswa()
	{
		$nis		=	$this->input->post('nis');
		$password	=	$this->input->post('password');
		$where 		=	"nis";
		$cek		= 	$this->login_model->cek_login($this->_siswa, $where, $nis, $password);
		if ($cek) {
			// DATANYA ADA
			foreach ($cek as $row) {
				$this->session->set_userdata('nis', $row->nis);
				$this->session->set_userdata('nama_siswa', $row->nama_siswa);
				$this->session->set_userdata('jenis_kelamin', $row->jenis_kelamin);
				$this->session->set_userdata('username', $row->username);
				redirect(base_url("siswa")); // localhost/controllerSiswa
			}
		} else {
			$this->siswa();
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
