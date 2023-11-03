-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2023 at 09:55 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `universidad`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnos_materias`
--

CREATE TABLE `alumnos_materias` (
  `id_am` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_alumate` int(11) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `mensajes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumnos_materias`
--

INSERT INTO `alumnos_materias` (`id_am`, `id_alumno`, `id_alumate`, `calificacion`, `mensajes`) VALUES
(1, NULL, 15, 100, 'Felicidades'),
(2, 3, 1, 100, 'Excelente trabajo hija');

-- --------------------------------------------------------

--
-- Table structure for table `login_user`
--

CREATE TABLE `login_user` (
  `id_login` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`id_login`, `email`, `pass`, `id_users`) VALUES
(1, 'admin@admin', '$2y$10$3yBkuJiw6wPaaSNerx02quoIMEfR5J1TZSFeAjwMWOh1ayn1Gzyhi', 1),
(3, 'alumno@alumno', '$2y$10$QBuXH6e.VcYxhdRhzoCgPetuksBQDK7e11uVb8ZxXDYXMWBmQla0O', 3),
(32, 'maestro@maestro', '$2y$10$6Y.Y0pMbuAZQDMNWubWIQuUhPry2BHFe50w4Z0cUdcKf.X8rN.1Ua', 58);

-- --------------------------------------------------------

--
-- Table structure for table `materias`
--

CREATE TABLE `materias` (
  `id_materia` int(11) NOT NULL,
  `materia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materias`
--

INSERT INTO `materias` (`id_materia`, `materia`) VALUES
(1, 'matematica'),
(12, 'Comunicacion'),
(14, 'Ingeniería Mecánica'),
(15, 'Economía'),
(16, 'Ingeniería Civil '),
(22, 'Química'),
(23, 'Lingüística'),
(24, 'Literatura '),
(27, 'Sociología '),
(30, 'gastronomia'),
(31, 'Literatura'),
(36, 'Farmacia '),
(43, 'Programacion Avanzado'),
(50, 'Agronomía'),
(51, 'programacionn inicial'),
(52, 'programacion'),
(60, 'Psicología'),
(64, 'Religion'),
(71, 'sociales'),
(72, 'Ingles'),
(73, 'programacion'),
(74, 'Biología'),
(76, 'Naturales'),
(77, 'Ingles'),
(78, 'Teatro'),
(80, 'fisica'),
(82, 'Matematica'),
(83, 'Biologia'),
(84, 'Matematicas');

-- --------------------------------------------------------

--
-- Table structure for table `profesor_materias`
--

CREATE TABLE `profesor_materias` (
  `id_pm` int(11) NOT NULL,
  `id_profesor` int(11) DEFAULT NULL,
  `id_profemate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profesor_materias`
--

INSERT INTO `profesor_materias` (`id_pm`, `id_profesor`, `id_profemate`) VALUES
(55, 3, 22),
(58, 58, 84);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'admin'),
(2, 'maestro'),
(3, 'alumno');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `dni` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `dni`, `nombre`, `apellido`, `fecha_nacimiento`, `direccion`, `rol_id`) VALUES
(1, 21789098, 'Kevin', 'Macias', '1999-08-17', 'Cerro Grande', 1),
(3, 897650, 'Emma', 'Macias', '1995-05-10', 'Cerro Grande', 3),
(58, 214783647, 'Yeny', 'Macias', '0000-00-00', 'Cerro Grande', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnos_materias`
--
ALTER TABLE `alumnos_materias`
  ADD PRIMARY KEY (`id_am`),
  ADD KEY `alumnos_materias_FK` (`id_alumno`),
  ADD KEY `alumnos_materias_FK_1` (`id_alumate`);

--
-- Indexes for table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `login_user_FK` (`id_users`);

--
-- Indexes for table `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indexes for table `profesor_materias`
--
ALTER TABLE `profesor_materias`
  ADD PRIMARY KEY (`id_pm`),
  ADD KEY `profesor_materias_FK_1` (`id_profemate`),
  ADD KEY `profesor_materias_FK_2` (`id_profesor`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `usuarios_FK` (`rol_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnos_materias`
--
ALTER TABLE `alumnos_materias`
  MODIFY `id_am` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `materias`
--
ALTER TABLE `materias`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `profesor_materias`
--
ALTER TABLE `profesor_materias`
  MODIFY `id_pm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumnos_materias`
--
ALTER TABLE `alumnos_materias`
  ADD CONSTRAINT `alumnos_materias_FK` FOREIGN KEY (`id_alumno`) REFERENCES `usuarios` (`id_user`) ON DELETE SET NULL,
  ADD CONSTRAINT `alumnos_materias_FK_1` FOREIGN KEY (`id_alumate`) REFERENCES `materias` (`id_materia`);

--
-- Constraints for table `profesor_materias`
--
ALTER TABLE `profesor_materias`
  ADD CONSTRAINT `profesor_materias_FK_1` FOREIGN KEY (`id_profemate`) REFERENCES `materias` (`id_materia`),
  ADD CONSTRAINT `profesor_materias_FK_2` FOREIGN KEY (`id_profesor`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_FK` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
