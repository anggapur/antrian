<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_polling extends CI_Controller {

	// programer : sevanam enterprise
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){

			$d['judul']="Laporan Polling ";
			$d['class'] = "laporan";
			
			$d['content']= 'laporan/lap_polling';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$tgl_awal = $this->input->post('tgl_awal');
			$tgl_akhir = $this->input->post('tgl_akhir');
			$judul=$this->input->post('judul');
			$q = $this->model_data->lap_polling($tgl_awal,$tgl_akhir,$judul);
			$r = $q->num_rows();
			
			if($r>0){
				$dt['data'] = $q;
				echo $this->load->view('laporan/view_lap_polling',$dt);
			}
			else{
				echo $this->load->view('laporan/view_kosong');
			}

		}else{
			redirect('login','refresh');
		}
	}
	
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$tgl_awal = $this->input->post('tgl_awal');
			$tgl_akhir = $this->input->post('tgl_akhir');
			$judul=$this->input->post('judul');
			$q = $this->model_data->lap_polling($tgl_awal,$tgl_akhir,$judul);
			$r = $q->num_rows();
			
			if($r>0){
			
				$pdf=new reportProduct();
				$pdf->setKriteria("cetak_laporan");
				$pdf->setNama("CETAK LAPORAN");
				$pdf->AliasNbPages();
				$pdf->AddPage("L","A4");
				
				$A4[0]=210;
				$A4[1]=297;
				$Q[0]=216;
				$Q[1]=279;
				$pdf->SetTitle('Laporan Polling');
				$pdf->SetCreator('Programmer IT with fpdf');
						
				$h = 7;
				$pdf->SetFont('Times','B',14);
				$pdf->SetX(6);
				$pdf->Cell(198,4,$this->config->item('nama_instansi'),0,1,'L');
				$pdf->SetX(6);
				$pdf->SetFont('Times','',10);
				$pdf->Cell(198,4,'Alamat : '.$this->config->item('alamat_instansi'),0,1,'L');
				$pdf->Ln(5);
				
				//Column widths
				$pdf->SetFont('Arial','B',14);
				$pdf->SetX(6);
				$pdf->Cell(290,4,$nama_laporan,0,1,'C');
				$pdf->Ln(5);
				
				$w = array(10,30,20,20,85,10,30,70);
						
				//Header
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell($w[0],$h,'No',1,0,'C');
				$pdf->Cell($w[1],$h,'Judul',1,0,'C');
				$pdf->Cell($w[2],$h,'OP1',1,0,'C');
				$pdf->Cell($w[3],$h,'OP2',1,0,'C');
				$pdf->Cell($w[4],$h,'OP3',1,0,'C');
				$pdf->Cell($w[4],$h,'OP4',1,0,'C');
				$pdf->Cell($w[4],$h,'OP5',1,0,'C');
				$pdf->Ln();
						
				//data
				//$pdf->SetFillColor(224,235,255);
				$pdf->SetFont('Arial','',9);
				$pdf->SetFillColor(204,204,204);
				$pdf->SetTextColor(0);
				$fill = false;
				$no=1;
				foreach($q->result() as $row)
				{
					$pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
					$pdf->Cell($w[1],$h,$row->judul,'LR',0,'C',$fill);
					$pdf->Cell($w[2],$h,$row->OP1,'LR',0,'C',$fill);
					$pdf->Cell($w[3],$h,$row->OP2,'LR',0,'C',$fill);
					$pdf->Cell($w[4],$h,$row->OP3,'LR',0,'L',$fill);
					$pdf->Cell($w[4],$h,$row->OP4,'LR',0,'L',$fill);
					$pdf->Cell($w[4],$h,$row->OP5,'LR',0,'L',$fill);
					$pdf->Ln();
					$fill = !$fill;
					$no++;
				}
				// Closing line
				$pdf->Cell(array_sum($w),0,'','T');
				$pdf->Ln(10);
				$pdf->SetX(200);
				$pdf->Cell(100,$h,'Serang, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
				$pdf->Ln(20);
				$pdf->SetX(200);
				$pdf->Cell(100,$h,'___________________','C');

				$pdf->Output($report_code.'.pdf','D');

			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('lap_polling');
			}
		}else{
			redirect('login','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */