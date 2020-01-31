<?php
if (isset($_SESSION['MSG'])) {
    switch ($_SESSION['MSG']) {
        case 1: // operacao
            $MSG = 'Operação realizada com êxito.';
            $IMG = 'sucesso';
            break;

        case 2: // erro
            $MSG = 'Ops! Algo não saiu como o planejado! Tente novamente ou contate o administrador.';
            $IMG = 'erro';
            break;

        case 3: // contato
            $MSG = 'Erro ao conectar com o servidor de autenticação.';
            $IMG = 'login';
            break;

        case 4: // contato
            $MSG = 'Ouve uma falha ao enviar sua mensagem. Entre em contato com o administrador.';
            $IMG = 'login';
            break;

        case 5: // login
            $MSG = 'Usuário ou senha inválidos.';
            $IMG = 'login';
            break;

        case 6: // login
            $MSG = 'Informe seus dados de acesso para ter acesso ao sistema.';
            $IMG = 'login';
            break;

        case 7: // Autenticacao LDAP
            $MSG = 'Erro na autenticação, verifique seu login e senha.';
            $IMG = 'login';
            break;

        case 8: // Conecta AD
            $MSG = 'Erro ao se conectar com o servidor.';
            $IMG = 'login';
            break;

        case 9: // Erro na consulta do usuario no AD
            $MSG = 'Erro na consulta do usuário.';
            $IMG = 'login';
            break;

        case 10: // Autenticacao no banco
            $MSG = 'Usuário não cadastrado no banco.';
            $IMG = 'login';
            break;
        case 11: // Autenticacao no banco
            $MSG = 'Usuário Inativo no sistema, contate o Administrador.';
            $IMG = 'login';
            break;

        case 12: // [Cadastro de Usuário] Usuário Já Existente
            $MSG = 'Usuário Já Cadastrado.';
            $IMG = 'erro';
            break;

        case 13: // [Cadastro de Usuário] Usuário sem login existente
            $MSG = 'Login não cadastro no sistema, contate o Administrador.';
            $IMG = 'erro';
            break;
        case 14: // [Cadastro de Usuário] Usuário sem login existente
            $MSG = 'Senha errada,tente novamente.';
            $IMG = 'login';
            break;
        case 15: // [Cadastro de Usuário] Usuário sem login existente
            $MSG = 'Usuário Cadastrado. Senha do Usuário : CPF+1°Nome';
            $IMG = 'sucesso';
            break;
        case 16: //
            $MSG = 'Prontuário já cadastrado.';
            $IMG = 'erro';
            break;
        case 17: //
            $MSG = 'Paciente excluido com sucesso.';
            $IMG = 'sucesso';
            break;
    }

    if (isset($IMG)) {
        if ($IMG == 'erro') {
            ?>

            <div id="pulsate-danger" class="alert alert-block alert-danger fade in">
                <button type="button" class="close" data-dismiss="alert"></button>
                <h4 class="alert-heading">Erro!</h4>
                <p>
                    <?php echo $MSG ?>
                </p>
            </div>
            <?php
        } else if ($IMG == 'sucesso') {
            ?>
            <div id="pulsate-success" class="alert alert-block alert-success fade in">
                <button type="button" class="close" data-dismiss="alert"></button>
                <h4 class="alert-heading">Sucesso!</h4>
                <p>
                    <?php echo $MSG ?>
                </p>
            </div>
            <?php
        } else if ($IMG == 'login') {
            echo '
        <div id="pulsate-danger" class="alert alert-danger fade in">
            <button class="close" data-close="alert"></button>'
            . @$MSG .
            '</div>';
        }
        unset($_SESSION['MSG']);
    }
}
?>


