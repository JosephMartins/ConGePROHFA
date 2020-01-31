    <!-- TÍTULO E DIRETÓRIO DE NAVEGAÇÃO -->
    <h1 class="page-title">
        Auditoria <small>Ações realizadas por usuários na área administrativa</small>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-settings"></i>
                <span>Administrador</span>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <i class="icon-eye"></i>
                <a href="<?php echo RAIZ . "auditoria/auditoria-adm"; ?>">Auditoria</a>
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
            
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-layers font-dark"></i>
                        <span class="caption-subject bold uppercase">Registros</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">

                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                        <thead>
                            <tr>
                                <!-- class:[ all ]-> "Coluna visivél quando for TELEFONE e DESKTOP -->
                                <!-- class:[ min-phone-l ]-> "Coluna visivél quando for TELEFONE -->
                                <!-- class:[ min-tablet ]-> "Coluna visivél quando for TABLET -->
                                <!-- class:[ desktop ]-> "Coluna visivél quando for DESKTOP -->
                                <th class="text-center all">Data e Hora</th>
                                <th class="text-center min-phone-l">Usuário</th>
                                <th class="text-center min-tablet">Ação Realizada</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $resultAuditoria = $oAuditoria ->listar();
                                
                                // OBS VERIFICAR SE A SENHA FIRACA EXPOSTA
                                //var_dump($oAuditoria);
                                //exit();
                                
                                while ($arAuditoria  = mysqli_fetch_array($resultAuditoria )){
                                   
                                $data_hora = date('d/m/Y H:i', strtotime($arAuditoria['dt_registro']));
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $data_hora ?></td>
                                <td class="text-center"><?php echo $arAuditoria ['str_usr_criador']; ?></td>
                                <td class="text-center"><?php echo $descricao = utf8_encode($arAuditoria ['str_descricao']); ?></td>
                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
            
        </div>
    </div>

