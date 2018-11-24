<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class JenisPelayananSetting extends CI_Controller {

	// programer : sevanam enterprise
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$d['judul']="Pengaturan Jenis Pelayanan";
			$d['class'] = "user_privilege";
			
			$d['content']= 'jenisPelayananSetting/index';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}	
	public function simpan()
	{
		$data['TYPE_LOKET'] = $this->input->post('TYPE_LOKET');
		$data['KODE_LOKET'] = $this->input->post('KODE_LOKET');		
		$data['STATUS'] = $this->input->post('STATUS');
		$q = $this->model_data->inputDataJenisPelayanan($data);
		if($q)
			echo "success";
		else 
			echo "failed";
	}
	public function hapus()
	{		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['JENIS_LOKET_ID'] = $this->uri->segment(3);
			
			$q = $this->db->get_where("t_jenis_loket",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("t_jenis_loket",$id);
			}
			redirect('jenisPelayananSetting','refresh');
		}else{
			redirect('login','refresh');
		}
	}
	public function editData()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['JENIS_LOKET_ID']	= $this->input->post('cari');
			
			$q = $this->db->get_where("t_jenis_loket",$id);
			$row = $q->num_rows();
			if($row>0){
				$d = $q->row();
				echo json_encode($d);
			}else{
					$d['content_id'] = "0";
					$d['type'] = "";
					$d['filename'] = "";
					$d['duration'] = "";
				echo json_encode($d);
			}
		}else{
			redirect('login','refresh');
		}	
	}
	public function update()
	{		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$data['TYPE_LOKET'] = $this->input->post('TYPE_LOKET');
			$data['KODE_LOKET'] = $this->input->post('KODE_LOKET');			
			$data['STATUS'] = $this->input->post('STATUS');
			$ID = $this->uri->segment(3);
			$q = $this->db
				->where('JENIS_LOKET_ID',$ID)
				->set($data)
				->update('t_jenis_loket');
			if($q)
				echo "success";
			else 
				echo "failed";
		}else{
			redirect('login','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */