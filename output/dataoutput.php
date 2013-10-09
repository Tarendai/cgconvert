<?php

namespace Tomjn\Cgconvert\Output;

interface DataOutput {
	public function __construct( \Tomjn\Cgconvert\DataModel $model );
	public function get_string();
}