<?php

/*
 * Chamadas via formulario que sao passados link's diretos ao controle
 * é preciso fazer referencia ao arquivo config e class banco.
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../application/config.php';
    require_once '../model/Banco.php';
} else {

    if ($_SERVER['REQUEST_METHOD'] == 'GET' and @ $_GET['acao'] == 'sair') {
        require_once '../application/config.php';
        require_once '../model/Banco.php';
    }
}

class controller extends Banco {
    /*
     * Valida dados do usuario logado
     */

    public function validaLogin($modulo, $pagina) {

        if (isset($_SESSION['LOGIN']) && isset($_SESSION['VALID']) && isset($_SESSION['VALID']) == true) {


            @session_start();
// seta configurações fusuhorario e tempo limite de inatividade//
            date_default_timezone_set("Brazil/East");
            $tempolimite = 7200;
//fim das configurações de fusu horario e limite de inatividade//
// aqui ta o seu script de autenticação no momento em que ele for validado você seta as configurações abaixo.//
// seta as configurações de tempo permitido para inatividade//
            $_SESSION['registro'] = time(); // armazena o momento em que autenticado //
            $_SESSION['limite'] = $tempolimite; // armazena o tempo limite sem atividade //
            $_SESSION['ultimo_acesso'] = date('d/m/Y H:i:s');
// fim das configurações de tempo inativo//


            $acessoView = false;
            $urlSolicitada = strtolower($modulo) . '/' . strtolower($pagina);
            for ($i = 0; $i <= count($_SESSION['ACESSO']); $i++) {
                @$urlAutorizada = $_SESSION['ACESSO'][$i]['modulo'] . '/' . $_SESSION['ACESSO'][$i]['view'];
                if ($urlAutorizada == $urlSolicitada) {
                    $acessoView = true;
                    @$_SESSION['PERMISSAOVIEW']['cadastrar'] = $_SESSION['ACESSO'][$i]['cadastrar'];
                    @$_SESSION['PERMISSAOVIEW']['alterar'] = $_SESSION['ACESSO'][$i]['alterar'];
                    @$_SESSION['PERMISSAOVIEW']['excluir'] = $_SESSION['ACESSO'][$i]['excluir'];
                    @$_SESSION['PERMISSAOVIEW']['visualizar'] = $_SESSION['ACESSO'][$i]['visualizar'];
                    @$_SESSION['PERMISSAOVIEW']['listar'] = $_SESSION['ACESSO'][$i]['listar'];
                }
            }

            return $acessoView;
        }
    }

    /*
     * Remove caracteres inadequados da string
     */

    function validaString($str) {
        $arInject = array("'", '"', "\\\\", "\\0", "\\n", "\\r", "\Z", "\'", '\"', "\\", "\0", "\n", "\r", "\x1a",
            '"', "'", "ORDER", "order", "BY", "by", "FROM", "from", "WHERE", "where", "HAVING", "having",
            "LIKE", "like", "SELECT", "select", "INSERT", "insert", "DELETE", "delete", "UPDATE", "update", "<>", "<=",
            ">=", "*", "'1'");
        return str_replace($arInject, "", $str);
    }

    function redirect($msg, $url) {
        $_SESSION['MSG'] = $msg;
        echo $URL = RAIZ . $url;
        header("location: $URL");
    }

    /*
     * Passando data para formato PT 30/04/1984
     */

    public function dataPt($data) {
        if ($data == '--')
            return "";
        $dia = substr($data, 8, 2);
        $mes = substr($data, 5, 2);
        $ano = substr($data, 0, 4);
        if (!empty($data))
            return $dia . '/' . $mes . '/' . $ano;
        else
            return "";
    }

    /*
     * Passando data para formato EN 1984-04-30
     */

    public function dataEn($data) {
        $dia = substr($data, 0, 2);
        $mes = substr($data, 3, 2);
        $ano = substr($data, 6, 4);
        if (!empty($data))
            return $ano . '-' . $mes . '-' . $dia;
        else
            return "";
    }

    /*
     * Mascaras em geral ex: CPF ###.###.###-##
     */

    function mask($val, $mask) {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    function tirarAcentos($string) {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/", "/(ç)/"), explode(" ", "a A e E i I o O u U n N c "), $string);
    }

    function removeSingleQuotes($string) {
        $string = str_replace("'", "", $string);
        return $string;
    }

    function removeSinais($string) {
        $string = str_replace(".", "", $string);
        $string = str_replace("-", "", $string);
        return $string;
    }

    /*
     * Limpa string, remove acentuação.
     */

    function removeAcentuacao($string) {
        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú', "'");
        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U', '');
        return str_replace($comAcentos, $semAcentos, $string);
    }

    function numDiaDaSemana($data) {
// 0 para domingo
// 6 sabado
        $timestamp = strtotime($this->dataEn($data));
        $dia = date('w', $timestamp);
        return $dia;
    }

    function js_alert($mensagem) {
        print "<script language=javascript> alert('" . $mensagem . "');</script>";
//return $function_ret;
    }

    function js_go($pagina) {
        print "<script language=javascript>self.location.href='$pagina';</script>";
    }

    function js_junto($mensagem, $pagina) {
        print "<script language=javascript> alert('" . $mensagem . "');</script>";
        print "<script language=javascript>self.location.href='" . RAIZ . "$pagina';</script>";
    }

    function comboListar($tabela, $id, $nome, $idSelecionado = null, $order = null) {
        $sql = $this->listaDados($tabela, null, $order);
        $id_value = $id;
        $nome_select = $nome;
        $option = '';
        while ($dados = mysqli_fetch_array($sql)) {
            $id = $dados[$id_value];
            $nome = utf8_encode($dados[$nome_select]);

            if ($idSelecionado <> null && $idSelecionado <> 'inicio') {
                if ($idSelecionado == $id) {
                    $option = $option . "<option value='$id'selected>". utf8_decode($nome) ."</option>";
                } else {
                    if (empty($option)) {
                        $option = "<option value=''></option>";
                        $option = $option . "<option value='$id'>". utf8_decode($nome) ."</option>";
                    } else {
                        $option = $option . "<option value='$id'>". utf8_decode($nome) ."</option>";
                    }
                }
            } else {
                if (empty($option)) {
                    $option = "<option value=''></option>";
                    $option = $option . "<option value='$id'>". utf8_decode($nome) ."</option>";
                } else {
                    $option = $option . "<option value='$id'>". utf8_decode($nome) ."</option>";
                }
            }
        }
        return $option;
    }

//Função para calcular diferença de Dias
    function diferencaDias($data1, $data2) {
        $data_inicial = $data1;
        $data_final = $data2;

// Calcula a diferença em segundos entre as datas
        $diferenca = strtotime($data_final) - strtotime($data_inicial);

//Calcula a diferença em dias
        return $dias = floor($diferenca / (60 * 60 * 24));
    }

    function diffDatas($data1, $data2, $formato) {

        //Datas no formato date_create();
        $datetime1 = date_create($data1);
        $datetime2 = date_create($data2);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($formato);
    }

    function diminuiDias1($data, $dias) {
        $data = explode("-", $data);
        $nova_data = mktime(0, 0, 0, $data[1], $data[2] - $dias, $data[0]);
        return strftime("%Y-%m-%d", $nova_data);
    }

//Função para Padronizar Nome
    function padronizarNome($nome) {
        $arrPalavras = Array('da', 'das', 'de', 'des', 'do', 'dos');
        $nomeexplode = explode(' ', $nome);
        $nomeFinal = '';

        for ($i = 0; $i < count($nomeexplode); $i++) {

            if (empty($nomeFinal)) {
                $nomeCorreto = strtolower($nomeexplode[$i]);
                $nomeCorreto = ucfirst($nomeCorreto);
                $nomeFinal = $nomeCorreto;
            } else {
                $nomeVerifica = strtolower($nomeexplode[$i]);
                if (in_array($nomeVerifica, $arrPalavras)) {
                    $nomeCorreto = $nomeVerifica;
                } else {
                    $nomeCorreto = ucfirst($nomeVerifica);
                }

                $nomeFinal = $nomeFinal . ' ' . $nomeCorreto;
            }
        }
        return $this->validaString(utf8_decode($nomeFinal));
    }

    function criaModel($modulo) {
        $class = ucfirst($modulo);
        $conteudo = "<?php
            @session_start();
            //Substituir require_once por _SESSION['PATH'];
            require_once '{$_SESSION['PATH']}controller/controller.php';
            class M{$class} extends controller{

            }

            ?>";
        $arquivo = $_SESSION['PATH'] . 'model/M' . $class . '.php';
        $fp = fopen($arquivo, "wb");
        fwrite($fp, $conteudo);
        if (fclose($fp)) {
            chmod($arquivo, 0775);
            return true;
        }
    }

    function criaController($modulo) {
        $newModulo = ucfirst($modulo);
        $class = $newModulo;
        $model = 'M' . $class;
        $conteudoController = "<?php
                @session_start();
                //Substituir require_once por _SESSION['PATH'];
                require_once '{$_SESSION['PATH']}model/{$model}.php';
                class {$class} extends {$model}{

                    function inicio(){ return 'Módulo {$modulo} criado com sucesso'; }

                }
                \$o{$newModulo} = new {$newModulo}();
                \$classe = '{$newModulo}';
                \$oBjeto = \$o{$newModulo};
                @include_once '../application/request.php';

            ?>";
        $arquivoController = $_SESSION['PATH'] . 'controller/' . $modulo . '.php';
        $fp = fopen($arquivoController, "wb");
        fwrite($fp, $conteudoController);
        if (fclose($fp)) {
            chmod($arquivoController, 0775);
            return true;
        }
    }

    function criaView($modulo, $idModulo, $tabela_view, $view = null) {
        ((!empty($view)) ? $pagina = $view : $pagina = 'inicio' . ucfirst($modulo));
        $newModulo = ucfirst($modulo);
        $conteudo = '<div class="page-wrapper">
            <div class="page-wrapper-row full-height">
                <div class="page-wrapper-middle">
                    <div class="page-container">
                        <div class="page-content-wrapper">
                            <div class="page-head" style="background:#ccc;">
                                <div class="container">
                                    <div class="page-title">
                                        <h1>Início
                                            <small></small>
                                        </h1>
                                    </div>
                                    <div class="page-toolbar" style="top:10px">
                                        <a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <i title="Voltar" onclick="window.history.go(-1)" class="glyphicon glyphicon-circle-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="page-content">
                                <div class="container">
                                    <p align="center">
                                        <?php echo $o' . $newModulo . '->inicio(); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        $modulo;
        $pagina;
        $arquivo = $_SESSION['PATH'] . 'view/' . $modulo . '/' . $pagina . '.php';
        $fp = fopen($arquivo, "wb");
        fwrite($fp, $conteudo);
        if (fclose($fp)) {
            chmod($arquivo, 0775);

            //Salva view no banco
            $arrDadosForm['tabela'] = $tabela_view;
            $arrDadosForm['str_view'] = $pagina;
            $arrDadosForm['id_modulo'] = $idModulo;
            $this->insert($arrDadosForm);

            return true;
        }
    }

    function permissaoAdministrador($id_view, $tabela_permissao) {

        $arr['tabela'] = $tabela_permissao;
        $arr['id_view'] = $id_view;
        $arr['id_perfil'] = 1;
        $arr['visualizar'] = 1;
        $arr['cadastrar'] = 1;
        $arr['alterar'] = 1;
        $arr['excluir'] = 1;

        $this->insert($arr);
    }

}

$oController = new controller();
?>