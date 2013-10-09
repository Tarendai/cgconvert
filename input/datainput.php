<?php

namespace Tomjn\Cgconvert\Input;

interface DataInput {
	public function __construct( \Tomjn\Cgconvert\DataModel $model );
	public function process_string( $string );
}