<script src="https://kit.fontawesome.com/be3b2da769.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php $usuario = $_SESSION['Usuario']; ?>

<nav class="navbar navbar-expand navbar-light topbar" style="background-color: #2d3033;">
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-lg-inline text-gray-300 large"> <?php echo "$usuario" ?> </span>
                <i class="fa-solid fa-circle-user fa-2x"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" id="cerrarSesion" style="cursor: pointer;">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar sesión
                </a>
            </div>
        </li>
    </ul>
</nav>

<!-- Cerrar sesión -->
<script>
    document.getElementById("cerrarSesion").addEventListener("click", function(e) {
        e.preventDefault();
        Swal.fire({
            title: "¿Seguro que deseas cerrar sesión?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Cerrar sesión",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../Login/Controlador/cerrar.php";
            }
        });
    });
</script>