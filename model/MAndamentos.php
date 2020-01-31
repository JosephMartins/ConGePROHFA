<?php

@session_start();
//Substituir require_once por _SESSION['PATH'];
require_once 'C:/xampp/htdocs/frame_atualizado/controller/controller.php';

class MAndamentos extends controller {

    function buscarAndamentos($cod_conta) {
        $this->sql = "SELECT an.*, si.situacao FROM tbandamento as an
        INNER JOIN tbsituacao AS si ON si.cod_sit = an.cod_sit WHERE an.cod_conta = $cod_conta";
        return $this->query();
    }

}

?>