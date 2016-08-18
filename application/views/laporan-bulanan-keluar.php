=<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12" style="color:#446CB3">
				   <h1 class="page-header">Laporan Bulanan</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class ="row">
				<div class ="col-lg-11">

					<div id="addSuccess" class="alert alert-success" style="display:none";>
						<a href="#" class="close" data-dismiss="alert" >&times;</a>
						<strong>Berhasil!</strong> Data telah berhasil ditambahkan
					</div>
					 <div id="delSuccess" class="alert alert-success"style="display:none";>
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Berhasil!</strong> Data telah berhasil dihapus
					</div>
					 <div id="editSuccess" class="alert alert-success"style="display:none";>
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Berhasil!</strong> Data telah berhasil disunting
					</div>
					<!-- /.success notification-->

					<div class ="panel panel-primary">
						<div class="panel-heading">

							<i class="fa fa-list"></i> Laporan Bulanan Keluar
						</div>
				
						
							
						
						<div class="panel-body">
							<div class="form-group panel-default">
								<div class="row">
									<div class="col-md-2"> 
									<label>Jenis Transaksi:</label> 
									<select class="form-control form-inline" id="jenisOpt" name="JenisTransaksi">
										<?php if ($jenis == 1) {?>
											<option disabled selected value="1">Masuk</option>
											<option value="2">Keluar</option>
										<?php }
										if ($jenis == 2) { ?>
										 	<option disabled selected value="2">Keluar</option>
											<option value="1">Masuk</option>
										<?php } ?>  

									    
									</select>
									</div>	

								

									<div class="col-md-2"> 
									<label>Bulan:</label> 
									<select class="form-control form-inline" id="bulanOpt" name="bulan">
									 	<option disabled selected><?php echo $bulan_s; ?></option>
									 	<?php  for ($i=1; $i <=$bulan ; $i++) { ?>

									    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									    <?php } ?>	
									</select>
									</div>				


									<div class="col-md-2">
									<label>Tahun:</label> 
									<select class="form-control form-inline" id="tahunOpt" name="tahun">
									 	<option disabled selected><?php echo $tahun_s; ?></option>
									 	<?php  for ($i=2015; $i <=$tahun ; $i++) { ?>

									    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									    <?php } ?>	
									</select>
									</div> 

									
									<div class="col-md-3 pull-right"> 
										<br>
										
										<a href="#" class="pull-right" id="excelPemDownload">Laporan Bulanan <img src="<?php  echo base_url('assets/img/excel.png')?>"></a>
										<a href="#" class="pull-right" id="excelPemDownloadRekap">Rekapitulasi Bulanan <img src="<?php  echo base_url('assets/img/excel.png')?>"></a>
										<!-- <br>
										<a href="#" class="pull-right" id="pdfPemDownload">Download PDF <img src="<?php  echo base_url('assets/img/pdf.png')?>"></a> -->


									</div>
								</div>
									<?php $BP_Gaji=$BP_Insentif=$BP_Honor=$BP_UGD=$BP_Partus=$BP_Cuci=$BP_Lembur=$BP_THR=$BP_Beli=$BP_Perjalanan=$BP_Konsumsi=$BO_Administrasi=$BO_Dapur=$BO_Laboratorium=$BO_Obat=$BO_Mobil=$BO_Listrik=$BO_Air=$BO_Telepon=$BO_Inventaris=$BO_Sarana=$Png_Lain=0;?>

									<?php foreach($hasil as $key => $value) {?>
												
										<?php

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

										 }?>
									




							</div>
							<div class ="table">
								<table id="bulanan" class="table table-striped table-bordered">
									<thead>
									<!-- <?php print_r($hasil) ?> -->
										<!-- <tr>
											<th style="min-width: 550px;">Pemasukan</th>
											<th style="min-width: 550px;">Pengeluaran</th>
											
										</tr> -->
										<tr>
											<th style="min-width: 150px;">No </th>
											<th style="min-width: 300px;">Uraian</th>
											<th style="min-width: 200px;">Kredit</th>
										</tr>
											
										
									</thead>
									<tbody>
										
										
										
										<tr class="odd gradeX">
											<td><?php echo "1"?>;</td>
											<td><?php echo "Belanja Pegawai"?>;
											
											<br><?php echo "Gaji Karyawan"?>;
											<br><?php echo "Insentif Karyawan"?>;
											<br><?php echo "Honor Dr. Jaga"?>;
											<br><?php echo "Jasa UGD Dr"?>;
											<br><?php echo "Jasa Partus Bidan"?>;
											<br><?php echo "Jasa Cuci Kain OK + Kain Pasien"?>;
											<br><?php echo "Lembur Karyawan"?>;
											<br><?php echo "THR Karyawan"?>;
											<br><?php echo "Beli Baju Dinas Karyawan"?>;
											<br><?php echo "Perjalanan + Pelatihan"?>;
											<br><?php echo "Konsumsi Karyawan/Uang Daging"?>;
											<br>

											</td>
											<td>	
												<br> <?php echo $BP_Gaji; ?>
												<br> <?php echo $BP_Insentif; ?>
												<br> <?php echo $BP_Honor; ?>
												<br> <?php echo $BP_UGD; ?>
												<br> <?php echo $BP_Partus; ?>
												<br> <?php echo $BP_Cuci; ?>
												<br> <?php echo $BP_Lembur; ?>
												<br> <?php echo $BP_THR; ?>
												<br> <?php echo $BP_Beli; ?>
												<br> <?php echo $BP_Perjalanan; ?>
												<br> <?php echo $BP_Konsumsi; ?>

											</td>

										</tr>

										<tr class="odd gradeX">
											<td><?php echo "2"?>;</td>
											<td><?php echo "Belanja Operasional"?>;
											<br><?php echo "Pengeluaran Administrasi"?>;
											<br><?php echo "Pengeluaran Dapur/Menu Pasien"?>;
											<br><?php echo "Pengeluaran Laboratorium"?>;
											<br><?php echo "Pengeluaran Obat-Obatan"?>;
											<br><?php echo "Pengeluaran Mobil"?>;
											<br><?php echo "Pengeluaran Listrik + Kain Pasien"?>;
											<br><?php echo "Pengeluaran Air"?>;
											<br><?php echo "Pengeluaran Telepon"?>;
											<br><?php echo "Pengeluaran Inventaris"?>;
											<br><?php echo "Pemeliharaan Sarana"?>;
											<br>

											</td>
											<td>
												<br> <?php echo $BO_Administrasi; ?>											
												<br> <?php echo $BO_Dapur; ?>
												<br> <?php echo $BO_Laboratorium; ?>
												<br> <?php echo $BO_Obat; ?>
												<br> <?php echo $BO_Mobil; ?>												
												<br> <?php echo $BO_Listrik; ?>
												<br> <?php echo $BO_Air; ?>
												<br> <?php echo $BO_Telepon; ?>
												<br> <?php echo $BO_Inventaris; ?>
												<br> <?php echo $BO_Sarana; ?>
											</td>
											

										</tr>



										<tr class="odd gradeX">
											<td><?php echo "5"?>;</td>
											<td><?php echo "Pengeluaran Lain-Lain"?>;
											
											</td>
											<td><?php echo $Png_Lain; ?></td>
											

										</tr>


												

									</tbody>
								</table>
							</div>
							<!-- /.table -->
						</div>
						<!-- /.panel-body -->

					</div>
					<!-- /.panel -->
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->
	</div>


