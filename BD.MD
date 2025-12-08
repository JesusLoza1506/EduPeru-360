## -- MySQL dump 10.13 Distrib 8.0.44, for Win64 (x86_64)

-- Host: trolley.proxy.rlwy.net Database: railway

---

-- Server version 9.4.0

/_!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT _/;
/_!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS _/;
/_!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION _/;
/_!50503 SET NAMES utf8 _/;
/_!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE _/;
/_!40103 SET TIME_ZONE='+00:00' _/;
/_!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 _/;
/_!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 _/;
/_!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' _/;
/_!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 _/;

--
-- Table structure for table `anos_escolares`
--

DROP TABLE IF EXISTS `anos_escolares`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `anos_escolares` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`ano` year NOT NULL,
`fecha_inicio` date NOT NULL,
`fecha_fin` date NOT NULL,
`activo` tinyint(1) DEFAULT '1',
PRIMARY KEY (`id`),
UNIQUE KEY `ano` (`ano`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `anos_escolares`
--

LOCK TABLES `anos_escolares` WRITE;
/_!40000 ALTER TABLE `anos_escolares` DISABLE KEYS _/;
INSERT INTO `anos_escolares` VALUES (1,2026,'2026-03-09','2026-12-11',1);
/_!40000 ALTER TABLE `anos_escolares` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `asignacion_cursos`
--

DROP TABLE IF EXISTS `asignacion_cursos`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `asignacion_cursos` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`curso_id` bigint unsigned NOT NULL,
`grado_id` bigint unsigned NOT NULL,
`docente_id` bigint unsigned NOT NULL,
`ano_escolar_id` bigint unsigned NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `unique_asignacion` (`grado_id`,`curso_id`,`ano_escolar_id`),
KEY `curso_id` (`curso_id`),
KEY `docente_id` (`docente_id`),
KEY `ano_escolar_id` (`ano_escolar_id`),
CONSTRAINT `asignacion_cursos_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
CONSTRAINT `asignacion_cursos_ibfk_2` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`),
CONSTRAINT `asignacion_cursos_ibfk_3` FOREIGN KEY (`docente_id`) REFERENCES `users` (`id`),
CONSTRAINT `asignacion_cursos_ibfk_4` FOREIGN KEY (`ano_escolar_id`) REFERENCES `anos_escolares` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `asignacion_cursos`
--

LOCK TABLES `asignacion_cursos` WRITE;
/_!40000 ALTER TABLE `asignacion_cursos` DISABLE KEYS _/;
/_!40000 ALTER TABLE `asignacion_cursos` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `asistencias`
--

DROP TABLE IF EXISTS `asistencias`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `asistencias` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`matricula_id` bigint unsigned NOT NULL,
`asignacion_curso_id` bigint unsigned NOT NULL,
`fecha` date NOT NULL,
`estado` enum('Presente','Ausente','Tardanza','Justificado') NOT NULL,
`observacion` text,
PRIMARY KEY (`id`),
UNIQUE KEY `unique_asistencia` (`matricula_id`,`asignacion_curso_id`,`fecha`),
KEY `asignacion_curso_id` (`asignacion_curso_id`),
CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`matricula_id`) REFERENCES `matriculas` (`id`) ON DELETE CASCADE,
CONSTRAINT `asistencias_ibfk_2` FOREIGN KEY (`asignacion_curso_id`) REFERENCES `asignacion_cursos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `asistencias`
--

LOCK TABLES `asistencias` WRITE;
/_!40000 ALTER TABLE `asistencias` DISABLE KEYS _/;
/_!40000 ALTER TABLE `asistencias` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `auditoria`
--

DROP TABLE IF EXISTS `auditoria`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `auditoria` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`user_id` bigint unsigned DEFAULT NULL,
`accion` varchar(255) NOT NULL,
`tabla` varchar(100) DEFAULT NULL,
`registro_id` bigint DEFAULT NULL,
`datos` json DEFAULT NULL,
`ip` varchar(45) DEFAULT NULL,
`fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `user_id` (`user_id`),
CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `auditoria`
--

LOCK TABLES `auditoria` WRITE;
/_!40000 ALTER TABLE `auditoria` DISABLE KEYS _/;
/_!40000 ALTER TABLE `auditoria` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `backups`
--

