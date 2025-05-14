<!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <!--<![endif]-->
        <link rel="stylesheet" href="assets/css/custom.min.css">

        <script src="assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
        <script src="assets/plugins/blockUI/jquery.blockUI.js"></script>
        <script src="assets/plugins/iCheck/jquery.icheck.min.js"></script>
        <script src="assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
        <script src="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
        <script src="assets/plugins/less/less-1.5.0.min.js"></script>
        <script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
        <script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
        <script src="assets/js/main.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->
         
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script src="assets/plugins/flot/jquery.flot.js"></script>
        <script src="assets/plugins/flot/jquery.flot.pie.js"></script>
        <script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="assets/plugins/jquery.sparkline/jquery.sparkline.js"></script>
        <script src="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
        <script src="assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
        <script src="assets/plugins/FullCalendar/fullcalendar/fullcalendar.js"></script>
        <!-- <script src='../assets/plugins/FullCalendar/js/fullcalendar/fullcalendar.js'></script> -->
        <script src="assets/js/index.js"></script>

        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="assets/plugins/bootstrap-paginator/src/bootstrap-paginator.js"></script>
		<script src="assets/plugins/jquery.pulsate/jquery.pulsate.min.js"></script>
		<script src="assets/plugins/gritter/js/jquery.gritter.min.js"></script>
		<script src="assets/js/ui-elements.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

        <!-- New Full Calendar Plugin -->
        
        <!-- end: New Full Calendar Plugin -->

        
        <!-- <script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="assets/js/login.js"></script> -->

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
        <script src="<?php echo $_ENV['FLD_ASSETS']?>/plugins/select2/select2-new.min.js"></script>

        <script>
            jQuery(document).ready(function() {
                Main.init();
                //Login.init();
                //Index.init();
                //UITreeview.init();
                UIElements.init();

                // Go to Top page
                jQuery('.go-top').on('click', ()=> {
                    jQuery('html, body').animate({scrollTop: '0px'}, 'slow');
                });
            });

        $('.close').on('click', ()=>{
            window.location.reload();
        });
        $('.btn-danger').on('click', ()=>{
            window.location.reload();
        });

        
        </script>

<!-- <script src="components/like_buton.js"></script> -->