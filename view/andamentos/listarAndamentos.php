<?php
$conta = $p1;
$consultaAndamentos = $oAndamentos->listaAndamento($conta);
?>
<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Controle de Andamentos <small>Andamentos Registrados.</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-settings"></i>
            <span>Andamentos</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="icon-users"></i>
            <a href="<?php echo RAIZ . "contas/listarContas"; ?>">Listagem de Andamentos</a>
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
                    <span class="caption-subject sbold uppercase">Listagem de Andamentos</span>
                </div>
                <div class="actions">
                    <button type="button" id="cod_conta" class="btn btn-success btn-circle" data-toggle="modal" data-target='#cadastrarAndamento' class="btn dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-plus"></i> Novo Andamento
                    </button>

                </div>
            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                    <thead>

                        <tr>
                            <th style="width: 5% !important;">Ação</th>
                            <th>Situação</th>
                            <th  style="width: 10% !important;" class="text-center">Observação</th>
                            <th>DT Andamento</th>
                            <th>Remessa</th>
                            <th>SACI</th>
                            <th>Responsável</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($andamentos = mysqli_fetch_array($consultaAndamentos)) {
                            ?>
                            <tr>
                                <td>
                                    <div class = "btn-toolbar" style = "margin-left:0px !important;">
                                        <div class = "btn-group">
                                            <button type = "button" id="cod_conta" class = "btn btn-xs btn-default blue-madison mod popovers" data-toggle = "modal" data-doc ="<?= $contas['cod_conta'] ?>" data-target = '#alterarConta' data-container = "body" data-trigger = "hover" data-placement = "top" data-content = "" data-original-title = "Editar">
                                                <i class = "fa fa-edit"></i>
                                            </button>
                                        </div>

                                        <div style="float: right !important;" > <!-- class="btn-group"  -->
                                            <div id="acaoAlterar" class="">
                                                <form action="<?php echo CONTROLLER . 'andamentos.php'; ?>" method="POST">
                                                    <button type="submit" class="btn btn-danger btn-xs mod" data-toggle="confirmation" data-original-title="Excluir Andamento?">
                                                        <input type='hidden' name='arrDadosForm[id]' value="<?php echo $andamentos['cod_andamento']; ?>" />
                                                        <input type="hidden" name="arrDadosForm[tabela]" value="tbandamento" />
                                                        <input type="hidden" name="arrDadosForm[cod_conta]" value="<?= $p1 ?>" />
                                                        <input type="hidden" name="arrDadosForm[prontuario]" value="<?= $p2 ?>" />
                                                        <input type="hidden" name="arrDadosForm[method]" value="deletar" />
                                                        <input type="hidden" name="arrDadosForm[campo_where]" value="cod_andamento" />
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
                                <td><?= $andamentos['situacao'] ?></td>
                                <td><?= $andamentos['observa'] ?></td>
                                <td><?= $andamentos['dt_andamento'] ?></td>
                                <td><?= $andamentos['nr_remessa'] ?></td>
                                <td><?= $andamentos['nr_protocsaci'] ?></td>
                                <td><?= $andamentos['responsavel'] ?></td>
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
include 'modal/cadastroAndamento.php';
?>


<!-- Ajax para editar Unidade DPU e Área DPGU -->
<script>
    $(document).ready(function() {
        $('#alterarConta').on('show.bs.modal', function(e) {
            var cod_conta = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'POST',
                data: 'cod_conta=' + cod_conta + '&method=listEditConta&acao=ajax',
                url: '<?php echo CONTROLLER; ?>contas.php',
                success: function(data) {

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
