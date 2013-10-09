<?php

namespace Tomjn\Cgconvert\Input;

class JsonInput implements DataInput {
	public function __construct( \Tomjn\Cgconvert\DataModel $model ) {
		$this->model = $model;
	}
	public function process_string( $string ) {
		return json_decode( $string );
	}
}