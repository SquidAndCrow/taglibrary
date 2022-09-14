<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name'];

    public function getUsers()
    {
          return $this->findAll();
    }

    public function getUser($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getCurators() {
      return $this->where('isCurator', 1)->findAll();
    }

}