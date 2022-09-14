<?php

namespace App\Models;

use CodeIgniter\Model;

class EventLibraryModel extends Model
{
    protected $table = 'event_library';
    protected $allowedFields = ['event_id','games_libraries_id'];

    public function getLibraryByEvent($id)
    {
      $db      = \Config\Database::connect();
      $builder = $db->table('games_libraries');
      $builder->select('games_libraries.id as games_libraries_id, games.*, event_library.id as library_id, events.name as event_name, checkin_checkout.id as cico_id, checkin_checkout.checkin as checkin, checkin_checkout.checkout as checkout, checkin_checkout.badge_hash as badge_hash');
      $builder->join('games', 'games_libraries.game_id = games.upc');
      $builder->join('event_library', 'event_library.games_libraries_id = games_libraries.id', 'LEFT');
      $builder->join('events', 'event_library.event_id = events.id', 'LEFT');
      $builder->join('(select * from checkin_checkout order by id desc limit 1) as checkin_checkout', 'event_library.id = checkin_checkout.event_library_id', 'LEFT');
      $builder->orderBy('games.name');
      $builder->where('event_library.event_id',$id);
      $query = $builder->get();
      return $query->getResult('array');
    }
}