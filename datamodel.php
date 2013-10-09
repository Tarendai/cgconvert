<?php

namespace Tomjn\Cgconvert;

class DataModel {
	private $items;
	public function __construct() {
		$this->items = array();
	}

	public function split_underscores( $arr ) {
		$data = array();
		foreach ( $arr as $key => $value ) {
			$pos = strpos( $key, '_' );
			if ( $pos !== false ) {
				$mkey = substr( $key, 0, $pos );
				if ( !isset( $data[ $mkey ] ) ) {
					$data[ $mkey ] = array();
				}
				$data[ $mkey ][$key ] = $value;
			} else {
				$data[ $key ] = $value;
			}
		}
		return $data;
	}

	public function add_item( $item ) {
		$final_item = $this->split_underscores( $item );
		$this->items[] = $final_item;
	}

	public function get_items() {
		return $this->items;
	}
}