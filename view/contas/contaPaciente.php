<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<?php
$consultaContas = $oContas->listarContasDoPaciente($p1);
?>
<h1 class="page-title">
    Controle de Contas <small>Contas registradas.</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-settings"></i>
            <span>Contas</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="icon-users"></i>
            <a href="<?php echo RAIZ . "contas/listarContas"; ?>">Listagem de contas</a>
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
                    <span class="caption-subject sbold uppercase">Listagem de Contas</span>
                </div>
                <div class="actions">
                    <button type="button" id="cod_conta" class="btn btn-success btn-circle" data-toggle="modal" data-target='#cadastrarContas' class="btn dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-plus"></i> Novo registro
                    </button>
                </div>
            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                    <thead>
                        <tr>
                            <th>Ação</th>
                            <th  style="width: 10% !important;" class="text-center">Nome</th>
                            <th>Nº Conta</th>
                            <th>Nº Atendimento</th>
                            <th>Internação</th>
                            <th>Alta</th>
                            <th>Protocolo</th>
                            <th>Data Recebida</th>
                            <th>Pré-Glosa</th>
                            <th>Pós-Glosa</th>
                            <th>Diferença</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($contas = mysqli_fetch_array($consultaContas)) {
                            ?>
                            <tr>
                                <td>
                                    <div class = "btn-toolbar" style = "margin-left:0px !important;">
                                        <div class = "btn-group">
                                            <button type = "button" id="cod_conta" class = "btn btn-xs btn-default blue-madison mod popovers" data-toggle = "modal" data-doc ="<?= $contas['cod_conta'] ?>" data-target = '#alterarConta' data-container = "body" data-trigger = "hover" data-placement = "top" data-content = "" data-original-title = "Editar">
                                                <i class = "fa fa-edit"></i>
                                            </button>
                                        </div>

                                        <div class = "btn-group">
                                            <a href="<?php echo RAIZ . "andamentos/listarAndamentos/" . $contas['cod_conta'] . "/" . $p1; ?>">
                                                <button type = "button" id="andamento" class = "btn btn-xs btn-default yellow mod popovers"  data-doc ="<?= $contas['cod_conta'] ?>"  data-container = "body" data-trigger = "hover" data-placement = "top" data-content = "" data-original-title = "Andamentos">
                                                    <i class="fa fa-list"></i>
                                                </button>
                                            </a>
                                        </div>

                                        <div style = "float: right !important;" > <!--class = "btn-group" -->

                                            <form action = "<?php echo CONTROLLER . 'usuario.php'; ?>" method = "POST">

                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"><?= $contas['nome'] ?></td>
                                <td class="text-center"><?= $contas['nr_conta'] ?></td>
                                <td class="text-center"><?= $contas['nr_atendimento'] ?></td>
                                <td class="text-center"><?= $oController->dataPt($contas['dt_interna']) ?></td>
                                <td class="text-center"><?= $oController->dataPt($contas['dt_alta']) ?></td>
                                <td class="text-center"><?= $contas['tipo'] == 1 ? "Interno" : "Externo"; ?></td>
                                <td class="text-center"><?= $oController->dataPt($contas['dt_recbcta']) ?></td>
                                <td class="text-center"><?= $contas['vlr_preglosa'] ?></td>
                                <td class="text-center"><?= $contas['vlr_posglosa'] ?></td>
                                <td class="text-center"><?= $contas['vlr_difglosa'] ?></td>
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
<?php
include 'modal/cadastroContas.php';
include 'modal/alterarConta.php';
?>


<!-- Ajax para editar Unidade DPU e Área DPGU -->
<script>
    $(document).ready(function () {
        $('#alterarConta').on('show.bs.modal', function (e) {
            var cod_conta = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'POST',
                data: 'cod_conta=' + cod_conta + '&method=listEditConta&acao=ajax',
                url: '<?php echo CONTROLLER; ?>contas.php',
                success: function (data) {

                    var response = $.parseJSON(data);
                    console.log(response.vlr_posglosa);
                    $("#id_cod_conta").val(response.cod_conta);
                    $("#cod_auditor").val(response.cod_auditor);
                    $("#cod_convenio").val(response.cod_convenio);
                    $("#dtalta").val(response.dt_alta);
                    $("#dtinterna").val(response.dt_interna);
                    $("#dt_recbcta").val(response.dt_recbcta);
                    $("#gau").val(response.gau);
                    $("#nr_atendimento").val(response.nr_atendimento);
                    $("#nr_conta").val(response.nr_conta);
                    $("#nr_prontmv").val(response.nr_prontuario);
                    $("#nrprotocmv").val(response.nr_protocmv);
                    $("#origem").val(response.origem);
                    $("#tipo").val(response.tipo);
                    $("#pos_glosa").val(response.vlr_posglosa);
                    $("#pre_glosa").val(response.vlr_preglosa);
                    $("#dif_glosa").val(response.vlr_difglosa);

                }
            });
        });


    });

</script>
