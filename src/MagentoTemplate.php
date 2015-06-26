<?php
namespace Mouf\Integration\Magento;


use Mouf\Html\HtmlElement\HtmlElementInterface;
use Mouf\Html\Template\BaseTemplate\BaseTemplate;

class MagentoTemplate extends BaseTemplate {

    private $toHtmlTriggered = false;

    /**
     * @var array<string, HtmlElementInterface>
     */
    private $blocks = array();

    /**
     * The "magento" path to the template.
     * Defaults to : "page/3columns.html".
     *
     * Use "page/1column.html", "page/2columns-left.html", "page/2columns-right.html" or any other template
     * defined in Magento.
     *
     * @var string
     */
    private $template = "page/3columns.phtml";


    /**
     * The Magento layout (in case we want to do Magento specific stuff directly in the controller).
     *
     * @var Mage_Core_Model_Layout
     */
    private $layout;

    public function isToHtmlTriggered() {
        return $this->toHtmlTriggered;
    }

    /**
     * @return HtmlElementInterface
     */
    public function getContent()
    {
        return $this->content;
    }

    public function toHtml() {
        $this->toHtmlTriggered = true;
        $this->getDefaultRenderer()->setTemplateRenderer($this->getTemplateRenderer());
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * The "magento" path to the template.
     * Defaults to : "page/3columns.html".
     *
     * Use "page/1column.phtml", "page/2columns-left.phtml", "page/2columns-right.phtml" or any other template
     * defined in Magento.
     *
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @return HtmlElementInterface[]
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * @param array<string, HtmlElementInterface> $blocks
     */
    public function setBlocks($blocks)
    {
        $this->blocks = $blocks;
    }

    /**
     * The Magento layout (in case we want to do Magento specific stuff directly in the controller).
     * @return Mage_Core_Model_Layout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * The Magento layout (in case we want to do Magento specific stuff directly in the controller).
     * @param Mage_Core_Model_Layout $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}