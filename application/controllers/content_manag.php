<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_manag extends CI_Controller {

	// programer : fadli
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Content Management";
			$d['class'] = "master";
			
			$d['content'] = 'content/view';
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
			$id['content_id']	= $this->input->post('cari');
			
			$q = $this->db->get_where("m_content",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$d['content_id'] = $dt->CONTENT_ID;
					$d['type'] = $dt->TYPE;
					$d['filename'] = $dt->FILENAME;
					$d['duration'] = $dt->DURATION;
					$d['ordernum'] = $dt->ORDERNUM;
				}
				echo json_encode($d);
			}else{
					$d['content_id'] = "0";
					$d['type'] = "";
					$d['filename'] = "";
					$d['duration'] = "";
					$d['ordernum'] = "";
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
			$id['CONTENT_ID'] = $this->input->post('content_id');
			$d['CONTENT_ID'] = $this->input->post('content_id');
			$d['TYPE'] = $this->input->post('type');
			$d['FILENAME'] = $this->input->post('address');
			$d['DURATION'] = $this->input->post('duration');
						
			$q = $this->db->get_where("m_content",$id);
			$row = $q->num_rows();
			if($row>0){
				$d['CHANGE_WHO'] = $login;
				$d['CHANGE_DATE'] = date('Y-m-d H:i:s');
				$this->db->update("m_content",$d,$id);
				$last_id=$id['CONTENT_ID'];
				echo "Data Sukses diupdate";
			}else{
				$d['CREATED_WHO'] = $login;
				$d['CREATED_DATE'] = date('Y-m-d H:i:s');
				$this->db->insert("m_content",$d);
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
			$id['CONTENT_ID']	= $this->uri->segment(3);
			
			//update
	        $orderNow = $this->db->where($id)->get('m_content')->row()->ORDERNUM;
	        $update = $this->db->where('ORDERNUM >',$orderNow)
	            			->set('ORDERNUM','ORDERNUM-1',false)
	            			->update('m_content');

			$q = $this->db->get_where("m_content",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("m_content",$id);
			}
			redirect('content_manag','refresh');
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
			$config['upload_path']          = './uploads/';
            $config['allowed_types']        = '*';
            $config['max_size']             = 1000000000;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    echo "error durng upload";
                    //$this->load->view('upload_form', $error);
            }
            else
            {
                    $datas = array('upload_data' => $this->upload->data());     
                    
            }
            //update
            $update = $this->db->where('ORDERNUM >=',$this->input->post('order'))
            			->set('ORDERNUM','ORDERNUM+1',false)
            			->update('m_content');
                        //get last
            $ORDERLAST = $this->db->order_by('ORDERNUM','DESC')->get('m_content')->row()->ORDERNUM;
            $getORDERNUM = $this->input->post('order');			
            if($getORDERNUM > $ORDERLAST)
            	$data['ORDERNUM'] = $ORDERLAST+1;			
            else
            	$data['ORDERNUM'] = $this->input->post('order');
            //insert			
			$data['TYPE'] = $this->input->post('type');
			$data['FILENAME'] = $this->upload->data()['file_name'];
			$data['DURATION'] = $this->input->post('duration');
			$data['CREATED_WHO'] = $login;
			$data['CREATED_DATE'] = date('Y-m-d H:i:s');
			$q = $this->db->insert("m_content",$data);
			if($q)				
				redirect('content_manag','refresh');
			else
				redirect('login','refresh');
		}
	}
	public function updateData()
	{
		$id['CONTENT_ID'] = $this->input->post('content_id');
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$login=$this->session->userdata('username');
		if(!empty($cek) && $level=='admin'){
			$config['upload_path']          = './uploads/';
            $config['allowed_types']        = '*';
            $config['max_size']             = 1000000000;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    // echo json_encode($error);
                    //$this->load->view('upload_form', $error);
                    // $data['FILENAME'] = "";
            }
            else
            {
                    $datas = array('upload_data' => $this->upload->data());   
                    $data['FILENAME'] = $this->upload->data()['file_name'];  
                    
            }
             //update
            $orderNow = $this->db->where($id)->get('m_content')->row()->ORDERNUM;
            $update = $this->db->where('ORDERNUM >',$orderNow)
            			->set('ORDERNUM','ORDERNUM-1',false)
            			->update('m_content');
            $update = $this->db->where('ORDERNUM >=',$this->input->post('order'))
            			->set('ORDERNUM','ORDERNUM+1',false)
            			->update('m_content');

            //get last
            $ORDERLAST = $this->db->order_by('ORDERNUM','DESC')->get('m_content')->row()->ORDERNUM;
            $getORDERNUM = $this->input->post('order');			
            if($getORDERNUM > $ORDERLAST)
            	$data['ORDERNUM'] = $ORDERLAST+1;			
            else
            	$data['ORDERNUM'] = $this->input->post('order');			
            //insert
			
			$data['TYPE'] = $this->input->post('type');			
			$data['DURATION'] = $this->input->post('duration');
			$data['CHANGE_WHO'] = $login;
			$data['CHANGE_DATE'] = date('Y-m-d H:i:s');
			$q = $this->db->update("m_content",$data,$id);
			if($q)
				redirect('content_manag','refresh');
			else
				redirect('login','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */