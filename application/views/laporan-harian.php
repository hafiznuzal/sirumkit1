	<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12" style="color:#446CB3">
				   <h1 class="page-header">Laporan Harian</h1>
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

							<i class="fa fa-list"></i> Laporan Harian
						</div>
				
						
							
						
						<div class="panel-body">
							<div class="form-group panel-default">
								<div class="row">
									
									<div class="col-md-2"> 
									<label>Tanggal:</label> 
									<select class="form-control form-inline" id="tanggalOpt" name="tanggal">
										<option disabled selected><?php echo $tanggal_s; ?></option>
									 	<?php  for ($i=1; $i <=$tanggal ; $i++) { ?>

									    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
									<select class="form-control form-inline" id="bulanOpt" name="bulan">
									 	<option disabled selected><?php echo $tahun_s; ?></option>
									 	<?php  for ($i=2015; $i <=$tahun ; $i++) { ?>

									    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									    <?php } ?>	
									</select>
									</div> 
									
									




									<div class="col-md-3 pull-right"> 
										<a href="#" class="pull-right" id="excelPemDownload">Download Excel <img src="<?php  echo site_url()?>assets/img/excel.png"></a>
										<br>
										<a href="#" class="pull-right" id="pdfPemDownload">Download PDF <img src="<?php  echo site_url()?>assets/img/pdf.png"></a>


									</div>
								</div>
							</div>
							<div class ="table">
								<table id="harian" class="table table-striped table-bordered">
									<thead>
										<!-- <tr>
											<th style="min-width: 550px;">Pemasukan</th>
											<th style="min-width: 550px;">Pengeluaran</th>
											
										</tr> -->
										<tr>
											<th style="min-width: 150px;">No Transaksi</th>
											<th style="min-width: 300px;">Uraian</th>
											<th style="min-width: 200px;">Jumlah</th>
											
											<th style="min-width: 150px;">No Transaksi</th>
											<th style="min-width: 300px;">Uraian</th>
											<th style="min-width: 200px;">Jumlah</th>

											<th style="min-width: 200px;">Penanggung Jawab</th>
											
										</tr>
											
										</tr>
									</thead>
									<tbody>
										
										<?php for($c=1;$c<$jumlah;$c++){?>
											
											<tr class="odd gradeX">

											<?php foreach ($lah_kec[$c] as $i) {?>
										
											<td><?php echo " "?></td>
											<td><?php echo "Pembelian Alat Uro"?></td>
											<td><?php echo "Inventory RS"?></td>
											<td><?php echo "0"?></td>
											<td><?php echo "2000000"?></td>
											<td><?php echo "21 Januari"?></td>
											
										<?php }?>
											
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
	$('#harian').DataTable( {
			"scrollX": true,
			"scrollY": "400px"
	});			

	$('#excelPemDownload').click(function(){
		window.location="<?php echo site_url(); ?>report/rekapitulasi_lahan_kecamatan_excel/"+$('#tahunOpt').val()+"/"+$('#periodeOpt').val();
	})

	$('#pdfPemDownload').click(function(){
		window.location="<?php echo site_url(); ?>create_pdf/rekapitulasi_lahan_kecamatan_pdf/"+$('#tahunOpt').val()+"/"+$('#periodeOpt').val();
	})
	
	function changeDataPem()
	{
		
		window.location="<?php echo site_url() ?>report/report_lahan/"+$('#tanggalOpt').val()+"/"+$('#bulanOpt').val()+"/"+$('#tahunOpt').val();
		
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
	$('#kecamatanOpt').change(function(){
		
		changeDataPem()
	});
	$('#pilihan').change(function(){
		
		changeDataPem()
	});



});
	
</script>