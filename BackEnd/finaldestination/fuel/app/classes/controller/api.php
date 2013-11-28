<?php

class Controller_Api extends Controller_Rest{

	public function get_users(){
		$data['users'] = Model_User::find('all');
		return $this->response($data);

	}

	public function get_jeepneyroutes(){
		$data['jeepneyroutes'] = Model_Jeepneyroute::find('all');
		return $this->response($data);
	}

	public function get_tricycleroutes(){
		$data['tricycleroutes'] = Model_Tricycleroute::find('all');
		return $this->response($data);
	}

	public function get_landmarks(){
		$data['landmarks'] = Model_Landmark::find('all');
		return $this->response($data);
	}
}