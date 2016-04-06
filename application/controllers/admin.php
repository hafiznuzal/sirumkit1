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
			

			// echo $data['jumlah_pengembang'][0]->jumlah_pengembang;
			$this->load->view('template/admin_header',$this->sesi);
			$this->load->view('admin/admin_home');
			$this->load->view('template/admin_footer');
		}
		else redirect(base_url()."/admin/login");
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
			$bulan = getdate()['month'];
			$tahun = getdate()['year'];


			// $data['daftar_perumahan'] = $this->perumahan_model->get_all();
			// $data['daftar_lokasi'] = $this->perumahan_model->get_all_dummy();
			// $data['daftar_pengembang'] = $this->perumahan_model->get_pengembang_dummy();
			if($this->input->method()=='post'){
				// $uraian = $this->input->post('uraian');
				// $item = $this->input->post('item');
				// $jenis = $this->input->post('Jenis');
				$this->load->model('m_report');

				if ($this->input->post('jenis') === 1) {
					$id_trans=$this->m_report->id_max_masuk($tahun, $bulan);
					$id_trans++;
					
				}
				else
				{
					$id_trans=$this->m_report->id_max_keluar($tahun, $bulan);
				}

				print_r($this->input->post());
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
		else redirect(base_url()."/admin/login");
	}

	
	public function report_lahan()
	{
		$this->load->model('proyek_model');
        $data['lokasi'] = $this->proyek_model->get_data_lokasi_all();
        $this->load->view('/admin/admin_report_lahan',$data);
	}

	
}