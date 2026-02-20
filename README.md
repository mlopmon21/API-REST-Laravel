# API-REST-Laravel

Proyecto realizado en clase para la asignatura de Fullstack (2º DAW). API REST con Laravel sobre la Tierra Media: CRUD de regiones, reinos, héroes, criaturas y artefactos, con relaciones y endpoints extra (alive, dangerous, top, asignación artefacto-héroe).

## Descripción

Este proyecto implementa una API REST con Laravel para gestionar entidades inspiradas en la Tierra Media:

- **Regiones**
- **Reinos**
- **Héroes**
- **Criaturas**
- **Artefactos**

Incluye operaciones CRUD completas, relaciones entre entidades y endpoints personalizados para consultas específicas.

## Funcionalidades principales

- CRUD de regiones, reinos, héroes, criaturas y artefactos.
- Relaciones entre modelos con Eloquent ORM.
- Endpoints extra:
  - `heroes/alive` → héroes vivos
  - `creatures/dangerous` → criaturas peligrosas (filtrables por nivel)
  - `artifacts/top` → artefactos más poderosos
  - asignación y eliminación de artefactos a héroes (relación muchos-a-muchos)
- Seeders con datos de ejemplo.
- Migraciones para crear la base de datos.

## Tecnologías usadas

- **Laravel**
- **PHP**
- **Eloquent ORM**
- **SQLite/MySQL** (según configuración del `.env`)

## Puesta en marcha

1. Instalar dependencias:
   ```bash
   composer install