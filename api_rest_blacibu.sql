-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 06, 2021 at 06:19 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `api_rest_blacibu`
--

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
--

CREATE TABLE `administradores` (
  `id` int(255) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tiporegistro_id` int(11) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `idioma` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `pais_ejerce` varchar(255) DEFAULT NULL,
  `pasaporte` varchar(255) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `edad` varchar(255) DEFAULT NULL,
  `lugar_nac` varchar(255) DEFAULT NULL,
  `nacionalidad` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` text,
  `cod_postal` varchar(255) DEFAULT NULL,
  `rrss_facebook` varchar(255) DEFAULT NULL,
  `rrss_instagram` varchar(255) DEFAULT NULL,
  `rrss_twitter` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`id`, `name`, `surname`, `role`, `email`, `password`, `tiporegistro_id`, `estado`, `idioma`, `pais`, `pais_ejerce`, `pasaporte`, `fecha_nac`, `edad`, `lugar_nac`, `nacionalidad`, `telefono`, `direccion`, `cod_postal`, `rrss_facebook`, `rrss_instagram`, `rrss_twitter`, `image`, `user_id`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'Admin', 'Cordova', 'ROLE_ADMIN', 'mercadocreativo@hotmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 3, 'true', 'es', 'Venezuela', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-07 20:51:09', '2021-01-07 20:51:09', NULL),
