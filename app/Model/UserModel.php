<?php
namespace App\Model;

use Atl\Database\Model;
use App\Model\AtlModel;

class UserModel extends AtlModel
{	

	public function __construct(){
		parent::__construct('users');
	}

	/**
	 * Sett meta table.
	 * 
	 * @return string
	 */
	public function metaDataTable(){
		return 'usermeta';
	}

	/**
	 * Set meta query.
	 * 
	 * @return stirng
	 */
	public function metaDataQueryBy(){
		return 'user_id';
	}

	/**
	 * Check login to system.
	 * 
	 * @param  string $acc   Account name user.
	 * @param  [type] $pass  Account pass Account.
	 * @return [type]        [description]
	 */
	public function checkLogin($acc, $pass){
		return $this->db->select(
			$this->table, 
				["id", "user_name", "user_email"], 
				[
					"user_email"    => $acc,
					"user_password" => $pass,
				]
			);
	}

	/**
	 * Check login to system.
	 * 
	 * @param  string $acc   Account name user.
	 * @param  [type] $pass  Account pass Account.
	 * @return [type]        [description]
	 */
	public function checkLoginAdmin($acc, $pass){
		return $this->db->select(
			$this->table, 
				["id", "user_name", "user_email"], 
				[
					"user_email"    => $acc,
					"user_password" => $pass,
					"user_role" => 1,
				]
			);
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
	 * Handle query get user by column.
	 * 
	 * @param  stirng $key   Column key
	 * @param  string $value Condition query
	 * @return array
	 */
	public function getUserBy( $key, $value ){
		return $this->db->select(
			$this->table, 
				'*', 
				[
					$key => $value,
				]
			);
	}

	/**
	 * Handle get limit user
	 * 
	 * @param  int 	  	$start Start query.
	 * @param  int 		$limit Number of row result.
	 * @return array
	 */
	public function getUserLimit( $start, $limit ){
		return $this->db->select(
			$this->table, 
				'*', 
				[
					'LIMIT' => [$start, $limit],
				]
			);
	}

	/**
	 * Handle get list user
	 * 
	 * @param  int 	  	$start Start query.
	 * @param  int 		$limit Number of row result.
	 * @return array
	 */
	public function getUserList( ){
		return $this->db->select(
			$this->table, 
				'*'
			);
	}

	public function count( $condition = [] ){
		return $this->db->count($this->table, $condition);
	}

	/**
	 * Handle get all user by meta key and meta value.
	 * 
	 * @param  string $metakey   Meta key of user.
	 * @param  string $metaValue Meta value of user.
	 * @return array
	 */
	public function getAllUserByMeta( $metakey, $metaValue = null ){
		$listUser = $this->db->select(
			$this->table, 
				'*'
			);

		$argsUsers = array();
		foreach ($listUser as $user) {
			$userMeta = $this->getAllMetaData( $user['id'] );

			if( $metaValue ) {
				if( $userMeta[$metakey] === $metaValue ) {

					foreach ($userMeta as $uMkey => $uMValue) {
						$user[$uMkey] = $uMValue;
					}

					$argsUsers[] = $user;
				}
			}else{
				foreach ($userMeta as $uMkey => $uMValue) {
						$user[$uMkey] = $uMValue;
					}

				$argsUsers[] = $user;
			}
			
		}

		return $argsUsers;
	}

	/**
	 * Handle remove user
	 * 
	 * @param  int | array $args Data id user
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

		/**
	 * Check pass.
	 * 
	 * @param  int $id   Account user.
	 * @param  [string] $pass  Account pass.
	 * @return [type]        [description]
	 */
	public function checkPassword($id, $pass){
		return $this->db->select(
			$this->table, 
				["id", "user_name", "user_email"], 
				[
					"id"    => $id,
					"user_password" => $pass,
				]
			);
	}
}