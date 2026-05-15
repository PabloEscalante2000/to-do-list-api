# To-Do List API

REST API para gestión de tareas personales, construida con Laravel 11 y autenticación mediante tokens con Laravel Sanctum.

Proyecto basado en: [https://roadmap.sh/projects/todo-list-api](https://roadmap.sh/projects/todo-list-api)

---

## Tecnologías

- **PHP 8+**
- **Laravel 11**
- **Laravel Sanctum** — autenticación por tokens
- **SQLite** — base de datos

---

## Instalación

```bash
# 1. Clonar el repositorio
git clone <url-del-repo>
cd to-do-list-api

# 2. Instalar dependencias
composer install

# 3. Copiar el archivo de entorno
cp .env.example .env

# 4. Generar la clave de la aplicación
php artisan key:generate

# 5. Crear la base de datos y correr las migraciones
touch database/database.sqlite
php artisan migrate

# 6. (Opcional) Poblar con datos de prueba
php artisan db:seed
```

---

## Endpoints

### Autenticación

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| POST | `/api/register` | Registro de usuario |
| POST | `/api/login` | Login — retorna token |
| POST | `/api/logout` | Logout — requiere token |

### Tareas `(requieren token)`

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/v1/todos` | Listar tareas del usuario |
| POST | `/api/v1/todos` | Crear tarea |
| GET | `/api/v1/todos/{id}` | Ver tarea |
| PUT | `/api/v1/todos/{id}` | Actualizar tarea |
| DELETE | `/api/v1/todos/{id}` | Eliminar tarea |

---

## Autenticación

Incluir el token en el header de cada petición protegida:

```
Authorization: Bearer {token}
```

---

## Campos de una tarea

| Campo | Tipo | Requerido | Descripción |
|-------|------|-----------|-------------|
| `title` | string | ✅ | Título (3-255 caracteres) |
| `description` | string | ✅ | Descripción (3-255 caracteres) |
| `status` | string | ✅ | `Pendiente`, `En proceso`, `Completado`, `Cancelado` |

---

## Ejemplo de uso

**Registro:**
```json
POST /api/register
{
    "name": "Pablo Escalante",
    "email": "pablo@example.com",
    "password": "password123"
}
```

**Crear tarea:**
```json
POST /api/v1/todos
Authorization: Bearer {token}

{
    "title": "Comprar víveres",
    "description": "Leche, pan y huevos",
    "status": "Pendiente"
}
```
