var app = angular.module('rumahSakit', []);
app.controller('formController', function($scope,$http) {
    var config = {
        headers : {
            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
    }
    var menuSelects = [];
    
    var menu = [];
    menu.push({'value':'VK- Persalinan','name':'VK- Persalinan'});
    menu.push({'value':'VK- Perawatan Bayi','name':'VK- Perawatan Bayi'});
    menu.push({'value':'VK- Jasa VK','name':'VK- Jasa VK'});

    menu.push({'value':'OK- Jasa OK','name':'OK- Jasa OK'});
    menu.push({'value':'OK- Penerimaan Alat Monitor','name':'OK- Penerimaan Alat Monitor'});
    menu.push({'value':'OK- Penerimaan Alat Couter','name':'OK- Penerimaan Alat Couter'});
    menu.push({'value':'OK- Penerimaan RR','name':'OK- Penerimaan RR'});

    menu.push({'value':'Rawat Inap - VIP','name':'Rawat Inap - VIP'});
    menu.push({'value':'Rawat Inap - Kelas I','name':'Rawat Inap - Kelas I'});
    menu.push({'value':'Rawat Inap - Kelas II','name':'Rawat Inap - Kelas II'});
    menu.push({'value':'Rawat Inap - Kelas III','name':'Rawat Inap - Kelas III'});

    menu.push({'value':'BPJS - Persentase dr dari pasien','name':'BPJS - Persentase dr dari pasien'});
    menu.push({'value':'BPJS - Labor Rawat Nginap','name':'BPJS - Labor Rawat Nginap'});
    menu.push({'value':'BPJS - Penerimaan HCU','name':'BPJS - Penerimaan HCU'});
    menu.push({'value':'BPJS - Transportasi','name':'BPJS - Transportasi'});
    menu.push({'value':'BPJS - Medical Record','name':'BPJS - Medical Record'});
    menu.push({'value':'BPJS - Piutang yang diterima','name':'BPJS - Piutang yang diterima'});
    menu.push({'value':'BPJS - Penerimaan Obat - Obat Rawat Inap','name':'BPJS - Penerimaan Obat - Obat Rawat Inap'});
    menu.push({'value':'BPJS - Perasat','name':'BPJS - Perasat'});
    menu.push({'value':'BPJS - Insentif obat rawat inap + rawat jalan','name':'BPJS - Insentif obat rawat inap + rawat jalan'});
    menu.push({'value':'BPJS - Jasa Pelayanan','name':'BPJS - Jasa Pelayanan'});
    menu.push({'value':'BPJS - Penerimaan Rotgen','name':'BPJS - Penerimaan Rotgen'});
    menu.push({'value':'BPJS - Penerimaan USG','name':'BPJS - Penerimaan USG'});
    
    menu.push({'value':'Rawat Jalan - Labor Rawat Jalan','name':'Rawat Jalan - Labor Rawat Jalan'});
    menu.push({'value':'Rawat Jalan - EKG Rawat Jalan + Rawat Inap','name':'Rawat Jalan - EKG Rawat Jalan + Rawat Inap'});
    menu.push({'value':'Rawat Jalan - Karcis IGD Rawat Jalan + Rawat Inap','name':'Rawat Jalan - Karcis IGD Rawat Jalan + Rawat Inap'});
    menu.push({'value':'Rawat Jalan - Jasa Tindakan Rawat Jalan','name':'Rawat Jalan - Jasa Tindakan Rawat Jalan'});
    menu.push({'value':'Rawat Jalan - Penerimaan Obat-Obatan Rawat Jalan','name':'Rawat Jalan - Penerimaan Obat-Obatan Rawat Jalan'});
    menu.push({'value':'Rawat Jalan - Karcis Rawat Jalan','name':'Rawat Jalan - Karcis Rawat Jalan'});

    menu.push({'value':'Penerimaan Lain-Lain','name':'Penerimaan Lain-Lain'});
    menuSelects.push(menu);

    menu = [];
    menu.push({'value':'B.Pegawai - Gaji Karyawan','name':'B.Pegawai - Gaji Karyawan'});
    menu.push({'value':'B.Pegawai - Insentif Karyawan','name':'B.Pegawai - Insentif Karyawan'});
    menu.push({'value':'B.Pegawai - Honor Dr. Jaga','name':'B.Pegawai - Honor Dr. Jaga'});
    menu.push({'value':'B.Pegawai - Jasa UGD Dr','name':'B.Pegawai - Jasa UGD Dr'});
    menu.push({'value':'B.Pegawai - Jasa Partus Bidan','name':'B.Pegawai - Jasa Partus Bidan'});
    menu.push({'value':'B.Pegawai - Jasa Cuci Kain OK + Kain Pasien','name':'B.Pegawai - Jasa Cuci Kain OK + Kain Pasien'});
    menu.push({'value':'B.Pegawai - Lembur Karyawan','name':'B.Pegawai - Lembur Karyawan'});
    menu.push({'value':'B.Pegawai - THR Karyawan','name':'B.Pegawai - THR Karyawan'});
    menu.push({'value':'B.Pegawai - Beli Baju Dinas Karyawan','name':'B.Pegawai - Beli Baju Dinas Karyawan'});
    menu.push({'value':'B.Pegawai - Perjalanan + Pelatihan','name':'B.Pegawai - Perjalanan + Pelatihan'});
    menu.push({'value':'B.Pegawai - Konsumsi Karyawan/Uang Daging','name':'B.Pegawai - Konsumsi Karyawan/Uang Daging'});
    
    menu.push({'value':'B.Operasional - Pengeluaran Administrasi','name':'B.Operasional - Pengeluaran Administrasi'});
    menu.push({'value':'B.Operasional - Pengeluaran Dapur/Menu Pasien','name':'B.Operasional - Pengeluaran Dapur/Menu Pasien'});
    menu.push({'value':'B.Operasional - Pengeluaran Laboratorium','name':'B.Operasional - Pengeluaran Laboratorium'});
    menu.push({'value':'B.Operasional - Pengeluaran Obat-Obatan','name':'B.Operasional - Pengeluaran Obat-Obatan'});
    menu.push({'value':'B.Operasional - Pengeluaran Mobil','name':'B.Operasional - Pengeluaran Mobil'});
    menu.push({'value':'B.Operasional - Pengeluaran Listrik + Kain Pasien','name':'B.Operasional - Pengeluaran Listrik + Kain Pasien'});
    menu.push({'value':'B.Operasional - Pengeluaran Air','name':'B.Operasional - Pengeluaran Air'});
    menu.push({'value':'B.Operasional - Pengeluaran Telepon','name':'B.Operasional - Pengeluaran Telepon'});
    menu.push({'value':'B.Operasional - Pengeluaran Inventaris','name':'B.Operasional - Pengeluaran Inventaris'});
    menu.push({'value':'B.Operasional - Pemeliharaan Sarana','name':'B.Operasional - Pemeliharaan Sarana'});

    menu.push({'value':'Pengeluaran Lain-Lain','name':'Pengeluaran Lain-Lain'});
    

    menuSelects.push(menu);

    if($('input[name=transaksi]:checked').val()==1)
	{
		$scope.option = menuSelects[0];
		$scope.selectedItem = menuSelects[0][0].value;

	}
	else if($('input[name=transaksi]:checked').val()==2)
	{
		$scope.option = menuSelects[1];
		$scope.selectedItem = menuSelects[1][0].value;
	}

    $scope.cekFilter = function(){
    	if($('input[name=transaksi]:checked').val()==1)
    	{
    		$scope.option = menuSelects[0];
    		$scope.selectedItem = menuSelects[0][0].value;
    	}
    	else if($('input[name=transaksi]:checked').val()==2)
    	{
    		$scope.option = menuSelects[1];
    		$scope.selectedItem = menuSelects[1][0].value;
    	}
    }

    $scope.submit = function(){
        // var nomor = $scope.nomorTransaksi
    	var nama =  $scope.namaTransaksi
    	var transaksi = $('#selectedItem option:selected').text();
    	var uraian = $scope.uraian;
    	var uang = $scope.uang;
    	var message = "<ul>"+"<li>"+"Transaksi : "+transaksi+"</li>"+"<li>"+"Uraian : "+uraian+"</li>"+"<li>"+"Biaya : "+uang+"</li>"+"</ul>";
    	swal({   title: "<h2>Apakah anda yakin dengan data ini ?</h2>!",   text: message,   html: true ,showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false}
            , function(){
                var data =$.param({
                    item:$scope.selectedItem,
                    uraian:$scope.uraian,
                    jenis:$('input[name=transaksi]:checked').val(),
                    biaya:$scope.uang
                })
                $http.post("/sirumkit1/index.php/admin/pasien", data,config)
               .then(
                   function(response){
                    console.log(response.data)
                    swal("Good job!", "data disimpan", "success")
                   }, 
                   function(response){
                     // failure callback
                   }
                );
        });
    }
});