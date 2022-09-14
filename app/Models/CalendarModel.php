<?php

namespace App\Models;

use CodeIgniter\Model;

class CalendarModel extends Model
{
    protected $table = 'calendar';
    protected $allowedFields = ['date','name','event_id','startTime','endTime','publicStartTime','publicEndTime'];

    public function getCalendarByEvent($id)
    {
      $db      = \Config\Database::connect();
      $builder = $db->table('calendar');
      $builder->select('*');
      $builder->orderBy('date');
      $builder->where('event_id',$id);
      $query = $builder->get();
      return $query->getResult('array');
    }
}