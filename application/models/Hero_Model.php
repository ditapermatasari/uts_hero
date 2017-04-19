<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hero_Model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataJenis()
		{
			$this->db->select("id,keterangan");
			$query = $this->db->get('jenis_hero');
			return $query->result();
		}	

		public function insertJenis()
		{
			$object = array(
				'keterangan' => $this->input->post('keterangan')  );
			$this->db->insert('jenis_hero', $object);
		}

		public function getJenis($idJenis)
		{
			$this->db->where('id', $idJenis);	
			$query = $this->db->get('jenis_hero',1);
			return $query->result();

		}

		public function updateById($idJenis)
		{
			$data = array(
				'id' => $this->input->post('id'),
				'keterangan' => $this->input->post('keterangan')  );
			$this->db->where('id', $idJenis);
			$this->db->update('jenis_hero', $data);
		}

		public function deleteById($idJenis)
		{
			$this -> db -> where('id', $idJenis);
  			$this -> db -> delete('jenis_hero');
  			$this -> db -> where('fk_jenis', $idJenis);
  			$this -> db -> delete('jenis_hero');
  		}

/////////////////////////////

		public function getHeroByJenis($idJenis)
		{
			$this->db->select("hero.id as id, nama, DATE_FORMAT(tanggal_lahir,'%d-%m-%Y') as tanggal_lahir, jenis_hero.keterangan as keterangan");
			$this->db->where('fk_jenis', $idJenis);	
			$this->db->join('jenis_hero', 'jenis_hero.id = hero.fk_jenis', 'left');	
			$query = $this->db->get('hero');
			return $query->result(); 
		}

		public function insertHero($idJenis)
		{	
			$object = array(
				'nama' => $this->input->post('jabatan'), 
				'tanggal_lahir' => date('Y/m/d'),
				'keterangan' => $this->input->post('keterangan'), 
				'fk_jenis'=> $idJenis

				);
			$this->db->insert('Hero', $object);
		}
}

/* End of file Pegawai_Model.php */
/* Location: ./application/models/Pegawai_Model.php */
 ?>