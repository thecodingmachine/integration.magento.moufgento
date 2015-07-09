<?php
use Mouf\Html\Utils\WebLibraryManager\WebLibrary;
use Mouf\Html\HtmlElement\HtmlString;
use Mouf\Integration\Magento\MagentoHtmlElementBlock;
/* @var $object WebLibrary  */

$headBlock = Mage::app()->getLayout()->getBlock('head');
/* @var $headBlock Mage_Page_Block_Html_Head */
/**
 * TODO Check with merged 
 */

$moufBlock = null;
/**
 * TODO Add the block from xml, to add it just after the displaying of css files. ( and to prevent copy/paste) (override head.phtml, and the xml)
 */
$magentoBlock = $headBlock->getChild("moufcssblock");
if ($magentoBlock === false) {
	$moufBlock = new HtmlString("");
	$magentoBlock = new MagentoHtmlElementBlock($moufBlock);
	$headBlock->append($magentoBlock, "moufcssblock");
}
else {
	$moufBlock = $magentoBlock->getMoufBlock();
	if (!($moufBlock instanceof HtmlString)) {
		throw new MoufgentoException("The Mouf block of the head-blocks child named moufjsblock is not a HtmlString");
	}
}

$shouldMergeCss = Mage::getStoreConfigFlag('dev/css/merge_css_files');

foreach ($object->getCssFiles() as $file) {
	    if(strpos($file, 'http://') === false && strpos($file, 'https://') === false && strpos($file, '/') !== 0) {
	    	if (!$shouldMergeCss) {
	        	$headBlock->addCss('../../../../'.$file);
	    	}
	    	else {
	    		$moufBlock->htmlString .= '<link rel="stylesheet" type="text/css" href="'.htmlspecialchars(ROOT_URL.$file, ENT_QUOTES).'" media="all" />'."\n";
	    	}
	    } else {
	        $headBlock->addLinkRel("stylesheet", $file);
	    }

}
