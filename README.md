
# Prueba Técnica - Alonso Parra

Proyecto de Laravel 12, Bootstrap UI.

## Requisitos previos
Es importante asegúrarse de tener instalado el siguiente stack:
- PHP 8.1+ (Versión recomendada: 8.3)
- Composer
- Node.js 20+ y NPM
- Git
## Instalación
### 1. Clonar el repositorio
```bash
  git clone https://github.com/ParraAlonso/prueba-nyrentek
  cd prueba-nyrentek
  git checkout main
```

### 2. Instalar dependencias
```bash
  composer install
  npm install
```
### 3. Configurar archivo de ambiente (.env)
#### 3.1. Crear el archivo .env utilizando el archivo de ejemplo .env.example
```bash
  cp .env.example .env
```
#### 3.2. Generar la clave de la aplicación
```bash
  php artisan key:generate
```
#### 3.3. Configurar variables de base de datos
Si no tiene una base de datos creada previamente, deberás crearla y establecer los valores en las siguientes variables:
En caso de utilizar SQLITE, se pueden comentar todas las variables a excepción de DB_CONNECTION=sqlite (Importante tener la extensión de php-pdo-sqlite habilitada)

	DB_CONNECTION=pgsql
	DB_HOST=127.0.0.1
	DB_PORT=5432
	DB_DATABASE="NOMBRE_BASE_DE_DATOS"
	DB_USERNAME="USUARIO_BASE_DE_DATOS"
	DB_PASSWORD="CONTRASEÑA_USUARIO_BASE_DE_DATOS"

#### 3.4. Establecer API_KEY de Pexels.com
Es importante establecer la API_KEY de Pexels, de no establecerla se limitará la funcionalidad de la aplicación ya que se utiliza la API de Pexels para obetener imágenes y guardarlas en la base de datos.

	PEXELS_API_KEY="API_KEY"

#### 3.5. Configurar variables de Mailing
Es importante configurar correctamente las variables del servicio de Mailing, ya que para que un usuario pueda completar su registro e iniciar sesión, debe establecer su contraseña a través de un correo electrónico que recibe.
Puede utilizar un servicio como Mailtrap en caso de no contar con un proovedor de correo.

	MAIL_MAILER=smtp
	MAIL_HOST=sandbox.smtp.mailtrap.io
	MAIL_PORT=2525
	MAIL_USERNAME=
	MAIL_PASSWORD=

#### 3.6. Guardar en caché los cambios del archivo .env
```bash
  php artisan optimize
```
### 4. Ejecutar migraciones y seeders
```bash
  php artisan migrate --seed
```
### 5. Generar enlace simbólico del storage
```bash
  php artisan storage:link
```
### 6. Compilar assets
```bash
  npm run build
```
## Ejecución del proyecto
Para iniciar el servidor de desarrollo de laravel, ejecute el siguiente comando:
```bash
  php artisan serve
```
El proyecto estará disponible en http://127.0.0.1:8000.
