<?php

@session_start();
//Substituir require_once por _SESSION['PATH'];
require_once 'C:/xampp/htdocs/frame_atualizado/controller/controller.php';

class MContas extends controller {

    function consultaConvenio($convenio)
    {
        $this->sql = "SELECT * FROM tbconvenio WHERE descricao = '$convenio'";
        return $this->query();
    }

    function listarConta()
    {
        $this->sql = "SELECT p.nome, c.* FROM tbpacientes AS p
        INNER JOIN tbconta as c ON p.nr_prontmv = c.nr_prontuario";
        $result = $this->query();
        return $result;
    }

    function listarContaPaciente($nr_prontuario)
    {
        $this->sql = "SELECT p.nome, c.* FROM tbpacientes AS p
        INNER JOIN tbconta as c ON p.nr_prontmv = c.nr_prontuario AND p.nr_prontmv = $nr_prontuario";
        $result = $this->query();
        return $result;
    }

}

?>