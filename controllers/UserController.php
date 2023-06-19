<?php
class UserController
{
	private $userService;

	public function __CONSTRUCT()
	{
		$this->userService = new UserService();
	}


	public function login()
	{
		if (isset($_POST['userLogin'])) {
			$user = $_POST['userLogin'];
			$pass = $_POST['passwordLogin'];
			$rol = $_POST['rolLogin'];

			if ($actualUser = $this->userService->findUser($user, $pass, $rol)) {
				$_SESSION['account'] = $user;
				$_SESSION['photo'] = $actualUser['foto'];
				$_SESSION['name'] = $actualUser['nombre'];
				$_SESSION['lastName'] = $actualUser['apellido'];
?>
				<script>
					window.location = "admin.php";
				</script>
			<?php
			} else {
				echo "<script>
				Swal.fire({
					title: 'usuario o contraseña no existe',
					icon: 'error',
					confirmButtonText: 'OK'
				});
				</script>";
			}
		}
	}

	public function encryptPassword($password)
	{
		$longitud = strlen($password);
		$half = intval($longitud / 2);

		$passwordPart = substr($password, 0, $half);
		$encrypt = str_repeat('*', $longitud - $half);

		return $passwordPart . $encrypt;
	}

	public function findAllUsers()
	{
		if ($res = $this->userService->findAllUserAdminAndCustomer()) {
			foreach ($res as $item) {
				echo '<tr>
					<td>' . $item["usua_nombre"] . '</td>
					<td>' . $this->encryptPassword($item["usua_clave"]) . '</td>							
					<td>  <img src="' . $item["foto"] . '" alt="" class="user-photo"> </td>
					<td>' . $item["tipoIdentificacion"] . " " . $item["identificacion"] . '</td>
					<td>' . $item["nombre"] . " " . $item["apellido"] . '</td>
					<td>' . $item["celular"] . '</td>
					<td>' . $item["direccion"] . '</td>										
					<td>
						<form method="post" action="">
						<input type="hidden" name="action" value="editarUser">
						<input type="hidden" name="id" value="' . $item['usua_codigo'] . '">						
						<input type="hidden" name="user" value="' . $item['usua_nombre'] . '">
						<input type="hidden" name="password" value="' . $item['usua_clave'] . '">
						<input type="hidden" name="idE" value="' . $item['identificacion'] . '">
						<input type="hidden" name="typeId" value="' . $item['tipoIdentificacion'] . '">
						<input type="hidden" name="photo" value="' . $item['foto'] . '">
						<input type="hidden" name="name" value="' . $item['nombre'] . '">
						<input type="hidden" name="lastName" value="' . $item['apellido'] . '">
						<input type="hidden" name="numberPhone" value="' . $item['celular'] . '">
						<input type="hidden" name="address" value="' . $item['direccion'] . '">
						<button type="submit" class="image-button">
							<img src="images/Editar.png">
						</button>
				</form>
					</td>
					<td>
						<form method="post" action="">
							<input type="hidden" name="action" value="eliminarUser">
							<input type="hidden" name="id" value="' . $item['usua_codigo'] . '">
							<input type="hidden" name="usua" value="' . $item['usua_nombre'] . '">
							<button type="submit" class="image-button">
								<img src="images/delete.png" alt="Eliminar">
							</button>
						</form>
					</td>
				</tr>';
			}
		}
	}

	public function crudUser($codeUser)
	{
		$alm = new UserService();

		if (isset($_REQUEST['id'])) {
			$alm = $this->userService->Obtener($_REQUEST['id']);
		}

		require_once("views/modules/usserEditar.php");
	}

	public function deleteUser($codeUser, $usuario)
	{
		$this->userService->desactivateUser($codeUser, $usuario);
	}

	public function findAllRoutesPhotosOfUsers()
	{
		if ($res = $this->userService->findPhotoRoutes()) {
			foreach ($res as $item) {
				echo '<option value="' . $item["foto"] . '" data-image="' . $item["foto"] . '"></option>';
			}
		}
	}

	public function addUserAndCustomerOrAdmin($selectImagen, $rol, $typeId, $emailAddress, $numberPhone, $lastName, $name, $id, $password, $user)
	{
		$this->userService->saveUserAndCustomerOrAdmin($selectImagen, $rol, $typeId, $emailAddress, $numberPhone, $lastName, $name, $id, $password, $user);
	}

	public function editUserAndCustomerOrAdmin($id,$userEdit,$selectImagenEdit, $typeIdEdit, $idEdit, $nameEdit, $lastNameEdit, $numberPhoneEdit,$emailAddressEdit,$userEditActual,$passwordEdit){		
		
		$this->userService->editUser($id,$userEdit,$selectImagenEdit, $typeIdEdit, $idEdit, $nameEdit, $lastNameEdit, $numberPhoneEdit,$emailAddressEdit, $userEditActual,$passwordEdit);
	}



	public function userActions()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
			$action = $_POST['action'];
			if ($action === 'editarUser') {
				require_once("views/modules/usserActionsEdit.php");
			}else if ($action === 'editarUser2') {
				
			$this->editUserAndCustomerOrAdmin($_POST['id'] , $_POST['userEdit'] , $_POST['selectImagenEdit'] , $_POST['typeIdEdit'],
			$_POST['idEdit'], $_POST['nameEdit'], $_POST['lastNameEdit'], $_POST['numberPhoneEdit'],$_POST['emailAddressEdit'],$_POST['userEditActual'],
			$_POST['passwordEdit']);
				

			}			
			elseif ($action === 'eliminarUser') {
				$this->deleteUser($_POST['id'], $_POST['usua']);
			} else {
				$this->addUserAndCustomerOrAdmin(
					$_POST['selectImagen'],
					$_POST['rol'],
					$_POST['typeId'],
					$_POST['emailAddress'],
					$_POST['numberPhone'],
					$_POST['lastName'],
					$_POST['name'],
					$_POST['id'],
					$_POST['password'],
					$_POST['user']
				);
			}
		}
	}
}
?>