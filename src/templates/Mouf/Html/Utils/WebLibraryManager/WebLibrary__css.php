<?php
use Mouf\Html\Utils\WebLibraryManager\WebLibrary;
/* @var $object WebLibrary  */

$headBlock = Mage::app()->getLayout()->getBlock('head');
/* @var $headBlock Mage_Page_Block_Html_Head */

foreach ($object->getCssFiles() as $file) {

    if(strpos($file, 'http://') === false && strpos($file, 'https://') === false && strpos($file, '/') !== 0) {
        $headBlock->addCss('../../../../'.$file);
    } else {
        $headBlock->addLinkRel("stylesheet", $file);
    }


}
