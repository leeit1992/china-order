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
}
