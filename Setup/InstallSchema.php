<?php

namespace Raccoon\Bloggers\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0){

		$installer->run('-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2019-03-12 18:11:21
-- 服务器版本： 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.2.16-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\"');
$installer->run('SET time_zone = \"+00:00\"');
$installer->run('/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */');
$installer->run('/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */');
$installer->run('/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */');
$installer->run('/*!40101 SET NAMES utf8mb4 */');
$installer->run('--
-- Database: `magento2.3_repeat`
--

-- --------------------------------------------------------

--
-- 表的结构 `bloggers`
--

CREATE TABLE `bloggers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `skus` varchar(255) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8');
$installer->run('--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloggers`
--
ALTER TABLE `bloggers`
  ADD PRIMARY KEY (`id`)');
$installer->run('--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bloggers`
--
ALTER TABLE `bloggers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
$installer->run('/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */');
$installer->run('/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */');
$installer->run('/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */');


		

		}

        $installer->endSetup();

    }
}