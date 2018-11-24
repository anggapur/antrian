<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_manag extends CI_Controller {

	// programer : fadli
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Main Content Management";
			$d['class'] = "master";
			
			$d['content'] = 'mainContent/view';

			$d['MAIN_NAMA'] = $this->db->where('CODE','MAIN_NAMA')->get('s_lov_value')->row()->DESCRIPTION;
			$d['MAIN_ALAMAT'] = $this->db->where('CODE','MAIN_ALAMAT')->get('s_lov_value')->row()->DESCRIPTION;
			$d['MAIN_TELPON'] = $this->db->where('CODE','MAIN_TELPON')->get('s_lov_value')->row()->DESCRIPTION;
			$d['MAIN_LOGO_LOGIN'] = $this->db->where('CODE','MAIN_LOGO_LOGIN')->get('s_lov_value')->row()->DESCRIPTION;
			$d['MAIN_LOGO_DISPLAY'] = $this->db->where('CODE','MAIN_LOGO_DISPLAY')->get('s_lov_value')->row()->DESCRIPTION;
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}

	public function saveData()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$login=$this->session->userdata('username');
		if(!empty($cek) && $level=='admin'){

			//Daa Teks
			$data['MAIN_NAMA'] = $this->input->post('MAIN_NAMA');
			$q = $this->db->set('DESCRIPTION',$data['MAIN_NAMA'])->where('CODE','MAIN_NAMA')->update('s_lov_value');
			$data['MAIN_TELPON'] = $this->input->post('MAIN_TELPON');
			$q = $this->db->set('DESCRIPTION',$data['MAIN_TELPON'])->where('CODE','MAIN_TELPON')->update('s_lov_value');
			$data['MAIN_ALAMAT'] = $this->input->post('MAIN_ALAMAT');
			$q = $this->db->set('DESCRIPTION',$data['MAIN_ALAMAT'])->where('CODE','MAIN_ALAMAT')->update('s_lov_value');

			//file1
			if($_FILES['MAIN_LOGO_LOGIN']['tmp_name'] !== "")
			{
				$config['upload_path']          = './assets/img/';
	            $config['allowed_types']        = '*';
	            $config['max_size']             = 1000000000;
	            $config['max_width']            = 87;
	            $config['max_height']           = 90;

	            $this->load->library('upload', $config);


	            if ( ! $this->upload->do_upload('MAIN_LOGO_LOGIN'))
	            {
	                    $error = array('error' => $this->upload->display_errors());
	                    echo "error durng upload";
	                    //$this->load->view('upload_form', $error);
	            }
	            else
	            {
	                    $datas = array('upload_data' => $this->upload->data());  
	                    // echo json_encode($datas);   	                    
	                    $dataImg = $datas['upload_data']['file_name'];
	                    $q = $this->db->set('DESCRIPTION',$dataImg)->where('CODE','MAIN_LOGO_LOGIN')->update('s_lov_value');
	            }           
	        }
	        if($_FILES['MAIN_LOGO_DISPLAY']['tmp_name'] !== "")
			{
				$config['upload_path']          = './assets/img/';
	            $config['allowed_types']        = '*';
	            $config['max_size']             = 1000000000;
	            $config['max_width']            = 319;
	            $config['max_height']           = 65;

	            $this->load->library('upload', $config);


	            if ( ! $this->upload->do_upload('MAIN_LOGO_DISPLAY'))
	            {
	                    $error = array('error' => $this->upload->display_errors());
	                    echo "error durng upload";
	                    //$this->load->view('upload_form', $error);
	            }
	            else
	            {
	                    $datas = array('upload_data' => $this->upload->data());  
	                    // echo json_encode($datas);   	                    
	                    $dataImg = $datas['upload_data']['file_name'];
	                    $q = $this->db->set('DESCRIPTION',$dataImg)->where('CODE','MAIN_LOGO_DISPLAY')->update('s_lov_value');
	            }           
	        }
			
			if($q)				
				redirect('main_manag','refresh');
			else
				redirect('login','refresh');

			

		}
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */