<!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
<?php
$consultaPacientes = $oController->listaDados('tbpacientes');
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
                    <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target='#cadastrarContas' class="btn dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-plus"></i> Novo registro
                    </button>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                    <thead>
                        <tr>
                            <th style="width: 1% !important;" class="text-center">Ação</th>
                            <th style="width: 1% !important;" class="text-center">Nº Prontuario</th>
                            <th style="width: 2% !important;" class="text-center">Nome</th>
                            <th style="width: 2% !important;" class="text-center">Convenio</th>
                            <th style="width: 2% !important;" class="text-center">dt_usu</th>
                            <th style="width: 1% !important;" class="text-center">Cod_usu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($pacientes = mysqli_fetch_array($consultaPacientes)) {
                            ?>
                            <tr>
                                <td class="text-center">
                                    <div class = "btn-toolbar" style = "margin-left:0px !important;">
                                        <div class = "btn-group">
                                            <button type = "button" class = "btn btn-xs btn-default blue-madison mod popovers" data-toggle = "modal" data-doc = "<?php echo $arUsuario['id_usuario']; ?>" data-target = '#contasPaciente' data-container = "body" data-trigger = "hover" data-placement = "top" data-content = "" data-original-title = "Editar">
                                                Contas
                                            </button>
                                        </div>
                                        <div style = "float: right !important;" > <!--class = "btn-group" -->

                                            <form action = "<?php echo CONTROLLER . 'paciente.php'; ?>" method = "POST">

                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td ><?= $pacientes['nr_prontmv'] ?></td>
                                <td ><?= $pacientes['nome'] ?></td>
                                <td ><?= $pacientes['cod_convenio'] ?></td>
                                <td ><?= $pacientes['dt_usu'] ?></td>
                                <td ><?= $pacientes['cod_usu'] ?></td>
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
?>


<!-- Ajax para editar Unidade DPU e Área DPGU -->
<script>
    $(document).ready(function() {
        $('#contasPaciente').on('show.bs.modal', function(e) {
            var idUsuario = $(e.relatedTarget).data('doc');
            $.ajax({
                type: 'POST',
                data: 'idUsuario=' + idUsuario + '&method=listar&acao=ajax',
                url: '<?php echo CONTROLLER; ?>usuario.php',
                success: function(data) {
                    var response = $.parseJSON(data);
                    $("#nome").val(response.nome);
                    $("#login").val(response.login);
                    $("#cpf").val(response.cpf);
                    $("#telefone").val(response.telefone);
                    $("#email").val(response.email);
                    $("#login").val(response.login);
                    $("#id").val(response.id);
                    $("#perfil").val(response.perfil);
                }
            });
        });
        UIGeneral.init();

    });

</script>