<?php

class Banco {

    private $sqlTabela;
    private $sqlCampos;
    private $sqlValores;
    private $conexao;
    private $servidor = B_HOST;
    private $usuario = B_USUARIO;
    private $senha = B_SENHA;
    private $banco = B_BANCO;
    public $arrDataForm;

    function __construct() {
        $this->conexao = mysqli_connect("$this->servidor", "$this->usuario", "$this->senha", "$this->banco") or die('Nao foi possivel conectar ao banco. Erro = ' . mysql_error());
        // mysqli_select_db($this->banco) or die("Nao foi possivel selecionar o banco de dados!");

        if (!$this->conexao) {
            echo "Erro ao se conectar no o banco de dados.";
            exit;
        }
    }

    /*
     * Query SQL
     */

    public function query() {

        $rs = mysqli_query($this->conexao, $this->sql);
        if ($rs == false) {
            //echo $this->sql;
        }
        return $rs;
    }

    /*
     * Monta campos do INSERT no sql
     */

    public function tabelaCamposInsert($arrDadosForm) {
        $arrIndices = array_keys($arrDadosForm);
        for ($i = 0; $i < count($arrIndices); $i++) {
            $campos .= $arrIndices[$i] . ", ";
        }
        return substr($campos, 0, -2);
    }

    /*
     * Monta sql do INSERT
     */

    public function tabelaValoresInsert($arrDadosForm) {
        $arrIndices = array_keys($arrDadosForm);
        for ($i = 0; $i < count($arrIndices); $i++) {
            $y = $arrIndices[$i];
            $valor = $arrDadosForm[$y];

            if ($valor == "")
                $valor = 'null';
            else
                $valor = "'" . $valor . "'";

            $valores .= $valor . ',';
        }
        return substr($valores, 0, -1);
    }

    /*
     * Monta sql do UPDATE - VALORES
     */

    public function tabelaValoresUpdate($arrDadosForm) {
        $arrIndices = array_keys($arrDadosForm);
        for ($i = 0; $i < count($arrIndices); $i++) {
            $y = $arrIndices[$i];
            $valor = $arrDadosForm[$y];
            if ($valor == "")
                $valor = 'null';
            else
                $valor = "'" . $valor . "'";

            $valores .= $y . " = " . $valor . ",";
        }
        return substr($valores, 0, -1);
    }

    /*
     * Insert
     */

    public function insert($arrDadosForm) {
        $tabela = $arrDadosForm['tabela'];
        unset($arrDadosForm['tabela']);
        unset($arrDadosForm['method']);
        $this->sqlTabela = $tabela;
        $this->sqlCampos = $this->tabelaCamposInsert($arrDadosForm);
        $this->sqlValores = $this->tabelaValoresInsert($arrDadosForm);
        $this->sql = "INSERT INTO {$this->sqlTabela} ({$this->sqlCampos}) VALUES ({$this->sqlValores})";

        return $this->query();
    }

    /*
     * Update
     */

    public function update($arrDadosForm) {
        $tabela = $arrDadosForm['tabela'];
        unset($arrDadosForm['tabela']);
        unset($arrDadosForm['method']);

        $campo = $arrDadosForm['campo_where'];
        $id = $arrDadosForm['id'];
        unset($arrDadosForm['id']);
        unset($arrDadosForm['campo_where']);


        $this->sqlTabela = $tabela;
        $this->sqlValores = $this->tabelaValoresUpdate($arrDadosForm);
        $this->sql = "UPDATE {$this->sqlTabela} SET
                                            {$this->sqlValores}
                                            WHERE {$campo} in({$id})";

        return $this->query();
    }

    /*
     * Deleta registro de um id especifico
     */

    public function delete($arrDadosForm) {
        $tabela = $arrDadosForm['tabela'];
        $id = $arrDadosForm['id'];
        $campo = $arrDadosForm['campo_where'];
        unset($arrDadosForm['tabela']);
        unset($arrDadosForm['id']);
        unset($arrDadosForm['campo_where']);
        $this->sql = " DELETE FROM $tabela WHERE $campo in ('$id')";
        return $this->query();
    }

    /*
     * Lista registros
     */

    public function listaDados($tabela, $id = null, $order = null, $campo_where = null) {
        (($id > 0) ? $where = " WHERE $campo_where in ($id)" : $where = null );
        (($order != '') ? $order = " ORDER BY {$order}" : $order = null);


        $this->sql = " SELECT * FROM $tabela $where $order ";
        return $this->query();
    }

    /*
     * Captura ultimo registro inserido na tabela
     */

    public function maxIdInsert($tabela, $id_tabela) {
        $this->sql = "SELECT MAX($id_tabela) FROM $tabela";
        $result = $this->query();
        $ar = mysqli_fetch_array($result);

        return $ar[0];
    }

    /*
     * Proximo ID
     */

    public function proxId($tabela) {
        $this->sql = "SELECT MAX(id_$tabela) FROM $tabela";
        $result = $this->query();
        $ar = mysql_fetch_array($result);
        return $ar[0] + 1;
    }

    /*
     * Fechar conexao
     */

    public function fechaConexao() {
        return mysqli_close($this->conexao);
    }

    //Verificando se ja existe esse registro
    public function select_check($tabela, $campo_condicao, $valor_condicao) {
        $this->sql = " SELECT * FROM {$tabela} where $campo_condicao = $valor_condicao ";
        $result = $this->query();
        return $retorno = mysqli_num_rows($result);
    }

}

?>
