<?php
require_once('JSController.php');

class Signup extends JSController {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('congregation_model');
    $this->load->model('member_model');
  }

  public function addCongregation()
  {
    $data = $this->input->post();
    $row = $this->congregation_model->getRecord(NULL, $data['name']);

    if($row != NULL) {
      $result['msg'] = "DUPLICATED_CONGREGATION";
    } else {
      $this->congregation_model->writeRecord($data);
      $result = $this->congregation_model->getRecords();
      $result['msg'] = "SUCCESS";
    }
    echo json_encode($result);
  }

  public function writeRecord()
  {
    $data = $this->input->post();
    $duplicatedID = $this->member_model->getRecord(NULL, $data['id'], NULL);
    $duplicatedEmail = $this->member_model->getRecord(NULL, NULL, $data['email']);
    $verificationResult = verifySignupForm($data);

    $result = NULL;
    if($verificationResult === "SUCCESS") {
      if($duplicatedID) {
        $result['msg'] = "DUPLICATED_ID";
      }
      else if($duplicatedEmail) {
        $result['msg'] = "DUPLICATED_EMAIL";
      }
      else {
        $numOfMembers = count($this->member_model->getRecords($data['congregation']));
        if($numOfMembers === 0)
          $data['auth'] = 'a';
        else
          $data['auth'] = 'r';

        $result = $this->member_model->writeRecord($data);
        if($result != NULL)
          $result['msg'] = "SUCCESS";
      }
    } else {
        $result['msg'] = $verificationResult;
    }
    echo json_encode($result);
  }

  public function updateRecord()
  {
    $updated_row = $this->member_model->updateRecord($this->input->post());
    if($updated_row != NULL)
      $updated_row['msg'] = "SUCCESS";
    else
      $updated_row['msg'] = "NO_CHANGE";

    echo json_encode($updated_row);
  }

  public function index()
	{
    if($this->session->userdata('logged_in');)
      header('Location: main');
    else {
      $data['congregations'] = $this->congregation_model->getRecords();
      parent::view('signup', $data);
    }
	}
}
