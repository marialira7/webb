

CREATE TABLE `livro` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(20) NOT NULL,
  `genero` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `capa` VARCHAR(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





INSERT INTO `usuario` (`id`, `username`, `email`, `telefone`, `senha`) VALUES
(1, 'gsoaresslv', 'guigamergg94@gmail.com', '27 998513127', '1234'),
(2, 'marialira', 'marialiramoreira7@gmail.com', '27 997020818', '1234'),
(5, 'annaajuliaft', 'annaajuliaft@gmail.com', '27 999016433', '1234'),
(6, 'martamendes', 'marta.mendes.ifes@gmail.com', '', '1234');

ALTER TABLE `livro`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `livro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

