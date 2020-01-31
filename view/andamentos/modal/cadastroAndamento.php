<script type="text/javascript">
    $(function () {
        $("#formLogin").validate();
        $("#formLogin").submit(function () {
            if ($("#formLogin").valid()) {
                enviaForm();
            }
        });
    });
</script>
<!-- Enviar formulário clicando em Enter -->
<script type="text/javascript">
    document.onkeyup = function (e) {
        if (e.which == 13) {
            document.form_login.submit();
        }
    }
</script>
<div class="modal fade bs-modal-lg" id="cadastrarAndamento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>Cadastro de Andamento</b></h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" >Prontuario: <?= $p2 ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-body">
                            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'andamentos.php' ?>" onsubmit="return validaForm()">
                                <input type="hidden" name="arrDadosForm[tabela]" value="tbandamento" />
                                <input type="hidden" name="arrDadosForm[cod_conta]" value="<?= $p1 ?>" />
                                <input type="hidden" name="arrDadosForm[method]" value="cadastrarAndamento" />
                                <input type="hidden" name="arrDadosForm[dt_usu]"  value="<?php echo date('Y-m-d H:i:s'); ?>"/>
                                <input type="hidden" name="arrDadosForm[responsavel]" value="<?php echo $_SESSION ['LOGIN']['str_login'] ?>"/>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>

                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >Situação:</label>
                                        <select class='form-control spinner' onchange="situacao()" id="situacaoSelect" name='arrDadosForm[cod_sit]'>
                                            <?php
                                            echo $oController->comboListar('tbsituacao', 'cod_sit', 'situacao');
                                            ?>
                                        </select>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >Data:</label>
                                        <input type="date" name="arrDadosForm[dt_andamento]" id="modulo" class="form-control" >
                                    </div>
                                </div>
                                <div class='row hidden' id="rmPr" style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-6 ' >
                                        <label style='text-align:left !important;' >Nº Protc SACI:</label>
                                        <input id="proto" type="text" name="arrDadosForm[nr_protocsaci]"  class="form-control" >
                                    </div>
                                    <div class='form-group col-md-6 ' >
                                        <label style='text-align:left !important;' >Nº Remessa:</label>
                                        <input id="remessa"   class='form-control spinner' maxlength='100' name='arrDadosForm[nr_remessa]'  type='text' placeholder=''  id='tel'  value=''>
                                    </div>
                                </div>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>

                                </div>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-12'>
                                        <label style='text-align:left !important;' >Observação:</label>
                                        <textarea name="arrDadosForm[observa]" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class="col-md-9">

                                    </div>
                                    <div class="form-group col-md-3" >
                                        <label style="text-align:left !important; color:#fff;">.</label>
                                        <div class="form-group" align="right">
                                            <button type="button" class="btn btn-default mt-ladda-btn ladda-button btn-circle" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success mt-ladda-btn ladda-button btn-circle"> Cadastrar </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background:#F5F5F5; border-radius: 0 0 10px 10px;">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#cpf2').mask('999.999.999-99');
        //   $('#tel').mask('(99) 99999-9999');
    });
    function validaForm() {
        var cpf = $('#cpf2').val();
        cpf = cpf.replace(/\D/g, '');

        var checkCPF = TestaCPF(cpf);
        if (checkCPF == false) {
            alert('CPF Inválido, insira cpf correto para continuar !');
            return false;
        } else {
            return true
        }
    }
    function TestaCPF(strCPF) {
        var Soma;
        var Resto;
        Soma = 0;
        if (strCPF == "00000000000")
            return false;

        for (i = 1; i <= 9; i++)
            Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))
            Resto = 0;
        if (Resto != parseInt(strCPF.substring(9, 10)))
            return false;

        Soma = 0;
        for (i = 1; i <= 10; i++)
            Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))
            Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11)))
            return false;
        return true;
    }
</script>

<script>
    function difGlosa() {
        var preGlosa = $("#preglosa").val();
        var posGlosa = $("#posglosa").val();
        var difglosa = preGlosa - posGlosa;
        document.getElementById('difglosa').value = difglosa;
    }
</script>

<script>
    function situacao() {
        var st = $('#situacaoSelect').val();
        if (st == 1) {
            $('#rmPr').removeClass('hidden');
            $('#remessa').val('');
            $('#proto').val('');
        } else {
            $('#rmPr').addClass('hidden');
        }

    }

</script>



<!-- ajax para buscar convenio do paciente -->
<script>
    $(document).ready(function () {
        $('#prontuario').change(function (e) {
            var prontuario = $('#prontuario').val();
            $.ajax({
                type: 'POST',
                data: 'nrProntuario=' + prontuario + '&method=buscaConvenio&acao=ajax',
                url: '<?php echo CONTROLLER; ?>contas.php',
                success: function (data) {
                    var response = $.parseJSON(data);
                    $("#convenio").val(response.convenio);
                }
            });
        });
    });
</script>