<?php

@session_start();
require_once $_SESSION['PATH']. 'controller/controller.php';
class MUsuario extends controller{
    
    function listarUsuario($id=null, $order=null){
        (($id>0) ? $where = " WHERE id_usuario = {$id}" : $where = null);
        ((!empty($order)) ? $order = " ORDER BY str_nome " : $order = null);

        $this->sql = " SELECT u.*, p.str_perfil
                       FROM gr_usuario AS u
                       LEFT JOIN gr_perfil AS p ON p.id_perfil = u.id_perfil
                       $where
                       $order"; 
           
        return $this->query();
        
    }
	
}

?>