<script type="text/javascript">

$(document).ready(function(){
	$('#bulanan').DataTable( {
			"scrollX": true,
			"scrollY": "400px"
	});			

	$('#excelPemDownload').click(function(){
		window.location="<?php echo site_url(); ?>report/transaksi_bulanan_excel/"+$('#bulanOpt').find(":selected").val()+"/"+$('#tahunOpt').find(":selected").val();
	})

	$('#excelPemDownloadRekap').click(function(){
		window.location="<?php echo site_url(); ?>report/rekapitulasi_transaksi_bulanan_excel/"+$('#bulanOpt').find(":selected").val()+"/"+$('#tahunOpt').find(":selected").val();
	})

	$('#pdfPemDownload').click(function(){
		window.location="<?php echo base_url(); ?>create_pdf/rekapitulasi_lahan_kecamatan_pdf/"+$('#tahunOpt').val()+"/"+$('#periodeOpt').val();
	})
	
	function changeDataPem()
	{
		
		window.location="<?php echo site_url(); ?>/report/laporan_bulanan/"+$('#bulanOpt').find(":selected").val()+"/"+$('#tahunOpt').find(":selected").val()+"/"+$('#jenisOpt').find(":selected").val()
		
	}
	$('#tahunOpt').change(function(){
		
		changeDataPem()
	});
	$('#bulanOpt').change(function(){
		
		changeDataPem()
	});
	$('#tanggalOpt').change(function(){
		
		changeDataPem()
	});
	$('#jenisOpt').change(function(){
		
		changeDataPem()
	});
	$('#pilihan').change(function(){
		
		changeDataPem()
	});



});
	
</script>