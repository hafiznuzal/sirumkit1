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
								<table id="harian" class="table table-striped table-bordered">
									<thead>
										<!-- <tr>
											<th style="min-width: 550px;">Pemasukan</th>
											<th style="min-width: 550px;">Pengeluaran</th>
											
										</tr> -->
										<tr>
											<th style="min-width: 150px;">No Transaksi</th>
											<th style="min-width: 300px;">Jenis Transaksi</th>
											<th style="min-width: 200px;">Uraian</th>
											
											<th style="min-width: 150px;">Biaya</th>
											
											
										</tr>
											
										</tr>
									</thead>
									<tbody>
											<?php foreach($hasil as $key => $value) {?>
												<tr class="odd gradeX">

												<td><?php echo $value['No_Transaksi']; ?></td>
												<td><?php echo $value['Item_Transaksi'];?></td>
												<td><?php echo $value['Uraian'];?></td>
												<td><?php echo $value['Biaya'];?></td>
												
												</tr>
										<?php }?>


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

	$('#harian').DataTable( {
			"scrollX": true,
			"scrollY": "400px"
	});			

	$('#excelPemDownload').click(function(){
		window.location="<?php echo site_url(); ?>report/transaksi_harian_excel/"+$('#tanggalOpt').find(":selected").val()+"/"+$('#bulanOpt').find(":selected").val()+"/"+$('#tahunOpt').find(":selected").val();
	})

	$('#pdfPemDownload').click(function(){
		window.location="<?php echo site_url(); ?>create_pdf/rekapitulasi_lahan_kecamatan_pdf/"+$('#tahunOpt').val()+"/"+$('#periodeOpt').val();
	})
	
	function changeDataPem()
	{
		alert($('#jenisOpt').find(":selected").val())
		// if($('#tahunOpt').val()!=null || $('#bulanOpt').val() !=null && $('#tanggalOpt').val() != null)
		window.location="<?php echo site_url(); ?>/report/laporan_harian/"+$('#tanggalOpt').find(":selected").val()+"/"+$('#bulanOpt').find(":selected").val()+"/"+$('#tahunOpt').find(":selected").val()+"/"+$('#jenisOpt').find(":selected").val();
		
	}
	



});
	
</script>