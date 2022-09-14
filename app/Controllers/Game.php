<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Game extends Controller
{
	public function update($id) {
		$GameModel = new GameModel();

		if ($this->request->isAJAX()) {
			$data = [
				'name' => $this->request->getPost('name'),
				'bga_id' => $this->request->getPost('bga_id'),
				'min_players' => $this->request->getPost('min_players'),
				'max_players' => $this->request->getPost('max_players'),
				'min_playtime' => $this->request->getPost('min_playtime'),
				'max_playtime' => $this->request->getPost('max_playtime'),
				'min_age' => $this->request->getPost('min_age'),
				'thumb_url' => $this->request->getPost('thumb_url'),
				'image_url' => $this->request->getPost('image_url'),
				'rules_url' => $this->request->getPost('rules_url'),
				'description' => $this->request->getPost('description'),
				'upc' => $this->request->getPost('upc')
			];
			try
			{
			    $GameModel->update($id, $data);
			}
			catch (\Exception $e)
			{
			    die($e->getMessage());
			}

		} else {
			echo "no";
		}
	}

	public function new() {
		$GameModel = new GameModel();

		if ($this->request->isAJAX()) {
			$data = [
				'name' => $this->request->getPost('name'),
				'bga_id' => $this->request->getPost('bga_id'),
				'min_players' => $this->request->getPost('min_players'),
				'max_players' => $this->request->getPost('max_players'),
				'min_playtime' => $this->request->getPost('min_playtime'),
				'max_playtime' => $this->request->getPost('max_playtime'),
				'min_age' => $this->request->getPost('min_age'),
				'thumb_url' => $this->request->getPost('thumb_url'),
				'image_url' => $this->request->getPost('image_url'),
				'rules_url' => $this->request->getPost('rules_url'),
				'description' => $this->request->getPost('description'),
				'upc' => $this->request->getPost('upc')
			];
			try
			{
			    $GameModel->insert($data);
			}
			catch (\Exception $e)
			{
			    die($e->getMessage());
			}

		} else {
			echo "no";
		}
	}

	public function profile($id) {
		$GameModel = new GameModel();
		$data['games'] = $GameModel->getGame($id);

		echo view('templates/header');
    echo view('game/profile', $data);
    echo view('templates/footer');
	}

	public function getGamesByAll($id) {
		$GameModel = new GameModel();
		$data['games'] = $GameModel->getGamesByAll($id);
		echo json_encode($data['games']);
	}
}
