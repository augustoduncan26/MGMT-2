<?php
	require_once( dirname(__FILE__) . '/framework.php' );
	global $link;
	//echo session_id(); exit;
	 $Objejec 		=  	new ejecutorSQL();
	 $Objejec->borrarRegistro("session","id_session = '".session_id()."'");
	//mysqli_query($link,"Delete from session where id_session = '".session_id()."'");
?>
<script>location.href='login'</script>
