<?php
/*
 * Copyright (c) 2015 David Negrier
 *
 * See the file LICENSE.txt for copying permission.
 */

namespace Mouf\Integration\Magento;

use Mouf\Installer\PackageInstallerInterface;
use Mouf\MoufManager;
use Mouf\Actions\InstallUtils;
use Mouf\Html\Renderer\ChainableRendererInterface;

/**
 * The installer for Moufgento.
 */
class MoufgentoInstaller implements PackageInstallerInterface {

    /**
     * (non-PHPdoc)
     * @see \Mouf\Installer\PackageInstallerInterface::install()
     */
    public static function install(MoufManager $moufManager) {

        // These instances are expected to exist when the installer is run.
        $defaultWebLibraryManager = $moufManager->getInstanceDescriptor('defaultWebLibraryManager');
        $defaultRenderer = $moufManager->getInstanceDescriptor('defaultRenderer');
        $apcCacheService = $moufManager->getInstanceDescriptor('apcCacheService');

        // Let's create the instances.
        $magentoTemplate = InstallUtils::getOrCreateInstance('magentoTemplate', 'Mouf\\Integration\\Magento\\MagentoTemplate', $moufManager);
        $block_content = InstallUtils::getOrCreateInstance('block.content', 'Mouf\\Html\\HtmlElement\\HtmlBlock', $moufManager);
        $block_left = InstallUtils::getOrCreateInstance('block.left', 'Mouf\\Html\\HtmlElement\\HtmlBlock', $moufManager);
        $block_right = InstallUtils::getOrCreateInstance('block.right', 'Mouf\\Html\\HtmlElement\\HtmlBlock', $moufManager);
        $block_header = InstallUtils::getOrCreateInstance('block.header', 'Mouf\\Html\\HtmlElement\\HtmlBlock', $moufManager);
        $block_footer = InstallUtils::getOrCreateInstance('block.footer', 'Mouf\\Html\\HtmlElement\\HtmlBlock', $moufManager);
        $defaultRouter = InstallUtils::getOrCreateInstance('defaultRouter', 'Mouf\\Mvc\\Splash\\Routers\\SplashDefaultRouter', $moufManager);

        // Let's bind instances together.
        if (!$magentoTemplate->getSetterProperty('setTemplate')->isValueSet()) {
            $magentoTemplate->getSetterProperty('setTemplate')->setValue('page/2columns-left.phtml');
        }
        if (!$magentoTemplate->getSetterProperty('setBlocks')->isValueSet()) {
            $magentoTemplate->getSetterProperty('setBlocks')->setValue(array('left' => $block_left, 'right' => $block_right, 'header' => $block_header, 'footer' => $block_footer, ));
        }
        if (!$magentoTemplate->getSetterProperty('setContent')->isValueSet()) {
            $magentoTemplate->getSetterProperty('setContent')->setValue($block_content);
        }
        if (!$magentoTemplate->getSetterProperty('setWebLibraryManager')->isValueSet()) {
            $magentoTemplate->getSetterProperty('setWebLibraryManager')->setValue($defaultWebLibraryManager);
        }
        if (!$magentoTemplate->getSetterProperty('setDefaultRenderer')->isValueSet()) {
            $magentoTemplate->getSetterProperty('setDefaultRenderer')->setValue($defaultRenderer);
        }
        if (!$defaultRouter->getConstructorArgumentProperty('cacheService')->isValueSet()) {
            $defaultRouter->getConstructorArgumentProperty('cacheService')->setValue($apcCacheService);
        }

        $moufgentoRenderer = InstallUtils::getOrCreateInstance("moufgentoRenderer", "Mouf\\Html\\Renderer\\FileBasedRenderer", $moufManager);
        $moufgentoRenderer->getProperty("directory")->setValue("vendor/mouf/integration.magento.moufgento/src/templates");
        $moufgentoRenderer->getProperty("cacheService")->setValue($moufManager->getInstanceDescriptor("rendererCacheService"));
        $moufgentoRenderer->getProperty("type")->setValue(ChainableRendererInterface::TYPE_TEMPLATE);
        $moufgentoRenderer->getProperty("priority")->setValue(0);
        $magentoTemplate->getProperty("templateRenderer")->setValue($moufgentoRenderer);

        if ($moufManager->has('userService')) {
            // Remove user service installed by default.
            $moufManager->removeComponent('userService');
        }
        InstallUtils::getOrCreateInstance('userService', 'Mouf\\Integration\\Magento\\MagentoUserService', $moufManager);

        // Let's rewrite the MoufComponents.php file to save the component
        $moufManager->rewriteMouf();
    }
}
