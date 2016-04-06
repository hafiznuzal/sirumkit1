<?php
class m_report extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function id_max_masuk($tahun, $bulan)
	{
		$sql = "SELECT MAX(No_Transaksi)
				FROM transaksi
				WHERE Jenis = 1 AND tanggal LIKE '".$tahun."-".$bulan."'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function id_max_keluar($tahun, $bulan)
	{
		$sql = "SELECT MAX(No_Transaksi)
				FROM transaksi
				WHERE Jenis = 2 AND tanggal LIKE '".$tahun."-".$bulan."'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	

	public function tabel_harian_masuk($tanggal)
	{
		$sql = "SELECT *
				FROM transaksi as transaksi
				WHERE Tanggal = '$tanggal' AND Jenis = 1";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_harian_keluar($tanggal)
	{
		$sql = "SELECT *
				FROM transaksi as transaksi
				WHERE Tanggal = '$tanggal' AND Jenis = 2";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}


	public function tabel_harian_jumlah_masuk($tanggal)
	{
		$sql = "SELECT SUM(Biaya) as Biaya_Masuk
				FROM transaksi as transaksi
				WHERE Jenis = 1 and Tanggal = '$tanggal'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_harian_jumlah_keluar($tanggal)
	{
		$sql = "SELECT SUM(Biaya) as Biaya_Keluar
				FROM transaksi as transaksi
				WHERE Jenis = 2 and Tanggal = '$tanggal'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	

	public function tabel_bln_thn_jumlah_masuk($tanggal)
	{
		$sql = "SELECT SUM(Biaya) as Biaya_Masuk
				FROM transaksi as transaksi
				WHERE Jenis = 1 and Tanggal LIKE '".$tanggal."%'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}	

	public function tabel_bln_thn_jumlah_keluar($tanggal)
	{
		$sql = "SELECT SUM(Biaya) as Biaya_Keluar
				FROM transaksi as transaksi
				WHERE Jenis = 2 and Tanggal LIKE '".$tanggal."%'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}




	public function tabel_bulanan($tanggal)
	{
		$sql = "SELECT SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO
				FROM PEMBANGUNAN
				WHERE PEMBANGUNAN.TAHUN = '$tahun'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_statistik2_realisasi($tahun)
	{
		$sql = "SELECT SUM( REAL_RSS ) AS REAL_RSS, SUM( REAL_RS ) AS REAL_RS, SUM( REAL_RM ) AS REAL_RM, SUM( REAL_MW ) AS REAL_MW, SUM( REAL_RUKO ) AS REAL_RUKO
				FROM PEMBANGUNAN
				WHERE PEMBANGUNAN.TAHUN = '$tahun'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_report_kecamatan_value($id,$tahun,$periode)//BUTUH ID
	{
		$sql = "SELECT NAMA_PERUSAHAAN, PIMPINAN, ALAMAT, TELP, FAX,NAMA_LOKASI AS LOKASI, RENC_RSS,RENC_RS,RENC_RM,RENC_MW,RENC_RUKO,REAL_RSS,REAL_RS,REAL_RM,REAL_MW,REAL_RUKO,PEM.CATATAN AS CATATAN
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE KEC.ID_KECAMATAN = '$id' AND PEM.TAHUN = '$tahun' AND PEM.TRIWULAN = '$periode'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	public function kecamatan_get_all()
	{
		$sql = "SELECT id_kecamatan,nama_kecamatan
				FROM KECAMATAN";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	public function get_kecamatan($id)
	{
		$sql = "SELECT NAMA_KECAMATAN
				FROM KECAMATAN
				WHERE KECAMATAN.ID_KECAMATAN='$id'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function jumlah_kecamatan()
	{
		$sql = "SELECT COUNT( ID_KECAMATAN ) AS JUMLAH
				FROM KECAMATAN";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_pembangunan_kecamatan_all($tahun,$periode)
	{
		$sql = "SELECT NAMA_KECAMATAN, COUNT( NAMA_LOKASI ) AS JML_LOKASI, SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO, SUM( REAL_RSS ) AS REAL_RSS, SUM( REAL_RS ) AS REAL_RS, SUM( REAL_RM ) AS REAL_RM, SUM( REAL_MW ) AS REAL_MW, SUM( REAL_RUKO ) AS REAL_RUKO, PEM.CATATAN AS CATATAN
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE PEM.TAHUN = '$tahun' AND PEM.TRIWULAN = '$periode'
				GROUP BY KEC.ID_KECAMATAN" ;
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	public function tabel_pembangunan_kecamatan_pertahun_all($tahun)
	{
		$sql = "SELECT NAMA_KECAMATAN,  NAMA_PERUMAHAN,NAMA_PERUSAHAAN,NAMA_LOKASI,RENC_RSS,  RENC_RS,  RENC_RM,  RENC_MW,  RENC_RUKO, REAL_RSS,  REAL_RS,  REAL_RM,  REAL_MW,  REAL_RUKO,CATATAN
 FROM (SELECT RENC_RSS,  RENC_RS,  RENC_RM,  RENC_MW,  RENC_RUKO, REAL_RSS,  REAL_RS,  REAL_RM,  REAL_MW,  REAL_RUKO,ID_LOKASI,ID_PERUMAHAN ,CATATAN	FROM PEMBANGUNAN WHERE TAHUN = '$tahun') AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN" ;
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function pembangunan_kecamatan_jml_lokasiprm($id_kecamatan)
	{
		$sql = "SELECT COUNT( DISTINCT (LOK.ID_LOKASI) ) AS JML_LOKASI
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE KEC.ID_KECAMATAN = ".$id_kecamatan."
				AND PEM.TAHUN = '2014'
				AND PEM.TRIWULAN = '1'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	public function tabel_jumlah_pem_kec($tahun,$periode)
	{
		$sql = "SELECT SUM( JML_LOKASI ) AS JML_LOKASI, SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO, SUM( REAL_RSS ) AS REAL_RSS, SUM( REAL_RS ) AS REAL_RS, SUM( REAL_RM ) AS REAL_RM, SUM( REAL_MW ) AS REAL_MW, SUM( REAL_RUKO ) AS REAL_RUKO
				FROM (

				SELECT COUNT( NAMA_LOKASI ) AS JML_LOKASI, SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO, SUM( REAL_RSS ) AS REAL_RSS, SUM( REAL_RS ) AS REAL_RS, SUM( REAL_RM ) AS REAL_RM, SUM( REAL_MW ) AS REAL_MW, SUM( REAL_RUKO ) AS REAL_RUKO
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE PEM.TAHUN = '$tahun' AND PEM.TRIWULAN = '$periode'
				GROUP BY KEC.ID_KECAMATAN
				) AS TBL";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_pembangunan_kecamatan_all_statistic($tahun)
	{
		$sql = "SELECT SUM(JML_LOKASI) AS JML_LOKASI, SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO, SUM( REAL_RSS ) AS REAL_RSS, SUM( REAL_RS ) AS REAL_RS, SUM( REAL_RM ) AS REAL_RM, SUM( REAL_MW ) AS REAL_MW, SUM( REAL_RUKO ) AS REAL_RUKO
				FROM
				(
				SELECT COUNT( NAMA_LOKASI ) AS JML_LOKASI, SUM( RENC_RSS ) AS RENC_RSS, SUM( RENC_RS ) AS RENC_RS, SUM( RENC_RM ) AS RENC_RM, SUM( RENC_MW ) AS RENC_MW, SUM( RENC_RUKO ) AS RENC_RUKO, SUM( REAL_RSS ) AS REAL_RSS, SUM( REAL_RS ) AS REAL_RS, SUM( REAL_RM ) AS REAL_RM, SUM( REAL_MW ) AS REAL_MW, SUM( REAL_RUKO ) AS REAL_RUKO
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE PEM.TAHUN = '$tahun'
			
				GROUP BY KEC.ID_KECAMATAN) AS TBL";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_lahan_kecamatan_all($id_kecamatan,$tahun,$periode)
	{
		$sql = "SELECT NAMA_KECAMATAN,COUNT(NAMA_LOKASI) AS JML_IJIN_LOKASI, SUM(LUAS) AS LUAS, SUM(RENCANA_TAPAK) AS RENCANA_TAPAK, SUM(PEMBEBASAN) AS PEMBEBASAN, SUM(TERBANGUN) AS TERBANGUN, SUM(BELUM_TERBANGUN) AS BELUM_TERBANGUN, SUM(FS_DIALOKASIKAN) AS DIALOKASIKAN,SUM(FS_PEMBEBASAN) AS PEMBEBASAN,SUM(FS_SUDAH_DIMATANGKAN) AS DIMATANGKAN 
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE KEC.ID_KECAMATAN = ".$id_kecamatan." AND PEM.TAHUN = ".$tahun." AND PEM.TRIWULAN = ".$periode."";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_lahan_kecamatan_all_statistic($tahun)
	{
		$sql = "SELECT SUM(JML_PENGEMBANG) AS JML_PENGEMBANG, SUM(JML_IJIN_LOKASI) AS JML_IJIN_LOKASI, SUM(LUAS) AS LUAS, SUM(RENCANA_TAPAK) AS RENCANA_TAPAK, SUM(PEMBEBASAN) AS PEMBEBASAN, SUM(TERBANGUN) AS TERBANGUN, SUM(BELUM_TERBANGUN) AS BELUM_TERBANGUN
				FROM(
				SELECT COUNT(DISTINCT(PRS.NAMA_PERUSAHAAN))AS JML_PENGEMBANG,COUNT(NAMA_LOKASI) AS JML_IJIN_LOKASI, SUM(LUAS) AS LUAS, SUM(RENCANA_TAPAK) AS RENCANA_TAPAK, SUM(PEMBEBASAN) AS PEMBEBASAN, SUM(TERBANGUN) AS TERBANGUN, SUM(BELUM_TERBANGUN) AS BELUM_TERBANGUN, SUM(FS_DIALOKASIKAN) AS DIALOKASIKAN,SUM(FS_PEMBEBASAN) AS FS_PEMBEBASAN,SUM(FS_SUDAH_DIMATANGKAN) AS DIMATANGKAN 
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				WHERE  PEM.TAHUN = '$tahun'
				GROUP BY KEC.ID_KECAMATAN) AS TBLI";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	
	public function aktif_dalam_pembangunan($id_kecamatan,$tahun,$periode)
	{
		$sql = "SELECT COUNT( AKTIF_DLM_PEMBANGUNAN ) AS AKTIF_DLM_PEMBANGUNAN
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE KEC.ID_KECAMATAN = ".$id_kecamatan."
				AND PEM.TAHUN = ".$tahun."
				AND PEM.TRIWULAN = ".$periode."
				AND AKTIF_DLM_PEMBANGUNAN = 'V'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	public function aktif_berhenti($id_kecamatan,$tahun,$periode)
	{
		$sql = "SELECT COUNT( AKTIF_BERHENTI ) AS AKTIF_BERHENTI
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE KEC.ID_KECAMATAN = ".$id_kecamatan."
				AND PEM.TAHUN = ".$tahun."
				AND PEM.TRIWULAN = ".$periode."
				AND AKTIF_BERHENTI = 'V'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function aktif_sdh_selesai($id_kecamatan,$tahun,$periode)
	{
		$sql = "SELECT COUNT( AKTIF_SDH_SELESAI ) AS AKTIF_SDH_SELESAI
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE KEC.ID_KECAMATAN = ".$id_kecamatan."
				AND PEM.TAHUN = ".$tahun."
				AND PEM.TRIWULAN = ".$periode."
				AND AKTIF_SDH_SELESAI = 'V'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tidak_aktif($id_kecamatan,$tahun,$periode)
	{
		$sql = "SELECT COUNT( TIDAK_AKTIF ) AS TIDAK_AKTIF
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				WHERE KEC.ID_KECAMATAN = ".$id_kecamatan."
				AND PEM.TAHUN = ".$tahun."
				AND PEM.TRIWULAN = ".$periode."
				AND TIDAK_AKTIF = 'V'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function lahan_perkecamatan_value($id,$tahun,$periode)//BUTUH ID
	{
		$sql = "SELECT NAMA_PERUSAHAAN, PIMPINAN, ALAMAT, TELP, FAX, NAMA_LOKASI,LOKASI_TGL, LUAS, RENCANA_TAPAK, PEMBEBASAN, TERBANGUN, BELUM_TERBANGUN, FS_DIALOKASIKAN AS DIALOKASIKAN, FS_PEMBEBASAN AS PEMBEBASAN, FS_SUDAH_DIMATANGKAN AS SUDAH_DIMATANGKAN, IJIN.CATATAN AS CATATAN, AKTIF_DLM_PEMBANGUNAN, AKTIF_BERHENTI, AKTIF_SDH_SELESAI, TIDAK_AKTIF
				FROM PEMBANGUNAN AS PEM
				JOIN LOKASI AS LOK ON PEM.ID_LOKASI = LOK.ID_LOKASI
				JOIN PERUMAHAN AS PRM ON PEM.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN IJIN ON IJIN.ID_PERUMAHAN = PRM.ID_PERUMAHAN
				JOIN KECAMATAN AS KEC ON KEC.ID_KECAMATAN = LOK.ID_KECAMATAN
				JOIN PERUSAHAAN AS PRS ON PRS.ID_PERUSAHAAN = PRM.ID_PERUSAHAAN
				WHERE KEC.ID_KECAMATAN = '$id'
				AND PEM.TAHUN = '$tahun'
				AND PEM.TRIWULAN = '$periode'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}


	public function report_chart()
	{
		$sql = "SELECT COUNT(ID_PEMBANGUNAN) AS JML_LOKASI,TRIWULAN,TAHUN
				FROM PEMBANGUNAN AS PEM
				GROUP BY CONCAT(PEM.TRIWULAN,'_',PEM.TAHUN) ORDER BY TAHUN,TRIWULAN";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	/**public function jumlah_pembangunan()
	{
		$sql = "SELECT COUNT(*) AS jumlah_pembangunan FROM pembangunan";
		$query = $this->db->query($sql);
		$data = $query->result();
		return $data;
	}**/
}
?>
