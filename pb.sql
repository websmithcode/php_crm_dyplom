-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: May 31, 2021 at 12:08 PM
-- Server version: 8.0.25
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pb`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ClientID` bigint NOT NULL,
  `ClientSurname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_ru_0900_ai_ci NOT NULL,
  `ClientName` varchar(30) NOT NULL,
  `ClientMiddleName` varchar(30) DEFAULT NULL,
  `ClientTelNumber` varchar(255) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1638 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ClientID`, `ClientSurname`, `ClientName`, `ClientMiddleName`, `ClientTelNumber`) VALUES
(1, 'Иванов', 'Сергей', 'Григорьевич', ''),
(2, 'Козлов', 'Дмитрий', 'Иванович', ''),
(3, 'Чукмеков', 'Салим', 'Насирович', ''),
(4, 'Карапетян', 'Артем', 'Гургенович', ''),
(5, 'Петров', 'Роман', 'Юрьевич', ''),
(6, 'Амарян', 'Гурам', 'Викторович', ''),
(7, 'Дорбин', 'Илья', 'Захарович', ''),
(8, 'Пергунов', 'Алексей', 'Андреевич', ''),
(9, 'Перунов', 'Вячеслав', 'Никитич', ''),
(10, 'Одинцов', 'Василий', 'Романович', '');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `DiscountID` tinyint NOT NULL,
  `DiscountName` varchar(30) DEFAULT NULL,
  `DiscountValue` decimal(2,1) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`DiscountID`, `DiscountName`, `DiscountValue`) VALUES
