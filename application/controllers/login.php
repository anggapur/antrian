<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	// programer : fadli
	
	
	
	public function index()
	{
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('login');	
		}else{
			$u = $this->input->post('username');
			$p = $this->input->post('password');
			$this->model_global->getLoginData($u,$p);
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('login','refresh');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */