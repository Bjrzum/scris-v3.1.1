

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `dependencia` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `asignatura` varchar(50) NOT NULL,
  `placa` varchar(50) NOT NULL,
  `observaciones` varchar(100) NOT NULL
);

INSERT INTO `funcionarios` (`id`, `nombre`, `dependencia`, `direccion`, `asignatura`, `placa`, `observaciones`) VALUES
(1, 'JUAN RICARDO TORRES', 'DIRECTIVO', 'RECTOR', '', 'FYT 17C/ MOTO', ''),
(2, 'JEIMY SOLORZA', 'DIRECTIVO', 'COORDINACIÓN ACADÉMICA', '', '', ''),
(3, 'DAVID CUELLO', 'DIRECTIVO', 'COORDINACIÓN CONVIVENCIA', '', 'YJE 30F/ MOTO', ''),
(4, 'YENNY GÓMEZ', 'DIRECTIVO', 'PSICOLOGÍA', '', 'ZCP 63E/ MOTO', ''),
(5, 'ELIZABETH SÁNCHEZ ', 'ADMINISTRATIVO', 'SECRETARIA ACADÉMICA', '', '', ''),
(6, 'MARITZA ZACIPA', 'DOCENTE', 'TRANSICIÓN 1', 'PRIMER CICLO', '', ''),
(7, 'XIOMARA CASTRO', 'DOCENTE', 'TRANSICIÓN 2', 'PRIMER CICLO', '', ''),
(8, 'CLAUDIA MARCELA HERNÁNDEZ', 'DOCENTE', 'DG 101', 'PRIMER CICLO', '', ''),
(9, 'SAMANTHA CASAS', 'DOCENTE', 'DG 102', 'PRIMER CICLO', '', ''),
(10, 'DIANA MALAVER', 'DOCENTE', 'DG 103', 'PRIMER CICLO', '', ''),
(11, 'YULIANA MORALES', 'DOCENTE', 'DG 201', 'PRIMER CICLO', '', ''),
(12, 'MARCELA PINTO', 'DOCENTE', 'DG 202', 'PRIMER CICLO', '', ''),
(13, 'MARTHA LILIANA GÓMEZ', 'DOCENTE', 'DG 203', 'PRIMER CICLO', '', ''),
(14, 'GLORIA GARCÍA', 'DOCENTE', 'DG 301', 'MATEMÁTICAS 3°/ CIENCIAS 301', '', ''),
(15, 'CRISTINA PINZÓN', 'DOCENTE', 'DG 302', 'SOCIALES 3°/ CIENCIAS 302°', '', 'INGRESA CON SU HIJO'),
(16, 'CATALINA MENDOZA', 'DOCENTE', 'DG 303', 'LENGUA CASTELLANA 3°/ CIENCIAS 303°', '', ''),
(17, 'NANCY MORALES', 'DOCENTE', 'DG 401', 'LENGUA CASTELLANA 4° Y 5°', '', 'INGRESA CON SUS HIJAS LUCIANA Y PAULA PINZÓN'),
(18, 'LUIS FELIPE TALERO', 'DOCENTE', 'DG 402', 'MATEMÁTICAS 4° Y 5°', 'BICICLETA', ''),
(19, 'ANGIE LIZETH ACERO', 'DOCENTE', 'DG 403', 'INGLÉS TRANSICIÓN, 3° Y 403°', '', ''),
(20, 'ANA LUCÍA RODRÍGUEZ', 'DOCENTE', 'DG 501', 'SOCIALES 4° Y 5°', '', ''),
(21, 'ANDREA PAOLA RICARDO', 'DOCENTE', 'DG 502', 'CIENCIAS 4° Y 5°', 'ZEH 58F/ MOTO', ''),
(22, 'JHON CARLOS FIGUEREDO', 'DOCENTE', 'DG 503', 'INGLÉS 4°, 5° Y 601°', 'QVJ 49B/ MOTO', ''),
(23, 'LESLY MALAGÓN', 'DOCENTE', '', 'EDUCACIÓN FÍSICA', '', ''),
(24, 'JUAN FELIPE ZAMBRANO', 'DOCENTE', '', 'ALEMÁN TRANSICIÓN, 1°, 2° Y 301°', 'CYI 84F/ MOTO', ''),
(25, 'GERMÁN ORTÍZ', 'DOCENTE', '', 'ALEMÁN 302°, 303°, 4°, 5° Y 601°', '', ''),
(26, 'JOHANNA CATHERINE QUINTERO', 'DOCENTE', '', 'INGLÉS 1° Y 2°', '', ''),
(27, 'LUZ MARINA FAJARDO', 'DOCENTE', '', 'SISTEMAS', '', ''),
(28, 'ALDUBAR SALAZAR', 'DOCENTE', '', 'MÚSICA TRANSICIÓN, 1°, 2° Y 3°', '', ''),
(29, 'LUZ ÁNGELA GAITÁN', 'DOCENTE', 'DG 601', 'MATEMÁTICAS 6° - 8°', '', 'INGRESA CON SU HIJO'),
(30, 'CLAUDIA ALEXANDRA CAMARGO', 'DOCENTE', 'DG 602', 'SOCIALES 6° - 8°', '', ''),
(31, 'ALEJANDRA PERLAZA', 'DOCENTE', 'DG 701', 'BIOLOGÍA 6° - 8°, 901° Y 902°', 'BPT 16G/MOTO', ''),
(32, 'GENNY GONZÁLEZ', 'DOCENTE', 'DG 702', 'EDUCACIÓN FÍSICA 6° - 11°', 'BICICLETA', ''),
(33, 'KEVIN ROJAS', 'DOCENTE', 'DG 801', 'INGLÉS 602°, 7°, 8° Y 901°', '', ''),
(35, 'DIEGO GUTIÉRREZ', 'DOCENTE', 'DG 901', 'MATEMÁTICAS 901°/ FÍSICA 6° - 11°', '', ''),
(36, 'MARIELA SÁNCHEZ', 'DOCENTE', 'DG 903', 'SOCIALES 9° - 11°/ CIENCIAS POLÍTICAS 10° Y 11°', '', ''),
(37, 'NATALIA CORREDOR', 'DOCENTE', 'DG 1001', 'BIOLOGÍA 903° /QUÍMICA 6° - 11°', '', ''),
(38, 'JESÚS EBERT SALAMANCA', 'DOCENTE', 'DG 1002', 'GESTIÓN EMPRESARIAL 6° - 11°', 'BICICLETA', ''),
(39, 'FREDERICK ESCOBAR', 'DOCENTE', 'DG 1101', 'MATEMÁTICAS 902°, 903°, 10° Y 11°', 'BICICLETA', ''),
(40, 'LEONARDO CERÓN', 'DOCENTE', 'DG 1102', 'INGLÉS 902°, 903°, 10° Y 11°', '', ''),
(41, 'CATHERINE RODRÍGUEZ', 'DOCENTE', '', 'ESPAÑOL 6° - 8°', '', ''),
(42, 'BRAYAN GERARDO DUQUE', 'DOCENTE', '', 'ÉTICA Y VALORES 5° - 11°/ FILOSOFÍA 10° Y 11°', '', ''),
(43, 'CLARA LEÓN', 'DOCENTE', '', 'RELIGIÓN 4° - 11°/ ÉTICA Y VALORES 4°', '', ''),
(44, 'ADRIANA SILVA', 'SERVICIOS GENERALES', 'CONFIANZA EXTREMA', '', '', ''),
(45, 'ISABEL MIGUEZ', 'SERVICIOS GENERALES', 'CONFIANZA EXTREMA', '', '', ''),
(46, 'BERTILDE QUINTERO', 'SERVICIOS GENERALES', 'CONFIANZA EXTREMA', '', '', ''),
(47, 'TRANSITO CASTILLO', 'SERVICIOS GENERALES', 'CONFIANZA EXTREMA', '', '', ''),
(48, 'PATRICIA SOTO', 'SERVICIOS GENERALES', 'CONFIANZA EXTREMA', '', '', ''),
(49, 'ALEIDER BOBADILLA', 'ADMINISTRATIVO', 'SERVICIOS GENERALES', '', 'DWD 036/MOTO', 'INGRESA CON SU HIJA MARÍA JOSÉ AUTORIZADO POR R.H.'),
(50, 'CLARA DUEÑAS', 'DIRECTIVO', 'ASESORA RECTORÍA', '', '', ''),
(51, 'LUZ ESTELLA CHINCHILLA', 'FUNCIONARIO CAFETERÍA', 'FUNCIONARIA', '', '', ''),
(52, 'MARÍA EUGENIA GARCÍA', 'FUNCIONARIO CAFETERÍA', 'FUNCIONARIA', '', '', ''),
(53, 'STELLA MANCERA', 'FUNCIONARIO CAFETERÍA', 'ENCARGADA', '', '', ''),
(54, 'LINDA YESENIA HUERTAS', 'DOCENTE', '', 'DANZAS 3° - 5°', '', 'INGRESA CON SU HIJO'),
(55, 'JOSÉ AROCA', 'SEGURIDAD', 'S GHIA', '', '', 'RELEVANTE'),
(56, 'DAMAR NARVÁEZ', 'SEGURIDAD', 'S GHIA', '', '', ''),
(57, 'BRIAN ANDRES GRANOBLES', 'DOCENTE', '', '', '', ''),
(58, 'JAVIER RODRÍGUEZ', 'SEGURIDAD', 'S GHIA', '', '', ''),
(59, 'MÉLIDA TORRES', 'DOCENTE', '', '', '', ''),
(60, 'MARTA EDITH PACHON', 'DOCENTE', '', '', '', 'REEMPLAZOS'),
(61, 'CAROLINA PINEDA', 'ADMINISTRATIVO', 'SECRETARIA GENERAL', '', '', ''),
(62, 'MARTA LILIANA PLAZAS', 'SERVICIOS GENERALES', 'CONFIANZA EXTREMA', '', '', ''),
(63, 'LORENA GÓMEZ', 'ADMINISTRATIVO', 'ENFERMERA', '', '', ''),
(64, 'MARTA REYES', 'ADMINISTRATIVO', 'BIBLIOTECARIA', '', '', ''),
(65, 'LUZ MARINA NEIZA', 'MENSAJERÍA', 'MENSAJERA', '', '', ''),
(66, 'ÁLVARO PINZÓN', 'FUNCIONARIO EXTERNO', 'INGENIERO', '', 'WGF 46F/MOTO', ''),
(68, 'FENNA SCHWARZ', 'DIRECTIVO', 'REPRESENTANTE LEGAL', '', 'JVW 180/CARRO', ''),
(69, 'HEIDI RETTBERG', 'DIRECTIVO', '', '', '', 'EX REPRENTANTE LEGAL');

ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

