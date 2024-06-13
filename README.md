# Proyecto OctoCHAT
<p align="center">
  <img src="logo.svg" alt="Logo OctoCHAT">
</p>

Este proyecto es una red social llamada [octoCHAT](http://ec2-44-194-37-124.compute-1.amazonaws.com/), donde los usuarios pueden crear publicaciones, Chatear, seguir a otros usuarios, dejar comentarios y más.

## Autores

- **Ismail Hilmi**
  - [LinkedIn](https://www.linkedin.com/in/ismail-hilmi/)

## Características

- **Publicaciones**: Los usuarios pueden crear publicaciones y compartir contenido.
- **Likes**: Los usuarios pueden dar "Me gusta" a las publicaciones de otros usuarios.
- **Tags**: Las publicaciones pueden ser etiquetadas con diferentes tags para categorizarlas.
- **Chat**: Los usuarios pueden chatear en tiempo real utilizando la funcionalidad de chat integrada.
- **Seguimiento**: Los usuarios pueden seguir a otros usuarios y recibir actualizaciones.
- **Comentarios**: Los usuarios pueden dejar comentarios en las publicaciones de otros.
- **Administración**: Los administradores pueden gestionar usuarios, publicaciones y comentarios.

## Tecnologías Utilizadas

- **Laravel**: Framework de desarrollo web para el backend.
- **Reverb**: Biblioteca para implementar funcionalidad de chat en tiempo real.
- **Livewire**: Biblioteca de Laravel para interfaces de usuario interactivas.
- **Tailwind CSS**: Framework de CSS para el diseño y estilo del frontend.
- **JavaScript**: Lenguaje de programación para funcionalidades interactivas en el frontend.
- **SQLite**: Sistema de gestión de bases de datos para almacenar los datos.


## Instalación

1. Clona el repositorio a tu máquina local:
git clone https://github.com/HilmiIsmail/octoboss.git

2. Instala las dependencias del proyecto:
cd octoCHAT
composer install
npm install
npm run dev


3. Configura el archivo `.env` con la información de tu base de datos y otras configuraciones necesarias.

4. Ejecuta las migraciones y los seeders para crear las tablas de la base de datos y generar datos ficticios:
php artisan migrate --seed


5. Inicia el servidor de desarrollo:
php artisan serve

6. Accede al proyecto en tu navegador en `http://localhost:8000`.

## Licencia

Este proyecto está bajo la licencia [![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
