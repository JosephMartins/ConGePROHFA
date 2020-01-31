<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MUsuario.php';

class Usuario extends MUsuario {

    function cadastrar($arrDadosForm = null) {

//Retira espaços em brancos no inicio e fim
        $str_nome = utf8_decode(trim($arrDadosForm['str_nome']));

//Verifica se nome é vazio ou 'Usuário não encontrado'
        if (($arrDadosForm['str_nome'] == 'Usuário não encontrado') || (empty($str_nome))) {
            $this->redirect('9', "usuario/listarUsuario");
        } else {

//Verifica se usuário já esta cadastrado no sistema
            $login = $arrDadosForm['str_cpf'];
            $result = $this->select_check($arrDadosForm['tabela'], 'str_cpf', "'$login'");
            if ($result == 0) {
                $_POST['arrDadosForm']['str_nome'] = strtolower($_POST['arrDadosForm']['str_nome']);
                //Criando login
                $explode = explode(' ', $_POST['arrDadosForm']['str_nome']);
                $totalExplode = count($explode);
                $casaUltima = $totalExplode - 1;

                echo $login = $explode[0] . '.' . utf8_decode($explode[$casaUltima]);

                //Verificando se login ja tem
                $resultLogin = $this->select_check('gr_usuario', 'str_login', "'$login'");
                if ($resultLogin > 0) {
                    echo'entrei';
                    //Ja tem, tentar com outro sobrenome
                    $casaPUltima = $casaUltima - 1;
                    $login = $explode[0] . '.' . utf8_decode($explode[$casaPUltima]);

                    $resultLogin2 = $this->select_check('gr_usuario', 'str_login', "'$login'");

                    if ($resultLogin2 > 0) {
                        $this->redirect('13', "usuario/listarUsuario");
                    }
                }

                //criar senha
                $cpfLimpo = $this->removeSinais($_POST['arrDadosForm']);
                $senha = $cpfLimpo . utf8_decode($explode[$casaUltima]);

                $arrDados = Array();
                $arrDados = $_POST['arrDadosForm'];
                $arrDados['str_login'] = $login;
                $arrDados['str_senha'] = md5($senha);


                $result = $this->insert($arrDados);


                $this->redirect('15', "usuario/listarUsuario");
            } else {
                $this->redirect('12', "usuario/listarUsuario");
            }
        }
    }

    function alterar($arrDadosForm) {
        $result = $this->update($arrDadosForm);
        $this->redirect('1', "usuario/listarUsuario");
    }

    function listar($arrDadosForm = null) {
        if (isset($arrDadosForm['idUsuario']) and $arrDadosForm['acao'] == 'ajax') {
            $result = $this->listarUsuario($_POST['idUsuario'], 'str_nome');
            while ($arDados = mysqli_fetch_array($result)) {
                $arr['id'] = $arDados['id_usuario'];
                $arr['nome'] = $arDados['str_nome'];
                $arr['login'] = $arDados['str_login'];
                $arr['cpf'] = $arDados['str_cpf'];
                $arr['telefone'] = $arDados['str_telefone'];
                $arr['email'] = $arDados['str_email'];

                $arr['situacao'] = $arDados['str_situacao'];
                $arr['perfil'] = $arDados['id_perfil'];
            }
            echo json_encode($arr);
        } else {
            return $this->listarUsuario();
        }
    }

    function listarQuantidade($arrDadosForm = null) {

        $resultUsuarioQuant = $this->listaDados("gr_usuario");

        $ativos = 0;
        $inativos = 0;
        $administradores = 0;
        $consultantes = 0;

        while ($arDadosQuant = mysqli_fetch_array($resultUsuarioQuant)) {
            if ($arDadosQuant['str_situacao'] == 'A') {
                $ativos++;
            } else {
                $inativos++;
            }
            if ($arDadosQuant['id_perfil'] == 1 && $arDadosQuant['str_situacao'] == 'A') {
                $administradores++;
            } else if ($arDadosQuant['id_perfil'] == 2 && $arDadosQuant['str_situacao'] == 'A') {
                $consultantes++;
            }
        }
        return array($ativos, $inativos, $administradores, $consultantes);
    }

    function contarAtivos($arrDadosForm = null) {


        return $this->contarAtivosMU();
    }

    function desativar($arrDadosForm) {
        (($arrDadosForm['str_situacao'] == 'D') ? $arrDadosForm['str_situacao'] = 'A' : $arrDadosForm['str_situacao'] = 'D' );
        $arrDadosForm['str_situacao'];
        $result = $this->update($arrDadosForm);
        $this->redirect('1', "usuario/listarUsuario");
    }

    function listarPerfil() {
        return $this->listaDados('gr_perfil', null, 'str_perfil');
    }

}

$oUsuario = new Usuario();
$classe = 'Usuario';
$oBjeto = $oUsuario;
@include_once '../application/request.php';
?>