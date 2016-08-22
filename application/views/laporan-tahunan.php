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
									<select class="form-control form-inline" id="tahunOpt" name="tahun">
									 	<option disabled selected><?php echo $tahun_s; ?></option>
									 	<?php  for ($i=2015; $i <=$tahun ; $i++) { ?>

									    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									    <?php } ?>	
									</select>
									</div> 
									
									
								<?php for ($i=1; $i<13 ; $i++) { 
										

									$VK_Persalinan[$i] = 0;
									$VK_Perawatan[$i] = 0;
									$VK_Jasa[$i] = 0;
									$OK_Jasa[$i] = 0;
									$OK_Monitor[$i] = 0;
									$OK_Couter[$i] = 0;
									$OK_RR[$i] = 0;
									$VIP[$i] = 0;
									$Kelas_I[$i] = 0;
									$Kelas_I[$i] = 0;
									$Kelas_II[$i] = 0;
									$Kelas_III[$i] = 0;
									$BPJS_Persentase[$i] = 0;
									$BPJS_Dr_Visite[$i] = 0;									
									$BPJS_Labor[$i] = 0;
									$BPJS_Penerimaan_HCU[$i] = 0;
									$BPJS_Transportasi[$i] = 0;
									$BPJS_Medical[$i] = 0;
									$BPJS_Piutang[$i] = 0;
									$BPJS_Penerimaan_Obat[$i] = 0;
									$BPJS_Perasat[$i] = 0;
									$BPJS_Insentif[$i] = 0;
									$BPJS_Jasa[$i] = 0;
									$BPJS_Penerimaan_Rontgen[$i] = 0;
									$BPJS_Penerimaan_USG[$i] = 0;
									$RJ_Labor[$i] = 0;
									$RJ_EKG[$i] = 0;
									$RJ_Karcis_IGD[$i] = 0;
									$RJ_Jasa_Tindakan[$i] = 0;
									$RJ_Penerimaan_Obat[$i] = 0;
									$RJ_Karcis[$i] = 0;
									$Penerimaan_Lain[$i] = 0;

									foreach($hasil[$i] as $key => $value) {?>
												
										<?php

											if($value['Item_Transaksi'] === 'VK- Persalinan')
											{
												$VK_Persalinan[$i] = $value['Biaya'];
											}
											elseif($value['Item_Transaksi'] === 'VK- Perawatan Bayi') 
										  	{
										  		$VK_Perawatan[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'VK- Jasa VK')
											{
												$VK_Jasa[$i] = $value['Biaya'];
											}
										 	
										  
											elseif($value['Item_Transaksi'] === 'OK- Jasa OK') 
											{
												$OK_Jasa[$i] = $value['Biaya'];
											}
											elseif($value['Item_Transaksi'] === 'OK- Penerimaan Alat Monitor') 
										  	{
										  		$OK_Monitor[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'OK- Penerimaan Alat Couter') 
											{
												$OK_Couter[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'OK- Penerimaan RR') 
											{
												$OK_RR[$i] = $value['Biaya'];
											}



											elseif($value['Item_Transaksi'] === 'Rawat Inap - VIP') 
											{
												$VIP[$i] = $value['Biaya'];
											}
											elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas I')
										  	{
										  		$Kelas_I[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas II')

											{
												$Kelas_II[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'Rawat Inap - Kelas III')

											{
												$Kelas_III[$i] = $value['Biaya'];
											}

											elseif($value['Item_Transaksi'] === 'BPJS - Persentase dr dari pasien') 
											{
												$BPJS_Persentase[$i] = $value['Biaya'];
											}

											elseif($value['Item_Transaksi'] === 'BPJS - Jasa dr utk RS dari Jasa Visite') 
											{
												$BPJS_Dr_Visite[$i] = $value['Biaya'];
											}

											elseif($value['Item_Transaksi'] === 'BPJS - Labor Rawat Nginap')
										  	{
										  		$BPJS_Labor[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan HCU')
											{
												$BPJS_Penerimaan_HCU[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'BPJS - Transportasi') 
											{
												$BPJS_Transportasi[$i] = $value['Biaya'];
											}

											elseif($value['Item_Transaksi'] === 'BPJS - Medical Record')
											{
												$BPJS_Medical[$i] = $value['Biaya'];
											}
											elseif($value['Item_Transaksi'] === 'BPJS - Piutang yang diterima')
											{
												$BPJS_Piutang[$i] = $value['Biaya'];
											}
											elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan Obat - Obat Rawat Inap')
										  	{
										  		$BPJS_Penerimaan_Obat[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'BPJS - Perasat')
											{
												$BPJS_Perasat[$i] = $value['Biaya'];
											}										 
										  
											elseif($value['Item_Transaksi'] === 'BPJS - Insentif obat rawat inap + rawat jalan') 
											{
												$BPJS_Insentif[$i] = $value['Biaya'];
											}
											elseif($value['Item_Transaksi'] === 'BPJS - Jasa Pelayanan') 
										  	{
										  		$BPJS_Jasa[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan Rotgen')
											{
												$BPJS_Penerimaan_Rontgen[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'BPJS - Penerimaan USG')
											{
												$BPJS_Penerimaan_USG[$i] = $value['Biaya'];
											}












											elseif($value['Item_Transaksi'] === 'Rawat Jalan - Labor Rawat Jalan')
											{
												$RJ_Labor[$i] = $value['Biaya'];
											}
											elseif($value['Item_Transaksi'] === 'Rawat Jalan - EKG Rawat Jalan + Rawat Inap')
										  	{
										  		$RJ_EKG[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'Rawat Jalan - Karcis IGD Rawat Jalan + Rawat Inap')
											{
												$RJ_Karcis_IGD[$i] = $value['Biaya'];
											}										 
										  
											elseif($value['Item_Transaksi'] === 'Rawat Jalan - Jasa Tindakan Rawat Jalan') 
											{
												$RJ_Jasa_Tindakan[$i] = $value['Biaya'];
											}
											elseif($value['Item_Transaksi'] === 'Rawat Jalan - Penerimaan Obat-Obatan Rawat Jalan') 
										  	{
										  		$RJ_Penerimaan_Obat[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'Rawat Jalan - Karcis Rawat Jalan')
											{
												$RJ_Karcis[$i] = $value['Biaya'];
											}
										 
										  	elseif($value['Item_Transaksi'] === 'Penerimaan Lain-Lain')
											{
												$Penerimaan_Lain[$i] = $value['Biaya'];
											}

										 }


									 } ?>
									




									<div class="col-md-4 pull-right"> 
										<br>
										
										<a href="#" class="pull-right" id="excelPemDownloadOutI">LAPORAN PENGELUARAN SMT I <img src="<?php  echo base_url('assets/img/excel.png')?>"></a>
										<a href="#" class="pull-right" id="excelPemDownloadOutII">LAPORAN PENGELUARAN SMT II <img src="<?php  echo base_url('assets/img/excel.png')?>"></a>
										<a href="#" class="pull-right" id="excelPemDownloadInI">LAPORAN PENERIMAAN SMT I <img src="<?php  echo base_url('assets/img/excel.png')?>"></a>
										<a href="#" class="pull-right" id="excelPemDownloadInII">LAPORAN PENERIMAAN SMT II <img src="<?php  echo base_url('assets/img/excel.png')?>"></a>
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
											<th style="min-width: 50px;">No </th>
											<th style="min-width: 300px;">Uraian</th>
											<th style="min-width: 150px;">Januari</th>
											<th style="min-width: 150px;">Februari</th>
											<th style="min-width: 150px;">Maret</th>
											<th style="min-width: 150px;">April</th>
											<th style="min-width: 150px;">Mei</th>
											<th style="min-width: 150px;">Juni</th>
											<th style="min-width: 150px;">Juli</th>
											<th style="min-width: 150px;">Agustus</th>
											<th style="min-width: 150px;">September</th>
											<th style="min-width: 150px;">Oktober</th>
											<th style="min-width: 150px;">November</th>
											<th style="min-width: 150px;">Desember</th>
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
											<?php for ($k=1; $k <13 ; $k++) 
											{ ?>
												<td>
												<br> <?php echo $VK_Persalinan[$k]; ?>
												<br> <?php echo $VK_Perawatan[$k]; ?>
												<br> <?php echo $VK_Jasa[$k]; ?>
											</td>

											<?php
											} ?>
											
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
											<?php for ($k=1; $k <13 ; $k++) 
											{ ?>
											<td>
												<br>
												<br> <?php echo $OK_Jasa[$k]; ?>												
												<br> <?php echo $OK_Monitor[$k]; ?>
												<br> <?php echo $OK_Couter[$k]; ?>
												<br> <?php echo $OK_RR[$k]; ?>
												
											</td>
											<?php
											} ?>

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
											<?php for ($k=1; $k <13 ; $k++) 
											{ ?>
											
											<td>
													<br>									
													<br> <?php echo $VIP[$k]; ?>
													<br> <?php echo $Kelas_I[$k]; ?>
													<br> <?php echo $Kelas_II[$k]; ?>
													<br> <?php echo $Kelas_III[$k]; ?>
													<br>
													<br>
													<br> <?php echo $BPJS_Persentase[$k]; ?>
													<br> <?php echo $BPJS_Dr_Visite[$k]; ?>
													<br> <?php echo $BPJS_Labor[$k]; ?>
													<br> <?php echo $BPJS_Penerimaan_HCU[$k]; ?>
													<br> <?php echo $BPJS_Transportasi[$k]; ?>
													<br> <?php echo $BPJS_Medical[$k]; ?>
													<br> <?php echo $BPJS_Piutang[$k]; ?>
													<br> <?php echo $BPJS_Penerimaan_Obat[$k]; ?>
													<br> <?php echo $BPJS_Perasat[$k]; ?>
													<br> <?php echo $BPJS_Insentif[$k]; ?>
													<br> <?php echo $BPJS_Jasa[$k]; ?>
													<br> <?php echo $BPJS_Penerimaan_Rontgen[$k]; ?>
													<br> <?php echo $BPJS_Penerimaan_USG[$k]; ?>
												
											</td>
											<?php
											} ?>

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
											<?php for ($k=1; $k <13 ; $k++) 
											{ ?>
											<td>
												<br> <?php echo $RJ_Labor[$k]; ?>
												<br> <?php echo $RJ_EKG[$k]; ?>
												<br> <?php echo $RJ_Karcis_IGD[$k]; ?>
												<br> <?php echo $RJ_Jasa_Tindakan[$k]; ?>
												<br> <?php echo $RJ_Penerimaan_Obat[$k]; ?>
												<br> <?php echo $RJ_Karcis[$k]; ?>
											</td>
											<?php
											} ?>


										</tr>

										<tr class="odd gradeX">
											<td><?php echo "5"?>;</td>
											<td><?php echo "Penerimaan Lain-Lain"?>;
											
											</td>
											<?php for ($k=1; $k <13 ; $k++) 
											{ ?>
											<td><?php echo $Penerimaan_Lain[$k]; ?></td>
											<?php
											} ?>

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

	$('#excelPemDownloadOutI').click(function(){
		window.location="<?php echo site_url(); ?>/report/rekapitulasi_transaksi_bulanan_excel_semester1_keluar/"+$('#tahunOpt').find(":selected").val();
		
	})

	$('#excelPemDownloadOutII').click(function(){
		window.location="<?php echo site_url(); ?>/report/rekapitulasi_transaksi_bulanan_excel_semester2_keluar/"+$('#tahunOpt').find(":selected").val();
		
	})

	$('#excelPemDownloadInI').click(function(){
		window.location="<?php echo site_url(); ?>/report/rekapitulasi_transaksi_bulanan_excel_semester1_masuk/"+$('#tahunOpt').find(":selected").val();
		
	})

	$('#excelPemDownloadInII').click(function(){
		window.location="<?php echo site_url(); ?>/report/rekapitulasi_transaksi_bulanan_excel_semester2_masuk/"+$('#tahunOpt').find(":selected").val();
		
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