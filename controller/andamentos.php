<?php

@session_start();
//Substituir require_once por _SESSION['PATH'];
require_once 'C:/xampp/htdocs/frame_atualizado/model/MAndamentos.php';

class Andamentos extends MAndamentos {

    function inicio() {
        return 'Módulo andamentos criado com sucesso';
    }

    function cadastrarAndamento() {
        $arrDadosForm = $_POST['arrDadosForm'];

        $resultadoInsert = $this->insert($arrDadosForm);

        if ($resultadoInsert == TRUE) {
            $this->redirect('1', "andamentos/listarAndamentos/" . $arrDadosForm['cod_conta']);
        } else {
            $this->redirect('2', "andamentos/listarAndamentos/" . $arrDadosForm['cod_conta']);
        }
    }

    function listaAndamento($cod_conta) {
        return $this->buscarAndamentos($cod_conta);
    }

    function deletar() {
        $arrDadosForm = $_POST['arrDadosForm'];
        $resultDelete = $this->delete($arrDadosForm);
        $this->redirect('1', "andamentos/listarAndamentos/" . $arrDadosForm['cod_conta'] . "/" . $arrDadosForm['prontuario']);
    }

}

$oAndamentos = new Andamentos();
$classe = 'Andamentos';
$oBjeto = $oAndamentos;
@include_once '../application/request.php';
?>