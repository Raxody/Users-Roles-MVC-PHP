<?php
require_once "Conection.php";

class UserService extends Conection
{
	private $pdo;
	public $id;

	public function findUser($user, $pass, $rol)
	{
		$statment = Conection::connect()->prepare("SELECT * FROM usuario u INNER JOIN " . $rol . " c ON (u.usua_codigo = c.Usua_codigo_fk) 
													WHERE u.usua_nombre = :nameUser and u.usua_clave = :passwordUser");
		$statment->bindParam(":nameUser", $user, PDO::PARAM_STR);
		$statment->bindParam(":passwordUser", $pass, PDO::PARAM_STR);
		$statment->execute();
		return $statment->fetch();
	}

	public function findAllUserAdminAndCustomer()
	{
		$stmt = Conection::connect()->prepare(
			"SELECT * FROM usuario A
			INNER JOIN cliente B
			ON A.usua_codigo = B.Usua_codigo_fk 
			WHERE usua_status = 'A'
			UNION SELECT * FROM usuario A
			INNER JOIN administrador B
			ON A.usua_codigo = B.Usua_codigo_fk 
			WHERE usua_status = 'A'"
		);

		$stmt->execute();
		return $stmt->fetchAll();
	}


	public function findPhotoRoutes()
	{
		$stmt = Conection::connect()->prepare(
			"SELECT DISTINCT foto FROM usuario"
		);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function isEmptyFields($selectImagen, $rol, $typeId, $emailAddress, $numberPhone, $lastName, $name, $id, $password, $user)
	{
		if (
			isset($selectImagen, $rol, $typeId, $emailAddress, $numberPhone, $lastName, $name, $id, $password, $user) &&
			$selectImagen !== "" && $rol !== "" && $typeId !== "" && $emailAddress !== "" && $numberPhone !== "" &&
			$lastName !== "" && $name !== "" && $id !== "" && $password !== "" && $user !== ""
		) {
			return false;
		} else {
			return true;
		}
	}

	public function saveUserAndCustomerOrAdmin($selectImagen, $rol, $typeId, $emailAddress, $numberPhone, $lastName, $name, $id, $password, $user)
	{
		if ($this->isEmptyFields($selectImagen, $rol, $typeId, $emailAddress, $numberPhone, $lastName, $name, $id, $password, $user)) {
			echo "<script>
            Swal.fire({
                title: 'Error en los datos, TODOS DEBEN ESTAR LLENOS. ',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            </script>";
		} else if (!$this->findSpecificUser($user)) {
			$this->saveUser($selectImagen, $rol, $typeId, $emailAddress, $numberPhone, $lastName, $name, $id, $password, $user);
		} else {
			echo "<script>
            Swal.fire({
                title: 'No se puede agregar el usuario, ya existe. ',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            </script>";
		}
	}

	public function editUser($id, $userEdit, $selectImagenEdit, $typeIdEdit, $idEdit, $nameEdit, $lastNameEdit, $numberPhoneEdit, $emailAddressEdit, $userEditActual, $passwordEdit)
	{
		if ($this->findSpecificUser($userEdit) && $userEdit != $userEditActual) {
			echo "<script>
            Swal.fire({
                title: 'No se puede actualizar el usuario, ese nombre de usuario ya existe. ',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            </script>";
		} else {
			if ($this->existAdministratorById($id)) {
				$this->updateUserByRol('administrador', $id, $userEdit, $selectImagenEdit, $typeIdEdit, $idEdit, $nameEdit, $lastNameEdit, $numberPhoneEdit, $emailAddressEdit, $passwordEdit);
			}else{
				$this->updateUserByRol('cliente', $id, $userEdit, $selectImagenEdit, $typeIdEdit, $idEdit, $nameEdit, $lastNameEdit, $numberPhoneEdit, $emailAddressEdit, $passwordEdit);
			}
		}
	}

	public function updateUserByRol($rol, $id, $userEdit, $selectImagenEdit, $typeIdEdit, $idEdit, $nameEdit, $lastNameEdit, $numberPhoneEdit, $emailAddressEdit, $passwordEdit){
		$statement = Conection::connect()->prepare("UPDATE ".$rol."  A
		INNER JOIN usuario B
		ON B.usua_codigo = A.Usua_codigo_fk
		SET
		B.foto = :selectImagenEdit,
		B.usua_nombre = :userEdit,
		B.usua_clave = :passwordEdit,
		A.identificacion = :id,
		A.tipoIdentificacion = :idEdit,
		A.nombre = :nameEdit,
		A.apellido = :lastNameEdit,
		A.direccion = :emailAddressEdit,
		A.celular = :numberPhoneEdit,
		A.tipoIdentificacion = :typeIdEdit
		WHERE B.usua_codigo = :id");

		$statement->bindParam(":selectImagenEdit", $selectImagenEdit);
		$statement->bindParam(":userEdit", $userEdit);
		$statement->bindParam(":passwordEdit", $passwordEdit);
		$statement->bindParam(":id", $id);
		$statement->bindParam(":idEdit", $idEdit);
		$statement->bindParam(":nameEdit", $nameEdit);
		$statement->bindParam(":lastNameEdit", $lastNameEdit);
		$statement->bindParam(":emailAddressEdit", $emailAddressEdit);
		$statement->bindParam(":numberPhoneEdit", $numberPhoneEdit);
		$statement->bindParam(":typeIdEdit", $typeIdEdit);
		$statement->bindParam(":id", $id);

		$statement->execute();


		echo "<script>
		Swal.fire({
			title: 'Usuario modificado ',
			icon: 'success',
			confirmButtonText: 'OK'
		}).then(function() {
			location.href = location.href;
		});
		</script>";
	}

	public function saveUser($selectImagen, $rol, $typeId, $emailAddress, $numberPhone, $lastName, $name, $id, $password, $user)
	{
		$rolcito = ($rol == 'cliente') ? 'C' : 'A';
		$statement = Conection::connect()->prepare("INSERT INTO Usuario (usua_nombre, usua_clave, foto, usua_rol,usua_status) VALUES (?,?,?,?,?)");
		if ($statement->execute([$user, $password, $selectImagen, $rolcito, 'A'])) {
			$this->saveCustomerOrAdminByRol($rol, $typeId, $emailAddress, $numberPhone, $lastName, $name, $id, $user);
		}
	}


	public function saveCustomerOrAdminByRol($rol, $typeId, $emailAddress, $numberPhone, $lastName, $name, $id, $user)
	{

		$statement = Conection::connect()->prepare("INSERT INTO " . $rol . "(identificacion, tipoIdentificacion, nombre, apellido, celular, 
						direccion, Usua_codigo_fk) VALUES (?,?,?,?,?,?,?) ");
		$statement->execute([$id, $typeId, $name, $lastName, $numberPhone, $emailAddress, $this->getIdUserByUserName($user)]);
		echo "<script>
            Swal.fire({
                title: 'Usuario " . $user . " agregado ',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function() {
				location.href = location.href;
			});
            </script>";
	}

	public function getIdUserByUserName($user)
	{
		$statement = Conection::connect()->prepare("SELECT usua_codigo FROM usuario u WHERE u.usua_nombre = :nameUser");
		$statement->bindParam(":nameUser", $user, PDO::PARAM_STR);
		$statement->execute();
		$userFound = $statement->fetch(PDO::FETCH_ASSOC);
		return $userFound['usua_codigo'];
	}

	public function findSpecificUser($user)
	{
		$statement = Conection::connect()->prepare("SELECT * FROM usuario u WHERE u.usua_nombre = :nameUser");
		$statement->bindParam(":nameUser", $user, PDO::PARAM_STR);
		$statement->execute();
		return $statement->rowCount() > 0;
	}

	public function existAdministratorById($id)
	{
		$statement = Conection::connect()->prepare("SELECT COUNT(*) FROM usuario u INNER JOIN administrador a ON (u.usua_codigo = a.Usua_codigo_fk) WHERE u.usua_codigo = :codeUser");
		$statement->bindParam(":codeUser", $id, PDO::PARAM_STR);
		$statement->execute();
		$userFound = $statement->fetchColumn();
		return $userFound > 0 ? true : false;
	}

	public function desactivateUser($codeUser, $usuario)
	{

		$statement = Conection::connect()->prepare("UPDATE usuario u SET u.usua_status = 'I' WHERE u.usua_codigo = :codeUser");
		$statement->bindParam(":codeUser", $codeUser, PDO::PARAM_STR);
		$statement->execute();
		echo "<script>
            Swal.fire({
                title: 'Usuario " . $usuario . " eliminado con exito ',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function() {				
				location.href = location.href;
			});
            </script>";
	}

	public function Obtener($id)
	{
		try {
			$stm = Conection::connect()->prepare("SELECT * FROM usuario WHERE usua_codigo = :codeUser");

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
