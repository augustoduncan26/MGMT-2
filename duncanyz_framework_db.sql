-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2025 at 07:05 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duncanyz_framework_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_announcement`
--

CREATE TABLE `mgmt_announcement` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `date` datetime NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_assignment`
--

CREATE TABLE `mgmt_assignment` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `teacher_id` varchar(100) NOT NULL,
  `class_id` varchar(100) NOT NULL,
  `id_cia` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgmt_assignment`
--

INSERT INTO `mgmt_assignment` (`id`, `name`, `teacher_id`, `class_id`, `id_cia`, `created_at`, `activo`) VALUES
(1, 'Matematicas Aplicadas', '2', '1,2', 1, '2025-04-16 22:41:19', 1),
(2, 'Matematicas Avanzadas', '2', '1', 1, '2025-04-30 12:49:12', 1),
(3, 'Ciencias Sociales', '2', '1', 1, '2025-05-01 01:54:34', 1),
(4, 'Historia', '6', '1,2', 1, '2025-05-01 01:55:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_assoc_student_assignment`
--

CREATE TABLE `mgmt_assoc_student_assignment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `assignment_id` varchar(30) DEFAULT NULL,
  `class_id` varchar(30) DEFAULT NULL,
  `date_ini` date NOT NULL,
  `date_end` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_cia` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgmt_assoc_student_assignment`
--

INSERT INTO `mgmt_assoc_student_assignment` (`id`, `student_id`, `student_name`, `assignment_id`, `class_id`, `date_ini`, `date_end`, `created_at`, `updated_at`, `id_cia`, `activo`) VALUES
(1, 3, 'Estudiante 1A Apellido 1', '1,2,3,4', '1,2,3,4,5,6', '2025-08-01', '2025-12-31', '2025-08-26 16:08:22', '2025-08-26 16:08:22', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_assoc_teacher_assignment`
--

CREATE TABLE `mgmt_assoc_teacher_assignment` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(100) NOT NULL,
  `assignment_id` varchar(30) DEFAULT NULL,
  `class_id` varchar(30) DEFAULT NULL,
  `date_ini` date NOT NULL,
  `date_end` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_cia` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgmt_assoc_teacher_assignment`
--

