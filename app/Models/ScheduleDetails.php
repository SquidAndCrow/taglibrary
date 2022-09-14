<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleDetailsModel extends Model
{
    protected $table = 'schedule_details';
    protected $allowedFields = ['name','max_players','description','need_library_copy','host','requested_date','requested_start','requested_end'];

    public function getDetails($id)
    {
      $db      = \Config\Database::connect();
      $builder = $db->table('schedule_details');
      $builder->select('*');
      $builder->where('id',$id);
      $query = $builder->get();
      return $query->getResult('array');
    }
}