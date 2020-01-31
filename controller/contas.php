<?php

@session_start();
//Substituir require_once por _SESSION['PATH'];
require_once 'C:/xampp/htdocs/frame_atualizado/model/MContas.php';

class Contas extends MContas {

    function inicio() {
        return 'Módulo contas criado com sucesso';
    }

    function cadastrarConta() {
        $arrDadosForm = $_POST['arrDadosForm'];
        //valiandando numero de dias
        $dataInterna = new DateTime($arrDadosForm['dt_interna']);
        $dataAlta = new DateTime($arrDadosForm['dt_alta']);

        $dateInterval = $dataInterna->diff($dataAlta);
        $dias = $dateInterval->days;
        $arrDadosForm['nrdias'] = $dias;
        //fim validadando dias
        //convertendo convenio para o codigo
        $convenio = $arrDadosForm['cod_convenio'];
        $resultadoListaConvenio = $this->consultaConvenio($convenio);
        $cod_convenio = mysqli_fetch_array($resultadoListaConvenio);
        $arrDadosForm['cod_convenio'] = $cod_convenio['cod_convenio'];
        //fim convertendo convenio
        $resultadoInsert = $this->insert($arrDadosForm);
        if ($resultadoInsert == true) {
            $this->redirect('1', "contas/contaPaciente" . "/" . $arrDadosForm['nr_prontuario']);
        } else {
            $this->redirect('2', "contas/contaPaciente" . "/" . $arrDadosForm['nr_prontuario']);
        }
    }

    function buscaConvenio() {
        $prontuario = $_POST['nrProntuario'];
        $resultadoListar = $this->listaDados('tbpacientes', $prontuario, null, 'nr_prontmv');
        $dadosPaciente = mysqli_fetch_array($resultadoListar);

        $convenio = $dadosPaciente['cod_convenio'];

        $resultadoConvenio = $this->listaDados('tbconvenio', $convenio, null, 'cod_convenio');
        $convenioPaciente = mysqli_fetch_array($resultadoConvenio);

        $arrConvenio = array();
        $arrConvenio['convenio'] = $convenioPaciente['descricao'];

        echo json_encode($arrConvenio);
    }

    function listaTodasContas() {
        return $this->listarConta();
    }

    function listarContasDoPaciente($nr_prontuario) {
        return $this->listarContaPaciente($nr_prontuario);
    }

    function listEditConta() {
        $cod_conta = $_POST['cod_conta'];
        $resultadoConsultaConta = $this->listaDados('tbconta', $cod_conta, null, 'cod_conta');
        $conta = array();
        while ($dadosConta = mysqli_fetch_array($resultadoConsultaConta)) {
            $conta['cod_conta'] = $dadosConta['cod_conta'];
            $conta['nr_conta'] = $dadosConta['nr_conta'];
            $conta['nr_prontuario'] = $dadosConta['nr_prontuario'];
            $conta['nr_atendimento'] = $dadosConta['nr_atendimento'];
            $conta['vlr_preglosa'] = $dadosConta['vlr_preglosa'];
            $conta['vlr_posglosa'] = $dadosConta['vlr_posglosa'];
            $conta['nr_protocmv'] = $dadosConta['nr_protocmv'];
            $conta['gau'] = $dadosConta['gau'];
            $conta['tipo'] = $dadosConta['tipo'];
            $conta['dt_recbcta'] = $dadosConta['dt_recbcta'];
            $conta['dt_interna'] = $dadosConta['dt_interna'];
            $conta['dt_alta'] = $dadosConta['dt_alta'];
            $conta['origem'] = $dadosConta['origem'];
            $conta['cod_convenio'] = $dadosConta['cod_convenio'];
            $conta['cod_auditor'] = $dadosConta['cod_auditor'];
            $conta['vlr_difglosa'] = $dadosConta['vlr_difglosa'];
        }
        echo json_encode($conta);
    }

    function alterarConta() {
        $arrDadosForm = $_POST['arrDadosForm'];

        $resultadoEditar = $this->update($arrDadosForm);


        if ($resultadoEditar == true) {
            $this->redirect('1', "contas/contaPaciente" . "/" . $arrDadosForm['nr_prontuario']);
        } else {
            $this->redirect('2', "contas/contaPaciente" . "/" . $arrDadosForm['nr_prontuario']);
        }
    }

}

$oContas = new Contas();
$classe = 'Contas';
$oBjeto = $oContas;
@include_once '../application/request.php';
?>