<head>
    <title>Inicio de sesión</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
<!-- Importamos Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<!-- Importamos jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Importamos Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/login.css" />
</head>

<body>
    <form method="post">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Inicio de sesión</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Usuario</label>
                                <input name="userLogin" type="text" class="form-control" placeholder="Ingresa tu usuario" required>
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input name="passwordLogin" type="password" class="form-control" placeholder="Ingrese su contraseña" required>
                            </div>
                            <div class="form-group">

                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="rolLogin" id="rolLogin" required>
                                    <option value="">Seleccione un rol</option>
                                    <option value="cliente">Cliente</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                            </div>
                            <br>
                            <button type="submit" class="btn">Ingresar</button>
                            <div class="center">
                                <p>
                                    ¿No tienes una cuenta Prueba? <a href="#">Crear usuario</a>
                                    <br />
                                    <a href="#">¿Olvidaste tú contraseña?</a>
                                </p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    $userController = new UserController();
    $userController->login();
    ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>