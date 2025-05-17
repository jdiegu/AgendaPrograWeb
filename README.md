# CRUD Contactos

Aplicación web de una agenda telefónica, con manejo de contactos y gestión de usuarios mediante un sistema de roles.

---

## Tabla de contenido

- [Descripción](#descripción)
- [Captura de pantalla](#captura-de-pantalla)
- [Instalación y ejecución](#instalación-y-ejecución)
- [Usuarios de prueba](#usuarios-de-prueba)
- [Información de contacto](#información-de-contacto)

---

## Descripción

**CRUD Contactos** es una aplicación desarrollada en PHP que permite gestionar una agenda telefónica de forma digital. Está diseñada con conexión a base de datos MySQL utilizando PDO y contempla dos tipos de usuarios: administradores y visualizadores.

La aplicación permite:

- Crear, leer, actualizar y eliminar contactos.
- Restringir funciones según el rol del usuario.
- Operar en un entorno local configurado mediante XAMPP.

> **Nota:** Este proyecto fue desarrollado con fines académicos para la asignatura de Programación Web.

---

## Captura de pantalla

![Pantalla inicial](https://github.com/user-attachments/assets/484f4697-3281-4a14-906b-6a51a3499d16)

---

## Instalación y ejecución

### Requisitos

- Tener instalado [XAMPP](https://www.apachefriends.org/index.html)

### Pasos para ejecutar el proyecto

1. Descargue el contenido de este repositorio y descomprímalo en una carpeta local.
2. Mueva la carpeta descomprimida a la carpeta `htdocs` de XAMPP, ubicada comúnmente en `C:\xampp\htdocs`.
3. Localice el archivo `agendamodelos.sql` dentro de la carpeta `database` del proyecto.
4. Abra [http://localhost/phpmyadmin](http://localhost/phpmyadmin) desde su navegador.
5. Cree una nueva base de datos (preferentemente con el nombre `agendamodelos`).
6. Use la opción **Importar** y seleccione el archivo `agendamodelos.sql` para cargar la estructura y datos.
7. Acceda a la aplicación desde su navegador con la URL: [http://localhost/AgendaPrograWeb/](http://localhost/AgendaPrograWeb/) o la direccion del proyecto donde se guardo.
8. ¡Listo! Puede comenzar a utilizar la aplicación.

> **Importante:** Verifique que los servicios de Apache y MySQL estén activos desde el panel de control de XAMPP.

> **Sugerencia:** Asegúrese de que el nombre de la base de datos coincida con el especificado en el archivo de conexión de la aplicación (`config/db.php` o similar).

---

## Usuarios de prueba

El usuario administrador tiene la clave `1` y contraseña `1234`.  
Un usuario visualizador es el de clave `2` y contraseña `abcd`.

---

## Información de contacto

**Nombre:** Morales Vázquez Juan Diego  
**Número de control:** 22010969  
**Materia:** Programación Web (Horario 12-13 h)  
**Docente:** *(Complete con el nombre del profesor)*

---
