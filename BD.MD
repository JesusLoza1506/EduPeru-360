-- =============================================
-- 1. Módulo de Usuarios, Roles y Permisos
-- =============================================
CREATE TABLE users (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
apellido VARCHAR(100) NOT NULL,
dni CHAR(8) UNIQUE NOT NULL,
email VARCHAR(255) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
telefono VARCHAR(15),
rol ENUM('Administrador General','Director','Docente','Estudiante','Padre') NOT NULL,
activo TINYINT(1) DEFAULT 1,
email_verified_at TIMESTAMP NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
INDEX idx_rol (rol)
);

-- =============================================
-- 2. Módulo de Matrícula
-- =============================================
CREATE TABLE anos_escolares (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
ano YEAR NOT NULL UNIQUE,
fecha_inicio DATE NOT NULL,
fecha_fin DATE NOT NULL,
activo TINYINT(1) DEFAULT 1
);

CREATE TABLE grados (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nivel ENUM('Primaria','Secundaria') NOT NULL,
grado TINYINT NOT NULL,
seccion CHAR(1) NOT NULL,
capacidad TINYINT DEFAULT 35,
UNIQUE KEY unique_grado (nivel, grado, seccion)
);

CREATE TABLE estudiantes (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id BIGINT UNSIGNED UNIQUE NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE matriculas (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
estudiante_id BIGINT UNSIGNED NOT NULL,
grado_id BIGINT UNSIGNED NOT NULL,
ano_escolar_id BIGINT UNSIGNED NOT NULL,
fecha_matricula DATE NOT NULL,
estado ENUM('Activo','Retirado','Repitente') DEFAULT 'Activo',
ficha_pdf VARCHAR(255),
FOREIGN KEY (estudiante_id) REFERENCES estudiantes(id) ON DELETE CASCADE,
FOREIGN KEY (grado_id) REFERENCES grados(id),
FOREIGN KEY (ano_escolar_id) REFERENCES anos_escolares(id),
UNIQUE KEY unique_matricula (estudiante_id, ano_escolar_id)
);

CREATE TABLE padre_hijo (
padre_id BIGINT UNSIGNED NOT NULL,
estudiante_id BIGINT UNSIGNED NOT NULL,
parentesco VARCHAR(20) DEFAULT 'Padre/Madre',
PRIMARY KEY (padre_id, estudiante_id),
FOREIGN KEY (padre_id) REFERENCES users(id) ON DELETE CASCADE,
FOREIGN KEY (estudiante_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =============================================
-- 3. Módulo de Cursos y Horarios
-- =============================================
CREATE TABLE cursos (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
area_curricular VARCHAR(100) NOT NULL
);

CREATE TABLE asignacion_cursos (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
curso_id BIGINT UNSIGNED NOT NULL,
grado_id BIGINT UNSIGNED NOT NULL,
docente_id BIGINT UNSIGNED NOT NULL,
ano_escolar_id BIGINT UNSIGNED NOT NULL,
FOREIGN KEY (curso_id) REFERENCES cursos(id),
FOREIGN KEY (grado_id) REFERENCES grados(id),
FOREIGN KEY (docente_id) REFERENCES users(id),
FOREIGN KEY (ano_escolar_id) REFERENCES anos_escolares(id),
UNIQUE KEY unique_asignacion (grado_id, curso_id, ano_escolar_id)
);

CREATE TABLE horarios (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
asignacion_curso_id BIGINT UNSIGNED NOT NULL,
dia ENUM('Lunes','Martes','Miércoles','Jueves','Viernes') NOT NULL,
hora_inicio TIME NOT NULL,
hora_fin TIME NOT NULL,
FOREIGN KEY (asignacion_curso_id) REFERENCES asignacion_cursos(id) ON DELETE CASCADE
);

-- =============================================
-- 4. Módulo de Asistencia
-- =============================================
CREATE TABLE asistencias (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
matricula_id BIGINT UNSIGNED NOT NULL,
asignacion_curso_id BIGINT UNSIGNED NOT NULL,
fecha DATE NOT NULL,
estado ENUM('Presente','Ausente','Tardanza','Justificado') NOT NULL,
observacion TEXT,
FOREIGN KEY (matricula_id) REFERENCES matriculas(id) ON DELETE CASCADE,
FOREIGN KEY (asignacion_curso_id) REFERENCES asignacion_cursos(id),
UNIQUE KEY unique_asistencia (matricula_id, asignacion_curso_id, fecha)
);

-- =============================================
-- 5. Módulo de Notas y Evaluaciones
-- =============================================
CREATE TABLE bimestres (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
ano_escolar_id BIGINT UNSIGNED NOT NULL,
numero TINYINT NOT NULL CHECK (numero BETWEEN 1 AND 4),
fecha_inicio DATE NOT NULL,
fecha_fin DATE NOT NULL,
FOREIGN KEY (ano_escolar_id) REFERENCES anos_escolares(id),
UNIQUE KEY unique_bimestre (ano_escolar_id, numero)
);

CREATE TABLE notas (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
matricula_id BIGINT UNSIGNED NOT NULL,
asignacion_curso_id BIGINT UNSIGNED NOT NULL,
bimestre_id BIGINT UNSIGNED NOT NULL,
nota DECIMAL(4,2) NOT NULL CHECK (nota BETWEEN 0 AND 20),
competencias JSON NULL, -- Ej: [{"competencia":"Resuelve problemas","nivel":"A"}]
FOREIGN KEY (matricula_id) REFERENCES matriculas(id) ON DELETE CASCADE,
FOREIGN KEY (asignacion_curso_id) REFERENCES asignacion_cursos(id),
FOREIGN KEY (bimestre_id) REFERENCES bimestres(id),
UNIQUE KEY unique_nota (matricula_id, asignacion_curso_id, bimestre_id)
);

CREATE TABLE promedios_anuales (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
matricula_id BIGINT UNSIGNED NOT NULL,
asignacion_curso_id BIGINT UNSIGNED NOT NULL,
promedio DECIMAL(4,2) NOT NULL,
aprobado TINYINT(1) AS (IF(promedio >= 11, 1, 0)) STORED,
FOREIGN KEY (matricula_id) REFERENCES matriculas(id),
FOREIGN KEY (asignacion_curso_id) REFERENCES asignacion_cursos(id)
);

CREATE TABLE recuperaciones (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
matricula_id BIGINT UNSIGNED NOT NULL,
asignacion_curso_id BIGINT UNSIGNED NOT NULL,
nota_original DECIMAL(4,2),
nota_recuperacion DECIMAL(4,2),
fecha DATE,
aprobado_final TINYINT(1),
FOREIGN KEY (matricula_id) REFERENCES matriculas(id),
FOREIGN KEY (asignacion_curso_id) REFERENCES asignacion_cursos(id)
);

-- =============================================
-- 6. Módulo de Tareas y Materiales
-- =============================================
CREATE TABLE tareas (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
asignacion_curso_id BIGINT UNSIGNED NOT NULL,
titulo VARCHAR(255) NOT NULL,
descripcion TEXT,
fecha_entrega DATE NOT NULL,
archivo_adjunto VARCHAR(255),
FOREIGN KEY (asignacion_curso_id) REFERENCES asignacion_cursos(id) ON DELETE CASCADE
);

CREATE TABLE entregas_tareas (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tarea_id BIGINT UNSIGNED NOT NULL,
matricula_id BIGINT UNSIGNED NOT NULL,
archivo VARCHAR(255),
calificacion DECIMAL(4,2),
observacion TEXT,
fecha_entrega DATETIME,
FOREIGN KEY (tarea_id) REFERENCES tareas(id) ON DELETE CASCADE,
FOREIGN KEY (matricula_id) REFERENCES matriculas(id) ON DELETE CASCADE
);

CREATE TABLE materiales (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
asignacion_curso_id BIGINT UNSIGNED NOT NULL,
titulo VARCHAR(255) NOT NULL,
descripcion TEXT,
archivo VARCHAR(255),
fecha_publicacion DATE NOT NULL,
FOREIGN KEY (asignacion_curso_id) REFERENCES asignacion_cursos(id) ON DELETE CASCADE
);

-- =============================================
-- 7. Módulo de Comunicación y Notificaciones
-- =============================================
CREATE TABLE comunicados (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
emisor_id BIGINT UNSIGNED NOT NULL,
titulo VARCHAR(255),
contenido TEXT NOT NULL,
tipo_destinatario ENUM('Todos','Docentes','Padres','Estudiantes','Grado') NOT NULL,
grado_id BIGINT UNSIGNED NULL,
archivo VARCHAR(255),
fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (emisor_id) REFERENCES users(id),
FOREIGN KEY (grado_id) REFERENCES grados(id)
);

CREATE TABLE notificaciones (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
comunicado_id BIGINT UNSIGNED NOT NULL,
receptor_id BIGINT UNSIGNED NOT NULL,
leido TINYINT(1) DEFAULT 0,
fecha_leido DATETIME NULL,
FOREIGN KEY (comunicado_id) REFERENCES comunicados(id) ON DELETE CASCADE,
FOREIGN KEY (receptor_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =============================================
-- 8. Módulo de Comportamiento y Conducta
-- =============================================
CREATE TABLE conducta (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
matricula_id BIGINT UNSIGNED NOT NULL,
docente_id BIGINT UNSIGNED NOT NULL,
tipo ENUM('Incidencia','Reconocimiento') NOT NULL,
descripcion TEXT NOT NULL,
fecha DATE NOT NULL,
FOREIGN KEY (matricula_id) REFERENCES matriculas(id),
FOREIGN KEY (docente_id) REFERENCES users(id)
);

-- =============================================
-- 9. Módulo de Certificados y Constancias + Reportes
-- =============================================
CREATE TABLE certificados (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
matricula_id BIGINT UNSIGNED NOT NULL,
tipo ENUM('Estudios','Matrícula','Conducta','Libreta Bimestral') NOT NULL,
archivo_pdf VARCHAR(255) NOT NULL,
codigo_verificacion CHAR(20) UNIQUE,
fecha_generacion DATE NOT NULL,
FOREIGN KEY (matricula_id) REFERENCES matriculas(id)
);

CREATE TABLE reportes (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tipo ENUM('Notas','Asistencia','Matrícula','Comportamiento') NOT NULL,
filtros JSON,
archivo VARCHAR(255),
fecha_generacion DATE NOT NULL
);

-- =============================================
-- 10. Módulo de Auditoría y Bitácora
-- =============================================
CREATE TABLE auditoria (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id BIGINT UNSIGNED NULL,
accion VARCHAR(255) NOT NULL,
tabla VARCHAR(100),
registro_id BIGINT NULL,
datos JSON,
ip VARCHAR(45),
fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (user_id) REFERENCES users(id)
);

-- =============================================
-- 11. Módulo de Copias de Seguridad y Recuperación
-- =============================================
CREATE TABLE backups (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
archivo VARCHAR(255) NOT NULL,
tamaño_mb DECIMAL(10,2),
tipo ENUM('Automático','Manual'),
fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `solicitudes_matricula` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`padre_id` bigint unsigned NOT NULL,
`nombre_estudiante` varchar(100) NOT NULL,
`apellido_estudiante` varchar(100) NOT NULL,
`dni_estudiante` char(8) NOT NULL,
`grado_id` bigint unsigned NOT NULL,
`ano_escolar_id` bigint unsigned NOT NULL,
`fecha_solicitud` date NOT NULL,
`monto_matricula` decimal(8,2) NOT NULL,
`monto_mensualidad` decimal(8,2) NOT NULL,
`comprobante_pago` varchar(255) DEFAULT NULL,
`estado` enum('Pendiente','Revisado','Aprobado','Rechazado') DEFAULT 'Pendiente',
`observaciones` text,
`fecha_revision` date DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `padre_id` (`padre_id`),
KEY `grado_id` (`grado_id`),
KEY `ano_escolar_id` (`ano_escolar_id`),
CONSTRAINT `solicitudes_matricula_ibfk_1` FOREIGN KEY (`padre_id`) REFERENCES `users` (`id`),
CONSTRAINT `solicitudes_matricula_ibfk_2` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`),
CONSTRAINT `solicitudes_matricula_ibfk_3` FOREIGN KEY (`ano_escolar_id`) REFERENCES `anos_escolares` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
