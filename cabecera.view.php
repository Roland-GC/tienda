<style>
    /* Cabecera general */
    .cabecera {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        align-items: center;
        padding: 10px 30px;
        background-color: #f6e6d1;
        border-bottom: 1px solid #ddd;
        position: relative;
        gap: 10px;
        min-width: 0;
    }

    /* Título centrado pero no ocupa toda la línea */
    .Title {
        font-size: 24px;
        font-weight: bold;
        font-family: 'Nunito', sans-serif;
        margin: 0 10px;
        white-space: nowrap;
    }

    /* Menú hamburguesa */
    .dropdown {
        position: relative;
    }

    .dropbtn {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 24px;
        color: #333;
    }

    /* Contenido desplegable */
    .dropdown-content {
        display: none;
        position: fixed;
        /* Cambiado a fixed para que se posicione respecto a ventana */
        background-color: #fff;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        top: 60px;
        left: 10px;
        font-size: 15px;
        min-width: 160px;
        flex-direction: column;
    }

    .dropdown-content a {
        color: black;
        padding: 10px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .show {
        display: block;
    }

    /* Formulario búsqueda */
    .form-search {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-grow: 1;
        white-space: nowrap;
    }

    .form-search input[type="search"] {
        flex-grow: 1;
        padding: 6px 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
        min-width: 0;
        font-size: 16px;
    }

    .form-search button {
        flex-shrink: 0;
        padding: 6px 12px;
        border: none;
        background-color: #8fbc8f;
        color: white;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }


    /* Botones */
    .botones,
    .boton_carrito {
        background-color: rgb(255, 255, 255);
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        margin: 0 5px;
        cursor: pointer;
        font-family: 'Nunito', sans-serif;
        white-space: nowrap;
    }

    .boton_carrito {
        position: relative;
    }

    .boton_carrito i {
        font-size: 20px;
    }

    .badge {
        position: absolute;
        top: -5px;
        right: -10px;
        background: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
    }

    /* Ícono de usuario */
    .user-dropdown {
        display: none;
        position: relative;
    }

    .user-icon {
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 28px;
        color: #333;
    }

  .user-menu {
    display: none;
    position: absolute;
    top: 40px;
    right: 0;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border-radius: 6px;
    min-width: 180px;
    font-size: 18px;
    z-index: 1000;
    left:auto;
    overflow: hidden;
  }

    .user-menu a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
    }

    .user-menu a:hover {
        background-color: #f0f0f0;
    }

    .user-dropdown.active .user-menu {
        display: block;
    }

    /* Responsive */
    @media (max-width: 768px) {

        .registro,
        .botones,
        .Title,
        .cabecera h3 {
            display: none;
        }

        .user-dropdown {
            display: block;
        }

        .user-menu {
            left: -10rem;
            right: auto;
            transform: none;
        }

        .form-search {
            max-width: 150px;
            margin-left: 0;
        }

        .form-search button {}
    }


    @media (min-width: 769px) and (max-width: 1200px) {

        .registro,
        .botones,
        .cabecera h3 {
            display: none;
        }

        .user-dropdown {
            display: block;
        }

        .form-search {}
    }
</style>


<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<div class="cabecera">
    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">
            <i class="fas fa-bars"></i>
        </button>
        <div id="myDropdown" class="dropdown-content">
            <a href="index.php">Inicio</a>
            <?php foreach ($categorias as &$categoria): ?>
                <a href="buscar.php?Id_Categoria=<?= $categoria["Id_Categoria"] ?>">
                    <?= $categoria["Descripción"] ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div>
        <form class="form-search" action="buscar.php" method="post">
            <input type="search" placeholder="Buscar..." name="texto">
            <button type="submit">🔍</button>
        </form>
    </div>

    <div class="Title">AKARI LUNA</div>

    <?php if (!isset($_SESSION["loggedin"])): ?>
        <div class="registro">
            <button class="botones" onclick="window.location='register.php'" value="Registrarse">❀ Registro de
                usuario</button>
        </div>

        <div>
            <button class="botones" onclick="window.location='login.php'" value="Login">❀ Inicio de sesión</button>
        </div>

        <!-- Ícono usuario solo visible en responsive -->
        <div class="user-dropdown">
            <button onclick="toggleUserMenu(event)" class="user-icon">
                <i class="fas fa-user"></i>
            </button>
            <div class="user-menu">
                <a href="login.php">❀ Iniciar sesión</a>
                <a href="register.php">❀ Registrarse</a>
            </div>
        </div>

    <?php else: ?>
        <h3><?php echo htmlspecialchars($_SESSION["Email"]); ?></h3>
        <a href="gestionDeUsuario.php" class="botones">❀ Gestionar Cuenta</a>
        <a href="carrito.php" class="boton_carrito">
            <?php if ($carrito_Cantidad > 0): ?>
                <span class="badge badge-light"><?= $carrito_Cantidad ?></span>
            <?php endif; ?>
            <img src="img/carrito.png" alt="Carrito">
        </a>
        <a href="reset-password.php" class="botones">❀ Cambia tu contraseña</a>
        <a href="cerrarConexion.php" class="botones">❀ Cierra la sesión</a>

        <!-- Ícono usuario solo visible en responsive -->
        <div class="user-dropdown">
            <button onclick="toggleUserMenu(event)" class="user-icon">
                <i class="fas fa-user"></i>
            </button>
            <div class="user-menu">
                <a href="gestionDeUsuario.php">❀ Gestionar Cuenta</a>
                <a href="reset-password.php">❀ Cambia tu contraseña</a>
                <a href="cerrarConexion.php">❀ Cierra la sesión</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    function toggleUserMenu(event) {
        const dropdown = event.currentTarget.closest(".user-dropdown");
        dropdown.classList.toggle("active");
        event.stopPropagation(); // evita que el clic cierre inmediatamente el menú
    }

    window.onclick = function (event) {
        // Cierra menú de usuario si clic fuera
        document.querySelectorAll(".user-dropdown.active").forEach(menu => {
            if (!menu.contains(event.target)) {
                menu.classList.remove("active");
            }
        });

        // Cierra menú hamburguesa si clic fuera
        if (!event.target.matches('.dropbtn') && !event.target.closest('.dropdown')) {
            document.querySelectorAll(".dropdown-content").forEach(dropdown => {
                dropdown.classList.remove("show");
            });
        }
    }
</script>