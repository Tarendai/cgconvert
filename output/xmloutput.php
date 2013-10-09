<?php

namespace Tomjn\Cgconvert\Output;

class XmlOutput implements DataOutput {
	public function __construct( \Tomjn\Cgconvert\DataModel $model ) {
		$this->model = $model;
	}
	public function get_string() {
		$items = $this->model->get_items();
		$xml = new \SimpleXMLElement( '<entries/>' );
		foreach ( $items as $item ) {
			$element = $xml->addChild( 'entry' );
			foreach ( $item as $key => $value ) {
				if ( is_array( $value ) ) {
					$field_el = $element->addChild( $key );
					foreach ( $value as $key_2 => $value_2 ) {
						$field_el->addChild( $key_2, $value_2 );
					}
				} else {
					$element->addChild( $key, $value );
				}
			}
		}
		$result = $xml->asXML();
		return $result;
	}
}