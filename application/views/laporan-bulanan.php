	<div id="page_container">
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

							<i class="fa fa-list"></i> Laporan Bulanan
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
										
										<a href="#" class="pull-right" id="excelPemDownload">Download Excel <img src="<?php  echo base_url('assets/img/excel.png')?>"></a>
										<!-- <br>
										<a href="#" class="pull-right" id="pdfPemDownload">Download PDF <img src="<?php  echo base_url('assets/img/pdf.png')?>"></a> -->


									</div>
								</div>
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
											<th style="min-width: 200px;">Debet</th>
										</tr>
											
										
									</thead>
									<tbody>
										
										
										
										<tr class="odd gradeX">
											<td><?php echo "1"?>;</td>
											<td><?php echo "Penerimaan VK"?>;
											
											<br><?php echo "a. Persalinan"?>;
											<br><?php echo "b. Perawatan Bayi"?>;
											<br><?php echo "c. Jasa VK"?>;
											<br>

											</td>
											<td> 
											<?php foreach($hasil as $key => $value) {?>

												<?php  if($value['Item_Transaksi'] === 'VK- Persalinan') {?>
													<br> <?php echo $value['Biaya']; ?>
												<?php } ?>
												<?php  if($value['Item_Transaksi'] === 'VK- Perawatan Bayi') {?>
													<br> <?php echo $value['Biaya']; ?>
												<?php } ?>
												<?php  if($value['Item_Transaksi'] === 'VK- Jasa VK') {?>
													<br> <?php echo $value['Biaya']; ?>
												<?php } ?>


											<?php }?>
											</td>

										</tr>

										<tr class="odd gradeX">
											<td><?php echo "2"?>;</td>
											<td><?php echo "Penerimaan OK"?>;
											<br><?php echo "a. Jasa OK"?>;
											<br><?php echo "b. Penerimaan Alat Monitor"?>;
											<br><?php echo "c. Penerimaan Alat Couter"?>;
											<br><?php echo "d. Penerimaan RR"?>;
											<br>

											</td>
											<td>aaa</td>
											

										</tr>

										<tr class="odd gradeX">
											<td><?php echo "3"?>;</td>
											<td><?php echo "Penerimaan Rawat Inap"?>;
											<br><?php echo "a. Perawatan"?>;
											<br><?php echo "	1. VIP 			XXorg	Rp.xxx"?>;
											<br><?php echo "	2. Kelas I 		XXorg	Rp.xxx"?>;
											<br><?php echo "	3. Kelas II 	XXorg	Rp.xxx"?>;
											<br><?php echo "	4. Kelas III 	XXorg	Rp.xxx"?>;
											<br>
											<br><?php echo "Pasien BPJS Bulan XXX XXXX XXXX orang"?>;
											<br><?php echo "b. Persentase dr dari pasien"?>;
											<br><?php echo "c. Jasa dr u/ RS dari jasa Visite"?>;
											<br><?php echo "d. Labor Rawat Nginap"?>;
											<br><?php echo "e. Penerimaan HCU"?>;
											<br><?php echo "f. Transportasi"?>;
											<br><?php echo "g. Medical Record"?>;
											<br><?php echo "h. Piutang yang diterima"?>;
											<br><?php echo "i. Penerimaan Obat - Obat Rawat Inap"?>;
											<br><?php echo "j. Perasat"?>;
											<br><?php echo "k. Insentif obat rawat inap + rawat jalan"?>;
											<br><?php echo "l. Jasa Pelayanan"?>;
											<br><?php echo "m. Penerimaan Rotgen"?>;
											<br><?php echo "n. Penerimaan USG"?>;
											<br>

											</td>
											<td>aaa</td>
											

										</tr>

										<tr class="odd gradeX">
											<td><?php echo "4"?>;</td>
											<td><?php echo "Penerimaan Rawat Jalan"?>;
											<br><?php echo "a. Labor Rawat Jalan"?>;
											<br><?php echo "b. EKG Rawat Jalan + Rawat Inap"?>;
											<br><?php echo "c. Karcis IGD Rawat Jalan + Rawat Inap"?>;
											<br><?php echo "d. Jasa Tindakan Rawat Jalan"?>;
											<br><?php echo "e. Penerimaan Obat-Obatan Rawat Jalan"?>;
											<br><?php echo "f. Karcis Rawat Jalan"?>;
											<br>

											</td>
											<td>aaa</td>
											

										</tr>

										<tr class="odd gradeX">
											<td><?php echo "5"?>;</td>
											<td><?php echo "Penerimaan Lain-Lain"?>;
											
											</td>
											<td>aaa</td>
											

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
		window.location="<?php echo base_url(); ?>report/rekapitulasi_lahan_kecamatan_excel/"+$('#tahunOpt').val()+"/"+$('#periodeOpt').val();
	})

	$('#pdfPemDownload').click(function(){
		window.location="<?php echo base_url(); ?>create_pdf/rekapitulasi_lahan_kecamatan_pdf/"+$('#tahunOpt').val()+"/"+$('#periodeOpt').val();
	})
	
	function changeDataPem()
	{
		
		window.location="<?php echo site_url(); ?>/report/laporan_harian/"+$('#bulanOpt').find(":selected").val()+"/"+$('#tahunOpt').find(":selected").val()+"/"+$('#jenisOpt').find(":selected").val()
		
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