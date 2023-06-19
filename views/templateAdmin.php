<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="assets/css/estilos.css" >
        <title>proyecto IngWeb J&C</title>
    </head>

    <body>
        <div class="contenedor">
            <header class="header">
                <?php
                $controller = new Controller();
                $controller->navigationAdmin();
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