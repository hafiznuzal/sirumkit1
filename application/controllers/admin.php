<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Admin extends CI_Controller
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
	public function create_dummy($tahun,$triwulan,$jumlah)
	{
		$this->load->model('type_model');
		$this->type_model->create_dummy($tahun,$triwulan,$jumlah);
		echo "string";
	}
	public function index()
	{
		if($this->session->userdata('logged_in')){
			$this->load->model('m_report');
			$bulan = date('m');
			$tahun = date('Y');
			$hari = date('d');
			if ($bulan < 10) {
				$tanggal_lengkap = $tahun."-0".$bulan;
				$tanggal_hari_ini = $tahun."-0".$bulan."-".$hari;
			}
			else $tanggal_lengkap = $tahun."-".$bulan;
			$tanggal_hari_ini = $tahun."-".$bulan."-".$hari;

			$hasil_masuk_thn = $this->m_report->tabel_jumlah_bln_th_msk($tahun);
			$hasil_keluar_thn = $this->m_report->tabel_jumlah_bln_th_klr($tahun);
			$hasil_masuk_bln = $this->m_report->tabel_jumlah_bln_th_msk($tanggal_lengkap);
			$hasil_keluar_bln = $this->m_report->tabel_jumlah_bln_th_klr($tanggal_lengkap);
			$hasil_masuk_hri = $this->m_report->tabel_jumlah_bln_th_msk($tanggal_hari_ini);
			$hasil_keluar_hri= $this->m_report->tabel_jumlah_bln_th_klr($tanggal_hari_ini);
			// echo $data['jumlah_pengembang'][0]->jumlah_pengembang;
			
			$data['masuk_thn']=$hasil_masuk_thn[0]['Biaya'];
			$data['keluar_thn']=$hasil_keluar_thn[0]['Biaya'];
			$data['masuk_bln']=$hasil_masuk_bln[0]['Biaya'];
			$data['keluar_bln']=$hasil_keluar_bln[0]['Biaya'];
			$data['masuk_hri']=$hasil_masuk_hri[0]['Biaya'];
			$data['keluar_hri']=$hasil_keluar_hri[0]['Biaya'];
			// print_r($data);
			// exit();
			$this->load->view('template/admin_header',$this->sesi);
			$this->load->view('admin/admin_home',$data);
			$this->load->view('template/admin_footer');
		}
		else redirect(base_url()."/");
	}
	
	
	public function logout() {
     	//remove all session data
     	$this->session->unset_userdata('logged_in');
     	$this->session->sess_destroy();
     	redirect(base_url()."login");
     }
	
	public function pasien()
	{
		if($this->session->userdata('logged_in')){
			$bulan = date('m');
			$tahun = date('Y');
			$hari = date('d');


			// $data['daftar_perumahan'] = $this->perumahan_model->get_all();
			// $data['daftar_lokasi'] = $this->perumahan_model->get_all_dummy();
			// $data['daftar_pengembang'] = $this->perumahan_model->get_pengembang_dummy();
			if($this->input->method()=='post'){
				$uraian = $this->input->post('uraian');
				$item = $this->input->post('item');
				$jenis = $this->input->post('jenis');
				$biaya = $this->input->post('biaya');
				
				$this->load->model('m_report');

				if ($this->input->post('jenis') == 1) {
					$id_trans=$this->m_report->id_max_masuk($tahun, $bulan);
					print_r($id_trans);
					
					$id_trans=$id_trans[0]['Id'];
				
					++$id_trans;
					
				}
				else
				{
					$id_trans=$this->m_report->id_max_keluar($tahun, $bulan);					
					$id_trans=$id_trans[0]['Id'];
					++$id_trans;
				}



				$id = $this->m_report->id_max();
				$id=$id[0]['Id'];
				++$id;
				$tanggal = date("Y-m-d");
				$this->m_report->insert_transaksi($id,$id_trans,$item,$uraian,$biaya,$tanggal,$jenis);
				

				print_r($id);
			}
			if($this->input->method()=='get')
			{
				$this->load->view('template/admin_header',$this->sesi);
				$this->load->view('form-transaksi');
				$this->load->view('template/admin_footer');
				$datatrans=$this->input->get('form-transaksi');
				print_r($datatrans);
			}
		}
		else redirect(base_url()."/");
	}

	public function transaksi_kuitansi()
	{
		if($this->session->userdata('logged_in')){
			$bulan = date('m');
			$tahun = date('Y');
			$hari = date('d');


			// $data['daftar_perumahan'] = $this->perumahan_model->get_all();
			// $data['daftar_lokasi'] = $this->perumahan_model->get_all_dummy();
			// $data['daftar_pengembang'] = $this->perumahan_model->get_pengembang_dummy();
			if($this->input->method()=='post'){
				$uraian = $this->input->post('uraian');
				$item = $this->input->post('item');
				$jenis = $this->input->post('jenis');
				$biaya = $this->input->post('biaya');
				
				$this->load->model('m_report');

				if ($this->input->post('jenis') == 1) {
					$id_trans=$this->m_report->id_max_masuk($tahun, $bulan);
					print_r($id_trans);
					// if ($id_trans == 'NULL') {
					// 	$id_trans = 0;
					// }

					$id_trans=$id_trans[0]['Id'];
				
					++$id_trans;
					
				}
				else
				{
					$id_trans=$this->m_report->id_max_keluar($tahun, $bulan);					
					$id_trans=$id_trans[0]['Id'];
					++$id_trans;
				}


				if ($id_trans < 10) {
					$id_trans_temp = "000{$id_trans}";
				}
				elseif ($id_trans < 100 && $id_trans > 10) {
					$id_trans_temp = "00{$id_trans}";
				}
				elseif ($id_trans < 1000 && $id_trans > 100) {
					$id_trans_temp = "0{$id_trans}";
				}
				else $id_trans_temp = $id_trans;

				$id = "{$jenis}{$hari}{$bulan}{$tahun}{$id_trans_temp}";
				$tanggal = date("Y-m-d");
				$this->m_report->insert_transaksi($id,$id_trans,$item,$uraian,$biaya,$tanggal,$jenis);
				

				print_r($id);
			}
			if($this->input->method()=='get')
			{
				$this->load->view('template/admin_header',$this->sesi);
				$this->load->view('form-transaksi');
				$this->load->view('template/admin_footer');
				$datatrans=$this->input->get('form-transaksi');
				print_r($datatrans);
			}
		}
		else redirect(base_url()."/");
	}



	public function edit_transaksi($jenisopt)
	{
		if($this->session->userdata('logged_in'))
		{
			// $jenispt=$jenisopt;

			$this->load->view('template/admin_header',$this->sesi);
			$tanggal_lengkap = date("Y-m-d");
			$this->load->model('m_report');

			if($this->input->method()=='post'){
				$edit_item = $this->input->post("edit_item");
				// echo json_encode($edit_item);
				// exit();
				$this->load->model('m_report');
				foreach ($edit_item as $key => $value) {
					$temp_biaya = $value['biaya'];
					$temp_transaksi = $value['transaksi'];
					$temp_uraian = $value['uraian'];
					$temp_jenis = $value['jenis'];
					$temp_id = $value['id'];
					// echo json_encode($temp_id);
					// exit();
					$this->m_report->edit_transksi($temp_id,$temp_jenis,$temp_transaksi,$temp_uraian,$temp_biaya);
					// exit();
				}
				// $this->edit_transksi($jenispt);

			}
			if($this->input->method()=='get')
			{
				if ($jenisopt == 1) {
					$data['hasil'] = $this->m_report->tabel_harian_masuk($tanggal_lengkap);
				}
	        	else $data['hasil'] = $this->m_report->tabel_harian_keluar($tanggal_lengkap);	        	
				$data['jenis']=$jenisopt;
				$this->load->view('edit-transaksi',$data);
				$this->load->view('template/admin_footer');
			}

			


		}
		
		else redirect(base_url('login'));
	}

	public function cashier($jenisopt)
	{
		if($this->session->userdata('logged_in'))
		{

			$this->load->view('template/admin_header',$this->sesi);
			$tanggal_lengkap = date("Y-m-d");
			$this->load->model('m_report');
			$bulan = date('m');
			$tahun = date('Y');
			$hari = date('d');

			if($this->input->method()=='post'){
				$cashier = $this->input->post("cashier");
				// echo json_encode($cashier);
				// exit();
				
				$this->load->model('m_report');
				
				$id_kuitansi=$this->m_report->id_max_kuitansi();
				$id_kuitansi=$id_kuitansi[0]['Id'];
				if ($id_kuitansi == 0) {
					$id_kuitansi = 1;
				}
				
				++$id_kuitansi;
				
				// echo json_encode($id_kuitansi);
				// 	exit();

				foreach ($cashier as $key => $value) {
					$id_trans=$this->m_report->id_max_masuk($tahun,$bulan);
					$id_trans=$id_trans[0]['Id'];
					++$id_trans;

					$id = $this->m_report->id_max();
					$id=$id[0]['Id'];
					++$id;
					$tanggal = date("Y-m-d");
					$jenis = 1;
					// echo json_encode($id_kuitansi);
					// exit();
					$temp_biaya = $value['biaya'];
					$temp_transaksi = $value['transaksi'];
					$temp_uraian = $value['uraian'];
					
					$this->m_report->insert_transaksi_berkuitansi($id,$id_kuitansi,$id_trans,$temp_transaksi,$temp_uraian,$temp_biaya,$tanggal,$jenis);
					
				}
				
				// print_r($id);
			}


			if($this->input->method()=='get')
			{
				if ($jenisopt == 1) {
					$data['hasil'] = $this->m_report->tabel_harian_masuk($tanggal_lengkap);
				}
	        	else $data['hasil'] = $this->m_report->tabel_harian_keluar($tanggal_lengkap);
	        	// $this->load->view('/admin/laporan_harian',$data);
				// $data['tanggal_s']=$tanggal;
				// $data['bulan_s']=$bulan;
				// $data['tahun_s']=$tahun;
				$data['jenis']=$jenisopt;
				// print_r($data1);
				$this->load->view('cashier',$data);
				$this->load->view('template/admin_footer');
			}


		}
		
		else redirect(base_url('login'));
	}
	

	public function edit_detail($id)
	{
		if($this->session->userdata('logged_in')){
			$bulan = date('m');
			$tahun = date('Y');
			$hari = date('d');


			// $data['daftar_perumahan'] = $this->perumahan_model->get_all();
			// $data['daftar_lokasi'] = $this->perumahan_model->get_all_dummy();
			// $data['daftar_pengembang'] = $this->perumahan_model->get_pengembang_dummy();
			if($this->input->method()=='post'){
				$uraian = $this->input->post('uraian');
				$item = $this->input->post('item');
				$jenis = $this->input->post('jenis');
				$biaya = $this->input->post('biaya');
				
				$this->load->model('m_report');

				if ($this->input->post('jenis') == 1) {
					$id_trans=$this->m_report->id_max_masuk($tahun, $bulan);
					print_r($id_trans);
					// if ($id_trans == 'NULL') {
					// 	$id_trans = 0;
					// }

					$id_trans=$id_trans[0]['Id'];
				
					++$id_trans;
					
				}
				else
				{
					$id_trans=$this->m_report->id_max_keluar($tahun, $bulan);					
					$id_trans=$id_trans[0]['Id'];
					++$id_trans;
				}


				

				$id = "{$jenis}{$hari}{$bulan}{$tahun}{$id_trans_temp}";
				$tanggal = date("Y-m-d");
				$this->m_report->insert_transaksi($id,$id_trans,$item,$uraian,$biaya,$tanggal,$jenis);
				

				print_r($id);
			}
			if($this->input->method()=='get')
			{
				$this->load->view('template/admin_header',$this->sesi);
				$this->load->view('form-transaksi');
				$this->load->view('template/admin_footer');
				$datatrans=$this->input->get('form-transaksi');
				print_r($datatrans);
			}
		}
		else redirect(base_url()."/");
	}	


	
}