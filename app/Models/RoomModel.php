<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table = 'rooms';
    protected $allowedFields = ['name','event_id'];

    public function getRoomsByEvent($id)
    {
      $db      = \Config\Database::connect();
      $builder = $db->table('rooms');
      $builder->select('*');
      $builder->where('event_id',$id);
      $query = $builder->get();
      return $query->getResult('array');
    }

    public function getRoom($id)
    {
      $db      = \Config\Database::connect();
      $builder = $db->table('rooms');
      $builder->select('*');
      $builder->where('id',$id);
      $query = $builder->get();
      return $query->getResult('array');
    }
}