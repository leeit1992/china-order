<?php

namespace app\Model;

use Atl\Database\Model;

class NoticeModel extends Model
{
    public function __construct()
    {
        parent::__construct('notices');
    }

    public function save($argsData, $id = null)
    {
        if ($id) {
            $this->db->update(
                $this->table,
                $argsData,
                ['id' => $id]
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
                        'id' => 'DESC',
                    ],
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
                    'id' => 'DESC',
                ],
            ]
        );
    }

    public function getByArray( $array = [] )
    {
        $condi = [];
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $condi['"'.$key.'"'] = $value;
            }
        }
        return $this->db->select(
            $this->table,
            '*',
            $condi
        );
    }

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
