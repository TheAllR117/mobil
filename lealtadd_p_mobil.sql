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
