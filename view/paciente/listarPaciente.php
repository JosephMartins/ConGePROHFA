<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<?php
$consultaPacientes = $oController->listaDados('tbpacientes');
?>
<h1 class="page-title" style="color: #26344b">
    Controle de pacientes <small>Pacientes Registrados.</small>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-settings"></i>
            <a href="<?php echo RAIZ . "inicio/inicio"; ?>"><span>Inicio</span></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <i class="icon-users"></i>
            <a href="<?php echo RAIZ . "paciente/listarPaciente"; ?>">Listagem de pacientes</a>
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
                    <span class="caption-subject sbold uppercase" style="color: #ea5460;">Pacientes</span>
                </div>
                <div class="actions">
                    <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target='#cadastroPaciente' class="btn dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-plus"></i> Novo Paciente
                    </button>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                    <thead>
                        <tr>
                            <th style="width: 1% !important;" class="text-center">Ação</th>
                            <th style="width: 1% !important;" class="text-center">Prontuario</th>
                            <th style="width: 4% !important;" class="text-center">Nome</th>
                            <th style="width: 2% !important;" class="text-center">Convenio</th>
                            <th style="width: 2% !important;" class="text-center">Data Registro</th>
                            <th style="width: 1% !important;" class="text-center">Responsável</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($pacientes = mysqli_fetch_array($consultaPacientes)) {
                            //validação de convenio
                            if ($pacientes['cod_convenio'] == 1) {
                                $pacientes['cod_convenio'] = "CD";
                            } else if ($pacientes['cod_convenio'] == 2) {
                                $pacientes['cod_convenio'] = "FUSEX";
                            } else if ($pacientes['cod_convenio'] == 3) {
                                $pacientes['cod_convenio'] = "FUSMA";
                            } else if ($pacientes['cod_convenio'] == 4) {
                                $pacientes['cod_convenio'] = "HFA/FUNC";
                            } else if ($pacientes['cod_convenio'] == 5) {
                                $pacientes['cod_convenio'] = "HFA/PAIS";
                            } else if ($pacientes['cod_convenio'] == 6) {
                                $pacientes['cod_convenio'] = "HFA/PENSION";
                            } else if ($pacientes['cod_convenio'] == 8) {
                                $pacientes['cod_convenio'] = "MD/FUNC";
                            } else if ($pacientes['cod_convenio'] == 9) {
                                $pacientes['cod_convenio'] = "MD/PENSION";
                            } else if ($pacientes['cod_convenio'] == 10) {
                                $pacientes['cod_convenio'] = "PRESIDENCIA";
                            } else if ($pacientes['cod_convenio'] == 11) {
                                $pacientes['cod_convenio'] = "PARTICULAR";
                            } else if ($pacientes['cod_convenio'] == 12) {
                                $pacientes['cod_convenio'] = "SARAM";
                            }
                            //fim validação de convenio
                            ?>
                            <tr>
                                <td class="text-center">

                                    <div class = "btn-toolbar" style = "margin-left:0px !important;">
                                        <div style="float: right !important;"  > <!-- class="btn-group"  -->
                                            <div id="acaoAlterar" class="">
                                                <form action="<?php echo CONTROLLER . 'paciente.php'; ?>" method="POST">
                                                    <button type="submit" class="btn btn-danger btn-xs mod" data-toggle="confirmation" data-original-title="Excluir Paciente?">
                                                        <input type="hidden" value="<?= $pacientes['nr_prontmv'] ?>" name="arrDadosForm[id]">
                                                        <input type="hidden" value="tbpacientes" name="arrDadosForm[tabela]">
                                                        <input type="hidden" value="deletar" name="arrDadosForm[method]">
                                                        <input type="hidden" value="nr_prontmv" name="arrDadosForm[campo_where]">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <a href="<?php echo RAIZ . "contas/contaPaciente/" . $pacientes['nr_prontmv']; ?>">
                                                <button type = "button" class = "btn btn-xs btn-success yellow  mod popovers" data-toggle = "modal" data-doc = "" data-target = '#contasPaciente' data-container = "body" data-trigger = "hover" data-placement = "top" data-content = "" data-original-title="Contas">
                                                    <i class="fa fa-list"></i>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-xs btn-default blue-madison mod popovers" data-toggle="modal" data-doc="<?= $pacientes['nr_prontmv'] ?>" data-target='#editarPaciente' data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="Editar">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </div>

                                    </div>

                                </td>
                                <td class="text-center"><?= $pacientes['nr_prontmv'] ?></td>
                                <td class="text-center"><?= $pacientes['nome'] ?></td>
                                <td class="text-center"><?= $pacientes['cod_convenio'] ?></td>
                                <td class="text-center"style="color: #337ab7; font-weight: bold;"><?= $oController->dataPt($pacientes['dt_usu']); ?></td>
                                <td class="text-center"><?= $pacientes['cod_usu'] ?></td>
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
include 'modal/contasPaciente.php';
include 'modal/cadastroPaciente.php';
include 'modal/alterarPaciente.php';
?>
<!-- Ajax para editar Unidade DPU e Área DPGU -->
<script>
    $(document).ready(function() {
        $('#editarPaciente').on('show.bs.modal', function(e) {
            var nrpront = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'POST',
                data: 'nrpront=' + nrpront + '&method=listarPaciente&acao=ajax',
                url: '<?php echo CONTROLLER; ?>paciente.php',
                success: function(data) {
                    var response = $.parseJSON(data);
                    $("#nome").val(response.nome);
                    $("#prontuario").val(response.prontuario);
                    $("#convenio").val(response.convenio);
                    $("#idPaciente").val(response.id);
                    $("#tituloPaciente").text(response.nome);
                }
            });
        });
        UIGeneral.init();
    });

</script>