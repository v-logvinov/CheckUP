-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Мар 19 2023 г., 02:13
-- Версия сервера: 8.0.32-0ubuntu0.22.04.2
-- Версия PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cw84791_checkup`
--

-- --------------------------------------------------------

--
-- Структура таблицы `analyzes`
--

CREATE TABLE `analyzes` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `analyzes`
--

INSERT INTO `analyzes` (`id`, `name`, `price`) VALUES
(1, 'Гормональный скрининг', 500),
(2, 'Тестестерон', 1200),
(3, 'Свободный тестестрон', 2000),
(4, 'Глобулин, связывающий половые гормоны', 1000),
(5, 'Анализ почек', 700),
(6, 'Анализ печени', 200),
(7, 'Биопсия костного мозга', 2500),
(8, 'Тест на волчанку', 1000),
(9, 'Тест на Болезнь Вилсона', 3000);

-- --------------------------------------------------------

--
-- Структура таблицы `checkUp`
--

CREATE TABLE `checkUp` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `sale_procent` int NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '/'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `checkUp`
--

INSERT INTO `checkUp` (`id`, `name`, `sale_procent`, `image`) VALUES
(1, 'Для мужчин', 10, '/assets/image/doc.png'),
(2, 'Для пенсионеров', 30, '/assets/image/doc1.jpg'),
(3, 'И принц полукровка', 5, '/assets/image/doc2.jpeg'),
(4, 'И тайная команата', 10, '/assets/image/doc3.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `check_up_analyzes`
--

CREATE TABLE `check_up_analyzes` (
  `id` int NOT NULL,
  `check_up_id` int NOT NULL,
  `analyzes_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `check_up_analyzes`
--

INSERT INTO `check_up_analyzes` (`id`, `check_up_id`, `analyzes_id`) VALUES
(9, 1, 1),
(10, 1, 2),
(11, 1, 3),
(12, 1, 4),
(13, 2, 2),
(14, 2, 3),
(15, 2, 4),
(17, 3, 2),
(16, 3, 4),
(18, 3, 6),
(22, 4, 1),
(20, 4, 2),
(24, 4, 3),
(19, 4, 4),
(23, 4, 5),
(21, 4, 6);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `analyzes`
--
ALTER TABLE `analyzes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `checkUp`
--
ALTER TABLE `checkUp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `check_up_analyzes`
--
ALTER TABLE `check_up_analyzes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `check_up_id` (`check_up_id`,`analyzes_id`),
  ADD KEY `analyzes_id` (`analyzes_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `analyzes`
--
ALTER TABLE `analyzes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `checkUp`
--
ALTER TABLE `checkUp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `check_up_analyzes`
--
ALTER TABLE `check_up_analyzes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `check_up_analyzes`
--
ALTER TABLE `check_up_analyzes`
  ADD CONSTRAINT `check_up_analyzes_ibfk_1` FOREIGN KEY (`check_up_id`) REFERENCES `checkUp` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `check_up_analyzes_ibfk_2` FOREIGN KEY (`analyzes_id`) REFERENCES `analyzes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
