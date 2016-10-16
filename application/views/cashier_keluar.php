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
                                            <input ng-click="cekFilter()"type="radio" name="transaksi" id="optionsRadiosInline1" value="1"> Pemasukan
                                        </label>
                                        <label class="radio-inline">
                                            <input ng-click="cekFilter()"type="radio" name="transaksi" id="optionsRadiosInline2" value="2" checked>Pengeluaran
                                        </label>

                                    </div>
                                    <div class="form-group">
                                        <label>Selects</label>
                                        <select id="selectedItem" ng-model="selectedItem" ng-options="item.value as item.name for item in option"></select>
                                    </div>

                                    <div class="form-group">
                                        <label>Uraian</label>
                                        <textarea id="uraian" ng-model="uraian" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">Rp.</span>
                                        <input id="uang" ng-model="uang" type="number" class="form-control">
                                        <span class="input-group-addon">.00</span>
                                    </div>

                                    <button ng-click="addRow()" class="btn btn-primary">Tambahkan</button>

                                </form>

                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>

                <form method="post" action="<?php echo base_url('') ?>">
                    <div class ="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-list"></i> Laporan Bulanan
                        </div>

                        <div class="panel-body">
                            <div class="form-group panel-default">
                                <div class="row">

                                    <div class="col-md-3 pull-right">                                         
                                        <a href="#" class="pull-right" id="excelPemDownloadRekap">Rekapitulasi Bulanan <img src="<?php  echo base_url('assets/img/excel.png')?>"></a>
                                    </div>
                                </div>
                            </div>
                            <div class ="table">
                                <table id="harian" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 50px;">No</th>
                                            <th style="min-width: 200px;">Jenis Transaksi</th>
                                            <th style="min-width: 300px;">Uraian</th>

                                            <th style="min-width: 150px;">Biaya</th>
                                            <th style="min-width: 50px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="company in companies" class="odd gradeX">
                                            <td class="hidden">
                                                <input name="company[{{company.counter}}][transaksi]" value="{{company.transaksi}}">
                                                <input name="company[{{company.counter}}][uraian]" value="{{company.uraian}}">
                                                <input name="company[{{company.counter}}][biaya]" value="{{company.biaya}}">
                                            </td>
                                            <td>{{company.counter}}</td>
                                            <td>{{company.transaksi}}</td>
                                            <td>{{company.uraian}}</td>
                                            <td>{{company.biaya}}</td>
                                            <td><input type="button" value="Remove" class="btn btn-primary" ng-click="removeRow(company.name)"/></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" ng-click="submitCashier()" class="btn btn-default">Sementara</button>
                            </div>
                            <!-- /.table -->
                        </div>
                        <!-- /.panel-body -->

                    </div>
                    <!-- /.panel -->
                </form>
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
            // function add(){
            //     var uraian= $('#uraian').val();
            //     var i = 1;
               
            //     $('#harian > tbody:last-child').append('<tr><td>' +uraian+ '</td></tr><tr>...</tr>');
            //      console.log(uraian);
            // }
            
</script>
