<?php

namespace App\Models;

use CodeIgniter\Model;

class GameModel extends Model
{
    protected $table = 'games';
    protected $allowedFields = ['name', 'min_players','max_players','description','thumb_url','image_url','rules_url','bga_id','min_age','upc','min_playtime','max_playtime'];

    public function getGames()
    {
          return $this->orderBy('name')->findAll();
    }

    public function getGamesByAll($str)
    {
        return $this->orderBy('name')->like('name', $str)->orLike('upc', $str)->findAll();
    }

    public function getGame($id)
    {
        return $this->where('upc', $id)->first();
    }

}