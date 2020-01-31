<?php

@session_start();
//Substituir require_once por _SESSION['PATH'];
require_once 'C:/xampp/htdocs/frame_atualizado/model/MPaciente.php';

class Paciente extends MPaciente {

    function inicio() {
        return 'Módulo paciente criado com sucesso';
    }

    function cadastrar() {
        $arrDadosForm = $_POST['arrDadosForm'];
        $resultCadastro = $this->insert($arrDadosForm);
        if ($resultCadastro == true) {
            $this->redirect('1', "paciente/listarPaciente");
        } else {
            $this->redirect('16', "paciente/listarPaciente");
        }
    }

    function deletar($arrDadosForm) {
        $resultDelete = $this->delete($arrDadosForm);

        if ($resultDelete == true) {
            $this->redirect('17', "paciente/listarPaciente");
        } else {
            $this->redirect('2', "paciente/listarPaciente");
        }
    }

    function listarPaciente() {
        $id = $_POST['nrpront'];
        $resultadoListarPaciente = $this->listaDados('tbpacientes', $id, null, 'nr_prontmv');
        while ($paciente = mysqli_fetch_array($resultadoListarPaciente)) {
            $pacienteJson = array(
                "nome" => $paciente['nome'],
                "prontuario" => $paciente['nr_prontmv'],
                "convenio" => $paciente['cod_convenio'],
                "id" => $id
            );
        }

        echo json_encode($pacienteJson);
    }

    function alterarPaciente() {
        $arrDadosForm = $_POST['arrDadosForm'];
        $resultadoUpdate = $this->update($arrDadosForm);
        if ($resultadoUpdate == true) {
            $this->redirect('1', "paciente/listarPaciente");
        } else {
            $this->redirect('2', "paciente/listarPaciente");
        }
    }

}

$oPaciente = new Paciente();
$classe = 'Paciente';
$oBjeto = $oPaciente;
@include_once '../application/request.php';
?>