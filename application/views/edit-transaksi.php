<body ng-controller="formController">
	<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12" style="color:#446CB3">
				   <h1 class="page-header">Edit Transaksi</h1>
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

							<i class="fa fa-list"></i> Edit Transaksi
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

								</div>
							</div>	
							<div class ="table">
								<table id="edit_transaksi" class="table table-striped table-bordered">
									<thead>
<<<<<<< HEAD
										
=======
										<!-- <tr>
											<th style="min-width: 550px;">Pemasukan</th>
											<th style="min-width: 550px;">Pengeluaran</th>
											
										</tr> -->
>>>>>>> fdc3360c1406076f7a60d364045ef276f214a52c
										<tr>
											<th style="min-width: 50px;">No Transaksi</th>
											<th style="min-width: 200px;">Jenis Transaksi</th>
											<th style="min-width: 250px;">Uraian</th>											
											<th style="min-width: 150px;">Biaya</th>
<<<<<<< HEAD
											<!-- <th style="min-width: 150px;">Model Transaksi</th> -->
=======
>>>>>>> fdc3360c1406076f7a60d364045ef276f214a52c
											<th style="min-width: 50px;">Ket</th>
											
											
										</tr>
											
										</tr>
									</thead>
									<tbody>
											<?php foreach($hasil as $key => $value) {?>
												<tr class="odd gradeX">

												<td><?php echo $value['No_Transaksi']; ?></td>
												<td><?php echo $value['Item_Transaksi'];?></td>
												<td><?php echo $value['Uraian'];?></td>
<<<<<<< HEAD
												<td><?php echo $value['Biaya'];?></td>												
												<td><button class="fa fa-edit fa btn btn-danger" href="#" onclick="edit_detail(<?php echo $value['Id_Transaksi']?>);" ></button></td>
												
												</tr>
												
=======
												<td><?php echo $value['Biaya'];?></td>
												<td><button ng-click="editButton('<?php echo $value['Id_Transaksi']; ?>','<?php echo $value['No_Transaksi']; ?>','<?php echo $value['Item_Transaksi']; ?>','<?php echo $value['Uraian']; ?>','<?php echo $value['Biaya']; ?>')" class="fa fa-edit fa btn btn-danger"></button></td>
												
												</tr>
>>>>>>> fdc3360c1406076f7a60d364045ef276f214a52c
										<?php }?>


									</tbody>
								</table>
							</div>
							<!-- /.table -->
						</div>
						<!-- /.panel-body -->
<<<<<<< HEAD
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Edit Transaksi</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
         <!--  <<?php if (condition) {
          	# code...
          } ?> -->
            <label class="radio-inline">
                <input ng-click="cekFilter()"type="radio" name="transaksi" id="optionsRadiosInline1" value="1" checked> Pemasukan
            </label>
            <label class="radio-inline">
                <input ng-click="cekFilter()"type="radio" name="transaksi" id="optionsRadiosInline2" value="2">Pengeluaran
            </label>
          </div>
          <div class="form-group">
            <label>Selects</label>
                <select id="selectedItem" ng-model="selectedItem" ng-options="item.value as item.name for item in option"></select>
          </div>
          <div class="form-group">
            <label>Uraian</label>
                <textarea ng-model="uraian" class="form-control" rows="3" value="lalala"></textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
=======

>>>>>>> fdc3360c1406076f7a60d364045ef276f214a52c
					</div>
					<!-- /.panel -->
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->
	</div>
</body>

<script type="text/javascript">
<<<<<<< HEAD
function edit_detail($id)
{	
	$('#exampleModal').modal("show")
}
=======

>>>>>>> fdc3360c1406076f7a60d364045ef276f214a52c
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
		alert($('#jenisOpt').find(":selected").val())
		// if($('#tahunOpt').val()!=null || $('#bulanOpt').val() !=null && $('#tanggalOpt').val() != null)
		window.location="<?php echo site_url(); ?>/report/laporan_harian/"+$('#tanggalOpt').find(":selected").val()+"/"+$('#bulanOpt').find(":selected").val()+"/"+$('#tahunOpt').find(":selected").val()+"/"+$('#jenisOpt').find(":selected").val();
		
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

	// $("#edit_transaksi").on("click", ".edit_btn", function(e) {
	// 			e.preventDefault();
	// 			var name = $(this).parent().prev().prev().prev().html();
	// 			var lokasi = $(this).parent().prev().html();
	// 			var id = $(this).attr('id');
	// 			var pengembang = $(this).parent().prev().prev().html();
	// 			var pengembangID = $(this).parent().prev().prev().attr('id');
				
	// 			console.log(pengembangID)
	// 			row=$(this).parent().parent();
				

	// 			$('#idEditPerumahan').val(id);
	// 			$('#editNamaPerumahan').val(name);
	// 			$('#editNamaPengembang').val(pengembang);
	// 			$('#perumahanID').val(id);
	// 			$('#perumahanLokasi').val(lokasi);
	// 			$('#EditModal').modal('show');
	// 			$('#editNamaPengembang').val(pengembangID);
	// 		});



});

</script>