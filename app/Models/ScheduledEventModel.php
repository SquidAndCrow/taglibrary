<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleEventModel extends Model
{
    protected $table = 'scheduled_events';
    protected $allowedFields = ['name','event_id'];

}