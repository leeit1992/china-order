<?php
namespace App\Model;

use Atl\Database\Model;
use App\Model\AtlModel;

class PageModel extends Model
{	

	public function __construct(){
		parent::__construct('pages');
	}

	/**
	 * Insert | Update data user.
	 * 
	 * @param  array  $argsData Array data insert | update
	 * @param  int    $id       User id
	 * @return array
	 */
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

	/**
	 * Handle query get page by column.
	 * 
	 * @param  stirng $key   Column key
	 * @param  string $value Condition query
	 * @return array
	 */
	public function getPageBy( $key, $value ){
		return $this->db->select(
			$this->table, 
				'*', 
				[
					$key => $value,
				]
			);
	}

	/**
	 * Handle get limit page
	 * 
	 * @param  int 	  	$start Start query.
	 * @param  int 		$limit Number of row result.
	 * @return array
	 */
	public function getPageLimit( $start, $limit ){
		return $this->db->select(
			$this->table, 
				'*', 
				[
					'LIMIT' => [$start, $limit],
				]
			);
	}

	public function getFeaturesList(){
		return $this->db->select(
			$this->table, 
				'*', 
				[
					'page_featured' => 1,
					'LIMIT' => [0, 3]
				]
			);
	}
	/**
	 * Handle get list Page
	 * 
	 * @param  int 	  	$start Start query.
	 * @param  int 		$limit Number of row result.
	 * @return array
	 */
	public function getPageList(){
		return $this->db->select(
			$this->table, 
				'*'
			);
	}

	public function getMenuList(){
		return $this->db->select(
			$this->table, 
				'*', 
				[
					'page_menu' => 1,
					'ORDER' => [
						'page_order' => 'ASC'
					]
				]
			);
	}

	public function count( $condition = [] ){
		return $this->db->count($this->table, $condition);
	}

	/**
	 * Handle remove Page
	 * 
	 * @param  int | array $args Data id Page
	 * @return void
	 */
	public function delete( $args ){
		return $this->db->delete(
			$this->table,
			[
			"AND" => [
				"id" => $args,
			]
		]);
	}
}
