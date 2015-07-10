<?php
use Mouf\Html\Utils\WebLibraryManager\WebLibrary;
use Mouf\Html\HtmlElement\HtmlString;
use Mouf\Integration\Magento\MagentoHtmlElementBlock;


/* @var $object Mouf\Html\Utils\WebLibraryManager\InlineWebLibrary */
$jsElement = $object->getJsElement();
if (!$jsElement) {
	return;
}

$headBlock = Mage::app()->getLayout()->getBlock('head');
/* @var $headBlock Mage_Page_Block_Html_Head */
$moufBlock = null;
/**
 * TODO Add the block from xml, to add it just after the displaying of js files. ( and to prevent copy/paste)
 */
$magentoBlock = $headBlock->getChild("moufjsblock");
if ($magentoBlock === false) {
	$moufBlock = new HtmlString("");
	$magentoBlock = new MagentoHtmlElementBlock($moufBlock);
	$headBlock->append($magentoBlock, "moufjsblock");
}
else {
	$moufBlock = $magentoBlock->getMoufBlock();
	if (!($moufBlock instanceof HtmlString)) {
		throw new MoufgentoException("The Mouf block of the head-blocks child named moufjsblock is not a HtmlString");
	}
}

ob_start();
$jsElement->toHtml();
$html = ob_get_contents();
ob_end_clean();
$moufBlock->htmlString .= $html;