<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	private $_tblpengumuman	= "pengumuman";
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$data['judul'] = 'SMAN 4 MACIPO';

		$this->db->order_by('tanggal', 'DESC');
		$this->db->limit(6);
		$data['pengumuman']	=	$this->db->get($this->_tblpengumuman)->result();

		$this->load->view('template_home/header', $data);
		$this->load->view('template_home/navbar');
		$this->load->view('template_home/slider');
		$this->load->view('template_home/index', $data);
		$this->load->view('template_home/footer');
	}
	public function pengumuman($id)
	{
		$this->db->where('id', $id);
		$data['pengumuman'] = $this->db->get($this->_tblpengumuman)->result();
		$this->load->view('template_home/pengumuman', $data);
	}
}
