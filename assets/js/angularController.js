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
    menu.push({'value':'BPJS - Jasa dr utk RS dari Jasa Visite','name':'BPJS - Jasa dr utk RS dari Jasa Visite'});
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


    var menueditSelects = [];
    
    var menuedit = [];
    menuedit.push({'value':'VK- Persalinan','text':'VK- Persalinan'});
    menuedit.push({'value':'VK- Perawatan Bayi','text':'VK- Perawatan Bayi'});
    menuedit.push({'value':'VK- Jasa VK','text':'VK- Jasa VK'});

    menuedit.push({'value':'OK- Jasa OK','text':'OK- Jasa OK'});
    menuedit.push({'value':'OK- Penerimaan Alat Monitor','text':'OK- Penerimaan Alat Monitor'});
    menuedit.push({'value':'OK- Penerimaan Alat Couter','text':'OK- Penerimaan Alat Couter'});
    menuedit.push({'value':'OK- Penerimaan RR','text':'OK- Penerimaan RR'});

    menuedit.push({'value':'Rawat Inap - VIP','text':'Rawat Inap - VIP'});
    menuedit.push({'value':'Rawat Inap - Kelas I','text':'Rawat Inap - Kelas I'});
    menuedit.push({'value':'Rawat Inap - Kelas II','text':'Rawat Inap - Kelas II'});
    menuedit.push({'value':'Rawat Inap - Kelas III','text':'Rawat Inap - Kelas III'});

    menuedit.push({'value':'BPJS - Persentase dr dari pasien','text':'BPJS - Persentase dr dari pasien'});
    menuedit.push({'value':'BPJS - Jasa dr utk RS dari Jasa Visite','text':'BPJS - Jasa dr utk RS dari Jasa Visite'});
    menuedit.push({'value':'BPJS - Labor Rawat Nginap','text':'BPJS - Labor Rawat Nginap'});
    menuedit.push({'value':'BPJS - Penerimaan HCU','text':'BPJS - Penerimaan HCU'});
    menuedit.push({'value':'BPJS - Transportasi','text':'BPJS - Transportasi'});
    menuedit.push({'value':'BPJS - Medical Record','text':'BPJS - Medical Record'});
    menuedit.push({'value':'BPJS - Piutang yang diterima','text':'BPJS - Piutang yang diterima'});
    menuedit.push({'value':'BPJS - Penerimaan Obat - Obat Rawat Inap','text':'BPJS - Penerimaan Obat - Obat Rawat Inap'});
    menuedit.push({'value':'BPJS - Perasat','text':'BPJS - Perasat'});
    menuedit.push({'value':'BPJS - Insentif obat rawat inap + rawat jalan','text':'BPJS - Insentif obat rawat inap + rawat jalan'});
    menuedit.push({'value':'BPJS - Jasa Pelayanan','text':'BPJS - Jasa Pelayanan'});
    menuedit.push({'value':'BPJS - Penerimaan Rotgen','text':'BPJS - Penerimaan Rotgen'});
    menuedit.push({'value':'BPJS - Penerimaan USG','text':'BPJS - Penerimaan USG'});
    
    menuedit.push({'value':'Rawat Jalan - Labor Rawat Jalan','text':'Rawat Jalan - Labor Rawat Jalan'});
    menuedit.push({'value':'Rawat Jalan - EKG Rawat Jalan + Rawat Inap','text':'Rawat Jalan - EKG Rawat Jalan + Rawat Inap'});
    menuedit.push({'value':'Rawat Jalan - Karcis IGD Rawat Jalan + Rawat Inap','text':'Rawat Jalan - Karcis IGD Rawat Jalan + Rawat Inap'});
    menuedit.push({'value':'Rawat Jalan - Jasa Tindakan Rawat Jalan','text':'Rawat Jalan - Jasa Tindakan Rawat Jalan'});
    menuedit.push({'value':'Rawat Jalan - Penerimaan Obat-Obatan Rawat Jalan','text':'Rawat Jalan - Penerimaan Obat-Obatan Rawat Jalan'});
    menuedit.push({'value':'Rawat Jalan - Karcis Rawat Jalan','text':'Rawat Jalan - Karcis Rawat Jalan'});

    menuedit.push({'value':'Penerimaan Lain-Lain','text':'Penerimaan Lain-Lain'});
    menueditSelects.push(menuedit);

    menuedit = [];
    menuedit.push({'value':'B.Pegawai - Gaji Karyawan','name':'B.Pegawai - Gaji Karyawan'});
    menuedit.push({'value':'B.Pegawai - Insentif Karyawan','name':'B.Pegawai - Insentif Karyawan'});
    menuedit.push({'value':'B.Pegawai - Honor Dr. Jaga','name':'B.Pegawai - Honor Dr. Jaga'});
    menuedit.push({'value':'B.Pegawai - Jasa UGD Dr','name':'B.Pegawai - Jasa UGD Dr'});
    menuedit.push({'value':'B.Pegawai - Jasa Partus Bidan','name':'B.Pegawai - Jasa Partus Bidan'});
    menuedit.push({'value':'B.Pegawai - Jasa Cuci Kain OK + Kain Pasien','name':'B.Pegawai - Jasa Cuci Kain OK + Kain Pasien'});
    menuedit.push({'value':'B.Pegawai - Lembur Karyawan','name':'B.Pegawai - Lembur Karyawan'});
    menuedit.push({'value':'B.Pegawai - THR Karyawan','name':'B.Pegawai - THR Karyawan'});
    menuedit.push({'value':'B.Pegawai - Beli Baju Dinas Karyawan','name':'B.Pegawai - Beli Baju Dinas Karyawan'});
    menuedit.push({'value':'B.Pegawai - Perjalanan + Pelatihan','name':'B.Pegawai - Perjalanan + Pelatihan'});
    menuedit.push({'value':'B.Pegawai - Konsumsi Karyawan/Uang Daging','name':'B.Pegawai - Konsumsi Karyawan/Uang Daging'});
    
    menuedit.push({'value':'B.Operasional - Pengeluaran Administrasi','name':'B.Operasional - Pengeluaran Administrasi'});
    menuedit.push({'value':'B.Operasional - Pengeluaran Dapur/Menu Pasien','name':'B.Operasional - Pengeluaran Dapur/Menu Pasien'});
    menuedit.push({'value':'B.Operasional - Pengeluaran Laboratorium','name':'B.Operasional - Pengeluaran Laboratorium'});
    menuedit.push({'value':'B.Operasional - Pengeluaran Obat-Obatan','name':'B.Operasional - Pengeluaran Obat-Obatan'});
    menuedit.push({'value':'B.Operasional - Pengeluaran Mobil','name':'B.Operasional - Pengeluaran Mobil'});
    menuedit.push({'value':'B.Operasional - Pengeluaran Listrik + Kain Pasien','name':'B.Operasional - Pengeluaran Listrik + Kain Pasien'});
    menuedit.push({'value':'B.Operasional - Pengeluaran Air','name':'B.Operasional - Pengeluaran Air'});
    menuedit.push({'value':'B.Operasional - Pengeluaran Telepon','name':'B.Operasional - Pengeluaran Telepon'});
    menuedit.push({'value':'B.Operasional - Pengeluaran Inventaris','name':'B.Operasional - Pengeluaran Inventaris'});
    menuedit.push({'value':'B.Operasional - Pemeliharaan Sarana','name':'B.Operasional - Pemeliharaan Sarana'});

    menuedit.push({'value':'Pengeluaran Lain-Lain','name':'Pengeluaran Lain-Lain'});   

    menueditSelects.push(menuedit);


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

    	swal({   title: "<h2>Apakah anda yakin dengan data ini ?</h2>!",   text: message,   html: true ,showCancelButton: true,   confirmButtonColor: "#4682B4",   confirmButtonText: "Simpan",   closeOnConfirm: false}

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
     // $scope.editButton = function (id_transaksi,no_transaksi,item_transaksi,uraian,biaya,jenis) {
   //  if (jenis==1) {
   //      var pilihan = [];
   //      pilihan = menueditSelects[0];

   //  }
   //  swal.withForm({
   //      title: 'Edit Transaksi',
   //      text: 'Pengubahan Transaksi Hari Ini',
   //      showCancelButton: true,
   //      confirmButtonColor: '#228B22',
   //      confirmButtonText: 'Konfirmasi',
   //      closeOnConfirm: true,
   //      formFields: [
   //        { id: 'uraian', placeholder: 'Nomor Transaksi',value:no_transaksi,title:'Nomor Transaksi' },
   //        { id: 'uraian', placeholder: 'Uraian',value:uraian,title:'Uraian ' },
   //        { id: 'biaya', placeholder: 'Biaya',value:biaya,title:'Biaya'  },
   //        { id: 'test', type: 'radio',value:'1',name:'Masuk'  },
   //          { id: 'test', type: 'radio',value:'2',name:'keluar'  },
   //        { id: 'select', type: 'select', options: [
          
   //            {value: 'VK- Persalinan', text: 'VK- Persalinan'},
   //            {value: 'test2', text: 'test2'},
   //            {value: 'test3', text: 'test3'},
   //            {value: 'test4', text: 'test4'},
   //            {value: 'test5', text: 'test5'}
   //        ]}
          
   //      ]
   //    }, function (isConfirm) {
   //      // do whatever you want with the form data
   //      console.log(this.swalForm) // { name: 'user name', nickname: 'what the user sends' }
   //    })
   //  setTimeout(function(){ $('.sweet-alert.showSweetAlert.visible').css('margin-top',"-300px");console.log('change') }, 500);
    
   //  }

   $scope.editButton = function (id_transaksi,no_transaksi,item_transaksi,uraian,biaya) {
 
    swal.withForm({
        title: 'More complex Swal-Forms example',
        text: 'This has different types of inputs',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Get form data!',
        closeOnConfirm: true,
        formFields: [
          { id: 'uraian', placeholder: 'Nomor Transaksi',value:no_transaksi,title:'Nomor Transaksi' },
          { id: 'uraian', placeholder: 'Uraian',value:uraian,title:'Uraian ' },
          { id: 'biaya', placeholder: 'Biaya',value:biaya,title:'Biaya '  },
          { id: 'select', type: 'select', options: [
              {value: 'VK- Persalinan', text: 'VK- Persalinan'},
              {value: 'test2', text: 'test2'},
              {value: 'test3', text: 'test3'},
              {value: 'test4', text: 'test4'},
              {value: 'test5', text: 'test5'}
          ]}
          
        ]
      }, function (isConfirm) {
        // do whatever you want with the form data
        console.log(this.swalForm) // { name: 'user name', nickname: 'what the user sends' }
      })
    setTimeout(function(){ $('.sweet-alert.showSweetAlert.visible').css('margin-top',"-300px");console.log('change') }, 500);
    
    }
});
