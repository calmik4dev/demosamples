<?php

namespace Dynamicdd\Dynamicvideos\Setup;

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

		$installer->run('create table dynamic_videos (id int not null auto_increment,page_id int(11),block_identifier text,video_title text,video_description text,video_live_link text, video_manually_upload text, opacity text ,desktop_background_image text,mobile_background_image text,sort_order int(11),created_date DATETIME ,updated_date DATETIME ,primary key(id))');


		

		}

        $installer->endSetup();

    }
}