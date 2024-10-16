--
-- Estructura de tabla para la tabla `tareas`
--

DROP TABLE IF EXISTS `tareas`;
CREATE TABLE IF NOT EXISTS `tareas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `prioridad` enum('Urgente','Alta','Media','Baja') DEFAULT 'Media',
  `estado` enum('Pendiente','Ejecución','Finalizada') DEFAULT 'Pendiente',
  `fecha_limite` date DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `titulo`, `descripcion`, `prioridad`, `estado`, `fecha_limite`, `fecha_creacion`) VALUES
(1, 'Despertarme', 'Me levanto a las 6:30', 'Urgente', 'Pendiente', '2024-10-16', '2024-10-14 11:02:22'),
(2, 'Ir hacia el curso', 'Marcho hacia el curso a las 7:45', 'Media', 'Pendiente', '2024-10-15', '2024-10-14 11:22:29'),
(3, 'Pasear perro', '6:45', 'Urgente', 'Finalizada', '2024-10-15', '2024-10-14 11:27:00'),
(5, 'Ir al colegio un 2', 'Salir hacia el colegio a las 10:15', 'Media', 'Ejecución', '2024-10-15', '2024-10-15 06:37:51'),
(6, 'Volver a casa', 'por la noche', 'Media', 'Finalizada', '2024-10-15', '2024-10-15 06:57:23');
COMMIT;
