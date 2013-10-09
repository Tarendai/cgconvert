<?php

namespace Tomjn\Cgconvert\Output;

class CsvOutput implements DataOutput {
	public function __construct( \Tomjn\Cgconvert\DataModel $model ) {
		$this->model = $model;
	}
	public function get_string() {
		$items = $this->model->get_items();
		$displayed_headers = false;
		$data = '';
		foreach ( $items as $item ) {
			if ( !$displayed_headers ) {
				$headers = array();
				foreach ( $item as $key => $value ) {
					if ( is_array( $value ) ) {
						foreach ( $value  as $subkey => $subvalue ) {
							$headers[] = $subkey;
						}
					} else {
						$headers[] = $key;
					}
				}
				$data .= implode( ',', $headers )."\n";
				$displayed_headers = true;
			}
			$line = array();
			foreach ( $item as $key => $value ) {
				if ( is_array( $value ) ) {
					foreach ( $value  as $subkey => $subvalue ) {
						$line[] = $subvalue;
					}
				} else {
					$line[] = $value;
				}
			}
			$data .= implode( ',', $line )."\n";
		}
		return $data;
	}
}