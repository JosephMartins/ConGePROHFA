<?php

@session_start();
require_once $_SESSION['PATH'] . 'model/MLogin.php';

class Login extends MLogin {

    function acessar($arrDadosForm) {


        //Verificar se existe no banco
        $buscarUsuario = $this->validaAcesso($arrDadosForm);
      
        $resultadoUsuario = mysqli_num_rows($buscarUsuario);

//Usuario Não cadastrado no Banco
        if ($resultadoUsuario == 0) {
            $this->redirect('10', "login/inicio"); //Usuário sem acesso ao sistema
            exit;
        }

        //Usuario cadastrado no Banco
        else {

            while ($dadosUsuario = mysqli_fetch_array($buscarUsuario)) {
                $idUsuario = $dadosUsuario['id_usuario'];
                $nomeUsuario = $dadosUsuario['str_nome'];
                $perfilUsuario = $dadosUsuario['id_perfil'];
                $senha = $dadosUsuario['str_senha'];
                $estatusUsuario = $dadosUsuario['str_situacao'];
                $loginUsuario = $dadosUsuario['str_login'];
                $str_perfilUsuario = $dadosUsuario['str_perfil'];
            }
            //Usuário Inativo
            if ($estatusUsuario == 'D') {
                $this->redirect('11', "login/inicio"); //Usuário sem acesso ao sistema
                exit;
            } //Usuário Ativo
            else {
                //Verificando se a senha Bate
                if ($senha != md5($arrDadosForm['str_senha'])) {
                    //senha errada
                    $this->redirect('14', "login/inicio");
                    exit;
                }
                $arDadosLogin['id_usuario'] = $idUsuario;
                $arDadosLogin['str_nome'] = $nomeUsuario;
                $arDadosLogin['str_login'] = $loginUsuario;
                $arDadosLogin['id_perfil'] = $perfilUsuario;
                $arDadosLogin['str_perfil'] = $str_perfilUsuario;
                $_SESSION['LOGIN'] = $arDadosLogin;
                $_SESSION['VALID'] = TRUE;

                $resultPermissoes = $this->permissoes($_SESSION['LOGIN']['id_perfil']);
                $arPer = array();
                $cont = 0;
                while ($arPermissao = mysqli_fetch_array($resultPermissoes)) {
                    $arP[$cont]['modulo'] = strtolower($this->removeAcentuacao($arPermissao['str_modulo']));
                    $arP[$cont]['view'] = strtolower($this->removeAcentuacao($arPermissao['str_view']));
                    $arP[$cont]['cadastrar'] = $arPermissao['cadastrar'];
                    $arP[$cont]['alterar'] = $arPermissao['alterar'];
                    $arP[$cont]['excluir'] = $arPermissao['visualizar'];
                    $arP[$cont]['visualizar'] = $arPermissao['excluir'];
                    $cont++;
                }

                $_SESSION['ACESSO'] = $arP;
                $this->redirect('null', 'inicio/home');
            }
        }
    }

    function inicio() {
        
    }

    function sair() {
        $this->fechaConexao();
        session_destroy();
        unset($_GET);
        unset($_POST);
        $this->redirect(null, "login/inicio");
    }

}

$oLogin = new Login();
$classe = 'Login';
$oBjeto = $oLogin;
@include_once '../application/request.php';
?>