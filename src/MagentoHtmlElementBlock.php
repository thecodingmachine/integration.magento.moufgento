<?php
namespace Mouf\Integration\Magento;
use Mouf\Html\HtmlElement\HtmlElementInterface;

/**
 * This class is an adapater between Magento blocks and Mouf blocks
 */
class MagentoHtmlElementBlock extends \Mage_Core_Block_Template {

    /**
     * @var HtmlElementInterface
     */
    private $block;


    public function __construct(HtmlElementInterface $block)
    {
        $this->block = $block;
        parent::__construct();
    }

    public function _toHtml() {
        $this->block->toHtml();
    }

    public function getMoufBlock() {
    	return $this->block;
    }
}