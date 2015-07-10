<?php
use Mouf\Html\Utils\WebLibraryManager\InlineWebLibrary;
use Mouf\Html\HtmlElement\HtmlString;
use Mouf\Integration\Magento\MagentoHtmlElementBlock;
/* @var $object Mouf\Html\Utils\WebLibraryManager\InlineWebLibrary */
$cssElement = $object->getCssElement();
if (!$cssElement) {
	return;
}

$headBlock = Mage::app()->getLayout()->getBlock('head');
/* @var $headBlock Mage_Page_Block_Html_Head */
$moufBlock = null;
/**
 * TODO Add the block from xml, to add it just after the displaying of css files. ( and to prevent copy/paste)
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

ob_start();
$cssElement->toHtml();
$html = ob_get_contents();
ob_end_clean();
$moufBlock->htmlString .= $html;