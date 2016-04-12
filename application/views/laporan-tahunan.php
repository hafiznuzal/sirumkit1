	<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12" style="color:#446CB3">
				   <h1 class="page-header">Laporan Tahunan</h1>
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

							<i class="fa fa-list"></i> Laporan Tahunan
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
									<label>Tahun:</label> 
									<select class="form-control form-inline" id="bulanOpt" name="bulan">
									 	<option disabled selected><?php echo $tahun_s; ?></option>
									 	<?php  for ($i=2015; $i <=$tahun ; $i++) { ?>

									    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									    <?php } ?>	
									</select>
									</div> 
									
									
									<?php $VK_Persalinan=$VK_Perawatan=$VK_Jasa =$OK_Jasa=$OK_Monitor=$OK_Couter=$OK_RR=$VIP=$Kelas_I=$Kelas_II=$Kelas_III=$BPJS_Persentase=$BPJS_Dr_Visite=$BPJS_Labor=$BPJS_Penerimaan_HCU=$BPJS_Transportasi=$BPJS_Medical=$BPJS_Piutang=$BPJS_Penerimaan_Obat=$BPJS_Perasat=$BPJS_Insentif=$BPJS_Jasa=$BPJS_Penerimaan_Rontgen=$BPJS_Penerimaan_USG=$RJ_Labor=$RJ_EKG=$RJ_Karcis_IGD=$RJ_Jasa_Tindakan=$RJ_Penerimaan_Obat=$RJ_Karcis=$Penerimaan_Lain=0?>
									<?php foreach($hasil as $key => $value) {?>
												
										<?php

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

										 }?>
									




									<div class="col-md-3 pull-right"> 
										<br>
										
										<a href="#" class="pull-right" id="excelPemDownload">Download Excel <img src="<?php  echo base_url('assets/img/excel.png')?>"></a>
										<!-- <br>
										<a href="#" class="pull-right" id="pdfPemDownload">Download PDF <img src="<?php  echo base_url('assets/img/pdf.png')?>"></a> -->


									</div>

									</div>
								</div>
							</div>
							<div class ="table">
								<table id="tahunan" class="table table-striped table-bordered">
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
												<br> <?php echo $VK_Persalinan; ?>
												<br> <?php echo $VK_Perawatan; ?>
												<br> <?php echo $VK_Jasa; ?>
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
											<td>
												<br>
												<br> <?php echo $OK_Jasa; ?>												
												<br> <?php echo $OK_Monitor; ?>
												<br> <?php echo $OK_Couter; ?>
												<br> <?php echo $OK_RR; ?>
												
											</td>
											

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
											<td>
													<br>									
													<br> <?php echo $VIP; ?>
													<br> <?php echo $Kelas_I; ?>
													<br> <?php echo $Kelas_II; ?>
													<br> <?php echo $Kelas_III; ?>
													<br>
													<br>
													<br> <?php echo $BPJS_Persentase; ?>
													<br> <?php echo $BPJS_Dr_Visite; ?>
													<br> <?php echo $BPJS_Labor; ?>
													<br> <?php echo $BPJS_Penerimaan_HCU; ?>
													<br> <?php echo $BPJS_Transportasi; ?>
													<br> <?php echo $BPJS_Medical; ?>
													<br> <?php echo $BPJS_Piutang; ?>
													<br> <?php echo $BPJS_Penerimaan_Obat; ?>
													<br> <?php echo $BPJS_Perasat; ?>
													<br> <?php echo $BPJS_Insentif; ?>
													<br> <?php echo $BPJS_Jasa; ?>
													<br> <?php echo $BPJS_Penerimaan_Rontgen; ?>
													<br> <?php echo $BPJS_Penerimaan_USG; ?>
												
											</td>
											

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
											<td>
												<br> <?php echo $RJ_Labor; ?>
												<br> <?php echo $RJ_EKG; ?>
												<br> <?php echo $RJ_Karcis_IGD; ?>
												<br> <?php echo $RJ_Jasa_Tindakan; ?>
												<br> <?php echo $RJ_Penerimaan_Obat; ?>
												<br> <?php echo $RJ_Karcis; ?>
											</td>
											

										</tr>

										<tr class="odd gradeX">
											<td><?php echo "5"?>;</td>
											<td><?php echo "Penerimaan Lain-Lain"?>;
											
											</td>
											<td><?php echo $Penerimaan_Lain; ?></td>
											

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
	$('#tahunan').DataTable( {
			"scrollX": true,
			"scrollY": "400px"
	});			

	$('#excelPemDownload').click(function(){
		window.location="<?php echo site_url(); ?>/report/laporan_tahunan_excel/"+$('#tahunOpt').find(":selected").val()+"/"+$('#jenisOpt').find(":selected").val();
		
	})

	$('#pdfPemDownload').click(function(){
		window.location="<?php echo base_url(); ?>create_pdf/rekapitulasi_lahan_kecamatan_pdf/"+$('#tahunOpt').val()+"/"+$('#periodeOpt').val();
	})
	
	function changeDataPem()
	{
		
		window.location="<?php echo site_url(); ?>/report/laporan_tahunan/"+$('#tahunOpt').find(":selected").val()+"/"+$('#jenisOpt').find(":selected").val();
		
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