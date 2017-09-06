<?php
require_once('JSController.php');

class Record extends JSController {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('member_model');
    $this->load->model('record_model');
  }

  public function writeRecord()
  {
    $data = $this->input->post();
    // MySQL에서 알아서 잘라주는 듯 싶지만 명시적으로 날짜 부분만 뽑는다.
    $data['visit_start'] = substr($data['visit_start'], 0, 10);
    $data['visit_end'] = substr($data['visit_end'], 0, 10);
    $result = $this->record_model->writeRecord($data);
    if($result != NULL)
      $result['msg'] = "SUCCESS";
    else
      $result['msg'] = "NO_CHANGE";

    echo json_encode($result);
  }

  public function index()
	{
    $session = $this->session->userdata('logged_in');
    if($session === NULL)
      header('location: signin');
    else {
      $data['members'] = $this->member_model->getRecords($session['congregation_srl']);
      $data['congregation_srl'] = $session['congregation_srl'];
      $data['latest'] = $this->record_model->getTerminalRecord($session['congregation_srl']);
      parent::view('record', $data);
    }
	}
}
