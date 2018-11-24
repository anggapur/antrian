<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Escpos\PrintConnectors\FilePrintConnector;
	use Escpos\Printer;

class Display extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function display_terminal()
	{		
		date_default_timezone_set('Asia/Jakarta');
		$data['jenis_loket'] = $this->model_data->data_jenis_loket('Y');
		$data['pertanyaan_polling'] = $this->model_data->data_pertanyaan_polling(2);
		$this->load->view('display/display_terminal',$data);
	}
	public function display_tv()
	{
		date_default_timezone_set('Asia/Jakarta');
		$data['banner_list'] = $this->model_data->banner_list_marquee();
		$data['jenis_loket'] = $this->model_data->data_jenis_loket('Y');
		$this->load->view('display/display_tv',$data);
	}
	public function printTiket()
	{
		$data['MAIN_NAMA'] = $this->model_data->getMainNama();
		$data['MAIN_LOGO_DISPLAY'] = $this->model_data->getDisplayLogo();
		$data['MAIN_ALAMAT'] = $this->model_data->getMainAlamat();
		$data['no_antrian'] = $this->uri->segment(3);		
		$data['antrian_di_depan'] = $this->uri->segment(4);		
		$this->load->view('display/print_ticket',$data);	
		// echo $data['no_antrian'];
	}
	public function printTicket()
	{
		
		$this->load->library("EscPos.php");
// use Mike42\Escpos\Printer;
// use Mike42\Escpos\PrintConnectors\FilePrintConnector;
// use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
		try {
				// Enter the device file for your USB printer here
			  $connector = new Escpos\PrintConnectors\FilePrintConnector("Boom");
				   
				/* Print a "Hello world" receipt" */
				$printer = new Escpos\Printer($connector);
				$printer -> text("Hello World!\n");
				$printer -> cut();

				/* Close printer */
				$printer -> close();
		} catch (Exception $e) {
			echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
		}
		//$this->load->view('display/print_ticket',$data);	
	}
	public function makeTicket()
	{
		date_default_timezone_set('Asia/Jakarta');
		//GET THE DATA
		$ID_LOKET = $this->input->post('ID_LOKET');
		$KODE_LOKET = $this->input->post('KODE_LOKET');
		$TYPE_LOKET = $this->input->post('TYPE_LOKET');
		//THEN MAKE TICKET
		$callModel = $this->model_data->makeTicket($ID_LOKET,$KODE_LOKET,$TYPE_LOKET);

		// echo "Nomor Antrian : ".$callModel['ANTRIAN_NO']."<br>Jumlah Antrian Di Depan : ".$callModel['JUMLAH_ANTRIAN_DIDEPAN']."<br> TIME : ".$callModel['CREATE_TIME'];
		
		// $this->cetakAntrian($callModel['ANTRIAN_NO'],$callModel['JUMLAH_ANTRIAN_DIDEPAN'],$callModel['TYPE_LOKET']);
		echo json_encode($callModel);
	}

	public function submitPolling()
	{
		date_default_timezone_set('Asia/Jakarta');
		//GET DATA POLLING
		$POLLING_ID = $this->input->post('POLLING_ID');
		$JAWABAN = strtoupper($this->input->post('JAWABAN'));
		//INSERT JAWABAN
		$query = $this->model_data->submitPolling($POLLING_ID,$JAWABAN);
		if($query)
			echo "success";
		else
			echo "failed";

	}
	public function getDataForTv()
	{
		date_default_timezone_set('Asia/Jakarta');
		//Get Data Untuk Loket
		$data = $this->model_data->dataNoAntrianDiLoket();
		echo json_encode($data->result());
	}
	public function ubahStateAntrianNo()
	{
		date_default_timezone_set('Asia/Jakarta');
		$ANTRIAN_ID = $this->input->post('ANTRIAN_ID');
		$data = $this->model_data->ubahStateAntrianNo($ANTRIAN_ID);
		if($data)
			echo "success";
		else
			echo "failed";
	}	
	public function getEntertaimentContent()
	{
		$data = $this->model_data->getEntertaimentContent();
		echo json_encode($data);
	}
	public function checkDataDisplay()
	{			
		date_default_timezone_set('Asia/Jakarta');
		$data = $this->model_data->checkDataDisplay();
		echo json_encode($data);
	}
	public function printTest()
	{

	}
	 function testPrintPdf()
    {
        // boost the memory limit if it's low ;)
        ini_set('memory_limit', '256M');
        // load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model or just static date
        $data['title'] = "items";
        $pdf->allow_charset_conversion=true;  // Set by default to TRUE
        $pdf->charset_in='UTF-8';
     //   $pdf->SetDirectionality('rtl'); // Set lang direction for rtl lang
        $pdf->autoLangToFont = true;
        $html = $this->load->view('content/mpdf', $data, true);
        // render the view into HTML
        $pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = 'itemreport' . date('Y_m_d_H_i_s') . '_.pdf';
        $pdf->Output("$output", 'I');
        // save to file because we can exit();
    }
    public function getDefaultPrinter()
    {
    	//$list_printers = printer_list(PRINTER_ENUM_LOCAL | PRINTER_ENUM_SHARED);

// get the name of the first returned printer
//(you can add array walk function to get all printer names if you wish.. but I am lazy)

		//$this_printer = $list_printers[0]['NAME'];
		//return "EPSON TM-T88V Receipt";
		return $this->db->where('CODE','MAIN_PRINTER')->get('s_lov_value')->row()->DESCRIPTION;
		// return $this_printer;
    }
    public function printerNow()
    {
    	echo $this->getDefaultPrinter();
    }
    public function cetakAntrian($no_antrian,$di_depan,$jenis)
    {
    	//Data Identitas
    	$MAIN_NAMA = $this->db->where('CODE','MAIN_NAMA')->get('s_lov_value')->row()->DESCRIPTION;
		$MAIN_ALAMAT = $this->db->where('CODE','MAIN_ALAMAT')->get('s_lov_value')->row()->DESCRIPTION;
		$MAIN_TELPON = $this->db->where('CODE','MAIN_TELPON')->get('s_lov_value')->row()->DESCRIPTION;
    	//
    	$totW = 500;
    	$yAwal = 0;
    	$printer_name = $this->getDefaultPrinter(); 
		$handle = printer_open($printer_name);		

		printer_start_doc($handle, "My Document");
		printer_start_page($handle);	

		//1 line
		$h = 30;
		$w = 10;
		$b = PRINTER_FW_ULTRABOLD;
		$text = $MAIN_NAMA;
		$x = ($totW-(strlen($text)*$w))/2;
		$font = printer_create_font("Arial", $h, $w, $b, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle,$text, $x, $yAwal);
		$yAwal+=$h;
		//2 line
		foreach($this->makeAlamat($MAIN_ALAMAT) as $val)
		{
			$h = 30;
			$w = 10;
			$b = PRINTER_FW_MEDIUM;
			$text = $val;
			$x = ($totW-(strlen($text)*$w))/2;
			$font = printer_create_font("Arial", $h, $w, $b, false, false, false, 0);
			printer_select_font($handle, $font);
			printer_draw_text($handle,$text, $x, $yAwal);
			$yAwal+=$h;
		}
		//Tambahan alamat
		$h = 30;
		$w = 10;
		$b = 300;
		$b = PRINTER_FW_MEDIUM;
		$text = $MAIN_TELPON;
		$x = ($totW-(strlen($text)*$w))/2;
		$font = printer_create_font("Arial", $h, $w, $b, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle,$text, $x, $yAwal);
		$yAwal+=$h;
		//3 line
		$h = 30;
		$w = 10;
		$b = PRINTER_FW_ULTRABOLD;
		$text = $jenis;
		$x = ($totW-(strlen($text)*$w))/2;
		$font = printer_create_font("Arial", $h, $w, $b, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle,$text, $x, $yAwal);
		$yAwal+=$h;
		//4 line
		$h = 100;
		$w = 60;
		$b = PRINTER_FW_HEAVY;
		$text = $no_antrian;
		$x = ($totW-(strlen($text)*$w))/2;
		$font = printer_create_font("Arial", $h, $w, $b, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle,$text, $x, $yAwal);
		$yAwal+=$h;
		//5 line
		$h = 30;
		$w = 10;
		$b = PRINTER_FW_MEDIUM;
		$text = "Antrian Di Depan Anda : ".$di_depan;
		$x = ($totW-(strlen($text)*$w))/2;
		$font = printer_create_font("Arial", $h, $w, $b, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle, $text, $x+20, $yAwal);
		$yAwal+=$h;
		//6 line
		$h = 30;
		$w = 10;
		$b = PRINTER_FW_MEDIUM;
		$text = date('d-m-Y h:i:s');
		$x = ($totW-(strlen($text)*$w))/2;
		$font = printer_create_font("Arial", $h, $w, $b, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle,$text, $x+20, $yAwal);
		$yAwal+=$h;

		//cetak spacing
		$h = 30;
		$w = 10;
		$b = 300;
		$text = ".";
		$x = ($totW-(strlen($text)*$w))/2;
		$font = printer_create_font("Arial", $h, $w, $b, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle,$text, $x+20, $yAwal);
		$yAwal+=$h;
		
		printer_delete_font($font);
		printer_end_page($handle);
		printer_end_doc($handle);
		printer_close($handle);

    }
    public function cekPrinter()
    {
    	// echo CI_VERSION;
    	
    	$handle = printer_open("EPSON TM-T88V Receipt");
		if($handle)
		echo "connected";
		else
		echo "not connected";
		// $fd ="test coba print";	    
	 //    printer_set_option($handle, PRINTER_MODE, "RAW");
	 //    printer_set_option($handle, PRINTER_TEXT_ALIGN, PRINTER_TA_CENTER);
	 //    printer_write($handle, $fd);
		//     printer_close($handle);
		    
		$printer_name = "EPSON TM-T88V Receipt"; 
		$handle = printer_open($printer_name);
		printer_start_doc($handle, "My Document");
		printer_start_page($handle);
		//1 line
		$font = printer_create_font("Arial", 80, 50, 300, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle, 'BPKAD JEMBRANA', 100, 200);
		//2 line
		$font = printer_create_font("Arial", 80, 50, 300, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle, 'Jalan Jembraba, JEMBRANA', 100, 300);
		//3 line
		$font = printer_create_font("Arial", 80, 50, 300, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle, 'Nomor Antrian', 100, 400);
		//4 line
		$font = printer_create_font("Arial", 400, 250, 300, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle, 'A30', 100, 500);
		//5 line
		$font = printer_create_font("Arial", 80, 50, 300, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle, 'Pelanggan Di Depan Anda : 5', 100, 900);
		//6 line
		$font = printer_create_font("Arial", 80, 50, 300, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle, date('d-m-Y h:i:s'), 100, 1000);
		
		printer_delete_font($font);
		printer_end_page($handle);
		printer_end_doc($handle);
		printer_close($handle);
		

		// $page = "http://localhost/BPKAD-SEVANAM/display/printTiket/A33/28";
		// $page = "http://localhost/BPKAD-SEVANAM/assets/images/fullscreen.png";

		// $printer = "printerDanke"; 
	 //    if($ph = printer_open($printer)) 
	 //    { 

	 //    	printer_start_doc($ph, "My Document");
	 //    	printer_start_page($ph);
	 //    	// printer_set_option($ph, PRINTER_MODE, "RAW"); 
	 //       $content = file_get_contents($page); 

	       
	 //       printer_write($ph, $content); 
	 //       printer_end_page($ph);
		// 	printer_end_doc($ph);
	 //       printer_close($ph); 
	 //    } 

	}
	public function cekTes()
	{
		$esc=chr(27);
		$cutpaper=$esc."m";
		// $printer="/dev/usb/lp0";
		$printer = $this->getDefaultPrinter()."m";
		$string = "--test EAN-13 barcode wide--\n";
		$string.=$cutpaper;
		$fp=fopen($printer, 'w');
		if($fp)
			echo "Koenek";
		else
			echo "Ndak Konek";
		fwrite($fp,$string);
		fclose($fp);
	}

	public function makeAlamat($kalimat)
	{
		//per line 44 huruf
		$maxPerLine = 44;

		$str = $kalimat;
		$pecah = explode(" ",$str);
		$hitung = count($pecah);
		$mula = 0;
		$tampung = 0;
		$strToPrint = "";
		$data = [];
		while($mula < $hitung)
		{
			for($i=$mula; $i < $hitung; $i++)
			{
				if($tampung + strlen($pecah[$i]) < $maxPerLine)
				{
					if($i == $hitung-1)
						$strToPrint.=$pecah[$i];
					else 
						$strToPrint.=$pecah[$i]." ";
					$tampung+=strlen($pecah[$i]);				
					$mula++;	
				}
				else
				{					
					$tampung = 0;
					echo "<br>";
					break;					
				}
			}	
			array_push($data,$strToPrint);
			$strToPrint = "";
		}
		
		return $data;
	}

	
}
