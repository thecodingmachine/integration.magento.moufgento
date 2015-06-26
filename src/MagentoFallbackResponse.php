<?php
namespace Mouf\Integration\Magento;

use Zend\Diactoros\Response;

class MagentoFallbackResponse extends Response {

    public function __construct() {
        // Let's overload the constructor so that nothing is called (for performance)
    }
}