<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller
{
	public $sesi;
	public function __construct()
	{

		
		parent::__construct();

		$this->load->helper('url');

        $this->load->library('session');
		
		if(!$this->session->userdata('logged_in')){
			redirect(base_url()."login");
		}
		if ($this->session->userdata('logged_in')) {
			$session_data=$this->session->userdata('logged_in');
			$this->sesi['tahun']=getdate()['year'];
			$this->sesi['bulan']=getdate()['mon'];
			$this->sesi['hari']=getdate()['weekday'];
			$this->sesi['tanggal']=getdate()['mday'];
			
			// $this->sesi['bulan']=getdate()['month'];
			// $this->sesi['hari']=getdate()['weekday'];
			// $this->sesi['hak'] = $session_data['hak'];
			
		}
		else{
			$this->sesi['tahun']=getdate()['year'];
			$this->sesi['bulan']=getdate()['mon'];


		}
		
	}

	public function laporan_harian($tanggal,$bulan,$tahun,$jenisopt)
	{
		if($this->session->userdata('logged_in'))
		{

			$this->load->view('template/admin_header',$this->sesi);
			if ($bulan < 10) {
				$tanggal_lengkap = $tahun."-0".$bulan."-".$tanggal;
			}
			else $tanggal_lengkap = $tahun."-".$bulan."-".$tanggal;
			$this->load->model('m_report');



			if ($jenisopt == 1) {
				$data['hasil'] = $this->m_report->tabel_harian_masuk($tanggal_lengkap);
			}
        	else $data['hasil'] = $this->m_report->tabel_harian_keluar($tanggal_lengkap);
        	// $this->load->view('/admin/laporan_harian',$data);
			$data['tanggal_s']=$tanggal;
			$data['bulan_s']=$bulan;
			$data['tahun_s']=$tahun;
			$data['jenis']=$jenisopt;
			// print_r($data1);
			$this->load->view('laporan-harian',$data);
			$this->load->view('template/admin_footer');


		}
		
		else redirect(base_url('login'));

		
        // print_r($data);
	}

	public function laporan_bulanan($bulan,$tahun,$jenisopt)
	{
		if($this->session->userdata('logged_in'))
		{
			

			$this->load->view('template/admin_header',$this->sesi);
			if ($bulan < 10) {
				$tanggal_lengkap = $tahun."-0".$bulan;
			}
			else $tanggal_lengkap = $tahun."-".$bulan;
			
			$this->load->model('m_report');



			if ($jenisopt == 1) {
				$data['hasil'] = $this->m_report->tabel_bln_th_msk($tanggal_lengkap);
				$data['bulan_s']=$bulan;
			$data['tahun_s']=$tahun;
			$data['jenis']=$jenisopt;
				$this->load->view('laporan-bulanan',$data);
				$this->load->view('template/admin_footer');

			}
        	else
        	{
        		$data['hasil'] = $this->m_report->tabel_bln_th_klr($tanggal_lengkap);
        		$data['bulan_s']=$bulan;
			$data['tahun_s']=$tahun;
			$data['jenis']=$jenisopt;
        		$this->load->view('laporan-bulanan-keluar',$data);
				$this->load->view('template/admin_footer');	
        	}	
        	 
        	
			// $data['tanggal_s']=$tanggal;
			
			
			// $this->load->view('laporan-bulanan',$data);
			// $this->load->view('template/admin_footer');
			// print_r($tanggal_lengkap);

		}
		
		else redirect(base_url('login'));

	}

	public function laporan_tahunan($tahun,$jenisopt)
	{
		if($this->session->userdata('logged_in'))
		{
			

			$this->load->view('template/admin_header',$this->sesi);
			// $tanggal_lengkap = $tahun;
			$this->load->model('m_report');



			if ($jenisopt == 1) {
				for ($i=1; $i <13 ; $i++) {
				 	$tanggal_lengkap = $tahun."-0".$i;
				 	// print_r($tanggal_lengkap);
					$data['hasil'][$i] = $this->m_report->tabel_bln_th_msk($tanggal_lengkap);
					print_r($data['hasil'][$i]);
				}

			}
        	else
        	{
  				for ($i=1; $i <13 ; $i++) {
				 	$tanggal_lengkap = $tahun."-0".$i;
				 	// print_r($tanggal_lengkap);
					$data['hasil'][$i] = $this->m_report->tabel_bln_th_klr($tanggal_lengkap);
					print_r($data['hasil'][$i]);
				}      		
        	} 
        	
        	
			// $data['tanggal_s']=$tanggal;
			// $data['bulan_s']=$bulan;
			$data['tahun_s']=$tahun;
			$data['jenis']=$jenisopt;
			
			$this->load->view('laporan-tahunan',$data);
			$this->load->view('template/admin_footer');


		}
		
		else redirect(base_url('login'));

	}

	public function laporan_chart()
	{
		//$this->sesi['tahun']=$tahun;
		$this->load->view('template/admin_header',$this->sesi);
		$data['mychart'] = $this->m_report->report_chart();		
		$this->load->view('admin/admin_chart',$data);
		$this->load->view('template/admin_footer');
	}
	public function back_up()
	{
		
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'perumahan';
		// $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
		// if(! $conn )
		// {
		//   die('Could not connect: ' . mysqli_error());
		// }
		// $table_name = "perumahan";
		$backup_file  = "../controllers/tmp/perumahan.sql";
		// $sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";
		// $result = mysqli_query($conn,$sql);
		// echo $result;
		
		$command='mysqldump --opt -h' .$dbhost .' -u' .$dbuser .' -p' .$dbpass .' ' .$dbname .' > ~/' .$backup_file;
        exec($command);

		// echo "Backedup  data successfully\n";
		//mysqli_close($conn);
		
	}

	public function back_up1()
	{
		include('dumper.php');

		try {
			$world_dumper = Shuttle_Dumper::create(array(
			    'host' => 'localhost',
			    'username' => 'root',
			    'password' => '',
			    'db_name' => 'perumahan',
			));
			// dump the database to plain text file
			$world_dumper->dump('perumahan.sql');

			// send the output to gziped file:
			//$world_dumper->dump('perumahan.gz');

		}
			catch(Shuttle_Exception $e){
			echo "Couldn't dump database: " . $e->getMessage();
			}
	}
	
	public function back_up2()
	{
				//ENTER THE RELEVANT INFO BELOW
		 //ENTER THE RELEVANT INFO BELOW
        $mysqlDatabaseName ='perumahan';
        $mysqlUserName ='root';
        $mysqlPassword ='';
        $mysqlHostName ='localhost';
        $mysqlExportPath ='perumahanex.sql';

        //DO NOT EDIT BELOW THIS LINE
        //Export the database and output the status to the page
        $command='mysqldump --opt -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ~/' .$mysqlExportPath;
        exec($command);

		
	}






	
	public function rekapitulasi_transaksi_bulanan_excel_semester1_masuk($tahun)
	{
		// if ($bulan < 10) {
		// 	$bulan = '0'.$bulan;
		// }
		// print_r($tanggal_lengkap);
		// $tanggal_lengkap= $tahun.'-'.$bulan;
		// $tanggal_asli = $bulan.'-'.$tahun;
		// $tanggal_saldo = ($bulan-1).'-'.$tahun;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'LAPORAN PENERIMAAN SEMESTER I TAHUN '.$tahun.'');
		$this->excel->getActiveSheet()->setCellValue('B2', 'RUMAH SAKIT UMUM AISYIYAH PADANG');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(38);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(14);
		
		

		$this->excel->getActiveSheet()->mergeCells('B1:I1');
		$this->excel->getActiveSheet()->mergeCells('B2:I2');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		


		$this->excel->getActiveSheet()->setCellValue('B4', "NO");
		// $this->excel->getActiveSheet()->mergeCells('B4:B8');
		$this->excel->getActiveSheet()->setCellValue('C4', "URAIAN");
		// $this->excel->getActiveSheet()->mergeCells('C4:C8');
		$this->excel->getActiveSheet()->setCellValue('D4', "JANUARI");
		// $this->excel->getActiveSheet()->mergeCells('D4:D8');
		
		$this->excel->getActiveSheet()->setCellValue('E4', "FEBRUARI");
		// $this->excel->getActiveSheet()->mergeCells('F4:F8');
		$this->excel->getActiveSheet()->setCellValue('F4', "MARET");
		// $this->excel->getActiveSheet()->mergeCells('G4:G8');
		$this->excel->getActiveSheet()->setCellValue('G4', "APRIL");
		$this->excel->getActiveSheet()->setCellValue('H4', "MEI");
		$this->excel->getActiveSheet()->setCellValue('I4', "JUNI");
		// $this->excel->getActiveSheet()->mergeCells('H4:H8');

		
		



			$numCell=5;	
	
        $this->excel->getActiveSheet()->setCellValue('C'.$numCell,'Saldo Bulan Sebelumnya ');	

        $numCell=6;	
        $this->excel->getActiveSheet()->setCellValue('B'.$numCell, '1');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+1).':'.'B'.($numCell+4));
		$this->excel->getActiveSheet()->setCellValue('C'.$numCell,'Penerimaan VK');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+1),'a. Persalinan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+2),'b. Perawatan Bayi');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+3),'c. Jasa VK');

		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+5), '2');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+6).':'.'B'.($numCell+10));    	
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+5),'Penerimaan OK');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+6),'a. Jasa OK');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+7),'b. Penerimaan Alat Monitor');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8),'c. Penerimaan Alat Couter');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+9),'d. Penerimaan RR');	
    		
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+11), '3');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+12).':'.'B'.($numCell+31));
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+11),'a. Perawatan');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+12),'1. VIP  Rp.XXXXX');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+13),'2. Kelas I  Rp.XXXXX');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+14),'3. Kelas II  Rp.XXXXX');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+15),'4. Kelas III  Rp.XXXXX');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+17),'Pasien BPJS ');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+18),'b. Persentase dr dari pasien');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+19),'c. Jasa dr u/ RS dari jasa Visite');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+20),'d. Labor Rawat Nginap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+21),'e. Penerimaan HCU');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+22),'f. Transportasi');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+23),'g. Medical Record');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+24),'h. Piutang yang diterima');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+25),'i. Penerimaan Obat - Obat Rawat Inap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+26),'j. Perasat');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+27),'k. Insentif obat rawat inap + rawat jalan');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+28),'l. Jasa Pelayanan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+29),'m. Penerimaan Rotgen');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+30),'n. Penerimaan USG');		
    		
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+32), '4');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+33).':'.'B'.($numCell+39));
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+32),'Penerimaan Rawat Jalan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+33),'a. Labor Rawat Jalan');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+34),'b. EKG Rawat Jalan + Rawat Inap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+35),'c. Karcis IGD Rawat Jalan + Rawat Inap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+36),'d. Jasa Tindakan Rawat Jalan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+37),'e. Penerimaan Obat-Obatan Rawat Jalan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+38),'f. Karcis Rawat Jalan');

    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+40), '5');	
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+40),'Penerimaan Lain-Lain');	

    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+42),'Total Penerimaan');	
    	$this->excel->getActiveSheet()->getStyle('C'.($numCell+42))->getFont()->setBold(true);
    	
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+43),'JUMLAH');
    	$this->excel->getActiveSheet()->getStyle('B'.($numCell+43))->getFont()->setBold(true);		


        
    	$huruf = 'C';
    	// $hurufh = $huruf++;
    	// $hurufi = ++$hurufh;
    	$total_semester=0;
    	$bulan=0;	
    		for ($i=0; $i <6 ; $i++) {
    			$bulan++;
    			if ($bulan < 10) {
					$bulan = '0'.$bulan;
				}
				$tanggal_lengkap= $tahun.'-'.$bulan;	 

    			$huruf = ++$huruf;
    			$this->load->model('m_report');
				$data1= $this->m_report->tabel_bln_th_msk($tanggal_lengkap);		
				$data2= $this->m_report->tabel_bln_th_klr($tanggal_lengkap);
				$jumlah_masuk_sementara= $this->m_report->tabel_jumlah_bln_th_msk($tanggal_lengkap);
				$jumlah_keluar_sementara= $this->m_report->tabel_jumlah_bln_th_klr($tanggal_lengkap);
				$jumlah_vk_sementara=$this->m_report->tabel_jumlah_VK($tanggal_lengkap);
				$jumlah_ok_sementara=$this->m_report->tabel_jumlah_OK($tanggal_lengkap);
				$jumlah_rinap_sementara=$this->m_report->tabel_jumlah_rawat_inap($tanggal_lengkap);
				$jumlah_penbpjs_sementara=$this->m_report->tabel_jumlah_bpjs($tanggal_lengkap);
				$jumlah_rjalan_sementara=$this->m_report->tabel_jumlah_rawat_jalan($tanggal_lengkap);
				$jumlah_bp_sementara=$this->m_report->tabel_jumlah_belanja_pegawai($tanggal_lengkap);
				$jumlah_bo_sementara=$this->m_report->tabel_jumlah_belanja_operasional($tanggal_lengkap);	

		    	$VK_Persalinan=$VK_Perawatan=$VK_Jasa =$OK_Jasa=$OK_Monitor=$OK_Couter=$OK_RR=$VIP=$Kelas_I=$Kelas_II=$Kelas_III=$BPJS_Persentase=$BPJS_Dr_Visite=$BPJS_Labor=$BPJS_Penerimaan_HCU=$BPJS_Transportasi=$BPJS_Medical=$BPJS_Piutang=$BPJS_Penerimaan_Obat=$BPJS_Perasat=$BPJS_Insentif=$BPJS_Jasa=$BPJS_Penerimaan_Rontgen=$BPJS_Penerimaan_USG=$RJ_Labor=$RJ_EKG=$RJ_Karcis_IGD=$RJ_Jasa_Tindakan=$RJ_Penerimaan_Obat=$RJ_Karcis=$Penerimaan_Lain=$Penerimaan_Total=$jumlah_vk=$jumlah_ok=$jumlah_rinap=$jumlah_rjalan=$jumlah_penbpjs=0;

		    	foreach ($jumlah_masuk_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$Penerimaan_Total = 0;
		    		}
		    		else $Penerimaan_Total = $value['Biaya'];
		    	}
		    	
		    	foreach ($jumlah_vk_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_vk = 0;
		    		}
		    		else $jumlah_vk = $value['Biaya'];
		    	}
		    	foreach ($jumlah_ok_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_ok = 0;
		    		}
		    		else $jumlah_ok = $value['Biaya'];
		    	}
		    	foreach ($jumlah_rinap_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_rinap = 0;
		    		}
		    		else $jumlah_rinap = $value['Biaya'];
		    	}
		    	foreach ($jumlah_penbpjs_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_penbpjs = 0;
		    		}
		    		else $jumlah_penbpjs = $value['Biaya'];
		    	}
		    	foreach ($jumlah_rjalan_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_rjalan = 0;
		    		}
		    		else $jumlah_rjalan = $value['Biaya'];
		    	}
		    	
		    	// print_r($Pengeluaran_Total);
		    	foreach($data1 as $key => $value) {
														
											

							if($value['Item_Transaksi'] === 'VK- Persalinan')
							{
								$VK_Persalinan = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'VK- Perawatan Bayi') 
						  	{
						  		$VK_Perawatan = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'VK- Jasa VK')
							{
								$VK_Jasa = $value['Biaya'];
							}
						 
						  
							elseif($value['Item_Transaksi'] === 'OK- Jasa OK') 
							{
								$OK_Jasa = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'OK- Penerimaan Alat Monitor') 
						  	{
						  		$OK_Monitor = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'OK- Penerimaan Alat Couter') 
							{
								$OK_Couter = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'OK- Penerimaan RR') 
							{
								$OK_RR = $value['Biaya'];
							}



							elseif($value['Item_Transaksi'] === 'Rawat Inap - VIP') 
							{
								$VIP = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas I')
						  	{
						  		$Kelas_I = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas II')

							{
								$Kelas_II = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas III')

							{
								$Kelas_III = $value['Biaya'];
							}

							elseif($value['Item_Transaksi'] === 'BPJS - Persentase dr dari pasien') 
							{
								$BPJS_Persentase = $value['Biaya'];
							}

							elseif($value['Item_Transaksi'] === 'BPJS - Jasa dr utk RS dari Jasa Visite') 
							{
								$BPJS_Dr_Visite = $value['Biaya'];
							}

							elseif($value['Item_Transaksi'] === 'BPJS - Labor Rawat Nginap')
						  	{
						  		$BPJS_Labor = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan HCU')
							{
								$BPJS_Penerimaan_HCU = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'BPJS - Transportasi') 
							{
								$BPJS_Transportasi = $value['Biaya'];
							}

							elseif($value['Item_Transaksi'] === 'BPJS - Medical Record')
							{
								$BPJS_Medical = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'BPJS - Piutang yang diterima')
							{
								$BPJS_Piutang = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan Obat - Obat Rawat Inap')
						  	{
						  		$BPJS_Penerimaan_Obat = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'BPJS - Perasat')
							{
								$BPJS_Perasat = $value['Biaya'];
							}										 
						  
							elseif($value['Item_Transaksi'] === 'BPJS - Insentif obat rawat inap + rawat jalan') 
							{
								$BPJS_Insentif = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'BPJS - Jasa Pelayanan') 
						  	{
						  		$BPJS_Jasa = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan Rotgen')
							{
								$BPJS_Penerimaan_Rontgen = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan USG')
							{
								$BPJS_Penerimaan_USG = $value['Biaya'];
							}




							elseif($value['Item_Transaksi'] === 'Rawat Jalan - Labor Rawat Jalan')
							{
								$RJ_Labor = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'Rawat Jalan - EKG Rawat Jalan + Rawat Inap')
						  	{
						  		$RJ_EKG = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'Rawat Jalan - Karcis IGD Rawat Jalan + Rawat Inap')
							{
								$RJ_Karcis_IGD = $value['Biaya'];
							}										 
						  
							elseif($value['Item_Transaksi'] === 'Rawat Jalan - Jasa Tindakan Rawat Jalan') 
							{
								$RJ_Jasa_Tindakan = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'Rawat Jalan - Penerimaan Obat-Obatan Rawat Jalan') 
						  	{
						  		$RJ_Penerimaan_Obat = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'Rawat Jalan - Karcis Rawat Jalan')
							{
								$RJ_Karcis = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'Penerimaan Lain-Lain')
							{
								$Penerimaan_Lain = $value['Biaya'];
							}

					}

					$total_semester=$total_semester+$Penerimaan_Total;
					$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+1),$VK_Persalinan);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+2),$VK_Perawatan);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+3),$VK_Jasa);
		   			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+4),$jumlah_vk);

		   			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+6),$OK_Jasa);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+7),$OK_Monitor);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+8),$OK_Couter);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+9),$OK_RR);	
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+10),$jumlah_ok);

		 			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+11),$jumlah_rinap);
					$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+12),$VIP);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+13),$Kelas_I);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+14),$Kelas_II);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+15),$Kelas_III);
			    	// $this->excel->getActiveSheet()->setCellValue($huruf.($numCell+17),'Pasien BPJS '.$jumlah_BPJS.' Orang');
					$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+18),$BPJS_Persentase);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+19),$BPJS_Dr_Visite);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+20),$BPJS_Labor);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+21),$BPJS_Penerimaan_HCU);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+22),$BPJS_Transportasi);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+23),$BPJS_Medical);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+24),$BPJS_Piutang);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+25),$BPJS_Penerimaan_Obat);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+26),$BPJS_Perasat);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+27),$BPJS_Insentif);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+28),$BPJS_Jasa);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+29),$BPJS_Penerimaan_Rontgen);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+30),$BPJS_Penerimaan_USG);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+31),$jumlah_penbpjs);

			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+33),$RJ_Labor);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+34),$RJ_EKG);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+35),$RJ_Karcis_IGD);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+36),$RJ_Jasa_Tindakan);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+37),$RJ_Penerimaan_Obat);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+38),$RJ_Karcis);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+39),$jumlah_rjalan);

			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+40),$Penerimaan_Lain);	

			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+42),$Penerimaan_Total);
		        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+43),$Penerimaan_Total);
		        }

					$this->excel->getActiveSheet()->setCellValue('I'.($numCell+44),$total_semester);
					$this->excel->getActiveSheet()->setCellValue('B'.($numCell+44),"JUMLAH TOTAL :");
					$this->excel->getActiveSheet()->mergeCells('B'.($numCell+44).':'.'H'.($numCell+44));
					$this->excel->getActiveSheet()->getStyle('B'.($numCell+44).':'.'I'.($numCell+44))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
					$this->excel->getActiveSheet()->getStyle('B'.($numCell+44))->getFont()->setBold(true);	

		         /** Borders for outside border */
		         $BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
		   		$this->excel->getActiveSheet()->getStyle('B5'.':'.'B'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('C5'.':'.'C'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('D5'.':'.'D'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('E5'.':'.'E'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('F5'.':'.'F'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('G5'.':'.'G'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('H5'.':'.'H'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('I5'.':'.'I'.($numCell+42))->applyFromArray($BStyle);
		   		
		        /** Set wrap Text **/
		   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'I'.($numCell+43)) ->getAlignment()->setWrapText(true); 
		   		/** Borders for heading */
		   		$this->excel->getActiveSheet()->getStyle('B4:I4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


    		
		    	
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+4).':'.'I'.($numCell+4))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+10).':'.'I'.($numCell+10))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+31).':'.'I'.($numCell+31))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+39).':'.'I'.($numCell+39))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				// $this->excel->getActiveSheet()->getStyle('H'.($numCell+12))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				// $this->excel->getActiveSheet()->getStyle('H'.($numCell+24))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;

				
		   		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+43).':'.'C'.($numCell+43));
		   		// $this->excel->getActiveSheet()->mergeCells('F'.($numCell+43).':'.'G'.($numCell+43));
		   		$this->excel->getActiveSheet()->getStyle('B'.($numCell+43).':'.'I'.($numCell+43))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


   		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+46), 'RSU AISYIYAH PADANG');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+47), 'DIREKTUR');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+47), 'KABAG KEUANGAN');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+52), 'dr. Hadril Busudin, Sp.S, MHA');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+52), 'Bachtar, S.Sos');	
   		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+47).':'.'D'.($numCell+47));
   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+47).':'.'H'.($numCell+47));
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+46).':'.'I'.($numCell+46));
		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+52).':'.'D'.($numCell+52));
   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+52).':'.'H'.($numCell+52));		
		$this->excel->getActiveSheet()->getStyle('C'.($numCell+47))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G'.($numCell+47))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C'.($numCell+52))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G'.($numCell+52))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B'.($numCell+46))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$filename='Laporan Penerimaan Semester 1 Tahun'.$tahun.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}	

	public function rekapitulasi_transaksi_bulanan_excel_semester2_masuk($tahun)
	{
		// if ($bulan < 10) {
		// 	$bulan = '0'.$bulan;
		// }
		// print_r($tanggal_lengkap);
		// $tanggal_lengkap= $tahun.'-'.$bulan;
		// $tanggal_asli = $bulan.'-'.$tahun;
		// $tanggal_saldo = ($bulan-1).'-'.$tahun;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'LAPORAN PENERIMAAN SEMESTER II TAHUN '.$tahun.'');
		$this->excel->getActiveSheet()->setCellValue('B2', 'RUMAH SAKIT UMUM AISYIYAH PADANG');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(38);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(14);
		
		

		$this->excel->getActiveSheet()->mergeCells('B1:I1');
		$this->excel->getActiveSheet()->mergeCells('B2:I2');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		


		$this->excel->getActiveSheet()->setCellValue('B4', "NO");
		// $this->excel->getActiveSheet()->mergeCells('B4:B8');
		$this->excel->getActiveSheet()->setCellValue('C4', "URAIAN");
		// $this->excel->getActiveSheet()->mergeCells('C4:C8');
		$this->excel->getActiveSheet()->setCellValue('D4', "JULI");
		// $this->excel->getActiveSheet()->mergeCells('D4:D8');
		
		$this->excel->getActiveSheet()->setCellValue('E4', "AGUSTUS");
		// $this->excel->getActiveSheet()->mergeCells('F4:F8');
		$this->excel->getActiveSheet()->setCellValue('F4', "SEPTEMBER");
		// $this->excel->getActiveSheet()->mergeCells('G4:G8');
		$this->excel->getActiveSheet()->setCellValue('G4', "OKTOBER");
		$this->excel->getActiveSheet()->setCellValue('H4', "NOVEMBER");
		$this->excel->getActiveSheet()->setCellValue('I4', "DESEMBER");
		// $this->excel->getActiveSheet()->mergeCells('H4:H8');

		
		



			$numCell=5;	
	
        $this->excel->getActiveSheet()->setCellValue('C'.$numCell,'Saldo Bulan Sebelumnya ');	

        $numCell=6;	
        $this->excel->getActiveSheet()->setCellValue('B'.$numCell, '1');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+1).':'.'B'.($numCell+4));
		$this->excel->getActiveSheet()->setCellValue('C'.$numCell,'Penerimaan VK');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+1),'a. Persalinan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+2),'b. Perawatan Bayi');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+3),'c. Jasa VK');

		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+5), '2');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+6).':'.'B'.($numCell+10));    	
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+5),'Penerimaan OK');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+6),'a. Jasa OK');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+7),'b. Penerimaan Alat Monitor');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8),'c. Penerimaan Alat Couter');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+9),'d. Penerimaan RR');	
    		
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+11), '3');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+12).':'.'B'.($numCell+31));
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+11),'a. Perawatan');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+12),'1. VIP  Rp.XXXXX');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+13),'2. Kelas I  Rp.XXXXX');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+14),'3. Kelas II  Rp.XXXXX');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+15),'4. Kelas III  Rp.XXXXX');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+17),'Pasien BPJS ');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+18),'b. Persentase dr dari pasien');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+19),'c. Jasa dr u/ RS dari jasa Visite');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+20),'d. Labor Rawat Nginap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+21),'e. Penerimaan HCU');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+22),'f. Transportasi');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+23),'g. Medical Record');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+24),'h. Piutang yang diterima');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+25),'i. Penerimaan Obat - Obat Rawat Inap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+26),'j. Perasat');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+27),'k. Insentif obat rawat inap + rawat jalan');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+28),'l. Jasa Pelayanan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+29),'m. Penerimaan Rotgen');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+30),'n. Penerimaan USG');		
    		
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+32), '4');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+33).':'.'B'.($numCell+39));
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+32),'Penerimaan Rawat Jalan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+33),'a. Labor Rawat Jalan');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+34),'b. EKG Rawat Jalan + Rawat Inap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+35),'c. Karcis IGD Rawat Jalan + Rawat Inap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+36),'d. Jasa Tindakan Rawat Jalan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+37),'e. Penerimaan Obat-Obatan Rawat Jalan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+38),'f. Karcis Rawat Jalan');

    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+40), '5');	
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+40),'Penerimaan Lain-Lain');	

    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+42),'Total Penerimaan');	
    	$this->excel->getActiveSheet()->getStyle('C'.($numCell+42))->getFont()->setBold(true);
    	
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+43),'JUMLAH');
    	$this->excel->getActiveSheet()->getStyle('B'.($numCell+43))->getFont()->setBold(true);		


        
    	$huruf = 'C';
    	// $hurufh = $huruf++;
    	// $hurufi = ++$hurufh;
    	$bulan=6;
    	$total_semester=0;	
    		for ($i=6; $i <12 ; $i++) {
    			$bulan++;
    			if ($bulan < 10) {
					$bulan = '0'.$bulan;
				}
				$tanggal_lengkap= $tahun.'-'.$bulan;	 

    			$huruf = ++$huruf;
    			$this->load->model('m_report');
				$data1= $this->m_report->tabel_bln_th_msk($tanggal_lengkap);		
				$data2= $this->m_report->tabel_bln_th_klr($tanggal_lengkap);
				$jumlah_masuk_sementara= $this->m_report->tabel_jumlah_bln_th_msk($tanggal_lengkap);
				$jumlah_keluar_sementara= $this->m_report->tabel_jumlah_bln_th_klr($tanggal_lengkap);
				$jumlah_vk_sementara=$this->m_report->tabel_jumlah_VK($tanggal_lengkap);
				$jumlah_ok_sementara=$this->m_report->tabel_jumlah_OK($tanggal_lengkap);
				$jumlah_rinap_sementara=$this->m_report->tabel_jumlah_rawat_inap($tanggal_lengkap);
				$jumlah_penbpjs_sementara=$this->m_report->tabel_jumlah_bpjs($tanggal_lengkap);
				$jumlah_rjalan_sementara=$this->m_report->tabel_jumlah_rawat_jalan($tanggal_lengkap);
				$jumlah_bp_sementara=$this->m_report->tabel_jumlah_belanja_pegawai($tanggal_lengkap);
				$jumlah_bo_sementara=$this->m_report->tabel_jumlah_belanja_operasional($tanggal_lengkap);	

		    	$VK_Persalinan=$VK_Perawatan=$VK_Jasa =$OK_Jasa=$OK_Monitor=$OK_Couter=$OK_RR=$VIP=$Kelas_I=$Kelas_II=$Kelas_III=$BPJS_Persentase=$BPJS_Dr_Visite=$BPJS_Labor=$BPJS_Penerimaan_HCU=$BPJS_Transportasi=$BPJS_Medical=$BPJS_Piutang=$BPJS_Penerimaan_Obat=$BPJS_Perasat=$BPJS_Insentif=$BPJS_Jasa=$BPJS_Penerimaan_Rontgen=$BPJS_Penerimaan_USG=$RJ_Labor=$RJ_EKG=$RJ_Karcis_IGD=$RJ_Jasa_Tindakan=$RJ_Penerimaan_Obat=$RJ_Karcis=$Penerimaan_Lain=$Penerimaan_Total=$jumlah_vk=$jumlah_ok=$jumlah_rinap=$jumlah_rjalan=$jumlah_penbpjs=0;

		    	foreach ($jumlah_masuk_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$Penerimaan_Total = 0;
		    		}
		    		else $Penerimaan_Total = $value['Biaya'];
		    	}
		    	
		    	foreach ($jumlah_vk_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_vk = 0;
		    		}
		    		else $jumlah_vk = $value['Biaya'];
		    	}
		    	foreach ($jumlah_ok_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_ok = 0;
		    		}
		    		else $jumlah_ok = $value['Biaya'];
		    	}
		    	foreach ($jumlah_rinap_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_rinap = 0;
		    		}
		    		else $jumlah_rinap = $value['Biaya'];
		    	}
		    	foreach ($jumlah_penbpjs_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_penbpjs = 0;
		    		}
		    		else $jumlah_penbpjs = $value['Biaya'];
		    	}
		    	foreach ($jumlah_rjalan_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_rjalan = 0;
		    		}
		    		else $jumlah_rjalan = $value['Biaya'];
		    	}
		    	
		    	// print_r($Pengeluaran_Total);
		    	foreach($data1 as $key => $value) {
														
											

							if($value['Item_Transaksi'] === 'VK- Persalinan')
							{
								$VK_Persalinan = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'VK- Perawatan Bayi') 
						  	{
						  		$VK_Perawatan = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'VK- Jasa VK')
							{
								$VK_Jasa = $value['Biaya'];
							}
						 
						  
							elseif($value['Item_Transaksi'] === 'OK- Jasa OK') 
							{
								$OK_Jasa = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'OK- Penerimaan Alat Monitor') 
						  	{
						  		$OK_Monitor = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'OK- Penerimaan Alat Couter') 
							{
								$OK_Couter = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'OK- Penerimaan RR') 
							{
								$OK_RR = $value['Biaya'];
							}



							elseif($value['Item_Transaksi'] === 'Rawat Inap - VIP') 
							{
								$VIP = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas I')
						  	{
						  		$Kelas_I = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas II')

							{
								$Kelas_II = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas III')

							{
								$Kelas_III = $value['Biaya'];
							}

							elseif($value['Item_Transaksi'] === 'BPJS - Persentase dr dari pasien') 
							{
								$BPJS_Persentase = $value['Biaya'];
							}

							elseif($value['Item_Transaksi'] === 'BPJS - Jasa dr utk RS dari Jasa Visite') 
							{
								$BPJS_Dr_Visite = $value['Biaya'];
							}

							elseif($value['Item_Transaksi'] === 'BPJS - Labor Rawat Nginap')
						  	{
						  		$BPJS_Labor = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan HCU')
							{
								$BPJS_Penerimaan_HCU = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'BPJS - Transportasi') 
							{
								$BPJS_Transportasi = $value['Biaya'];
							}

							elseif($value['Item_Transaksi'] === 'BPJS - Medical Record')
							{
								$BPJS_Medical = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'BPJS - Piutang yang diterima')
							{
								$BPJS_Piutang = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan Obat - Obat Rawat Inap')
						  	{
						  		$BPJS_Penerimaan_Obat = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'BPJS - Perasat')
							{
								$BPJS_Perasat = $value['Biaya'];
							}										 
						  
							elseif($value['Item_Transaksi'] === 'BPJS - Insentif obat rawat inap + rawat jalan') 
							{
								$BPJS_Insentif = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'BPJS - Jasa Pelayanan') 
						  	{
						  		$BPJS_Jasa = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan Rotgen')
							{
								$BPJS_Penerimaan_Rontgen = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan USG')
							{
								$BPJS_Penerimaan_USG = $value['Biaya'];
							}




							elseif($value['Item_Transaksi'] === 'Rawat Jalan - Labor Rawat Jalan')
							{
								$RJ_Labor = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'Rawat Jalan - EKG Rawat Jalan + Rawat Inap')
						  	{
						  		$RJ_EKG = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'Rawat Jalan - Karcis IGD Rawat Jalan + Rawat Inap')
							{
								$RJ_Karcis_IGD = $value['Biaya'];
							}										 
						  
							elseif($value['Item_Transaksi'] === 'Rawat Jalan - Jasa Tindakan Rawat Jalan') 
							{
								$RJ_Jasa_Tindakan = $value['Biaya'];
							}
							elseif($value['Item_Transaksi'] === 'Rawat Jalan - Penerimaan Obat-Obatan Rawat Jalan') 
						  	{
						  		$RJ_Penerimaan_Obat = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'Rawat Jalan - Karcis Rawat Jalan')
							{
								$RJ_Karcis = $value['Biaya'];
							}
						 
						  	elseif($value['Item_Transaksi'] === 'Penerimaan Lain-Lain')
							{
								$Penerimaan_Lain = $value['Biaya'];
							}

					}
					$total_semester	= $total_semester+$Penerimaan_Total;
					
					$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+1),$VK_Persalinan);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+2),$VK_Perawatan);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+3),$VK_Jasa);
		   			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+4),$jumlah_vk);

		   			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+6),$OK_Jasa);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+7),$OK_Monitor);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+8),$OK_Couter);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+9),$OK_RR);	
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+10),$jumlah_ok);

		 			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+11),$jumlah_rinap);
					$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+12),$VIP);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+13),$Kelas_I);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+14),$Kelas_II);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+15),$Kelas_III);
			    	// $this->excel->getActiveSheet()->setCellValue($huruf.($numCell+17),'Pasien BPJS '.$jumlah_BPJS.' Orang');
					$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+18),$BPJS_Persentase);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+19),$BPJS_Dr_Visite);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+20),$BPJS_Labor);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+21),$BPJS_Penerimaan_HCU);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+22),$BPJS_Transportasi);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+23),$BPJS_Medical);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+24),$BPJS_Piutang);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+25),$BPJS_Penerimaan_Obat);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+26),$BPJS_Perasat);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+27),$BPJS_Insentif);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+28),$BPJS_Jasa);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+29),$BPJS_Penerimaan_Rontgen);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+30),$BPJS_Penerimaan_USG);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+31),$jumlah_penbpjs);

			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+33),$RJ_Labor);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+34),$RJ_EKG);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+35),$RJ_Karcis_IGD);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+36),$RJ_Jasa_Tindakan);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+37),$RJ_Penerimaan_Obat);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+38),$RJ_Karcis);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+39),$jumlah_rjalan);

			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+40),$Penerimaan_Lain);	

			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+42),$Penerimaan_Total);
		        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+43),$Penerimaan_Total);
					
			}		
					$this->excel->getActiveSheet()->setCellValue('I'.($numCell+44),$total_semester);
					$this->excel->getActiveSheet()->setCellValue('B'.($numCell+44),"JUMLAH TOTAL :");
					$this->excel->getActiveSheet()->mergeCells('B'.($numCell+44).':'.'H'.($numCell+44));
					$this->excel->getActiveSheet()->getStyle('B'.($numCell+44).':'.'I'.($numCell+44))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
					$this->excel->getActiveSheet()->getStyle('B'.($numCell+44))->getFont()->setBold(true);	

		         /** Borders for outside border */
		         $BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
		   		$this->excel->getActiveSheet()->getStyle('B5'.':'.'B'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('C5'.':'.'C'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('D5'.':'.'D'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('E5'.':'.'E'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('F5'.':'.'F'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('G5'.':'.'G'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('H5'.':'.'H'.($numCell+42))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('I5'.':'.'I'.($numCell+42))->applyFromArray($BStyle);
		   		
		        /** Set wrap Text **/
		   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'I'.($numCell+43)) ->getAlignment()->setWrapText(true); 
		   		/** Borders for heading */
		   		$this->excel->getActiveSheet()->getStyle('B4:I4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


    		
		    	
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+4).':'.'I'.($numCell+4))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+10).':'.'I'.($numCell+10))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+31).':'.'I'.($numCell+31))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+39).':'.'I'.($numCell+39))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				// $this->excel->getActiveSheet()->getStyle('H'.($numCell+12))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				// $this->excel->getActiveSheet()->getStyle('H'.($numCell+24))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;

				
		   		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+43).':'.'C'.($numCell+43));
		   		// $this->excel->getActiveSheet()->mergeCells('F'.($numCell+43).':'.'G'.($numCell+43));
		   		$this->excel->getActiveSheet()->getStyle('B'.($numCell+43).':'.'I'.($numCell+43))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


   		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+46), 'RSU AISYIYAH PADANG');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+47), 'DIREKTUR');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+47), 'KABAG KEUANGAN');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+52), 'dr. Hadril Busudin, Sp.S, MHA');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+52), 'Bachtar, S.Sos');	
   		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+47).':'.'D'.($numCell+47));
   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+47).':'.'H'.($numCell+47));
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+46).':'.'I'.($numCell+46));
		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+52).':'.'D'.($numCell+52));
   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+52).':'.'H'.($numCell+52));		
		$this->excel->getActiveSheet()->getStyle('C'.($numCell+47))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G'.($numCell+47))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C'.($numCell+52))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G'.($numCell+52))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B'.($numCell+46))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// print_r($tanggal_lengkap);
		$filename='Laporan Penerimaan Semester 2 Tahun'.$tanggal_lengkap.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}

	public function rekapitulasi_transaksi_bulanan_excel_semester2_keluar($tahun)
	{
		// if ($bulan < 10) {
		// 	$bulan = '0'.$bulan;
		// }
		// print_r($tanggal_lengkap);
		// $tanggal_lengkap= $tahun.'-'.$bulan;
		// $tanggal_asli = $bulan.'-'.$tahun;
		// $tanggal_saldo = ($bulan-1).'-'.$tahun;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'LAPORAN PENGELUARAN SEMESTER II TAHUN '.$tahun.'');
		$this->excel->getActiveSheet()->setCellValue('B2', 'RUMAH SAKIT UMUM AISYIYAH PADANG');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(38);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(14);
		
		

		$this->excel->getActiveSheet()->mergeCells('B1:I1');
		$this->excel->getActiveSheet()->mergeCells('B2:I2');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		


		$this->excel->getActiveSheet()->setCellValue('B4', "NO");
		// $this->excel->getActiveSheet()->mergeCells('B4:B8');
		$this->excel->getActiveSheet()->setCellValue('C4', "URAIAN");
		// $this->excel->getActiveSheet()->mergeCells('C4:C8');
		$this->excel->getActiveSheet()->setCellValue('D4', "JULI");
		// $this->excel->getActiveSheet()->mergeCells('D4:D8');
		
		$this->excel->getActiveSheet()->setCellValue('E4', "AGUSTUS");
		// $this->excel->getActiveSheet()->mergeCells('F4:F8');
		$this->excel->getActiveSheet()->setCellValue('F4', "SEPTEMBER");
		// $this->excel->getActiveSheet()->mergeCells('G4:G8');
		$this->excel->getActiveSheet()->setCellValue('G4', "OKTOBER");
		$this->excel->getActiveSheet()->setCellValue('H4', "NOVEMBER");
		$this->excel->getActiveSheet()->setCellValue('I4', "DESEMBER");
		// $this->excel->getActiveSheet()->mergeCells('H4:H8');

		
		



			$numCell=5;	
        // $numCell=6;	
         $this->excel->getActiveSheet()->setCellValue('B'.$numCell, '1');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+1).':'.'B'.($numCell+12));
		$this->excel->getActiveSheet()->setCellValue('C'.$numCell,'Belanja Pegawai');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+1),'a. Gaji Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+2),'b. Insentif Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+3),'c. Honor Dr. Jaga');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+4),'d. Jasa UGD Dr');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+5),'e. Jasa Partus Bidan');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+6),'f. Jasa Cuci Kain OK + Kain Pasien');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+7),'g. Lembur Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8),'h. THR Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+9),'i. Beli Baju Dinas Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+10),'j. Perjalanan + Pelatihan');	
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+11),'k. Konsumsi Karyawan/Uang Daging');

		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+13), '2');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+14).':'.'B'.($numCell+24));
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+13),'Belanja Operasional');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+14),'a. Pengeluaran Administrasi');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+15),'b. Pengeluaran Dapur/Menu Pasien');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+16),'c. Pengeluaran Laboratorium');    	
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+17),'d. Pengeluaran Obat-Obatan');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+18),'e. Pengeluaran Mobil');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+19),'f. Pengeluaran Listrik + Kain Pasien');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+20),'g. Pengeluaran Air');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+21),'h. Pengeluaran Telepon');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+22),'i. Pengeluaran Inventaris');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+23),'j. Pemeliharaan Sarana');
    	
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+25), '3');	
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+25),'Pengeluaran Lain-Lain');

    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+27),'Total Pengeluaran');
    	$this->excel->getActiveSheet()->getStyle('C'.($numCell+27))->getFont()->setBold(true);
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+29),'Saldo Pada Kas');

    	// $this->excel->getActiveSheet()->setCellValue('B'.($numCell+43),'JUMLAH');
    	// $this->excel->getActiveSheet()->getStyle('B'.($numCell+43))->getFont()->setBold(true);	


        
    	$huruf = 'C';
    	// $hurufh = $huruf++;
    	// $hurufi = ++$hurufh;
    	$bulan=6;
    	$total_semester=0;	
    		for ($i=6; $i <12 ; $i++) {
    			$bulan++;
    			if ($bulan < 10) {
					$bulan = '0'.$bulan;
				}
				$tanggal_lengkap= $tahun.'-'.$bulan;	 

    			$huruf = ++$huruf;
    			$this->load->model('m_report');
				$data1= $this->m_report->tabel_bln_th_msk($tanggal_lengkap);		
				$data2= $this->m_report->tabel_bln_th_klr($tanggal_lengkap);
				$jumlah_masuk_sementara= $this->m_report->tabel_jumlah_bln_th_msk($tanggal_lengkap);
				$jumlah_keluar_sementara= $this->m_report->tabel_jumlah_bln_th_klr($tanggal_lengkap);
				$jumlah_vk_sementara=$this->m_report->tabel_jumlah_VK($tanggal_lengkap);
				$jumlah_ok_sementara=$this->m_report->tabel_jumlah_OK($tanggal_lengkap);
				$jumlah_rinap_sementara=$this->m_report->tabel_jumlah_rawat_inap($tanggal_lengkap);
				$jumlah_penbpjs_sementara=$this->m_report->tabel_jumlah_bpjs($tanggal_lengkap);
				$jumlah_rjalan_sementara=$this->m_report->tabel_jumlah_rawat_jalan($tanggal_lengkap);
				$jumlah_bp_sementara=$this->m_report->tabel_jumlah_belanja_pegawai($tanggal_lengkap);
				$jumlah_bo_sementara=$this->m_report->tabel_jumlah_belanja_operasional($tanggal_lengkap);	

		    	$BP_Gaji=$BP_Insentif=$BP_Honor=$BP_UGD=$BP_Partus=$BP_Cuci=$BP_Lembur=$BP_THR=$BP_Beli=$BP_Perjalanan=$BP_Konsumsi=$BO_Administrasi=$BO_Dapur=$BO_Laboratorium=$BO_Obat=$BO_Mobil=$BO_Listrik=$BO_Air=$BO_Telepon=$BO_Inventaris=$BO_Sarana=$Png_Lain=$Pengeluaran_Total=$Saldo_Kas=$jumlah_BP=$jumlah_BO=0;
		
				foreach ($jumlah_keluar_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$Pengeluaran_Total = 0;
		    		}
		    		else $Pengeluaran_Total = $value['Biaya'];
		    	}
		    	foreach ($jumlah_bp_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_BP = 0;
		    		}
		    		else $jumlah_BP = $value['Biaya'];
		    	}
		    	foreach ($jumlah_bo_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_BO = 0;
		    		}
		    		else $jumlah_BO = $value['Biaya'];
		    	}
		 		// print_r($jumlah_BO);
				foreach($data2 as $key => $value) {
							
					

						if($value['Item_Transaksi'] ==='B.Pegawai - Gaji Karyawan')
						{
							$BP_Gaji = $value['Biaya'];
						}
						elseif($value['Item_Transaksi'] ==='B.Pegawai - Insentif Karyawan') 
					  	{
					  		$BP_Insentif = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Honor Dr. Jaga')
						{
							$BP_Honor = $value['Biaya'];
						}
					 
					  
						elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa UGD Dr') 
						{
							$BP_UGD = $value['Biaya'];
						}
						elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa Partus Bidan') 
					  	{
					  		$BP_Partus = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa Cuci Kain OK + Kain Pasien') 
						{
							$BP_Cuci = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Lembur Karyawan') 
						{
							$BP_Lembur = $value['Biaya'];
						}

						elseif($value['Item_Transaksi'] ==='B.Pegawai - THR Karyawan') 
						{
							$BP_THR = $value['Biaya'];
						}
						elseif($value['Item_Transaksi'] ==='B.Pegawai - Beli Baju Dinas Karyawan')
					  	{
					  		$BP_Beli = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Perjalanan + Pelatihan')

						{
							$BP_Perjalanan = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Konsumsi Karyawan/Uang Daging')

						{
							$BP_Konsumsi = $value['Biaya'];
						}


						elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Administrasi') 
						{
							$BO_Administrasi = $value['Biaya'];
						}

						elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Dapur/Menu Pasien') 
						{
							$BO_Dapur = $value['Biaya'];
						}

						elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Laboratorium')
					  	{
					  		$BO_Laboratorium = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Obat-Obatan')
						{
							$BO_Obat = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Mobil') 
						{
							$BO_Mobil = $value['Biaya'];
						}

						elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Listrik + Kain Pasien')
						{
							$BO_Listrik = $value['Biaya'];
						}
						elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Air')
						{
							$BO_Air = $value['Biaya'];
						}
						elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Telepon')
					  	{
					  		$BO_Telepon = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Inventaris')
						{
							$BO_Inventaris = $value['Biaya'];
						}										 
					  
						elseif($value['Item_Transaksi'] === 'B.Operasional - Pemeliharaan Sarana') 
						{
							$BO_Sarana = $value['Biaya'];
						}

						elseif($value['Item_Transaksi'] === 'Pengeluaran Lain-Lain') 
						{
							$Png_Lain = $value['Biaya'];
						}

					 }	
							$total_semester	= $total_semester+$Pengeluaran_Total;
							
					$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+1),$BP_Gaji);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+2),$BP_Insentif);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+3),$BP_Honor);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+4),$BP_UGD);   			
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+5),$BP_Partus);
		   			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+6),$BP_Cuci);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+7),$BP_Lembur);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+8),$BP_THR);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+9),$BP_Beli);	
		 			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+10),$BP_Perjalanan);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+11),$BP_Konsumsi);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+12),$jumlah_BP);

			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+14),$BO_Administrasi);   			
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+15),$BO_Dapur);
		   			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+16),$BO_Laboratorium);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+17),$BO_Obat);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+18),$BO_Mobil);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+19),$BO_Listrik);	
		 			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+20),$BO_Air);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+21),$BO_Telepon);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+22),$BO_Inventaris);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+23),$BO_Sarana);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+24),$jumlah_BO);

			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+25),$Png_Lain);

			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+27),$Pengeluaran_Total);

			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+29),$Saldo_Kas);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+31),$Pengeluaran_Total);
					
			}		
					$this->excel->getActiveSheet()->setCellValue('I'.($numCell+33),$total_semester);
					$this->excel->getActiveSheet()->setCellValue('B'.($numCell+33),"JUMLAH TOTAL :");
					$this->excel->getActiveSheet()->mergeCells('B'.($numCell+33).':'.'H'.($numCell+33));
					$this->excel->getActiveSheet()->getStyle('B'.($numCell+33).':'.'I'.($numCell+33))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
					$this->excel->getActiveSheet()->getStyle('B'.($numCell+33))->getFont()->setBold(true);	

		         /** Borders for outside border */
		         $BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
		   		$this->excel->getActiveSheet()->getStyle('B5'.':'.'B'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('C5'.':'.'C'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('D5'.':'.'D'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('E5'.':'.'E'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('F5'.':'.'F'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('G5'.':'.'G'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('H5'.':'.'H'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('I5'.':'.'I'.($numCell+33))->applyFromArray($BStyle);
		   		
		        /** Set wrap Text **/
		   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'I'.($numCell+34)) ->getAlignment()->setWrapText(true); 
		   		/** Borders for heading */
		   		$this->excel->getActiveSheet()->getStyle('B4:I4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


    		
		    	
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+12).':'.'I'.($numCell+12))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+24).':'.'I'.($numCell+24))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+31).':'.'I'.($numCell+31))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
					
		   		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+33).':'.'C'.($numCell+33));
		   		// $this->excel->getActiveSheet()->mergeCells('F'.($numCell+43).':'.'G'.($numCell+43));
		   		$this->excel->getActiveSheet()->getStyle('D'.($numCell+27).':'.'I'.($numCell+27))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


   		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+35), 'RSU AISYIYAH PADANG');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+36), 'DIREKTUR');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+36), 'KABAG KEUANGAN');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+41), 'dr. Hadril Busudin, Sp.S, MHA');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+41), 'Bachtar, S.Sos');	
   		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+36).':'.'D'.($numCell+36));
   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+36).':'.'H'.($numCell+36));
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+35).':'.'I'.($numCell+35));
		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+41).':'.'D'.($numCell+41));
   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+41).':'.'H'.($numCell+41));		
		$this->excel->getActiveSheet()->getStyle('C'.($numCell+36))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G'.($numCell+36))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C'.($numCell+41))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G'.($numCell+41))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B'.($numCell+35))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$filename='Rekapitulasi Pengeluaran Semester 2 Tahun'.$tanggal_lengkap.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}

	public function rekapitulasi_transaksi_bulanan_excel_semester1_keluar($tahun)
	{
		// if ($bulan < 10) {
		// 	$bulan = '0'.$bulan;
		// }
		// print_r($tanggal_lengkap);
		// $tanggal_lengkap= $tahun.'-'.$bulan;
		// $tanggal_asli = $bulan.'-'.$tahun;
		// $tanggal_saldo = ($bulan-1).'-'.$tahun;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'LAPORAN PENGELUARAN SEMESTER I TAHUN '.$tahun.'');
		$this->excel->getActiveSheet()->setCellValue('B2', 'RUMAH SAKIT UMUM AISYIYAH PADANG');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(38);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(14);
		
		

		$this->excel->getActiveSheet()->mergeCells('B1:I1');
		$this->excel->getActiveSheet()->mergeCells('B2:I2');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		


		$this->excel->getActiveSheet()->setCellValue('B4', "NO");
		// $this->excel->getActiveSheet()->mergeCells('B4:B8');
		$this->excel->getActiveSheet()->setCellValue('C4', "URAIAN");
		// $this->excel->getActiveSheet()->mergeCells('C4:C8');
		$this->excel->getActiveSheet()->setCellValue('D4', "JANUARI");
		// $this->excel->getActiveSheet()->mergeCells('D4:D8');
		
		$this->excel->getActiveSheet()->setCellValue('E4', "FEBRUARI");
		// $this->excel->getActiveSheet()->mergeCells('F4:F8');
		$this->excel->getActiveSheet()->setCellValue('F4', "MARET");
		// $this->excel->getActiveSheet()->mergeCells('G4:G8');
		$this->excel->getActiveSheet()->setCellValue('G4', "APRIL");
		$this->excel->getActiveSheet()->setCellValue('H4', "MEI");
		$this->excel->getActiveSheet()->setCellValue('I4', "JUNI");
		// $this->excel->getActiveSheet()->mergeCells('H4:H8');

		
		



			$numCell=5;	
        // $numCell=6;	
         $this->excel->getActiveSheet()->setCellValue('B'.$numCell, '1');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+1).':'.'B'.($numCell+12));
		$this->excel->getActiveSheet()->setCellValue('C'.$numCell,'Belanja Pegawai');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+1),'a. Gaji Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+2),'b. Insentif Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+3),'c. Honor Dr. Jaga');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+4),'d. Jasa UGD Dr');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+5),'e. Jasa Partus Bidan');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+6),'f. Jasa Cuci Kain OK + Kain Pasien');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+7),'g. Lembur Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8),'h. THR Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+9),'i. Beli Baju Dinas Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+10),'j. Perjalanan + Pelatihan');	
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+11),'k. Konsumsi Karyawan/Uang Daging');

		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+13), '2');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+14).':'.'B'.($numCell+24));
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+13),'Belanja Operasional');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+14),'a. Pengeluaran Administrasi');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+15),'b. Pengeluaran Dapur/Menu Pasien');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+16),'c. Pengeluaran Laboratorium');    	
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+17),'d. Pengeluaran Obat-Obatan');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+18),'e. Pengeluaran Mobil');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+19),'f. Pengeluaran Listrik + Kain Pasien');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+20),'g. Pengeluaran Air');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+21),'h. Pengeluaran Telepon');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+22),'i. Pengeluaran Inventaris');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+23),'j. Pemeliharaan Sarana');
    	
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+25), '3');	
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+25),'Pengeluaran Lain-Lain');

    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+27),'Total Pengeluaran');
    	$this->excel->getActiveSheet()->getStyle('C'.($numCell+27))->getFont()->setBold(true);
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+29),'Saldo Pada Kas');

    	// $this->excel->getActiveSheet()->setCellValue('B'.($numCell+43),'JUMLAH');
    	// $this->excel->getActiveSheet()->getStyle('B'.($numCell+43))->getFont()->setBold(true);	


        
    	$huruf = 'C';
    	// $hurufh = $huruf++;
    	// $hurufi = ++$hurufh;
    	$bulan=0;
    	$total_semester=0;	
    		for ($i=0; $i <6 ; $i++) {
    			$bulan++;
    			if ($bulan < 10) {
					$bulan = '0'.$bulan;
				}
				$tanggal_lengkap= $tahun.'-'.$bulan;	 

    			$huruf = ++$huruf;
    			$this->load->model('m_report');
				$data1= $this->m_report->tabel_bln_th_msk($tanggal_lengkap);		
				$data2= $this->m_report->tabel_bln_th_klr($tanggal_lengkap);
				$jumlah_masuk_sementara= $this->m_report->tabel_jumlah_bln_th_msk($tanggal_lengkap);
				$jumlah_keluar_sementara= $this->m_report->tabel_jumlah_bln_th_klr($tanggal_lengkap);
				$jumlah_vk_sementara=$this->m_report->tabel_jumlah_VK($tanggal_lengkap);
				$jumlah_ok_sementara=$this->m_report->tabel_jumlah_OK($tanggal_lengkap);
				$jumlah_rinap_sementara=$this->m_report->tabel_jumlah_rawat_inap($tanggal_lengkap);
				$jumlah_penbpjs_sementara=$this->m_report->tabel_jumlah_bpjs($tanggal_lengkap);
				$jumlah_rjalan_sementara=$this->m_report->tabel_jumlah_rawat_jalan($tanggal_lengkap);
				$jumlah_bp_sementara=$this->m_report->tabel_jumlah_belanja_pegawai($tanggal_lengkap);
				$jumlah_bo_sementara=$this->m_report->tabel_jumlah_belanja_operasional($tanggal_lengkap);	

		    	$BP_Gaji=$BP_Insentif=$BP_Honor=$BP_UGD=$BP_Partus=$BP_Cuci=$BP_Lembur=$BP_THR=$BP_Beli=$BP_Perjalanan=$BP_Konsumsi=$BO_Administrasi=$BO_Dapur=$BO_Laboratorium=$BO_Obat=$BO_Mobil=$BO_Listrik=$BO_Air=$BO_Telepon=$BO_Inventaris=$BO_Sarana=$Png_Lain=$Pengeluaran_Total=$Saldo_Kas=$jumlah_BP=$jumlah_BO=0;
		
				foreach ($jumlah_keluar_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$Pengeluaran_Total = 0;
		    		}
		    		else $Pengeluaran_Total = $value['Biaya'];
		    	}
		    	foreach ($jumlah_bp_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_BP = 0;
		    		}
		    		else $jumlah_BP = $value['Biaya'];
		    	}
		    	foreach ($jumlah_bo_sementara as $key => $value) {
		    		if ($value['Biaya'] == '') {
		    			$jumlah_BO = 0;
		    		}
		    		else $jumlah_BO = $value['Biaya'];
		    	}
		 		// print_r($jumlah_BO);
				foreach($data2 as $key => $value) {
							
					

						if($value['Item_Transaksi'] ==='B.Pegawai - Gaji Karyawan')
						{
							$BP_Gaji = $value['Biaya'];
						}
						elseif($value['Item_Transaksi'] ==='B.Pegawai - Insentif Karyawan') 
					  	{
					  		$BP_Insentif = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Honor Dr. Jaga')
						{
							$BP_Honor = $value['Biaya'];
						}
					 
					  
						elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa UGD Dr') 
						{
							$BP_UGD = $value['Biaya'];
						}
						elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa Partus Bidan') 
					  	{
					  		$BP_Partus = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa Cuci Kain OK + Kain Pasien') 
						{
							$BP_Cuci = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Lembur Karyawan') 
						{
							$BP_Lembur = $value['Biaya'];
						}

						elseif($value['Item_Transaksi'] ==='B.Pegawai - THR Karyawan') 
						{
							$BP_THR = $value['Biaya'];
						}
						elseif($value['Item_Transaksi'] ==='B.Pegawai - Beli Baju Dinas Karyawan')
					  	{
					  		$BP_Beli = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Perjalanan + Pelatihan')

						{
							$BP_Perjalanan = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Konsumsi Karyawan/Uang Daging')

						{
							$BP_Konsumsi = $value['Biaya'];
						}


						elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Administrasi') 
						{
							$BO_Administrasi = $value['Biaya'];
						}

						elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Dapur/Menu Pasien') 
						{
							$BO_Dapur = $value['Biaya'];
						}

						elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Laboratorium')
					  	{
					  		$BO_Laboratorium = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Obat-Obatan')
						{
							$BO_Obat = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Mobil') 
						{
							$BO_Mobil = $value['Biaya'];
						}

						elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Listrik + Kain Pasien')
						{
							$BO_Listrik = $value['Biaya'];
						}
						elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Air')
						{
							$BO_Air = $value['Biaya'];
						}
						elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Telepon')
					  	{
					  		$BO_Telepon = $value['Biaya'];
						}
					 
					  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Inventaris')
						{
							$BO_Inventaris = $value['Biaya'];
						}										 
					  
						elseif($value['Item_Transaksi'] === 'B.Operasional - Pemeliharaan Sarana') 
						{
							$BO_Sarana = $value['Biaya'];
						}

						elseif($value['Item_Transaksi'] === 'Pengeluaran Lain-Lain') 
						{
							$Png_Lain = $value['Biaya'];
						}

					 }	
							$total_semester	= $total_semester+$Pengeluaran_Total;
							
					$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+1),$BP_Gaji);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+2),$BP_Insentif);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+3),$BP_Honor);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+4),$BP_UGD);   			
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+5),$BP_Partus);
		   			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+6),$BP_Cuci);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+7),$BP_Lembur);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+8),$BP_THR);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+9),$BP_Beli);	
		 			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+10),$BP_Perjalanan);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+11),$BP_Konsumsi);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+12),$jumlah_BP);

			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+14),$BO_Administrasi);   			
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+15),$BO_Dapur);
		   			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+16),$BO_Laboratorium);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+17),$BO_Obat);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+18),$BO_Mobil);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+19),$BO_Listrik);	
		 			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+20),$BO_Air);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+21),$BO_Telepon);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+22),$BO_Inventaris);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+23),$BO_Sarana);
			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+24),$jumlah_BO);

			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+25),$Png_Lain);

			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+27),$Pengeluaran_Total);

			       	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+29),$Saldo_Kas);
			    	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+31),$Pengeluaran_Total);
					
			}		
					$this->excel->getActiveSheet()->setCellValue('I'.($numCell+33),$total_semester);
					$this->excel->getActiveSheet()->setCellValue('B'.($numCell+33),"JUMLAH TOTAL :");
					$this->excel->getActiveSheet()->mergeCells('B'.($numCell+33).':'.'H'.($numCell+33));
					$this->excel->getActiveSheet()->getStyle('B'.($numCell+33).':'.'I'.($numCell+33))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
					$this->excel->getActiveSheet()->getStyle('B'.($numCell+33))->getFont()->setBold(true);	

		         /** Borders for outside border */
		         $BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
		   		$this->excel->getActiveSheet()->getStyle('B5'.':'.'B'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('C5'.':'.'C'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('D5'.':'.'D'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('E5'.':'.'E'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('F5'.':'.'F'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('G5'.':'.'G'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('H5'.':'.'H'.($numCell+33))->applyFromArray($BStyle);
		   		$this->excel->getActiveSheet()->getStyle('I5'.':'.'I'.($numCell+33))->applyFromArray($BStyle);
		   		
		        /** Set wrap Text **/
		   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'I'.($numCell+34)) ->getAlignment()->setWrapText(true); 
		   		/** Borders for heading */
		   		$this->excel->getActiveSheet()->getStyle('B4:I4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


    		
		    	
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+12).':'.'I'.($numCell+12))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+24).':'.'I'.($numCell+24))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
				$this->excel->getActiveSheet()->getStyle('D'.($numCell+31).':'.'I'.($numCell+31))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
					
		   		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+33).':'.'C'.($numCell+33));
		   		// $this->excel->getActiveSheet()->mergeCells('F'.($numCell+43).':'.'G'.($numCell+43));
		   		$this->excel->getActiveSheet()->getStyle('D'.($numCell+27).':'.'I'.($numCell+27))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


   		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+35), 'RSU AISYIYAH PADANG');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+36), 'DIREKTUR');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+36), 'KABAG KEUANGAN');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+41), 'dr. Hadril Busudin, Sp.S, MHA');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+41), 'Bachtar, S.Sos');	
   		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+36).':'.'D'.($numCell+36));
   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+36).':'.'H'.($numCell+36));
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+35).':'.'I'.($numCell+35));
		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+41).':'.'D'.($numCell+41));
   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+41).':'.'H'.($numCell+41));		
		$this->excel->getActiveSheet()->getStyle('C'.($numCell+36))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G'.($numCell+36))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C'.($numCell+41))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G'.($numCell+41))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B'.($numCell+35))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$filename='Laporan Pengeluaran Semester 1 Tahun '.$tanggal_lengkap.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}

	// public function rekapitulasi_transaksi_bulanan_excel($bulan,$tahun)
	// {
	// 	if ($bulan < 10) {
	// 		$bulan = '0'.$bulan;
	// 	}
	// 	// print_r($tanggal_lengkap);
	// 	$tanggal_lengkap= $tahun.'-'.$bulan;
	// 	$tanggal_asli = $bulan.'-'.$tahun;
	// 	$tanggal_saldo = ($bulan-1).'-'.$tahun;

	// 	$this->load->library('excel');
	// 	$this->excel->setActiveSheetIndex(0);
	// 	$this->excel->getActiveSheet()->setTitle('test worksheet');
	// 	$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
	// 	$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
	// 	$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(14);
	// 	$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
	// 	$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(14);
	// 	$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);

	// 	$this->excel->getActiveSheet()->setCellValue('B1', 'LAPORAN PENGELUARAN SEMESTER I TAHUN '.$tahun.'');
	// 	$this->excel->getActiveSheet()->setCellValue('B2', 'RUMAH SAKIT UMUM AISYIYAH PADANG');

	// 	$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
	// 	$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
	// 	$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(38);
	// 	$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
	// 	$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
	// 	$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
	// 	$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
	// 	$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
	// 	$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
	// 	$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(14);
	// 	$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(14);
	// 	$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(14);
	// 	$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(14);
	// 	$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(14);
	// 	$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(14);
		
		

	// 	$this->excel->getActiveSheet()->mergeCells('B1:I1');
	// 	$this->excel->getActiveSheet()->mergeCells('B2:I2');
		
	// 	$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// 	$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		


	// 	$this->excel->getActiveSheet()->setCellValue('B4', "NO");
	// 	// $this->excel->getActiveSheet()->mergeCells('B4:B8');
	// 	$this->excel->getActiveSheet()->setCellValue('C4', "URAIAN");
	// 	// $this->excel->getActiveSheet()->mergeCells('C4:C8');
	// 	$this->excel->getActiveSheet()->setCellValue('D4', "JANUARI");
	// 	// $this->excel->getActiveSheet()->mergeCells('D4:D8');
		
	// 	$this->excel->getActiveSheet()->setCellValue('E4', "FEBRUARI");
	// 	// $this->excel->getActiveSheet()->mergeCells('F4:F8');
	// 	$this->excel->getActiveSheet()->setCellValue('F4', "MARET");
	// 	// $this->excel->getActiveSheet()->mergeCells('G4:G8');
	// 	$this->excel->getActiveSheet()->setCellValue('G4', "APRIL");
	// 	$this->excel->getActiveSheet()->setCellValue('H4', "MEI");
	// 	$this->excel->getActiveSheet()->setCellValue('I4', "JUNI");
	// 	// $this->excel->getActiveSheet()->mergeCells('H4:H8');

		
		



	// 		$numCell=5;	
 //        // $numCell=6;	
 //         $this->excel->getActiveSheet()->setCellValue('B'.$numCell, '1');
	// 	$this->excel->getActiveSheet()->mergeCells('B'.($numCell+1).':'.'B'.($numCell+12));
	// 	$this->excel->getActiveSheet()->setCellValue('C'.$numCell,'Belanja Pegawai');
 //       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+1),'a. Gaji Karyawan');
 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+2),'b. Insentif Karyawan');
 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+3),'c. Honor Dr. Jaga');
 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+4),'d. Jasa UGD Dr');
	// 	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+5),'e. Jasa Partus Bidan');
	// 	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+6),'f. Jasa Cuci Kain OK + Kain Pasien');
 //       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+7),'g. Lembur Karyawan');
 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8),'h. THR Karyawan');
 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+9),'i. Beli Baju Dinas Karyawan');
 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+10),'j. Perjalanan + Pelatihan');	
	// 	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+11),'k. Konsumsi Karyawan/Uang Daging');

	// 	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+13), '2');
	// 	$this->excel->getActiveSheet()->mergeCells('B'.($numCell+14).':'.'B'.($numCell+24));
	// 	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+13),'Belanja Operasional');
 //       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+14),'a. Pengeluaran Administrasi');
	// 	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+15),'b. Pengeluaran Dapur/Menu Pasien');
 //       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+16),'c. Pengeluaran Laboratorium');    	
 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+17),'d. Pengeluaran Obat-Obatan');
	// 	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+18),'e. Pengeluaran Mobil');
 //       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+19),'f. Pengeluaran Listrik + Kain Pasien');
 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+20),'g. Pengeluaran Air');
 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+21),'h. Pengeluaran Telepon');
 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+22),'i. Pengeluaran Inventaris');
 //       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+23),'j. Pemeliharaan Sarana');
    	
 //    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+25), '3');	
 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+25),'Pengeluaran Lain-Lain');

 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+27),'Total Pengeluaran');
 //    	$this->excel->getActiveSheet()->getStyle('C'.($numCell+27))->getFont()->setBold(true);
 //    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+29),'Saldo Pada Kas');

 //    	// $this->excel->getActiveSheet()->setCellValue('B'.($numCell+43),'JUMLAH');
 //    	// $this->excel->getActiveSheet()->getStyle('B'.($numCell+43))->getFont()->setBold(true);	


        
 //    	$huruf = 'C';
 //    	// $hurufh = $huruf++;
 //    	// $hurufi = ++$hurufh;
 //    	$bulan=5;
 //    	$total_semester=0;	
 //    		for ($i=0; $i <6 ; $i++) {
 //    			$bulan++;
 //    			if ($bulan < 10) {
	// 				$bulan = '0'.$bulan;
	// 			}
	// 			$tanggal_lengkap= $tahun.'-'.$bulan;	 

 //    			$huruf = ++$huruf;
 //    			$this->load->model('m_report');
	// 			$data1= $this->m_report->tabel_bln_th_msk($tanggal_lengkap);		
	// 			$data2= $this->m_report->tabel_bln_th_klr($tanggal_lengkap);
	// 			$jumlah_masuk_sementara= $this->m_report->tabel_jumlah_bln_th_msk($tanggal_lengkap);
	// 			$jumlah_keluar_sementara= $this->m_report->tabel_jumlah_bln_th_klr($tanggal_lengkap);
	// 			$jumlah_vk_sementara=$this->m_report->tabel_jumlah_VK($tanggal_lengkap);
	// 			$jumlah_ok_sementara=$this->m_report->tabel_jumlah_OK($tanggal_lengkap);
	// 			$jumlah_rinap_sementara=$this->m_report->tabel_jumlah_rawat_inap($tanggal_lengkap);
	// 			$jumlah_penbpjs_sementara=$this->m_report->tabel_jumlah_bpjs($tanggal_lengkap);
	// 			$jumlah_rjalan_sementara=$this->m_report->tabel_jumlah_rawat_jalan($tanggal_lengkap);
	// 			$jumlah_bp_sementara=$this->m_report->tabel_jumlah_belanja_pegawai($tanggal_lengkap);
	// 			$jumlah_bo_sementara=$this->m_report->tabel_jumlah_belanja_operasional($tanggal_lengkap);	

	// 	    	$BP_Gaji=$BP_Insentif=$BP_Honor=$BP_UGD=$BP_Partus=$BP_Cuci=$BP_Lembur=$BP_THR=$BP_Beli=$BP_Perjalanan=$BP_Konsumsi=$BO_Administrasi=$BO_Dapur=$BO_Laboratorium=$BO_Obat=$BO_Mobil=$BO_Listrik=$BO_Air=$BO_Telepon=$BO_Inventaris=$BO_Sarana=$Png_Lain=$Pengeluaran_Total=$Saldo_Kas=$jumlah_BP=$jumlah_BO=0;
		
	// 	foreach ($jumlah_keluar_sementara as $key => $value) {
 //    		if ($value['Biaya'] == '') {
 //    			$Pengeluaran_Total = 0;
 //    		}
 //    		else $Pengeluaran_Total = $value['Biaya'];
 //    	}
 //    	foreach ($jumlah_bp_sementara as $key => $value) {
 //    		if ($value['Biaya'] == '') {
 //    			$jumlah_BP = 0;
 //    		}
 //    		else $jumlah_BP = $value['Biaya'];
 //    	}
 //    	foreach ($jumlah_bo_sementara as $key => $value) {
 //    		if ($value['Biaya'] == '') {
 //    			$jumlah_BO = 0;
 //    		}
 //    		else $jumlah_BO = $value['Biaya'];
 //    	}
 // 		// print_r($jumlah_BO);
	// 	foreach($data2 as $key => $value) {
					
			

	// 			if($value['Item_Transaksi'] ==='B.Pegawai - Gaji Karyawan')
	// 			{
	// 				$BP_Gaji = $value['Biaya'];
	// 			}
	// 			elseif($value['Item_Transaksi'] ==='B.Pegawai - Insentif Karyawan') 
	// 		  	{
	// 		  		$BP_Insentif = $value['Biaya'];
	// 			}
			 
	// 		  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Honor Dr. Jaga')
	// 			{
	// 				$BP_Honor = $value['Biaya'];
	// 			}
			 
			  
	// 			elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa UGD Dr') 
	// 			{
	// 				$BP_UGD = $value['Biaya'];
	// 			}
	// 			elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa Partus Bidan') 
	// 		  	{
	// 		  		$BP_Partus = $value['Biaya'];
	// 			}
			 
	// 		  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa Cuci Kain OK + Kain Pasien') 
	// 			{
	// 				$BP_Cuci = $value['Biaya'];
	// 			}
			 
	// 		  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Lembur Karyawan') 
	// 			{
	// 				$BP_Lembur = $value['Biaya'];
	// 			}

	// 			elseif($value['Item_Transaksi'] ==='B.Pegawai - THR Karyawan') 
	// 			{
	// 				$BP_THR = $value['Biaya'];
	// 			}
	// 			elseif($value['Item_Transaksi'] ==='B.Pegawai - Beli Baju Dinas Karyawan')
	// 		  	{
	// 		  		$BP_Beli = $value['Biaya'];
	// 			}
			 
	// 		  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Perjalanan + Pelatihan')

	// 			{
	// 				$BP_Perjalanan = $value['Biaya'];
	// 			}
			 
	// 		  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Konsumsi Karyawan/Uang Daging')

	// 			{
	// 				$BP_Konsumsi = $value['Biaya'];
	// 			}


	// 			elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Administrasi') 
	// 			{
	// 				$BO_Administrasi = $value['Biaya'];
	// 			}

	// 			elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Dapur/Menu Pasien') 
	// 			{
	// 				$BO_Dapur = $value['Biaya'];
	// 			}

	// 			elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Laboratorium')
	// 		  	{
	// 		  		$BO_Laboratorium = $value['Biaya'];
	// 			}
			 
	// 		  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Obat-Obatan')
	// 			{
	// 				$BO_Obat = $value['Biaya'];
	// 			}
			 
	// 		  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Mobil') 
	// 			{
	// 				$BO_Mobil = $value['Biaya'];
	// 			}

	// 			elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Listrik + Kain Pasien')
	// 			{
	// 				$BO_Listrik = $value['Biaya'];
	// 			}
	// 			elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Air')
	// 			{
	// 				$BO_Air = $value['Biaya'];
	// 			}
	// 			elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Telepon')
	// 		  	{
	// 		  		$BO_Telepon = $value['Biaya'];
	// 			}
			 
	// 		  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Inventaris')
	// 			{
	// 				$BO_Inventaris = $value['Biaya'];
	// 			}										 
			  
	// 			elseif($value['Item_Transaksi'] === 'B.Operasional - Pemeliharaan Sarana') 
	// 			{
	// 				$BO_Sarana = $value['Biaya'];
	// 			}

	// 			elseif($value['Item_Transaksi'] === 'Pengeluaran Lain-Lain') 
	// 			{
	// 				$Png_Lain = $value['Biaya'];
	// 			}

	// 		 }	
	// 				$total_semester	= $total_semester+$Pengeluaran_Total;
					
	// 		$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+1),$BP_Gaji);
	//     	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+2),$BP_Insentif);
	//     	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+3),$BP_Honor);
	//     	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+4),$BP_UGD);   			
	//     	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+5),$BP_Partus);
 //   			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+6),$BP_Cuci);
	//        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+7),$BP_Lembur);
	//     	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+8),$BP_THR);
	//     	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+9),$BP_Beli);	
 // 			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+10),$BP_Perjalanan);
	//        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+11),$BP_Konsumsi);
	//        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+12),$jumlah_BP);

	//        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+14),$BO_Administrasi);   			
	//     	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+15),$BO_Dapur);
 //   			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+16),$BO_Laboratorium);
	//        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+17),$BO_Obat);
	//     	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+18),$BO_Mobil);
	//     	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+19),$BO_Listrik);	
 // 			$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+20),$BO_Air);
	//        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+21),$BO_Telepon);
	//     	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+22),$BO_Inventaris);
	//        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+23),$BO_Sarana);
	//        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+24),$jumlah_BO);

	//        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+25),$Png_Lain);

	//        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+27),$Pengeluaran_Total);

	//        	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+29),$Saldo_Kas);
	//     	$this->excel->getActiveSheet()->setCellValue($huruf.($numCell+31),$Pengeluaran_Total);
					
	// 		}		
	// 				$this->excel->getActiveSheet()->setCellValue('I'.($numCell+33),$total_semester);
	// 				$this->excel->getActiveSheet()->setCellValue('B'.($numCell+33),"JUMLAH TOTAL :");
	// 				$this->excel->getActiveSheet()->mergeCells('B'.($numCell+33).':'.'H'.($numCell+33));
	// 				$this->excel->getActiveSheet()->getStyle('B'.($numCell+33).':'.'I'.($numCell+33))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
	// 				$this->excel->getActiveSheet()->getStyle('B'.($numCell+33))->getFont()->setBold(true);	

	// 	         /** Borders for outside border */
	// 	         $BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
	// 	   		$this->excel->getActiveSheet()->getStyle('B5'.':'.'B'.($numCell+33))->applyFromArray($BStyle);
	// 	   		$this->excel->getActiveSheet()->getStyle('C5'.':'.'C'.($numCell+33))->applyFromArray($BStyle);
	// 	   		$this->excel->getActiveSheet()->getStyle('D5'.':'.'D'.($numCell+33))->applyFromArray($BStyle);
	// 	   		$this->excel->getActiveSheet()->getStyle('E5'.':'.'E'.($numCell+33))->applyFromArray($BStyle);
	// 	   		$this->excel->getActiveSheet()->getStyle('F5'.':'.'F'.($numCell+33))->applyFromArray($BStyle);
	// 	   		$this->excel->getActiveSheet()->getStyle('G5'.':'.'G'.($numCell+33))->applyFromArray($BStyle);
	// 	   		$this->excel->getActiveSheet()->getStyle('H5'.':'.'H'.($numCell+33))->applyFromArray($BStyle);
	// 	   		$this->excel->getActiveSheet()->getStyle('I5'.':'.'I'.($numCell+33))->applyFromArray($BStyle);
		   		
	// 	        /** Set wrap Text **/
	// 	   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'I'.($numCell+34)) ->getAlignment()->setWrapText(true); 
	// 	   		/** Borders for heading */
	// 	   		$this->excel->getActiveSheet()->getStyle('B4:I4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


    		
		    	
	// 			$this->excel->getActiveSheet()->getStyle('D'.($numCell+12).':'.'I'.($numCell+12))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
	// 			$this->excel->getActiveSheet()->getStyle('D'.($numCell+24).':'.'I'.($numCell+24))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
	// 			$this->excel->getActiveSheet()->getStyle('D'.($numCell+31).':'.'I'.($numCell+31))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
					
	// 	   		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+33).':'.'C'.($numCell+33));
	// 	   		// $this->excel->getActiveSheet()->mergeCells('F'.($numCell+43).':'.'G'.($numCell+43));
	// 	   		$this->excel->getActiveSheet()->getStyle('D'.($numCell+27).':'.'I'.($numCell+27))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


 //   		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+35), 'RSU AISYIYAH PADANG');
	// 	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+36), 'DIREKTUR');
	// 	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+36), 'KABAG KEUANGAN');
	// 	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+41), 'dr. Hadril Busudin, Sp.S, MHA');
	// 	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+41), 'Bachtar, S.Sos');	
 //   		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+36).':'.'D'.($numCell+36));
 //   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+36).':'.'H'.($numCell+36));
	// 	$this->excel->getActiveSheet()->mergeCells('B'.($numCell+35).':'.'I'.($numCell+35));
	// 	$this->excel->getActiveSheet()->mergeCells('C'.($numCell+41).':'.'D'.($numCell+41));
 //   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+41).':'.'H'.($numCell+41));		
	// 	$this->excel->getActiveSheet()->getStyle('C'.($numCell+36))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// 	$this->excel->getActiveSheet()->getStyle('G'.($numCell+36))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// 	$this->excel->getActiveSheet()->getStyle('C'.($numCell+41))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// 	$this->excel->getActiveSheet()->getStyle('G'.($numCell+41))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// 	$this->excel->getActiveSheet()->getStyle('B'.($numCell+35))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// 	$filename='Rekapitulasi Bulanan'.$tanggal_lengkap.'.xls'; //save our workbook as this file name
	// 	header('Content-Type: application/vnd.ms-excel'); //mime type
	// 	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	// 	header('Cache-Control: max-age=0');
	// 	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

	// 	$objWriter->save('php://output');
	// }

	public function transaksi_bulanan_excel($bulan,$tahun)
	{
		if ($bulan < 10) {
			$bulan = '0'.$bulan;
		}
		// print_r($tanggal_lengkap);
		$tanggal_lengkap= $tahun.'-'.$bulan;
		$tanggal_asli = $bulan.'-'.$tahun;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'LAPORAN BULANAN ('.$bulan.'-'.$tahun.')');
		$this->excel->getActiveSheet()->setCellValue('B2', 'RUMAH SAKIT UMUM AISYIYAH PADANG');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(42);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(17.17);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(42);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(17.17);
		
		

		$this->excel->getActiveSheet()->mergeCells('B1:H1');
		$this->excel->getActiveSheet()->mergeCells('B2:H2');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		


		$this->excel->getActiveSheet()->setCellValue('B4', "NO");
		// $this->excel->getActiveSheet()->mergeCells('B4:B8');
		$this->excel->getActiveSheet()->setCellValue('C4', "URAIAN");
		// $this->excel->getActiveSheet()->mergeCells('C4:C8');
		$this->excel->getActiveSheet()->setCellValue('D4', "KREDIT");
		// $this->excel->getActiveSheet()->mergeCells('D4:D8');
		
		$this->excel->getActiveSheet()->setCellValue('F4', "NO");
		// $this->excel->getActiveSheet()->mergeCells('F4:F8');
		$this->excel->getActiveSheet()->setCellValue('G4', "URAIAN");
		// $this->excel->getActiveSheet()->mergeCells('G4:G8');
		$this->excel->getActiveSheet()->setCellValue('H4', "DEBET");
		// $this->excel->getActiveSheet()->mergeCells('H4:H8');

		
		


		$this->load->model('m_report');
		$data1= $this->m_report->tabel_bln_th_msk($tanggal_lengkap);		
		$data2= $this->m_report->tabel_bln_th_klr($tanggal_lengkap);
		$jumlah_masuk_sementara= $this->m_report->tabel_jumlah_bln_th_msk($tanggal_lengkap);
		$jumlah_keluar_sementara= $this->m_report->tabel_jumlah_bln_th_klr($tanggal_lengkap);
		$jumlah_vk_sementara=$this->m_report->tabel_jumlah_VK($tanggal_lengkap);
		$jumlah_ok_sementara=$this->m_report->tabel_jumlah_OK($tanggal_lengkap);
		$jumlah_rinap_sementara=$this->m_report->tabel_jumlah_rawat_inap($tanggal_lengkap);
		$jumlah_penbpjs_sementara=$this->m_report->tabel_jumlah_bpjs($tanggal_lengkap);
		$jumlah_rjalan_sementara=$this->m_report->tabel_jumlah_rawat_jalan($tanggal_lengkap);
		$jumlah_bp_sementara=$this->m_report->tabel_jumlah_belanja_pegawai($tanggal_lengkap);
		$jumlah_bo_sementara=$this->m_report->tabel_jumlah_belanja_operasional($tanggal_lengkap);

		$jumlah_vip=1;
		$jumlah_Kelas_I=1;
		$jumlah_Kelas_II = 1;
		$jumlah_Kelas_III=1;
		$jumlah_BPJS = 1;
        $no=1;
        $numCell=5;

        $this->excel->getActiveSheet()->setCellValue('B'.$numCell, '1');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+1).':'.'B'.($numCell+4));
		$this->excel->getActiveSheet()->setCellValue('C'.$numCell,'Penerimaan VK');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+1),'a. Persalinan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+2),'b. Perawatan Bayi');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+3),'c. Jasa VK');

		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+5), '2');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+6).':'.'B'.($numCell+10));    	
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+5),'Penerimaan OK');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+6),'a. Jasa OK');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+7),'b. Penerimaan Alat Monitor');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8),'c. Penerimaan Alat Couter');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+9),'d. Penerimaan RR');	
    		
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+11), '3');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+12).':'.'B'.($numCell+31));
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+11),'a. Perawatan');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+12),'1. VIP '.$jumlah_vip.' Orang Rp.XXXXX');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+13),'2. Kelas I '.$jumlah_Kelas_I.' Orang Rp.XXXXX');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+14),'3. Kelas II '.$jumlah_Kelas_II.' Orang Rp.XXXXX');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+15),'4. Kelas III '.$jumlah_Kelas_III.' Orang Rp.XXXXX');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+17),'Pasien BPJS '.$jumlah_BPJS.' Orang');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+18),'b. Persentase dr dari pasien');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+19),'c. Jasa dr u/ RS dari jasa Visite');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+20),'d. Labor Rawat Nginap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+21),'e. Penerimaan HCU');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+22),'f. Transportasi');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+23),'g. Medical Record');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+24),'h. Piutang yang diterima');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+25),'i. Penerimaan Obat - Obat Rawat Inap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+26),'j. Perasat');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+27),'k. Insentif obat rawat inap + rawat jalan');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+28),'l. Jasa Pelayanan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+29),'m. Penerimaan Rotgen');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+30),'n. Penerimaan USG');		
    		
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+32), '4');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+33).':'.'B'.($numCell+39));
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+32),'Penerimaan Rawat Jalan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+33),'a. Labor Rawat Jalan');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+34),'b. EKG Rawat Jalan + Rawat Inap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+35),'c. Karcis IGD Rawat Jalan + Rawat Inap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+36),'d. Jasa Tindakan Rawat Jalan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+37),'e. Penerimaan Obat-Obatan Rawat Jalan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+38),'f. Karcis Rawat Jalan');

    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+40), '5');	
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+40),'Penerimaan Lain-Lain');	

    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+42),'Total Penerimaan');	
    	$this->excel->getActiveSheet()->getStyle('C'.($numCell+42))->getFont()->setBold(true);
    	
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+43),'JUMLAH');
    	$this->excel->getActiveSheet()->getStyle('B'.($numCell+43))->getFont()->setBold(true);		


        $this->excel->getActiveSheet()->setCellValue('F'.$numCell, '1');
		$this->excel->getActiveSheet()->mergeCells('F'.($numCell+1).':'.'F'.($numCell+12));
		$this->excel->getActiveSheet()->setCellValue('G'.$numCell,'Belanja Pegawai');
       	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+1),'a. Gaji Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+2),'b. Insentif Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+3),'c. Honor Dr. Jaga');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+4),'d. Jasa UGD Dr');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+5),'e. Jasa Partus Bidan');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+6),'f. Jasa Cuci Kain OK + Kain Pasien');
       	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+7),'g. Lembur Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+8),'h. THR Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+9),'i. Beli Baju Dinas Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+10),'j. Perjalanan + Pelatihan');	
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+11),'k. Konsumsi Karyawan/Uang Daging');

		$this->excel->getActiveSheet()->setCellValue('F'.($numCell+13), '2');
		$this->excel->getActiveSheet()->mergeCells('F'.($numCell+14).':'.'F'.($numCell+24));
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+13),'Belanja Operasional');
       	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+14),'a. Pengeluaran Administrasi');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+15),'b. Pengeluaran Dapur/Menu Pasien');
       	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+16),'c. Pengeluaran Laboratorium');    	
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+17),'d. Pengeluaran Obat-Obatan');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+18),'e. Pengeluaran Mobil');
       	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+19),'f. Pengeluaran Listrik + Kain Pasien');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+20),'g. Pengeluaran Air');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+21),'h. Pengeluaran Telepon');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+22),'i. Pengeluaran Inventaris');
       	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+23),'j. Pemeliharaan Sarana');
    	
    	$this->excel->getActiveSheet()->setCellValue('F'.($numCell+25), '3');	
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+25),'Pengeluaran Lain-Lain');

    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+27),'Total Pengeluaran');
    	$this->excel->getActiveSheet()->getStyle('G'.($numCell+27))->getFont()->setBold(true);
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+29),'Saldo Pada Kas');

    	$this->excel->getActiveSheet()->setCellValue('F'.($numCell+43),'JUMLAH');
    	$this->excel->getActiveSheet()->getStyle('F'.($numCell+43))->getFont()->setBold(true);	


    	$VK_Persalinan=$VK_Perawatan=$VK_Jasa =$OK_Jasa=$OK_Monitor=$OK_Couter=$OK_RR=$VIP=$Kelas_I=$Kelas_II=$Kelas_III=$BPJS_Persentase=$BPJS_Dr_Visite=$BPJS_Labor=$BPJS_Penerimaan_HCU=$BPJS_Transportasi=$BPJS_Medical=$BPJS_Piutang=$BPJS_Penerimaan_Obat=$BPJS_Perasat=$BPJS_Insentif=$BPJS_Jasa=$BPJS_Penerimaan_Rontgen=$BPJS_Penerimaan_USG=$RJ_Labor=$RJ_EKG=$RJ_Karcis_IGD=$RJ_Jasa_Tindakan=$RJ_Penerimaan_Obat=$RJ_Karcis=$Penerimaan_Lain=$Penerimaan_Total=$jumlah_vk=$jumlah_ok=$jumlah_rinap=$jumlah_rjalan=$jumlah_penbpjs=0;

    	foreach ($jumlah_masuk_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$Penerimaan_Total = 0;
    		}
    		else $Penerimaan_Total = $value['Biaya'];
    	}
    	
    	foreach ($jumlah_vk_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_vk = 0;
    		}
    		else $jumlah_vk = $value['Biaya'];
    	}
    	foreach ($jumlah_ok_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_ok = 0;
    		}
    		else $jumlah_ok = $value['Biaya'];
    	}
    	foreach ($jumlah_rinap_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_rinap = 0;
    		}
    		else $jumlah_rinap = $value['Biaya'];
    	}
    	foreach ($jumlah_penbpjs_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_penbpjs = 0;
    		}
    		else $jumlah_penbpjs = $value['Biaya'];
    	}
    	foreach ($jumlah_rjalan_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_rjalan = 0;
    		}
    		else $jumlah_rjalan = $value['Biaya'];
    	}
    	
    	// print_r($Pengeluaran_Total);
    	foreach($data1 as $key => $value) {
												
									

					if($value['Item_Transaksi'] === 'VK- Persalinan')
					{
						$VK_Persalinan = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'VK- Perawatan Bayi') 
				  	{
				  		$VK_Perawatan = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'VK- Jasa VK')
					{
						$VK_Jasa = $value['Biaya'];
					}
				 
				  
					elseif($value['Item_Transaksi'] === 'OK- Jasa OK') 
					{
						$OK_Jasa = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'OK- Penerimaan Alat Monitor') 
				  	{
				  		$OK_Monitor = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'OK- Penerimaan Alat Couter') 
					{
						$OK_Couter = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'OK- Penerimaan RR') 
					{
						$OK_RR = $value['Biaya'];
					}



					elseif($value['Item_Transaksi'] === 'Rawat Inap - VIP') 
					{
						$VIP = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas I')
				  	{
				  		$Kelas_I = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas II')

					{
						$Kelas_II = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas III')

					{
						$Kelas_III = $value['Biaya'];
					}

					elseif($value['Item_Transaksi'] === 'BPJS - Persentase dr dari pasien') 
					{
						$BPJS_Persentase = $value['Biaya'];
					}

					elseif($value['Item_Transaksi'] === 'BPJS - Jasa dr utk RS dari Jasa Visite') 
					{
						$BPJS_Dr_Visite = $value['Biaya'];
					}

					elseif($value['Item_Transaksi'] === 'BPJS - Labor Rawat Nginap')
				  	{
				  		$BPJS_Labor = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan HCU')
					{
						$BPJS_Penerimaan_HCU = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'BPJS - Transportasi') 
					{
						$BPJS_Transportasi = $value['Biaya'];
					}

					elseif($value['Item_Transaksi'] === 'BPJS - Medical Record')
					{
						$BPJS_Medical = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'BPJS - Piutang yang diterima')
					{
						$BPJS_Piutang = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan Obat - Obat Rawat Inap')
				  	{
				  		$BPJS_Penerimaan_Obat = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'BPJS - Perasat')
					{
						$BPJS_Perasat = $value['Biaya'];
					}										 
				  
					elseif($value['Item_Transaksi'] === 'BPJS - Insentif obat rawat inap + rawat jalan') 
					{
						$BPJS_Insentif = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'BPJS - Jasa Pelayanan') 
				  	{
				  		$BPJS_Jasa = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan Rotgen')
					{
						$BPJS_Penerimaan_Rontgen = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan USG')
					{
						$BPJS_Penerimaan_USG = $value['Biaya'];
					}




					elseif($value['Item_Transaksi'] === 'Rawat Jalan - Labor Rawat Jalan')
					{
						$RJ_Labor = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'Rawat Jalan - EKG Rawat Jalan + Rawat Inap')
				  	{
				  		$RJ_EKG = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'Rawat Jalan - Karcis IGD Rawat Jalan + Rawat Inap')
					{
						$RJ_Karcis_IGD = $value['Biaya'];
					}										 
				  
					elseif($value['Item_Transaksi'] === 'Rawat Jalan - Jasa Tindakan Rawat Jalan') 
					{
						$RJ_Jasa_Tindakan = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'Rawat Jalan - Penerimaan Obat-Obatan Rawat Jalan') 
				  	{
				  		$RJ_Penerimaan_Obat = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'Rawat Jalan - Karcis Rawat Jalan')
					{
						$RJ_Karcis = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'Penerimaan Lain-Lain')
					{
						$Penerimaan_Lain = $value['Biaya'];
					}

			}

			$BP_Gaji=$BP_Insentif=$BP_Honor=$BP_UGD=$BP_Partus=$BP_Cuci=$BP_Lembur=$BP_THR=$BP_Beli=$BP_Perjalanan=$BP_Konsumsi=$BO_Administrasi=$BO_Dapur=$BO_Laboratorium=$BO_Obat=$BO_Mobil=$BO_Listrik=$BO_Air=$BO_Telepon=$BO_Inventaris=$BO_Sarana=$Png_Lain=$Pengeluaran_Total=$Saldo_Kas=$jumlah_BP=$jumlah_BO=0;
		
		foreach ($jumlah_keluar_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$Pengeluaran_Total = 0;
    		}
    		else $Pengeluaran_Total = $value['Biaya'];
    	}
    	foreach ($jumlah_bp_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_BP = 0;
    		}
    		else $jumlah_BP = $value['Biaya'];
    	}
    	foreach ($jumlah_bo_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_BO = 0;
    		}
    		else $jumlah_BO = $value['Biaya'];
    	}
 		// print_r($jumlah_BO);
		foreach($data2 as $key => $value) {
					
			

				if($value['Item_Transaksi'] ==='B.Pegawai - Gaji Karyawan')
				{
					$BP_Gaji = $value['Biaya'];
				}
				elseif($value['Item_Transaksi'] ==='B.Pegawai - Insentif Karyawan') 
			  	{
			  		$BP_Insentif = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Honor Dr. Jaga')
				{
					$BP_Honor = $value['Biaya'];
				}
			 
			  
				elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa UGD Dr') 
				{
					$BP_UGD = $value['Biaya'];
				}
				elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa Partus Bidan') 
			  	{
			  		$BP_Partus = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa Cuci Kain OK + Kain Pasien') 
				{
					$BP_Cuci = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Lembur Karyawan') 
				{
					$BP_Lembur = $value['Biaya'];
				}

				elseif($value['Item_Transaksi'] ==='B.Pegawai - THR Karyawan') 
				{
					$BP_THR = $value['Biaya'];
				}
				elseif($value['Item_Transaksi'] ==='B.Pegawai - Beli Baju Dinas Karyawan')
			  	{
			  		$BP_Beli = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Perjalanan + Pelatihan')

				{
					$BP_Perjalanan = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Konsumsi Karyawan/Uang Daging')

				{
					$BP_Konsumsi = $value['Biaya'];
				}


				elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Administrasi') 
				{
					$BO_Administrasi = $value['Biaya'];
				}

				elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Dapur/Menu Pasien') 
				{
					$BO_Dapur = $value['Biaya'];
				}

				elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Laboratorium')
			  	{
			  		$BO_Laboratorium = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Obat-Obatan')
				{
					$BO_Obat = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Mobil') 
				{
					$BO_Mobil = $value['Biaya'];
				}

				elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Listrik + Kain Pasien')
				{
					$BO_Listrik = $value['Biaya'];
				}
				elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Air')
				{
					$BO_Air = $value['Biaya'];
				}
				elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Telepon')
			  	{
			  		$BO_Telepon = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Inventaris')
				{
					$BO_Inventaris = $value['Biaya'];
				}										 
			  
				elseif($value['Item_Transaksi'] === 'B.Operasional - Pemeliharaan Sarana') 
				{
					$BO_Sarana = $value['Biaya'];
				}

				elseif($value['Item_Transaksi'] === 'Pengeluaran Lain-Lain') 
				{
					$Png_Lain = $value['Biaya'];
				}

			 }	

    	// print_r($data1);
        

			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+1),$VK_Persalinan);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+2),$VK_Perawatan);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+3),$VK_Jasa);
   			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+4),$jumlah_vk);

   			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+6),$OK_Jasa);
	       	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+7),$OK_Monitor);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+8),$OK_Couter);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+9),$OK_RR);	
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+10),$jumlah_ok);

 			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+11),$jumlah_rinap);
			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+12),$VIP);
	       	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+13),$Kelas_I);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+14),$Kelas_II);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+15),$Kelas_III);
	    	// $this->excel->getActiveSheet()->setCellValue('D'.($numCell+17),'Pasien BPJS '.$jumlah_BPJS.' Orang');
			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+18),$BPJS_Persentase);
	       	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+19),$BPJS_Dr_Visite);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+20),$BPJS_Labor);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+21),$BPJS_Penerimaan_HCU);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+22),$BPJS_Transportasi);
	       	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+23),$BPJS_Medical);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+24),$BPJS_Piutang);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+25),$BPJS_Penerimaan_Obat);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+26),$BPJS_Perasat);
	       	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+27),$BPJS_Insentif);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+28),$BPJS_Jasa);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+29),$BPJS_Penerimaan_Rontgen);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+30),$BPJS_Penerimaan_USG);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+31),$jumlah_penbpjs);

	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+33),$RJ_Labor);
	       	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+34),$RJ_EKG);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+35),$RJ_Karcis_IGD);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+36),$RJ_Jasa_Tindakan);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+37),$RJ_Penerimaan_Obat);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+38),$RJ_Karcis);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+39),$jumlah_rjalan);

	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+40),$Penerimaan_Lain);	

	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+42),$Penerimaan_Total);
        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+43),$Penerimaan_Total);
			

	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+1),$BP_Gaji);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+2),$BP_Insentif);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+3),$BP_Honor);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+4),$BP_UGD);   			
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+5),$BP_Partus);
   			$this->excel->getActiveSheet()->setCellValue('H'.($numCell+6),$BP_Cuci);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+7),$BP_Lembur);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+8),$BP_THR);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+9),$BP_Beli);	
 			$this->excel->getActiveSheet()->setCellValue('H'.($numCell+10),$BP_Perjalanan);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+11),$BP_Konsumsi);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+12),$jumlah_BP);

	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+14),$BO_Administrasi);   			
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+15),$BO_Dapur);
   			$this->excel->getActiveSheet()->setCellValue('H'.($numCell+16),$BO_Laboratorium);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+17),$BO_Obat);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+18),$BO_Mobil);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+19),$BO_Listrik);	
 			$this->excel->getActiveSheet()->setCellValue('H'.($numCell+20),$BO_Air);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+21),$BO_Telepon);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+22),$BO_Inventaris);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+23),$BO_Sarana);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+24),$jumlah_BO);

	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+25),$Png_Lain);

	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+27),$Pengeluaran_Total);

	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+29),$Saldo_Kas);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+43),$Pengeluaran_Total);



         /** Borders for outside border */
         $BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
   		$this->excel->getActiveSheet()->getStyle('B5'.':'.'B'.($numCell+42))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('C5'.':'.'C'.($numCell+42))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('D5'.':'.'D'.($numCell+42))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('E5'.':'.'E'.($numCell+42))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('F5'.':'.'F'.($numCell+42))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('G5'.':'.'G'.($numCell+42))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('H5'.':'.'H'.($numCell+42))->applyFromArray($BStyle);
   		
        /** Set wrap Text **/
   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'H'.($numCell+43)) ->getAlignment()->setWrapText(true); 
   		/** Borders for heading */
   		$this->excel->getActiveSheet()->getStyle('B4:H4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


		$this->excel->getActiveSheet()->getStyle('D'.($numCell+4))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
		$this->excel->getActiveSheet()->getStyle('D'.($numCell+10))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
		$this->excel->getActiveSheet()->getStyle('D'.($numCell+31))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
		$this->excel->getActiveSheet()->getStyle('D'.($numCell+39))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
		$this->excel->getActiveSheet()->getStyle('H'.($numCell+12))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
		$this->excel->getActiveSheet()->getStyle('H'.($numCell+24))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;

		
   		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+43).':'.'C'.($numCell+43));
   		$this->excel->getActiveSheet()->mergeCells('F'.($numCell+43).':'.'G'.($numCell+43));
   		$this->excel->getActiveSheet()->getStyle('B'.($numCell+43).':'.'H'.($numCell+43))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


   		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+46), 'RSU AISYIYAH PADANG');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+47), 'DIREKTUR');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+47), 'KABAG KEUANGAN');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+52), 'dr. Hadril Busudin, Sp.S, MHA');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+52), 'Bachtar, S.Sos');	
   		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+47).':'.'D'.($numCell+47));
   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+47).':'.'H'.($numCell+47));
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+46).':'.'H'.($numCell+46));
		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+52).':'.'D'.($numCell+52));
   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+52).':'.'H'.($numCell+52));		
		$this->excel->getActiveSheet()->getStyle('C'.($numCell+47))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G'.($numCell+47))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C'.($numCell+52))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G'.($numCell+52))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B'.($numCell+46))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$filename='Laporan Bulanan'.$tanggal_lengkap.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}

	public function rekapitulasi_transaksi_bulanan_excel123($bulan,$tahun)
	{
		if ($bulan < 10) {
			$bulan = '0'.$bulan;
		}
		// print_r($tanggal_lengkap);
		$tanggal_lengkap= $tahun.'-'.$bulan;
		$tanggal_asli = $bulan.'-'.$tahun;
		$tanggal_saldo = ($bulan-1).'-'.$tahun;

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'LAPORAN S/D BULANAN ('.$bulan.'-'.$tahun.')');
		$this->excel->getActiveSheet()->setCellValue('B2', 'RUMAH SAKIT UMUM AISYIYAH PADANG');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(42);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(17.17);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(42);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(17.17);
		
		

		$this->excel->getActiveSheet()->mergeCells('B1:H1');
		$this->excel->getActiveSheet()->mergeCells('B2:H2');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		


		$this->excel->getActiveSheet()->setCellValue('B4', "NO");
		// $this->excel->getActiveSheet()->mergeCells('B4:B8');
		$this->excel->getActiveSheet()->setCellValue('C4', "URAIAN");
		// $this->excel->getActiveSheet()->mergeCells('C4:C8');
		$this->excel->getActiveSheet()->setCellValue('D4', "DEBET");
		// $this->excel->getActiveSheet()->mergeCells('D4:D8');
		
		$this->excel->getActiveSheet()->setCellValue('F4', "NO");
		// $this->excel->getActiveSheet()->mergeCells('F4:F8');
		$this->excel->getActiveSheet()->setCellValue('G4', "URAIAN");
		// $this->excel->getActiveSheet()->mergeCells('G4:G8');
		$this->excel->getActiveSheet()->setCellValue('H4', "KREDIT");
		// $this->excel->getActiveSheet()->mergeCells('H4:H8');

		
		


		$this->load->model('m_report');
		$data1= $this->m_report->tabel_bln_th_msk($tanggal_lengkap);		
		$data2= $this->m_report->tabel_bln_th_klr($tanggal_lengkap);
		$jumlah_masuk_sementara= $this->m_report->tabel_jumlah_bln_th_msk($tanggal_lengkap);
		$jumlah_keluar_sementara= $this->m_report->tabel_jumlah_bln_th_klr($tanggal_lengkap);
		$jumlah_vk_sementara=$this->m_report->tabel_jumlah_VK($tanggal_lengkap);
		$jumlah_ok_sementara=$this->m_report->tabel_jumlah_OK($tanggal_lengkap);
		$jumlah_rinap_sementara=$this->m_report->tabel_jumlah_rawat_inap($tanggal_lengkap);
		$jumlah_penbpjs_sementara=$this->m_report->tabel_jumlah_bpjs($tanggal_lengkap);
		$jumlah_rjalan_sementara=$this->m_report->tabel_jumlah_rawat_jalan($tanggal_lengkap);
		$jumlah_bp_sementara=$this->m_report->tabel_jumlah_belanja_pegawai($tanggal_lengkap);
		$jumlah_bo_sementara=$this->m_report->tabel_jumlah_belanja_operasional($tanggal_lengkap);

		$jumlah_vip=1;
		$jumlah_Kelas_I=1;
		$jumlah_Kelas_II = 1;
		$jumlah_Kelas_III=1;
		$jumlah_BPJS = 1;
        $no=1;
        $numCell=5;

        $this->excel->getActiveSheet()->setCellValue('C'.$numCell,'Saldo Lebih Sampai Bulan '.$tanggal_saldo);	


        $numCell=6;	
        $this->excel->getActiveSheet()->setCellValue('B'.$numCell, '1');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+1).':'.'B'.($numCell+4));
		$this->excel->getActiveSheet()->setCellValue('C'.$numCell,'Penerimaan VK');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+1),'a. Persalinan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+2),'b. Perawatan Bayi');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+3),'c. Jasa VK');

		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+5), '2');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+6).':'.'B'.($numCell+10));    	
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+5),'Penerimaan OK');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+6),'a. Jasa OK');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+7),'b. Penerimaan Alat Monitor');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8),'c. Penerimaan Alat Couter');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+9),'d. Penerimaan RR');	
    		
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+11), '3');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+12).':'.'B'.($numCell+31));
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+11),'a. Perawatan');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+12),'1. VIP '.$jumlah_vip.' Orang Rp.XXXXX');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+13),'2. Kelas I '.$jumlah_Kelas_I.' Orang Rp.XXXXX');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+14),'3. Kelas II '.$jumlah_Kelas_II.' Orang Rp.XXXXX');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+15),'4. Kelas III '.$jumlah_Kelas_III.' Orang Rp.XXXXX');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+17),'Pasien BPJS '.$jumlah_BPJS.' Orang');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+18),'b. Persentase dr dari pasien');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+19),'c. Jasa dr u/ RS dari jasa Visite');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+20),'d. Labor Rawat Nginap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+21),'e. Penerimaan HCU');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+22),'f. Transportasi');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+23),'g. Medical Record');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+24),'h. Piutang yang diterima');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+25),'i. Penerimaan Obat - Obat Rawat Inap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+26),'j. Perasat');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+27),'k. Insentif obat rawat inap + rawat jalan');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+28),'l. Jasa Pelayanan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+29),'m. Penerimaan Rotgen');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+30),'n. Penerimaan USG');		
    		
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+32), '4');
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+33).':'.'B'.($numCell+39));
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+32),'Penerimaan Rawat Jalan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+33),'a. Labor Rawat Jalan');
       	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+34),'b. EKG Rawat Jalan + Rawat Inap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+35),'c. Karcis IGD Rawat Jalan + Rawat Inap');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+36),'d. Jasa Tindakan Rawat Jalan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+37),'e. Penerimaan Obat-Obatan Rawat Jalan');
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+38),'f. Karcis Rawat Jalan');

    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+40), '5');	
    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+40),'Penerimaan Lain-Lain');	

    	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+42),'Total Penerimaan');	
    	$this->excel->getActiveSheet()->getStyle('C'.($numCell+42))->getFont()->setBold(true);
    	
    	$this->excel->getActiveSheet()->setCellValue('B'.($numCell+43),'JUMLAH');
    	$this->excel->getActiveSheet()->getStyle('B'.($numCell+43))->getFont()->setBold(true);		


        $this->excel->getActiveSheet()->setCellValue('F'.$numCell, '1');
		$this->excel->getActiveSheet()->mergeCells('F'.($numCell+1).':'.'F'.($numCell+12));
		$this->excel->getActiveSheet()->setCellValue('G'.$numCell,'Belanja Pegawai');
       	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+1),'a. Gaji Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+2),'b. Insentif Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+3),'c. Honor Dr. Jaga');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+4),'d. Jasa UGD Dr');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+5),'e. Jasa Partus Bidan');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+6),'f. Jasa Cuci Kain OK + Kain Pasien');
       	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+7),'g. Lembur Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+8),'h. THR Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+9),'i. Beli Baju Dinas Karyawan');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+10),'j. Perjalanan + Pelatihan');	
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+11),'k. Konsumsi Karyawan/Uang Daging');

		$this->excel->getActiveSheet()->setCellValue('F'.($numCell+13), '2');
		$this->excel->getActiveSheet()->mergeCells('F'.($numCell+14).':'.'F'.($numCell+24));
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+13),'Belanja Operasional');
       	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+14),'a. Pengeluaran Administrasi');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+15),'b. Pengeluaran Dapur/Menu Pasien');
       	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+16),'c. Pengeluaran Laboratorium');    	
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+17),'d. Pengeluaran Obat-Obatan');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+18),'e. Pengeluaran Mobil');
       	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+19),'f. Pengeluaran Listrik + Kain Pasien');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+20),'g. Pengeluaran Air');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+21),'h. Pengeluaran Telepon');
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+22),'i. Pengeluaran Inventaris');
       	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+23),'j. Pemeliharaan Sarana');
    	
    	$this->excel->getActiveSheet()->setCellValue('F'.($numCell+25), '3');	
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+25),'Pengeluaran Lain-Lain');

    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+27),'Total Pengeluaran');
    	$this->excel->getActiveSheet()->getStyle('G'.($numCell+27))->getFont()->setBold(true);
    	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+29),'Saldo Pada Kas');

    	$this->excel->getActiveSheet()->setCellValue('F'.($numCell+43),'JUMLAH');
    	$this->excel->getActiveSheet()->getStyle('F'.($numCell+43))->getFont()->setBold(true);	


    	$VK_Persalinan=$VK_Perawatan=$VK_Jasa =$OK_Jasa=$OK_Monitor=$OK_Couter=$OK_RR=$VIP=$Kelas_I=$Kelas_II=$Kelas_III=$BPJS_Persentase=$BPJS_Dr_Visite=$BPJS_Labor=$BPJS_Penerimaan_HCU=$BPJS_Transportasi=$BPJS_Medical=$BPJS_Piutang=$BPJS_Penerimaan_Obat=$BPJS_Perasat=$BPJS_Insentif=$BPJS_Jasa=$BPJS_Penerimaan_Rontgen=$BPJS_Penerimaan_USG=$RJ_Labor=$RJ_EKG=$RJ_Karcis_IGD=$RJ_Jasa_Tindakan=$RJ_Penerimaan_Obat=$RJ_Karcis=$Penerimaan_Lain=$Penerimaan_Total=$jumlah_vk=$jumlah_ok=$jumlah_rinap=$jumlah_rjalan=$jumlah_penbpjs=0;

    	foreach ($jumlah_masuk_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$Penerimaan_Total = 0;
    		}
    		else $Penerimaan_Total = $value['Biaya'];
    	}
    	
    	foreach ($jumlah_vk_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_vk = 0;
    		}
    		else $jumlah_vk = $value['Biaya'];
    	}
    	foreach ($jumlah_ok_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_ok = 0;
    		}
    		else $jumlah_ok = $value['Biaya'];
    	}
    	foreach ($jumlah_rinap_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_rinap = 0;
    		}
    		else $jumlah_rinap = $value['Biaya'];
    	}
    	foreach ($jumlah_penbpjs_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_penbpjs = 0;
    		}
    		else $jumlah_penbpjs = $value['Biaya'];
    	}
    	foreach ($jumlah_rjalan_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_rjalan = 0;
    		}
    		else $jumlah_rjalan = $value['Biaya'];
    	}
    	
    	// print_r($Pengeluaran_Total);
    	foreach($data1 as $key => $value) {
												
									

					if($value['Item_Transaksi'] === 'VK- Persalinan')
					{
						$VK_Persalinan = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'VK- Perawatan Bayi') 
				  	{
				  		$VK_Perawatan = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'VK- Jasa VK')
					{
						$VK_Jasa = $value['Biaya'];
					}
				 
				  
					elseif($value['Item_Transaksi'] === 'OK- Jasa OK') 
					{
						$OK_Jasa = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'OK- Penerimaan Alat Monitor') 
				  	{
				  		$OK_Monitor = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'OK- Penerimaan Alat Couter') 
					{
						$OK_Couter = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'OK- Penerimaan RR') 
					{
						$OK_RR = $value['Biaya'];
					}



					elseif($value['Item_Transaksi'] === 'Rawat Inap - VIP') 
					{
						$VIP = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas I')
				  	{
				  		$Kelas_I = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas II')

					{
						$Kelas_II = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas III')

					{
						$Kelas_III = $value['Biaya'];
					}

					elseif($value['Item_Transaksi'] === 'BPJS - Persentase dr dari pasien') 
					{
						$BPJS_Persentase = $value['Biaya'];
					}

					elseif($value['Item_Transaksi'] === 'BPJS - Jasa dr utk RS dari Jasa Visite') 
					{
						$BPJS_Dr_Visite = $value['Biaya'];
					}

					elseif($value['Item_Transaksi'] === 'BPJS - Labor Rawat Nginap')
				  	{
				  		$BPJS_Labor = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan HCU')
					{
						$BPJS_Penerimaan_HCU = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'BPJS - Transportasi') 
					{
						$BPJS_Transportasi = $value['Biaya'];
					}

					elseif($value['Item_Transaksi'] === 'BPJS - Medical Record')
					{
						$BPJS_Medical = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'BPJS - Piutang yang diterima')
					{
						$BPJS_Piutang = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan Obat - Obat Rawat Inap')
				  	{
				  		$BPJS_Penerimaan_Obat = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'BPJS - Perasat')
					{
						$BPJS_Perasat = $value['Biaya'];
					}										 
				  
					elseif($value['Item_Transaksi'] === 'BPJS - Insentif obat rawat inap + rawat jalan') 
					{
						$BPJS_Insentif = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'BPJS - Jasa Pelayanan') 
				  	{
				  		$BPJS_Jasa = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan Rotgen')
					{
						$BPJS_Penerimaan_Rontgen = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan USG')
					{
						$BPJS_Penerimaan_USG = $value['Biaya'];
					}




					elseif($value['Item_Transaksi'] === 'Rawat Jalan - Labor Rawat Jalan')
					{
						$RJ_Labor = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'Rawat Jalan - EKG Rawat Jalan + Rawat Inap')
				  	{
				  		$RJ_EKG = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'Rawat Jalan - Karcis IGD Rawat Jalan + Rawat Inap')
					{
						$RJ_Karcis_IGD = $value['Biaya'];
					}										 
				  
					elseif($value['Item_Transaksi'] === 'Rawat Jalan - Jasa Tindakan Rawat Jalan') 
					{
						$RJ_Jasa_Tindakan = $value['Biaya'];
					}
					elseif($value['Item_Transaksi'] === 'Rawat Jalan - Penerimaan Obat-Obatan Rawat Jalan') 
				  	{
				  		$RJ_Penerimaan_Obat = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'Rawat Jalan - Karcis Rawat Jalan')
					{
						$RJ_Karcis = $value['Biaya'];
					}
				 
				  	elseif($value['Item_Transaksi'] === 'Penerimaan Lain-Lain')
					{
						$Penerimaan_Lain = $value['Biaya'];
					}

			}

			$BP_Gaji=$BP_Insentif=$BP_Honor=$BP_UGD=$BP_Partus=$BP_Cuci=$BP_Lembur=$BP_THR=$BP_Beli=$BP_Perjalanan=$BP_Konsumsi=$BO_Administrasi=$BO_Dapur=$BO_Laboratorium=$BO_Obat=$BO_Mobil=$BO_Listrik=$BO_Air=$BO_Telepon=$BO_Inventaris=$BO_Sarana=$Png_Lain=$Pengeluaran_Total=$Saldo_Kas=$jumlah_BP=$jumlah_BO=0;
		
		foreach ($jumlah_keluar_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$Pengeluaran_Total = 0;
    		}
    		else $Pengeluaran_Total = $value['Biaya'];
    	}
    	foreach ($jumlah_bp_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_BP = 0;
    		}
    		else $jumlah_BP = $value['Biaya'];
    	}
    	foreach ($jumlah_bo_sementara as $key => $value) {
    		if ($value['Biaya'] == '') {
    			$jumlah_BO = 0;
    		}
    		else $jumlah_BO = $value['Biaya'];
    	}
 		// print_r($jumlah_BO);
		foreach($data2 as $key => $value) {
					
			

				if($value['Item_Transaksi'] ==='B.Pegawai - Gaji Karyawan')
				{
					$BP_Gaji = $value['Biaya'];
				}
				elseif($value['Item_Transaksi'] ==='B.Pegawai - Insentif Karyawan') 
			  	{
			  		$BP_Insentif = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Honor Dr. Jaga')
				{
					$BP_Honor = $value['Biaya'];
				}
			 
			  
				elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa UGD Dr') 
				{
					$BP_UGD = $value['Biaya'];
				}
				elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa Partus Bidan') 
			  	{
			  		$BP_Partus = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Jasa Cuci Kain OK + Kain Pasien') 
				{
					$BP_Cuci = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Lembur Karyawan') 
				{
					$BP_Lembur = $value['Biaya'];
				}

				elseif($value['Item_Transaksi'] ==='B.Pegawai - THR Karyawan') 
				{
					$BP_THR = $value['Biaya'];
				}
				elseif($value['Item_Transaksi'] ==='B.Pegawai - Beli Baju Dinas Karyawan')
			  	{
			  		$BP_Beli = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Perjalanan + Pelatihan')

				{
					$BP_Perjalanan = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] ==='B.Pegawai - Konsumsi Karyawan/Uang Daging')

				{
					$BP_Konsumsi = $value['Biaya'];
				}


				elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Administrasi') 
				{
					$BO_Administrasi = $value['Biaya'];
				}

				elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Dapur/Menu Pasien') 
				{
					$BO_Dapur = $value['Biaya'];
				}

				elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Laboratorium')
			  	{
			  		$BO_Laboratorium = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Obat-Obatan')
				{
					$BO_Obat = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Mobil') 
				{
					$BO_Mobil = $value['Biaya'];
				}

				elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Listrik + Kain Pasien')
				{
					$BO_Listrik = $value['Biaya'];
				}
				elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Air')
				{
					$BO_Air = $value['Biaya'];
				}
				elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Telepon')
			  	{
			  		$BO_Telepon = $value['Biaya'];
				}
			 
			  	elseif($value['Item_Transaksi'] === 'B.Operasional - Pengeluaran Inventaris')
				{
					$BO_Inventaris = $value['Biaya'];
				}										 
			  
				elseif($value['Item_Transaksi'] === 'B.Operasional - Pemeliharaan Sarana') 
				{
					$BO_Sarana = $value['Biaya'];
				}

				elseif($value['Item_Transaksi'] === 'Pengeluaran Lain-Lain') 
				{
					$Png_Lain = $value['Biaya'];
				}

			 }	

    	// print_r($data1);
        

			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+1),$VK_Persalinan);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+2),$VK_Perawatan);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+3),$VK_Jasa);
   			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+4),$jumlah_vk);

   			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+6),$OK_Jasa);
	       	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+7),$OK_Monitor);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+8),$OK_Couter);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+9),$OK_RR);	
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+10),$jumlah_ok);

 			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+11),$jumlah_rinap);
			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+12),$VIP);
	       	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+13),$Kelas_I);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+14),$Kelas_II);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+15),$Kelas_III);
	    	// $this->excel->getActiveSheet()->setCellValue('D'.($numCell+17),'Pasien BPJS '.$jumlah_BPJS.' Orang');
			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+18),$BPJS_Persentase);
	       	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+19),$BPJS_Dr_Visite);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+20),$BPJS_Labor);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+21),$BPJS_Penerimaan_HCU);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+22),$BPJS_Transportasi);
	       	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+23),$BPJS_Medical);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+24),$BPJS_Piutang);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+25),$BPJS_Penerimaan_Obat);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+26),$BPJS_Perasat);
	       	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+27),$BPJS_Insentif);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+28),$BPJS_Jasa);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+29),$BPJS_Penerimaan_Rontgen);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+30),$BPJS_Penerimaan_USG);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+31),$jumlah_penbpjs);

	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+33),$RJ_Labor);
	       	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+34),$RJ_EKG);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+35),$RJ_Karcis_IGD);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+36),$RJ_Jasa_Tindakan);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+37),$RJ_Penerimaan_Obat);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+38),$RJ_Karcis);
	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+39),$jumlah_rjalan);

	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+40),$Penerimaan_Lain);	

	    	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+42),$Penerimaan_Total);
        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+43),$Penerimaan_Total);
			

	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+1),$BP_Gaji);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+2),$BP_Insentif);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+3),$BP_Honor);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+4),$BP_UGD);   			
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+5),$BP_Partus);
   			$this->excel->getActiveSheet()->setCellValue('H'.($numCell+6),$BP_Cuci);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+7),$BP_Lembur);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+8),$BP_THR);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+9),$BP_Beli);	
 			$this->excel->getActiveSheet()->setCellValue('H'.($numCell+10),$BP_Perjalanan);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+11),$BP_Konsumsi);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+12),$jumlah_BP);

	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+14),$BO_Administrasi);   			
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+15),$BO_Dapur);
   			$this->excel->getActiveSheet()->setCellValue('H'.($numCell+16),$BO_Laboratorium);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+17),$BO_Obat);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+18),$BO_Mobil);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+19),$BO_Listrik);	
 			$this->excel->getActiveSheet()->setCellValue('H'.($numCell+20),$BO_Air);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+21),$BO_Telepon);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+22),$BO_Inventaris);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+23),$BO_Sarana);
	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+24),$jumlah_BO);

	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+25),$Png_Lain);

	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+27),$Pengeluaran_Total);

	       	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+29),$Saldo_Kas);
	    	$this->excel->getActiveSheet()->setCellValue('H'.($numCell+43),$Pengeluaran_Total);



         /** Borders for outside border */
         $BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
   		$this->excel->getActiveSheet()->getStyle('B5'.':'.'B'.($numCell+42))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('C5'.':'.'C'.($numCell+42))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('D5'.':'.'D'.($numCell+42))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('E5'.':'.'E'.($numCell+42))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('F5'.':'.'F'.($numCell+42))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('G5'.':'.'G'.($numCell+42))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('H5'.':'.'H'.($numCell+42))->applyFromArray($BStyle);
   		
        /** Set wrap Text **/
   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'H'.($numCell+43)) ->getAlignment()->setWrapText(true); 
   		/** Borders for heading */
   		$this->excel->getActiveSheet()->getStyle('B4:H4')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


		$this->excel->getActiveSheet()->getStyle('D'.($numCell+4))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
		$this->excel->getActiveSheet()->getStyle('D'.($numCell+10))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
		$this->excel->getActiveSheet()->getStyle('D'.($numCell+31))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
		$this->excel->getActiveSheet()->getStyle('D'.($numCell+39))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
		$this->excel->getActiveSheet()->getStyle('H'.($numCell+12))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;
		$this->excel->getActiveSheet()->getStyle('H'.($numCell+24))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);;

		
   		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+43).':'.'C'.($numCell+43));
   		$this->excel->getActiveSheet()->mergeCells('F'.($numCell+43).':'.'G'.($numCell+43));
   		$this->excel->getActiveSheet()->getStyle('B'.($numCell+43).':'.'H'.($numCell+43))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


   		$this->excel->getActiveSheet()->setCellValue('B'.($numCell+46), 'RSU AISYIYAH PADANG');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+47), 'DIREKTUR');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+47), 'KABAG KEUANGAN');
		$this->excel->getActiveSheet()->setCellValue('C'.($numCell+52), 'dr. Hadril Busudin, Sp.S, MHA');
		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+52), 'Bachtar, S.Sos');	
   		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+47).':'.'D'.($numCell+47));
   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+47).':'.'H'.($numCell+47));
		$this->excel->getActiveSheet()->mergeCells('B'.($numCell+46).':'.'H'.($numCell+46));
		$this->excel->getActiveSheet()->mergeCells('C'.($numCell+52).':'.'D'.($numCell+52));
   		$this->excel->getActiveSheet()->mergeCells('G'.($numCell+52).':'.'H'.($numCell+52));		
		$this->excel->getActiveSheet()->getStyle('C'.($numCell+47))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G'.($numCell+47))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C'.($numCell+52))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G'.($numCell+52))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B'.($numCell+46))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$filename='Rekapitulasi Bulanan'.$tanggal_lengkap.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}
	

	public function transaksi_harian_excel($tanggal,$bulan,$tahun)
	{
		if ($bulan < 10) {
			$bulan = '0'.$bulan;
		}
		if ($tanggal < 10) {
			$tanggal = '0'.$tanggal;
		}
		$tanggal_lengkap= $tahun.'-'.$bulan.'-'.$tanggal;
		$tanggal_asli = $tanggal.'-'.$bulan.'-'.$tahun;
		// print_r($tanggal_lengkap);

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'LAPORAN TRANSAKSI HARIAN');
		$this->excel->getActiveSheet()->setCellValue('B3', 'RUMAH SAKIT UMUM AISYIYAH PADANG');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25.17);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(9.60);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(2);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(7);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(25.17);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(9.60);
		

		$this->excel->getActiveSheet()->mergeCells('B1:J2');
		$this->excel->getActiveSheet()->mergeCells('B3:J4');
		//$this->excel->getActiveSheet()->mergeCells('B1:B2');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('B7', "Nomor");
		$this->excel->getActiveSheet()->mergeCells('B7:B8');
		$this->excel->getActiveSheet()->setCellValue('C7', "Jenis Transaksi");
		$this->excel->getActiveSheet()->mergeCells('C7:C8');
		$this->excel->getActiveSheet()->getStyle('C7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('D7', "Uraian");
		$this->excel->getActiveSheet()->mergeCells('D7:D8');		
		$this->excel->getActiveSheet()->setCellValue('E7', "Biaya");
		$this->excel->getActiveSheet()->mergeCells('E7:E8');
		$this->excel->getActiveSheet()->getStyle('E7')->getAlignment()->setWrapText(true);

		// $this->excel->getActiveSheet()->setCellValue('F7', "Nama Lokasi");
		// $this->excel->getActiveSheet()->mergeCells('F7:F9');
		// $this->excel->getActiveSheet()->getStyle('F7')->getAlignment()->setWrapText(true);

		$this->excel->getActiveSheet()->setCellValue('G7', "Nomor");
		$this->excel->getActiveSheet()->mergeCells('G7:G8');
		$this->excel->getActiveSheet()->getStyle('G7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('H7', "Jenis Transaksi");
		$this->excel->getActiveSheet()->mergeCells('H7:H8');
		$this->excel->getActiveSheet()->getStyle('H7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('I7', "Uraian");
		$this->excel->getActiveSheet()->mergeCells('I7:I8');
		$this->excel->getActiveSheet()->getStyle('I7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('J7', "Biaya");
		$this->excel->getActiveSheet()->mergeCells('J7:J8');
		$this->excel->getActiveSheet()->getStyle('J7')->getAlignment()->setWrapText(true);
		
		
		$this->excel->getActiveSheet()->setCellValue('D5', ":".$tanggal_asli);
		$this->excel->getActiveSheet()->setCellValue('B5', "Tanggal Transaksi");
		$this->excel->getActiveSheet()->setCellValue('B6', "Transaksi Masuk");
		$this->excel->getActiveSheet()->setCellValue('G6', "Transaksi Keluar");
		$this->excel->getActiveSheet()->getStyle('B6')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('G6')->getFont()->setBold(true);
		 $this->excel->getActiveSheet()->mergeCells('B5:C5');
		$this->excel->getActiveSheet()->mergeCells('B6:C6');
		$this->excel->getActiveSheet()->mergeCells('G6:H6');
		
		
		$this->load->model('m_report');
		$data= $this->m_report->tabel_harian_masuk($tanggal_lengkap);
		$data1= $this->m_report->tabel_harian_keluar($tanggal_lengkap);
        $no=1;
        $numCell=$numCell1=$numCell2=9;		
        foreach ($data as $i) {
        	
        		$this->excel->getActiveSheet()->setCellValue('B'.$numCell1, $i['No_Transaksi']);
	        	$this->excel->getActiveSheet()->setCellValue('C'.$numCell1, $i['Item_Transaksi']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.$numCell1, $i['Uraian']);
	        	$this->excel->getActiveSheet()->setCellValue('E'.$numCell1, $i['Biaya']);
	        	$numCell1++;
        }
        foreach ($data1 as $j) {	
        	// $this->excel->getActiveSheet()->setCellValue('F'.$numCell, $i['nama_lokasi']);
        	$this->excel->getActiveSheet()->setCellValue('G'.$numCell2, $j['No_Transaksi']);
        	$this->excel->getActiveSheet()->setCellValue('H'.$numCell2, $j['Item_Transaksi']);
        	$this->excel->getActiveSheet()->setCellValue('I'.$numCell2, $j['Uraian']);
        	$this->excel->getActiveSheet()->setCellValue('J'.$numCell2, $j['Biaya']);
        		$numCell2++;
        	
        }
        if ($numCell1>$numCell2) {
        	$numCell = $numCell1;
        }
        else $numCell=$numCell2;        	

        $BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));

   		/** Borders for outside border */
   		$this->excel->getActiveSheet()->getStyle('B9'.':'.'B'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('C9'.':'.'C'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('D9'.':'.'D'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('E9'.':'.'E'.($numCell))->applyFromArray($BStyle);
   		// $this->excel->getActiveSheet()->getStyle('F9'.':'.'F'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('G9'.':'.'G'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('H9'.':'.'H'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('I9'.':'.'I'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('J9'.':'.'J'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'J'.($numCell)) ->getAlignment()->setWrapText(true);
   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'J'.($numCell)) ->getAlignment()->setWrapText(true);

   		$this->excel->getActiveSheet()->getStyle('B7:E8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
   		$this->excel->getActiveSheet()->getStyle('G7:J8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
   		$this->excel->getActiveSheet()->getStyle('A7'.':'.'J7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      	// print_r($tanggal_lengkap);
   		
		$filename='Laporan Harian_Tanggal'.$tanggal_lengkap.'.xls';
		 header('Content-Type: application/vnd.ms-excel'); //mime type
		 header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		 header('Cache-Control: max-age=0');
		 $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		 $objWriter->save('php://output');
	}
	

	
	
	
	
}