-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 18, 2018 at 10:47 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `millhouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `post_id`, `created_by`, `created_at`) VALUES
(1, 'hej', 23, 1, '2018-12-17 19:07:23'),
(2, 'comment', 24, 1, '2018-12-17 19:14:08'),
(3, 'Wow sick', 34, 2, '2018-12-18 22:07:58'),
(4, 'Det var coolt!\r\n', 34, 2, '2018-12-18 22:08:12');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`) VALUES
(0, 'images/hero_image.png'),
(12, 'images/uploads/watchesetc.jpg'),
(13, 'images/uploads/greensunglasses.jpg'),
(15, 'images/uploads/interiorsofa.jpg'),
(18, 'images/uploads/sabina-ciesielska-325340-unsplash.jpg'),
(19, 'images/uploads/bagandsunglasses.jpg'),
(20, 'images/uploads/millhouse-logo.png'),
(21, 'images/uploads/paint_featured_interior copy.jpg'),
(22, 'images/uploads/sofa.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `description`, `created_by`, `image`, `published`, `created_at`) VALUES
(24, 'Welcome to Millhouse', 'welcome_to_millhouse', '<p>Welcome to our blog!</p><p>Here you\'ll find a great assortment of products to inspire you, so stay tuned.</p>', 1, '20', 1, '2018-12-17 20:10:50'),
(25, 'Watch this', 'watch_this', '<p><em style=\"color: rgb(0, 0, 0);\">Lorem ipsum</em><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\"> dolor sit amet, consectetur adipiscing elit.&nbsp;</span></p><p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\">Vivamus mattis turpis tellus, nec condimentum tortor vestibulum in. In blandit tortor nec dolor bibendum gravida. Nunc convallis urna eu varius auctor. Vivamus ante risus, tempus in tincidunt ut, condimentum et eros.&nbsp;</span></p><p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\">Nulla sit amet felis eget nisi </span><strong style=\"color: rgb(0, 0, 0);\">ultrices accumsan</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\"> ut vel metus. Sed non nunc a sem luctus posuere vulputate ac quam. In fermentum felis sit amet venenatis aliquet</span></p>', 1, '12', 1, '2018-12-17 21:58:47'),
(26, 'Interior design', 'interior_design', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\">Maecenas nec porttitor odio. Aenean pharetra vestibulum bibendum. Nunc dignissim sapien bibendum ex lacinia faucibus. Fusce ultricies dui erat, et ullamcorper arcu lacinia in. Curabitur eu tellus scelerisque nisi varius dictum maximus eget neque. Fusce lacinia, lectus sed dictum suscipit, ipsum enim bibendum tellus, sit amet malesuada neque est vel ante. Pellentesque semper turpis vitae neque tincidunt, sed auctor tellus varius.</span></p>', 1, '15', 1, '2018-12-17 21:59:45'),
(27, 'Fancy watch', 'fancy_watch', '<p><strong style=\"color: rgb(0, 0, 0);\"><em>Donec ante orci, </em></strong><span style=\"color: rgb(0, 0, 0);\">dictum eget purus a, accumsan bibendum nulla. Curabitur a eleifend odio. Donec posuere eleifend est in dictum. Donec at neque nibh. Fusce id molestie est. Nullam ac ultricies diam.</span><em style=\"color: rgb(0, 0, 0);\"> </em></p><p><em style=\"color: rgb(0, 0, 0);\">Donec dolor </em><span style=\"color: rgb(0, 0, 0);\">libero, pharetra vitae dapibus ac, dignissim porta nisl.&nbsp;</span></p><p><span style=\"color: rgb(0, 0, 0);\">Class </span><u style=\"color: rgb(0, 0, 0);\">aptent ta</u><span style=\"color: rgb(0, 0, 0);\">citi sociosqu ad litora torquent</span></p>', 1, '19', 1, '2018-12-17 23:17:17'),
(28, 'Green Sunglasses', 'green_sunglasses', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\">Donec ante orci, dictum eget purus a, accumsan bibendum nulla. Curabitur a eleifend odio.&nbsp;</span></p><p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\">Donec posuere eleifend est in dictum. Donec at neque nibh. Fusce id molestie est.&nbsp;</span></p><p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\">Nullam ac ultricies diam. Donec dolor libero, pharetra vitae dapibus ac, dignissim porta nisl.&nbsp;</span></p><p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\">Class aptent taciti sociosqu ad litora torquent</span></p>', 1, '13', 1, '2018-12-17 22:48:44'),
(31, 'More Sunglasses', 'more_sunglasses', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\">Suspendisse cursus ullamcorper eleifend. In justo dolor, molestie eleifend sollicitudin sit amet, tempor eget leo. Aliquam erat volutpat. Curabitur pulvinar vestibulum sagittis. Fusce volutpat viverra posuere.&nbsp;</span></p><p><strong style=\"color: rgb(0, 0, 0);\"><u>Sed a purus elit.</u></strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\"> In bibendum, lectus viverra malesuada consectetur,&nbsp;</span></p><p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\">dui lectus dignissim nunc, id vehicula nisi risus vel ex.&nbsp;</span></p><p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; white-space: normal;\">Suspendisse elementum lectus faucibus faucibus condimentum.</span></p>', 1, '18', 1, '2018-12-17 22:58:34'),
(33, 'Very nice sofa', 'very_nice_sofa', '<p><em style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </em><span style=\"color: rgb(0, 0, 0);\">Vivamus mattis turpis tellus, nec condimentum tortor vestibulum in. In blandit tortor nec dolor bibendum gravida.&nbsp;</span></p><p><br></p><p><span style=\"color: rgb(0, 0, 0);\">Nunc convallis urna eu varius auctor.&nbsp;</span></p>', 1, '22', 1, '2018-12-17 23:44:35'),
(34, 'Paintings', 'paintings', '<p><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis turpis tellus, nec condimentum tortor vestibulum in. In blandit tortor nec dolor bibendum gravida. Nunc convallis urna eu varius auctor.&nbsp;</span></p><p><span style=\"color: rgb(0, 0, 0);\">Vivamus ante risus, tempus in tincidunt ut, condimentum et eros. Nulla sit amet felis eget nisi ultrices accumsan ut vel metus.&nbsp;</span></p>', 1, '21', 1, '2018-12-17 23:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `prod_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`id`, `post_id`, `prod_category_id`) VALUES
(1, 22, 1),
(2, 23, 1),
(3, 24, 3),
(4, 25, 1),
(5, 26, 3),
(6, 27, 1),
(7, 28, 2),
(10, 31, 2),
(12, 33, 3),
(13, 34, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category`) VALUES
(1, 'watches'),
(2, 'sunglasses'),
(3, 'interior');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `email` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `admin`, `username`, `password`, `email`) VALUES
(1, 1, 'lio', '$2y$10$aV1KVyLu35p6lcs5ziiTMO5qXIH.Kp3PJydaPKbpnoIf32zQBzZZW', 'u@u.com'),
(2, 0, 'Featic', '$2y$10$29Fk6Rtcf8DMJ7389E/K..dH765.3gJkhUtXN0F8DpD7ZyrYZXrne', 'alexanderdanebring@hotmail.se');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
