<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'events';
    protected $allowedFields = ['name'];

    public function getEvents()
    {
      return $this->orderBy('name')->findAll();
    }

    public function getEvent($id)
    {
      return $this->where('id', $id)->first();
    }
}