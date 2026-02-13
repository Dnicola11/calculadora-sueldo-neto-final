
## Información general

* La prueba técnica fue desarrollado con el objetivo de calcular el sueldo neto de un trabajador, considerando los descuentos de ley.

## Tecnologías

* La prueba técnica fue desarrollado con las siguientes tecnologías:
  - [Laravel 10](https://laravel.com/docs/10.x)
  - [Bootstrap 5.3](https://getbootstrap.com/docs/5.3/getting-started/introduction/)

## Requisitos

* Para poder ejecutar la prueba técnica se debe tener instalado lo siguiente:
  - PHP 8.x
  - Composer 2.x
  - MySQL 8.x
  - Git 2.x
  - Editor de código (VSCode, Sublime Text, Atom, etc)

## Instalación

* Se debe clonar el repositorio de GitHub:

```bash
git clone https://github.com/yhuayanay/calculadora-sueldo-neto
```

* Se debe instalar las dependencias del proyecto:

```bash
composer install
```

* Se debe configurar las variables de entorno en el archivo `.env`:

```bash
cp .env.example .env
```

* Se debe generar la llave de la aplicación:

```bash
php artisan key:generate
```

* Se debe crear la base de datos en MySQL con el nombre `laravel` y ejecutar las migraciones y seeders:

```bash
php artisan migrate:refresh --seed
```

* Para iniciar sesión en el sistema se debe utilizar el siguiente usuario:

| Usuario                   | Contraseña                    |
| :------------------------ | :---------------------------- |
| `user`                    | `12345678`                    |

## Requerimientos

* Se cuenta con un formulario simple para el registro de un trabajador, el cual debe ser validado antes de ser registrado en la base de datos. Se cuenta con los siguientes campos que deben ser validados antes de ser registrados en la base de datos:

| Campo                     | Validación                                                                        |
| :------------------------ | :-------------------------------------------------------------------------------- |
| `Nombres`                 | Campo obligatorio                                                                 |
| `Apellido paterno`        | Campo obligatorio                                                                 |
| `Apellido materno`        | Campo obligatorio                                                                 |
| `DNI`                     | Campo obligatorio, contener 8 dígitos, ser numérico y no debe estar repetido      |
| `Fecha de nacimiento`     | Campo obligatorio, ser una fecha menor a la fecha actual del sistema              |
| `Sexo`                    | Campo obligatorio                                                                 |
| `Cantidad de hijos`       | Campo obligatorio y debe ser numérico                                             |

* Adicionalmente, se debe considerar los siguientes campos bajo su criterio de validación:

| Campo                 |
| :-------------------- |
| `Foto`                |
| `Área`                |
| `Cargo`               |
| `Fecha de ingreso`    |
| `Sueldo`              |

* Se debe calcular considerar la siguiente remuneración si el trabajador tiene uno o más hijos:

| Concepto                      | Monto de remuneración     |
| :---------------------------- | :------------------------ |
| `Asignación familiar`         | S/ 102.50                 |

* Se debe calcular el sueldo neto del trabajador, considerando los siguientes descuentos:

| Concepto                      | Porcentaje de descuento   | Monto de descuento    |
| :---------------------------- | :------------------------ | :-------------------- |
| `AFP. Aportación Obligator`   | 10%                       | *No aplica*           |
| `AFP. Comisión`               | 2.5%                      | *No aplica*           |
| `Renta de 5ta Categoría`      | 10%                       | *No aplica*           |
| `EPS`                         | *No aplica*               | S/ 100.00             |

## Consideraciones

* La estructura de la base de datos debe ser considerada en las migraciones, o en su defecto, en el archivo `database.sql` que se debe encontrar en la raíz del proyecto.

* Se cuenta con una hora y media para la realización de la prueba técnica.

* La solución de la prueba técnica deberá ser cargada a un repositorio nuevo del postulante y la url generada deberá ser entregada al responsable de la prueba.
