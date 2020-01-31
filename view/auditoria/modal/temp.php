<div class="portlet box col-md-6" style="border-radius: 4px;">
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form action="#" class="horizontal-form">
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
                                    <input type="checkbox" id="inlineCheckbox1" value="<?= $auditores['cod_auditor'] ?>"> <?= $auditores['nome'] ?>
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Unidade de Atendimento*</label>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                        <option value="1">GRUPO INTERNAÇÃO</option>
                        <option value="2">GRUPO ESPECIAIS</option>
                    </select>
                </div>
            </div>
            <div class="form-actions right">
                <button type="submit" class="btn blue-madison btn-circle">
                    <i class="fa fa-check"></i>Distribuir</button>
            </div>
    </div>

</form>
<!-- END FORM-->
</div>