INSERT INTO `mgmt_assoc_teacher_assignment` (`id`, `teacher_id`, `teacher_name`, `assignment_id`, `class_id`, `date_ini`, `date_end`, `created_at`, `updated_at`, `id_cia`, `activo`) VALUES
(1, 2, 'Profesor 1 Apellido', '1,2,3', '2', '2025-03-03', '2025-12-22', '2025-06-05 19:29:03', '2025-06-05 19:29:03', 1, 1),
(2, 6, 'Rodrigo M. Matew L.', '2', '1,2,3,4,5,6', '2025-06-06', '2025-06-12', '2025-06-06 04:19:34', '2025-06-06 04:19:34', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_attendance`
--

CREATE TABLE `mgmt_attendance` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `present` tinyint(1) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_class`
--

CREATE TABLE `mgmt_class` (
  `id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `capacity` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `id_cia` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgmt_class`
--

INSERT INTO `mgmt_class` (`id`, `class_name`, `capacity`, `supervisor_id`, `grade`, `id_cia`, `created_at`, `updated_at`, `activo`) VALUES
(1, 'Primer grado', 11, 2, 1, 1, '2025-04-08 22:23:12', '2025-06-04 15:46:35', 1),
(2, 'Secundaria', 10, 2, 19, 1, '2025-05-01 01:54:03', '2025-05-13 22:24:32', 1),
(3, 'Segundo Grado', 12, 2, 2, 1, '2025-05-13 20:14:20', '2025-06-04 15:47:01', 1),
(4, 'Tercer Grado', 21, 2, 3, 1, '2025-05-13 21:57:17', '2025-06-04 15:47:10', 1),
(5, 'Cuarto Grado', 15, 2, 4, 1, '2025-05-13 22:10:14', '2025-06-04 15:47:18', 1),
(6, 'quinto grado', 21, 2, 5, 1, '2025-05-13 22:10:27', '2025-08-26 13:07:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_emergency_contact`
--

CREATE TABLE `mgmt_emergency_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_students` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_events`
--

CREATE TABLE `mgmt_events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `class` varchar(100) DEFAULT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `time_start` varchar(10) NOT NULL DEFAULT '00:00',
  `time_end` varchar(10) NOT NULL DEFAULT '00:00',
  `class_id` varchar(200) DEFAULT '0',
  `perfil_id` varchar(200) DEFAULT '0',
  `id_cia` int(11) NOT NULL,
  `tipo_color` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgmt_events`
--

INSERT INTO `mgmt_events` (`id`, `name`, `class`, `date_start`, `date_end`, `description`, `time_start`, `time_end`, `class_id`, `perfil_id`, `id_cia`, `tipo_color`, `created_at`, `activo`) VALUES
(1, 'Seminario de Profesores', '0', '2025-07-06', '2025-07-08', 'Seminario para Profesores de 3er Año', 'T00:00:00', 'T03:30:00', '1,3,4', '1,2,4', 1, '#16b910', '0000-00-00 00:00:00', 0),
(2, 'Cumpleaños del mes de Agosto', '0', '2025-08-01', '2025-09-24', 'Description Events - 33', 'T00:00:00', 'T06:00:00', '1,6,2', '1,2,3,4,5', 1, '#ff8c00', '2025-04-09 11:06:06', 1),
(3, 'Examen de Fisica', 'Array', '2025-06-04', '2025-06-09', 'Examen sobre el capitulo 2', 'T00:00:00', 'T00:00:00', '5,2', '2', 1, '#000000', '2025-05-14 01:53:17', 0),
(4, 'Nombre del Evento', '0', '2025-06-25', '2025-08-27', 'Descripcion del Evento', 'T01:00:00', 'T03:30:00', '5,1,6,2,3,4', '1', 1, '#ef0d0d', '2025-05-14 16:36:02', 1),
(5, 'Titulo Test', '0', '2025-07-10', '2025-08-28', 'Descripcion del Evento', 'T01:30:00', 'T01:30:00', '5,1,6,2,3,4', '1,2,3,4', 1, '#16b910', '2025-05-14 22:41:28', 1),
(6, 'Otro Evento', 'Array', '2025-07-11', '2025-09-26', 'Otra descripcion', 'T00:00:00', 'T00:00:00', '5,1,6,2,3,4', '1,2,3,4,5', 1, '#16b910', '2025-05-14 23:18:40', 1),
(7, 'Seminario Ciencias', NULL, '2025-06-04', '2025-06-27', '', 'T14:00:00', 'T18:00:00', '', '1', 1, '#ff8cbb', '2025-06-05 11:13:37', 0),
(8, 'FELIZ CUMPLEAÑO', NULL, '2025-08-26', '2025-08-26', 'Cumpleanos del Root', 'T00:00', 'T00:00', '', '', 1, '#3a87ad', '2025-06-11 11:02:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_exam`
--

CREATE TABLE `mgmt_exam` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `start_time` datetime NOT NULL DEFAULT current_timestamp(),
  `end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lesson_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_lessons`
--

CREATE TABLE `mgmt_lessons` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `day` date NOT NULL,
  `start_time` datetime NOT NULL DEFAULT current_timestamp(),
  `end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_mant_perfiles`
--

CREATE TABLE `mgmt_mant_perfiles` (
  `id` int(11) NOT NULL COMMENT 'Llave primaria de la tabla',
  `name` varchar(100) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Descripción de perfil',
  `id_cia` int(11) NOT NULL,
  `activo` int(1) DEFAULT 1 COMMENT 'activo = 0 ; inactivo = 1',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Catálogo de perfiles de usuario';

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_mant_tipo_planner`
--

CREATE TABLE `mgmt_mant_tipo_planner` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(5) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgmt_mant_tipo_planner`
--

INSERT INTO `mgmt_mant_tipo_planner` (`id`, `name`, `value`, `activo`) VALUES
(1, 'Asignación Especial', 'AE', 1),
(2, 'Evento', 'E', 1),
(3, 'Exámen', 'X', 1),
(4, 'Tarea', 'T', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_message`
--

CREATE TABLE `mgmt_message` (
  `id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_new_users_permissions`
--

CREATE TABLE `mgmt_new_users_permissions` (
  `nombre` varchar(50) NOT NULL,
  `permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgmt_new_users_permissions`
--

INSERT INTO `mgmt_new_users_permissions` (`nombre`, `permiso`) VALUES
('Eventos', 50),
('Estadisticas', 850),
('Profesores', 100),
('Estudiantes', 150),
('Padres', 200),
('Asignaturas', 250),
('Clases', 300),
('Examenes', 400),
('Tareas', 450),
('Resultados', 500);

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_parents`
--

CREATE TABLE `mgmt_parents` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_perfiles`
--

CREATE TABLE `mgmt_perfiles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'rol name',
  `alias` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `id_cia` int(11) NOT NULL COMMENT 'company id',
  `activo` int(1) NOT NULL COMMENT 'if rol active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgmt_perfiles`
--

INSERT INTO `mgmt_perfiles` (`id`, `name`, `alias`, `description`, `id_cia`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Padres', NULL, 'Perfil exclusivo para padres', 1, 1, '2025-03-26 12:00:49', '2025-04-10 19:09:10'),
(2, 'Estudiantes', NULL, 'Perfil para estudiantes', 1, 1, '2025-03-26 21:36:13', '2025-04-10 19:08:07'),
(3, 'Profesores', NULL, 'Perfil para profesores y maestros', 1, 1, '2025-03-26 21:36:19', '2025-04-10 19:09:44'),
(4, 'Directivos', NULL, 'Directivos del Colegio o Escuela', 1, 1, '2025-03-26 21:36:25', '2025-04-10 19:05:45'),
(5, 'Supervisores', NULL, 'Perfil para administradores y supervisores', 1, 1, '2025-04-03 09:59:33', '2025-04-10 19:10:04'),
(6, 'Usuario', NULL, 'Usuario de Sistema', 0, 1, '2025-05-09 17:22:03', '2025-05-09 17:22:03'),
(100, 'Administrador', NULL, 'Administrador del Sistema', 1, 1, '2025-04-11 00:04:53', '2025-04-11 00:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_permisos`
--

CREATE TABLE `mgmt_permisos` (
  `id` int(10) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_definicion_permiso` int(10) NOT NULL,
  `id_cia` int(11) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mgmt_permisos`
--

INSERT INTO `mgmt_permisos` (`id`, `id_perfil`, `id_definicion_permiso`, `id_cia`, `activo`) VALUES
(1, 1, 50, 1, 1),
(120, 6, 50, 0, 1),
(121, 6, 850, 0, 1),
(122, 6, 100, 0, 1),
(123, 6, 150, 0, 1),
(124, 6, 200, 0, 1),
(125, 6, 250, 0, 1),
(126, 6, 300, 0, 1),
(127, 6, 400, 0, 1),
(128, 6, 450, 0, 1),
(129, 6, 500, 0, 1),
(153, 6, 50, 0, 1),
(154, 6, 850, 0, 1),
(155, 6, 100, 0, 1),
(156, 6, 150, 0, 1),
(157, 6, 200, 0, 1),
(158, 6, 250, 0, 1),
(159, 6, 300, 0, 1),
(160, 6, 400, 0, 1),
(161, 6, 450, 0, 1),
(162, 6, 500, 0, 1),
(188, 100, 50, 1, 1),
(189, 100, 51, 1, 1),
(190, 100, 52, 1, 1),
(191, 100, 53, 1, 1),
(192, 100, 100, 1, 1),
(193, 100, 150, 1, 1),
(194, 100, 200, 1, 1),
(195, 100, 250, 1, 1),
(196, 100, 300, 1, 1),
(197, 100, 350, 1, 1),
(198, 100, 351, 1, 1),
(199, 100, 400, 1, 1),
(200, 100, 450, 1, 1),
(201, 100, 500, 1, 1),
(202, 100, 550, 1, 1),
(203, 100, 551, 1, 1),
(204, 100, 552, 1, 1),
(205, 100, 553, 1, 1),
(206, 100, 600, 1, 1),
(207, 100, 650, 1, 1),
(208, 100, 750, 1, 1),
(209, 100, 800, 1, 1),
(210, 100, 801, 1, 1),
(211, 100, 802, 1, 1),
(212, 100, 850, 1, 1),
(213, 100, 9999, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_permiso_definicion`
--

CREATE TABLE `mgmt_permiso_definicion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `permiso` int(11) DEFAULT NULL,
  `permiso_padre` int(11) NOT NULL,
  `tipo_permiso` varchar(11) DEFAULT NULL COMMENT 'Tipo de permiso: Padre (A) ; Hijo (B) ; Sub-Hijo (C)',
  `icono` varchar(50) DEFAULT NULL,
  `id_cia` int(11) DEFAULT NULL,
  `activo` int(2) DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mgmt_permiso_definicion`
--

INSERT INTO `mgmt_permiso_definicion` (`id`, `nombre`, `permiso`, `permiso_padre`, `tipo_permiso`, `icono`, `id_cia`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Eventos', 50, 50, 'A', 'littlehouse.png', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Profesores', 100, 100, 'A', 'fa-group', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Estudiantes', 150, 150, 'A', NULL, 1, 1, '2025-03-21 10:43:00', '2025-03-21 10:43:00'),
(4, 'Padres', 200, 200, NULL, NULL, 1, 1, '2025-03-21 16:45:22', NULL),
(5, 'Asignaturas', 250, 250, NULL, NULL, 1, 1, '2025-03-25 20:16:19', NULL),
(6, 'Clases', 300, 300, NULL, NULL, 1, 1, '2025-03-25 20:16:40', NULL),
(7, 'Agenda / Cronograma Profesores', 350, 350, NULL, NULL, 1, 1, '2025-03-25 20:16:56', NULL),
(8, 'Examenes', 400, 400, NULL, NULL, 1, 1, '2025-03-25 20:17:11', NULL),
(9, 'Tareas', 450, 450, NULL, NULL, 1, 1, '2025-03-25 20:17:40', NULL),
(10, 'Resultados', 500, 500, NULL, NULL, 1, 1, '2025-03-25 20:17:54', NULL),
(11, 'Asistencias', 550, 550, NULL, NULL, 1, 1, '2025-03-25 20:18:10', NULL),
(12, 'Mesnajes', 600, 600, NULL, NULL, 1, 1, '2025-03-25 20:18:27', NULL),
(13, 'Anuncios', 650, 650, NULL, NULL, 1, 1, '2025-03-25 20:18:45', NULL),
(14, 'Planning', 750, 750, NULL, NULL, 1, 1, '2025-03-26 01:06:29', NULL),
(15, 'Mantenimiento de Usuarios', 800, 800, NULL, NULL, 1, 1, '2025-03-26 01:06:45', NULL),
(16, 'Mantenimiento de Perfiles', 801, 800, NULL, NULL, 1, 1, '2025-03-26 01:07:07', NULL),
(17, 'Cambiar Contraseña', 802, 800, NULL, NULL, 1, 1, '2025-03-26 01:07:21', NULL),
(18, 'Estadisticas', 850, 850, NULL, NULL, 1, 1, '2025-05-06 11:16:17', NULL),
(19, 'Configuraciones', 9999, 9999, NULL, NULL, 1, 1, '2025-05-09 20:17:51', NULL),
(20, 'Agenda / Cronograma Estudiantes', 351, 351, NULL, NULL, 1, 1, '2025-05-11 23:09:57', NULL),
(21, 'Eventos - Nuevo', 51, 50, NULL, NULL, 1, 1, '2025-05-14 15:26:41', NULL),
(22, 'Eventos - Editar - Ver', 52, 50, NULL, NULL, 1, 1, '2025-05-14 15:28:01', NULL),
(23, 'Eventos - Eliminar', 53, 50, NULL, NULL, 1, 1, '2025-05-14 15:28:16', NULL),
(24, 'Asistencia - Nuevo', 551, 550, NULL, NULL, 1, 1, '2025-06-02 19:33:33', NULL),
(25, 'Asistencia - Editar', 552, 550, NULL, NULL, 1, 1, '2025-06-02 19:33:58', NULL),
(26, 'Asistencia - Tomar Asistencia', 553, 550, NULL, NULL, 1, 1, '2025-06-02 20:36:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_planner`
--

CREATE TABLE `mgmt_planner` (
  `id` int(11) NOT NULL,
  `id_cia` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `color` varchar(10) NOT NULL,
  `show_to` longtext NOT NULL,
  `fecha_e` date DEFAULT NULL,
  `fecha_s` date DEFAULT NULL,
  `start_hr` varchar(10) NOT NULL COMMENT 'Start Hour',
  `end_hr` varchar(10) NOT NULL COMMENT 'End Hour',
  `total_days` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tipo` varchar(5) NOT NULL,
  `url` varchar(200) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgmt_planner`
--

INSERT INTO `mgmt_planner` (`id`, `id_cia`, `id_user`, `title`, `color`, `show_to`, `fecha_e`, `fecha_s`, `start_hr`, `end_hr`, `total_days`, `email`, `tipo`, `url`, `activo`) VALUES
(1, 1, 1, 'TEST1', '#FF8CBB', '', '2025-05-15', '2025-05-17', 'T01:00:00', 'T06:00:00', 4, '', 'E', '', 1),
(2, 1, 1, 'TEST2', '#FF8C00', '', '2025-05-15', '2025-05-17', 'T11:00:00', 'T06:00:00', 4, '', 'E', '', 1),
(3, 1, 1, 'TEST3', '#FF8CBB', '', '2025-05-15', '2025-05-17', 'T01:00:00', 'T02:00:00', 4, '', 'E', '', 1),
(4, 1, 1, 'TEST4', '#FF8CBB', '', '2025-05-15', '2025-05-17', 'T01:00:00', 'T00:00:00', 4, '', 'E', '', 1),
(5, 1, 1, 'TEST5', '#FF8C00', '', '2025-05-15', '2025-05-17', 'T09:00:00', 'T00:00:00', 4, '', 'E', '', 1),
(6, 1, 1, 'TEST6', '#FF8CBB', '', '2025-05-15', '2025-05-17', 'T01:00:00', 'T00:00:00', 4, '', 'E', '', 1),
(7, 1, 1, 'TEST7', '#FF8C00', '', '2025-05-15', '2025-05-17', 'T11:00:00', 'T00:00:00', 4, '', 'E', '', 1),
(8, 1, 1, 'TEST8', '#FF8CBB', '', '2025-05-14', '2025-05-17', 'T07:00:00', 'T00:00:00', 4, '', 'E', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_result`
--

CREATE TABLE `mgmt_result` (
  `id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_role_user`
--

CREATE TABLE `mgmt_role_user` (
  `id_definicion_permiso` int(11) NOT NULL COMMENT 'Llave primaria de tabla definicionPermiso',
  `id_perfil` int(11) NOT NULL COMMENT 'Llave primaria de tabla Perfil'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Asociar permiso segun rol y usuarios';

--
-- Dumping data for table `mgmt_role_user`
--

INSERT INTO `mgmt_role_user` (`id_definicion_permiso`, `id_perfil`) VALUES
(100, 2),
(100, 4),
(100, 5),
(100, 8),
(100, 100),
(101, 5),
(101, 6),
(101, 100),
(102, 5),
(102, 100),
(103, 5),
(103, 100),
(104, 5),
(104, 100),
(105, 1),
(105, 2),
(105, 5),
(105, 8),
(105, 100),
(106, 5),
(106, 100),
(107, 5),
(107, 100),
(109, 3),
(109, 4),
(109, 5),
(109, 6),
(111, 4),
(111, 5),
(111, 6),
(200, 3),
(201, 3),
(202, 3),
(204, 3),
(205, 3),
(206, 3),
(206, 100),
(207, 3),
(208, 100),
(209, 3),
(303, 3),
(306, 3),
(2044, 3),
(2045, 3),
(2046, 3),
(2096, 3),
(42200000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_session`
--

CREATE TABLE `mgmt_session` (
  `id` int(11) NOT NULL,
  `id_session` varchar(100) NOT NULL COMMENT 'session hash',
  `user` varchar(50) NOT NULL COMMENT 'user name or email',
  `session_data` int(11) DEFAULT NULL,
  `expires` int(25) DEFAULT NULL COMMENT 'expiration',
  `date` datetime NOT NULL COMMENT 'date',
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Sessiones';

--
-- Dumping data for table `mgmt_session`
--

INSERT INTO `mgmt_session` (`id`, `id_session`, `user`, `session_data`, `expires`, `date`, `activo`) VALUES
(25, '0f470f510d0050ae1195bd9411a88a95', 'augustoduncan26@hotmail.com', NULL, NULL, '2025-05-13 20:56:36', 1),
(34, 'ff6e225b888b8e86ab97f6c7e9ae9973', 'admin@admin.com', NULL, NULL, '2025-08-26 12:52:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_students`
--

CREATE TABLE `mgmt_students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sername` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `img` varchar(100) NOT NULL,
  `bloodtype` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_subjects`
--

CREATE TABLE `mgmt_subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_teachers`
--

CREATE TABLE `mgmt_teachers` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(100) NOT NULL,
  `teacher_name` varchar(100) NOT NULL,
  `assignment_id` varchar(100) DEFAULT NULL,
  `class_id` varchar(100) NOT NULL DEFAULT '0' COMMENT 'All classes. Todas las clases o salones asignados al profesor',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `id_cia` int(11) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_users_permissions`
--

CREATE TABLE `mgmt_users_permissions` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL,
  `id_cia` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgmt_users_permissions`
--

INSERT INTO `mgmt_users_permissions` (`id`, `id_user`, `id_permission`, `id_cia`, `created_at`) VALUES
(117, 1, 50, 1, '2025-05-08 21:11:27'),
(118, 1, 100, 1, '2025-05-08 21:11:27'),
(119, 1, 150, 1, '2025-05-08 21:11:27'),
(120, 1, 200, 1, '2025-05-08 21:11:27'),
(121, 1, 250, 1, '2025-05-08 21:11:27'),
(122, 1, 300, 1, '2025-05-08 21:11:27'),
(123, 1, 350, 1, '2025-05-08 21:11:27'),
(124, 1, 400, 1, '2025-05-08 21:11:27'),
(125, 1, 450, 1, '2025-05-08 21:11:27'),
(126, 1, 500, 1, '2025-05-08 21:11:27'),
(127, 1, 550, 1, '2025-05-08 21:11:27'),
(128, 1, 600, 1, '2025-05-08 21:11:27'),
(129, 1, 650, 1, '2025-05-08 21:11:27'),
(130, 1, 750, 1, '2025-05-08 21:11:27'),
(131, 1, 800, 1, '2025-05-08 21:11:27'),
(132, 1, 801, 1, '2025-05-08 21:11:27'),
(133, 1, 802, 1, '2025-05-08 21:11:27'),
(134, 1, 850, 1, '2025-05-08 21:11:27'),
(135, 4, 50, 1, '2025-05-08 23:13:12');

-- --------------------------------------------------------

--
-- Table structure for table `mgmt_usuarios`
--

CREATE TABLE `mgmt_usuarios` (
  `id_usuario` int(11) NOT NULL COMMENT 'Llave primaria de la tabla',
  `id_depto` int(10) DEFAULT 0 COMMENT 'id del departamento o seccion',
  `id_perfil` int(10) DEFAULT 0 COMMENT 'id del perfil',
  `name_perfil` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `id_area` int(10) DEFAULT 0 COMMENT 'id el area o seccion',
  `id_direccion` int(10) DEFAULT 0 COMMENT 'id de la direccion',
  `id_cia` int(11) NOT NULL,
  `es_director` int(10) DEFAULT 0 COMMENT '0 = NO ES DIRECTOR ; 1 = ES DIRECTOR',
  `usuario` char(50) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Usuario con el que el usuario hace el log in',
  `contrasena` varchar(100) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Contraseña del usuario',
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre del usuario',
  `apellido` varchar(100) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Apellido del usuario',
  `email` varchar(100) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Correo electrónico del usuario',
  `id_contacto` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT 'Fecha / hora en que se registro el usuario',
  `updated_at` datetime NOT NULL COMMENT 'Fecha de ultima actualizacion del registro',
  `fecha_ult_clave` date DEFAULT NULL COMMENT 'Ultima vez que cambio la clave',
  `principal` int(1) DEFAULT 0 COMMENT 'principal de la SL en la que se encuentra',
  `caracteres` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `superadmin` int(11) NOT NULL DEFAULT 0,
  `idioma` int(1) DEFAULT 0 COMMENT 'idioma del usuario',
  `birthday` date DEFAULT NULL,
  `photo` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Profile photo',
  `tipo_sangre` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `telefono` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `direccion` longtext COLLATE latin1_spanish_ci DEFAULT NULL,
  `genero` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `activo` smallint(1) NOT NULL DEFAULT 1 COMMENT 'Campo flag de estatus de usuario'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 CHECKSUM=1 COLLATE=latin1_spanish_ci COMMENT='Tabla de usuarios del sistema' DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mgmt_usuarios`
--

INSERT INTO `mgmt_usuarios` (`id_usuario`, `id_depto`, `id_perfil`, `name_perfil`, `id_area`, `id_direccion`, `id_cia`, `es_director`, `usuario`, `contrasena`, `nombre`, `apellido`, `email`, `id_contacto`, `created_at`, `updated_at`, `fecha_ult_clave`, `principal`, `caracteres`, `superadmin`, `idioma`, `birthday`, `photo`, `tipo_sangre`, `telefono`, `direccion`, `genero`, `activo`) VALUES
(1, 1, 100, 'Administrador', 0, 1, 1, 0, 'admin_root', 'VHVEMFdYTEY3YzIvZjhodDJKMjkrZz09', 'Administrador', 'Usuarios', 'admin@admin.com', 0, '2009-03-25 09:08:27', '2025-08-26 12:52:09', NULL, 0, '', 0, 0, '0000-00-00', '1-foto-1221548369-2025-06-24-1110147654.jpeg', 'B+', '', '', '', 1),
(2, 0, 3, '', 0, 0, 1, 0, 'usuario1@example.com', 'VXRqWFlOZ2V5dU8wdkdhVUl0V1I4R3l3M2pQTWZibVpXdGtDemxOd0h0QT0=', 'Profesor 1', 'Apellido', 'usuario1@example.com', 0, '2025-04-10 01:00:28', '2025-06-05 12:43:08', NULL, 0, NULL, 0, 0, '2008-12-30', '1-foto-1004323669-2025-06-05-1129420904.png', 'A+', '23423423234', 'Don Bosco', 'femenino', 1),
(3, 0, 2, '', 0, 0, 1, 0, 'usuario2@example.com', 'VXRqWFlOZ2V5dU8wdkdhVUl0V1I4R3l3M2pQTWZibVpXdGtDemxOd0h0QT0=', 'Estudiante 1A', 'Apellido 1', 'usuario2@example.com', 0, '2025-04-10 01:00:55', '2025-05-08 22:37:24', NULL, 0, NULL, 0, 0, '2025-04-09', '1-foto-1226262830-2025-04-10-1146874662.jpeg', 'AB+', '98765432', '', '', 1),
(4, 0, 1, '', 0, 0, 1, 0, 'usuario3@example.com', 'VXRqWFlOZ2V5dU8wdkdhVUl0V1I4R3l3M2pQTWZibVpXdGtDemxOd0h0QT0=', 'Padre -1', 'Apellido 1', 'usuario3@example.com', 0, '2025-04-10 01:01:31', '2025-05-08 23:13:12', NULL, 0, NULL, 0, 0, '1995-01-25', '1-foto-1115866923-2025-04-11-1199108643.jpeg', 'O-', '444444', '', '', 1),
(5, 0, 6, 'Usuario', 0, 0, 0, 0, 'test@test.com', 'L0FmMDFqM3k4WFYybTV4Qy96M0NwZz09', 'Test', '', 'test@test.com', 0, '2025-05-13 14:37:41', '2025-05-13 14:37:41', NULL, 0, 'HTU9xueIM9', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, 0, 3, '', 0, 0, 1, 0, 'profesor1@profesor.com', 'ekhqbUx0LysxSVErU2ZiRDhzb3N4dz09', 'Rodrigo M.', 'Matew L.', 'profesor1@profesor.com', 0, '2025-05-13 23:11:50', '2025-05-13 23:19:44', NULL, 0, NULL, 0, 0, '0000-00-00', '1-foto-1143142999-2025-05-14-1118178741.png', '', '', '', '', 1),
(9, 0, 6, 'Usuario', 0, 0, 0, 0, '', 'bE1JRjZJNnNiWlJEdUU5b0N1ZXJwUT09', '', '', '', 0, '2025-05-14 15:53:30', '2025-05-14 15:53:30', NULL, 0, 'GcSZ0P3G0Y', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mgmt_announcement`
--
ALTER TABLE `mgmt_announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_assignment`
--
ALTER TABLE `mgmt_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_assoc_student_assignment`
--
ALTER TABLE `mgmt_assoc_student_assignment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_id` (`student_id`);

--
-- Indexes for table `mgmt_assoc_teacher_assignment`
--
ALTER TABLE `mgmt_assoc_teacher_assignment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `mgmt_attendance`
--
ALTER TABLE `mgmt_attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `date` (`date`),
  ADD KEY `assignments` (`assignment_id`);

--
-- Indexes for table `mgmt_class`
--
ALTER TABLE `mgmt_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_emergency_contact`
--
ALTER TABLE `mgmt_emergency_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_events`
--
ALTER TABLE `mgmt_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_exam`
--
ALTER TABLE `mgmt_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_lessons`
--
ALTER TABLE `mgmt_lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_mant_perfiles`
--
ALTER TABLE `mgmt_mant_perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_mant_tipo_planner`
--
ALTER TABLE `mgmt_mant_tipo_planner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_message`
--
ALTER TABLE `mgmt_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_parents`
--
ALTER TABLE `mgmt_parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_perfiles`
--
ALTER TABLE `mgmt_perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_permisos`
--
ALTER TABLE `mgmt_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_permiso_definicion`
--
ALTER TABLE `mgmt_permiso_definicion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_planner`
--
ALTER TABLE `mgmt_planner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_result`
--
ALTER TABLE `mgmt_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_role_user`
--
ALTER TABLE `mgmt_role_user`
  ADD PRIMARY KEY (`id_definicion_permiso`,`id_perfil`),
  ADD KEY `id_perfil` (`id_perfil`);

--
-- Indexes for table `mgmt_session`
--
ALTER TABLE `mgmt_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_students`
--
ALTER TABLE `mgmt_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_subjects`
--
ALTER TABLE `mgmt_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_teachers`
--
ALTER TABLE `mgmt_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_users_permissions`
--
ALTER TABLE `mgmt_users_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgmt_usuarios`
--
ALTER TABLE `mgmt_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mgmt_announcement`
--
ALTER TABLE `mgmt_announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgmt_assignment`
--
ALTER TABLE `mgmt_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mgmt_assoc_student_assignment`
--
ALTER TABLE `mgmt_assoc_student_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mgmt_assoc_teacher_assignment`
--
ALTER TABLE `mgmt_assoc_teacher_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mgmt_attendance`
--
ALTER TABLE `mgmt_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgmt_class`
--
ALTER TABLE `mgmt_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mgmt_emergency_contact`
--
ALTER TABLE `mgmt_emergency_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgmt_events`
--
ALTER TABLE `mgmt_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mgmt_exam`
--
ALTER TABLE `mgmt_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgmt_lessons`
--
ALTER TABLE `mgmt_lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgmt_mant_perfiles`
--
ALTER TABLE `mgmt_mant_perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla';

--
-- AUTO_INCREMENT for table `mgmt_mant_tipo_planner`
--
ALTER TABLE `mgmt_mant_tipo_planner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mgmt_message`
--
ALTER TABLE `mgmt_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgmt_parents`
--
ALTER TABLE `mgmt_parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgmt_perfiles`
--
ALTER TABLE `mgmt_perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `mgmt_permisos`
--
ALTER TABLE `mgmt_permisos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `mgmt_permiso_definicion`
--
ALTER TABLE `mgmt_permiso_definicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `mgmt_planner`
--
ALTER TABLE `mgmt_planner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mgmt_result`
--
ALTER TABLE `mgmt_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgmt_session`
--
ALTER TABLE `mgmt_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `mgmt_students`
--
ALTER TABLE `mgmt_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgmt_subjects`
--
ALTER TABLE `mgmt_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgmt_teachers`
--
ALTER TABLE `mgmt_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mgmt_users_permissions`
--
ALTER TABLE `mgmt_users_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `mgmt_usuarios`
--
ALTER TABLE `mgmt_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla', AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mgmt_attendance`
--
ALTER TABLE `mgmt_attendance`
  ADD CONSTRAINT `assignments` FOREIGN KEY (`assignment_id`) REFERENCES `mgmt_assignment` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `students` FOREIGN KEY (`student_id`) REFERENCES `mgmt_students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
