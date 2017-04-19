<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

	public function index()
	{
		$this->load->model('hero_model');
		$data["jenis_list"] = $this->hero_model->getDataJenis();
		$this->load->view('jenis',$data);	
	}

	public function datatable(){
	$this->load->model('hero_model');
	$data["jenis_list"] = $this->hero_model->getDataJenis();
	$this->load->view('jenis', $data);
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'Id', 'trim|numeric');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		$this->load->model('hero_model');	
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_jenis_view');

		}else{
			$this->hero_model->insertJenis();
			$this->load->view('tambah_jenis_sukses');

		}
	}
	//method update butuh parameter id berapa yang akan di update
	public function update($idJenis)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'Id', 'trim|required|');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|numeric');
		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('hero_model');
		$data['jenis']=$this->hero_model->getJenis($idJenis);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_jenis_view',$data);

		}else{
			$this->hero_model->updateById($idJenis);
			$this->load->view('edit_jenis_sukses');

		}
	}

	public function delete($idJenis)
	{

		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->load->model('hero_model');
		$this->hero_model->deleteById($idJenis);
		if($this->form_validation->run()==FALSE){
			redirect('jenis_hero');
		}
	
	}
}


/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */

 ?>