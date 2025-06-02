# Requisitos

    XAMPP instalado y funcionando.

    PHP y MySQL habilitados en XAMPP.

    Editor de código (opcional).

    Navegador web.

Instalación y configuración
1. Clonar o descargar el repositorio

Descarga el proyecto y colócalo dentro de la carpeta htdocs de XAMPP. Por ejemplo:

C:\xampp\htdocs\tienda

2. Importar la base de datos

Para que el proyecto funcione correctamente, debes importar la base de datos MySQL proporcionada.
Pasos para importar:

    1.Abre el Panel de Control de XAMPP y asegúrate de que Apache y MySQL estén activos.

    2.Abre tu navegador y entra a phpMyAdmin:
    http://localhost/phpmyadmin

    3.Crea una nueva base de datos con el nombre que prefieras, por ejemplo: tienda_db.

    4.Selecciona la base de datos recién creada.

    5.Ve a la pestaña Importar.

    6.Haz clic en Elegir archivo y selecciona el archivo .sql con la base de datos que entregas junto con el proyecto.

    7.Presiona Continuar y espera a que se importe la base de datos.

3. Configurar la conexión a la base de datos

Abre el archivo de configuración de la base de datos en el proyecto (por ejemplo, config.php o similar) y ajusta los parámetros de conexión a MySQL:

<?php
$servername = "localhost";
$username = "root";
$password = ""; // usualmente vacío en XAMPP por defecto
$dbname = "tienda_db"; // el nombre que usaste al crear la base de datos

Guarda los cambios.

-Uso del proyecto

    Accede al proyecto en el navegador con la ruta:
    http://localhost/tienda

    El sistema cuenta con dos tipos de usuarios: admin y usuario normal.

    Para probar, usa las cuentas de ejemplo que estén en la base de datos o crea nuevos usuarios.

-Notas importantes

    Asegúrate que los servicios de Apache y MySQL estén corriendo en XAMPP antes de usar el proyecto.

    Si cambias el nombre de la base de datos, actualiza la configuración en el archivo config.php.

    Si usas otro puerto para MySQL o Apache, ajusta las URLs y configuraciones correspondientes.
