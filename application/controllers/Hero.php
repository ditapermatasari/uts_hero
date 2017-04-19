<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hero extends CI_Controller {

	public function index($idJenis)
	{
		$this->load->model('hero_model');		
		$data["hero_list"] = $this->hero_model->getHeroByJenis($idJenis);
		$this->load->view('hero', $data);
	}
	public function create($idJenis)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation'); //untuk form validasi
		$this->form_validation->set_rules('id', 'Id', 'trim|required|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');//trim memo
		$this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|numeric');
		$this->load->model('hero_model');	

		if($this->form_validation->run()==FALSE){
			$this->load->view('tambah_hero_view');
		}else{

				$this->hero_model->insertHero($idJenis);
				$this->load->view('tambah_hero_sukses');
		}
	}
}
?>