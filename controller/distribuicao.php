<?php

@session_start();
//Substituir require_once por _SESSION['PATH'];
require_once 'C:/xampp/htdocs/frame_atualizado/model/MDistribuicao.php';

class Distribuicao extends MDistribuicao {

    function inicio() {
        return 'Módulo distribuicao criado com sucesso';
    }

    function tabelaZerada() {
        $resultadoUpdate = $this->zerarTabela();
        if ($resultadoUpdate == TRUE) {
            $this->redirect('1', "auditoria/listarAuditores/");
        } else {
            $this->redirect('2', "auditoria/listarAuditores/");
        }
    }

    function listaTodasContasD() {
        return $this->listarContaD();
    }

    function listarContaFiltro() {

        $grupo = $_POST['grupo'];
        $dt_inicio = date('Y/m/d', strtotime($_POST['dt_inicio']));
        $dt_fim = date('Y/m/d', strtotime($_POST['dt_fim']));
        $arrConta = Array();

        $sessao = $_POST['sessao'];

        $filtros = array(
            'grupo' => $grupo,
            'dt_inicio' => $dt_inicio,
            'dt_fim' => $dt_fim
        );


        $resultadoListar = $this->listarContas($filtros);
        while ($conta = mysqli_fetch_array($resultadoListar)) {
            $arrConta['cod_conta'][] = $conta['cod_conta'];
            $arrConta['nome'][] = $conta['nome'];
            $arrConta['nrdias'][] = $conta['nrdias'];
            $arrConta['data'][] = $conta['data'];
            $arrConta['nr_prontuario'][] = $conta['nr_prontuario'];
        }
        echo json_encode($arrConta);
    }

    function distribuicaoInsert() {
        $this->zeraDias();
        $arrDadosForm = $_POST['arrDadosForm'];
        $sessao = $arrDadosForm['cod_usu'];
        $dt_usu = $arrDadosForm['dt_usu'];
        
        $dt_inicio = date('Y/m/d', strtotime($arrDadosForm['dt_inicio']));
        $dt_fim = date('Y/m/d', strtotime($arrDadosForm['dt_fim']));
        $grupo = $arrDadosForm['grupo'];
        $filtros = array(
            'grupo' => $grupo,
            'dt_inicio' => $dt_inicio,
            'dt_fim' => $dt_fim
        );



        $auditores = $arrDadosForm['auditores'];
        /* for ($i = 0; $i < count($auditores); $i ++) {
          $this->alteraAuditor($auditores[$i]);
          } */

        
        if ($grupo == '1') {
            $resultadoConta = $this->listarContas($filtros);
        } else {
            $resultadoConta = $this->listarContas($filtros);
        }

        while ($conta = mysqli_fetch_array($resultadoConta)) {
            $resultadoMenorDia = $this->listaAuditorMenorDia($auditores);
            $idAuditorMenorDia = mysqli_fetch_array($resultadoMenorDia);
            $nomeAuditorMenorDia = $idAuditorMenorDia['nome'];
            $idAuditorMenorDia = $idAuditorMenorDia['cod_auditor'];


            $diasAdd = $conta['nrdias'];
            $this->alteraDiaAuditor($diasAdd, $idAuditorMenorDia);
            $this->insereAndamento($conta['cod_conta'], $sessao, $dt_usu, $nomeAuditorMenorDia);
        }
        $funfou = true;
        $this->redirect('1', "distribuicao/distribuir/" . $funfou);
    }

}

$oDistribuicao = new Distribuicao();
$classe = 'Distribuicao';
$oBjeto = $oDistribuicao;
@include_once '../application/request.php';
?>