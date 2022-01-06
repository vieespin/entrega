<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="http://localhost:8080/entrega/img/liceocomercial.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Liceo Comercial</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <?php if (!\Yii::$app->user->isGuest): ?>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= Yii::$app->user->identity->NOMBRE?></a>
            </div>
        </div>
        <?php endif;?>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <?php

        use app\models\User;

        $items = [];
        if (!\Yii::$app->user->isGuest) {
   
           if (User::isUserAdmin(Yii::$app->user->identity->id))
           {
            $items = [
                   
                    ['label' => 'Laboratorio','url'=>['/laboratorio'],'iconStyle' => 'fas fa-desktop', 'iconClassAdded' => 'text-danger'],
                    ['label' => 'Usuario','url'=>['/users'], 'iconStyle' => 'fas fa-user-alt', 'iconClassAdded' => 'text-warning'],
                    ['label' => 'Reserva', 'icon' => 'calendar', 'url' => ['/reserva'], 'iconClassAdded' => '_blank'],
                    ['label' => 'Calendario', 'icon' => 'fas fa-calendar-check', 'url' => ['reserva/calendario'], 'iconClassAdded' => ''],
                    ['label' => 'SALIR', 'icon' => 'fas fa-close', 'url' => ['site/logout'], 'template'=>'<a href="{url}" data-method="post">{label}</a>', 'iconClassAdded' => '_blank'],


                
                ];
           }
           else
           {
            $items = [
                   
                    /*['label' => 'Laboratorio','url'=>['/laboratorio'],'iconStyle' => 'fas fa-desktop', 'iconClassAdded' => 'text-danger'],
                    ['label' => 'Usuario','url'=>['/users'], 'iconStyle' => 'fas fa-user-alt', 'iconClassAdded' => 'text-warning'],
                    ['label' => 'Reserva', 'icon' => 'calendar', 'url' => ['/reserva'], 'iconClassAdded' => '_blank'],*/
                    ['label' => 'Calendario', 'icon' => 'fas fa-calendar-check', 'url' => ['reserva/calendario'], 'iconClassAdded' => ''],
                
                ];
           }
        } else {
            $items = [
                ['label' => 'Ingresar','url'=>['site/login'], 'iconStyle' => 'fas fa-user-alt', 'iconClassAdded' => 'text-warning'],
            ];
        }
         ?>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                /*'items' => [
                   
                    ['label' => 'Laboratorio','url'=>['/laboratorio'],'iconStyle' => 'fas fa-desktop', 'iconClassAdded' => 'text-danger'],
                    ['label' => 'Usuario','url'=>['/users'], 'iconStyle' => 'fas fa-user-alt', 'iconClassAdded' => 'text-warning'],
                    ['label' => 'Reserva', 'icon' => 'calendar', 'url' => ['/reserva'], 'iconClassAdded' => '_blank'],
                    ['label' => 'Calendario', 'icon' => 'fas fa-calendar-check', 'url' => ['reserva/calendario'], 'iconClassAdded' => ''],
                
                ],*/
                'items' => $items
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>