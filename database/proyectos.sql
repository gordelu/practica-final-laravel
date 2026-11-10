-- =====================================================================
-- Base de datos: gestión de proyectos (MySQL / MariaDB)
-- =====================================================================
-- Usa la tabla `users` que crea Laravel (migración 0001_01_01_000000)
-- y que utilizan Breeze y el login. Este script NO crea ni borra `users`.
--
-- Relaciones:
--   1:N  Un usuario CREA muchos proyectos; un proyecto lo crea un usuario.
--        -> proyectos.user_id
--   N:M  Un usuario PARTICIPA en muchos proyectos; un proyecto tiene
--        muchos participantes. La relación guarda rol y horas.
--        -> tabla intermedia proyecto_user
-- =====================================================================

-- USE laravel;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS proyecto_user;
DROP TABLE IF EXISTS proyecto_usuario;  -- versión anterior del script
DROP TABLE IF EXISTS proyectos;
DROP TABLE IF EXISTS usuarios;          -- versión anterior del script
SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------------------------
-- Tabla: proyectos
-- ---------------------------------------------------------------------
CREATE TABLE proyectos (
    id                 BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id            BIGINT UNSIGNED NOT NULL,   -- creador del proyecto (relación 1:N)
    titulo             VARCHAR(255)    NOT NULL,
    descripcion        TEXT            NULL,
    fecha_vencimiento  DATE            NULL,
    estado             ENUM('pendiente', 'en_progreso', 'completado') NOT NULL DEFAULT 'pendiente',
    created_at         TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at         TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    KEY proyectos_user_id_index (user_id),
    CONSTRAINT proyectos_user_id_foreign
        FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Tabla intermedia: proyecto_user (participación, relación N:M)
-- ---------------------------------------------------------------------
CREATE TABLE proyecto_user (
    id                  BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    proyecto_id         BIGINT UNSIGNED NOT NULL,
    user_id             BIGINT UNSIGNED NOT NULL,
    rol                 VARCHAR(50)     NOT NULL DEFAULT 'colaborador',
    horas_contribucion  DECIMAL(6,2)    NOT NULL DEFAULT 0.00,
    created_at          TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at          TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE KEY proyecto_user_unique (proyecto_id, user_id),  -- un usuario no se repite en el mismo proyecto
    KEY proyecto_user_user_id_index (user_id),
    CONSTRAINT proyecto_user_horas_check CHECK (horas_contribucion >= 0),
    CONSTRAINT proyecto_user_proyecto_id_foreign
        FOREIGN KEY (proyecto_id) REFERENCES proyectos (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT proyecto_user_user_id_foreign
        FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
