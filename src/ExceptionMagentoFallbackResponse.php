<?php

namespace Mouf\Integration\Magento;

class ExceptionMagentoFallbackResponse extends MagentoFallbackResponse {
	
	private $e;
	
	public function __construct(\Exception $e) {
		$this->e = $e;
	}
	
	public function getException() {
		return $this->e;
	}
}