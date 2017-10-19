<?php
namespace App\Model;

use Atl\Database\Model;

class OrderModel extends Model
{	

	public function __construct(){
		parent::__construct('orders');
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

	public function getAll(){
		return $this->db->select(
			$this->table, 
				'*', 
				[	
					'ORDER' => [
						'id' => 'DESC'
					]
				]
			);
	}


	public function getBy($key, $value){
		return $this->db->select(
			$this->table, 
				'*', 
				[	
					$key => $value,
					'ORDER' => [
						'id' => 'DESC'
					]
				]
			);
	}

	public function getByRestPercent() {
		return $this->db->select(
			$this->table, 
				'*', 
				[
					'order_info_pay[~]' => ':0,',
					'ORDER' => [
						'id' => 'DESC'
					]
				]
			);
	}

	/**
	 * Handle search by key in Admcp
	 * 
	 * @param  string $key  Key search value.
	 * @return void
	 */
	public function searchByAdmcp( $array = [] ){
		$condi = [];
		if (!empty($array['avt_admcp_order_code'])) {
			$condi['"order_code[~]"'] = $array['avt_admcp_order_code'];
		}
		if (!empty($array['avt_admcp_order_date'])) {
			$condi['"order_date[~]"'] = $array['avt_admcp_order_date'];
		}
		return $this->db->select(
			$this->table,
			'*',
			$condi
		);
	}

	/**
	 * Handle search by key in UserTool
	 * 
	 * @param  string $key  Key search value.
	 * @return void
	 */
	public function searchByUserT( $array = [] ){
		$condi = [];
		if (!empty($array['avt_userT_order_date'])) {
			$condi['"order_date[~]"'] = $array['avt_userT_order_date'];
		}
		return $this->db->select(
			$this->table,
			'*',
			$condi
		);
	}
}
