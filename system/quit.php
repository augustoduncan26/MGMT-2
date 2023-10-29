<?php
	require_once( dirname(__FILE__) . '/framework.php' );
	global $link;
	//echo session_id(); exit;
	 $Objejec 		=  	new ejecutorSQL();
	 $Objejec->borrarRegistro(PREFIX."session","id_session = '".session_id()."'");
	 unset($_SESSION["id_user"]) ;
	 unset($_SESSION["username"]) ;
	 unset($_SESSION["id_session"]) ;
	 unset($_SESSION["lastname"]) ;
	 unset($_SESSION["email"]) ;
	 unset($_SESSION["id_cia"]) ;

?>
<script>location.href='login'</script>
