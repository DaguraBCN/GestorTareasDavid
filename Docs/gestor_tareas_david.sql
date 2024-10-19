--
-- Base de datos: `gestor_tareas_david`
--
CREATE DATABASE IF NOT EXISTS `gestor_tareas_david` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gestor_tareas_david`;

--
-- Estructura de tabla para la tabla `tareas`
--
DROP TABLE IF EXISTS `tareas`;
CREATE TABLE IF NOT EXISTS `tareas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `prioridad` enum('Urgente','Alta','Media','Baja') DEFAULT 'Media',
  `estado` enum('Pendiente','Ejecucion','Finalizada') DEFAULT 'Pendiente',
  `fecha_limite` date DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--
INSERT INTO `tareas` (`id`, `titulo`, `descripcion`, `prioridad`, `estado`, `fecha_limite`, `fecha_creacion`) VALUES
(1, 'Levantarme', 'Me tengo que levantar a las 6:30', 'Baja', 'Pendiente', '2024-10-16', '2024-10-14 13:52:50'),
(2, 'Pasear al perro', 'Sacar al perro a pasear 7:00', 'Media', 'Pendiente', '2024-10-16', '2024-10-14 22:09:11'),
(3, 'Ir al curso', 'Salir dirección al curso a las 7:45', 'Alta', 'Finalizada', '2024-10-15', '2024-10-15 00:03:24'),
(4, 'Volver a casa', 'Al salir del curso ir a casa a las 14:00', 'Media', 'Ejecucion', '2024-10-21', '2024-10-15 00:03:54'),
(5, 'Estudiar para ingles', 'Tiene que estudiar para ingles a partir de las 18:00', 'Urgente', 'Ejecucion', '2024-10-16', '2024-10-15 19:58:52'),
(6, 'Estudiar frances', 'Quiere estudiar francés para seguir con la racha', 'Media', 'Pendiente', '2024-10-16', '2024-10-15 19:59:43'),
(7, 'Otro día más', 'Vamos a ver que ocurre hoy', 'Urgente', 'Ejecucion', '2024-10-18', '2024-10-15 23:58:24');