<?php
namespace App\Model;

use Atl\Database\Model;

class ExpenditureModel extends Model
{
   

    public function __construct()
    {
        parent::__construct('expenditure');
    }

    public function save($argsData, $id = null)
    {

        if ($id) {
            $this->db->update(
                $this->table,
                $argsData,
                [ 'id' => $id ]
            );
            return $id;
        } else {
            $this->db->insert(
                $this->table,
                $argsData
            );

            return $this->db->id();
        }
    }

    public function getAll()
    {
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


    public function getBy($key, $value)
    {
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

        /**
     * Handle search by key in User tool
     * 
     * @param  string $key  Key search value.
     * @return void
     */
    public function searchByUserT( $array = [] ){
        $condi = [];
        if (!empty($array['avt_userT_revenueExpen_code'])) {
            $condi['"order_code[~]"'] = $array['avt_userT_revenueExpen_code'];
        }
        if (!empty($array['avt_userT_revenueExpen_date'])) {
            $condi['"date[~]"'] = $array['avt_userT_revenueExpen_date'];
        }
        return $this->db->select(
            $this->table,
            [
                "[><]orders" => [ "order_id" => "id" ],
            ],
            '*',
            $condi
        );
    }
}
