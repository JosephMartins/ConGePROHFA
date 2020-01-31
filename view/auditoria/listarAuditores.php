<?php
$consultaAuditores = $oController->listaDados('tbauditor');
?>
<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Controle de Auditores <small>Auditores Registrados.</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-settings"></i>
            <span>Auditores</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="icon-users"></i>
            <a href="<?php echo RAIZ . "contas/listarContas"; ?>">Listagem de Auditores</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <a onclick="window.history.go(-1)" class="btn btn-fit-height grey-salt dropdown-toggle"><i class="fa fa-reply"></i> Voltar </a>
        </div>
    </div>
</div>
<!-- FIM TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <!-- ALERTAS -->
        <?php require HELPER . "mensagem.php"; ?>
        <!-- FIM ALERTAS -->

        <div class="portlet light ">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list "></i>
                    <span class="caption-subject sbold uppercase">Listagem de Auditores</span>
                </div>
                <div class="actions">
                    <form action="<?php echo CONTROLLER . 'distribuicao.php'; ?>" method="POST">
                        <input type="hidden" name="arrDadosForm[method]" value="tabelaZerada" >
                        <button type="submit"  class="btn btn-success btn-circle"  >
                            Zerar Distribuição
                        </button>
                    </form>
                </div>
                <div class="actions">

                    <button type="button" id="cod_conta" class="btn btn-success btn-circle" data-toggle="modal" data-target='#cadastrarAuditor' class="btn dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-plus"></i> Novo Auditor
                    </button>

                </div>
            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                    <thead>
                        <tr>
                            <th style="width: 1% !important;" class="text-center">Ação</th>
                            <th style="width: 1% !important;" class="text-center">Cod Auditor</th>
                            <th  style="width: 6% !important;" class="text-center">Nome</th>
                            <th style="width: 1% !important;" class="text-center">Nº Doc</th>
                            <th style="width: 1% !important;" class="text-center">Nº Dias</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($auditores = mysqli_fetch_array($consultaAuditores)) {
                            ?>
                            <tr>
                                <td>
                                    <div class = "btn-toolbar" style = "margin-left:0px !important;">
                                        <div class = "btn-group">
                                            <button type = "button" id="cod_auditor" class = "btn btn-xs btn-default blue-madison mod popovers" data-toggle = "modal" data-doc ="<?= $auditores['cod_auditor'] ?>" data-target = '#alterarAuditor' data-container = "body" data-trigger = "hover" data-placement = "top" data-content = "" data-original-title = "Editar">
                                                <i class = "fa fa-edit"></i>
                                            </button>
                                        </div>
                                        <div style="float: right !important;" > <!-- class="btn-group"  -->
                                            <div id="acaoAlterar" class="">
                                                <form action="<?php echo CONTROLLER . 'auditoria.php'; ?>" method="POST">
                                                    <button type="submit" class="btn btn-danger btn-xs mod" data-toggle="confirmation" data-original-title="Excluir Auditor?">
                                                        <input type='hidden' name='arrDadosForm[id]' value="<?php echo $auditores['cod_auditor']; ?>" />
                                                        <input type="hidden" name="arrDadosForm[tabela]" value="tbauditor" />
                                                        <input type="hidden" name="arrDadosForm[method]" value="deletar" />
                                                        <input type="hidden" name="arrDadosForm[campo_where]" value="cod_auditor" />
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div style = "float: right !important;" > <!--class = "btn-group" -->
                                            <form action = "<?php echo CONTROLLER . 'usuario.php'; ?>" method = "POST">
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $auditores['cod_auditor'] ?></td>
                                <td><?= $auditores['nome'] ?></td>
                                <td><?= $auditores['nr_docto'] ?></td>
                                <td><?= $auditores['nrdias'] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
</div>
<?php
include 'modal/cadastrarAuditor.php';
include 'modal/alterarAuditor.php';
?>

<!-- Ajax para editar Unidade DPU e Área DPGU -->
<script>
    $(document).ready(function() {
        $('#alterarAuditor').on('show.bs.modal', function(e) {
            var cod_auditor = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'POST',
                data: 'cod_auditor=' + cod_auditor + '&method=listEditAuditor&acao=ajax',
                url: '<?php echo CONTROLLER; ?>auditoria.php',
                success: function(data) {
                    var response = $.parseJSON(data);
                    $("#nomeAuditor").val(response.nome);
                    $("#nrDoc").val(response.nr_docto);
                    $("#codigo_auditor").val(response.cod_auditor);
                }
            });
        });
    });

</script>
