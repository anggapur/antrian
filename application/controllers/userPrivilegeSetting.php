<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserPrivilegeSetting extends CI_Controller {

	// programer : sevanam enterprise
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$d['judul']="Pengaturan Loket";
			$d['class'] = "user_privilege";
			
			$d['content']= 'userPrivilegeSetting/index';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}	
	public function getData()
	{
		$USER_ID = $this->input->post('USER_ID');
		echo json_encode($this->model_data->dataLoketHandleableByID($USER_ID));
	}
	public function simpan()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			//get data
			$USER_ID = $this->input->post('USER_ID');
			$LOKET_ID = $this->input->post('LOKET_ID');
			$DATA = $this->input->post('DATA');
			//delete dulu
			$hapus = $this->db
					->where('USER_ID',$USER_ID)					
					->delete('t_user_loket');
			//masukin data
			foreach ($DATA as $key => $value) {
				$datas = [
					'USER_ID' => $USER_ID,
					'JENIS_LOKET_ID' => $value,
					'LOKET_ID' => $LOKET_ID
				];
				$query = $this->db->insert('t_user_loket',$datas);
			}
			if($hapus)
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