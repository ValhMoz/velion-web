# Proyecto ERP para Gestión de Citas de Clínica

Este proyecto consiste en un Sistema de Gestión de Recursos Empresariales (ERP) desarrollado para la gestión eficiente de citas en una clínica médica. Proporciona una interfaz de usuario intuitiva y funcionalidades completas para administrar citas de pacientes, médicos y recursos de la clínica.

## El proyecto utiliza las siguientes tecnologías y herramientas:

1. HTML5
2. CSS3
3. JavaScript
4. jQuery
5. Bootstrap
6. PHP
7. Librería externa: FPDF (para la generación de documentos PDF)

## Características Principales

1. Registro y gestión de pacientes.
2. Programación y gestión de citas médicas.
3. Gestión de médicos y personal de la clínica.
4. Visualización de calendario con citas programadas.
5. Generación de informes y documentos PDF de citas.

## Instalación y Configuración

1. Clona este repositorio a tu máquina local.

2. Coloca el proyecto en tu servidor web local (p. ej., XAMPP, WAMP, etc.).

3. Importa la base de datos proporcionada (/models/clinic-managment.sql) en tu sistema de gestión de bases de datos (p. ej., MySQL).

4. Configura la conexión a la base de datos en el archivo BaseModel.php.

5. Accede al proyecto desde tu navegador web:

    http://localhost/clinic-managment/index.php

## Licencia

Este proyecto está bajo la Licencia MIT.

## NOTA

Para arrancar docker deberás ejecutar el comando:
```bash
 sudo docker compose up --build
 ```