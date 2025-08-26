  <head>
        <title><?=$_ENV['APP_NAME']?></title>
        <!-- start: META -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->


        <!-- start: MAIN CSS -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/modal-style.css" type="text/css" />
        <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/style.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/main-responsive.css">
        <link rel="stylesheet" href="assets/plugins/iCheck/skins/all.css">
        <link rel="stylesheet" href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
        <link rel="stylesheet" href="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">

        <!-- Diferent Styles -->
        <link rel="stylesheet" href="assets/css/theme_navy.css" type="text/css" id="skin_color">
        <!-- /End Diferent Styles -->

        <link rel="stylesheet" href="assets/css/print.css" type="text/css" media="print"/>
        
        <!-- Include JQuery -->
        
        <script src="assets/plugins/jquery-min/jquery.min.js"></script>
        <script src="assets/plugins/jquery-min/jquery-ui.js"></script>
        
        <!-- End JQuery -->

    
        <!-- JS -->
        <script src="assets/js/functions.js"></script>

        <script src="assets/js/jquery-validate/jquery.validate.min.js"></script>
        <script src="assets/js/jquery-validate/additional-methods.min.js"></script>

        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="icon" type="image/x-icon" href="assets/images/template/mgmt_logo_transparent.ico" />
        
        <!-- Modal Styles / modal-sm / modal-md / modal-lg -->

        
        <!-- Load React with Babel -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.4.2/react.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.4.2/react-dom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.21.1/babel.min.js"></script>

         <!-- Load React. -->
        <!-- Note: when deploying, replace "development.js" with "production.min.js". -->
        <script src="https://unpkg.com/react@18/umd/react.production.min.js" crossorigin></script>
        <script src="https://unpkg.com/react-dom@18.3.1/umd/react-dom.production.min.js" crossorigin></script>
        <!-- // End load react -->

        <!-- 
        For all Pages
        - Select2
        - Font awesome
        - Side bar Modal 
        -->
        <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_ENV['FLD_ASSETS']?>/css/bootstrap_modal_right_sider_bar.css" />
        

        <!-- start: CSS >Gritter Notifications< -->
		<link rel="stylesheet" href="assets/plugins/gritter/css/jquery.gritter.css">
		<!-- end: CSS-->

        <!-- FullCalendar -->
        <link rel="stylesheet" href="assets/plugins/FullCalendar/fullcalendar/fullcalendar.css">
        <!-- FullCalendar -->

</head>
    <!-- end: HEAD -->


<script type="text/javascript">
    function nuevoAjax(){
        var xmlhttp=false;
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (E) {
                xmlhttp = false;
            }
        }
        if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
            xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
    }

</script>

<style>
/* Poner scroll a los modals*/
.modal-body{
    height: 250px;
    overflow-y: auto;
}

@media (min-height: 500px) {
    .modal-body { height: 400px; }
}

@media (min-height: 800px) {
    .modal-body { height: 600px; }
} 
</style>
<!-- End Header -->