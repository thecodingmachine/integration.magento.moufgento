<?php
use Mouf\Html\Utils\WebLibraryManager\WebLibrary;
/* @var $object WebLibrary  */

$headBlock = Mage::app()->getLayout()->getBlock('head');
/* @var $headBlock Mage_Page_Block_Html_Head */

foreach ($object->getJsFiles() as $file) {

    if(strpos($file, 'http://') === false && strpos($file, 'https://') === false && strpos($file, '/') !== 0) {
        $headBlock->addJs('../'.$file);
    } else {
        throw new \Exception('Management of external JS files not implemented yet in Moufgento. Unable to insert '.$file);
    }
}
