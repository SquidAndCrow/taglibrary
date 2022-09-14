<?php

namespace App\Models;

use CodeIgniter\Model;

class LibraryModel extends Model
{
    protected $table = 'games_libraries';
    protected $allowedFields = ['game_id','user_id'];

    public function getLibrary($id)
    {
      $db      = \Config\Database::connect();
      $builder = $db->table('libraries_users');
      $builder->select('games_libraries.id as games_libraries_id, games.*, event_library.id as library_id, events.name as event_name, libraries_users.id as library_users_id');
      $builder->join('games_libraries', 'libraries_users.library_id = games_libraries.library_id', 'LEFT');
      $builder->join('games', 'games_libraries.game_id = games.upc');
      $builder->join('event_library', 'event_library.games_libraries_id = games_libraries.id', 'LEFT');
      $builder->join('events', 'event_library.event_id = events.id', 'LEFT');
      $builder->orderBy('games.name');
      $builder->where('libraries_users.user_id',$id);
      $query = $builder->get();
      return $query->getResult('array');
    }

    public function getLibraryItem($id)
    {
      $db      = \Config\Database::connect();
      $builder = $db->table('games_libraries');
      $builder->select('games_libraries.id as games_libraries_id, games.*, event_library.id as library_id, events.name as event_name');
      $builder->join('games', 'games_libraries.game_id = games.upc');
      $builder->join('event_library', 'event_library.games_libraries_id = games_libraries.id', 'LEFT');
      $builder->join('events', 'event_library.event_id = events.id', 'LEFT');
      $builder->orderBy('games.name');
      $builder->where('games_libraries.id',$id);
      $query = $builder->get();
      return $query->getResult('array');
    }

}