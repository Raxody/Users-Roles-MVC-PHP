<!DOCTYPE html>
<html>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <link rel="stylesheet" href="assets/css/userActions.css">



</head>

<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalStudent">Agregar usuario</a>



<div class="modal fade" id="modalStudent" tabindex="-1" aria-labelledby="tittleUsers" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tittleUsers">Ingresar datos de usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="frm-alumno" action="" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="user" class="col-form-label">Usuario: *</label>
                        <input type="text" class="form-control" id="user" name="user" required>
                    </div>

                    <div class="mb-3">
                        <label for="user" class="col-form-label">Clave: *</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="selectImagen" class="col-form-label">Selecciona tu avatar: *</label><br>
                        <select  id="selectImagen" name="selectImagen" style="width: 90px;">
                            <?php
                            $userController = new UserController();
                            $userController->findAllRoutesPhotosOfUsers();
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="rol" class="col-form-label">Selecciona tu rol: *</label><br>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="rol" id="rol" required>
                            <option value="cliente">Cliente</option>
                            <option value="administrador">Administrador</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="typeId" class="col-form-label">Selecciona tu tipo de id: *</label><br>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="typeId" id="typeId" required>
                            <option value="c.c">Cedula de ciudadania</option>
                            <option value="c.e">Cedula de extranjeria</option>
                            <option value="t.i">Tarjeta de identidad</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id" class="col-form-label">Identificacion: *</label>
                        <input type="text" id="id" name="id" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="col-form-label">Nombre: *</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="lastName" class="col-form-label">Apellido: *</label>
                        <input type="text" id="lastName" name="lastName" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="numberPhone" class="col-form-label">Numero de celular: *</label>
                        <input type="number" id="numberPhone" name="numberPhone" class="form-control" step="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required>
                    </div>

                    <div class="mb-3">
                        <label for="emailAddress" class="col-form-label">Direccion: *</label>
                        <input type="text" id="emailAddress" name="emailAddress" class="form-control" required>
                    </div>

                    <input type="hidden" name="action" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#modalStudent').on('shown.bs.modal', function() {
            $('#selectImagen').select2({
                templateResult: formatOption,
                templateSelection: formatOption
            });
        });

        function formatOption(option) {
            if (!option.id) {
                return option.text;
            }

            var imgSrc = $(option.element).data('image');
            var $option = $('<span><img src="' + imgSrc + '" class="select-image" />' + option.text + '</span>');
            return $option;
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>