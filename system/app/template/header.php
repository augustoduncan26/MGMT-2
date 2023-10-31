  <head>
        <title>H&H System</title>
        <!-- start: META -->
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
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

        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
        <!-- end: MAIN CSS -->

    
        <!-- JS -->
        <script src="assets/js/functions.js"></script>

        <script src="assets/js/jquery-validate/jquery.validate.min.js"></script>
        <script src="assets/js/jquery-validate/additional-methods.min.js"></script>
       
        <!--[if IE 7]>
        <link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->


      <!--   <link rel="stylesheet" href="assets/css/custom.min.css"> -->


        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="shortcut icon" href="assets/images/template/DC-2.png" />

        <!-- Modal Styles / modal-sm / modal-md / modal-lg -->

         <!-- Load React. -->
        <!-- Note: when deploying, replace "development.js" with "production.min.js". -->
        <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
        <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
        
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