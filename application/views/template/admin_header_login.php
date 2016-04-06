<!DOCTYPE html>
<html lang="en">

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
	<link href="<?php echo base_url('assets/css/signin.css')?>" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?php echo base_url('assets/font-awesome-4.2.0/css/font-awesome.min.css')?>" rel="stylesheet">

	<!-- jQuery -->
	<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/dataTables/jquery.dataTables.js')?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/dataTables/dataTables.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('assets/js/ajaxfileupload.js')?>"></script>


	<!--LEAFLET-->
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
	<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>


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
			<div class="navbar-header">
				<img style="padding-top:3px;padding-left:3px;" class="nav navbar-top-links navbar-left" height="42" widtth="42" src="<?php  echo base_url()?>assets/img/logo.jpeg"> 
			
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html">Sistem Informasi RSU Aisyiyah Padang</a>
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<li>
					<form method="POST" action="root" id="formact">
						<input type="hidden" id="actmenu" name="actmenu">
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
							        $bulan="Januari";
							        break;
								case 2:
							        $bulan="Februari";
							        break;
							    case 3:
							        $bulan="Maret";
							        break;
							    case 4:
							        $bulan="April";
							        break;
							    case 5:
							        $bulan="Mei";
							        break;    							        
							    case 6:
							        $bulan="Juni";
							        break;
							    case 7:
							        $bulan="Juli";
							        break;
							    case 8:
							        $bulan="Agustus";
							        break;
							    case 9:
							        $bulan="September";
							        break;
							    case 10:
							        $bulan="Oktober";
							        break;    							        
							    case 11:
							        $bulan="November";
							        break;
							    case 12:
							        $bulan="Desember";
							        break;
								}
						 ?>
						Tanggal : <?php echo $hari," / ",$tanggal," ",$bulan," ",$tahun; ?>
					</form>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="#"><i class="fa fa-user fa-fw"></i> Login</a>
						</li>
						
					</ul>
					<!-- /.dropdown-user -->
				</li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->

		
			<!-- /.navbar-static-side -->
			
		</nav>



	