(2, 'Malcolm', 'Cordova', 'ROLE_ADMIN', 'mercadocreativo@gomail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 3, 'true', 'es', 'Brasil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-07 21:25:46', '2021-01-07 21:25:46', NULL),
(3, 'Malcolm', 'Cordova', 'ROLE_ADMIN', 'mercadocreativo@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 3, 'true', 'es', 'Venezuela', 'Venezuela', '12345', '1980-03-31', '40', 'Venezuela', 'Venezolano', '12345', 'Av. Triunfo! con calle La Razón, coño', '1010A', '@prueb', '@prueb', '@prueb', '1611263605prod4-100.jpg', NULL, '2021-01-07 21:27:50', '2021-01-07 21:27:50', NULL),
(4, 'Prueba', 'Admin', 'ROLE_Admin', 'prueba@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 3, 'false', 'es', 'Chile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-20 03:55:25', '2021-01-20 03:55:25', NULL),
(5, 'Malcolm', 'Prueba', 'ROLE_Admin', 'malcolmprueba@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 3, 'false', 'es', 'Colombia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 16:06:14', '2021-01-21 16:06:14', NULL),
(6, 'OtraaPrueba', 'Prueba', 'ROLE_ADMIN', 'ootramass@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 3, 'false', 'es', 'Chile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-24 04:44:29', '2021-01-24 04:44:29', NULL),
(7, 'UnaMas', 'Prueba', 'ROLE_ADMIN', 'unamas@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 3, 'false', 'es', 'Chile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-24 04:45:15', '2021-01-24 04:45:15', NULL),
(8, 'UnaMas', 'Prueba', 'ROLE_ADMIN', 'unadeestado@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 3, 'false', 'es', 'Chile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-24 04:46:41', '2021-01-24 04:46:41', NULL),
(9, 'pruebbbaa', 'ooorra', 'ROLE_ADMIN', 'pru@pru.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 3, 'false', 'es', 'Bolivia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-24 05:04:39', '2021-01-24 05:04:39', NULL),
(10, 'Prueba', 'Desde', 'ROLE_ADMIN', 'soyarrecho@yo.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 3, 'false', 'pt', 'Brasil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-24 05:46:19', '2021-01-24 05:46:19', NULL),
(11, 'prueba nueva', 'desde app', 'ROLE_ADMIN', 'poooooo@mail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 3, 'true', 'es', 'Ecuador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-24 05:48:11', '2021-01-24 05:48:11', NULL),
(12, 'Ronar', 'Gudiño', 'ROLE_ADMIN', 'odronar@gmail.com', '1c3be601b4eea9ed2f8f5f3bbc8ad08c58a5fae51190a88af1b66f999d26792f', 3, '0', 'es', 'Venezuela', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-26 04:35:16', '2021-01-26 04:35:16', NULL),
(13, 'María Herminia', 'Bellorín', 'ROLE_ADMIN', 'mhbellorin@hotmail.com', 'b08b9a34582633b48acf543730b4c2a17daea0cf07037ad171f379ec6304b3ab', 3, '0', 'es', 'Venezuela', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-26 04:38:34', '2021-01-26 04:38:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `certificados`
--

CREATE TABLE `certificados` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `tiporegistro_id` int(255) NOT NULL,
  `user_post_id` int(255) DEFAULT NULL,
  `cert_asist_avalados_nombre` varchar(100) DEFAULT NULL,
  `cert_asist_avalados_ano` varchar(100) DEFAULT NULL,
  `cert_asist_avalados_otrasinst` varchar(100) DEFAULT NULL,
  `cert_asist_avalados_horas` varchar(100) DEFAULT NULL,
  `cert_asist_avalados_pdf` varchar(255) DEFAULT NULL,
  `cert_asist_avalados_status_id` int(11) DEFAULT NULL,
  `cert_asist_no_avalados_nombre` varchar(100) DEFAULT NULL,
  `cert_asist_no_avalados_ano` varchar(100) DEFAULT NULL,
  `cert_asist_no_avalados_otrasinst` varchar(100) DEFAULT NULL,
  `cert_asist_no_avalados_horas` varchar(100) DEFAULT NULL,
  `cert_asist_no_avalados_status_id` int(11) DEFAULT NULL,
  `cert_o_diploma_academico_nombre` varchar(100) DEFAULT NULL,
  `cert_o_diploma_academico_cargo` varchar(100) DEFAULT NULL,
  `cert_o_diploma_academico_tiempo` varchar(100) DEFAULT NULL,
  `cert_o_diploma_academico_otrasinst` varchar(100) DEFAULT NULL,
  `cert_o_diploma_academico_pdf` varchar(100) DEFAULT NULL,
  `cert_o_diploma_academico_status_id` int(11) DEFAULT NULL,
  `cert_o_diploma_asistencial_cargo` varchar(100) DEFAULT NULL,
  `cert_o_diploma_asistencial_tiempo` varchar(100) DEFAULT NULL,
  `cert_o_diploma_asistencial_otrasinst` varchar(100) DEFAULT NULL,
  `cert_o_diploma_asistencial_pdf` varchar(100) DEFAULT NULL,
  `cert_o_diploma_asistencial_status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificados`
--

INSERT INTO `certificados` (`id`, `user_id`, `tiporegistro_id`, `user_post_id`, `cert_asist_avalados_nombre`, `cert_asist_avalados_ano`, `cert_asist_avalados_otrasinst`, `cert_asist_avalados_horas`, `cert_asist_avalados_pdf`, `cert_asist_avalados_status_id`, `cert_asist_no_avalados_nombre`, `cert_asist_no_avalados_ano`, `cert_asist_no_avalados_otrasinst`, `cert_asist_no_avalados_horas`, `cert_asist_no_avalados_status_id`, `cert_o_diploma_academico_nombre`, `cert_o_diploma_academico_cargo`, `cert_o_diploma_academico_tiempo`, `cert_o_diploma_academico_otrasinst`, `cert_o_diploma_academico_pdf`, `cert_o_diploma_academico_status_id`, `cert_o_diploma_asistencial_cargo`, `cert_o_diploma_asistencial_tiempo`, `cert_o_diploma_asistencial_otrasinst`, `cert_o_diploma_asistencial_pdf`, `cert_o_diploma_asistencial_status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'prueba', 'prueba', 'prueba', 'prueba', NULL, 1, 'prueba', 'prueba', 'prueba', 'prueba', 2, 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 3, 'prueba', 'prueba', 'prueba', 'prueba', 4, '2021-01-12 19:57:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conferencia_y_trabajos`
--

CREATE TABLE `conferencia_y_trabajos` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `tiporegistro_id` int(255) NOT NULL,
  `user_post_id` int(255) DEFAULT NULL,
  `conf_con_aval_academico_titulo` varchar(100) DEFAULT NULL,
  `conf_con_aval_academico_evento` varchar(100) DEFAULT NULL,
  `conf_con_aval_academico_pdf` varchar(100) DEFAULT NULL,
  `conf_con_aval_academico_status_id` int(11) DEFAULT NULL,
  `conf_sin_aval_academico_titulo` varchar(100) DEFAULT NULL,
  `conf_sin_aval_academico_evento` varchar(100) DEFAULT NULL,
  `conf_sin_aval_academico_pdf` varchar(100) DEFAULT NULL,
  `conf_sin_aval_academico_status_id` int(11) DEFAULT NULL,
  `trab_pres_con_aval_titulo` varchar(100) DEFAULT NULL,
  `trab_pres_con_aval_evento` varchar(100) DEFAULT NULL,
  `trab_pres_con_aval_modalidad` varchar(100) DEFAULT NULL,
  `trab_pres_con_aval_pdf` varchar(100) DEFAULT NULL,
  `trab_pres_con_aval_status_id` int(11) DEFAULT NULL,
  `trab_pres_sin_aval_titulo` varchar(100) DEFAULT NULL,
  `trab_pres_sin_aval_evento` varchar(100) DEFAULT NULL,
  `trab_pres_sin_aval_modalidad` varchar(100) DEFAULT NULL,
  `trab_pres_sin_aval_pdf` varchar(100) DEFAULT NULL,
  `trab_pres_sin_aval_status_id` int(11) DEFAULT NULL,
  `trab_publicados_nombre` varchar(100) DEFAULT NULL,
  `trab_publicados_ano` varchar(100) DEFAULT NULL,
  `trab_publicados_revisa` varchar(100) DEFAULT NULL,
  `trab_publicados_pdf` varchar(100) DEFAULT NULL,
  `trab_publicados_status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conferencia_y_trabajos`
--

INSERT INTO `conferencia_y_trabajos` (`id`, `user_id`, `tiporegistro_id`, `user_post_id`, `conf_con_aval_academico_titulo`, `conf_con_aval_academico_evento`, `conf_con_aval_academico_pdf`, `conf_con_aval_academico_status_id`, `conf_sin_aval_academico_titulo`, `conf_sin_aval_academico_evento`, `conf_sin_aval_academico_pdf`, `conf_sin_aval_academico_status_id`, `trab_pres_con_aval_titulo`, `trab_pres_con_aval_evento`, `trab_pres_con_aval_modalidad`, `trab_pres_con_aval_pdf`, `trab_pres_con_aval_status_id`, `trab_pres_sin_aval_titulo`, `trab_pres_sin_aval_evento`, `trab_pres_sin_aval_modalidad`, `trab_pres_sin_aval_pdf`, `trab_pres_sin_aval_status_id`, `trab_publicados_nombre`, `trab_publicados_ano`, `trab_publicados_revisa`, `trab_publicados_pdf`, `trab_publicados_status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'prueba', 'prueba', 'prueba', 1, 'prueba', 'prueba', 'prueba', 2, 'prueba', 'prueba', 'prueba', 'prueba', 3, 'prueba', 'prueba', 'prueba', 'prueba', 1, 'prueba', 'prueba', 'prueba', 'prueba', 2, '2021-01-12 20:00:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documentos`
--

CREATE TABLE `documentos` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `tiporegistro_id` int(255) NOT NULL,
  `user_post_id` int(255) DEFAULT NULL,
  `pdf_titulo_odontologo` varchar(100) DEFAULT NULL,
  `pdf_titulo_odontologo_status_id` int(11) DEFAULT NULL,
  `pdf_matricula_odontologo` varchar(100) DEFAULT NULL,
  `pdf_matricula_odontologo_status_id` int(11) DEFAULT NULL,
  `pdf_titulo_espec_bucomax` varchar(100) DEFAULT NULL,
  `pdf_titulo_espec_bucomax_status_id` int(11) DEFAULT NULL,
  `pdf_matricula_bucomax` varchar(100) DEFAULT NULL,
  `pdf_matricula_bucomax_status_id` int(11) DEFAULT NULL,
  `pdf_residencia_especializacion` varchar(100) DEFAULT NULL,
  `pdf_residencia_especializacion_status_id` int(11) DEFAULT NULL,
  `pdf_constancia_miembro` varchar(100) DEFAULT NULL,
  `pdf_constancia_miembro_status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documentos`
--

INSERT INTO `documentos` (`id`, `user_id`, `tiporegistro_id`, `user_post_id`, `pdf_titulo_odontologo`, `pdf_titulo_odontologo_status_id`, `pdf_matricula_odontologo`, `pdf_matricula_odontologo_status_id`, `pdf_titulo_espec_bucomax`, `pdf_titulo_espec_bucomax_status_id`, `pdf_matricula_bucomax`, `pdf_matricula_bucomax_status_id`, `pdf_residencia_especializacion`, `pdf_residencia_especializacion_status_id`, `pdf_constancia_miembro`, `pdf_constancia_miembro_status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '1614985728Recibo-factura-SVCBMF.pdf', 1, '16147073679122.pdf', 1, '16147073795187.pdf', 1, '161470734818437.pdf', 1, '161470733736937.pdf', 1, '161470742263468.pdf', 1, '2021-01-12 19:59:00', '2021-03-05 23:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `miembros`
--

CREATE TABLE `miembros` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `tiporegistro_id` int(255) NOT NULL,
  `user_post_id` int(255) DEFAULT NULL,
  `numero_miembro` varchar(100) DEFAULT NULL,
  `ano_certificacion` varchar(100) DEFAULT NULL,
  `tiempo_titulado` varchar(255) DEFAULT NULL,
  `ano_graduado` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `miembros`
--

INSERT INTO `miembros` (`id`, `user_id`, `tiporegistro_id`, `user_post_id`, `numero_miembro`, `ano_certificacion`, `tiempo_titulado`, `ano_graduado`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, '123456', '2021', '', '', '2021-01-12 20:07:07', NULL),
(2, 6, 2, 6, '123333', '1980', '', '', '2021-02-01 15:37:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `tiporegistro_id` int(255) NOT NULL,
  `user_post_id` int(255) DEFAULT NULL,
  `transf_banco` varchar(100) DEFAULT NULL,
  `transf_fecha` date DEFAULT NULL,
  `transf_numero` varchar(100) DEFAULT NULL,
  `transf_pdf` varchar(100) DEFAULT NULL,
  `transf_pdf_status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagos`
--

INSERT INTO `pagos` (`id`, `user_id`, `tiporegistro_id`, `user_post_id`, `transf_banco`, `transf_fecha`, `transf_numero`, `transf_pdf`, `transf_pdf_status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Mercantil', '2021-01-12', '12345', '1614990416Web_V1_R3.pdf', 1, '2021-01-12 20:02:01', '2021-03-06 00:26:56'),
(2, 2, 2, 2, 'Banesco', '2021-01-12', '123456', '161491948118437.pdf', 3, '2021-01-12 20:02:01', '2021-03-05 04:44:41'),
(3, 3, 1, 3, 'Venezuela', '2021-02-01', '12345', '1615000761Web_V1_R3.pdf', 2, '2021-02-01 15:21:27', '2021-03-06 03:19:21'),
(4, 6, 2, 6, 'Zelle', '2021-02-01', '12345', 'prueba', 2, '2021-02-01 15:21:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recert_certificados`
--

CREATE TABLE `recert_certificados` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `tiporegistro_id` int(255) NOT NULL,
  `user_post_id` int(255) DEFAULT NULL,
  `cert_act_academicas_y_asistenciales_nombre` varchar(100) DEFAULT NULL,
  `cert_act_academicas_y_asistenciales_cargo` varchar(100) DEFAULT NULL,
  `cert_act_academicas_y_asistenciales_tiempo` varchar(100) DEFAULT NULL,
  `cert_act_academicas_y_asistenciales_institucion` varchar(100) DEFAULT NULL,
  `cert_act_academicas_y_asistenciales_pdf` varchar(100) DEFAULT NULL,
  `cert_act_academicas_y_asistenciales_status` varchar(100) DEFAULT NULL,
  `trab_esp_y_art_cientificos_nombre` varchar(100) DEFAULT NULL,
  `trab_esp_y_art_cientificos_ano` varchar(100) DEFAULT NULL,
  `trab_esp_y_art_cientificos_revista` varchar(100) DEFAULT NULL,
  `trab_esp_y_art_cientificos_institucion` varchar(100) DEFAULT NULL,
  `trab_esp_y_art_cientificos_encalidad` varchar(100) DEFAULT NULL,
  `trab_esp_y_art_cientificos_pdf` varchar(100) DEFAULT NULL,
  `trab_esp_y_art_cientificos_status` varchar(100) DEFAULT NULL,
  `act_editor_revisor_pub_cient_nombre` varchar(100) DEFAULT NULL,
  `act_editor_revisor_pub_cient_ano` varchar(100) DEFAULT NULL,
  `act_editor_revisor_pub_cient_revista` varchar(100) DEFAULT NULL,
  `act_editor_revisor_pub_cient_pdf` varchar(100) DEFAULT NULL,
  `act_editor_revisor_pub_cient_status` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_de_especialidad_nombre` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_de_especialidad_modalidad` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_de_especialidad_ano` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_de_especialidad_institucion` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_de_especialidad_horas` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_de_especialidad_encalidade` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_de_especialidad_pdf` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_de_especialidad_status` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_no_especialidad_nombre` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_no_especialidad_modalidad` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_no_especialidad_ano` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_no_especialidad_institucion` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_no_especialidad_horas` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_no_especialidad_encalidade` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_no_especialidad_pdf` varchar(100) DEFAULT NULL,
  `cert_asist_simposio_no_especialidad_status` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recert_certificados`
--

INSERT INTO `recert_certificados` (`id`, `user_id`, `tiporegistro_id`, `user_post_id`, `cert_act_academicas_y_asistenciales_nombre`, `cert_act_academicas_y_asistenciales_cargo`, `cert_act_academicas_y_asistenciales_tiempo`, `cert_act_academicas_y_asistenciales_institucion`, `cert_act_academicas_y_asistenciales_pdf`, `cert_act_academicas_y_asistenciales_status`, `trab_esp_y_art_cientificos_nombre`, `trab_esp_y_art_cientificos_ano`, `trab_esp_y_art_cientificos_revista`, `trab_esp_y_art_cientificos_institucion`, `trab_esp_y_art_cientificos_encalidad`, `trab_esp_y_art_cientificos_pdf`, `trab_esp_y_art_cientificos_status`, `act_editor_revisor_pub_cient_nombre`, `act_editor_revisor_pub_cient_ano`, `act_editor_revisor_pub_cient_revista`, `act_editor_revisor_pub_cient_pdf`, `act_editor_revisor_pub_cient_status`, `cert_asist_simposio_de_especialidad_nombre`, `cert_asist_simposio_de_especialidad_modalidad`, `cert_asist_simposio_de_especialidad_ano`, `cert_asist_simposio_de_especialidad_institucion`, `cert_asist_simposio_de_especialidad_horas`, `cert_asist_simposio_de_especialidad_encalidade`, `cert_asist_simposio_de_especialidad_pdf`, `cert_asist_simposio_de_especialidad_status`, `cert_asist_simposio_no_especialidad_nombre`, `cert_asist_simposio_no_especialidad_modalidad`, `cert_asist_simposio_no_especialidad_ano`, `cert_asist_simposio_no_especialidad_institucion`, `cert_asist_simposio_no_especialidad_horas`, `cert_asist_simposio_no_especialidad_encalidade`, `cert_asist_simposio_no_especialidad_pdf`, `cert_asist_simposio_no_especialidad_status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', '2021-01-12 20:03:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recert_conf_afiliaciones`
--

CREATE TABLE `recert_conf_afiliaciones` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tiporegistro_id` int(255) NOT NULL,
  `user_post_id` int(255) DEFAULT NULL,
  `conf_nac_inter_titulo` varchar(255) DEFAULT NULL,
  `conf_nac_inter_evento` varchar(255) DEFAULT NULL,
  `conf_nac_inter_pdf` varchar(255) DEFAULT NULL,
  `conf_nac_inter_status_id` int(11) DEFAULT NULL,
  `conf_nac_inter_cialacibu_titulo` varchar(255) DEFAULT NULL,
  `conf_nac_inter_cialacibu_evento` varchar(255) DEFAULT NULL,
  `conf_nac_inter_cialacibu_pdf` varchar(255) DEFAULT NULL,
  `conf_nac_inter_cialacibu_status_id` int(11) DEFAULT NULL,
  `afilia_asosc_odont_nac_extran_nombre` varchar(255) DEFAULT NULL,
  `afilia_asosc_odont_nac_extran_cargo` varchar(255) DEFAULT NULL,
  `afilia_asosc_odont_nac_extran_categoria` varchar(255) DEFAULT NULL,
  `afilia_asosc_odont_nac_extran_gremio` varchar(255) DEFAULT NULL,
  `afilia_asosc_odont_nac_extran_pdf` varchar(255) DEFAULT NULL,
  `afilia_asosc_odont_nac_extran_status_id` int(11) DEFAULT NULL,
  `colaboracion_acade_para_blacibu_figura` varchar(255) DEFAULT NULL,
  `colaboracion_acade_para_blacibu_ano` varchar(255) DEFAULT NULL,
  `colaboracion_acade_para_blacibu_funcion` varchar(255) DEFAULT NULL,
  `colaboracion_acade_para_blacibu_pdf` varchar(255) DEFAULT NULL,
  `colaboracion_acade_para_blacibu_status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recert_conf_afiliaciones`
--

INSERT INTO `recert_conf_afiliaciones` (`id`, `user_id`, `tiporegistro_id`, `user_post_id`, `conf_nac_inter_titulo`, `conf_nac_inter_evento`, `conf_nac_inter_pdf`, `conf_nac_inter_status_id`, `conf_nac_inter_cialacibu_titulo`, `conf_nac_inter_cialacibu_evento`, `conf_nac_inter_cialacibu_pdf`, `conf_nac_inter_cialacibu_status_id`, `afilia_asosc_odont_nac_extran_nombre`, `afilia_asosc_odont_nac_extran_cargo`, `afilia_asosc_odont_nac_extran_categoria`, `afilia_asosc_odont_nac_extran_gremio`, `afilia_asosc_odont_nac_extran_pdf`, `afilia_asosc_odont_nac_extran_status_id`, `colaboracion_acade_para_blacibu_figura`, `colaboracion_acade_para_blacibu_ano`, `colaboracion_acade_para_blacibu_funcion`, `colaboracion_acade_para_blacibu_pdf`, `colaboracion_acade_para_blacibu_status_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, 'prueba', 'prueba', 'prueba', 1, 'prueba', 'prueba', 'prueba', 2, 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 3, 'prueba', 'prueba', 'prueba', 'prueba', 4, '2021-01-12 20:05:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recert_constancias`
--

CREATE TABLE `recert_constancias` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `tiporegistro_id` int(255) NOT NULL,
  `user_post_id` int(255) DEFAULT NULL,
  `const_miembro_activo_pdf` varchar(100) DEFAULT NULL,
  `const_miembro_activo_status_id` int(11) DEFAULT NULL,
  `curriculum_pdf` varchar(100) DEFAULT NULL,
  `curriculum_status_id` int(11) DEFAULT NULL,
  `const_practica_privada_pdf` varchar(100) DEFAULT NULL,
  `const_anos` varchar(255) DEFAULT NULL,
  `const_practica_privada_status_id` int(11) DEFAULT NULL,
  `distinciones_premios_pdf` varchar(100) DEFAULT NULL,
  `distinciones_premios_status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recert_constancias`
--

INSERT INTO `recert_constancias` (`id`, `user_id`, `tiporegistro_id`, `user_post_id`, `const_miembro_activo_pdf`, `const_miembro_activo_status_id`, `curriculum_pdf`, `curriculum_status_id`, `const_practica_privada_pdf`, `const_anos`, `const_practica_privada_status_id`, `distinciones_premios_pdf`, `distinciones_premios_status_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, 'prueba', 1, 'prueba', 1, 'prueba', NULL, 1, 'prueba', 1, '2021-01-12 20:06:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(255) NOT NULL,
  `user_post_id` int(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `user_post_id`, `name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'ROLE_ADMIN', NULL, NULL),
(2, NULL, 'ROLE_USER', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `color`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Aprobado', 'green', 'fa-check-circle', NULL, NULL),
(2, 'Revisar', 'blue', 'fa-eye', NULL, NULL),
(3, 'Revisando', 'orange', 'fa-search', NULL, NULL),
(4, 'Rechazado', 'red', 'fa-circle', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tiporegistros`
--

CREATE TABLE `tiporegistros` (
  `id` int(255) NOT NULL,
  `user_post_id` int(255) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tiporegistros`
--

INSERT INTO `tiporegistros` (`id`, `user_post_id`, `name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Certificado', NULL, NULL),
(2, NULL, 'Recertificado', NULL, NULL),
(3, NULL, 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userposts`
--

CREATE TABLE `userposts` (
  `id` int(255) NOT NULL,
  `user_post_id` int(255) DEFAULT NULL,
  `pagos_userpost_id` int(255) DEFAULT NULL,
  `status_userpost_id` int(255) DEFAULT NULL,
  `documentos_userpost_id` int(255) DEFAULT NULL,
  `certificados_userpost_id` int(255) DEFAULT NULL,
  `constancias_userpost_id` int(255) DEFAULT NULL,
  `conferencias_userpost_id` int(255) DEFAULT NULL,
  `rec_constancias_userpost_id` int(255) DEFAULT NULL,
  `rec_certificados_userpost_id` int(255) DEFAULT NULL,
  `rec_conferencias_userpost_id` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userposts`
--

INSERT INTO `userposts` (`id`, `user_post_id`, `pagos_userpost_id`, `status_userpost_id`, `documentos_userpost_id`, `certificados_userpost_id`, `constancias_userpost_id`, `conferencias_userpost_id`, `rec_constancias_userpost_id`, `rec_certificados_userpost_id`, `rec_conferencias_userpost_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(2, 2, 2, 2, NULL, NULL, 2, NULL, 2, 2, 2, NULL, NULL),
(3, 3, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tiporegistro_id` int(255) NOT NULL,
  `user_post_id` int(255) DEFAULT NULL,
  `idioma` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `pasaporte` varchar(255) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `edad` varchar(255) DEFAULT NULL,
  `lugar_nac` varchar(255) DEFAULT NULL,
  `nacionalidad` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` text,
  `cod_postal` varchar(255) DEFAULT NULL,
  `pais_ejerce` varchar(255) DEFAULT NULL,
  `user_red` varchar(255) DEFAULT NULL,
  `red_social` varchar(255) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `role`, `email`, `password`, `tiporegistro_id`, `user_post_id`, `idioma`, `pais`, `pasaporte`, `fecha_nac`, `edad`, `lugar_nac`, `nacionalidad`, `telefono`, `direccion`, `cod_postal`, `pais_ejerce`, `user_red`, `red_social`, `status_id`, `image`, `email_verified_at`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'Malcolmdas', 'das', 'ROLE_USER', 'mercadocreativo@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 1, 1, 'es', 'Venezuela', '12345', '2021-02-02', '23', 'Venezuela', 'Venezolano', '4241874370', 'caracas, sadas dasdsa', '1010a', 'Venezuela', 'ddas', 'das', 1, '1614985667logo.png', NULL, '2021-01-11 18:40:33', '2021-03-06 04:02:25', NULL),
(2, 'User', 'Prueba', 'ROLE_USER', 'prueba@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 2, 2, 'pt', 'Brasil', '12345', '2021-01-12', '20', 'Brasil', 'Brasileiro', '12345', 'Av. Brasil, con calle caroni, Edif. ultrabello', '1221', 'Brasil', '@user', '@user', 2, '1614488181logo.png', NULL, '2021-01-11 18:41:11', '2021-02-28 04:56:21', NULL),
(3, 'Malcolmdas', 'Cordova', 'ROLE_USER', 'malcolmprueba@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 1, 3, 'es', 'Argentina', '12345', '2021-02-10', '40', 'Argentina', 'cxz', '4241874370', 'caracas\ncaracas', '1010a', 'Venezuela', '@user', 'ads', 3, '1615000720bocabeachhouse.jpg', NULL, '2021-01-22 23:44:43', '2021-03-06 03:19:27', NULL),
(4, 'OtraPrueba', 'Prueba', 'ROLE_USER', 'otraprueba@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 2, 4, 'es', 'Colombia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '1615002933res5.jpg', NULL, '2021-01-23 02:28:30', '2021-03-06 03:55:33', NULL),
(5, 'OtraaPrueba', 'Prueba', '', 'ootramas@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 2, 5, 'es', 'Chile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-24 04:43:43', '2021-01-24 04:43:43', NULL),
(6, 'User9', 'Prueba9', 'ROLE_USER', 'prueba9@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 2, 6, 'pt', 'Brasil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1614706536logo.png', NULL, '2021-01-26 09:21:39', '2021-03-02 17:35:36', NULL),
(7, 'oootro', 'oootro', 'ROLE_USER', 'pruebaderegistro@prueba.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 1, 7, 'es', 'Argentina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-26 09:31:08', '2021-01-26 09:31:08', NULL),
(8, 'ootra prueba', 'desde apppp', 'ROLE_USER', 'pruebadesdeapp@prueba.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 1, 8, 'es', 'Venezuela', '23', '2021-03-02', '23', 'Algeria', '23', '23', 'das', 'das2e32', 'Brasil', 'rwewer', 'rwe23', NULL, '1615003212res2.jpg', NULL, '2021-01-26 09:41:06', '2021-03-06 04:00:27', NULL),
(9, 'Usuario', 'Cordova', 'ROLE_USER', 'token@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 1, 1, 'es', 'Venezuela', '32', '2021-03-03', '23', 'American Samoa', 'da', '23', 'dasdas', '1212', 'Venezuela', 'das;dasdsa', 'das;dsadsa', NULL, NULL, NULL, '2021-02-20 01:41:08', '2021-03-02 17:38:40', NULL),
(10, 'UnaMas', 'Prueba', NULL, 'unadeestado@gmail.com', '$2y$10$aXH82MtpLTRKIR2VkxHPkuA0YkHElH1V.e4wHBngO/pCUnIgRdeW6', 3, NULL, 'es', 'Chile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-21 17:29:04', '2021-02-21 17:29:04', NULL),
(11, 'UnaMas', 'Prueba', NULL, 'ooottrrasdas@gmail.com', '$2y$10$.AXolBy8RvIKcoVnO8WeteCyw0drdWCWPCd/tFA94JOxydifGjw1O', 3, NULL, 'es', 'Chile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-21 17:29:36', '2021-02-21 17:29:36', NULL),
(12, 'UnaMas', 'Prueba', NULL, 'aver@gmail.com', '$2y$10$3Ximb1rD8sXLxqEwdb6SpOKwC0VA6r0gEvRGjwY2loqIl9QIiLuzu', 3, NULL, 'es', 'Chile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-21 17:30:10', '2021-02-21 17:30:10', NULL),
(13, 'UnaMas', 'Prueba', NULL, 'avedsar@gmail.com', '$2y$10$XK8N9Z449jNfc0Zx.cP82eG/BsXq/MgKVYCsc0ayhifznNiJ0AzWW', 1, NULL, 'es', 'Chile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-21 17:38:31', '2021-02-21 17:38:31', NULL),
(14, 'UnaMas', 'Prueba', NULL, 'prubb@gmail.com', '$2y$10$zvdStwkLQO.woX5oRczTwOT5Z5o/L7NrLIO9c/En4Ff03X85mePRW', 1, NULL, 'es', 'Chile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-27 19:19:56', '2021-02-27 19:19:56', NULL),
(15, 'desde', 'servidor', NULL, 'desdeservidor@gmail.com', '$2y$10$1sxEv3p9lOSsaqOnsVRUYuQZPS2V2c7vB0WK8bgmT1pd67dJ31CuK', 1, NULL, 'es', 'Chile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-02 16:55:30', '2021-03-02 16:55:30', NULL),
(16, 'desde', 'servidor', NULL, 'pdasas@gmail.com', '$2y$10$4yiFyvh.sR5GCU2HFDJhW.mrWPdbl2WAQfVER2HHLvbUjnwe78rie', 1, NULL, 'es', 'Chile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-02 16:56:47', '2021-03-02 16:56:47', NULL),
(17, 'User', 'Prueba', NULL, 'merc@gmail.com', '$2y$10$gtSpCU.WmhSulGbfrCMSReujbDStKd4Ktleco8oI4gWDvpdCmy8Fq', 2, NULL, 'pt', 'Brasil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-02 17:14:14', '2021-03-02 17:14:14', NULL),
(18, 'Malcolm', 'Cordova', NULL, 'mercadocr@gmail.com', '$2y$10$M3TNEEj3uv2fQOlfRvYQ3e4/fwzNE/OiEL3Jts7tBgpK1X9I3ficy', 1, NULL, 'es', 'Venezuela', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-02 17:15:23', '2021-03-02 17:15:23', NULL),
(19, 'Malcolm', 'Cordova', NULL, 'mercadoc@gmail.com', '$2y$10$N/3ItaYoisSyrdXp.nEY2uWc38SiSw13lDW/Mpxh9A3A93I6Aootm', 1, NULL, 'es', 'Venezuela', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-02 17:25:40', '2021-03-02 17:25:40', NULL),
(20, 'Malcolm', 'Cordova', NULL, 'mercadocs@gmail.com', '$2y$10$/98y62sgIXjtXUhNmg0WZuBQYH9qHmX5TZRG/ASO/7eGKyCd5zY0q', 1, NULL, 'es', 'Venezuela', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-02 17:26:10', '2021-03-02 17:26:10', NULL),
(21, 'User', 'Prueba', NULL, 'mercsss@gmail.com', '$2y$10$FbtjlH0rT9rqVQOu4LiXi.r.gPGnQuU4nZsE5d6VWxvuK/cB846vG', 2, NULL, 'pt', 'Brasil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-02 17:28:13', '2021-03-02 17:28:13', NULL),
(22, 'das', 'dsa', NULL, 'prueregistro@gmail.com', '$2y$10$3V6B8Hq2wFuqNnjw5VOnwebb7GNsX4MGq1Mgn7y5vBJu1D2o0sZ/K', 1, NULL, 'pt', 'Argentina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-02 17:30:22', '2021-03-02 17:30:22', NULL),
(23, 'das', 'dsa', NULL, 'prueregistro2@gmail.com', '$2y$10$dtzY/r9WRx09VSCxeZG0mOJcMQZi35bPZNfSKh5c3baIuMayI2xlC', 1, NULL, 'pt', 'Argentina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-02 17:31:35', '2021-03-02 17:31:35', NULL),
(24, 'reead', 'adre', NULL, 'rwew@gmail.com', '$2y$10$mNb9vXJZhImNdbF3yHzFVOmw3vBnw8R0UC1X.oi1RI0vOFWvxHePG', 1, NULL, 'es', 'Bolivia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-02 17:51:32', '2021-03-02 17:51:32', NULL),
(25, 'adsdsad', 'sadsa', 'ROLE_USER', 'adsd@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 1, NULL, 'pt', 'Argentina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-02 18:03:34', '2021-03-02 18:03:34', NULL),
(26, 'prueba', 'prueba', 'ROLE_USER', 'dasdsa@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 1, NULL, 'es', 'Argentina', '1234523', '2021-03-04', '32', 'Algeria', 'das', '32', 'asddas', 'das', 'Brasil', 'dasdsa;dsaas', 'dsadas;dasdas', NULL, '1614708432img2.jpg', NULL, '2021-03-02 18:05:33', '2021-03-02 18:08:27', NULL),
(27, 'preubma', 'preubma', 'ROLE_USER', 'preubma@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 1, NULL, 'es', 'Argentina', '2445', '2021-03-16', '123', 'American Samoa', '123', '132', 'dasdsa', 'dassasa', 'Bolivia', 'dasdas;das', 'das;das', NULL, '1614871040Screen Shot 2021-03-03 at 3.22.44 AM.png', NULL, '2021-03-04 15:16:28', '2021-03-04 15:24:06', NULL),
(28, 'NUeva', 'nueva', 'ROLE_USER', 'nuevaaaa@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 1, NULL, 'es', 'Argentina', '123312', '2021-03-03', '32', 'Andorra', '23', '12', 'dasdas', 'dasdasdas', 'El Salvador', 'dasdsa;dasdsa', 'das;asdsa', NULL, '1614919742img3.jpg', NULL, '2021-03-05 04:48:04', '2021-03-05 04:49:47', NULL),
(29, 'Prueba', 'dasdsa', 'ROLE_USER', 'oooo@prueba.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 1, NULL, 'es', 'Argentina', 'fdsgsdgd', '2021-03-02', '234', 'Falkland Islands', 'afsd', NULL, 'afdsfdsa', '435ertfds', 'Argentina', '@sfdfds;fsdfsd;fsdfds', 'rweq;fsd;fsdfdsfds', NULL, '1614986935screenshot.png', NULL, '2021-03-05 23:23:36', '2021-03-06 03:05:20', NULL),
(30, 'userpost', 'userpost', 'ROLE_USER', 'userpost@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 1, NULL, 'pt', 'México', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-06 03:37:21', '2021-03-06 03:37:21', NULL),
(31, 'userpostsr', 'userpostsr', 'ROLE_USER', 'userpostsr@gmail.com', '1d937e9ccd3cf0d6f88cb2760316a02f95ce6c05358edc86e693e83eb1ce3610', 1, NULL, 'es', 'Guatemala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-06 03:45:20', '2021-03-06 03:45:20', NULL),
(32, 'dasqew', 'dasqew', 'ROLE_USER', 'dasqew@ads.com', 'c499fc40564af2be764530273eea9b0cd4386c1a46fd0aa35e279298cd5f568b', 1, NULL, 'es', 'Haiti', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-06 03:47:17', '2021-03-06 03:47:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo_admin` (`tiporegistro_id`),
  ADD KEY `fk_users` (`user_id`);

--
-- Indexes for table `certificados`
--
ALTER TABLE `certificados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cert_registro` (`tiporegistro_id`),
  ADD KEY `fk_cert_user` (`user_id`),
  ADD KEY `fk_status_cert_asis_avalado` (`cert_asist_avalados_status_id`),
  ADD KEY `fk_status_cert_asis_no_avalado` (`cert_asist_no_avalados_status_id`),
  ADD KEY `fk_status_cert_diploma` (`cert_o_diploma_academico_status_id`),
  ADD KEY `fk_status_cert_diploma_asistencial` (`cert_o_diploma_asistencial_status_id`),
  ADD KEY `fk_post_user` (`user_post_id`);

--
-- Indexes for table `conferencia_y_trabajos`
--
ALTER TABLE `conferencia_y_trabajos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_conf_registro` (`tiporegistro_id`),
  ADD KEY `fk_conf_user` (`user_id`),
  ADD KEY `fk_post_user_conf` (`user_post_id`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doc_registro` (`tiporegistro_id`),
  ADD KEY `fk_doc_user` (`user_id`),
  ADD KEY `fk_status_doc_miembro` (`pdf_constancia_miembro_status_id`),
  ADD KEY `fk_status_doc_bucomax` (`pdf_matricula_bucomax_status_id`),
  ADD KEY `fk_status_doc_odontologo` (`pdf_matricula_odontologo_status_id`),
  ADD KEY `fk_status_doc_especializacion` (`pdf_residencia_especializacion_status_id`),
  ADD KEY `fk_status_doc_esp_bucomax` (`pdf_titulo_espec_bucomax_status_id`),
  ADD KEY `fk_status_doc_titulo_odontologo` (`pdf_titulo_odontologo_status_id`),
  ADD KEY `fk_post_user_doc` (`user_post_id`);

--
-- Indexes for table `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_miembro_registro` (`tiporegistro_id`),
  ADD KEY `fk_miembro_user` (`user_id`),
  ADD KEY `fk_post_user_miembro` (`user_post_id`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pago_registro` (`tiporegistro_id`),
  ADD KEY `fk_pago_user` (`user_id`),
  ADD KEY `fk_status_pago` (`transf_pdf_status_id`),
  ADD KEY `fk_post_user_pago` (`user_post_id`);

--
-- Indexes for table `recert_certificados`
--
ALTER TABLE `recert_certificados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rcert_registro` (`tiporegistro_id`),
  ADD KEY `fk_rcert_user` (`user_id`),
  ADD KEY `fk_post_user_recert` (`user_post_id`);

--
-- Indexes for table `recert_conf_afiliaciones`
--
ALTER TABLE `recert_conf_afiliaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_recert_conf_afiliaciones_registro` (`tiporegistro_id`),
  ADD KEY `FK_recert_conf_afiliaciones_users` (`user_id`),
  ADD KEY `fk_status_conf_asoc` (`afilia_asosc_odont_nac_extran_status_id`),
  ADD KEY `fk_status_conf_colaboracion` (`colaboracion_acade_para_blacibu_status_id`),
  ADD KEY `fk_status_conf_internacional` (`conf_nac_inter_cialacibu_status_id`),
  ADD KEY `fk_status_conf_nacional` (`conf_nac_inter_status_id`),
  ADD KEY `fk_post_user_recconf` (`user_post_id`);

--
-- Indexes for table `recert_constancias`
--
ALTER TABLE `recert_constancias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rconst_registro` (`tiporegistro_id`),
  ADD KEY `fk_rconst_user` (`user_id`),
  ADD KEY `fk_post_user_constancias` (`user_post_id`),
  ADD KEY `fk_recert_status_miembro` (`const_miembro_activo_status_id`),
  ADD KEY `fk_recert_status_practica` (`const_practica_privada_status_id`),
  ADD KEY `fk_recert_status_curr` (`curriculum_status_id`),
  ADD KEY `fk_recert_status_premio` (`distinciones_premios_status_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiporegistros`
--
ALTER TABLE `tiporegistros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userposts`
--
ALTER TABLE `userposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pago_userpost` (`pagos_userpost_id`),
  ADD KEY `fk_documento_userpost` (`documentos_userpost_id`),
  ADD KEY `fk_certificado_userpost` (`certificados_userpost_id`),
  ADD KEY `fk_conferencia_userpost` (`conferencias_userpost_id`),
  ADD KEY `fk_rec_certificado_userpost` (`rec_certificados_userpost_id`),
  ADD KEY `fk_rec_constancia_userpost` (`rec_constancias_userpost_id`),
  ADD KEY `fk_rec_conferencia_userpost` (`rec_conferencias_userpost_id`),
  ADD KEY `fk_user_userpost` (`user_post_id`),
  ADD KEY `fk_constancia_userpost` (`constancias_userpost_id`),
  ADD KEY `fk_status_userpost` (`status_userpost_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo_user` (`tiporegistro_id`),
  ADD KEY `fk_status_user` (`status_id`),
  ADD KEY `fk_userpost_user_userpost` (`user_post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `certificados`
--
ALTER TABLE `certificados`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `conferencia_y_trabajos`
--
ALTER TABLE `conferencia_y_trabajos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recert_certificados`
--
ALTER TABLE `recert_certificados`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recert_conf_afiliaciones`
--
ALTER TABLE `recert_conf_afiliaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recert_constancias`
--
ALTER TABLE `recert_constancias`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tiporegistros`
--
ALTER TABLE `tiporegistros`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userposts`
--
ALTER TABLE `userposts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `fk_tipo_admin` FOREIGN KEY (`tiporegistro_id`) REFERENCES `tiporegistros` (`id`),
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `certificados`
--
ALTER TABLE `certificados`
  ADD CONSTRAINT `fk_cert_registro` FOREIGN KEY (`tiporegistro_id`) REFERENCES `tiporegistros` (`id`),
  ADD CONSTRAINT `fk_cert_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_post_user` FOREIGN KEY (`user_post_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_status_cert_asis_avalado` FOREIGN KEY (`cert_asist_avalados_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_status_cert_asis_no_avalado` FOREIGN KEY (`cert_asist_no_avalados_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_status_cert_diploma` FOREIGN KEY (`cert_o_diploma_academico_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_status_cert_diploma_asistencial` FOREIGN KEY (`cert_o_diploma_asistencial_status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `fk_doc_registro` FOREIGN KEY (`tiporegistro_id`) REFERENCES `tiporegistros` (`id`),
  ADD CONSTRAINT `fk_doc_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_post_user_doc` FOREIGN KEY (`user_post_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_status_doc_bucomax` FOREIGN KEY (`pdf_matricula_bucomax_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_status_doc_esp_bucomax` FOREIGN KEY (`pdf_titulo_espec_bucomax_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_status_doc_especializacion` FOREIGN KEY (`pdf_residencia_especializacion_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_status_doc_miembro` FOREIGN KEY (`pdf_constancia_miembro_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_status_doc_odontologo` FOREIGN KEY (`pdf_matricula_odontologo_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_status_doc_titulo_odontologo` FOREIGN KEY (`pdf_titulo_odontologo_status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `miembros`
--
ALTER TABLE `miembros`
  ADD CONSTRAINT `fk_miembro_registro` FOREIGN KEY (`tiporegistro_id`) REFERENCES `tiporegistros` (`id`),
  ADD CONSTRAINT `fk_miembro_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_post_user_miembro` FOREIGN KEY (`user_post_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pago_tipouser` FOREIGN KEY (`tiporegistro_id`) REFERENCES `tiporegistros` (`id`),
  ADD CONSTRAINT `fk_pago_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_post_user_pago` FOREIGN KEY (`user_post_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_status_pago` FOREIGN KEY (`transf_pdf_status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `recert_certificados`
--
ALTER TABLE `recert_certificados`
  ADD CONSTRAINT `fk_post_user_recert` FOREIGN KEY (`user_post_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_recert_certificado_registro` FOREIGN KEY (`tiporegistro_id`) REFERENCES `tiporegistros` (`id`),
  ADD CONSTRAINT `fk_recert_certificado_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `recert_conf_afiliaciones`
--
ALTER TABLE `recert_conf_afiliaciones`
  ADD CONSTRAINT `fk_post_user_recconf` FOREIGN KEY (`user_post_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_recert_conf_afiliacion_tipo` FOREIGN KEY (`tiporegistro_id`) REFERENCES `tiporegistros` (`id`),
  ADD CONSTRAINT `fk_recert_conf_afiliacion_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_status_conf_asoc` FOREIGN KEY (`afilia_asosc_odont_nac_extran_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_status_conf_colaboracion` FOREIGN KEY (`colaboracion_acade_para_blacibu_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_status_conf_internacional` FOREIGN KEY (`conf_nac_inter_cialacibu_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_status_conf_nacional` FOREIGN KEY (`conf_nac_inter_status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `recert_constancias`
--
ALTER TABLE `recert_constancias`
  ADD CONSTRAINT `FK_recert_constancias_tipo` FOREIGN KEY (`tiporegistro_id`) REFERENCES `tiporegistros` (`id`),
  ADD CONSTRAINT `FK_recert_constancias_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_post_user_constancias` FOREIGN KEY (`user_post_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_recert_status_curr` FOREIGN KEY (`curriculum_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_recert_status_miembro` FOREIGN KEY (`const_miembro_activo_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_recert_status_practica` FOREIGN KEY (`const_practica_privada_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_recert_status_premio` FOREIGN KEY (`distinciones_premios_status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `userposts`
--
ALTER TABLE `userposts`
  ADD CONSTRAINT `fk_certificado_userpost` FOREIGN KEY (`certificados_userpost_id`) REFERENCES `certificados` (`user_post_id`),
  ADD CONSTRAINT `fk_conferencia_userpost` FOREIGN KEY (`conferencias_userpost_id`) REFERENCES `conferencia_y_trabajos` (`user_post_id`),
  ADD CONSTRAINT `fk_constancia_userpost` FOREIGN KEY (`constancias_userpost_id`) REFERENCES `recert_constancias` (`user_post_id`),
  ADD CONSTRAINT `fk_documento_userpost` FOREIGN KEY (`documentos_userpost_id`) REFERENCES `documentos` (`user_post_id`),
  ADD CONSTRAINT `fk_pago_userpost` FOREIGN KEY (`pagos_userpost_id`) REFERENCES `pagos` (`user_post_id`),
  ADD CONSTRAINT `fk_rec_certificado_userpost` FOREIGN KEY (`rec_certificados_userpost_id`) REFERENCES `recert_certificados` (`user_post_id`),
  ADD CONSTRAINT `fk_rec_conferencia_userpost` FOREIGN KEY (`rec_conferencias_userpost_id`) REFERENCES `recert_conf_afiliaciones` (`user_post_id`),
  ADD CONSTRAINT `fk_rec_constancia_userpost` FOREIGN KEY (`rec_constancias_userpost_id`) REFERENCES `recert_constancias` (`user_post_id`),
  ADD CONSTRAINT `fk_status_userpost` FOREIGN KEY (`status_userpost_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_user_userpost` FOREIGN KEY (`user_post_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_status_user` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `fk_tipo_user` FOREIGN KEY (`tiporegistro_id`) REFERENCES `tiporegistros` (`id`),
  ADD CONSTRAINT `fk_userpost_user_userpost` FOREIGN KEY (`user_post_id`) REFERENCES `userposts` (`user_post_id`);
