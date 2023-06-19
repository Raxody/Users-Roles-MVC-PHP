<head>
    <link rel="stylesheet" href="assets/css/user.css">
</head>

<h1 class="page-header">
    <?php echo $alm->id != null ? $alm->producto : ''; ?>
</h1>

<div class="container-fluid py-3 bg-light">
    <h1 class="text-center">Modificación de usuario</h1>
        <ol class="breadcrumb">
            <li><a href="?action=users">Regresar </a></li>
            <li class="active"><?php echo $alm->id != null ? $alm->stock : ''; ?></li>
        </ol>
    <div class="d-flex justify-content-end mb-3">
        <?php require_once("views/modules/usserActions.php"); ?>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Clave</th>
                    <th>Foto</th>
                    <th>Identificacion</th>
                    <th>Nombre</th>
                    <th>Celular</th>
                    <th>Direccion</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $userController = new UserController();
                $userController->findAllUsers();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$userController->userActions();

?>