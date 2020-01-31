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

<div class="modal fade bs-modal-lg" id="alterarConta" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>Alteração de Conta</b></h4>
            </div>
            <div class="modal-body">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" >Dados gerais</h3>
                    </div>
                    <div class="panel-body">

                        <div class="form-body">


                            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'contas.php' ?>" onsubmit="return validaForm()">
                                <input type="hidden" name="arrDadosForm[tabela]" value="tbconta" />
                                <input type="hidden" name="arrDadosForm[method]" value="alterarConta" />
                                <input type="hidden" name="arrDadosForm[campo_where]" value="cod_conta" />
                                <input type="hidden" name="arrDadosForm[id]" value="" id="id_cod_conta" />
                                <input type="hidden" name="arrDadosForm[nrdias]" value="" />
                                <input type="hidden" name="arrDadosForm[cod_usu]" value="<?php echo $_SESSION ['LOGIN']['str_login'] ?>"/>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >Conta MV:</label>
                                        <input id="nr_conta" class='form-control spinner' maxlength='100' name='arrDadosForm[nr_conta]'  type='text' placeholder='Conta MV'    value=''>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >Nº Atendimento:<span class="required" aria-required="true">*</span></label>
                                        <input id="nr_atendimento" name="arrDadosForm[nr_atendimento]"  class="form-control" required>
                                    </div>
                                </div>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >Nome Completo:<span class="required" aria-required="true">*</span></label>
                                        <select id="nr_prontmv" name="arrDadosForm[nr_prontuario]"  class="form-control select2" required>
                                            <?php
                                            echo $oController->comboListar('tbpacientes', 'nr_prontmv', 'nome');
                                            ?>
                                        </select>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >Convenio:</label>
                                        <input id="cod_convenio" name="arrDadosForm[cod_convenio]"   class="form-control" readonly>
                                    </div>

                                </div>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class="col-md-6">
                                        <label class="control-label">Período Internação<span class="required" aria-required="true">*</span></label>
                                        <div class="input-group input-large" data-date="10/11/2012" data-date-format="dd/mm/yyyy">
                                            <input id="dtinterna" type="date" class="form-control" placeholder="Data Inicial" name="arrDadosForm[dt_interna]">
                                            <span class="input-group-addon"> até </span>
                                            <input id="dtalta" type="date" class="form-control" placeholder="Data Final"  name="arrDadosForm[dt_alta]" >
                                        </div>

                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >Unidades/Atendimento:</label>
                                        <select id="origem" name="arrDadosForm[origem]"  class="form-control" required>
                                            <option value=""></option>
                                            <option value="1">Internação</option>
                                            <option value="2">Centro Cirugico</option>
                                            <option value="3">UTI</option>
                                            <option value="4">Oncologia</option>
                                            <option value="5">Hemodinâmica</option>
                                            <option value="6">Medicina Núclear</option>
                                            <option value="7">Medicina Hiperbarica</option>
                                            <option value="8">Sem Registro</option>
                                        </select>
                                    </div>

                                </div>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >Tipo/Faturamento:</label>
                                        <select id="tipo" name="arrDadosForm[tipo]"  class="form-control" required>
                                            <option value=""></option>
                                            <option value="1">Interno</option>
                                            <option value="2">Externo</option>
                                        </select>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >Protocolo:</label>
                                        <input id="nrprotocmv"   class='form-control spinner' maxlength='100' name='arrDadosForm[nr_protocmv]'  type='text' placeholder=''  id='tel'  value=''>
                                    </div>
                                </div>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >Data Recebida da Conta:</label>
                                        <input id="dt_recbcta" class='form-control spinner' maxlength='100' name='arrDadosForm[dt_recbcta]'  type='date' placeholder='Data recebida'    value=''>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label style='text-align:left !important;' >Guia:</label>
                                        <select id="gau" name="arrDadosForm[gau]"  class="form-control" required>
                                            <option value="1">GAU</option>
                                            <option value="2">GAB</option>
                                            <option value="3">SEM</option>
                                        </select>
                                    </div>
                                </div>


                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-12'>
                                        <label style='text-align:left !important;' >Auditor:</label>
                                        <select id="cod_auditor" name="arrDadosForm[cod_auditor]"  class="form-control select2" required>
                                            <?php
                                            echo $oController->comboListar('tbauditor', 'cod_auditor', 'nome');
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-3'>
                                        <label style='text-align:left !important;' >Pre-Auditoria:</label>
                                        <input id="pre_glosa" class='form-control spinner'  name='arrDadosForm[vlr_preglosa]'  type='text' placeholder=''  >
                                    </div>
                                    <div class='form-group col-md-3'>
                                        <label style='text-align:left !important;' >Pos-Auditoria:</label>
                                        <input id="pos_glosa" onblur="difGlosaA();" class='form-control spinner'  name='arrDadosForm[vlr_posglosa]'  type='text' placeholder=''  >
                                    </div>
                                    <div class='form-group col-md-3'>
                                        <label style='text-align:left !important;' >Diferença:</label>
                                        <input id="dif_glosa" class='form-control spinner'  name='arrDadosForm[vlr_difglosa]'  type='text' placeholder='' readonly="">
                                    </div>
                                    <div class="form-group col-md-3" >
                                        <label style="text-align:left !important; color:#fff;">.</label>
                                        <div class="form-group" align="right">
                                            <button type="button" class="btn btn-default mt-ladda-btn ladda-button btn-circle" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success mt-ladda-btn ladda-button btn-circle"> Alterar</button>
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

<script language="javascript">



    function difGlosaA() {

        var preGlosa = $('#pre_glosa').val();
        var posGlosa = $('#pos_glosa').val();
        var difGlosa = preGlosa - posGlosa;
        var difGlosa = converterFloatReal(difGlosa);
        document.getElementById('dif_glosa').value = difGlosa;
        document.getElementById('pre_glosa').value = converterFloatReal(preGlosa);
        document.getElementById('pos_glosa').value = converterFloatReal(posGlosa);

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