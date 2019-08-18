<?php
namespace Raccoon\Bloggers\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface {
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0) {
          $installer->run('CREATE TABLE `bloggers` (
                                        `id` int(11) NOT NULL,
                                        `username` varchar(255) NOT NULL,
                                        `fullname` varchar(255) NOT NULL,
                                        `link` TEXT NOT NULL,
                                        `profile_image` varchar(255) NOT NULL,
                                        `image` varchar(255) NOT NULL,
                                        `description` varchar(255) NOT NULL,
                                        `skus` varchar(255) NOT NULL,
                                        `is_enabled` tinyint(1) NOT NULL
                                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8'
          );
          $installer->run('ALTER TABLE `bloggers` ADD PRIMARY KEY (`id`)');
          $installer->run('ALTER TABLE `bloggers` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        }

        $installer->endSetup();
    }
}