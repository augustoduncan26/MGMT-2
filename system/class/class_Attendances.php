<?php
/**
 * Attendances
 */


class Attendances
{
    private $exito;
    private $tableAttendance;
    private $tableAssignment;
    private $idCia;
    private $idUser;

    public function __construct()
    {
        $this->tableAttendance = PREFIX.'attendance';
        $this->tableAssignment = PREFIX.'assignment';
        $this->idCia    = $_SESSION['id_cia'];
        $this->idUser   = $_SESSION['id_user'];
        $this->exito    = '';
    }

    public function showAll () 
	{
        $ObjMante       =   new Mantenimientos();
        $where          = false;
        if ($_SESSION['id_rol']!=100) {
            $where = ' and teacher_id = '.$this->idUser;
        }
            $this->exito    =   $ObjMante->BuscarLoQueSea('*',$this->tableAttendance,'id_cia = '.$this->idCia.$where,'array');
        if ($this->exito['total'] > 0) {
            return $this->exito;
        } else {
            return false;    
        }
	}

    public function getTotalStudents ( $id ) 
	{
        $ObjMante       =   new Mantenimientos();
        $this->exito    =   $ObjMante->BuscarLoQueSea('*',$this->tableAttendance,'assignment_id = "'.$id.'"and id_cia = '.$this->idCia,'array');

        if ($this->exito['total'] > 0) {
            return $this->exito['total'];
        } else {
            return 0;    
        }
	}

    public function save () 
	{
		return true;
	}

    public function update () 
	{
		return true;
	}

    public function delete () 
	{
		return true;
	}

    public function saveAssociate () 
	{
		return true;
	}
}


