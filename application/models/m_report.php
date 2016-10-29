<?php
class m_report extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function id_max_masuk($tahun, $bulan)
	{
		$sql = "SELECT MAX(No_Transaksi) as Id
				FROM transaksi
				WHERE Jenis = 1 AND tanggal LIKE '".$tahun."-".$bulan."%'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function id_max_keluar($tahun, $bulan)
	{
		$sql = "SELECT MAX(No_Transaksi) as Id
				FROM transaksi
				WHERE Jenis = 2 AND tanggal LIKE '".$tahun."-".$bulan."%'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function id_max()
	{
		$sql = "SELECT MAX(Id_Transaksi) as Id
				FROM transaksi";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	public function id_max_kuitansi()
	{
		$sql = "SELECT MAX(Id_Kuitansi) as Id
				FROM transaksi";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	
	public function jumlah_transaksi_masuk_perhari($tanggal)
	{
		$sql = "SELECT COUNT(Id_Transaksi) as Jumlah_Id
				FROM transaksi
				WHERE Tanggal = '$tanggal' AND Jenis = 1";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function jumlah_transaksi_keluar_perhari($tanggal)
	{
		$sql = "SELECT COUNT(Id_Transaksi) as Jumlah_Id
				FROM transaksi
				WHERE Tanggal = '$tanggal' AND Jenis = 2";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}


	public function tabel_harian_masuk($tanggal)
	{
		$sql = "SELECT *
				FROM transaksi as transaksi
				WHERE Tanggal = '$tanggal' AND Jenis = 1
				ORDER BY no_transaksi";
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
	

	public function tabel_bln_msk_VK_Persalinan($tanggal)
	{
		$sql = "SELECT SUM(Biaya) as Biaya_VK_Persalinan
				FROM transaksi as transaksi
				WHERE Jenis = 1 and Item_Transaksi='VK- Persalinan' and Tanggal LIKE '".$tanggal."%'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_bln_th_msk($tanggal)
	{
		$sql = "SELECT Item_Transaksi,SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 1 and Tanggal like '".$tanggal."%'
				GROUP BY Item_Transaksi";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_bln_th_klr($tanggal)
	{
		$sql = "SELECT Item_Transaksi,SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 2 and Tanggal like '".$tanggal."%'
				GROUP BY Item_Transaksi";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_jumlah_bln_th_msk($tanggal)
	{
		$sql = "SELECT SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 1 and Tanggal like '".$tanggal."%'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_jumlah_bln_th_klr($tanggal)
	{
		$sql = "SELECT SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 2 and Tanggal like '".$tanggal."%'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_jumlah_VK($tanggal)
	{
		$sql = "SELECT SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 1 and Item_Transaksi like 'VK-%' and Tanggal like '".$tanggal."%' 
				";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_jumlah_OK($tanggal)
	{
		$sql = "SELECT SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 1 and Item_Transaksi like 'OK-%' and Tanggal like '".$tanggal."%' 
				";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_jumlah_rawat_inap($tanggal)
	{
		$sql = "SELECT SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 1 and Item_Transaksi like 'Rawat Inap -%' and Tanggal like '".$tanggal."%' 
				";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_jumlah_bpjs($tanggal)
	{
		$sql = "SELECT SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 1 and Item_Transaksi like 'BPJS -%' and Tanggal like '".$tanggal."%' 
				";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_jumlah_rawat_jalan($tanggal)
	{
		$sql = "SELECT SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 1 and Item_Transaksi like 'Rawat Jalan -%' and Tanggal like '".$tanggal."%' 
				";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_jumlah_belanja_pegawai($tanggal)
	{
		$sql = "SELECT SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 2 and Item_Transaksi like 'B.Pegawai -%' and Tanggal like '".$tanggal."%' 
				";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_jumlah_belanja_operasional($tanggal)
	{
		$sql = "SELECT SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 2 and Item_Transaksi like 'B.Operasional -%' and Tanggal like '".$tanggal."%' 
				";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}	


	

	public function insert_transaksi($id,$nomor_transaksi,$item_transaksi,$uraian,$biaya,$tanggal,$jenis)
	{
		$sql = "INSERT INTO Transaksi (Id_Transaksi,No_Transaksi,Item_Transaksi,Uraian,Biaya,Tanggal,Jenis)
				VALUES ($id,$nomor_transaksi,'$item_transaksi','$uraian',$biaya,'$tanggal',$jenis)";
		$query = $this->db->query($sql);
		// $data = $query->result_array();
		// return $data;
	}

	public function insert_transaksi_berkuitansi($id,$id_kuitansi,$nomor_transaksi,$item_transaksi,$uraian,$biaya,$tanggal,$jenis)
	{
		$sql = "INSERT INTO Transaksi (Id_Transaksi,Id_Kuitansi,No_Transaksi,Item_Transaksi,Uraian,Biaya,Tanggal,Jenis)
				VALUES ($id,$id_kuitansi,$nomor_transaksi,'$item_transaksi','$uraian',$biaya,'$tanggal',$jenis)";
		$query = $this->db->query($sql);
		// $data = $query->result_array();
		// return $data;
	}

	public function tabel_bln_lainlain_th_msk($tanggal)
	{
		$sql = "SELECT Uraian,SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 1 and Item_Transaksi like 'Penerimaan Lain-Lain' and Tanggal like '".$tanggal."%'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function tabel_bln_lainlain_th_klr($tanggal)
	{
		$sql = "SELECT Uraian,SUM(Biaya) AS Biaya 
				FROM Transaksi
				WHERE Jenis = 2 and Item_Transaksi like 'Pengeluaran Lain-Lain' and Tanggal like '".$tanggal."%'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	public function jumlah_lainlain_masuk_perhari($tanggal)
	{

		$sql = "SELECT COUNT(Id_Transaksi) as Jumlah_Id, SUM(Biaya) as Jumlah_Biaya

				FROM transaksi
				WHERE Jenis = 1 and Item_Transaksi like 'Penerimaan Lain-Lain' and Tanggal like '".$tanggal."%'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	public function jumlah_lainlain_keluar_perhari($tanggal)
	{

		$sql = "SELECT COUNT(Id_Transaksi) as Jumlah_Id, SUM(Biaya) as Jumlah_Biaya
				FROM transaksi
				WHERE Jenis = 2 and Item_Transaksi like 'Pengeluaran Lain-Lain' and Tanggal like '".$tanggal."%'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function edit_transksi($id,$jenis,$item,$uraian,$biaya)
	{

		$sql = "UPDATE transaksi
				SET Item_Transaksi='$item',Uraian='$uraian',Biaya=$biaya,Jenis=$jenis
				WHERE Id_Transaksi=$id";
		$query = $this->db->query($sql);
		
	}

	
}
?>
