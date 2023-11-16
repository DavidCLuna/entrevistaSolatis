# Entrevista Solati

Este proyecto es una prueba técnica que utiliza Docker para facilitar el entorno de desarrollo y despliegue. A continuación, se detallan los requisitos y pasos para ejecutar el proyecto.

## Requisitos

- [Docker](https://www.docker.com/) debe estar instalado en tu sistema.

## Instrucciones para Linux

### 1. Clonar el Repositorio


`git clone https://github.com/DavidCLuna/entrevistaSolatis.git`
`cd entrevistaSolatis`

### 2. Iniciar el Contenedor

`docker-compose up -d --build`

Este comando creará y ejecutará los contenedores definidos en el archivo docker-compose.yml. Asegúrate de estar en el directorio del proyecto antes de ejecutar este comando.

### 3. Acceder al Proyecto

Una vez que los contenedores estén en ejecución, puedes acceder al proyecto desde tu navegador web en http://localhost:8085.

## Detalles del Proyecto
Tecnologías Utilizadas

    PHP 7.4 con Apache
    PostgreSQL como base de datos

Patrones y Estructura del Proyecto

El proyecto sigue una estructura MVC (Modelo-Vista-Controlador) para una organización clara del código fuente. Además utiliza para la conexión a base de datos el patrón Singleton y para el modelo el patrón DAO.


Configuración de la Base de Datos

    Servicio de Base de Datos: PostgreSQL
    Puerto expuesto: 5432
    Base de datos: entrevista
    Usuario: root
    Contraseña: 1234

Scripts y Automatizaciones

    La aplicación ejecuta automáticamente un script de inicialización SQL (init.sql) al arrancar, que crea la tabla canciones en la base de datos.

Detalles del Docker Compose
Servicio Web

    Imagen: php:7.4-apache
    Puerto expuesto: 8085
    Volumen: Directorio actual mapeado a /var/www/html
    Dependencias: Servicio de base de datos (db)
    Comando: Configuración adicional y arranque del servidor Apache

Servicio de Base de Datos (db)

    Imagen: postgres:latest
    Puerto expuesto: 5432
    Base de datos: entrevista
    Usuario: root
    Contraseña: 1234
    Volumen: Inicialización con el script SQL (init.sql)
    Comando: Configuración adicional para permitir conexiones externas

Notas Adicionales

    Asegúrate de que ningún otro servicio esté utilizando los puertos 8085 y 5432 antes de ejecutar Docker Compose.

Con estos pasos, deberías tener el proyecto en ejecución localmente.

Muchas gracias por la oportunidad de poder presentar estas pruebas 🙌.