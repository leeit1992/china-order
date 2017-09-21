<?php
namespace App\Model;

use Atl\Database\Model;

class OptionModel extends Model
{	

	public function __construct(){
		parent::__construct('options');
	}

	public function setOption( $metaKey, $meta_value ){

		$checkMeta = $this->getOption( $metaKey, true );

		if( is_array( $meta_value ) ) {
			$meta_value = json_encode( $meta_value );
		}

		if( empty( $checkMeta ) ) {
			$this->db->insert(
				$this->table,
				[
					"option_key"   => $metaKey,
					"option_value" => $meta_value,
				]
			);
		}else{
			$this->db->update(
				$this->table,
				["option_value" => $meta_value],
				[
					"option_key" => $metaKey,
				]
			);
		}
	}

	public function getOption( $metaKey, $checkKey = false ){
		$data = $this->db->select(
			$this->table, 
				["option_key", "option_value"], 
				[
					'option_key' => $metaKey,
				]
			);

		if( $checkKey ) {
			if( !isset( $data[0]['option_key'] ) ) {
				return null;
			}else{
				return $data[0]['option_key'];
			}
		}

		if( empty( $data ) ) {
			return null;
		}

		return $data[0]['option_value'];
	}

}