(1, 'Скидка 0', '1.0'),
(2, 'Скидка 30%', '0.3'),
(3, 'Скидка 50%', '0.5');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `LoginID` int NOT NULL,
  `LoginName` varchar(64) NOT NULL,
  `LoginPassword` varchar(255) NOT NULL,
  `LoginRoleID` tinyint NOT NULL,
  `PartnerID` int DEFAULT NULL
) ;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`LoginID`, `LoginName`, `LoginPassword`, `LoginRoleID`, `PartnerID`) VALUES
(1, 'Ars', '202cb962ac59075b964b07152d234b70', 2, 1),
(2, 'Ars2', '202cb962ac59075b964b07152d234b70', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `MaterialID` smallint NOT NULL,
  `MaterialName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`MaterialID`, `MaterialName`) VALUES
(1, 'Микрофибра'),
(2, 'Полиэстер'),
(3, 'Хлопок');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderID` bigint NOT NULL,
  `OrderDetailID` bigint NOT NULL,
  `ProductCostID` bigint NOT NULL,
  `PrintID` int NOT NULL,
  `SizeID` tinyint NOT NULL,
  `DiscountID` tinyint NOT NULL,
  `Price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `DiscountValue` decimal(2,1) NOT NULL DEFAULT '1.0',
  `Quantity` smallint NOT NULL DEFAULT '0',
  `Summa` decimal(20,2) GENERATED ALWAYS AS (((`Price` * `DiscountValue`) * `Quantity`)) VIRTUAL NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`OrderID`, `OrderDetailID`, `ProductCostID`, `PrintID`, `SizeID`, `DiscountID`, `Price`, `DiscountValue`, `Quantity`) VALUES
(14, 25, 5, 10, 3, 2, '300.00', '0.3', 2),
(14, 29, 1, 6, 1, 1, '1690.00', '1.0', 1),
(27, 30, 1, 1, 1, 3, '1690.00', '1.0', 2),
(27, 31, 2, 14, 3, 2, '1889.00', '1.0', 1),
(19, 32, 4, 9, 2, 3, '2188.00', '1.0', 2),
(19, 33, 1, 6, 7, 1, '1690.00', '1.0', 2),
(31, 34, 1, 9, 5, 2, '1690.00', '1.0', 1),
(32, 35, 1, 8, 5, 2, '1690.00', '1.0', 1),
(31, 36, 5, 4, 4, 1, '2089.00', '1.0', 1),
(32, 37, 3, 13, 1, 1, '1989.00', '1.0', 2),
(24, 38, 1, 11, 6, 3, '1690.00', '1.0', 5),
(24, 39, 6, 5, 4, 2, '2288.00', '1.0', 1),
(26, 40, 3, 10, 3, 1, '1989.00', '1.0', 1),
(26, 41, 5, 7, 8, 2, '2089.00', '1.0', 4);

--
-- Triggers `orderdetails`
--
DELIMITER $$
CREATE TRIGGER `tr_af_delete_orderdetails_summa` AFTER DELETE ON `orderdetails` FOR EACH ROW BEGIN
  UPDATE orders o
  SET o.OrderCost = o.OrderCost - OLD.Summa
  WHERE o.OrderID = OLD.OrderID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_af_insert_orderdetails_summa` AFTER INSERT ON `orderdetails` FOR EACH ROW BEGIN
  UPDATE orders o
  SET o.OrderCost = o.OrderCost + NEW.Summa
  WHERE o.OrderID = NEW.OrderID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_af_update_orderdetails_summa` AFTER UPDATE ON `orderdetails` FOR EACH ROW BEGIN
  UPDATE orders o
  SET o.OrderCost = o.OrderCost + NEW.Summa - OLD.Summa
  WHERE o.OrderID = OLD.OrderID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_bf_insert_orderdetails` BEFORE INSERT ON `orderdetails` FOR EACH ROW BEGIN
  SET @discountvalue = (SELECT
      DiscountValue
    FROM discounts AS d
    WHERE DiscountID = NEW.DiscountID);
  SET NEW.DiscountValue = @discountvalue;

  SET @price = (SELECT
      Price
    FROM productcosts AS p
    WHERE ProductCostID = NEW.ProductCostID);
  SET NEW.Price = @price;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_bf_update_orderdetails` BEFORE UPDATE ON `orderdetails` FOR EACH ROW BEGIN
  SET @discountvalue = (SELECT
      DiscountValue
    FROM discounts AS d
    WHERE DiscountID = NEW.DiscountID);
  SET NEW.DiscountValue = @discountvalue;

  SET @price = (SELECT
      Price
    FROM productcosts AS p
    WHERE ProductCostID = NEW.ProductCostID);
  SET NEW.Price = @price;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` bigint NOT NULL,
  `OrderDate` datetime NOT NULL DEFAULT (now()),
  `ClientID` bigint NOT NULL,
  `PartnerID` int NOT NULL,
  `StateID` tinyint NOT NULL,
  `OrderCost` decimal(12,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AVG_ROW_LENGTH=1489 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderDate`, `ClientID`, `PartnerID`, `StateID`, `OrderCost`) VALUES
(14, '2019-12-28 00:00:00', 1, 1, 3, '1870.00'),
(18, '2019-12-04 00:00:00', 2, 1, 1, '4444.70'),
(19, '2019-11-07 00:00:00', 4, 2, 1, '3380.00'),
(24, '2019-12-30 00:00:00', 8, 4, 1, '507.00'),
(26, '2020-01-08 00:00:00', 10, 1, 3, '507.00'),
(27, '2020-01-01 00:00:00', 9, 3, 4, '2089.00'),
(28, '2019-12-13 00:00:00', 5, 5, 3, '3978.00'),
(29, '2020-01-02 00:00:00', 3, 5, 3, '4225.00'),
(30, '2020-01-04 00:00:00', 7, 4, 2, '686.40'),
(31, '2020-01-06 00:00:00', 6, 3, 4, '1989.00'),
(32, '2019-11-14 00:00:00', 5, 2, 1, '2506.80');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `tr_orders_commission` AFTER UPDATE ON `orders` FOR EACH ROW BEGIN
  IF NEW.StateID = 3
    AND NEW.StateID != OLD.StateID THEN
    SET @commissionPercent = (SELECT
        Commission
      FROM Partners
      WHERE PartnerID = NEW.PartnerID);
    DELETE
      FROM partnercommissions
    WHERE OrderID = NEW.OrderID
      AND PaertnerID = NEW.PartnerID;
    INSERT INTO partnercommissions (OrderID, PartnerID, CommissionSumma)
      VALUES (NEW.OrderID, NEW.PartnerID, NEW.OrderCost * @commissionPercent * 0.01);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `partnercommissions`
--

CREATE TABLE `partnercommissions` (
  `PartnerID` int NOT NULL,
  `OrderID` bigint NOT NULL,
  `CommisionDate` datetime NOT NULL DEFAULT (now()),
  `CommissionSumma` decimal(12,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `partnercommissions`
--

INSERT INTO `partnercommissions` (`PartnerID`, `OrderID`, `CommisionDate`, `CommissionSumma`) VALUES
(1, 14, '2021-05-24 19:34:12', '360.00'),
(1, 26, '2021-05-24 20:17:02', '101.40');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `PartnerID` int NOT NULL,
  `PartnerName` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Commission` decimal(5,2) NOT NULL,
  `PartnerEmail` varchar(20) NOT NULL,
  `PartnerRequisites` varchar(64) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=3276 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`PartnerID`, `PartnerName`, `Commission`, `PartnerEmail`, `PartnerRequisites`) VALUES
(1, 'Арсений', '20.00', 'qwe@bk.ru', '4330 5133 6700 1223'),
(2, 'Василий', '20.00', 'racerin933@bk.ru', '1112 5633 7765 8937'),
(3, 'Татьяна', '25.00', 'vagova44@mail.ru', '3422 0998 5553 1324'),
(4, 'Аркадий', '20.00', 'arkan@mail.ru', '6644 7766 0856 7944'),
(5, 'Нелли', '20.00', 'nllrty@bk.ru', '3155 6247 8209 6261');

-- --------------------------------------------------------

--
-- Table structure for table `prints`
--

CREATE TABLE `prints` (
  `PrintID` int NOT NULL,
  `PrintName` varchar(30) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=819 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `prints`
--

INSERT INTO `prints` (`PrintID`, `PrintName`) VALUES
(1, 'Сварог'),
(2, 'Русич'),
(3, 'Русич'),
(4, 'Русич'),
(5, 'Перун'),
(6, 'За Русь'),
(7, 'Славянин'),
(8, 'Славянин'),
(9, 'Варяг'),
(10, 'Русская Рать'),
(11, 'Орнамент'),
(12, 'Русский Медведь'),
(13, 'Дети Сварога'),
(14, 'Мои правила'),
(15, 'Воин'),
(16, 'Один'),
(17, 'Князь Святослав'),
(18, 'Кельтика'),
(19, 'Сын солнца'),
(20, 'Родина');

-- --------------------------------------------------------

--
-- Table structure for table `printtypes`
--

CREATE TABLE `printtypes` (
  `PrintTypeID` tinyint NOT NULL,
  `PrintTypeName` varchar(30) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `printtypes`
--

INSERT INTO `printtypes` (`PrintTypeID`, `PrintTypeName`) VALUES
(1, 'HD'),
(2, 'Ultra HD');

-- --------------------------------------------------------

--
-- Table structure for table `productcosts`
--

CREATE TABLE `productcosts` (
  `ProductCostID` bigint NOT NULL,
  `ProductID` bigint NOT NULL,
  `Price` decimal(12,2) NOT NULL,
  `PriceDate` datetime NOT NULL DEFAULT (now())
) ENGINE=InnoDB AVG_ROW_LENGTH=2730 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `productcosts`
--

INSERT INTO `productcosts` (`ProductCostID`, `ProductID`, `Price`, `PriceDate`) VALUES
(1, 1, '1690.00', '2019-12-15 21:14:01'),
(2, 2, '1889.00', '2019-12-15 21:14:01'),
(3, 3, '1989.00', '2019-12-15 21:14:01'),
(4, 4, '2188.00', '2019-12-15 21:15:52'),
(5, 5, '2089.00', '2019-12-15 21:15:55'),
(6, 6, '2288.00', '2019-12-15 21:15:56'),
(7, 1, '1710.00', '2021-05-31 10:36:11'),
(8, 2, '1890.00', '2021-05-31 10:36:11'),
(9, 1, '1900.00', '2021-05-31 13:44:00'),
(10, 2, '1800.00', '2021-05-31 13:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` bigint NOT NULL,
  `MaterialID` smallint DEFAULT NULL,
  `PrintTypeID` tinyint DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=2730 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `MaterialID`, `PrintTypeID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 3, 1),
(6, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `SizeID` tinyint NOT NULL,
  `SizeCodeSym` varchar(10) NOT NULL,
  `SizeCodeNum` smallint NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1638 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`SizeID`, `SizeCodeSym`, `SizeCodeNum`) VALUES
(1, 'XS', 0),
(2, 'XS', 44),
(3, 'S', 46),
(4, 'M', 48),
(5, 'L', 50),
(6, 'XL', 52),
(7, 'XXL', 54),
(8, 'XXXL', 56),
(9, '4XL', 58),
(10, '5XL', 60);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `StateID` tinyint NOT NULL,
  `StateName` varchar(30) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`StateID`, `StateName`) VALUES
(1, 'Новый'),
(2, 'В работе'),
(3, 'Выполнен'),
(4, 'Отменен');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ClientID`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`DiscountID`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`LoginID`),
  ADD KEY `FK_logins_PartnerID` (`PartnerID`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`MaterialID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`OrderDetailID`,`OrderID`),
  ADD KEY `FK_orderdetails_DiscountID` (`DiscountID`),
  ADD KEY `FK_orderdetails_OrderID` (`OrderID`),
  ADD KEY `FK_orderdetails_PrintID` (`PrintID`),
  ADD KEY `FK_orderdetails_ProductCostID` (`ProductCostID`),
  ADD KEY `FK_orderdetails_SizeID` (`SizeID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FK_orders_ClientID` (`ClientID`),
  ADD KEY `FK_orders_PartnerID` (`PartnerID`),
  ADD KEY `FK_orders_StateID` (`StateID`);

--
-- Indexes for table `partnercommissions`
--
ALTER TABLE `partnercommissions`
  ADD PRIMARY KEY (`PartnerID`,`OrderID`),
  ADD KEY `IDX_partnercommissions_partner_date` (`PartnerID`,`CommisionDate`),
  ADD KEY `FK_partnercommissions_OrderID` (`OrderID`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`PartnerID`);

--
-- Indexes for table `prints`
--
ALTER TABLE `prints`
  ADD PRIMARY KEY (`PrintID`);

--
-- Indexes for table `printtypes`
--
ALTER TABLE `printtypes`
  ADD PRIMARY KEY (`PrintTypeID`);

--
-- Indexes for table `productcosts`
--
ALTER TABLE `productcosts`
  ADD PRIMARY KEY (`ProductCostID`),
  ADD UNIQUE KEY `UK_productcosts` (`ProductID`,`PriceDate`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `FK_products_MaterialID` (`MaterialID`),
  ADD KEY `FK_products_PrintTypeID` (`PrintTypeID`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`SizeID`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`StateID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ClientID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `LoginID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `MaterialID` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `OrderDetailID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `productcosts`
--
ALTER TABLE `productcosts`
  MODIFY `ProductCostID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logins`
--
ALTER TABLE `logins`
  ADD CONSTRAINT `FK_logins_PartnerID` FOREIGN KEY (`PartnerID`) REFERENCES `partners` (`PartnerID`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `FK_orderdetails_DiscountID` FOREIGN KEY (`DiscountID`) REFERENCES `discounts` (`DiscountID`),
  ADD CONSTRAINT `FK_orderdetails_OrderID` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `FK_orderdetails_PrintID` FOREIGN KEY (`PrintID`) REFERENCES `prints` (`PrintID`),
  ADD CONSTRAINT `FK_orderdetails_ProductCostID` FOREIGN KEY (`ProductCostID`) REFERENCES `productcosts` (`ProductCostID`),
  ADD CONSTRAINT `FK_orderdetails_SizeID` FOREIGN KEY (`SizeID`) REFERENCES `sizes` (`SizeID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_ClientID` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`),
  ADD CONSTRAINT `FK_orders_PartnerID` FOREIGN KEY (`PartnerID`) REFERENCES `partners` (`PartnerID`),
  ADD CONSTRAINT `FK_orders_StateID` FOREIGN KEY (`StateID`) REFERENCES `states` (`StateID`);

--
-- Constraints for table `partnercommissions`
--
ALTER TABLE `partnercommissions`
  ADD CONSTRAINT `FK_partnercommissions_OrderID` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `FK_partnercommissions_PartnerID` FOREIGN KEY (`PartnerID`) REFERENCES `partners` (`PartnerID`);

--
-- Constraints for table `productcosts`
--
ALTER TABLE `productcosts`
  ADD CONSTRAINT `FK_productcosts_ProductID` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products_MaterialID` FOREIGN KEY (`MaterialID`) REFERENCES `materials` (`MaterialID`),
  ADD CONSTRAINT `FK_products_PrintTypeID` FOREIGN KEY (`PrintTypeID`) REFERENCES `printtypes` (`PrintTypeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
