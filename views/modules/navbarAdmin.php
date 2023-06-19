<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

<div class="container-fluid bg-dark p-2 mb-3">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?action=users">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?action=customers">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?action=employees">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?action=sales">Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?action=exit">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div style="text-align: right;">


        <a class="nav-link"><?php echo $_SESSION['name'], " ", $_SESSION['lastName']; ?></a>
        <img src="<?php echo $_SESSION['photo']; ?>" alt="" class="user-photo" onclick="showImage(this)">
</div>


<div id="modal">
    <img id="modal-image" src="">
</div>

<script>
    function showImage(img) {
        document.getElementById("modal-image").src = img.src;
        document.getElementById("modal").style.display = "block";
    }

    document.getElementById("modal").onclick = function() {
        document.getElementById("modal").style.display = "none";
    };
</script>
<style>
    .user-photo {
        max-height: 30px;
        margin-left: 10px;
    }


    #modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
    }

    #modal-image {
        max-width: 90%;
        max-height: 90%;
        margin: auto;
        display: block;
    }
</style>