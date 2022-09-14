<?php

namespace App\Models;

use CodeIgniter\Model;

class TableModel extends Model
{
    protected $table = 'tables';
    protected $allowedFields = ['name','event_id','time_block','room_id','seats'];

    public function getTablesByEvent($id)
    {
      $db      = \Config\Database::connect();
      $builder = $db->table('tables');
      $builder->select('*');
      $builder->where('event_id',$id);
      $query = $builder->get();
      return $query->getResult('array');
    }

    public function getTablesByRoom($id)
    {
      $db      = \Config\Database::connect();
      $builder = $db->table('tables');
      $builder->select('*');
      $builder->where('room_id',$id);
      $query = $builder->get();
      return $query->getResult('array');
    }
}