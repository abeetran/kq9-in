
--
-- Table structure for table `obi_color`
--

CREATE TABLE `obi_color` (
  `id` int(11) NOT NULL,
  `color` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `createddate` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `trash` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obi_color`
--

INSERT INTO `obi_color` (`id`, `color`, `content`, `createddate`, `created_by`, `trash`) VALUES
(1, 'Đỏ', 'Màu đỏ', '2018-02-08 23:24:25', 1, 0),
(2, 'Vàng chanh', 'Màu vàng chanh', '2018-02-08 23:24:40', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `obi_cottons`
--

CREATE TABLE `obi_cottons` (
  `id` int(11) NOT NULL,
  `cottons` varchar(250) NOT NULL,
  `content` text,
  `createddate` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `trash` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obi_cottons`
--

INSERT INTO `obi_cottons` (`id`, `cottons`, `content`, `createddate`, `created_by`, `trash`) VALUES
(1, 'Thun', 'Mo ta thun', '2018-02-08 23:04:07', 1, 0),
(2, 'Thun day', 'Mo ta thun', '2018-02-08 23:17:19', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `obi_size`
--

CREATE TABLE `obi_size` (
  `id` int(11) NOT NULL,
  `size` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '999999',
  `createddate` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `trash` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obi_size`
--

INSERT INTO `obi_size` (`id`, `size`, `content`, `sort`, `createddate`, `created_by`, `trash`) VALUES
(1, 's', 'Size S', 1, '2018-02-08 23:28:21', 1, 0),
(2, 'm', 'Size M', 2, '2018-02-08 23:28:32', 1, 0),
(3, 'l', 'Size L', 3, '2018-02-08 23:30:09', 1, 0),
(4, 'xl', 'Size XL', 4, '2018-02-08 23:32:13', 1, 0),
(5, 'xxl', 'Size XXL', 5, '2018-02-08 23:32:26', 1, 0),
(6, 'xxxl', 'Size XXXL', 6, '2018-02-08 23:32:39', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `obi_users`
--

CREATE TABLE `obi_users` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(250) NOT NULL,
  `birthday` date NOT NULL,
  `gender` int(1) NOT NULL DEFAULT '0',
  `image` varchar(250) NOT NULL,
  `level` int(2) NOT NULL DEFAULT '0',
  `published` int(11) NOT NULL DEFAULT '1',
  `trash` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_info` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obi_users`
--

INSERT INTO `obi_users` (`id`, `email`, `password`, `username`, `fullname`, `phone`, `address`, `birthday`, `gender`, `image`, `level`, `published`, `trash`, `created_by`, `created_date`, `updated_info`) VALUES
(1, 'admin@uibc.info', '72dbc8df7cf8d8068d8d3354f7580631823f5986', 'administrator', 'UIBC Administrator', '01687228899', '', '1989-06-03', 1, '', 9999, 1, 0, 0, '2017-09-16 00:00:00', ''),
(2, 'abeetran@gmail.com', '72dbc8df7cf8d8068d8d3354f7580631823f5986', 'abeetran', 'Abee Tran', '0939502023', '980 To Ngoc Van, Binh Chieu, Thu Duc, HCMC', '1999-01-01', 1, '1509115417_nau-ngot.jpg', 1, 1, 0, 1, '2017-10-25 22:13:12', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `obi_color`
--
ALTER TABLE `obi_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obi_cottons`
--
ALTER TABLE `obi_cottons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obi_size`
--
ALTER TABLE `obi_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obi_users`
--
ALTER TABLE `obi_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `obi_color`
--
ALTER TABLE `obi_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `obi_cottons`
--
ALTER TABLE `obi_cottons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `obi_size`
--
ALTER TABLE `obi_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `obi_users`
--
ALTER TABLE `obi_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;
