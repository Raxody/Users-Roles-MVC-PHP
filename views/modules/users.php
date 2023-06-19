<head>
    <link rel="stylesheet" href="assets/css/user.css">
</head>

<div class="container-fluid py-3 bg-light">
    <h1 class="text-center">Usuarios</h1>

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