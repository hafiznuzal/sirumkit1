<?php
class keuangan_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function insert_transaksi($id,$nama,$urai,$tgl,$jns)
	{
		$sql = "insert into transaksi(Id_Transaksi,Nama_Transaksi,Uraian,Tanggal,Jenis)
				values('".$id."','".$nama."','".$urai."','".$thn."','".$jns."')";
		$query = $this->db->query($sql);
		// $data = $query->result_array();
		// return $data;
	}

	public function get_transaksi_harian($tgl,$bulan,$tahun)
	{
		$sql = "SELECT id_kecamatan, nama_kecamatan from kecamatan";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;	
	}

	public function delete($ID)
	{
		$sql = "";
		$query = $this->db->query($sql);
	}

	public function add($nama, $longitude, $latitude, $id_kecamatan)
	{
		$sql = "INSERT INTO lokasi (nama_lokasi,longitude,latitude,id_kecamatan) VALUES ('$nama', $longitude, $latitude, $id_kecamatan)";
		$query = $this->db->query($sql);
	}

	public function edit($ID, $nama, $longitude, $latitude, $id_kecamatan)
	{
		$sql = "UPDATE lokasi SET nama_lokasi='$nama', longitude=$longitude, latitude=$latitude, id_kecamatan=$id_kecamatan WHERE id_lokasi=$ID";
		$query = $this->db->query($sql);
	}
}
?>