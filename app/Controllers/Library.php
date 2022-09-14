<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\GameModel;
use App\Models\LibraryModel;
use App\Models\LibraryUsersModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Library extends Controller
{
	public function index($id) {
		$libraryModel = new LibraryModel();
		$eventModel = new EventModel();
		$data['games']= $libraryModel->getLibrary($id);
		$data['user_id'] = $id;
		$data['events'] = $eventModel->getEvents();

		echo view('templates/header');
    echo view('library/index', $data);
    echo view('templates/footer');
	}

	public function new(){
		$libraryUsersModel = new LibraryUsersModel();
		$data['libraries'] = $libraryUsersModel->getLibrariesByUser(1);

		echo view('templates/header');
    echo view('library/new', $data);
    echo view('templates/footer');
	}

	public function addGameToLibrary(){
		$LibraryModel = new LibraryModel();

		if ($this->request->isAJAX()) {
			$data = [
				'game_id' => $this->request->getPost('game_id'),
				'library_id' => $this->request->getPost('library_id'),
			];
			try
			{
			    $LibraryModel->insert($data);
			}
			catch (\Exception $e)
			{
			    die($e->getMessage());
			}

		} else {
			echo "no";
		}

		echo 'success';
	}
}
