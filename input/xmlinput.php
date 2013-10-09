<?php

namespace Tomjn\Cgconvert\Input;

class XmlInput implements DataInput {
	public function __construct( \Tomjn\Cgconvert\DataModel $model ) {
		$this->model = $model;
	}
	public function process_string( $string ) {
		$xml = new \XMLReader();
		$xml->XML( $string );
		$arr = $this->xml2assoc( $xml );
		foreach ( $arr[ 'entries' ][0]['entry'] as $entry_value ) {
			$entry = $entry_value;
			$item = array();
			foreach ( $entry as $key => $value ) {
				$val = $value[0];
				if ( is_array( $value[0] ) ) {
					$vals = array();
					foreach ( $val as $subkey => $subval ) {
						$vals[ $subkey ] = $subval[0];
					}
					$val = $vals;
				}
				$item[$key] = $val;
			}
			$this->model->add_item( $item );
		}
	}

	public function xml2assoc( \XMLReader $xml ) {
		$assoc = null;
		while ( $xml->read() ) {
			switch ( $xml->nodeType ) {
				case \XMLReader::END_ELEMENT: return $assoc;
				case \XMLReader::ELEMENT:
					$assoc[$xml->name][] = $xml->isEmptyElement ? '' : xml2assoc( $xml );
					break;
				case \XMLReader::TEXT:
				case \XMLReader::CDATA: $assoc .= $xml->value;
			}
		}
		return $assoc;
	}
}
