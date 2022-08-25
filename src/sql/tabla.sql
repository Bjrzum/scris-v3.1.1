
--

CREATE TABLE `tabla` (
  `id` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `dependencia` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `asignatura` varchar(100) NOT NULL,
  `hora_ingreso` varchar(100) NOT NULL,
  `hora_salida` varchar(100) NOT NULL,
  `placa` varchar(100) NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tabla`
--
ALTER TABLE `tabla`
  ADD PRIMARY KEY (`id`);


--
ALTER TABLE `tabla`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

