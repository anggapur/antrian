<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

	// programer : fadli
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Edit Profil";
			$d['class'] = "home";
			
			$d['nama_lengkap'] = $this->session->userdata('nama_lengkap');
			$d['content']= 'profil/profil';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan_profil()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['username'] = $this->session->userdata('username');
			
			$dt['nama_lengkap'] = $this->input->post('nama_lengkap');
			
			$q = $this->db->get_where('admins');
			$r = $q->num_rows();
			if($r>0){
				$this->db->update('admins',$dt,$id);
				echo "Sukses di Ubah";
			}
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan_foto()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$key = $this->model_data->cari_id_username($this->session->userdata('username'));
			
			$config['upload_path'] = './assets/avatars/'; 
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			//$config['max_size'] = '2000';
			//$config['max_width'] = '1280';
			//$config['max_height'] = '1280';	
			$config['overwrite'] = TRUE;	
			$config['file_name'] = $key;							
			$this->load->library('upload', $config);
			
			$foto = $_FILES['gambar']['name'];
			
			if(!empty($foto)){
				if($this->upload->do_upload('gambar')){
					$tp=$this->upload->data();
					$ori = $tp['file_name'];
					
					$data['foto'] = $ori;
					
					$this->load->library('image_lib');
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/avatars/'.$ori;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 300;
					$config['height'] = 200;
					
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					$id['username'] = $this->session->userdata('username');
					
					$q = $this->db->get_where('admins',$id);
					$r = $q->num_rows();
					if($r>0){
						$this->db->update('admins',$data,$id);
						$info = "Sukses di Ubah";
						$this->session->set_flashdata('result_info', '<center>'.$info.'</center>');
						redirect('profil','refresh');
					}
				}else{
					$info =  $this->upload->display_errors();
					$this->session->set_flashdata('result_info', '<center>'.$info.'</center>');
					redirect('profil');
				}
			}else{
				$info ='File Foto tidak ada';
				$this->session->set_flashdata('result_info', '<center>'.$info.'</center>');
				redirect('profil');
			}
			
			
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan_pwd()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['username'] = $this->session->userdata('username');
			
			$pwd = $this->input->post('pwd_1');
			$dt['password'] = md5($pwd);
			
			$q = $this->db->get_where('admins');
			$r = $q->num_rows();
			if($r>0){
				$this->db->update('admins',$dt,$id);
				echo "Password !!! Sukses di Ubah";
			}
			
		}else{
			redirect('login','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */