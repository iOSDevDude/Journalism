<!DOCTYPE html>
	<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title>KSC Journalism</title>

		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo asset_url() ?>css/foundation.css" />

		<!-- Add new stylesheets after this comment -->

		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paradeiser/0.4.2/min/paradeiser.min.css">
		<link rel="stylesheet" href="<?php echo asset_url() ?>css/main.css" />
</head>
<body>
	<nav class="paradeiser">

		<?php if( $this->session->userdata('usertype') == "3" ){ ?>
		     <a href="<?php echo site_url('studentlist') ?>" class="<?php echo($pageTitle == "list" ? "active" : "not-active")?>">
		         <span>Student List</span>
		     </a>
		     <a href="<?php echo site_url('stats') ?>" class="<?php echo($pageTitle == "stats" ? "active" : "not-active")?>">
		         <span>Statistics</span>
		     </a>
		<?php } ?>
	    <a href="<?php echo site_url('login') ?>" id="logOutTab">
	        <span>Logged in as: <?php echo ($this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'))?></span>
	        <span>Click here to log out</span>
	    </a>
	</nav>