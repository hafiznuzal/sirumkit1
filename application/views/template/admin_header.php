<!DOCTYPE html>
<html lang="en" ng-app="rumahSakit">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Sistem Informasi RSU Aisyiyah Padang</title>


	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url('assets/css/bootstrap.css')?>" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="<?php echo base_url('assets/css/plugins/metisMenu/metisMenu.min.css')?>" rel="stylesheet">

	<!-- Timeline CSS -->
	<link href="<?php echo base_url('assets/css/plugins/timeline.css')?>" rel="stylesheet">


	<!-- Custom CSS -->
	<link href="<?php echo base_url('assets/css/sb-admin-2.css')?>" rel="stylesheet">


	<!-- Morris Charts CSS -->
	<link href="<?php echo base_url('assets/css/plugins/morris.css')?>" rel="stylesheet">


	<!-- Custom Fonts -->
	<link href="<?php echo base_url('assets/font-awesome-4.2.0/css/font-awesome.min.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/sweetalert/dist/sweetalert.css')?>" rel="stylesheet">

	<!-- jQuery -->
	<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>


	<script src="<?php echo base_url('assets/js/moment.js')?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js')?>"></script>
	<link href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css')?>" rel="stylesheet">

	<!-- <link href="<?php echo base_url('assets/css/jquery-ui.theme.min.css')?>" rel="stylesheet"></script> -->
	<!-- <link href="<?php echo base_url('assets/css/jquery-ui.structure.min.css')?>" rel="stylesheet"></script> -->

	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/dataTables/jquery.dataTables.js')?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/dataTables/dataTables.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('assets/js/ajaxfileupload.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootbox.js')?>"></script>

	<!--LEAFLET-->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/leaflet.css')?>" />
	
	<script src="<?php echo base_url('assets/js/leaflet.js')?>"></script>

	

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>

	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header" >

			<img class="nav navbar-top-links navbar-left" style="padding-top:3px;padding-left:3px;" height="42" widtth="42" src="<?php  echo base_url()?>/assets/img/logo.jpeg"> 
			
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" style="margin-bottom: ">Sistem Informasi RSU Aisyiyah Padang </a>
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<li>
					<form method="POST" action="<?php echo site_url() ?>admin/updatePeriode" id="formact">
						<input type="hidden" id="actmenu" name="actmenu">
						<input type="hidden" id="uri" name="uri" value="<?php echo base_url(uri_string()); ?>">
						<?php
							switch ($hari) 
							{
							    case "Sunday":
							        $hari="Minggu";
							        break;
								case "Monday":
							        $hari="Senin";
							        break;
							    case "Tuesday":
							        $hari="Selasa";
							        break;
							    case "Wednesday":
							        $hari="Rabu";
							        break;
							    case "Thursday":
							        $hari="Kamis";
							        break;    							        
							    case "Friday":
							        $hari="Jum'at";
							        break;
							    case "Saturday":
							        $hari="Sabtu";
							        break;
							}

							switch ($bulan) {
							    case 1:
							        $nama_bulan="Januari";
							        break;
								case 2:
							        $nama_bulan="Februari";
							        break;
							    case 3:
							        $nama_bulan="Maret";
							        break;
							    case 4:
							        $nama_bulan="April";
							        break;
							    case 5:
							        $nama_bulan="Mei";
							        break;    							        
							    case 6:
							        $nama_bulan="Juni";
							        break;
							    case 7:
							        $nama_bulan="Juli";
							        break;
							    case 8:
							        $nama_bulan="Agustus";
							        break;
							    case 9:
							        $nama_bulan="September";
							        break;
							    case 10:
							        $nama_bulan="Oktober";
							        break;    							        
							    case 11:
							        $nama_bulan="November";
							        break;
							    case 12:
							        $nama_bulan="Desember";
							        break;
}
						 ?>
						Tanggal : <?php echo $hari," / ",$tanggal," ",$nama_bulan," ",$tahun; ?>
						<!-- <select id="tahun" name="tahun">
						    
						    <?php  for ($i=$tahun-3; $i <$tahun ; $i++) { ?> 
						    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						    <?php } ?>	
						    
						    <option value="<?php echo $tahun; ?>" selected><?php echo $tahun; ?></option>
						    <?php  for ($i=$tahun+1; $i <$tahun+3; $i++) { ?> 
						    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						    <?php } ?>	
						    
						</select>
						Triwulan: <select id="periode" name="periode">
						    <option value="1" <?php if($bulan==1) echo "selected";?>>1</option>
						    <option value="2" <?php if($bulan==2) echo "selected";?>>2</option>
						    <option value="3" <?php if($bulan==3) echo "selected";?>>3</option>
						    <option value="4" <?php if($bulan==4) echo "selected";?>>4</option>
						</select> -->
					</form>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<!--<?php if($hak=='admin'){ ?>
						<li><a style="color:#e74c3c;" href="<?php echo site_url('/admin/manage_user');?>"><i class="fa fa-users fa-fw"></i> Manage User</a>
						</li>
						<li class="divider"></li>
						<?php } ?>-->
						<li><a href="<?php echo base_url('logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li>
							<a href="<?php echo base_url('/admin/index');?>"><i class="fa fa-home fa-fw"></i> Halaman Utama</a>
						</li>
						
						<li>
							<a href="<?php echo base_url('/admin/pasien');?>"><i class="fa fa-wheelchair fa-fw"></i> Transaksi</a>
						</li>
						<!-- <li>
							<a href="<?php echo site_url('/admin/pengembang');?>"><i class="fa fa-stethoscope fa-fw"></i> Rekam Medik</a>
						</li> -->
						<!-- <li>
							<a href="<?php echo site_url('/admin/perumahan')?>"><i class="fa fa-medkit fa-fw"></i> Apotek</a>
						</li> -->

						<!-- <li>
							<a href="#"><i class="fa fa-medkit fa-fw"></i> Apotek<span class="fa arrow"></span></a>
	                            <ul class="nav nav-second-level">
	                                <li>
										<a href="<?php echo site_url('/admin/perumahan')?>"><i class="fa fa-database fa-fw"></i> Inventori Obat</a>
									</li>
									
	                                <li>
	                                	<a href="<?php echo site_url('/report/report_pembangunan_perkecamatan').'/'.'1'.'/'.$tahun.'/'.$bulan?>" ><i class="fa fa-money fa-fw"></i> Transaksi </a>
									</li>
									
	                            </ul>
                        </li> -->
						<?php $jenisopt = 1;  ?>
						<li>
							<a href="#"><i class="fa fa-file-text fa-fw"></i> Laporan<span class="fa arrow"></span></a>
	                            <ul class="nav nav-second-level">
	                                <li>
										<a href="<?php echo base_url('/report/laporan_harian').'/'.$tanggal.'/'.$bulan.'/'.$tahun.'/'.$jenisopt?>" ><i class="fa fa-file-text-o fa-fw"></i> Laporan Harian</a>
									</li>
									
	                                <li>
	                                	<a href="<?php echo base_url('/report/laporan_bulanan').'/'.$bulan.'/'.$tahun.'/'.$jenisopt?>" ><i class="fa fa-file-text-o fa-fw"></i> Laporan Bulanan</a>
									</li>

									<li>
	                                	<a href="<?php echo base_url('/report/report_tahunan').'/'.$tahun?>" ><i class="fa fa-file-text-o fa-fw"></i> Laporan Tahunan</a>
									</li>

									<!-- <li>
	                                	<a href="<?php echo site_url('/report/rekapitulasi_lahan_kecamatan').'/'.$tahun.'/'.$bulan?>" ><i class="fa fa-file-text-o fa-fw"></i> Rekapitulasi Lahan Kecamatan Se Kabupaten Sidoardjo</a>
									</li> -->
	                            </ul>
                        </li>
						<!-- <li>
							<a href="#"><i class="fa fa-file-text fa-fw"></i> Laporan Apotek<span class="fa arrow"></span></a>
	                            <ul class="nav nav-second-level">
	                                <li>
										<a href="<?php echo site_url('/report/report_pembangunan').'/'.$tahun?>" ><i class="fa fa-file-text-o fa-fw"></i> Laporan Tahunan</a>
									</li>
									
	                                <li>
	                                	<a href="<?php echo site_url('/report/report_pembangunan_perkecamatan').'/'.'1'.'/'.$tahun.'/'.$bulan?>" ><i class="fa fa-file-text-o fa-fw"></i> Laporan Bulanan</a>
									</li>

									
	                            </ul>
                        </li>
                        <li>
							<a href="<?php echo site_url('/admin/lokasi')?>"><i class="fa fa-users fa-fw"></i> Karyawan</a>
						</li>

                        <li>
							<a href="<?php echo site_url('/report/laporan_chart')?>"><i class="fa fa-line-chart fa-fw"></i> Statistik Pasien</a>
						</li>

						<li>
							<a href="<?php echo site_url()?>admin/logout"><i class ="fa fa-power-off fa-fw"></i>Logout</a>
							
						</li> -->
					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
			<script type="text/javascript">
				$(document).ready(function(){
					$("#tahun").change(function(){
						$("#actmenu").val="changeTahun";
						$("#formact").submit();
					});
					$("#periode").change(function(){
						$("#actmenu").val="changePeriode";
						$("#formact").submit();
					});
				});
			</script>
		</nav>



	
