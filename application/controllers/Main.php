<?php
require_once('JSController.php');

class Main extends JSController {
  public function index()
	{
    $data['session'] = $this->session->userdata('logged_in');
    if($data['session']['member_srl']) {
      parent::view('main', $data);
    }
    else
      header('Location: signin');
	}
}
