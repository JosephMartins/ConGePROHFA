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




<div class="modal fade bs-modal-lg" id="novoCadastro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><b>CADASTRAR NOVO USUÁRIO</b></h4>
            </div>
            <div class="modal-body">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" >Dados gerais</h3>
                    </div>
                    <div class="panel-body">

                        <div class="form-body">


                            <form role="form" name="form_login" method="POST" accept-charset="utf-8" action="<?php echo CONTROLLER . 'usuario.php' ?>" onsubmit="return validaForm()">
                                <input type="hidden" name="arrDadosForm[tabela]" value="gr_usuario" />
                                <input type="hidden" name="arrDadosForm[str_situacao]" value="A" />
                                <input type="hidden" name="arrDadosForm[method]" value="cadastrar" /> 
                                <input type="hidden" name="arrDadosForm[dt_registro]"  value="<?php echo date('Y-m-d H:i:s'); ?>"/>
                                <input type="hidden" name="arrDadosForm[str_usr_criador]" value="<?php echo $_SESSION ['LOGIN']['str_login'] ?>"/>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-12'>
                                        <label style='text-align:left !important;' >Nome completo:<span class="required" aria-required="true">*</span></label>
                                        <input class='form-control spinner' maxlength='100' name='arrDadosForm[str_nome]'  type='text' placeholder='Nome completo' required='' value=''>
                                    </div>
                                </div>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-12'>
                                        <label style='text-align:left !important;' >CPF:<span class="required" aria-required="true">*</span></label>
                                        <input class='form-control spinner' maxlength='100' name='arrDadosForm[str_cpf]'  type='text' placeholder='N° cpf'  id='cpf2' required='' value=''>
                                    </div>
                                </div>
                                
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-12'>
                                        <label style='text-align:left !important;' >Celular:</label>
                                        <input class='form-control spinner' maxlength='100' name='arrDadosForm[str_telefone]'  type='text' placeholder='N° telefone'  id='tel'  value=''>
                                    </div>
                                </div>
                                <div class='row' style='margin-left: -0px !important; margin-right: -0px !important;'>
                                    <div class='form-group col-md-12'>
                                        <label style='text-align:left !important;' >Email:</label>
                                        <input class='form-control spinner' maxlength='100' name='arrDadosForm[str_email]'  type='text' placeholder='email'  value=''>
                                    </div>
                                </div>
                                <div class="row" style="margin-left: -0px !important; margin-right: -0px !important;">
                                    <div class="form-group col-md-6">
                                        <label style="text-align:left !important;">Selecione o perfil:<span class="required" aria-required="true">*</span></label>
                                        <div class="form-group">
                                            <select name="arrDadosForm[id_perfil]" id="modulo" class="form-control" required>
                                                <?php
                                                echo $oController->comboListar('gr_perfil','id_perfil','str_perfil');                                             
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6" >
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

$(document).ready(function(){
  $('#cpf2').mask('999.999.999-99');
 //   $('#tel').mask('(99) 99999-9999');
});

function validaForm(){
    var cpf = $('#cpf2').val();
    cpf = cpf.replace(/\D/g, '');
    
    var checkCPF=TestaCPF(cpf);
    if(checkCPF==false){
        alert('CPF Inválido, insira cpf correto para continuar !');
        return false;
    }else{
       return true 
    }
}

function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
  if (strCPF == "00000000000") return false;
     
  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;
   
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
   
  Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
   
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}
</script>
