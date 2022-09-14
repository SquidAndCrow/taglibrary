<?php

namespace App\Controllers;

use App\Models\CharacterModel;

class Api extends BaseController
{

  public function index()
	{
		return "hi";
	}

  public function getCharacters($id = false) {
    $model = new CharacterModel();

    $data = [
        'characters'  => $model->getCharacters($id),
    ];

    echo json_encode($data['characters']);
  }
}
