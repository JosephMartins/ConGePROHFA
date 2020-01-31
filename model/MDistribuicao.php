<?php

@session_start();
//Substituir require_once por _SESSION['PATH'];
require_once 'C:/xampp/htdocs/frame_atualizado/controller/controller.php';

class MDistribuicao extends controller {

    function zerarTabela() {
        $this->sql = "UPDATE tbauditor SET nrdias = 0";
        return $this->query();
    }

    function listarContaD() {
        $this->sql = "SELECT p.nome, c.* FROM tbpacientes AS p
        INNER JOIN tbconta as c ON p.nr_prontmv = c.nr_prontuario";
        $result = $this->query();
        return $result;
    }

    //vai morrer
    function listarInternacao() {
        $this->sql = "SELECT p.nome, c.* FROM tbpacientes AS p
        INNER JOIN tbconta as c ON p.nr_prontmv = c.nr_prontuario
         WHERE c.origem >= 1  AND c.origem <= 3";
        return $this->query();
    }

    function listarEspeciais() {
        $this->sql = "SELECT p.nome, c.* FROM tbpacientes AS p
        INNER JOIN tbconta as c ON p.nr_prontmv = c.nr_prontuario
        WHERE c.origem >= 4 AND c.origem <= 7";
        $result = $this->query();
        return $result;
    }

    //fimmorreu

    function listarContas($filtros) {
        $where = array();

        if (!empty($filtros['grupo']) && $filtros['grupo'] == 1) {
            $where[] = "(c.origem >= 1  AND c.origem <= 3)";
        } else {
            $where[] = "(c.origem >= 4 AND c.origem <= 7)";
        }

        if (!empty($filtros['dt_inicio']) and ! empty($filtros['dt_fim'])) {
            $where[] .= "  dt_recbcta BETWEEN " . "'" . $filtros['dt_inicio'] . "'" . " AND " . "'" . $filtros['dt_fim'] . "'";
        }

        $where = implode(' and ', $where);

        $where = !empty($where) ? " WHERE $where " : "";






        $this->sql = "SELECT p.nome, c.* FROM tbpacientes AS p
        INNER JOIN tbconta as c ON p.nr_prontmv = c.nr_prontuario " . $where;
        return $this->query();
    }

    function insereAndamento($cod_conta, $sessao, $dt_usu, $nomeAuditorMenorDia) {
        $this->sql = "INSERT INTO tbandamento (cod_conta, cod_sit, responsavel, dt_usu, dt_andamento, observa) values ($cod_conta, 1, '$sessao', '$dt_usu', '$dt_usu', '$nomeAuditorMenorDia')";
        return $this->query();
    }

    function listaAuditorMenorDia($auditores) {
        $auditores = implode(', ', $auditores);
        $this->sql = "select cod_auditor, nome
                        from tbauditor
                        where cod_auditor in ($auditores)
                        order by nrdias asc
                        limit 1";
        return $this->query();
    }

    function alteraDiaAuditor($diasAdd, $cod_auditor) {
        $this->sql = "UPDATE tbauditor
                        set nrdias = nrdias + $diasAdd
                        where cod_auditor in ($cod_auditor)";
        return $this->query();
    }

    function zeraDias() {
        $this->sql = "UPDATE tbauditor SET nrdias = 0";
        return $this->query();
    }

}

?>