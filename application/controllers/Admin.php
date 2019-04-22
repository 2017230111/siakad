<?php

class Admin extends CI_Controller
{
    private $_tblpengumuman = "pengumuman";
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_siswa");
        $this->load->helper(array('form', 'url'));
        $this->load->model("Guru_model");
        $this->load->model("Pegawai_model");
        $this->load->model("M_pengumuman");
        $this->load->model('login_model');

        if (!($this->session->userdata('nama')) && ($this->session->userdata('password'))) {
            redirect(base_url('loginadmin'));
        } else {
            $this->index_login();
        }
    }
    public function index() // HALAMAN SEBELUM ADA SESSION
    {
        $data['judul'] = "Wellcome To Administrator";
        $data["pengumuman"] = $this->M_pengumuman->getAll();
        $this->load->view('template_admin/header', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
    public function index_login() // HALAMAN SETELAH ADA SESSION
    {
        // $data['judul']  =   "ass";
        $data['judul'] = 'SMAN 4 MACIPO';
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit(6);
        $data['pengumuman']    =    $this->db->get($this->_tblpengumuman)->result();

        $this->load->view('template_home/header', $data);
        $this->load->view('template_home/navbar_login');
        $this->load->view('template_home/slider');
        $this->load->view('template_home/index', $data);
        $this->load->view('template_home/footer');
    }
    public function pengumuman()
    {
        $this->load->view('template_admin/header');
        $this->load->view('admin/pengumuman');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
    public function nilaisiswaipa()
    {
        $this->load->view('template_admin/header');
        $this->load->view('admin/nilaisiswaipa');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
    public function daftarsiswaspp()
    {
        $this->load->view('template_admin/header');
        $this->load->view('admin/daftarsiswaspp');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
    public function nilaisiswaips()
    {
        $this->load->view('template_admin/header');
        $this->load->view('admin/nilaisiswaips');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
    public function statusspp()
    {
        $this->load->view('template_admin/header');
        $this->load->view('admin/statusspp');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
    public function listguru()
    {
        $data["guru"] = $this->Guru_model->getAll();
        $this->load->view('template_admin/header');
        $this->load->view('admin/listguru', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
    public function listsiswa()
    {
        $data['siswa'] = $this->M_siswa->getAll();
        $data['sisw a'] = $this->M_siswa->getAll();
        $this->load->view('template_admin/header');
        $this->load->view('admin/listsiswa', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }

    public function listpegawai()
    {
        $data["pegawai"] = $this->Pegawai_model->getAll();
        $this->load->view('template_admin/header');
        $this->load->view('admin/listpegawai', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
    public function listpengumuman()
    {
        $data["pengumuman"] = $this->M_pengumuman->getAll();
        $this->load->view('template_admin/header');
        $this->load->view('admin/listpengumuman', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }

    public function addguru()
    {
        $data['judul'] = "Halaman Tambah Guru";
        $this->load->view('template_admin/header');
        $this->load->view('admin/addguru');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }

    public function addsiswa()
    {
        $data['judul'] = "Halaman Tambah Siswa";
        $this->load->view('template_admin/header', $data);
        $this->load->view('admin/addsiswa');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
    public function addpegawai()
    {
        $data['judul'] = "Halaman Tambah Pegawai";
        $this->load->view('template_admin/header', $data);
        $this->load->view('admin/addpegawai');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
    public function editguru()
    {
        $this->load->view('template_admin/header');
        $this->load->view('admin/editguru');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
    public function editpegawai()
    {
        $this->load->view('template_admin/header');
        $this->load->view('admin/editpegawai');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
    public function uploadjadwal()
    {
        $this->load->view('template_admin/header');
        $this->load->view('admin/jadwal');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/footer');
    }
}
