<?php

namespace Tomjn\Cgconvert\Output;

class JsonOutput implements DataOutput {
	public function __construct( \Tomjn\Cgconvert\DataModel $model ) {
		$this->model = $model;
	}
	public function get_string() {
		return json_encode( $this->model->get_items(), ( JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) );
	}
}