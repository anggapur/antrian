<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polling_manag extends CI_Controller {

	// programer : fadli
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Polling Management";
			$d['class'] = "master";
			
			$d['content'] = 'polling/view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['polling_id']	= $this->input->post('cari');
			$q = $this->db->get_where("m_polling",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$d['polling_id'] = $dt->polling_id;
					$d['judul'] = $dt->judul;
					$d['jawaban1'] = $dt->jawaban1;
					$d['jawaban2'] = $dt->jawaban2;
					$d['jawaban3'] = $dt->jawaban3;
					$d['jawaban4'] = $dt->jawaban4;
					$d['jawaban5'] = $dt->jawaban5;
					$d['active_flag'] = $dt->active_flag;
				}
				echo json_encode($d);
			}else{
					$d['polling_id'] = "0";
					$d['judul'] = "";
					$d['jawaban1'] = "";
					$d['jawaban2'] = "";
					$d['jawaban3'] = "";
					$d['jawaban4'] = "";
					$d['jawaban5'] = "";
					$d['active_flag'] = "";
				echo json_encode($d);
			}
		}else{
			redirect('login','refresh');
		}	
	}
	
	public function simpan()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$login=$this->session->userdata('username');
		if(!empty($cek) && $level=='admin'){
			date_default_timezone_set('Asia/Makassar');
			$id['polling_id'] = $this->input->post('polling_id');
			$d['polling_id'] = $this->input->post('polling_id');
			$d['judul'] = $this->input->post('judul');
			$d['jawaban1'] = $this->input->post('opsi1');
			$d['jawaban2'] = $this->input->post('opsi2');
			$d['jawaban3'] = $this->input->post('opsi3');
			$d['jawaban4'] = $this->input->post('opsi4');
			$d['jawaban5'] = $this->input->post('opsi5');
			$d['active_flag'] = $this->input->post('active_flag');


			$q = $this->db->get_where("m_polling",$id);
			$row = $q->num_rows();
			if($row>0){
				$d['changed_who'] = $login;
				$d['changed_date'] = date('Y-m-d H:i:s');
				$this->db->update("m_polling",$d,$id);
				$last_id=$id['polling_id'];
				echo "Data Sukses diupdate";
			}else{
				$d['created_who'] = $login;
				$d['created_date'] = date('Y-m-d H:i:s');
				$this->db->insert("m_polling",$d);
				echo "Data Sukses disimpan";
			}
		}else{
			redirect('login','refresh');
		}
		
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['polling_id']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("m_polling",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("m_polling",$id);
			}
			redirect('polling_manag','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */