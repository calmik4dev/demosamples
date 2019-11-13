<?php
namespace Dynamic\DynamicVideos\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
class UpgradeSchema implements  UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup,
                            ModuleContextInterface $context){
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.2') < 0) {
            $setup->run("ALTER TABLE `dynamic_videos` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;");
        }

        $setup->endSetup();
    }
}
