<?php

include_once ('../framework.php');
$ObjMante   = new Mantenimientos();
$ObjEjec    = new ejecutorSQL();
$id_user    = $_GET['id_user'];
$id_cia     = $_GET['id_cia'];
$dateFrom   = $_GET['date_from'];
//$dateTo     = $_GET['date_to'];
$AREA       = $_GET['area'];
echo $USERS      = $_GET['users'];

$realMonth1 = explode('-', $dateFrom);
//$realMonth2 = explode('-',$dateTo);

$DIGITOS	=	array('0','1','2','3','4','5','6','7','8','9','10','11','12');	
$MESES_ASSOC=	array('XXX','01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo',
            '06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');		
$MESES		=	array('XXX','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$DIGITOS2	=	array('0','01','02','03','04','05','06','07','08','09','10','11','12');


if (isset($_GET['generate']) && $_GET['generate'] == 1) {
    // echo $MESES_ASSOC[$realMonth1[1]];
    /*
        1. Buscar la formula de acuerdo al area seleccionada
        2. Saber el tipo de horario que solicitan
        3. Saber el grupo
        4. Contar para cuantos usuarios se requiere tirar el turno
        5. Saber para cuantos meses		
    */	

    /** Parameters */
    $date			=	date('Y-m-d');
    $P_ParaCuantos	=	false;	
    $P_Data			=	false;
    $Letra			=	false;
    $clave			=	false;
    $error			=	0;
    //$P_Tot			=	count($id_user);
    // for($x	=	0	;	$x		<	$id_user	;	$x++) {
    //     if($P_Data!='') {
    //         $P_Data .=  '-';
    //     }
    //     $P_Data			.=	$area[$x];
    // }
    $P_Data			=	$AREA;

    // CREAR LA TABLA TEMPORAL
    // ***********************
    $NAREASQL_	=	$ObjMante->BuscarLoQueSea("*",PREFIX."mant_areas","id='".$P_Data."'","extract");
    $NombArea	=	$NAREASQL_['name'];
    $NAMETBLTMP	=	PREFIX.'rolturn_'.strtolower($NAREASQL_['id']);
    $ObjEjec->vaciarTabla($NAMETBLTMP);	
    $l = $ObjEjec->ejecutarSQL('CREATE TABLE '.$NAMETBLTMP.' (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id)) AS SELECT * FROM '.PREFIX.'rolturn_tmp');
    
    $TOTAL_CAMPOS = $USERS;			
    //$N_Area		=	$objMante->BuscarLoQueSea('*' ,'911_mant_areas', 'id="'.$P_Data.'" and activo = 1','extract');
    //if($POST_ngrupo!=''): $POST_ngrupo = ' , - GRUPO : '.$POST_ngrupo; endif;
    //$P_Areas	=  strtoupper('Para: '.$TOTAL_CAMPOS.' usuarios, - area: '.substr($N_Area['nombre'],0,20)).$POST_ngrupo;


}

?>
