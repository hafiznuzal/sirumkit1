<body ng-controller="formController">
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Forms</h1>
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
                                        
                                       

                                        <div class="form-group">
                                            <label>Jenis Transaksi</label>
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

                                        <button ng-click="submit()" class="btn btn-primary">Simpan</button>

                                        </form>
                                        
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
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
