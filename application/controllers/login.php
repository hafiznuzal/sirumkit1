<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');

        $this->load->library('session');
		
		
		if ($this->session->userdata('logged_in')) {
			$session_data=$this->session->userdata('logged_in');
			$this->sesi['tahun']=getdate()['year'];
			$this->sesi['bulan']=getdate()['mon'];
			$this->sesi['hari']=getdate()['weekday'];
			$this->sesi['tanggal']=getdate()['mday'];
			
		}
		else{
			$this->sesi['tahun']=getdate()['year'];
			$this->sesi['bulan']=getdate()['mon'];
			$this->sesi['hari']=getdate()['weekday'];
			$this->sesi['tanggal']=getdate()['mday'];

		}

		
	}
	public function index()
	{
		$login['loginStat']=$this->input->get('login');
		$this->load->view('template/admin_header_login',$this->sesi);
		$this->load->view('login',$login);
	}

}