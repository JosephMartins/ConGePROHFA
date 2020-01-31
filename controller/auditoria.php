<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MAuditoria.php';

class Auditoria extends MAuditoria {

    function cadastrarAuditor() {
        $arrDadosForm = $_POST['arrDadosForm'];
        $resultadoInsert = $this->insert($arrDadosForm);

        if ($resultadoInsert == true) {
            $this->redirect('1', 'auditoria/listarAuditores');
        } else {
            $this->redirect('2', 'auditoria/listarAuditores');
        }
    }

    function listEditAuditor() {
        $cod_auditor = $_POST['cod_auditor'];
        $resultadoSelect = $this->listaDados('tbauditor', $cod_auditor, null, 'cod_auditor');
        $arrAuditor = array();
        $auditor = mysqli_fetch_array($resultadoSelect);
        $arrAuditor['nrdias'] = $auditor['nrdias'];
        $arrAuditor['nome'] = $auditor['nome'];
        $arrAuditor['nr_docto'] = $auditor['nr_docto'];
        $arrAuditor['cod_auditor'] = $auditor['cod_auditor'];

        echo json_encode($arrAuditor);
    }

    function alterarAuditor() {
        $arrDadosForm = $_POST['arrDadosForm'];
        $resultadoUpdate = $this->update($arrDadosForm);


        if ($resultadoUpdate == true) {
            $this->redirect('1', 'auditoria/listarAuditores');
        } else {
            $this->redirect('2', 'auditoria/listarAuditores');
        }
    }

    function deletar() {
        $arrDadosForm = $_POST['arrDadosForm'];
        $resultDel = $this->delete($arrDadosForm);

        if ($resultDel == true) {
            $this->redirect('1', 'auditoria/listarAuditores');
        } else {
            $this->redirect('2', 'auditoria/listarAuditores');
        }
    }

}

$oAuditoria = new Auditoria();
$classe = 'Auditoria';
$oBjeto = $oAuditoria;
@include_once '../application/request.php';
?>