<?php

namespace Tomjn\Cgconvert\Input;

class CsvInput implements DataInput {
	public function __construct( \Tomjn\Cgconvert\DataModel $model ) {
		$this->model = $model;
	}
	public function process_string( $string ) {
		$rows = explode( "\n", $string );
		$header = false;
		foreach ( $rows as $row ) {
			if ( !$header ) {
				$header = $this->explode_row( $row );
			} else {
				if ( !empty( $row ) ) {
					$fields = $this->explode_row( $row );
					$item = array_combine( $header, $fields );
					$this->model->add_item( $item );
				}
			}
		}
	}

	private function explode_row( $row ) {
		$fields = explode( ',', $row );
		$fields = array_map( 'trim', $fields );
		return $fields;
	}
}