DROP TABLE IF EXISTS `backups`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `backups` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`archivo` varchar(255) NOT NULL,
`tamaño_mb` decimal(10,2) DEFAULT NULL,
`tipo` enum('Automático','Manual') DEFAULT NULL,
`fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `backups`
--

LOCK TABLES `backups` WRITE;
/_!40000 ALTER TABLE `backups` DISABLE KEYS _/;
/_!40000 ALTER TABLE `backups` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `bimestres`
--

DROP TABLE IF EXISTS `bimestres`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `bimestres` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`ano_escolar_id` bigint unsigned NOT NULL,
`numero` tinyint NOT NULL,
`fecha_inicio` date NOT NULL,
`fecha_fin` date NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `unique_bimestre` (`ano_escolar_id`,`numero`),
CONSTRAINT `bimestres_ibfk_1` FOREIGN KEY (`ano_escolar_id`) REFERENCES `anos_escolares` (`id`),
CONSTRAINT `bimestres_chk_1` CHECK ((`numero` between 1 and 4))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `bimestres`
--

LOCK TABLES `bimestres` WRITE;
/_!40000 ALTER TABLE `bimestres` DISABLE KEYS _/;
/_!40000 ALTER TABLE `bimestres` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `cache` (
`key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
`expiration` int NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/_!40000 ALTER TABLE `cache` DISABLE KEYS _/;
/_!40000 ALTER TABLE `cache` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `cache_locks` (
`key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`expiration` int NOT NULL,
PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/_!40000 ALTER TABLE `cache_locks` DISABLE KEYS _/;
/_!40000 ALTER TABLE `cache_locks` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `certificados`
--

DROP TABLE IF EXISTS `certificados`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `certificados` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`matricula_id` bigint unsigned NOT NULL,
`tipo` enum('Estudios','Matrícula','Conducta','Libreta Bimestral') NOT NULL,
`archivo_pdf` varchar(255) NOT NULL,
`codigo_verificacion` char(20) DEFAULT NULL,
`fecha_generacion` date NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `codigo_verificacion` (`codigo_verificacion`),
KEY `matricula_id` (`matricula_id`),
CONSTRAINT `certificados_ibfk_1` FOREIGN KEY (`matricula_id`) REFERENCES `matriculas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `certificados`
--

LOCK TABLES `certificados` WRITE;
/_!40000 ALTER TABLE `certificados` DISABLE KEYS _/;
/_!40000 ALTER TABLE `certificados` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `comunicados`
--

DROP TABLE IF EXISTS `comunicados`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `comunicados` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`emisor_id` bigint unsigned NOT NULL,
`titulo` varchar(255) DEFAULT NULL,
`contenido` text NOT NULL,
`tipo_destinatario` enum('Todos','Docentes','Padres','Estudiantes','Grado') NOT NULL,
`grado_id` bigint unsigned DEFAULT NULL,
`archivo` varchar(255) DEFAULT NULL,
`fecha_envio` datetime DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `emisor_id` (`emisor_id`),
KEY `grado_id` (`grado_id`),
CONSTRAINT `comunicados_ibfk_1` FOREIGN KEY (`emisor_id`) REFERENCES `users` (`id`),
CONSTRAINT `comunicados_ibfk_2` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `comunicados`
--

LOCK TABLES `comunicados` WRITE;
/_!40000 ALTER TABLE `comunicados` DISABLE KEYS _/;
/_!40000 ALTER TABLE `comunicados` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `conducta`
--

DROP TABLE IF EXISTS `conducta`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `conducta` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`matricula_id` bigint unsigned NOT NULL,
`docente_id` bigint unsigned NOT NULL,
`tipo` enum('Incidencia','Reconocimiento') NOT NULL,
`descripcion` text NOT NULL,
`fecha` date NOT NULL,
PRIMARY KEY (`id`),
KEY `matricula_id` (`matricula_id`),
KEY `docente_id` (`docente_id`),
CONSTRAINT `conducta_ibfk_1` FOREIGN KEY (`matricula_id`) REFERENCES `matriculas` (`id`),
CONSTRAINT `conducta_ibfk_2` FOREIGN KEY (`docente_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `conducta`
--

LOCK TABLES `conducta` WRITE;
/_!40000 ALTER TABLE `conducta` DISABLE KEYS _/;
/_!40000 ALTER TABLE `conducta` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `cursos` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`nombre` varchar(100) NOT NULL,
`area_curricular` varchar(100) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/_!40000 ALTER TABLE `cursos` DISABLE KEYS _/;
/_!40000 ALTER TABLE `cursos` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `entregas_tareas`
--

DROP TABLE IF EXISTS `entregas_tareas`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `entregas_tareas` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`tarea_id` bigint unsigned NOT NULL,
`matricula_id` bigint unsigned NOT NULL,
`archivo` varchar(255) DEFAULT NULL,
`calificacion` decimal(4,2) DEFAULT NULL,
`observacion` text,
`fecha_entrega` datetime DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `tarea_id` (`tarea_id`),
KEY `matricula_id` (`matricula_id`),
CONSTRAINT `entregas_tareas_ibfk_1` FOREIGN KEY (`tarea_id`) REFERENCES `tareas` (`id`) ON DELETE CASCADE,
CONSTRAINT `entregas_tareas_ibfk_2` FOREIGN KEY (`matricula_id`) REFERENCES `matriculas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `entregas_tareas`
--

LOCK TABLES `entregas_tareas` WRITE;
/_!40000 ALTER TABLE `entregas_tareas` DISABLE KEYS _/;
/_!40000 ALTER TABLE `entregas_tareas` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `estudiantes`
--

DROP TABLE IF EXISTS `estudiantes`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `estudiantes` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`user_id` bigint unsigned NOT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `user_id` (`user_id`),
CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `estudiantes`
--

LOCK TABLES `estudiantes` WRITE;
/_!40000 ALTER TABLE `estudiantes` DISABLE KEYS _/;
/_!40000 ALTER TABLE `estudiantes` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `failed_jobs` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
`queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
`payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
`exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
`failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/_!40000 ALTER TABLE `failed_jobs` DISABLE KEYS _/;
/_!40000 ALTER TABLE `failed_jobs` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `grados`
--

DROP TABLE IF EXISTS `grados`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `grados` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`nivel` enum('Primaria','Secundaria') NOT NULL,
`grado` tinyint NOT NULL,
`seccion` char(1) NOT NULL,
`capacidad` tinyint DEFAULT '35',
PRIMARY KEY (`id`),
UNIQUE KEY `unique_grado` (`nivel`,`grado`,`seccion`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `grados`
--

LOCK TABLES `grados` WRITE;
/_!40000 ALTER TABLE `grados` DISABLE KEYS _/;
INSERT INTO `grados` VALUES (1,'Primaria',1,'A',35),(2,'Primaria',1,'B',35),(3,'Primaria',2,'A',35),(4,'Primaria',2,'B',35),(5,'Primaria',3,'A',35),(6,'Primaria',3,'B',35),(7,'Primaria',4,'A',35),(8,'Primaria',4,'B',35),(9,'Primaria',5,'A',35),(10,'Primaria',5,'B',35),(11,'Primaria',6,'A',35),(12,'Primaria',6,'B',35),(13,'Secundaria',1,'A',35),(14,'Secundaria',1,'B',35),(15,'Secundaria',2,'A',35),(16,'Secundaria',2,'B',35),(17,'Secundaria',3,'A',35),(18,'Secundaria',3,'B',35),(19,'Secundaria',4,'A',35),(20,'Secundaria',4,'B',35),(21,'Secundaria',5,'A',35),(22,'Secundaria',5,'B',35);
/_!40000 ALTER TABLE `grados` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `horarios` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`asignacion_curso_id` bigint unsigned NOT NULL,
`dia` enum('Lunes','Martes','Miércoles','Jueves','Viernes') NOT NULL,
`hora_inicio` time NOT NULL,
`hora_fin` time NOT NULL,
PRIMARY KEY (`id`),
KEY `asignacion_curso_id` (`asignacion_curso_id`),
CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`asignacion_curso_id`) REFERENCES `asignacion_cursos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/_!40000 ALTER TABLE `horarios` DISABLE KEYS _/;
/_!40000 ALTER TABLE `horarios` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `job_batches` (
`id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`total_jobs` int NOT NULL,
`pending_jobs` int NOT NULL,
`failed_jobs` int NOT NULL,
`failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
`options` mediumtext COLLATE utf8mb4_unicode_ci,
`cancelled_at` int DEFAULT NULL,
`created_at` int NOT NULL,
`finished_at` int DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/_!40000 ALTER TABLE `job_batches` DISABLE KEYS _/;
/_!40000 ALTER TABLE `job_batches` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `jobs` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
`attempts` tinyint unsigned NOT NULL,
`reserved_at` int unsigned DEFAULT NULL,
`available_at` int unsigned NOT NULL,
`created_at` int unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/_!40000 ALTER TABLE `jobs` DISABLE KEYS _/;
/_!40000 ALTER TABLE `jobs` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `materiales`
--

DROP TABLE IF EXISTS `materiales`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `materiales` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`asignacion_curso_id` bigint unsigned NOT NULL,
`titulo` varchar(255) NOT NULL,
`descripcion` text,
`archivo` varchar(255) DEFAULT NULL,
`fecha_publicacion` date NOT NULL,
PRIMARY KEY (`id`),
KEY `asignacion_curso_id` (`asignacion_curso_id`),
CONSTRAINT `materiales_ibfk_1` FOREIGN KEY (`asignacion_curso_id`) REFERENCES `asignacion_cursos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `materiales`
--

LOCK TABLES `materiales` WRITE;
/_!40000 ALTER TABLE `materiales` DISABLE KEYS _/;
/_!40000 ALTER TABLE `materiales` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `matriculas`
--

DROP TABLE IF EXISTS `matriculas`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `matriculas` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`estudiante_id` bigint unsigned NOT NULL,
`grado_id` bigint unsigned NOT NULL,
`ano_escolar_id` bigint unsigned NOT NULL,
`fecha_matricula` date NOT NULL,
`estado` enum('Activo','Retirado','Repitente') DEFAULT 'Activo',
`ficha_pdf` varchar(255) DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `unique_matricula` (`estudiante_id`,`ano_escolar_id`),
KEY `grado_id` (`grado_id`),
KEY `ano_escolar_id` (`ano_escolar_id`),
CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id`) ON DELETE CASCADE,
CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`),
CONSTRAINT `matriculas_ibfk_3` FOREIGN KEY (`ano_escolar_id`) REFERENCES `anos_escolares` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `matriculas`
--

LOCK TABLES `matriculas` WRITE;
/_!40000 ALTER TABLE `matriculas` DISABLE KEYS _/;
/_!40000 ALTER TABLE `matriculas` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `migrations` (
`id` int unsigned NOT NULL AUTO_INCREMENT,
`migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`batch` int NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/_!40000 ALTER TABLE `migrations` DISABLE KEYS _/;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000001_create_cache_table',1),(2,'0001_01_01_000002_create_jobs_table',1);
/_!40000 ALTER TABLE `migrations` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `notas`
--

DROP TABLE IF EXISTS `notas`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `notas` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`matricula_id` bigint unsigned NOT NULL,
`asignacion_curso_id` bigint unsigned NOT NULL,
`bimestre_id` bigint unsigned NOT NULL,
`nota` decimal(4,2) NOT NULL,
`competencias` json DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `unique_nota` (`matricula_id`,`asignacion_curso_id`,`bimestre_id`),
KEY `asignacion_curso_id` (`asignacion_curso_id`),
KEY `bimestre_id` (`bimestre_id`),
CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`matricula_id`) REFERENCES `matriculas` (`id`) ON DELETE CASCADE,
CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`asignacion_curso_id`) REFERENCES `asignacion_cursos` (`id`),
CONSTRAINT `notas_ibfk_3` FOREIGN KEY (`bimestre_id`) REFERENCES `bimestres` (`id`),
CONSTRAINT `notas_chk_1` CHECK ((`nota` between 0 and 20))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `notas`
--

LOCK TABLES `notas` WRITE;
/_!40000 ALTER TABLE `notas` DISABLE KEYS _/;
/_!40000 ALTER TABLE `notas` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `notificaciones` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`comunicado_id` bigint unsigned NOT NULL,
`receptor_id` bigint unsigned NOT NULL,
`leido` tinyint(1) DEFAULT '0',
`fecha_leido` datetime DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `comunicado_id` (`comunicado_id`),
KEY `receptor_id` (`receptor_id`),
CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`comunicado_id`) REFERENCES `comunicados` (`id`) ON DELETE CASCADE,
CONSTRAINT `notificaciones_ibfk_2` FOREIGN KEY (`receptor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/_!40000 ALTER TABLE `notificaciones` DISABLE KEYS _/;
/_!40000 ALTER TABLE `notificaciones` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `padre_hijo`
--

DROP TABLE IF EXISTS `padre_hijo`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `padre_hijo` (
`padre_id` bigint unsigned NOT NULL,
`estudiante_id` bigint unsigned NOT NULL,
`parentesco` varchar(20) DEFAULT 'Padre/Madre',
PRIMARY KEY (`padre_id`,`estudiante_id`),
KEY `estudiante_id` (`estudiante_id`),
CONSTRAINT `padre_hijo_ibfk_1` FOREIGN KEY (`padre_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
CONSTRAINT `padre_hijo_ibfk_2` FOREIGN KEY (`estudiante_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `padre_hijo`
--

LOCK TABLES `padre_hijo` WRITE;
/_!40000 ALTER TABLE `padre_hijo` DISABLE KEYS _/;
/_!40000 ALTER TABLE `padre_hijo` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `promedios_anuales`
--

DROP TABLE IF EXISTS `promedios_anuales`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `promedios_anuales` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`matricula_id` bigint unsigned NOT NULL,
`asignacion_curso_id` bigint unsigned NOT NULL,
`promedio` decimal(4,2) NOT NULL,
`aprobado` tinyint(1) GENERATED ALWAYS AS (if((`promedio` >= 11),1,0)) STORED,
PRIMARY KEY (`id`),
KEY `matricula_id` (`matricula_id`),
KEY `asignacion_curso_id` (`asignacion_curso_id`),
CONSTRAINT `promedios_anuales_ibfk_1` FOREIGN KEY (`matricula_id`) REFERENCES `matriculas` (`id`),
CONSTRAINT `promedios_anuales_ibfk_2` FOREIGN KEY (`asignacion_curso_id`) REFERENCES `asignacion_cursos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `promedios_anuales`
--

LOCK TABLES `promedios_anuales` WRITE;
/_!40000 ALTER TABLE `promedios_anuales` DISABLE KEYS _/;
/_!40000 ALTER TABLE `promedios_anuales` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `recuperaciones`
--

DROP TABLE IF EXISTS `recuperaciones`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `recuperaciones` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`matricula_id` bigint unsigned NOT NULL,
`asignacion_curso_id` bigint unsigned NOT NULL,
`nota_original` decimal(4,2) DEFAULT NULL,
`nota_recuperacion` decimal(4,2) DEFAULT NULL,
`fecha` date DEFAULT NULL,
`aprobado_final` tinyint(1) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `matricula_id` (`matricula_id`),
KEY `asignacion_curso_id` (`asignacion_curso_id`),
CONSTRAINT `recuperaciones_ibfk_1` FOREIGN KEY (`matricula_id`) REFERENCES `matriculas` (`id`),
CONSTRAINT `recuperaciones_ibfk_2` FOREIGN KEY (`asignacion_curso_id`) REFERENCES `asignacion_cursos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `recuperaciones`
--

LOCK TABLES `recuperaciones` WRITE;
/_!40000 ALTER TABLE `recuperaciones` DISABLE KEYS _/;
/_!40000 ALTER TABLE `recuperaciones` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `reportes`
--

DROP TABLE IF EXISTS `reportes`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `reportes` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`tipo` enum('Notas','Asistencia','Matrícula','Comportamiento') NOT NULL,
`filtros` json DEFAULT NULL,
`archivo` varchar(255) DEFAULT NULL,
`fecha_generacion` date NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `reportes`
--

LOCK TABLES `reportes` WRITE;
/_!40000 ALTER TABLE `reportes` DISABLE KEYS _/;
/_!40000 ALTER TABLE `reportes` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `solicitudes_matricula`
--

DROP TABLE IF EXISTS `solicitudes_matricula`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
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
`comprobante_yape` varchar(255) DEFAULT NULL,
`nro_operacion_yape` varchar(20) DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `padre_id` (`padre_id`),
KEY `grado_id` (`grado_id`),
KEY `ano_escolar_id` (`ano_escolar_id`),
CONSTRAINT `solicitudes_matricula_ibfk_1` FOREIGN KEY (`padre_id`) REFERENCES `users` (`id`),
CONSTRAINT `solicitudes_matricula_ibfk_2` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`),
CONSTRAINT `solicitudes_matricula_ibfk_3` FOREIGN KEY (`ano_escolar_id`) REFERENCES `anos_escolares` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `solicitudes_matricula`
--

LOCK TABLES `solicitudes_matricula` WRITE;
/_!40000 ALTER TABLE `solicitudes_matricula` DISABLE KEYS _/;
/_!40000 ALTER TABLE `solicitudes_matricula` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `tareas`
--

DROP TABLE IF EXISTS `tareas`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `tareas` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`asignacion_curso_id` bigint unsigned NOT NULL,
`titulo` varchar(255) NOT NULL,
`descripcion` text,
`fecha_entrega` date NOT NULL,
`archivo_adjunto` varchar(255) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `asignacion_curso_id` (`asignacion_curso_id`),
CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`asignacion_curso_id`) REFERENCES `asignacion_cursos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `tareas`
--

LOCK TABLES `tareas` WRITE;
/_!40000 ALTER TABLE `tareas` DISABLE KEYS _/;
/_!40000 ALTER TABLE `tareas` ENABLE KEYS _/;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/_!40101 SET @saved_cs_client = @@character_set_client _/;
/_!50503 SET character_set_client = utf8mb4 _/;
CREATE TABLE `users` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`nombre` varchar(100) NOT NULL,
`apellido` varchar(100) NOT NULL,
`dni` char(8) NOT NULL,
`email` varchar(255) NOT NULL,
`password` varchar(255) NOT NULL,
`telefono` varchar(15) DEFAULT NULL,
`rol` enum('Administrador General','Director','Docente','Estudiante','Padre') NOT NULL,
`activo` tinyint(1) DEFAULT '1',
`email_verified_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
UNIQUE KEY `dni` (`dni`),
UNIQUE KEY `email` (`email`),
KEY `idx_rol` (`rol`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/_!40101 SET character_set_client = @saved_cs_client _/;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/_!40000 ALTER TABLE `users` DISABLE KEYS _/;
INSERT INTO `users` VALUES (1,'Admin','General','00000001','admin@eduperu360.edu.pe','$2y$12$EAbUTgT6Zp1il.6JhFK6KO8IiEx6MvhtDoRSBICBkhJ3s8rc1CunG','999999999','Administrador General',1,NULL,'2025-12-05 03:29:35','2025-12-05 03:29:35'),(2,'Fanny','Ejemplo','00000002','padre@eduperu360.edu.pe','$2y$12$n4GmB3iJiP4w3VewBejsYeKBaIoQ4BZYn99JCgtv4Zb2A7xf4iuG6','999999998','Padre',1,NULL,'2025-12-05 03:29:35','2025-12-07 06:41:47'),(4,'Docente','Ejemplo','00000004','docente@eduperu360.edu.pe','$2y$12$4sbM9LA5JoStVj9wpjd6jeZ51vcdyNKJKPQ/XX.Rt/AdE7yinbvpO','999999996','Docente',1,NULL,'2025-12-05 03:29:35','2025-12-05 03:29:35');
/_!40000 ALTER TABLE `users` ENABLE KEYS _/;
UNLOCK TABLES;
/_!40103 SET TIME_ZONE=@OLD_TIME_ZONE _/;

/_!40101 SET SQL_MODE=@OLD_SQL_MODE _/;
/_!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS _/;
/_!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS _/;
/_!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT _/;
/_!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS _/;
/_!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION _/;
/_!40111 SET SQL_NOTES=@OLD_SQL_NOTES _/;

-- Dump completed on 2025-12-07 2:20:02
