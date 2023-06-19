<?php 
class Controller
{
	
	public function template()
	{
		include "views/template.php";
	}
	
	public function templateAdmin()
	{
		include "views/templateAdmin.php";
	}

	public function navigationAdmin()
	{
		include "views/modules/navbarAdmin.php";
	}

	public function navigation()
	{
		include "views/modules/navbar.php";
	}
    
    public function footer()
	{
		include "views/modules/footer.php";
	}

	public function initial()
	{
		include "views/modules/initial.php";
	}

	public function linkPages()
	{
		if (isset($_GET['action'])) {
			$link = $_GET["action"];
			include "views/modules/".$link.".php";	
		}
	}
	

}
?>