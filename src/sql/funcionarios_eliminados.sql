
CREATE TABLE `funcionarios_eliminados` (
  `id` int(11) NOT NULL,
  `fecha_eliminacion` datetime NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `dependencia` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `asignatura` varchar(50) NOT NULL,
  `placa` varchar(50) NOT NULL
);

INSERT INTO `funcionarios_eliminados` (`id`, `fecha_eliminacion`, `nombre`, `dependencia`, `direccion`, `asignatura`, `placa`) VALUES
(1, '2022-05-16', 'JUAN DAVID ZAPATA', 'DOCENTE', 'DG 802', 'ALEMÁN 602°, 7°, 8° Y 901°', ''),
(2, '2022-06-07', 'ALEJANDRA HERNÁNDEZ', 'FUNCIONARIO CAFETERÍA', 'FUNCIONARIO', '', '');

--
ALTER TABLE `funcionarios_eliminados`
  ADD PRIMARY KEY (`id`);
UTO_INCREMENT de la tabla `funcionarios_eliminados`
--
ALTER TABLE `funcionarios_eliminados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
