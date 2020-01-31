<script type="text/javascript">
    $(function() {
        $("#formLogin").validate();
        $("#formLogin").submit(function() {
            if ($("#formLogin").valid()) {
                enviaForm();
            }
        });
    });
</script>
<!-- Enviar formulário clicando em Enter -->
<script type="text/javascript">
    document.onkeyup = function(e) {
        if (e.which == 13) {
            document.form_login.submit();
        }
    }
</script>
<div class="modal fade bs-modal-lg" id="alterarAuditor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>Cadastro de Auditor</b></h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" >Prontuario: <?= $p2 ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-body">
                            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'auditoria.php' ?>" onsubmit="return validaForm()">
                                <input type="hidden" name="arrDadosForm[tabela]" value="tbauditor" />
                                <input type="hidden" name="arrDadosForm[method]" value="alterarAuditor" />
                                <input type="hidden" name="arrDadosForm[campo_where]" value="cod_auditor" />
                                <input type="hidden" id="codigo_auditor"  name="arrDadosForm[id]" value="" />
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >Nome:</label>
                                        <input id="nomeAuditor" type="text" name="arrDadosForm[nome]"  class="form-control" required>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >N º Doc:</label>
                                        <input type="number"  id="nrDoc"  class='form-control spinner' name='arrDadosForm[nr_docto]'>
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
    $(document).ready(function() {
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


<!-- ajax para buscar convenio do paciente -->
<script>
    $(document).ready(function() {
        $('#prontuario').change(function(e) {
            var prontuario = $('#prontuario').val();
            $.ajax({
                type: 'POST',
                data: 'nrProntuario=' + prontuario + '&method=buscaConvenio&acao=ajax',
                url: '<?php echo CONTROLLER; ?>contas.php',
                success: function(data) {
                    var response = $.parseJSON(data);
                    $("#convenio").val(response.convenio);
                }
            });
        });
    });
</script>