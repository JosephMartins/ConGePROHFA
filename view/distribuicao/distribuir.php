<?php
$consultaAuditores = $oController->listaDados('tbauditor');
$consultaContas = $oDistribuicao->listaTodasContasD();
?>
<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<h1 class="page-title">
    Controle de Distribuição
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-settings"></i>
            <span>Distribuição</span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="icon-users"></i>
            <a href="<?php echo RAIZ . "distribuicao/distribuir"; ?>">Controle de Distribuição</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <a onclick="window.history.go(-1)" class="btn btn-fit-height grey-salt dropdown-toggle"><i class="fa fa-reply"></i> Voltar </a>
        </div>
    </div>
</div>
<!-- FIM TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->

<div class="tab-pane" >
    <div class="portlet box blue-madison" style="border-radius: 4px;">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-file-text-o"></i> - Formulário de Atualização de Dados </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <div class="portlet box col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="border-radius: 4px;">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo CONTROLLER . 'distribuicao.php' ?>" method="POST" class="horizontal-form" style="border: solid 1px #578ebe;">
                        <input type="hidden" id="sessao" name="arrDadosForm[cod_usu]" value="<?php echo $_SESSION ['LOGIN']['str_login'] ?>"/>
                        <input type="hidden" name="arrDadosForm[method]" value="distribuicaoInsert">
                        <input type="hidden" name="arrDadosForm[dt_usu]"  value="<?php echo date('Y-m-d H:i:s'); ?>"/>

                        <input type="hidden">
                        <div class="form-body">
                            <h3 class="form-section">Distribuíção</h3>
                            <?php
                            $consultaAuditores = $oController->listaDados('tbauditor');
                            while ($auditores = mysqli_fetch_array($consultaAuditores)) {
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-checkbox-inline">
                                            <label class="mt-checkbox">
                                                <input type="checkbox" id="inlineCheckbox1" name="arrDadosForm[auditores][]" value="<?= $auditores['cod_auditor'] ?>"> <?= $auditores['nome'] ?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-6" id="periodo">
                            <label class="control-label">Período<span class="required" aria-required="true">*</span></label>
                            <div class="input-group input-large  input-daterange"  data-date-format="dd/mm/yyyy">
                                <input type="date" id="dt_inicio" class="form-control" placeholder="Data Inicial" name="arrDadosForm[dt_inicio]" required >
                                <span class="input-group-addon"> até </span>
                                <input type="date" id="dt_fim" class="form-control" placeholder="Data Final"  name="arrDadosForm[dt_fim]" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Unidade de Atendimento*</label>
                                <select id="grupo" class="form-control" data-placeholder="Choose a Category" tabindex="1" name="arrDadosForm[grupo]">
                                    <option value="">-- SELECIONE --</option>
                                    <option value="1">GRUPO INTERNAÇÃO</option>
                                    <option value="2">GRUPO ESPECIAIS</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions right">
                            <button type="submit" id="distribuir" class="btn blue-madison btn-circle">
                                <i class="fa fa-check"></i>Distribuir</button>
                        </div>
                    </form>
                </div>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
        <!-- ALERTAS -->
        <?php require HELPER . "mensagem.php"; ?>
        <!-- FIM ALERTAS -->
        <div class="portlet light " id="tabela" style="border: solid 1px rgb(147, 147, 148)">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list "></i>
                    <span class="caption-subject sbold uppercase">Contas</span>
                </div>
            </div>
            <div class="portlet-body"  >

                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5" >
                    <thead>
                        <tr>
                            <th  style="width: 10% !important;" class="text-center">Codigo</th>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Prontuario</th>
                            <th class="text-center">Nº Dias</th>
                            <th class="text-center">Data</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td ></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#tabela').hide();
        $('#periodo').show();
    });
    $(document).ready(function() {
        $('#grupo').on('change', function(e) {

            if ($('#grupo').val() == "") {
                $('#tabela').hide();
                $('#periodo').hide();
            }
            var grupo = $('#grupo').val();
            var dt_inicio = $('#dt_inicio').val();
            var dt_fim = $('#dt_fim').val();

            $.ajax({
                type: 'POST',
                data: 'grupo=' + grupo + '&dt_inicio=' + dt_inicio + '&dt_fim=' + dt_fim + '&method=listarContaFiltro&acao=ajax',
                url: '<?php echo CONTROLLER; ?>distribuicao.php',
                success: function(data) {
                    $('#tabela').show();
                    popularTabela(data);
                }
            });
        });
    });

    function popularTabela(dados) {
        var table = $('#sample_5').DataTable();
        table.clear().draw();
        if (dados != null) {
            var obj = $.parseJSON(dados);
            var length = Object.keys(obj.cod_conta).length;
            for (var i = 0; i < length; i++) {
                table.row.add([
                    obj.cod_conta[i],
                    obj.nome[i],
                    obj.nr_prontuario[i],
                    obj.nrdias[i],
                    obj.data[i]

                ]).draw();
            }
        }
    }
</script>


<!-- Ajax para editar Unidade DPU e Área DPGU -->
<script>


</script>

