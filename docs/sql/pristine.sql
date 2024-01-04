-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2024 at 07:35 PM
-- Server version: 10.3.10-MariaDB-log
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `bookmark_storage`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_locking`
--

CREATE TABLE `app_locking` (
`lock_id` bigint(11) UNSIGNED NOT NULL,
`screen_url_path` varchar(250) NOT NULL,
`screen_name` varchar(250) NOT NULL DEFAULT '',
`item_primary` varchar(250) NOT NULL DEFAULT '',
`lock_label` varchar(250) NOT NULL DEFAULT '',
`locked_by` int(11) UNSIGNED NOT NULL,
`locked_time` datetime NOT NULL,
`locked_until` datetime NOT NULL,
`last_activity` datetime NOT NULL,
`properties` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_locking_messages`
--

CREATE TABLE `app_locking_messages` (
`lock_id` bigint(11) UNSIGNED NOT NULL,
`requested_by` int(11) UNSIGNED NOT NULL,
`message_id` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_messagelog`
--

CREATE TABLE `app_messagelog` (
`log_id` bigint(11) UNSIGNED NOT NULL,
`date` datetime NOT NULL,
`type` varchar(60) NOT NULL,
`message` text NOT NULL,
`user_id` int(11) UNSIGNED NOT NULL,
`category` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_messaging`
--

CREATE TABLE `app_messaging` (
`message_id` bigint(11) UNSIGNED NOT NULL,
`in_reply_to` bigint(11) UNSIGNED DEFAULT NULL,
`from_user` int(11) UNSIGNED NOT NULL,
`to_user` int(11) UNSIGNED NOT NULL,
`message` text NOT NULL,
`priority` varchar(60) NOT NULL DEFAULT 'normal',
`date_sent` datetime NOT NULL,
`date_received` datetime DEFAULT NULL,
`date_responded` datetime DEFAULT NULL,
`response` text DEFAULT NULL,
`custom_data` text DEFAULT NULL,
`lock_id` bigint(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_news`
--

CREATE TABLE `app_news` (
`news_id` int(11) UNSIGNED NOT NULL,
`parent_news_id` int(11) UNSIGNED DEFAULT NULL,
`news_type` varchar(60) NOT NULL,
`label` varchar(120) NOT NULL,
`author` int(11) UNSIGNED NOT NULL,
`locale` varchar(5) NOT NULL,
`status` varchar(20) NOT NULL DEFAULT 'draft',
`synopsis` text NOT NULL DEFAULT '',
`article` mediumtext NOT NULL DEFAULT '',
`date_created` datetime NOT NULL,
`date_modified` datetime NOT NULL,
`criticality` varchar(60) DEFAULT NULL COMMENT 'Used for alerts.',
`scheduled_from_date` datetime DEFAULT NULL,
`scheduled_to_date` datetime DEFAULT NULL,
`requires_receipt` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Used for alerts.',
`views` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_news_categories`
--

CREATE TABLE `app_news_categories` (
`news_category_id` int(11) UNSIGNED NOT NULL,
`label` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_news_entry_categories`
--

CREATE TABLE `app_news_entry_categories` (
`news_id` int(11) UNSIGNED NOT NULL,
`news_category_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_news_reactions`
--

CREATE TABLE `app_news_reactions` (
`reaction_id` int(11) UNSIGNED NOT NULL,
`label` varchar(60) NOT NULL,
`emoji` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_news_related`
--

CREATE TABLE `app_news_related` (
`news_id` int(11) UNSIGNED NOT NULL,
`related_news_id` int(11) UNSIGNED NOT NULL,
`relation_type` varchar(160) NOT NULL,
`relation_params` text NOT NULL COMMENT 'JSON configuration.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_news_user_reactions`
--

CREATE TABLE `app_news_user_reactions` (
`news_id` int(11) UNSIGNED NOT NULL,
`user_id` int(11) UNSIGNED NOT NULL,
`reaction_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_news_user_receipts`
--

CREATE TABLE `app_news_user_receipts` (
`news_id` int(11) UNSIGNED NOT NULL,
`user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_ratings`
--

CREATE TABLE `app_ratings` (
`rating_id` int(11) UNSIGNED NOT NULL,
`user_id` int(11) UNSIGNED NOT NULL,
`rating_screen_id` int(11) UNSIGNED NOT NULL,
`date` datetime NOT NULL,
`rating` int(11) NOT NULL,
`comments` text NOT NULL,
`app_version` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stores user ratings for application screens.';

-- --------------------------------------------------------

--
-- Table structure for table `app_ratings_screens`
--

CREATE TABLE `app_ratings_screens` (
`rating_screen_id` int(11) UNSIGNED NOT NULL,
`hash` varchar(32) NOT NULL,
`dispatcher` varchar(250) NOT NULL,
`path` varchar(250) NOT NULL,
`params` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Unique application screens rated by users';

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
`data_key` varchar(80) NOT NULL,
`data_value` mediumtext NOT NULL,
`data_role` enum('cache','persistent') NOT NULL DEFAULT 'cache'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
`bookmark_id` int(11) UNSIGNED NOT NULL,
`label` varchar(300) NOT NULL,
`url` varchar(8000) NOT NULL,
`domain` varchar(600) NOT NULL,
`date_created` datetime NOT NULL,
`rating` int(2) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
`country_id` int(11) UNSIGNED NOT NULL,
`iso` varchar(2) NOT NULL,
`label` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cache for Editor countries';

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `iso`, `label`) VALUES
(1, 'de', 'Germany'),
(2, 'fr', 'France'),
(4, 'uk', 'United Kingdom'),
(7, 'us', 'United States'),
(9999, 'zz', 'Country-independent');

-- --------------------------------------------------------

--
-- Table structure for table `custom_properties`
--

CREATE TABLE `custom_properties` (
`property_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `custom_properties_data`
--

CREATE TABLE `custom_properties_data` (
`property_id` int(11) UNSIGNED NOT NULL,
`owner_type` varchar(250) NOT NULL,
`owner_key` varchar(250) NOT NULL,
`name` varchar(180) NOT NULL,
`is_structural` enum('yes','no') NOT NULL DEFAULT 'no',
`value` text NOT NULL,
`label` varchar(180) NOT NULL,
`default_value` text NOT NULL,
`preset_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `custom_properties_presets`
--

CREATE TABLE `custom_properties_presets` (
`preset_id` int(11) UNSIGNED NOT NULL,
`owner_type` varchar(250) NOT NULL,
`editable` enum('yes','no') NOT NULL DEFAULT 'yes',
`name` varchar(180) NOT NULL,
`is_structural` enum('yes','no') NOT NULL DEFAULT 'no',
`label` varchar(180) NOT NULL,
`default_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
`feedback_id` int(11) NOT NULL,
`user_id` int(11) NOT NULL,
`date` datetime NOT NULL,
`feedback` text NOT NULL,
`request_params` text NOT NULL,
`feedback_scope` varchar(40) NOT NULL DEFAULT 'application',
`feedback_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `known_users`
--

CREATE TABLE `known_users` (
`user_id` int(11) UNSIGNED NOT NULL,
`foreign_id` varchar(250) NOT NULL,
`firstname` varchar(250) NOT NULL,
`lastname` varchar(250) NOT NULL,
`email` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `known_users`
--

INSERT INTO `known_users` (`user_id`, `foreign_id`, `firstname`, `lastname`, `email`) VALUES
(1, '__system', 'Bookmark Storage', '', 'system@bookmark-storage.systems'),
(2, '__dummy', 'Sample', 'User', 'sample@bookmark-storage.systems');

-- --------------------------------------------------------

--
-- Table structure for table `locales_application`
--

CREATE TABLE `locales_application` (
`locale_name` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `locales_content`
--

CREATE TABLE `locales_content` (
`locale_name` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
`media_id` int(11) UNSIGNED NOT NULL,
`user_id` int(11) UNSIGNED NOT NULL,
`media_date_added` datetime NOT NULL,
`media_type` varchar(100) NOT NULL,
`media_name` varchar(240) NOT NULL,
`media_extension` varchar(20) NOT NULL,
`file_size` int(11) UNSIGNED NOT NULL DEFAULT 0,
`keywords` varchar(500) NOT NULL DEFAULT '',
`description` varchar(1200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `media_configurations`
--

CREATE TABLE `media_configurations` (
`config_id` int(11) UNSIGNED NOT NULL,
`type_id` varchar(60) NOT NULL,
`config_key` varchar(32) NOT NULL,
`config` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `test_records`
--

CREATE TABLE `test_records` (
`record_id` int(11) UNSIGNED NOT NULL,
`label` varchar(180) NOT NULL,
`alias` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `test_records_data`
--

CREATE TABLE `test_records_data` (
`record_id` int(11) UNSIGNED NOT NULL,
`name` varchar(250) NOT NULL,
`value` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
`upload_id` int(11) UNSIGNED NOT NULL,
`user_id` int(11) UNSIGNED NOT NULL,
`upload_date` datetime NOT NULL,
`upload_name` varchar(240) NOT NULL,
`upload_extension` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_emails`
--

CREATE TABLE `user_emails` (
`user_id` int(11) UNSIGNED NOT NULL,
`email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
`user_id` int(11) UNSIGNED NOT NULL,
`setting_name` varchar(180) NOT NULL,
`setting_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_locking`
--
ALTER TABLE `app_locking`
ADD PRIMARY KEY (`lock_id`),
ADD UNIQUE KEY `screen_url_path` (`screen_url_path`,`item_primary`) USING BTREE,
ADD KEY `locked_by` (`locked_by`),
ADD KEY `locked_time` (`locked_time`),
ADD KEY `locked_until` (`locked_until`),
ADD KEY `last_activity` (`last_activity`);

--
-- Indexes for table `app_locking_messages`
--
ALTER TABLE `app_locking_messages`
ADD PRIMARY KEY (`lock_id`,`requested_by`),
ADD KEY `message_id` (`message_id`),
ADD KEY `lock_id` (`lock_id`),
ADD KEY `requested_by` (`requested_by`);

--
-- Indexes for table `app_messagelog`
--
ALTER TABLE `app_messagelog`
ADD PRIMARY KEY (`log_id`),
ADD KEY `user_id` (`user_id`),
ADD KEY `type` (`type`),
ADD KEY `user_id_2` (`user_id`),
ADD KEY `date` (`date`);

--
-- Indexes for table `app_messaging`
--
ALTER TABLE `app_messaging`
ADD PRIMARY KEY (`message_id`),
ADD KEY `from_user` (`from_user`),
ADD KEY `to_user` (`to_user`),
ADD KEY `priority` (`priority`),
ADD KEY `date_sent` (`date_sent`),
ADD KEY `date_received` (`date_received`),
ADD KEY `date_responded` (`date_responded`),
ADD KEY `reply_to` (`in_reply_to`),
ADD KEY `lock_id` (`lock_id`);

--
-- Indexes for table `app_news`
--
ALTER TABLE `app_news`
ADD PRIMARY KEY (`news_id`),
ADD KEY `label` (`label`),
ADD KEY `date_created` (`date_created`),
ADD KEY `criticality` (`criticality`),
ADD KEY `visible_from_date` (`scheduled_from_date`),
ADD KEY `visible_to_date` (`scheduled_to_date`),
ADD KEY `dismissable` (`requires_receipt`),
ADD KEY `author` (`author`),
ADD KEY `date_modified` (`date_modified`),
ADD KEY `parent_news_id` (`parent_news_id`),
ADD KEY `views` (`views`),
ADD KEY `status` (`status`),
ADD KEY `news_type` (`news_type`),
ADD KEY `locale` (`locale`);

--
-- Indexes for table `app_news_categories`
--
ALTER TABLE `app_news_categories`
ADD PRIMARY KEY (`news_category_id`),
ADD KEY `label` (`label`);

--
-- Indexes for table `app_news_entry_categories`
--
ALTER TABLE `app_news_entry_categories`
ADD PRIMARY KEY (`news_id`,`news_category_id`),
ADD KEY `news_id` (`news_id`),
ADD KEY `news_category_id` (`news_category_id`);

--
-- Indexes for table `app_news_reactions`
--
ALTER TABLE `app_news_reactions`
ADD PRIMARY KEY (`reaction_id`),
ADD KEY `label` (`label`),
ADD KEY `emoji` (`emoji`);

--
-- Indexes for table `app_news_related`
--
ALTER TABLE `app_news_related`
ADD PRIMARY KEY (`news_id`,`related_news_id`,`relation_type`),
ADD KEY `news_id` (`news_id`),
ADD KEY `related_news_id` (`related_news_id`),
ADD KEY `relation_type` (`relation_type`);

--
-- Indexes for table `app_news_user_reactions`
--
ALTER TABLE `app_news_user_reactions`
ADD PRIMARY KEY (`news_id`,`user_id`,`reaction_id`),
ADD KEY `user_id` (`user_id`),
ADD KEY `reaction_id` (`reaction_id`);

--
-- Indexes for table `app_news_user_receipts`
--
ALTER TABLE `app_news_user_receipts`
ADD PRIMARY KEY (`news_id`,`user_id`),
ADD KEY `news_id` (`news_id`),
ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `app_ratings`
--
ALTER TABLE `app_ratings`
ADD PRIMARY KEY (`rating_id`),
ADD KEY `user_id` (`user_id`),
ADD KEY `rating` (`rating`),
ADD KEY `date` (`date`),
ADD KEY `rating_screen_id` (`rating_screen_id`),
ADD KEY `app_version` (`app_version`);

--
-- Indexes for table `app_ratings_screens`
--
ALTER TABLE `app_ratings_screens`
ADD PRIMARY KEY (`rating_screen_id`),
ADD UNIQUE KEY `hash` (`hash`),
ADD KEY `dispatcher` (`dispatcher`),
ADD KEY `path` (`path`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
ADD PRIMARY KEY (`data_key`),
ADD KEY `data_role` (`data_role`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
ADD PRIMARY KEY (`bookmark_id`),
ADD KEY `label` (`label`),
ADD KEY `date_created` (`date_created`),
ADD KEY `domain` (`domain`),
ADD KEY `rating` (`rating`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
ADD PRIMARY KEY (`country_id`),
ADD UNIQUE KEY `iso_2` (`iso`),
ADD KEY `iso` (`iso`);

--
-- Indexes for table `custom_properties`
--
ALTER TABLE `custom_properties`
ADD PRIMARY KEY (`property_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
MODIFY `bookmark_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;
