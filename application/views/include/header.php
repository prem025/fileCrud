<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   
    <title><?php echo $heading; ?></title>
  
    <link href="<?php echo base_url('assets'); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets'); ?>/vendor/sweetalert/sweetalert.css" rel="stylesheet">
    
    <link href="<?php echo base_url('assets'); ?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link href="<?php echo base_url('assets'); ?>/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <script src="<?php echo base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
</head>

<body>
 
<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
</script>
    

<div class="content-wrapper">

<div class="card-body">
   
<style>
    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url("<?php echo base_url('assets/img/load.gif'); ?>") 50% 50% no-repeat rgba(0, 0, 0, 0.42);
        background-size: 140px;
    }

    table.dataTable.nowrap th,
    table.dataTable.nowrap td {
        white-space: normal !important;
    }

    table.dataTable th,
    table.dataTable td {
        white-space: normal !important;
    }
</style>
<div id="loading" class="loader"></div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#loading').hide();
        $.ajaxSetup({
            beforeSend: function() {
                $("#loading").show();
            },
            complete: function() {
                $("#loading").hide();
            }
        });
    });
</script>
<?php


$this->load->view($view, $data);

$this->load->view('include/footer');
?>