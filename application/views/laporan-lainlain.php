<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12" style="color:#446CB3">
				   <h1 class="page-header">Laporan Lain Lain</h1>
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

							<i class="fa fa-list"></i> Laporan Lain Lain
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

									

									<div class="col-md-4 pull-right"> 
										<br>
										
										<a href="#" class="pull-right" id="excelPemDownload">Laporan Penerimaan Lain-Lain <img src="<?php  echo base_url('assets/img/excel.png')?>"></a>
										<a href="#" class="pull-right" id="excelPemDownloadRekap">Laporan Pengeluaran Lain-Lain <img src="<?php  echo base_url('assets/img/excel.png')?>"></a>


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
											<th style="min-width: 200px;">Debet/Kredit</th>
										</tr>
											
										
									</thead>
									<tbody>
										<?php for ($i=0; $i < $panjang ; $i++) { ?>
											<tr class="odd gradeX">
											<td><?php echo $i+1?></td>											
											<td><?php echo $hasil[$i]['Uraian'];?></td>
											<td><?php echo $hasil[$i]['Biaya'];?></td>
											</tr>
										<?php } ?>
										
										



												

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

		window.location="<?php echo site_url(); ?>report/transaksi_lainlain_masuk_excel/"+$('#bulanOpt').find(":selected").val()+"/"+$('#tahunOpt').find(":selected").val();
	})

	$('#excelPemDownloadRekap').click(function(){
		window.location="<?php echo site_url(); ?>report/transaksi_lainlain_keluar_excel/"+$('#bulanOpt').find(":selected").val()+"/"+$('#tahunOpt').find(":selected").val();

	
	})


	$('#pdfPemDownload').click(function(){
		window.location="<?php echo base_url(); ?>create_pdf/rekapitulasi_lahan_kecamatan_pdf/"+$('#tahunOpt').val()+"/"+$('#periodeOpt').val();
	})
	
	function changeDataPem()
	{
		

		window.location="<?php echo site_url(); ?>/report/laporan_lainlain/"+$('#bulanOpt').find(":selected").val()+"/"+$('#tahunOpt').find(":selected").val()+"/"+$('#jenisOpt').find(":selected").val()

		
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