<body ng-controller="formController">
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Kasir</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form">
                                        
                                       

                                        <div class="form-group" style="display:none;">
                                            <label>Jenis Transaksi</label>
                                            <label class="radio-inline" >
                                                <input ng-click="cekFilter()"type="radio" name="transaksi" id="optionsRadiosInline1" value="1" checked > Pemasukan
                                            </label>
                                            <label class="radio-inline">
                                                <input ng-click="cekFilter()"type="radio" name="transaksi" id="optionsRadiosInline2" value="2">Pengeluaran
                                            </label>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Selects</label>
                                            <select id="selectedItem" ng-model="selectedItem" ng-options="item.value as item.name for item in option"></select>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label>Nomor Transaksi</label>
                                            <input ng-model="nomorTransaksi" class="form-control" placeholder="Enter text" disabled style="width: 200px">
                                            <label>Nama Transaksi</label>
                                            <input ng-model="namaTransaksi" class="form-control" placeholder="Enter text">
                                        </div> -->
                                        
                                        <div class="form-group">
                                            <label>Uraian</label>
                                            <textarea ng-model="uraian" class="form-control" rows="3"></textarea>
                                        </div>

                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input ng-model="uang" type="number" class="form-control">
                                            <span class="input-group-addon">.00</span>
                                        </div>

                                        <button ng-click="submit()" class="btn btn-primary">Tambahkan</button>

                                        </form>
                                        
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>

                        <div class ="panel panel-primary">
                        <div class="panel-heading">

                            <i class="fa fa-list"></i> Laporan Bulanan
                        </div>
                
                        
                            
                        
                        <div class="panel-body">
                            <div class="form-group panel-default">
                                <div class="row">
                                   
                                    <div class="col-md-3 pull-right">                                         
                                        <a href="#" class="pull-right" id="excelPemDownloadRekap">Rekapitulasi Bulanan <img src="<?php  echo base_url('assets/img/excel.png')?>"></a>
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
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

</div>

</body>





<script>

            $('.add_btn').click(function(e) {
                e.preventDefault();
                var temp = $(".hapusLokasi");
                for (var i = 0; i < temp.length; i++) $(temp[i]).click();
                $("#AddModal").modal("show");
            });
    
</script>
