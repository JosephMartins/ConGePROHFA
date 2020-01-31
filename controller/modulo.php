<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MModulo.php';

class Modulo extends MModulo {

    function cadastrar($arrDadosForm = null) {
        $arrDadosForm['str_modulo'] = strtolower($this->removeAcentuacao($arrDadosForm['str_modulo']));
        $resultM = $this->verificaModulo($arrDadosForm['tabela'], $arrDadosForm['str_modulo']);
        if (mysqli_num_rows($resultM) > 0) {
            $this->redirect('12', "modulo/listarModulo");
        }

        $result = $this->insert($arrDadosForm);
        $idModuloCriado = $this->maxIdInsert($arrDadosForm['tabela'], 'id_modulo');

        if ($result) {
            $caminho = $_SESSION['PATH'] . 'view/';
            $modulo = $arrDadosForm['str_modulo'];

            if (!is_dir($caminho . $modulo)) {

                if (mkdir($caminho . $modulo, 0777)) {
                    $this->criaModel($modulo);
                    $this->criaController($modulo);
                    $this->criaView($modulo, $idModuloCriado, 'gr_view');
                    $idViewCriado = $this->maxIdInsert('gr_view', 'id_view');
                    $this->permissaoAdministrador($idViewCriado, 'gr_acesso');
                }
            }
        }

        $this->redirect('1', "modulo/listarModulo");
    }

    function alterar($arrDadosForm) {
        $arrDadosForm['str_modulo'] = strtolower($this->removeAcentuacao($arrDadosForm['str_modulo']));
        $result = $this->update($arrDadosForm);
        $this->redirect('1', "modulo/listarModulo");
    }

    function listar($arrDadosForm = null) {
        if (isset($arrDadosForm['idModulo']) and $arrDadosForm['acao'] == 'ajax') {
            $result = $this->listaDados('gr_modulo', $_POST['idModulo'], 'str_modulo');
            while ($arDados = mysqli_fetch_array($result)) {
                $arr['id'] = $arDados['id_modulo'];
                $arr['modulo'] = $arDados['str_modulo'];
            }
            echo json_encode($arr);
        } else {
            return $this->listaDados('gr_modulo', null, 'str_modulo');
        }
    }

    function desativar($arrDadosForm) {
        $result = $this->delete($arrDadosForm);
        $this->redirect('1', "modulo/listarModulo");
    }

   

}

$oModulo = new Modulo();
$classe = 'Modulo';
$oBjeto = $oModulo;
@include_once '../application/request.php';
?>