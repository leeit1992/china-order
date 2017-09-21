<?php
namespace App\Model;

use Atl\Database\Model;

class OrderItemModel extends Model
{	

	public function __construct(){
		parent::__construct('order_items');
	}

	public function save( $argsData, $id = null ){

		if( $id ){
			$this->db->update(
				$this->table, 
				$argsData,
				[ 'id' => $id ]
			);
			return $id;
		}else{
			$this->db->insert(
				$this->table, 
				$argsData
			);

			return $this->db->id();
		}
	}


}