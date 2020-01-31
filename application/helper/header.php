<!-- BEGIN HEADER INNER -->
<div class="page-header-inner">

    <div class="page-logo">

        <img src="<?php echo IMG; ?>hfa.png" alt="Viking" class="logo-default" style="width: 48px; margin-top: 0px;">
        <span style="vertical-align: -webkit-baseline-middle; font-weight: bold; font-size: 28px;">HFA</span>
        <div class="menu-toggler sidebar-toggler">
        </div>
    </div>

    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

    <div class="page-actions">
        <span style="font-size: 22px; color: #26344b"> ConGePro - Controle Geral de Processos</span>
    </div>

    <div class="page-top">
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="Perfil" class="img-circle" src="<?php echo IMG; ?>no-user-2.jpg">
                        <span class="username username-hide-on-mobile"> <?php echo '<b>' . $_SESSION['LOGIN']['str_perfil'] . '</b> ' . $_SESSION['LOGIN']['str_nome']; ?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?php echo RAIZ . "inicio/manual" ?>">
                                <i class="icon-book-open"></i> Manual do Sistema
                            </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="<?php echo CONTROLLER . 'login.php?acao=sair'; ?>">
                                <i class="icon-logout"></i> Sair do Sistema </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                    <a href="<?php echo CONTROLLER . 'login.php?acao=sair'; ?>" class="dropdown-toggle" >
                        <i class="icon-logout"></i>
                    </a>
                    <ul class="dropdown-menuss">
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- END HEADER INNER -->