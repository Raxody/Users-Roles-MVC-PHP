<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
    <link rel="stylesheet" href="assets/css/estilos.css" >
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <title>proyecto IngWeb J&C</title>
</head>

<body>
    <div class="contenedor">
		<header class="header">
            <?php
            $controller = new Controller();
            $controller->navigation();
            ?>
        </header>
        <main class="contenido">
			<p>
                <?php
                $controller->linkPages();
                ?>
			</p>
		</main>

        <footer class="footer">
            <?php
            $controller->footer();
            ?>
        </footer>
    </div>
</body>

</html>