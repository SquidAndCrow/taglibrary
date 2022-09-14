<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\OwnerModel;
use CodeIgniter\Controller;

class Home extends Controller
{
	public function index()
	{
		$data['title'] = "TAG Events";

		$model = new GameModel();
		$data['games'] = $model->getGames();

		echo view('templates/header');
    echo view('home/index', $data);
    echo view('templates/footer');
	}

	public function tagLibrary()
	{
		$data['title'] = "Complete TAG Library";

		$model = new GameModel();
		$data['games'] = $model->getGames();

		echo view('templates/header');
		echo view('home/taglibrary', $data);
		echo view('templates/footer');
	}

	public function game($id) {
		$model = new GameModel();
		$data['games'] = $model->getGame($id);
		$data['id'] = $id;

		echo view('templates/header');
    echo view('home/game', $data);
    echo view('templates/footer');
	}
}
