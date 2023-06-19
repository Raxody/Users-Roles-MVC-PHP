<!DOCTYPE html>
<html>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/userActions.css">

</head>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="tittleUsers" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tittleUsers">Editar datos de usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="" method="post" >

                    <input type="hidden" name="action" value="editarUser2">

                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_POST['id'] ?>" required>
                    <input type="hidden" class="form-control" id="userEditActual" name="userEditActual" value="<?php echo $_POST['user'] ?>" required>

                    <div class="mb-3">
                        <label for="user" class="col-form-label">Usuario: *</label>
                        <input type="text" class="form-control" id="userEdit" name="userEdit" value="<?php echo $_POST['user'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="user" class="col-form-label">Clave: *</label>
                        <input type="password" class="form-control" id="passwordEdit" name="passwordEdit" value="<?php echo $_POST['password'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="selectImagenEdit" class="col-form-label">Selecciona tu avatar: *</label><br>
                        <select id="selectImagenEdit" name="selectImagenEdit" style="width: 90px;">
                            <?php
                            $userController = new UserController();
                            $userController->findAllRoutesPhotosOfUsers();
                            ?>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="typeId" class="col-form-label">Selecciona tu tipo de ID: *</label><br>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="typeIdEdit" id="typeIdEdit" required>
                            <option value="c.c" <?php echo ($_POST['typeId'] == 'c.c') ? 'selected' : ''; ?>>Cedula de ciudadanía</option>
                            <option value="c.e" <?php echo ($_POST['typeId'] == 'c.e') ? 'selected' : ''; ?>>Cedula de extranjería</option>
                            <option value="t.i" <?php echo ($_POST['typeId'] == 't.i') ? 'selected' : ''; ?>>Tarjeta de identidad</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="id" class="col-form-label">Identificacion: *</label>
                        <input type="text" id="idEdit" name="idEdit" value="<?php echo $_POST['idE'] ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="col-form-label">Nombre: *</label>
                        <input type="text" id="nameEdit" name="nameEdit" value="<?php echo $_POST['name'] ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="lastName" class="col-form-label">Apellido: *</label>
                        <input type="text" id="lastNameEdit" name="lastNameEdit" value="<?php echo $_POST['lastName'] ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="numberPhone" class="col-form-label">Numero de celular: *</label>
                        <input type="number" id="numberPhoneEdit" name="numberPhoneEdit" value="<?php echo $_POST['numberPhone'] ?>" class="form-control" step="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required>
                    </div>

                    <div class="mb-3">
                        <label for="emailAddressEdit" class="col-form-label">Correo electronico: *</label>
                        <input type="text" id="emailAddressEdit" name="emailAddressEdit" value="<?php echo $_POST['address']; ?>" class="form-control" required>
                    </div>
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
        $('#myModal').on('show.bs.modal', function() {
            setTimeout(function() {
                $('#selectImagenEdit').select2({
                    templateResult: formatOption,
                    templateSelection: formatOption
                });

                var selectedValue = '<?php echo $_POST["photo"]; ?>'; // Obtén el valor predefinido de $_POST u otra fuente de datos
                $('#selectImagenEdit').val(selectedValue).trigger('change');
            }, 100); // Ajusta el tiempo de espera según sea necesario
        });

        function formatOption(option) {
            if (!option.id) {
                return option.text;
            }

            var imgSrc = $(option.element).data('image');
            var $option = $('<span><img src="' + imgSrc + '" class="select-image" />' + option.text + '</span>');
            return $option;
        }

        // Abrir el modal al cargar la página
        $('#myModal').modal('show');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>