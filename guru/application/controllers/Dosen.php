<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {


	public function __construct()
    {
        parent::__construct();

        // CHECK LOGIN
        if($this->session->userdata('level') != 9){
        	$this->session->set_flashdata("error","Anda harus login untuk mengakses halaman ini ");
        	redirect("../auth/masuk");
        }

        // MODEL
        $this->load->model("Guru_model");

        // JS
		$data['js'] = '';
		$data['validasi'] = '';
    }
	

	public function index()
	{
		$data['js'] = '';
		$data['validasi'] = '';

		// DATA DOSEN
		$data['dosen'] 		= $this->Guru_model->get_dosen();
		$data['folder_foto_guru']	= base_url()."../upload/foto/guru/";
		$this->load->view('template/header');
		$this->load->view('dosen/index', $data);
		$this->load->view('template/footer');
	}

	public function detail($dosen = 0)
	{	
		if($dosen > 0){
			$data['js'] = '';
			$data['validasi'] = '';

			//DETAIL DOSEN
			$data['dosen'] 		= $this->Guru_model->get_detail_dosen($dosen);
			$data['mapel'] 		= "";//$this->Guru_model->get_mapel_dosen($dosen);
			$data['folder_foto_guru']	= base_url()."../upload/foto/guru/";
			$this->load->view('template/header');
			$this->load->view('dosen/detail', $data);
			$this->load->view('template/footer');	
		}
		else
		{
			redirect("kelas");
		}
	}
}