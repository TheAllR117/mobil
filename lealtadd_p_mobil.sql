-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-07-2020 a las 19:32:06
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lealtadd_p_mobil`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controls`
--

CREATE TABLE `controls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_freights` bigint(20) UNSIGNED NOT NULL,
  `terminal_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `controls`
--

INSERT INTO `controls` (`id`, `id_freights`, `terminal_id`, `created_at`, `updated_at`) VALUES
(22, 7, 1, '2020-07-03 19:33:16', '2020-07-03 19:33:16'),
(23, 7, 1, '2020-07-28 22:54:07', '2020-07-28 22:54:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_status` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `drivers`
--

INSERT INTO `drivers` (`id`, `id_status`, `name`, `created_at`, `updated_at`) VALUES
(3, 1, 'Joel Rugerio', '2020-06-04 19:36:24', '2020-07-28 22:55:07'),
(4, 1, 'Jose Gustavo Manzola Angeles', '2020-06-04 19:36:35', '2020-06-30 23:32:29'),
(5, 1, 'Jose Luis Sanchez Torres', '2020-06-04 19:36:46', '2020-06-04 19:36:46'),
(6, 1, 'Jose Luis Guzman Salazar', '2020-06-04 19:36:58', '2020-06-04 19:36:58'),
(7, 1, 'Wilfrido Camacho Arellano', '2020-06-04 19:37:13', '2020-06-04 19:37:13'),
(9, 1, 'Jesús De la Rosa Marin', '2020-06-04 19:37:26', '2020-06-04 19:37:26'),
(10, 1, 'Miguel Rechy Jiménez', '2020-06-04 19:37:40', '2020-06-04 19:37:40'),
(11, 1, 'Pedro Vargas Flores', '2020-07-02 20:07:09', '2020-07-02 20:07:09'),
(12, 1, 'Jose Isabel Pozo Capilla', '2020-07-02 20:07:23', '2020-07-02 20:07:23'),
(13, 1, 'Rafael Gutiérrez Morales', '2020-07-02 20:07:39', '2020-07-02 20:07:39'),
(14, 1, 'Joel Torres Herrera', '2020-07-02 20:07:55', '2020-07-02 20:07:55'),
(15, 1, 'Oscar Gustavo Telles Ruiz', '2020-07-02 20:08:12', '2020-07-02 20:08:12'),
(16, 1, 'Oscar Cielo Galeazzi', '2020-07-02 20:08:28', '2020-07-02 20:08:28'),
(17, 1, 'Carlo Cielo Merlo', '2020-07-02 20:08:44', '2020-07-02 20:08:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estacions`
--

CREATE TABLE `estacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `razon_social` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sh` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_sucursal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flete_r` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flete_p` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flete_d` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ieps_r` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ieps_p` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ieps_d` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utilidad_r` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utilidad_p` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utilidad_d` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `linea_credito` tinyint(1) NOT NULL,
  `datos_fiscales` tinyint(1) NOT NULL,
  `credito` double(12,2) DEFAULT NULL,
  `credito_usado` double(12,2) DEFAULT NULL,
  `saldo` double(12,2) DEFAULT NULL,
  `dias_credito` int(11) DEFAULT NULL,
  `retencion` int(11) DEFAULT NULL,
  `codigo_postal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_de_vialidad` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_de_vialidad` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_exterior` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_interior` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_colonia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_localidad` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_municipio_o_demarcacion_territorial` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_entidad_federativa` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entre_calle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `y_calle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estacions`
--

INSERT INTO `estacions` (`id`, `razon_social`, `rfc`, `cre`, `sh`, `nombre_sucursal`, `flete_r`, `flete_p`, `flete_d`, `ieps_r`, `ieps_p`, `ieps_d`, `utilidad_r`, `utilidad_p`, `utilidad_d`, `status`, `linea_credito`, `datos_fiscales`, `credito`, `credito_usado`, `saldo`, `dias_credito`, `retencion`, `codigo_postal`, `tipo_de_vialidad`, `nombre_de_vialidad`, `n_exterior`, `n_interior`, `nombre_colonia`, `nombre_localidad`, `nombre_municipio_o_demarcacion_territorial`, `nombre_entidad_federativa`, `entre_calle`, `y_calle`, `created_at`, `updated_at`) VALUES
(1, '*', 'XEXX010101000', 'PL/11245/EXP/ES/2015', NULL, '*', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 2000000.00, 1450409.40, 0.00, 10, 4, '91157', 'Avenida', 'Lázaro Cárdenas', '81', '', 'Rafael Lucio', 'Xalapa', 'Ignacio de la Llave', 'Veracruz', 'Esq. Gildardo Aviles', '', '2020-05-19 19:40:21', '2020-05-19 19:40:21'),
(4, 'ESTACIÓN HUEXOTITLA, S. DE R.L DE C.V', 'EHU121129NA1', 'PL/10069/EXP/ES/2015', NULL, 'HUEXOTITLA', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 4120000.00, 775465.00, 0.00, 10, 4, '72430', 'CIRCUITO JUAN PABLO II', NULL, '1717', '---', 'RIVERA DEL ATOYAC', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-07-03 19:28:58'),
(5, 'GASOLNAT, S.A DE C.V', 'GAS1108123KA', 'PL/10070/EXP/ES/2015', NULL, 'GASOLNAT', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 5410000.00, 314790.00, 0.00, 10, 4, '72300', 'AV.18 DE NOVIEMBRE', NULL, '2246', '---', 'JOAQUIN COLOMBRES', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-01 22:17:09'),
(6, 'SERVICIO LAS CUPULAS, S.A DE C.V', 'SCU1008169V4', 'PL/10071/EXP/ES/2015', '', 'CUPULAS', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '74169', 'AUTOPISTA MEXICO-PUEBLA KM 102 MARGEN DERECHO', '', 'S/N', '---', 'SANTA ANA XALMIMILULCO', '---', 'Huejotzingo', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(7, 'RZ CAPITAL, S.A. DE C.V', 'RCA110506TT6', 'PL/10072/EXP/ES/2015', '', 'RZ CAPITAL', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '72160', '53 SUR', '', '902', '---', 'AMPLIACIONREFORMA SUR', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(8, 'PUEBLA AVANZA, S. DE R.L DE C.V.', 'PAV121024TR3', 'PL/10073/EXP/ES/2015', NULL, 'AVANZA', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 5940000.00, 1001610.00, 0.00, 10, 4, '74169', 'AUTOPISTA MEXICO-PUEBLA KM 100+ 400', NULL, 'S/N', '---', 'SANTA ANA XALMIMILULCO', '---', 'Huejotzingo', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-24 21:24:02'),
(9, 'GAS COMPANY, S.A DE C.V.', 'GAS991206B58', 'PL/10093/EXP/ES/2015', '', 'GAS COMPANY 1', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '75120', 'CARRT FED MEXICO-VERACRUZ VIA JALAPA KM 17+900', '', 'S/N', '---', 'Sin Colonia', '---', 'General Felipe Ángeles', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(10, 'GAS COMPANY, S.A DE C.V.', 'GAS991206B59', 'PL/10094/EXP/ES/2015', '', 'GAS COMPANY 2', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '75120', 'CARRT. FED. MEXICO-VERACRUZ KM 17+600 VIA XALAPA', '', 'S/N', '---', 'Sin Colonia', '---', 'General Felipe Ángeles', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(11, 'ECOGASOLINE, S.A DE C.V.', 'ECO110506NZ0', 'PL/10583/EXP/ES/2015', NULL, 'ECOGASOLINE', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 7180000.00, 734580.00, 0.00, 10, 4, '74294', 'BLVD.LIBRAMIENTO PUEBLA I. DE MATAMOROS', NULL, '1503', '---', 'EX RANCHO EL ACOLE', '---', 'Atlixco', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-24 21:34:30'),
(12, 'ESTACIÓN BICENTENARIO, S. DE R.L DE C.V ', 'EBl120906HW7', 'PL/10585/EXP/ES/2015', '', 'BICENTENARIO', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '72424', 'BOULEVARD VALSEQUILLO', '', '945', '---', 'FRACC. ALPHA 2', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(13, 'Z GAS COMPANY, S.A DE C.V.', 'ZGA1105064B4', 'PL/10586/EXP/ES/2015', NULL, 'Z GAS', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 5410000.00, 478640.00, 0.00, 10, 4, '72230', '11 NORTE', NULL, '7202', '---', 'VEINTE DE NOVIEMBRE', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-04 19:29:37'),
(14, 'PLAZA SANTA MARIA FUNDIDORA, S.A DE C.V.', 'PSF110813548', 'PL/10589/EXP/ES/2015', NULL, 'FUNDIDORA', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 6610000.00, 238545.00, 0.00, 10, 4, '72080', 'BOULEVARD NORTE HEROES DEL 5 DE MAYO', NULL, '713', '---', 'SANTA MARIA', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-04 19:28:16'),
(15, 'ESTACIÓN AVENIDA MEXICO 86, S. DE R.L DE C.V.', 'EAM130603KY9', 'PL/10598/EXP/ES/2015', NULL, 'MEXICO 86', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 3980000.00, 260245.00, 0.00, 10, 4, '72080', 'ENRIQUE C. REBSAMEN', NULL, '70', '---', 'MAESTRO FEDERAL', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-01 22:21:28'),
(16, 'PMC GAS, S. DE R.L DE C.V.', 'PGA130808Q37', 'PL/10608/EXP/ES/2015', NULL, 'PMC GAS', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 3509000.00, 263345.00, 0.00, 10, 4, '72430', '49 PONIENTE Y 5 B SUR', NULL, '518', '---', 'PRADOS AGUA AZUL', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-24 21:27:12'),
(17, 'JOSE ALEJANDRO GUZMAN PALAFOX', 'GUPA630504GQ7', 'PL/10651/EXP/ES/2015', NULL, 'EL SECO', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 999000.00, 485615.00, 0.00, 10, 4, '75160', 'CARRT. FED. MEXICO-VERACRUZ KM 42+800', NULL, 'S/N', '---', 'Sin Colonia', '---', 'San Salvador el Seco', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-01 22:19:32'),
(18, 'GENKUN, S. DE R.L DE C.V.', 'GEN1307032P8', 'PL/10969/EXP/ES/2015', '', 'GENKUN', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '72550', 'CALLE 2 SUR', '', '2302', '---', 'EL CARMEN', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(19, 'ALDIA, S.A DE C.V.', 'ALD9804293W2', 'PL/11243/EXP/ES/2015', NULL, 'ALDIA DORADA', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 1, 2000000.00, 1764160.00, 0.00, 10, 4, '72530', 'AV 43 ORIENTE N 219-A', NULL, 'S/N', '---', 'SAN BALTAZAR CAMPECHE', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-29 00:41:13'),
(20, 'ALDIA, S.A DE C.V.', 'ALD9804293W213', 'PL/11245/EXP/ES/2015', NULL, 'ALDIA XALAPA', '0.71', '0.71', '0.71', '0.43', '0.53', '0.36', '1.21', '1.25', '1.21', 1, 1, 0, 999000.00, 2210920.00, 0.00, 10, 4, '91157', 'AV. LAZARO CARDENAS ESQ. GILDARDO AVILES', NULL, '81', '---', 'RAFAEL LUCIO', '---', 'Xalapa', 'Veracruz', '---', '---', '2020-05-19 22:11:29', '2020-06-24 21:35:54'),
(21, 'ALDIA, S.A DE C.V.', 'ALD9804293W2', 'PL/11246/EXP/ES/2015', NULL, 'ALDIA-CHOLULA', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 4783000.00, 755005.00, 0.00, 10, 4, '72760', 'FINAL DE LA RECTA A CHOLULA', NULL, '314', '---', 'Sin Colonia', '---', 'San Andrés Cholula', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-24 21:26:00'),
(22, 'YZI AVENTURA LOMAS, S. DE R.L DE C.V.', 'YAL130703BQ2', 'PL/11350/EXP/ES/2015', '', 'YZI AVENTURA LOMAS', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '72080', 'LATERAL SUR VIA ATLIXCAYOTL', '', '5423', '---', 'SAN BERNARDINO', '---', 'San Andrés Cholula', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(23, 'FOMENTO EMPRESARIAL DE PUEBLA, S.A DE C.V.', 'FEP0204116SA', 'PL/12053/EXP/ES/2015', '', 'FEPSA', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '72560', 'BOULEVARD MUNICIPIO LIBRE', '', '1830', '---', 'UNIVERSITARIA', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(24, 'AUTOSERVICO TEPATALX, S.A DE C.V.', 'ATE0403125X4', 'PL/12580/EXP/ES/2015', '', 'AUTOSERVICO TEPATLAX', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '75100', 'CARRT. FEDERAL AMOZOC-TEZIUTLAN KM 9+650', '', 'S/N', '---', 'SIN COLONIA', '---', 'Tepatlaxco de Hidalgo', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(25, 'ZOHAN GAS, S. DE R.L DE C.V.', 'ZGA130808EA0', 'PL/13595/EXP/ES/2016', NULL, 'ZOHAN GAS', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 5510000.00, 702660.00, 0.00, 10, 4, '74290', 'AVENIDA INDEPENDENCIA', NULL, '2114', '---', 'FRANSCISCO I. MADERO', '---', 'Atlixco', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-01 22:15:53'),
(26, 'ESTACIÓN DE SERVICIOS MULTIPLES SANTO NIÑO DOCTOR, S.A DE C.V.', 'ESM131213A51', 'PL/13627/EXP/ES/2016', NULL, 'MULTIPLES', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 5970000.00, 0.00, 0.00, 10, 4, '75200', 'CALLE MIGUEL NEGRETE ORIENTE', NULL, '201', '---', 'CENTRO', '---', 'Tepeaca', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-01 20:20:13'),
(27, 'MAYORAZGO', 'POL130808LZ3', 'PL/19084/EXP/ES/2016', '', 'POLIOIL', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '72180', '23 PONIENTE', '', '3518', '---', 'BELISARIO DOMINGUEZ', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(28, 'AUTOSERVICIO SAN JOSÉ MAYORAZGO DE PUEBLA, S.A DE C.V.', 'ASJ140905NS1', 'PL/19303/EXP/ES/2016', NULL, 'MAYORAZGO', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 2000000.00, 260555.00, 0.00, 10, 4, '72480', '11 sur', NULL, '9521', '---', 'ex – hacienda mayorazgo', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-04 19:31:01'),
(29, 'GASOLINERA HEROES GEPI, S.A DE C.V. ', 'GHG130422UHA', 'PL/20331/EXP/ES/2017', '', 'HEROES GEPI', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '72494', 'Lateral Sur del Periférico Ecológico', '', '803', '---', 'ex Hacienda Chapulco', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(30, 'ESTACIÓN DE SERVICIOS ÁLAMO TEMAPACHE, S.A DE C.V.', 'ESAl60520A20', 'PL/21546/EXP/ES/2018', '', 'ÁLAMO TEMAPACHE', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '92733', 'Avenida Independencia esquina Aquiles Serdán No. 1', '', '', '---', 'Gabino González', '---', 'Veracruz de Ignacio de la Llave', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(31, 'SERVICIO PERIFÉRICO ECOLÓGICO GASCO, S. DE R.L DE C.V. ', 'SPE1607209Y2', 'PL/21688/EXP/ES/2018', '', 'GASCO', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '72595', 'Prolongación 10 Norte', '', '1434', '---', 'SC', '---', 'San Francisco Totimehuacán', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(32, 'HONESTIDAD TOTAL, S. DE R.L DE C.V.', 'HTO151027E90', 'PL/22398/EXP/ES/2019', NULL, 'HONESTIDAD', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 999000.00, 465000.00, 0.00, 10, 4, '72595', 'Boulevard Municipio Libre', NULL, '3021', '---', 'SC', '---', 'Col. Camino Real', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-04 19:27:47'),
(33, 'SERVICIOS MOMOXPAN, S.A DE C.V.', 'SMO951212GV9', 'PL/2764/EXP/ES/2015', '', 'MOMOXPAN CUETZALAN', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '73560', 'Esquina de la Prolongación Miguel Alvarado Centro', '', '134', '---', 'Cuetzalan del Progreso. Puebla', '---', 'Cuetzalan', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(34, 'SERVICIOS MOMOXPAN, S.A DE C.V.', 'SMO951212GV9', 'PL/2827/EXP/ES/2015', '', 'MOMOXPAN CAPULO', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '72850', 'Prolongación Av. 11', '', '2', '---', 'el Capulo', '---', 'Santa Clara Ocoyucan. Puebla C.P. ', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(35, 'SERVICIOS MOMOXPAN, S.A DE C.V.', 'SMO951212GV9', 'PL/3066/EXP/ES/2015', NULL, 'MOMOXPAN FORJADORES', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 1800000.00, 504215.00, 0.00, 10, 4, '72760', 'Blvd. Forjadores de Puebla Km. 107.4', NULL, 'S/N', '---', 'Santiago Momoxpan', '---', 'San Pedro Cholula. Puebla C.P.', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-24 21:31:25'),
(36, 'SERVICIO LA RECTA, S.A DE C.V.', 'SRE991115BB6', 'PL/3634/EXP/ES/2015', '', 'SERVICIO LA RECTA', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '72820', 'AV. 5 DE MAYO', '', '1622', '---', 'BARRIO DE SAN JUAN', '---', 'San Andrés Cholula', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(37, 'MARIO HERRERA OROPEZA', 'HEOM680119MR6', 'PL/3685/EXP/ES/2015', '', 'EL ÁRBOL', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '73870', 'CARRETERA A PEROTE', '', '264', '---', 'BARRIO DE XOLOCO', '---', 'Teziutlán', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(38, 'SERVICIO RIVERA SOSA, S.A DE C.V.', 'SRS000121lUA', 'PL/4300/EXP/ES/2015', '', 'RIVERA SOSA', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '73180', 'KM 108 CARRT. FEDERAL 119 APIZACO EL TEJOCOTAL', '', 'S/N', '---', 'S/C', '---', 'Ahuazotepec', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(39, 'SERVICIO VANOE, S.A DE C.V.', 'ALD9804293W2', 'PL/4901/EXP/ES/2015', '', 'VANOE', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '72140', 'AV REFORMA', '', '2922', '---', 'AMOR', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(40, 'ANGELOPOLIS, S.A DE C.V.', 'ANG980226PX2', 'PL/6657/EXP/ES/2015', NULL, 'ANGELOPOLIS', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 1000000.00, 702460.00, 0.00, 10, 4, '72700', 'CHICHIMECA PONIENTE', NULL, '2', '---', 'DESARROLLO COMERCIAL CIUDAD QUETZALC', '---', 'Cuautlancingo', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-24 21:27:52'),
(41, 'GASOIL, S.A DE C.V.', 'GAS950913l52', 'PL/7047/EXP/ES/2015', '', 'Libres Centro- 7047', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '73780', 'AVILA CAMACHO', '', '999', '---', 'CENTRO', '---', 'Libres', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(42, 'GASOIL, S.A DE C.V.', 'GAS950913l52', 'PL/7049/EXP/ES/2015', NULL, 'Libres Curva - 7049', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 999000.00, 506540.00, 0.00, 10, 4, '73780', 'AVILA CAMACHO', NULL, '1563', '---', 'CENTRO', '---', 'Libres', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-24 21:33:47'),
(43, 'GASOIL, S.A DE C.V.', 'GAS950913l52', 'PL/7050/EXP/ES/2015', NULL, 'GASOIL PERIFÉRICO', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 999000.00, 584970.00, 0.00, 10, 4, '72800', 'ANILLO PERIFERICO ECOLOGICO KM. 12', NULL, '2002', '---', 'SANTA CATARINA MARTIR', '---', 'San Andrés Cholula', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-30 23:10:23'),
(44, 'ESTACIÓN DE SERVICIO LAS ANIMAS, S.A DE C.V.', 'ESA9709029F7', 'PL/7463/EXP/ES/2015', NULL, 'LAS ANIMAS', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 3100000.00, 484685.00, 0.00, 10, 4, '72180', 'PROLONGACION 31 PONIENTE', NULL, '3724', '---', 'NUEVA ANTEQUERA', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-04 19:32:28'),
(45, 'AUTOSERVICIO CASTILLOTLA, S.A DE C.V.', 'ACA111202AG7', 'PL/8152/EXP/ES/2015', NULL, 'CASTILLOTLA', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 2000000.00, 195300.00, 0.00, 10, 4, '72480', 'PROLONGACION DE LA 11 SUR', NULL, '12928', '---', 'GUADALUPE HIDALGO', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-28 20:43:33'),
(46, 'SERVICIO LIBRAMIENTO BAPJE, S.A DE C.V. ', 'SLB040203VCT', 'PL/8187/EXP/ES/2015', '', 'BAPJE', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '90500', 'CARRT.LIB.HUAMANTLA KM 0+650 AL 0770', '', 'S/N', '---', 'SIN COLONIA', '---', 'Huamantla', 'Tlaxcala', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(47, 'GASOLINERA LA MESILLA, S.A DE C.V.', 'LATJ830224FM8', 'PL/8192/EXP/ES/2015', '', 'LA MESILLA', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '73800', 'CALLE LA MESILLA', '', '4', '---', 'BARRIO DE FRANCIA', '---', 'Teziutlán', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(48, 'GASOLINERA LA POBLANITA, S.A DE C.V.', 'SPE1607209Y2', 'PL/8264/EXP/ES/2015', '', 'POBLANITA 1', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '72090', 'AV 2 PONIENTE', '', '1902', '---', 'BARRIO DE SAN MATIAS', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(49, 'GASOLINERA LA POBLANITA, S.A DE C.V.', 'SPE1607209Y2', 'PL/8267/EXP/ES/2015', NULL, 'POBLANITA 2', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 4980000.00, 1038450.00, 0.00, 10, 4, '72580', 'AVENIDA PERIFERICO ECOLOGICO ESQ. PRIV. 22 D SUR', NULL, '2222', '---', 'BARRIO DE SAN JUAN', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-24 21:38:39'),
(50, 'SERVICIOS GASA DE PUEBLA, S.A DE C.V.', 'SGP740904213', 'PL/9383/EXP/ES/2015', NULL, 'GASA', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 2000000.00, 0.00, 0.00, 10, 4, '72210', 'CL IGNACIO ZARAGOZA N 471', NULL, 'S/N', '---', 'MALINTZI', '---', 'Puebla', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-07-02 20:47:03'),
(51, 'QUALIGAZARI, S.A. DE C.V.', 'QUA1201109K4', 'PL/7441/EXP/ES/2015', '', 'QUALIGAZARI', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '73310', 'CARR.APIZACO-HUAUCHINANGO T.CHIGNAHUAPAN ZACATLAN KM 69.20', '', 'S/N', '---', 'CARRETERA', '---', 'Zacatlán', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(52, 'GRUPO EMPRENDEDOR LAS S.A. DE C.V.', 'GET1108315l51', 'PL/22853/EXP/ES/2019', NULL, 'PUNTA ANGELOPOLIS', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 1, 0, 7430000.00, 776085.00, 0.00, 10, 4, '72820', 'Boulevard Atlixcayotl', NULL, '2202', '---', 'San Andrés Cholula', '---', 'Col. Reserva Territorial Atlixcayotl', 'Puebla', '---', '---', '2020-05-19 22:11:29', '2020-06-30 23:29:03'),
(53, 'SERVIARAGON, S.A. DE C.V.', 'SER140508C57', 'PL/4695/EXP/ES/2015', '', 'SERVIARAGON', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '---', '---', '', 'S/N', '---', '---', '---', '---', '---', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(54, 'SERVICIO 3 RÍOS, S.A. DE C.V.', 'STR880120D92', 'PL/4694/EXP/ES/2015', '', 'TRES RÍOS', '0.47', '0.47', '0.47', '0.4369', '0.5331', '0.3626', '1.21', '1.25', '1.21', 1, 0, 0, 0.00, 0.00, 0.00, 10, 4, '---', '---', '', 'S/N', '---', '---', '---', '---', '---', '---', '---', '2020-05-19 22:11:29', '2020-05-19 22:11:29'),
(55, 'Digitalsoft', 'XEXX010101000', '13341415', NULL, 'Digitalsoft', '1.41', '1.41', '1.41', '1.41', '1.41', '1.41', '1.41', '1.41', '1.41', 1, 1, 0, 10000000.00, 9665465.00, 0.00, 10, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-19 22:36:38', '2020-07-28 22:44:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estacion_user`
--

CREATE TABLE `estacion_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `estacion_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estacion_user`
--

INSERT INTO `estacion_user` (`id`, `user_id`, `estacion_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, NULL, NULL),
(4, 4, 55, NULL, NULL),
(9, 9, 19, NULL, NULL),
(11, 11, 5, NULL, NULL),
(13, 13, 7, NULL, NULL),
(15, 15, 9, NULL, NULL),
(16, 16, 10, NULL, NULL),
(17, 17, 11, NULL, NULL),
(18, 18, 12, NULL, NULL),
(19, 19, 13, NULL, NULL),
(20, 20, 14, NULL, NULL),
(21, 21, 4, NULL, NULL),
(22, 22, 4, NULL, NULL),
(23, 23, 52, NULL, NULL),
(26, 26, 19, NULL, NULL),
(27, 27, 21, NULL, NULL),
(28, 28, 22, NULL, NULL),
(29, 29, 23, NULL, NULL),
(30, 30, 24, NULL, NULL),
(31, 31, 25, NULL, NULL),
(33, 33, 27, NULL, NULL),
(34, 34, 51, NULL, NULL),
(35, 35, 50, NULL, NULL),
(36, 36, 49, NULL, NULL),
(38, 38, 28, NULL, NULL),
(39, 39, 29, NULL, NULL),
(40, 40, 30, NULL, NULL),
(41, 41, 47, NULL, NULL),
(42, 42, 46, NULL, NULL),
(43, 43, 45, NULL, NULL),
(44, 44, 44, NULL, NULL),
(45, 45, 31, NULL, NULL),
(46, 46, 32, NULL, NULL),
(47, 47, 33, NULL, NULL),
(48, 48, 34, NULL, NULL),
(49, 49, 43, NULL, NULL),
(50, 50, 35, NULL, NULL),
(51, 51, 36, NULL, NULL),
(52, 52, 42, NULL, NULL),
(53, 53, 41, NULL, NULL),
(54, 54, 40, NULL, NULL),
(55, 55, 39, NULL, NULL),
(56, 56, 38, NULL, NULL),
(57, 58, 55, NULL, NULL),
(58, 57, 37, NULL, NULL),
(61, 5, 1, NULL, NULL),
(62, 5, 55, NULL, NULL),
(64, 6, 55, NULL, NULL),
(65, 7, 55, NULL, NULL),
(66, 59, 1, NULL, NULL),
(67, 3, 25, NULL, NULL),
(68, 24, 17, NULL, NULL),
(69, 37, 48, NULL, NULL),
(71, 32, 26, NULL, NULL),
(72, 10, 15, NULL, NULL),
(73, 14, 8, NULL, NULL),
(74, 8, 55, NULL, NULL),
(75, 12, 6, NULL, NULL),
(76, 25, 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `freights`
--

CREATE TABLE `freights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_freights` bigint(20) UNSIGNED DEFAULT NULL,
  `id_estacion` bigint(20) UNSIGNED DEFAULT NULL,
  `id_tractor` bigint(20) UNSIGNED NOT NULL,
  `id_pipa_1` bigint(20) UNSIGNED NOT NULL,
  `id_pipa_2` bigint(20) UNSIGNED DEFAULT NULL,
  `id_chofer` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `freights`
--

INSERT INTO `freights` (`id`, `id_freights`, `id_estacion`, `id_tractor`, `id_pipa_1`, `id_pipa_2`, `id_chofer`, `created_at`, `updated_at`) VALUES
(7, 2, NULL, 2, 21, 22, 3, '2020-07-03 19:26:01', '2020-07-03 19:26:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pdf` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xml` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_modulo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desplegable` int(11) DEFAULT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `icono` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `name_modulo`, `desplegable`, `ruta`, `id_role`, `icono`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 0, 'home', 1, 'dashboard', '2020-05-27 04:26:02', '2020-05-27 04:26:02'),
(2, 'Perfil', 0, 'profile', 1, 'account_circle', '2020-05-27 04:26:02', '2020-05-27 04:26:02'),
(3, 'Estaciones', 0, 'estaciones', 1, 'local_gas_station', '2020-05-27 04:26:02', '2020-05-27 04:26:02'),
(4, 'Usuarios', 0, 'user', 1, 'perm_identity', '2020-05-27 04:26:03', '2020-05-27 04:26:03'),
(5, 'Terminales', 0, 'terminales', 1, 'home_work', '2020-05-27 04:26:03', '2020-05-27 04:26:03'),
(6, 'Pedidos', 0, 'pedidos', 1, 'add_shopping_cart', '2020-05-27 04:26:03', '2020-05-27 04:26:03'),
(7, 'Facturas', 0, 'facturas', 1, 'description', '2020-05-27 04:26:03', '2020-05-27 04:26:03'),
(8, 'Control pedidos', 0, 'control', 1, 'control_camera', '2020-05-27 04:26:03', '2020-05-27 04:26:03'),
(9, 'Fleteras', 0, 'fleteras', 1, 'account_tree', '2020-05-27 04:26:04', '2020-05-27 04:26:04'),
(10, 'Abonos', 0, 'abonos', 1, 'control_point', '2020-05-27 04:26:04', '2020-05-27 04:26:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_role`
--

CREATE TABLE `menu_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menu_role`
--

INSERT INTO `menu_role` (`id`, `menu_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 2, 1, NULL, NULL),
(6, 2, 2, NULL, NULL),
(7, 2, 3, NULL, NULL),
(8, 2, 4, NULL, NULL),
(9, 3, 1, NULL, NULL),
(10, 3, 2, NULL, NULL),
(11, 3, 3, NULL, NULL),
(12, 4, 1, NULL, NULL),
(13, 4, 3, NULL, NULL),
(14, 5, 1, NULL, NULL),
(15, 5, 3, NULL, NULL),
(16, 6, 1, NULL, NULL),
(17, 6, 2, NULL, NULL),
(18, 6, 3, NULL, NULL),
(19, 7, 1, NULL, NULL),
(20, 7, 2, NULL, NULL),
(21, 7, 3, NULL, NULL),
(22, 7, 4, NULL, NULL),
(23, 8, 1, NULL, NULL),
(24, 8, 3, NULL, NULL),
(25, 9, 1, NULL, NULL),
(26, 9, 3, NULL, NULL),
(27, 10, 1, NULL, NULL),
(28, 10, 2, NULL, NULL),
(29, 10, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(67, '2014_03_09_102119_create_terminals_table', 1),
(68, '2014_03_12_120126_create_estacions_table', 1),
(69, '2014_10_12_000000_create_users_table', 1),
(70, '2014_10_12_100000_create_password_resets_table', 1),
(71, '2020_03_10_010347_create_roles_table', 1),
(72, '2020_03_10_010830_create_role_user_table', 1),
(73, '2020_03_10_115712_create_menus_table', 1),
(74, '2020_03_19_133252_create_estacion_user_table', 1),
(75, '2020_04_06_021219_create_states_table', 1),
(76, '2020_04_06_143126_create_statu_orders_table', 1),
(77, '2020_04_07_184804_create_valeros_table', 1),
(78, '2020_05_02_004508_create_menu_role_table', 1),
(79, '2020_05_04_145634_create_invoices_table', 1),
(80, '2020_05_05_063217_create_drivers_table', 1),
(81, '2020_05_05_100105_create_name_freights_table', 1),
(82, '2020_05_05_151020_create_pipes_table', 1),
(83, '2020_05_05_152001_create_tractors_table', 1),
(84, '2020_05_05_162907_create_freights_table', 1),
(85, '2020_05_05_172114_create_controls_table', 1),
(86, '2020_05_06_114510_create_orders_table', 1),
(87, '2020_05_07_155717_create_prices_table', 1),
(88, '2020_05_13_105057_create_payments_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `name_freights`
--

CREATE TABLE `name_freights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `name_freights`
--

INSERT INTO `name_freights` (`id`, `name`, `rfc`, `cre`, `telefono`, `direccion`, `contacto`, `created_at`, `updated_at`) VALUES
(2, 'POLIMOTORS SA DE CV', 'POL161214JY5', 'PL/22194/TRA/OM/2019', '2224654521', 'Blvd. Atlixco km 8.5 Col. San Bernardino Tlaxcalancingo, San Andrés Cholula, Puebla CP. 72821', 'Manuel Olivas', '2020-07-02 19:15:24', '2020-07-02 19:15:24'),
(4, 'SERVICIO CHIPILO SA DE CV', 'SCI9210151V5', 'PL/6262/TRA/OM/2015', '2222390765', 'Km. 14 carretera federal puebla atlixco', 'Margarita Merlo Zago', '2020-07-02 19:20:50', '2020-07-02 19:20:50'),
(5, 'TRANSPORTACIÓN Y LOGÍSTICA ADEDRO, S.A. DE C.V.', '............', 'PL/23339/TRA/OM/2020', '2223421193', '....', 'Elizabeth Fuentes', '2020-07-02 19:34:24', '2020-07-02 19:34:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `control_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estacion_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `producto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad_lts` int(11) NOT NULL,
  `costo_aprox` double(12,3) DEFAULT NULL,
  `dia_entrega` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `po` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `xml` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `control_id`, `estacion_id`, `status_id`, `producto`, `so_number`, `cantidad_lts`, `costo_aprox`, `dia_entrega`, `po`, `pdf`, `xml`, `created_at`, `updated_at`) VALUES
(8, NULL, 19, 6, 'Extra', '122345657', 15500, 171275.000, '2020-05-27', NULL, NULL, NULL, '2020-05-27 16:48:58', '2020-05-27 16:50:08'),
(10, NULL, 55, 6, 'Extra', '0970869', 31000, 397110.000, '2020-05-28', 'mo098u0987', NULL, NULL, '2020-05-28 19:25:25', '2020-05-28 19:35:11'),
(13, NULL, 20, 2, 'Extra', 'U5653542', 31000, 452600.000, '2020-05-30', 'MO49585', NULL, NULL, '2020-05-28 19:29:54', '2020-05-28 19:32:23'),
(19, NULL, 19, 2, 'Extra', '12312', 15500, 171275.000, '2020-05-29', NULL, NULL, NULL, '2020-05-28 20:36:07', '2020-05-29 00:06:33'),
(22, NULL, 45, 2, 'Extra', '463456', 15500, 195300.000, '2020-05-29', NULL, NULL, NULL, '2020-05-28 20:43:33', '2020-05-29 00:01:40'),
(23, NULL, 19, 2, 'Diesel', '25065432167', 15500, 236685.000, '2020-05-28', 'MO8976', NULL, NULL, '2020-05-28 23:37:39', '2020-05-28 23:40:05'),
(39, NULL, 25, 1, 'Extra', NULL, 21000, 332850.000, '2020-06-02', 'MO48443', NULL, NULL, '2020-06-01 22:15:22', '2020-06-01 22:15:22'),
(40, NULL, 25, 1, 'Supreme', NULL, 21000, 369810.000, '2020-06-02', 'MO656', NULL, NULL, '2020-06-01 22:15:42', '2020-06-01 22:15:42'),
(42, NULL, 5, 1, 'Extra', NULL, 21000, 314790.000, '2020-06-02', 'MO45466', NULL, NULL, '2020-06-01 22:17:09', '2020-06-01 22:17:09'),
(43, NULL, 49, 1, 'Supreme', NULL, 21000, 333270.000, '2020-06-02', 'MO454658', NULL, NULL, '2020-06-01 22:17:52', '2020-06-01 22:17:52'),
(44, NULL, 17, 1, 'Supreme', NULL, 15500, 249395.000, '2020-06-02', 'MO785423', NULL, NULL, '2020-06-01 22:18:39', '2020-06-01 22:18:39'),
(46, NULL, 17, 1, 'Extra', NULL, 15500, 236220.000, '2020-06-02', 'MO48655', NULL, NULL, '2020-06-01 22:19:32', '2020-06-01 22:19:32'),
(47, NULL, 8, 1, 'Extra', NULL, 15500, 223820.000, '2020-06-02', 'MO48452', NULL, NULL, '2020-06-01 22:20:11', '2020-06-01 22:20:11'),
(48, NULL, 8, 1, 'Diesel', NULL, 15500, 257145.000, '2020-06-02', 'MO2896', NULL, NULL, '2020-06-01 22:20:35', '2020-06-01 22:20:35'),
(49, NULL, 15, 1, 'Diesel', NULL, 15500, 260245.000, '2020-06-02', 'MO45464', NULL, NULL, '2020-06-01 22:21:28', '2020-06-01 22:21:28'),
(50, NULL, 32, 2, 'Extra', '2602759196', 31000, 465000.000, '2020-06-05', 'MO12545', NULL, NULL, '2020-06-04 19:27:47', '2020-06-05 06:46:53'),
(51, NULL, 14, 2, 'Extra', '2602759197', 15500, 238545.000, '2020-06-05', 'MO145656', NULL, NULL, '2020-06-04 19:28:16', '2020-06-05 06:47:18'),
(54, NULL, 13, 2, 'Extra', '2602759198', 31000, 478640.000, '2020-06-05', 'MO2422254', NULL, NULL, '2020-06-04 19:29:37', '2020-06-05 06:47:50'),
(56, NULL, 8, 2, 'Diesel', '2602759199', 15500, 255595.000, '2020-06-05', 'MO4452', NULL, NULL, '2020-06-04 19:30:30', '2020-06-05 06:48:16'),
(57, NULL, 28, 2, 'Diesel', '2602759200', 15500, 260555.000, '2020-06-05', 'MO564654', NULL, NULL, '2020-06-04 19:31:01', '2020-06-05 06:48:57'),
(58, NULL, 44, 2, 'Extra', '2602759201', 15500, 236530.000, '2020-06-05', 'MO46546', NULL, NULL, '2020-06-04 19:31:37', '2020-06-05 06:49:23'),
(60, NULL, 44, 2, 'Supreme', '2602759202', 15500, 248155.000, '2020-06-05', 'MO46786', NULL, NULL, '2020-06-04 19:32:28', '2020-06-05 06:49:40'),
(61, NULL, 21, 2, 'Diesel', '2602759203', 15500, 247845.000, '2020-06-05', 'MO46548', NULL, NULL, '2020-06-04 19:32:57', '2020-06-05 06:50:03'),
(62, NULL, 21, 2, 'Supreme', '2602759204', 15500, 246605.000, '2020-06-05', 'MO78462', NULL, NULL, '2020-06-04 19:33:23', '2020-06-05 06:50:36'),
(63, NULL, 43, 2, 'Extra', '123456', 31000, 194990.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 20:44:23', '2020-06-25 05:00:13'),
(64, NULL, 52, 2, 'Extra', '123457', 15500, 254820.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 20:44:56', '2020-06-25 05:00:24'),
(65, NULL, 52, 2, 'Supreme', '123458', 15500, 266445.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 21:23:28', '2020-06-25 05:00:36'),
(66, NULL, 8, 2, 'Supreme', '123459', 15500, 265050.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 21:24:02', '2020-06-25 05:00:46'),
(67, NULL, 21, 2, 'Supreme', '12345', 15500, 260555.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 21:26:00', '2020-06-25 05:00:58'),
(68, NULL, 4, 2, 'Supreme', '21345', 15500, 264275.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 21:26:23', '2020-06-25 05:01:06'),
(69, NULL, 16, 2, 'Supreme', '13245', 15500, 263345.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 21:27:12', '2020-06-25 05:01:13'),
(70, NULL, 40, 2, 'Extra', '489465', 15500, 247070.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 21:27:32', '2020-06-25 05:01:23'),
(71, NULL, 40, 2, 'Supreme', '12565', 15500, 260090.000, '2020-06-24', '132', NULL, NULL, '2020-06-24 21:27:52', '2020-06-25 05:01:33'),
(72, NULL, 35, 2, 'Extra', '54646', 15500, 246295.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 21:31:04', '2020-06-25 05:01:43'),
(73, NULL, 35, 2, 'Supreme', '549846', 15500, 257920.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 21:31:25', '2020-06-25 05:01:53'),
(74, NULL, 42, 2, 'Extra', '28941', 31000, 506540.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 21:33:47', '2020-06-25 05:06:07'),
(75, NULL, 11, 2, 'Extra', '18618', 21000, 355740.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 21:34:07', '2020-06-25 05:06:25'),
(76, NULL, 11, 2, 'Supreme', '18645', 21000, 378840.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 21:34:30', '2020-06-25 05:06:37'),
(77, NULL, 49, 2, 'Extra', '18165', 21000, 345240.000, '2020-06-24', '123', NULL, NULL, '2020-06-24 21:38:17', '2020-06-25 05:06:50'),
(78, NULL, 49, 6, 'Supreme', '18168', 21000, 359940.000, '2020-06-24', '132', NULL, NULL, '2020-06-24 21:38:39', '2020-06-25 05:07:27'),
(80, NULL, 43, 6, 'Extra', NULL, 31000, 194990.000, '01/07/2020', '13245', NULL, NULL, '2020-06-30 23:08:44', '2020-06-30 23:08:44'),
(83, NULL, 55, 6, 'Extra', '4537654765', 15500, 198555.000, '2020-07-02', NULL, NULL, NULL, '2020-07-01 20:53:09', '2020-07-02 20:46:55'),
(84, NULL, 50, 6, 'Extra', '86584', 21000, 344190.000, '2020-07-02', NULL, NULL, NULL, '2020-07-01 21:01:53', '2020-07-02 20:47:03'),
(87, 23, 55, 5, 'Extra', '23042304', 21000, 269010.000, '2020-07-29', NULL, NULL, NULL, '2020-07-28 22:43:11', '2020-07-28 22:55:07'),
(88, 23, 55, 5, 'Extra', '40405', 15500, 198555.000, '2020-07-29', NULL, NULL, NULL, '2020-07-28 22:44:53', '2020-07-28 22:55:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_estacion` bigint(20) UNSIGNED NOT NULL,
  `cantidad` double(12,2) NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_status` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`id`, `id_estacion`, `cantidad`, `url`, `id_status`, `created_at`, `updated_at`) VALUES
(3, 55, 1000000.00, '55-2020-05-27.png', 2, '2020-05-27 16:43:15', '2020-05-27 16:44:03'),
(4, 19, 200000.00, '19-28052020-174037.jpg', 2, '2020-05-29 00:40:37', '2020-05-29 00:41:13'),
(5, 55, 500000.00, '55-28072020-211352.jpg', 1, '2020-07-29 04:13:52', '2020-07-29 04:13:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pipes`
--

CREATE TABLE `pipes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_status` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_economico` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacidad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `compartimentos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacidad_compartimiento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenedor_disponible` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pipes`
--

INSERT INTO `pipes` (`id`, `id_status`, `numero`, `numero_economico`, `capacidad`, `compartimentos`, `capacidad_compartimiento`, `contenedor_disponible`, `created_at`, `updated_at`) VALUES
(19, 1, '3M9T33BAOJCO72006', 'TQ1', '31000', '2', '15500', NULL, '2020-07-02 18:44:34', '2020-07-02 18:44:34'),
(20, 1, '3M9T33BA2JCO72007', 'TQ2', '31000', '2', '15500', NULL, '2020-07-02 18:45:30', '2020-07-02 18:45:30'),
(21, 1, '3M9T33BA4JCO72008', 'TQ3', '31000', '2', '15500', NULL, '2020-07-02 18:46:20', '2020-07-28 22:55:07'),
(22, 1, '3M9T33BA6JCO72009', 'TQ4', '31000', '2', '15500', NULL, '2020-07-02 18:46:43', '2020-07-28 22:55:07'),
(23, 1, '3M9T33BA2JCO72010', 'TQ5', '31000', '2', '15500', NULL, '2020-07-02 18:47:24', '2020-07-02 18:53:51'),
(24, 1, '3M9T33BA4JCO72011', 'TQ6', '31000', '2', '15500', NULL, '2020-07-02 18:48:01', '2020-07-02 18:48:01'),
(25, 1, '3M9T33BA6JCO72012', 'TQ7', '31000', '2', '15500', NULL, '2020-07-02 18:48:33', '2020-07-02 18:55:23'),
(26, 1, '3M9T33BA8JCO72013', 'TQ8', '31000', '2', '15500', NULL, '2020-07-02 18:49:04', '2020-07-02 18:55:52'),
(27, 1, '3M9T33BA3JCO72016', 'TQ9', '31000', '2', '15500', NULL, '2020-07-02 18:49:46', '2020-07-02 18:56:30'),
(28, 1, '3M9T33BA5JCO72017', 'TQ10', '31000', '2', '15500', NULL, '2020-07-02 18:50:26', '2020-07-02 18:57:16'),
(29, 1, '3MT933BA7JCO72018', 'TQ11', '31000', '2', '15500', NULL, '2020-07-02 18:51:28', '2020-07-02 18:51:28'),
(30, 1, '3MT933BA9JCO72019', 'TQ12', '31000', '2', '15500', NULL, '2020-07-02 18:58:42', '2020-07-02 18:58:42'),
(31, 1, '3MT933BA5JCO72020', 'TQ13', '31000', '2', '15500', NULL, '2020-07-02 18:59:22', '2020-07-02 18:59:22'),
(32, 1, '3MT933BA7JCO72021', 'TQ14', '31000', '2', '15500', NULL, '2020-07-02 19:00:28', '2020-07-02 19:00:28'),
(33, 1, '3D9T1JAJ8K9018026', 'TQS-1', '42000', '2', '21000', NULL, '2020-07-02 19:01:46', '2020-07-02 19:01:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_estacion` bigint(20) UNSIGNED NOT NULL,
  `extra` double(12,2) DEFAULT NULL,
  `supreme` double(12,2) DEFAULT NULL,
  `diesel` double(12,2) DEFAULT NULL,
  `extra_u` double(12,2) DEFAULT NULL,
  `supreme_u` double(12,2) DEFAULT NULL,
  `diesel_u` double(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prices`
--

INSERT INTO `prices` (`id`, `id_estacion`, `extra`, `supreme`, `diesel`, `extra_u`, `supreme_u`, `diesel_u`, `created_at`, `updated_at`) VALUES
(1, 55, 14.45, 16.78, 18.56, 12.81, 15.14, 16.92, '2020-05-27 07:21:11', '2020-05-27 07:21:11'),
(2, 19, 12.45, 13.45, 16.67, 11.05, 12.00, 15.27, '2020-05-27 12:03:46', '2020-05-27 12:03:46'),
(3, 20, 16.00, 16.00, 18.00, 14.60, 14.55, 16.60, '2020-05-28 19:29:18', '2020-05-28 19:29:18'),
(4, 20, 14.00, 16.00, 18.00, 12.60, 14.55, 16.60, '2020-05-28 20:37:21', '2020-05-28 20:37:21'),
(5, 21, 14.00, 15.00, 18.00, 12.60, 13.55, 16.60, '2020-05-28 20:37:35', '2020-05-28 20:37:35'),
(6, 40, 14.00, 16.00, 18.00, 12.60, 14.55, 16.60, '2020-05-28 20:37:50', '2020-05-28 20:37:50'),
(7, 45, 14.00, 15.00, 18.00, 12.60, 13.55, 16.60, '2020-05-28 20:38:06', '2020-05-28 20:38:06'),
(8, 45, 14.00, 15.00, 18.00, 12.60, 13.55, 16.60, '2020-05-28 20:42:53', '2020-05-28 20:42:53'),
(9, 25, 17.25, 19.06, 0.00, 15.85, 17.61, -1.40, '2020-06-01 21:39:12', '2020-06-01 21:39:12'),
(10, 25, 17.25, 19.06, 0.00, 15.85, 17.61, -1.40, '2020-06-01 21:39:59', '2020-06-01 21:39:59'),
(11, 25, 17.25, 19.06, 0.00, 15.85, 17.61, -1.40, '2020-06-01 21:41:07', '2020-06-01 21:41:07'),
(12, 25, 17.25, 19.06, 0.00, 15.85, 17.61, -1.40, '2020-06-01 22:10:43', '2020-06-01 22:10:43'),
(13, 5, 16.39, 17.29, 18.39, 14.99, 15.84, 16.99, '2020-06-01 22:11:16', '2020-06-01 22:11:16'),
(14, 49, 16.52, 17.32, 17.91, 15.10, 15.87, 16.51, '2020-06-01 22:11:53', '2020-06-01 22:11:53'),
(15, 17, 16.64, 17.54, 17.32, 15.24, 16.09, 15.92, '2020-06-01 22:12:32', '2020-06-01 22:12:32'),
(16, 8, 15.84, 17.22, 17.99, 14.44, 15.77, 16.59, '2020-06-01 22:13:15', '2020-06-01 22:13:15'),
(17, 26, 17.02, 17.84, 18.22, 15.62, 16.39, 16.82, '2020-06-01 22:13:59', '2020-06-01 22:13:59'),
(18, 15, 16.19, 16.99, 18.19, 14.79, 15.54, 16.79, '2020-06-01 22:14:33', '2020-06-01 22:14:33'),
(19, 32, 16.43, 17.25, 0.00, 15.00, 15.80, -1.40, '2020-06-04 19:15:18', '2020-06-04 19:15:18'),
(20, 14, 16.79, 17.62, 18.01, 15.39, 16.17, 16.61, '2020-06-04 19:16:07', '2020-06-04 19:16:07'),
(21, 13, 16.84, 17.81, 0.00, 15.44, 16.36, -1.40, '2020-06-04 19:16:58', '2020-06-04 19:16:58'),
(22, 8, 15.86, 17.22, 17.89, 14.46, 15.77, 16.49, '2020-06-04 19:17:34', '2020-06-04 19:17:34'),
(23, 28, 16.67, 17.47, 18.21, 15.27, 16.02, 16.81, '2020-06-04 19:19:16', '2020-06-04 19:19:16'),
(24, 44, 16.66, 17.46, 0.00, 15.26, 16.01, -1.40, '2020-06-04 19:20:29', '2020-06-04 19:20:29'),
(25, 21, 16.36, 17.36, 17.39, 14.96, 15.91, 15.99, '2020-06-04 19:21:32', '2020-06-04 19:21:32'),
(26, 43, 7.69, 18.49, 18.39, 6.29, 17.04, 16.99, '2020-06-24 20:19:08', '2020-06-24 20:19:08'),
(27, 52, 17.84, 18.64, 18.94, 16.44, 17.19, 17.54, '2020-06-24 20:19:36', '2020-06-24 20:19:36'),
(28, 8, 17.55, 18.55, 18.43, 16.10, 17.10, 17.03, '2020-06-24 20:20:21', '2020-06-24 20:20:21'),
(29, 21, 17.36, 18.26, 17.94, 15.96, 16.81, 16.54, '2020-06-24 20:21:19', '2020-06-24 20:21:19'),
(30, 4, 17.89, 18.59, 0.00, 16.49, 17.05, -1.40, '2020-06-24 20:22:20', '2020-06-24 20:22:20'),
(31, 16, 17.74, 18.44, 0.00, 16.34, 16.99, -1.40, '2020-06-24 20:23:22', '2020-06-24 20:23:22'),
(32, 40, 17.34, 18.23, 0.00, 15.94, 16.78, 0.00, '2020-06-24 20:23:59', '2020-06-24 20:23:59'),
(33, 35, 17.29, 18.09, 18.14, 15.89, 16.64, 16.74, '2020-06-24 20:25:06', '2020-06-24 20:25:06'),
(34, 42, 17.74, 18.64, 18.69, 16.34, 17.15, 17.29, '2020-06-24 20:27:47', '2020-06-24 20:27:47'),
(35, 11, 18.34, 19.49, 0.00, 16.94, 18.04, -1.40, '2020-06-24 20:29:23', '2020-06-24 20:29:23'),
(36, 20, 17099.00, 18.74, 0.00, 17097.60, 17.25, -1.40, '2020-06-24 20:30:17', '2020-06-24 20:30:17'),
(37, 49, 17.84, 18.59, 0.00, 16.44, 17.14, -1.40, '2020-06-24 20:31:56', '2020-06-24 20:31:56'),
(38, 20, 17.99, 18.74, 0.00, 16.59, 17.29, -1.40, '2020-06-24 21:37:04', '2020-06-24 21:37:04'),
(39, 50, 17.79, 17.89, 18.59, 16.39, 16.44, 17.19, '2020-07-01 20:46:25', '2020-07-01 20:46:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'Usuarion con nivel de administracion total.', '2020-05-27 04:26:01', '2020-05-27 04:26:01'),
(2, 'Admin-Estacion', 'Administrador total de la estacion seleccionada.', '2020-05-27 04:26:01', '2020-05-27 04:26:01'),
(3, 'Logistica', '', '2020-05-27 04:26:01', '2020-05-27 04:26:01'),
(4, 'Abonos & Pagos', '', '2020-05-27 04:26:01', '2020-05-27 04:26:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, NULL, NULL),
(4, 3, 2, NULL, NULL),
(5, 4, 1, NULL, NULL),
(6, 5, 3, NULL, NULL),
(7, 6, 4, NULL, NULL),
(8, 7, 4, NULL, NULL),
(9, 8, 1, NULL, NULL),
(10, 9, 1, NULL, NULL),
(11, 10, 2, NULL, NULL),
(12, 11, 2, NULL, NULL),
(13, 12, 2, NULL, NULL),
(14, 13, 2, NULL, NULL),
(15, 14, 2, NULL, NULL),
(16, 15, 1, NULL, NULL),
(17, 16, 2, NULL, NULL),
(18, 17, 2, NULL, NULL),
(19, 18, 1, NULL, NULL),
(20, 19, 2, NULL, NULL),
(21, 20, 2, NULL, NULL),
(22, 21, 2, NULL, NULL),
(23, 22, 2, NULL, NULL),
(24, 23, 1, NULL, NULL),
(25, 24, 2, NULL, NULL),
(26, 25, 2, NULL, NULL),
(27, 26, 2, NULL, NULL),
(28, 27, 2, NULL, NULL),
(29, 28, 1, NULL, NULL),
(30, 29, 2, NULL, NULL),
(31, 30, 2, NULL, NULL),
(32, 31, 2, NULL, NULL),
(33, 32, 2, NULL, NULL),
(34, 33, 1, NULL, NULL),
(35, 34, 2, NULL, NULL),
(36, 35, 2, NULL, NULL),
(37, 36, 2, NULL, NULL),
(38, 37, 2, NULL, NULL),
(39, 38, 2, NULL, NULL),
(40, 39, 2, NULL, NULL),
(41, 40, 2, NULL, NULL),
(42, 41, 2, NULL, NULL),
(43, 42, 2, NULL, NULL),
(44, 43, 2, NULL, NULL),
(45, 44, 1, NULL, NULL),
(46, 45, 2, NULL, NULL),
(47, 46, 2, NULL, NULL),
(48, 47, 2, NULL, NULL),
(49, 48, 2, NULL, NULL),
(50, 49, 2, NULL, NULL),
(51, 50, 2, NULL, NULL),
(52, 51, 2, NULL, NULL),
(53, 52, 2, NULL, NULL),
(54, 53, 2, NULL, NULL),
(55, 54, 2, NULL, NULL),
(56, 55, 2, NULL, NULL),
(57, 56, 2, NULL, NULL),
(58, 58, 2, NULL, NULL),
(59, 57, 2, NULL, NULL),
(60, 59, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id`, `estado`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Disponible', '-', '2020-05-27 04:26:00', '2020-05-27 04:26:00'),
(2, 'Ocupado', '-', '2020-05-27 04:26:00', '2020-05-27 04:26:00'),
(3, 'Mantenimiento', '', '2020-05-27 04:26:01', '2020-05-27 04:26:01'),
(4, 'Fuera de servicio', '-', '2020-05-27 04:26:01', '2020-05-27 04:26:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `statu_orders`
--

CREATE TABLE `statu_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `statu_orders`
--

INSERT INTO `statu_orders` (`id`, `name`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Pendiente', '-', '2020-05-27 04:26:01', '2020-05-27 04:26:01'),
(2, 'Autorizado', '-', '2020-05-27 04:26:01', '2020-05-27 04:26:01'),
(3, 'En camino', '-', '2020-05-27 04:26:01', '2020-05-27 04:26:01'),
(4, 'Entregado', '-', '2020-05-27 04:26:01', '2020-05-27 04:26:01'),
(5, 'Para Factura', '-', '2020-05-27 04:26:01', '2020-05-27 04:26:01'),
(6, 'Cancelado', '-', '2020-05-27 04:26:01', '2020-05-27 04:26:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terminals`
--

CREATE TABLE `terminals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `razon_social` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_terminal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `codigo_postal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_de_vialidad` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_de_vialidad` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_exterior` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_interior` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_colonia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_localidad` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_municipio_o_demarcacion_territorial` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_entidad_federativa` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entre_calle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `y_calle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `terminals`
--

INSERT INTO `terminals` (`id`, `razon_social`, `rfc`, `nombre_terminal`, `status`, `codigo_postal`, `tipo_de_vialidad`, `nombre_de_vialidad`, `n_exterior`, `n_interior`, `nombre_colonia`, `nombre_localidad`, `nombre_municipio_o_demarcacion_territorial`, `nombre_entidad_federativa`, `entre_calle`, `y_calle`, `created_at`, `updated_at`) VALUES
(1, 'Tula, Hidalgo', 'XEXX010101000', 'Laredo', 1, '72845', 'calle', 'la', '4', '1', 'lo que sea', 'me importa un', 'dddddd', 'dddddd', '4', '4', '2020-05-27 04:26:00', '2020-05-27 04:26:00'),
(2, 'Salinas Victoria, Nuevo León', 'XEXX010101000', 'Guadalajara', 1, '72845', 'calle', 'la', '4', '1', 'lo que sea', 'me importa un', 'dddddd', 'dddddd', '4', '4', '2020-05-27 04:26:00', '2020-05-27 04:26:00'),
(3, 'San Luis Potosí, San Luis Potosí', 'XEXX010101000', 'Puebla', 1, '72845', 'calle', 'la', '4', '1', 'lo que sea', 'me importa un', 'dddddd', 'dddddd', '4', '4', '2020-05-27 04:26:00', '2020-05-27 04:26:00'),
(4, 'San José Iturbide, Guanajuato', 'XEXX010101000', 'Monterrey', 1, '72845', 'calle', 'la', '4', '1', 'lo que sea', 'me importa un', 'dddddd', 'dddddd', '4', '4', '2020-05-27 04:26:00', '2020-05-27 04:26:00'),
(5, 'Tuxpan, Veracruz', 'XEXX010101000', 'Chihuahua', 1, '72845', 'calle', 'la', '4', '1', 'lo que sea', 'me importa un', 'dddddd', 'dddddd', '4', '4', '2020-05-27 04:26:00', '2020-05-27 04:26:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tractors`
--

CREATE TABLE `tractors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_status` bigint(20) UNSIGNED NOT NULL,
  `tractor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tractors`
--

INSERT INTO `tractors` (`id`, `id_status`, `tractor`, `placas`, `marca`, `modelo`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 1, 'PL01', '79AH4X', 'VW', '2016', 'MAN', '2019-12-18 14:21:47', '2020-06-30 23:32:29'),
(2, 1, 'PL02', '80AH4X', 'VW', '2016', 'MAN', '2019-12-21 18:15:02', '2020-07-28 22:55:07'),
(3, 1, 'PL03', '81AH4X', 'VW', '2017', 'MAN', '2019-12-21 18:16:02', '2020-06-25 05:18:02'),
(4, 1, 'PL04', '17AL7D', 'VW', '2017', 'MAN', '2019-12-21 18:16:38', '2020-06-05 16:36:01'),
(5, 1, 'PL05', '16AL7D', 'VW', '2017', 'MAN', '2019-12-21 18:17:37', '2020-06-30 23:30:44'),
(6, 1, 'PL06', '15AL7D', 'VW', '2017', 'MAN', '2019-12-21 18:18:15', '2020-06-05 16:36:43'),
(7, 1, 'PL07', '14AL7D', 'VW', '2017', 'MAN', '2019-12-21 18:20:24', '2020-06-05 16:36:59'),
(8, 1, 'PL08', '73AL1M', 'VW', '2014', 'MAN', '2019-12-21 18:20:59', '2020-07-02 20:06:30'),
(9, 1, 'AZC0573', '64AK1X', 'KENWORTH', '2000', '...', '2020-07-02 19:51:58', '2020-07-02 19:51:58'),
(10, 1, 'FZC3111', '37AL3M', 'KENWORTH', '2007', '...', '2020-07-02 19:53:24', '2020-07-02 19:53:24'),
(11, 1, 'FZC0114', '93UE9N', 'FREIGHTLINER', '2014', '...', '2020-07-02 19:53:57', '2020-07-02 19:53:57'),
(12, 1, 'FZS3515', '03AJ6Y', 'KENWORTH', '2019', '...', '2020-07-02 19:54:27', '2020-07-02 19:54:27'),
(13, 1, 'FZS3589', '82AL3M', 'KENWORTH', '2020', '...', '2020-07-02 19:57:15', '2020-07-02 19:57:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apm_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` int(11) NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `app_name`, `apm_name`, `username`, `password`, `sex`, `phone`, `direccion`, `email`, `active`, `remember_token`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(2, 'Invitado', 'qwerty', 'qwerty', 'Invitado', '$2y$10$8RzJmeaZmnHLSNrp01R6puwnNhMulx0N4YGkQR9OnU7VEX2r.Yeb6', 0, '', 'soledad #8', 'admin@material.com', 1, 'EgMKDTwVr6y1XqlP7OGkrRwCnRJHQe2633KfWlQ3hoz0kvNtEnEKlj3whmxU', '2020-05-19 19:40:23', '2020-05-19 19:40:23', '2020-05-19 19:40:23'),
(3, 'Eduardo', 'Coyotl', 'Vázquez', 'Lalo', '$2y$10$Z4df8vtH/dCGw1x/fXUfe.ueHg1q8Zq5C6Nm2wV4hS8M1b5LaMDZO', 0, '+522222176048', 'Soledad #8', 'l4l0_love@hotmail.com', 1, '', '2020-05-19 19:40:23', '2020-05-19 19:40:23', '2020-05-20 21:55:13'),
(4, 'Isabel', 'Aportela', 'Niño Justo', 'isabeln', '$2y$10$ly4qWUIawjw85gslAdOzXeNZPZJIkhZOiL4ogkxZFvv622OpvtWA2', 1, '2222621880', 'Privada del barreal #17', 'isabeln@policon.mx', 1, '2Xph4Z0oc8dtrXJb1SzdIOEuWHtF98gGSoWv49LEep8U8jAVH7Tsg352nS45', NULL, '2020-05-14 02:48:12', '2020-05-14 02:48:12'),
(5, 'Manuel', 'Olivas', 'Baca', 'Manuelo', '$2y$10$cNJhjMZsVlwG/DRXDvHX2.vTBOOwoHgrjkiqBaC.i9v0m28Tbj2Hy', 0, '2224654521', '---', 'polimotors@policon.mx', 1, NULL, NULL, '2020-05-14 02:49:57', '2020-05-29 18:26:00'),
(6, 'Berenice', 'Mendez', '---', 'Berenicem', '$2y$10$W862K19MjPkmvaX97kyfnumO73VnYwfwaezGkEQO2yKO4hzsUoeUu', 1, '2222222222', '---', 'berenice@rosasgoiz.net', 1, NULL, NULL, '2020-05-14 02:51:51', '2020-05-29 18:27:19'),
(7, 'Coral', 'Torres', '---', 'Coralt', '$2y$10$ONk/2m4/YxvZwQowdouVvO2RwmMSf6B2OkgfuT8kWoK.wDN0EZ.h2', 1, '22222222222', '---', 'pedidosmobil2@policon.mx', 0, NULL, NULL, '2020-05-14 02:54:07', '2020-05-29 18:27:41'),
(8, 'Enrique', 'Bravo', 'Montalban', 'Enriqueb', '$2y$10$jTiVEyW50dseUAprJ4G7fO6thcWQehonGH4BdpD3lzU7yczsejZc6', 0, '2222930326', '---', 'enriqueb@policon.mx', 1, 'hKx2i7nkrWrMghCCIaagllT3eh6gkExD1hkrjhjXyJVwRHN6n6WmRJd2BDlk', NULL, '2020-05-14 02:54:55', '2020-06-01 20:59:22'),
(9, 'Maria Teresa', 'Hernandez', 'Castro', 'Teresah', '$2y$10$BWJ7WVHK1MYBoUaiyRWv/.REDy0ol7wLMvMAwCHiBm7TwfJgfaBuq', 1, '2281488986', 'Av. Lazaro Cardenas no. 81 Rafael Lucio, Veracruz, CP. 91157', 'aldia2@gasstation.com.mx', 1, NULL, NULL, '2020-05-14 02:59:47', '2020-05-15 22:13:01'),
(10, 'Damian', 'Amaro', 'de Roman', 'Damiana', '$2y$10$nW5HqteAQrFvM7pa87p1JezAaXhYWcsc2kh5caeRGulRHMzgyv8EW', 0, '2226777747', 'Enrique C. Rebsamen no. 70, Maestro FEderal, Puebla, Pue. CP. 72080', 'sanpedro@mbpuebla.com', 1, NULL, NULL, '2020-05-14 21:00:41', '2020-06-01 20:50:14'),
(11, 'Saul', 'Cuahutle', 'Diz', 'Saulc', '$2y$10$ygFrIp9/xTgfqHoOucMcy.IfAeZ1hbqmweI7.8Moo7xANHWqi6EJO', 0, '2212518208', 'av. 8 de noviembre no. 2246', 'joaquincolombres@mbpuebla.com', 1, NULL, NULL, '2020-05-14 22:05:22', '2020-05-20 10:46:10'),
(12, 'Jesus', 'Garcia', 'Rodriguez', 'Jesusg', '$2y$10$5wolP3rVmwDdg/20Nspifu9X4tFh2ISjMSVlFH65cB83b7Wmc2OBO', 0, '2225889704', 'Autopista mexico-puebla km 102', 'cupulas11471@hotmail.com', 1, NULL, NULL, '2020-05-14 22:07:09', '2020-06-04 18:38:55'),
(13, 'Leticia', 'Santa Maria', 'Martinez', 'Leticias', '$2y$10$GfSJWHNCNhnKTkGWzM87.ONkhav0PNri6Kd.MVF23ZTeuhem5iuR6', 1, '2225120960', '53 sur no. 902', 'rzcapitalsacv@gmail.com', 1, NULL, NULL, '2020-05-14 22:09:10', '2020-05-20 10:41:46'),
(14, 'Jeanette', 'Garcia', 'Rodriguez', 'Jeanetteg', '$2y$10$/QngyklJfnQQmBh2Djy8y.2imyZ4I2hm6PiHJDom.O9cYVCrKUNv6', 1, '2225889719', 'Autopista mexico-puebla km 100+400', 'pueblaavanza@gasstation.com.mx', 1, NULL, NULL, '2020-05-15 20:11:23', '2020-06-01 20:51:31'),
(15, 'Sara', 'Osorno', 'Claudio', 'Sarao', '$2y$10$D8QLTYEsK77jrU0ERtRyl.Lh37jfdT0BJXB6UxALXEFONtSpB50qO', 1, '2225889728', 'Carret fed mexico-veracruz via jalapa km 19+900', 'gascompany@hotmail.com', 1, NULL, NULL, '2020-05-15 20:13:01', '2020-05-20 10:47:49'),
(16, 'Sara', 'Osorno', 'Claudio', 'Sarac', '$2y$10$ScCsBkYPv2cmUvQ33U0vLO9GoCK2ZZ8xZr/uB54ajiuhk/qLdCw6K', 1, '2225889728', 'Carret. Fed Mexico Veracruz km 17+600', '---@hotmail.com', 0, NULL, NULL, '2020-05-15 20:15:05', '2020-05-20 10:47:21'),
(17, 'Beatriz', 'Cinto', 'Soto', 'Beatrizc', '$2y$10$4u9GdXbOtvjzYAlcdh9V1e7eWQ7IyzF9x4xhrDwnopDEh8pbP.LLa', 1, '2226779830', 'Blvd. libramiento puebla i. de matamoros n. 1503', 'ecogasoline@hotmail.com', 1, NULL, NULL, '2020-05-15 20:16:26', '2020-05-20 05:34:57'),
(18, 'Maricruz', 'Martinez', 'Martinez', 'Maricruzm', '$2y$10$GeNHNifnwHxBrXngvpmW4.Pi75YNIojOVu3T/FPUYW8YUrF0BTAZy', 1, '2227180446', 'Blvd. Valsequillo no. 945 Fracc. Alpha 2, Puebla, Pue. CP 72424', 'valsequillo@mbpuebla.com', 1, NULL, NULL, '2020-05-15 20:17:58', '2020-05-20 10:54:22'),
(19, 'Araceli', 'García', 'Calderón', 'Aracelig', '$2y$10$6qbp4.SQOm3kYsA7JtCVQOwhWgHb7baEfTZeu/eGLWUDjfsR4LtzK', 1, '2221824314', '11 norte no. 7202, Veinte de noviembre, puebla, puebla. CP. 72230', 'zgascompany@gmail.com', 1, NULL, NULL, '2020-05-15 20:19:43', '2020-05-20 05:34:38'),
(20, 'Victor Fabian', 'Flores', 'Lozada', 'Victorf', '$2y$10$F8vcpiohR.zXp7d.r79hUub.FND9kpnF7s7jjVnuIckZ8jgQ9suQG', 0, '2224939542', 'blvd. norte heroes del 5 de mayo numero 713, santa maria, Puebla, Pue. CP 72080', 'fundidora11859@hotmail.com', 1, NULL, NULL, '2020-05-15 21:22:46', '2020-05-20 10:43:53'),
(21, 'Moises Abraham', 'Muñoz', 'Becerra', 'Moisesm', '$2y$10$fOwSBLKBpctiXiZQ9YTvK.QnCSTyrWMe.MhoIvyrr.AGFhJwGec1y', 0, '2225057994', '49 poniente y 5B sur no. 518, prados agua azul, Puebla, Pue. CP. 72430', 'pradosaguaazul@mbpuebla.com', 1, NULL, NULL, '2020-05-15 21:23:58', '2020-05-15 22:01:23'),
(22, 'Moises Abraham', 'Muñoz', 'Becerra', 'Moisesa', '$2y$10$lad7QnDwg4BC9y/YwkqAWe3gcjO4kpGUlxlxM.nMorKkkmhR1GB1q', 0, '2223454985', 'Circuito Juan Pablo II No. 1717, Rivera del atoyac, Puebla, Puebla. CP. 72430', 'circuito@mbpuebla.com', 1, NULL, NULL, '2020-05-15 21:34:51', '2020-05-15 21:34:51'),
(23, 'Maria del Rosario', 'Sanchez', 'Resendez', 'Rosarios', '$2y$10$M/E5qtL4dmxStelEBiDsTeMWCkPn2w0FoOc8viQRWGt2t9IDW7GX6', 1, '2224738722', 'Blvd. Atlixcayotl no. 2202, Col. Reserva Territorial Atlixcayotl CP 72820, san Andres Cholula, Puebla', 'gerencia.angelopolismobil@gmail.com', 1, NULL, NULL, '2020-05-15 21:37:06', '2020-05-20 10:55:28'),
(24, 'Enrique', 'Guzmán', '---', 'Enriqueg', '$2y$10$lLYYnQ3XXauWff/jSjgLEueXcpiku85To9xrgUMuLhXVjOxNUlfIy', 0, '2221497334', 'Carrt. Fed. Mexico - Veracruz km 42-800, Sin colonia, San Salvador el Seco, Puebla, CP. 75160', 'jose.guzman.palafox@gmail.com', 1, NULL, NULL, '2020-05-15 22:03:52', '2020-06-01 20:40:17'),
(25, 'Rosa Angelica', 'Tello', 'Hernández', 'Rosat', '$2y$10$TEE1Gie0Bv6TJtk8f2G8COaGa40cB2hGDm3YRGK6iMBp..nUudmUa', 1, '2225057994', 'Calle 2 sur no. 2302, El Carmen, Puebla, Puebla. CP. 72550', 'elcarmen@mbpuebla.com', 1, NULL, NULL, '2020-05-15 22:05:22', '2020-06-04 18:40:11'),
(26, 'Emilio', 'Solano', 'Bonilla', 'Emilios', '$2y$10$SsX2MjoRRsl1GSNdtT.XK.T.Wue8tMmMLXuyP6ecEtrOSkIjSESwO', 0, '2226538615', 'Av. 43 oriente n 219-A, San Baltazar Campeche, Puebla, Puebla. CP. 72530', 'aldia1@gasstation.com.mx', 1, NULL, NULL, '2020-05-15 22:08:26', '2020-05-20 10:24:15'),
(27, 'Socorro', 'Ibarra', 'Rodriguez', 'Socorroi', '$2y$10$w5.r16WxQHQycBck.jyLAehqzTcAfrq/1kQhqcO1/vkKpmlXeUe8W', 1, '2221252381', 'Final de la recta a cholula no. 314, San andres Cholula, Puebla CP. 72760', 'aldia3@gasstation.com.mx', 1, NULL, NULL, '2020-05-15 22:11:33', '2020-05-20 10:45:32'),
(28, 'Yousef Gerardo', 'Cuahuizo', 'Aca', 'Yousefc', '$2y$10$QtYZ1SWVvRz/1c0eLKVrG.ZAJiXFqZyuNxa3/M.OWzl/bd4oX.EEm', 0, '2221664371', 'Lateral Sur via Atlixcayotl No. 5423, San Bernardino, San Andres Cholula Puebla CP. 72080', 'yziaventura@gmail.com', 1, NULL, NULL, '2020-05-15 22:20:57', '2020-05-20 10:42:28'),
(29, 'Julio Cesar', 'Lozano', 'Muguia', 'Juliol', '$2y$10$aKZ3FQoD2NSXZpATQfH1puGNdbVCAiNqW28mGub18c43YJ.jdNUiu', 1, '2221895371', 'Blvd. Municipio Libre no. 1830, Universitaria, Puebla, Puebla CP. 72560', 'fepsa@gasstation.com.mx', 0, NULL, NULL, '2020-05-15 22:23:10', '2020-05-20 10:41:21'),
(30, 'Maria de las Nieves', 'Goreti', 'Lopez', 'Mariag', '$2y$10$ksnWLWHRGliUrzoHkPMcBeEvhYV3D1lcHvaXOE1ZI6pxnEBk1u1NO', 1, '2231068597', 'CArrt. Federal Amozoc-Teziutlan km. 9+650 Tepatlaxco de Hidalgo, Puebla CP. 75100', 'rodrigozgas@hotmail.com', 1, NULL, NULL, '2020-05-15 22:27:17', '2020-05-20 10:57:20'),
(31, 'Alicia', 'Barojas', 'Gomez', 'Aliciab', '$2y$10$xVIFbBinNvX9vgkihEOVA.yObHjjdAg0ISr50iAxIjz.lwx7mHYP6', 1, '2441319700', 'Av. Independencia numero 2114, Francisco I. Madero, Atlixco, Puebla CP. 74290', 'zohan12713@gmail.com', 1, NULL, NULL, '2020-05-15 22:28:47', '2020-05-20 10:18:42'),
(32, 'Maria del Carmen', 'Muñoz', 'Esquivel', 'Mariam', '$2y$10$QqLMR3l70JrJW84tm8J/S.n.VWQs3oODhrABv9jQAzxzTc2usoNQC', 1, '2226524252', 'Calle Miguel Negrete Oriente no. 201, Centro, Tepeaca, Puebla, CP. 75200', 'estservmultiplestepeaca@gmail.com', 1, NULL, NULL, '2020-05-15 22:30:51', '2020-06-01 20:49:29'),
(33, 'Guadalupe', 'Flores', 'Carreto', 'Guadalupef', '$2y$10$os4CS5mB.WFEvo8vbYXYVOVnXyc5X30MOfjZrAdDXmV551hpmFbbO', 1, '2228577005', '23 poniente no. 3518, Belisario Dominguez, Puebla, Puebla CP. 72180', 'polioil12993@gmail.com', 1, NULL, NULL, '2020-05-15 22:32:14', '2020-05-20 10:34:02'),
(34, 'Alejandro Cuper', 'Perez', 'Soria', 'Alejandrop', '$2y$10$qvgeNEVeFSLP2wI7VSME4u7.yhoR0dDqZNs9h58o2wZsNqlUdroBS', 1, '7971012105', 'Carr. apizaco-huauchinango t. chignahuapan zacatlan km 69 20, Carretera, Zacatlan, Puebla. CP. 73310', 'gas12354@hotmail.com', 1, NULL, NULL, '2020-05-15 23:43:28', '2020-05-20 05:33:40'),
(35, 'Ana Laura', 'Gonzaga', 'Antonio', 'Analaurag', '$2y$10$xSnGIS3SwcYd5ntFREPNhuULgrovUOCZ9jYP6XDPuLjb5gE0OMtuO', 1, '2214153945', 'CL. Ignacio Zaragoza N. 471, Malintzi, Puebla CP. 72210', 'gasa3182@outlook.es', 1, NULL, NULL, '2020-05-15 23:45:26', '2020-05-20 10:19:49'),
(36, 'Jesus', 'Molina', 'Rodriguez', 'Jesusm', '$2y$10$lRu1GWUmzpKCm710bJ44ueNWiMCfz6jWkn4dpSfNsb5AJlN1CEQf6', 0, '2227137687', 'Av.. Periferico ecologico 222 Esq. Priv. 22D sur, Barrio de San Juan, Puebla, CP. 72580', 'poblanita2@gasstation.com.mx', 1, NULL, NULL, '2020-05-15 23:46:47', '2020-05-20 10:36:47'),
(37, 'Adriana', 'Saenz', 'Serrano', 'Adrianas', '$2y$10$6X6wUTfru2Q6z9lcc95JBuXscYz21ao2c7j0XtzyS0WMrcb/4UMGi', 1, '2226628918', 'Av. 2 poniente no. 1902, Barrio de San MAtias, Puebla. CP. 72090', 'poblanita@gasstation.com.mx', 1, NULL, NULL, '2020-05-15 23:48:41', '2020-06-01 20:41:57'),
(38, 'Julio', 'Bucio', 'Peña', 'Juliob', '$2y$10$.gRawZOAB1v0hYPoajtd3OZMdpgO69AUYtuVlcgxJ2/Kj4y5cy47O', 0, '2226504730', '11 sur No. Exterior 9521, ex-hacienda Mayorazgo, CP. 72480', 'juliobuciop@gmail.com', 1, NULL, NULL, '2020-05-15 23:50:13', '2020-05-20 10:39:09'),
(39, 'Samuel', 'Sanchez', '---', 'Samuels', '$2y$10$fY7eP1EtS44dNJDAhUwWU.VLu1zgqj4S4DftWpgUFk7NmHNsSgdoi', 0, '2225989461', 'Lateral Sur del Periférico Ecológico No. 803, ex hacienda Chapulco, CP. 72494', 'sasal_89@live.com.mx', 1, NULL, NULL, '2020-05-15 23:51:52', '2020-05-20 10:48:35'),
(40, 'Bruno', 'Reyes', '---', 'Brunor', '$2y$10$fXtmL5xevEch9RBw0iStJeJ1T2EEWJOWOmCn6UviH/dkupm9qv/LO', 0, '7658395111', 'Av. Independencia esquina Aquiles Serdan no. 1, Gabino González, CP. 92733, Alamo Temapache, Veracruz, CP. 92733', 'bruno878@msn.com', 1, NULL, NULL, '2020-05-15 23:53:22', '2020-05-20 10:20:56'),
(41, 'Yanery', 'Guarneros', 'Espinoza', 'Yaneryg', '$2y$10$RhgfVAgezOhHbs68i/GDAOmPZVPBo.Ow/Eu.DW1dGpWLcCfLx250e', 1, '2311383887', 'Calle la Mesilla no. 4, Barrio de Francia, Teziutlan, Puebla, CP. 73800', 'sujemy@hotmail.com', 1, NULL, NULL, '2020-05-15 23:54:45', '2020-05-20 10:43:25'),
(42, 'Ana', 'Flores', 'Castañeda', 'Anaf', '$2y$10$EOQ9va/IpmCkp1Vc4Z1m4e3ICmj0DnPiN0Cv9HQSMEZsSbWx0ZH8e', 1, '5519077540', 'Carrt. Lib. Huamantla km. 0+650 al 0880, Huamantla, Tlaxcala CP. 90500', 'sujuxi@sujuxi.com.mx', 1, NULL, NULL, '2020-05-15 23:57:43', '2020-05-20 10:19:15'),
(43, 'Julio', 'Bucio', 'Peña', 'Juliobp', '$2y$10$cX.VgUfr.nbgDCzmBkRnwePIJ.9xD5nTJl6nnX2LO9qUiPvzJO7iG', 0, '2226504730', 'Prolongación de la 11 sur No. 12928 Guadalupe Hidalgo, Puebla, CP. 72480', 'juliobuciopp@gmail.com', 1, NULL, NULL, '2020-05-15 23:59:07', '2020-05-20 10:40:43'),
(44, 'Rosario', 'Sanchez', 'Silverio', 'Rosarioss', '$2y$10$yS6AD9G2pRIcvvLPQrEZWOqu16s4UpJPqvpcIxi.s0lxW2ds.RQLC', 1, '2222393763', 'Prolongación 31 poniente no. 3724, Nueva Antequera, Puebla, CP. 72180', 'lasanimas@gasstation.com.mx', 1, NULL, NULL, '2020-05-16 00:00:32', '2020-05-20 10:50:10'),
(45, 'Ernesto Daniel', 'Flores', 'Lozada', 'Ernestof', '$2y$10$zMKfscBsWtQmKxTZx1HJAuPpRX88vHL3/Y/Ob2jSDMrz06pE3PtqW', 1, '9331669937', 'Prolongación 10 norte, no. 1434, San Francisco Teotimehuacán, Puebla CP. 72595', 'gascomobil@hotmail.com', 0, NULL, NULL, '2020-05-16 00:02:07', '2020-05-20 10:28:25'),
(46, 'Alejandro', 'Cruz', 'Castelán', 'Alejandroc', '$2y$10$n/5EnUZ44ekS/CgRDL1VOu8B.REH11UqpN7exz/poHFJM0Gw6qr.m', 0, '2212133052', 'Blvd. Municipio Libre no. 3021, Col. Camino real Puebla, Puebla. CP. 72595', 'honestidad@gasstation.com.mx', 1, NULL, NULL, '2020-05-16 00:03:30', '2020-05-20 05:32:14'),
(47, 'Felicitas', 'Robles', 'Diego', 'Felicitasr', '$2y$10$7/gLbvswMZjcmfKk/zSsKOSndyiJnLf4lQDx2Vor.02k4RKWDtVSi', 1, '2331219800', 'Esquina de la prolongación Miguel Alvarado No. 134 centro, Cuetzalan del Progreso, Puebla. CP. 73560', 'sanfrancisco12420@gmail.com', 1, NULL, NULL, '2020-05-16 00:05:49', '2020-05-20 10:29:12'),
(48, 'David Eduardo', 'Arroyo', 'Ortiz', 'Davida', '$2y$10$RO1RQjjCUY9DOlxzdo2lyOrNsrBlu9EEg0vepnTLfMh/JQh4O2Cmq', 0, '2223490950', 'Prolongación av. 11 sur no. 2, El Capulo, Santa Clara Ocoyucan, Puebla. CP. 72850', 'servicioelcapulo@gmail.com', 1, NULL, NULL, '2020-05-16 00:07:20', '2020-05-20 10:26:03'),
(49, 'Jonathan', 'Cruz', 'Rosendo', 'Jonathanc', '$2y$10$RX50IbQZOsmwShmVltgLLOg/ETFvts9IzM9gA52bYvQJqVMYsfFD6', 0, '2227087481', 'Anillo Periférico Ecológico No. 2002 km. 12, Santa Catarina Martir, San Andrés Cholula, Puebla. CP. 72800', 'gasoil2@hotmail.com', 1, NULL, NULL, '2020-05-16 00:08:50', '2020-05-20 10:38:29'),
(50, 'Carlos', 'Aguilar', 'Rangel', 'Carlosa', '$2y$10$a79SxWSIxngKOEQYxOEuyOCH5A5iymO5XwW/HWopr0alq5cowAr5S', 0, '2221636817', 'Blvd. Forjadores de Puebla km. 107.4, Santiago Momoxpan, San Pedro Cholula, Puebla. CP. 72760', 'momoxpan@prodigy.net.mx', 1, NULL, NULL, '2020-05-16 00:10:12', '2020-05-20 10:21:38'),
(51, 'Ruben', 'Mancilla', 'Jimenez', 'Rubenm', '$2y$10$qXYtdX7eQoJrNY0Yz6CuAe8fc/OkhuPPn7sZh3mI9xwW1p4bPD3iO', 0, '2222391964', 'Av. 5 de mayo no. 1622, Barrio de San Juan, San Andrés Cholula, CP. 72820', 'rmjche6201@hotmail.com', 1, NULL, NULL, '2020-05-16 00:11:55', '2020-05-20 10:49:29'),
(52, 'Griselda', 'Diaz', 'Ortega', 'Griseldad', '$2y$10$r5PuxeGq4V2.legqXFrUr.n7UiX8PnCJ5iMud63DqfGqnxJhYAGLe', 1, '2225889709', 'Avila Camacho no. 1563, Centro Libres, Puebla. CP. 72780', 'gasoillibres508509@hotmail.com', 1, NULL, NULL, '2020-05-16 00:13:23', '2020-05-20 10:30:16'),
(53, 'Griselda', 'Diaz', 'Ortega', 'Griseldado', '$2y$10$N7PRX0gwWQEH1vRY9w1j5.CI.1LHdOafaTkaZPgE601J/ikzZ3NWC', 1, '2225889707', 'Avila Camacho no. 999, Centro ¡, Libres, Puebla, CP. 73780', 'gasoillibres5085090@hotmail.com', 1, NULL, NULL, '2020-05-16 00:14:42', '2020-05-20 10:31:37'),
(54, 'Celia Guadalupe', 'Torres', 'Aramburo', 'Celiat', '$2y$10$1VoE.6GVCCG0P1c/bFE4X.wgM1GsFFydQrHjd1.P4eOo3TmbaDsYC', 1, '2225889734', 'Chichimeca Poniente no. 2, Desarrolo comercial Ciudad Quetzal, Cuautlancingo, Puebla. CP. 72700', 'ANGELOPOLIS03@hotmail.com', 1, NULL, NULL, '2020-05-16 00:16:18', '2020-05-20 10:22:14'),
(55, 'Javier', 'Diaz', 'Gomez', 'Javierd', '$2y$10$T0VNGoRut6D5/VA4pcaVaOPCwRVVYe8whu9Gp8n8CLKonerNXlhbW', 0, '2224469486', 'Av. Reforma no. 2922, Amor, Puebla, CP. 72140', 'vanoe@gasstation.com.mx', 1, NULL, NULL, '2020-05-16 00:17:42', '2020-05-20 10:36:03'),
(56, 'Gustavo', 'Esquviel', '---', 'Gustavoe', '$2y$10$aw3O0Hk7Uv5yjWYzhOu/POuPYhesoruOEQRLk./KZAMQwXKq/HGBG', 0, '7761007808', 'Km. 108 Carrt. Federal 119 Apizaco El Tejocotal, S/C, Ahuazotepec, Puebla. CP. 73180', 'RIVERASOSA_FACTURAS@outlook.com', 1, NULL, NULL, '2020-05-16 00:19:13', '2020-05-20 10:35:24'),
(57, 'Cynthia', 'Herrera', 'Castellano', 'Cynthiah', '$2y$10$HPvmZDHSCGhD/Dhw.VPqN.EQBdx1cZSLS3lnpRRNNLH1HEzOonysq', 1, '2311120801', 'Carretera A perote no. 264, Barrio de Xoloco, Teziutlan, Puebla. CP. 73780', 'mildredhc9@hotmail.com', 1, NULL, NULL, '2020-05-16 00:20:38', '2020-05-16 00:20:38'),
(58, 'Ricardo', 'Resendiz', 'Polvo', 'Richar', '$2y$10$/VYjcuRLHTaVNTfr371ViueK8F4zIau0on4.ZNNXqvOSAgo5Izf3e', 0, '2222222222', '2 poniente 313', 'ricardo.resendiz@digitalsoft.mx', 1, NULL, NULL, '2020-05-19 22:38:06', '2020-05-19 22:38:06'),
(59, 'Samuel', 'Espinoza', '---', 'Samuele', '$2y$10$UKe/.gT7bIW88NRJ6mv5yOpJfM0mTDBSruvJctBwTOWUdQ1Bx.okO', 0, '2225260751', '---', 'samuele@policon.mx', 1, NULL, NULL, '2020-05-29 18:29:20', '2020-05-29 18:29:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valeros`
--

CREATE TABLE `valeros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `terminal_id` bigint(20) UNSIGNED NOT NULL,
  `precio_regular` double(12,3) DEFAULT NULL,
  `precio_premium` double(12,3) DEFAULT NULL,
  `precio_disel` double(12,3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `valeros`
--

INSERT INTO `valeros` (`id`, `terminal_id`, `precio_regular`, `precio_premium`, `precio_disel`, `created_at`, `updated_at`) VALUES
(1, 1, 0.000, 0.000, 0.000, '2020-04-01 19:20:35', '2020-04-01 19:20:35'),
(2, 1, 0.000, 0.000, 0.000, '2020-04-02 19:21:30', '2020-04-02 19:21:30'),
(3, 1, 0.000, 0.000, 0.000, '2020-04-03 19:22:13', '2020-04-03 19:22:13'),
(4, 1, 0.000, 0.000, 0.000, '2020-04-06 18:22:41', '2020-04-06 18:22:41'),
(5, 1, 0.000, 0.000, 0.000, '2020-04-07 18:24:38', '2020-04-07 18:24:38'),
(6, 2, 0.000, 0.000, 0.000, '2020-04-01 19:20:35', '2020-04-01 19:20:35'),
(7, 2, 0.000, 0.000, 0.000, '2020-04-02 19:21:30', '2020-04-02 19:21:30'),
(8, 2, 0.000, 0.000, 0.000, '2020-04-03 19:22:13', '2020-04-03 19:22:13'),
(9, 2, 0.000, 0.000, 0.000, '2020-04-06 18:22:41', '2020-04-06 18:22:41'),
(10, 2, 0.000, 0.000, 0.000, '2020-04-07 18:24:38', '2020-04-07 18:24:38'),
(11, 3, 11.640, 11.910, 16.760, '2020-03-01 19:24:38', '2020-03-01 19:24:38'),
(12, 3, 11.640, 11.910, 16.760, '2020-03-02 19:24:38', '2020-03-02 19:24:38'),
(13, 3, 11.640, 11.910, 16.760, '2020-03-03 19:24:38', '2020-03-03 19:24:38'),
(14, 3, 11.640, 11.910, 16.760, '2020-03-03 19:24:38', '2020-03-03 19:24:38'),
(15, 3, 11.640, 11.910, 16.760, '2020-03-04 19:24:38', '2020-03-04 19:24:38'),
(16, 3, 11.640, 11.910, 16.760, '2020-03-05 19:24:38', '2020-03-05 19:24:38'),
(17, 3, 11.640, 11.910, 16.760, '2020-03-06 19:24:38', '2020-03-06 19:24:38'),
(18, 3, 11.640, 11.910, 16.760, '2020-03-07 19:24:38', '2020-03-07 19:24:38'),
(19, 3, 11.640, 11.910, 16.760, '2020-03-08 19:24:38', '2020-03-08 19:24:38'),
(20, 3, 11.640, 11.910, 16.760, '2020-03-09 19:24:38', '2020-03-09 19:24:38'),
(21, 3, 11.640, 11.910, 16.760, '2020-03-10 19:24:38', '2020-03-10 19:24:38'),
(22, 3, 11.640, 11.910, 16.760, '2020-03-11 19:24:38', '2020-03-11 19:24:38'),
(23, 3, 11.640, 11.910, 16.760, '2020-03-12 19:24:38', '2020-03-12 19:24:38'),
(24, 3, 11.640, 11.910, 16.760, '2020-03-13 19:24:38', '2020-03-13 19:24:38'),
(25, 3, 11.640, 11.910, 16.760, '2020-03-14 19:24:38', '2020-03-14 19:24:38'),
(26, 3, 11.640, 11.910, 16.760, '2020-03-15 19:24:38', '2020-03-15 19:24:38'),
(27, 3, 11.640, 11.910, 16.760, '2020-03-16 19:24:38', '2020-03-16 19:24:38'),
(28, 3, 11.640, 11.910, 16.760, '2020-03-17 19:24:38', '2020-03-17 19:24:38'),
(29, 3, 11.640, 11.910, 16.760, '2020-03-18 19:24:38', '2020-03-18 19:24:38'),
(30, 3, 11.640, 11.910, 16.760, '2020-03-19 19:24:38', '2020-03-19 19:24:38'),
(31, 3, 11.640, 11.910, 16.760, '2020-03-20 19:24:38', '2020-03-20 19:24:38'),
(32, 3, 11.640, 11.910, 16.760, '2020-03-21 19:24:38', '2020-03-21 19:24:38'),
(33, 3, 11.640, 11.910, 16.760, '2020-03-22 19:24:38', '2020-03-22 19:24:38'),
(34, 3, 11.640, 11.910, 16.760, '2020-03-23 19:24:38', '2020-03-23 19:24:38'),
(35, 3, 11.640, 11.910, 16.760, '2020-03-24 19:24:38', '2020-03-24 19:24:38'),
(36, 3, 11.640, 11.910, 16.760, '2020-03-25 19:24:38', '2020-03-25 19:24:38'),
(37, 3, 11.640, 11.910, 16.760, '2020-03-26 19:24:38', '2020-03-26 19:24:38'),
(38, 3, 12.140, 12.620, 17.100, '2020-03-27 19:24:38', '2020-03-27 19:24:38'),
(39, 3, 12.140, 12.620, 17.100, '2020-03-28 19:24:38', '2020-03-28 19:24:38'),
(40, 3, 12.140, 12.620, 17.100, '2020-03-29 19:24:38', '2020-03-29 19:24:38'),
(41, 3, 11.860, 12.420, 16.390, '2020-03-30 19:24:38', '2020-03-30 19:24:38'),
(42, 3, 12.270, 12.800, 16.540, '2020-03-31 19:24:38', '2020-03-31 19:24:38'),
(43, 4, 0.000, 0.000, 0.000, '2020-04-01 19:20:35', '2020-04-01 19:20:35'),
(44, 4, 0.000, 0.000, 0.000, '2020-04-02 19:21:30', '2020-04-02 19:21:30'),
(45, 4, 0.000, 0.000, 0.000, '2020-04-03 19:22:13', '2020-04-03 19:22:13'),
(46, 4, 0.000, 0.000, 0.000, '2020-04-06 18:22:41', '2020-04-06 18:22:41'),
(47, 4, 0.000, 0.000, 0.000, '2020-04-07 18:24:38', '2020-04-07 18:24:38'),
(48, 5, 0.000, 0.000, 0.000, '2020-04-01 19:20:35', '2020-04-01 19:20:35'),
(49, 5, 0.000, 0.000, 0.000, '2020-04-02 19:21:30', '2020-04-02 19:21:30'),
(50, 5, 0.000, 0.000, 0.000, '2020-04-03 19:22:13', '2020-04-03 19:22:13'),
(51, 5, 0.000, 0.000, 0.000, '2020-04-06 18:22:41', '2020-04-06 18:22:41'),
(52, 5, 0.000, 0.000, 0.000, '2020-04-07 18:24:38', '2020-04-07 18:24:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `controls`
--
ALTER TABLE `controls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `controls_id_freights_foreign` (`id_freights`),
  ADD KEY `controls_terminal_id_foreign` (`terminal_id`);

--
-- Indices de la tabla `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `drivers_id_status_foreign` (`id_status`);

--
-- Indices de la tabla `estacions`
--
ALTER TABLE `estacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estacion_user`
--
ALTER TABLE `estacion_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estacion_user_user_id_foreign` (`user_id`),
  ADD KEY `estacion_user_estacion_id_foreign` (`estacion_id`);

--
-- Indices de la tabla `freights`
--
ALTER TABLE `freights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `freights_id_freights_foreign` (`id_freights`),
  ADD KEY `freights_id_estacion_foreign` (`id_estacion`),
  ADD KEY `freights_id_pipa_1_foreign` (`id_pipa_1`),
  ADD KEY `freights_id_pipa_2_foreign` (`id_pipa_2`),
  ADD KEY `freights_id_tractor_foreign` (`id_tractor`),
  ADD KEY `freights_id_chofer_foreign` (`id_chofer`);

--
-- Indices de la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_role_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_role_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `name_freights`
--
ALTER TABLE `name_freights`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_control_id_foreign` (`control_id`),
  ADD KEY `orders_estacion_id_foreign` (`estacion_id`),
  ADD KEY `orders_status_id_foreign` (`status_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_id_estacion_foreign` (`id_estacion`),
  ADD KEY `payments_id_status_foreign` (`id_status`);

--
-- Indices de la tabla `pipes`
--
ALTER TABLE `pipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pipes_id_status_foreign` (`id_status`);

--
-- Indices de la tabla `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prices_id_estacion_foreign` (`id_estacion`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `statu_orders`
--
ALTER TABLE `statu_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `terminals`
--
ALTER TABLE `terminals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tractors`
--
ALTER TABLE `tractors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tractors_id_status_foreign` (`id_status`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `valeros`
--
ALTER TABLE `valeros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valeros_terminal_id_foreign` (`terminal_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `controls`
--
ALTER TABLE `controls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `estacions`
--
ALTER TABLE `estacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `estacion_user`
--
ALTER TABLE `estacion_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `freights`
--
ALTER TABLE `freights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `name_freights`
--
ALTER TABLE `name_freights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pipes`
--
ALTER TABLE `pipes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `statu_orders`
--
ALTER TABLE `statu_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `terminals`
--
ALTER TABLE `terminals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tractors`
--
ALTER TABLE `tractors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `valeros`
--
ALTER TABLE `valeros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `controls`
--
ALTER TABLE `controls`
  ADD CONSTRAINT `controls_id_freights_foreign` FOREIGN KEY (`id_freights`) REFERENCES `freights` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `controls_terminal_id_foreign` FOREIGN KEY (`terminal_id`) REFERENCES `terminals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estacion_user`
--
ALTER TABLE `estacion_user`
  ADD CONSTRAINT `estacion_user_estacion_id_foreign` FOREIGN KEY (`estacion_id`) REFERENCES `estacions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estacion_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `freights`
--
ALTER TABLE `freights`
  ADD CONSTRAINT `freights_id_chofer_foreign` FOREIGN KEY (`id_chofer`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `freights_id_estacion_foreign` FOREIGN KEY (`id_estacion`) REFERENCES `estacions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `freights_id_freights_foreign` FOREIGN KEY (`id_freights`) REFERENCES `name_freights` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `freights_id_pipa_1_foreign` FOREIGN KEY (`id_pipa_1`) REFERENCES `pipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `freights_id_pipa_2_foreign` FOREIGN KEY (`id_pipa_2`) REFERENCES `pipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `freights_id_tractor_foreign` FOREIGN KEY (`id_tractor`) REFERENCES `tractors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `menu_role`
--
ALTER TABLE `menu_role`
  ADD CONSTRAINT `menu_role_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_control_id_foreign` FOREIGN KEY (`control_id`) REFERENCES `controls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_estacion_id_foreign` FOREIGN KEY (`estacion_id`) REFERENCES `estacions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statu_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_id_estacion_foreign` FOREIGN KEY (`id_estacion`) REFERENCES `estacions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `statu_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pipes`
--
ALTER TABLE `pipes`
  ADD CONSTRAINT `pipes_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_id_estacion_foreign` FOREIGN KEY (`id_estacion`) REFERENCES `estacions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tractors`
--
ALTER TABLE `tractors`
  ADD CONSTRAINT `tractors_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `valeros`
--
ALTER TABLE `valeros`
  ADD CONSTRAINT `valeros_terminal_id_foreign` FOREIGN KEY (`terminal_id`) REFERENCES `terminals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
