<?php

namespace App\Models;

use CodeIgniter\Model;

class LibraryUsersModel extends Model
{
    protected $table = 'libraries_users';
    protected $allowedFields = ['library_id','user_id'];

    public function getLibrariesByUser($id)
    {
      $db      = \Config\Database::connect();
      $builder = $db->table('libraries_users');
      $builder->select('libraries_users.library_id as library_id, libraries.name, libraries_users.user_id as user_id');
      $builder->join('libraries', 'libraries_users.library_id = libraries.id', 'LEFT');
      $builder->where('libraries_users.user_id',$id);
      $query = $builder->get();
      return $query->getResult('array');
    }

}