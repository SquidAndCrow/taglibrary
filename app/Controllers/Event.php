<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\CalendarModel;
use App\Models\RoomModel;
use App\Models\LibraryModel;
use App\Models\TableModel;
use App\Models\EventLibraryModel;
use App\Models\CICOModel;
use App\Models\GameModel;
use App\Models\OwnerModel;
use CodeIgniter\Controller;

class Event extends Controller
{
	public function index()
	{
		$data['title'] = "Event Management";

		$model = new EventModel();
		$data['events'] = $model->getEvents();

		echo view('templates/header');
    echo view('event/index', $data);
    echo view('templates/footer');
	}

	public function event($id) {
		$model = new EventModel();
		$data['event'] = $model->getEvent($id);
		$data['id'] = $id;

		echo view('templates/header');
    echo view('home/game', $data);
    echo view('templates/footer');
	}

	public function calendar($id) {
		$event = new EventModel();
		$calendar = new CalendarModel();
		$data['event'] = $event->getEvent($id);
		$data['calendar'] = $calendar->getCalendarByEvent($id);
		$data['id'] = $id;

		echo view('templates/header');
    echo view('event/calendar', $data);
    echo view('templates/footer');
	}

	public function addDay() {
		$calendar = new CalendarModel();
		if ($this->request->isAJAX()) {
			$data = [
				'event_id' => $this->request->getPost('event_id'),
				'name' => $this->request->getPost('name'),
				'startTime' => $this->request->getPost('startTime'),
				'endTime' => $this->request->getPost('endTime'),
				'date' => date('Y-m-d',strtotime($this->request->getPost('date'))),
				'publicStartTime' => $this->request->getPost('publicStartTime'),
				'publicEndTime' => $this->request->getPost('publicEndTime')
			];
			try
			{
			    $calendar->insert($data);
			}
			catch (\Exception $e)
			{
			    die($e->getMessage());
			}
			echo "success";

		} else {
			echo "no";
		}
	}

	public function rooms($id) {
		$event = new EventModel();
		$rooms = new RoomModel();
		$data['event'] = $event->getEvent($id);
		$data['rooms'] = $rooms->getRoomsByEvent($id);
		$data['id'] = $id;

		echo view('templates/header');
    echo view('event/rooms', $data);
    echo view('templates/footer');
	}

	public function addRoom() {
		$room = new RoomModel();
		if ($this->request->isAJAX()) {
			$data = [
				'event_id' => $this->request->getPost('event_id'),
				'name' => $this->request->getPost('name')
			];
			try
			{
			    $room->insert($data);
			}
			catch (\Exception $e)
			{
			    die($e->getMessage());
			}
			echo "success";

		} else {
			echo "no";
		}
	}

	public function addEvent() {
		$event = new EventModel();
		if ($this->request->isAJAX()) {
			$data = [
				'name' => $this->request->getPost('name')
			];
			try
			{
			    $event->insert($data);
			}
			catch (\Exception $e)
			{
			    die($e->getMessage());
			}
			echo "success";

		} else {
			echo "no";
		}
	}

	public function addScheduledDetails() {
		$event = new ScheduleDetails();
		if ($this->request->isAJAX()) {
			$data = [
				'name' => $this->request->getPost('name'),
				'max_players' => $this->request->getPost('max_players'),
				'description' => $this->request->getPost('description'),
				'need_library_copy' => $this->request->getPost('need_library_copy'),
				'host' => $this->request->getPost('host'),
				'requested_date' => $this->request->getPost('requested_date'),
				'requested_start' => $this->request->getPost('requested_start'),
				'requested_end' => $this->request->getPost('requested_end'),
				'event_id' => $this->request->getPost('event_id'),
			];
			try
			{
			    $event->insert($data);
			}
			catch (\Exception $e)
			{
			    die($e->getMessage());
			}
			echo "success";

		} else {
			echo "no";
		}
	}

	public function addTable() {
		$table = new TableModel();
		if ($this->request->isAJAX()) {
			$data = [
				'name' => $this->request->getPost('name'),
				'seats' => $this->request->getPost('seats'),
				'event_id' => $this->request->getPost('event_id'),
				'room_id' => $this->request->getPost('room_id'),
				'time_block' => $this->request->getPost('time_block'),
			];
			try
			{
			    $table->insert($data);
			}
			catch (\Exception $e)
			{
			    die($e->getMessage());
			}
			echo "success";

		} else {
			echo "no";
		}
	}

	public function cico($id) {
		$EventModel = new EventModel;
		$EventLibraryModel = new EventLibraryModel;

		$data['events'] = $EventModel->getEvent($id);
		$data['games'] = $EventLibraryModel->getLibraryByEvent($id);

		echo view('templates/header');
    echo view('event/cico', $data);
    echo view('templates/footer');
	}

	public function tables($eventid, $roomid) {
		$event = new EventModel();
		$room = new RoomModel();
		$tables = new TableModel();
		$data['event'] = $event->getEvent($eventid);
		$data['tables'] = $tables->getTablesByRoom($roomid);
		$data['room'] = $room->getRoom($roomid);

		echo view('templates/header');
    echo view('event/tables', $data);
    echo view('templates/footer');
	}

	public function library($id) {
		$EventModel = new EventModel;
		$EventLibraryModel = new EventLibraryModel;

		$data['events'] = $EventModel->getEvent($id);
		$data['games'] = $EventLibraryModel->getLibraryByEvent($id);

		echo view('templates/header');
    echo view('event/library', $data);
    echo view('templates/footer');
	}

	public function addGameToEventLibrary($event, $game) {
		$EventLibraryModel = new EventLibraryModel();
		$LibraryModel = new LibraryModel();

		if ($this->request->isAJAX()) {
			$data = [
				'event_id' => $event,
				'games_libraries_id' => $game,
			];
			try
			{
			    $EventLibraryModel->insert($data);
			}
			catch (\Exception $e)
			{
			    die($e->getMessage());
			}
			$data['games'] = $LibraryModel->getLibraryItem($game);
			echo view('library/game_partial', $data);

		} else {
			echo "no";
		}

	}

	public function removeGameFromEventLibrary($game, $guid) {
		$EventLibraryModel = new EventLibraryModel();
		$LibraryModel = new LibraryModel();

		if ($this->request->isAJAX()) {
			$data = [
				'id' => $game,
			];
			try
			{
			    $EventLibraryModel->delete($data);
			}
			catch (\Exception $e)
			{
			    die($e->getMessage());
			}
			$data['games'] = $LibraryModel->getLibraryItem($guid);
			echo view('library/game_partial', $data);

		} else {
			echo "no";
		}

	}

	public function gameCheckin() {
		$CICOModel = new CICOModel();

		if ($this->request->isAJAX()) {
			$data = [
				'checkin' => date('Y-m-d H:i:s')
			];
			try
			{
					$CICOModel->update($this->request->getPost('id'), $data);
			}
			catch (\Exception $e)
			{
					die($e->getMessage());
			}
			echo date('Y-m-d H:i:s');
		} else {
			echo "no";
		}
	}

	public function gameCheckout() {
		$CICOModel = new CICOModel();

		if ($this->request->isAJAX()) {
			$data = [
				'checkout' => date('Y-m-d H:i:s'),
				'event_library_id' => $this->request->getPost('id'),
				'badge_hash' => $this->request->getPost('badge_hash')
			];
			try
			{
					$CICOModel->insert($data);
			}
			catch (\Exception $e)
			{
					die($e->getMessage());
			}
			echo var_dump($data);
		} else {
			echo "no";
		}
	}
}
