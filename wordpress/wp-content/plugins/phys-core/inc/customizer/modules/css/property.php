<?php
namespace PhysCode\Customizer\Modules\CSS;

class Property {

	protected $property;

	protected $value;

	public function __construct( $property, $value ) {
		$this->property = $property;
		$this->value    = $value;
		$this->process_value();
	}

	protected function process_value() {

	}

	public function get_value() {
		return $this->value;
	}
}
