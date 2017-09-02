<?php
require_once('JSController.php');

class Member extends JSController {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('congregation_model');
    $this->load->model('member_model');
  }

  public function deleteRecord()
  {
    $affected_rows = $this->member_model->deleteRecord($this->input->post());
    if($affected_rows > 0)
    {
      $result['msg'] = 'SUCCESS';
      $result['deleted_rows'] = $affected_rows;
    } else {
      $result['msg'] = 'NO_CHANGE';
      $result['deleted_rows'] = $affected_rows;
    }
    echo json_encode($result);
  }

  public function updateRecord()
  {
    $current_user_info = parent::getSessionData();
    $verificationResult = verifySignupForm($this->input->post());
    $updated_row = NULL;

    $data = $this->input->post();
    $session = parent::getSessionData();
    // 회중을 옮기는 경우
    if(isset($data['congregation']) && ($data['congregation'] != $session['congregation_srl'])) {
      // 옮기려는 회중에 계정이 없는 경우
      if(count($this->member_model->getRecords($data['congregation'])) === 0) {
        $data['auth'] = 'a';
      } else {
        $data['auth'] = 'r';
      }
    }

    if($verificationResult === "SUCCESS") {
      $emailOwner = $this->member_model->getRecord(NULL, NULL, $data['email']);
      if(!$emailOwner || ($emailOwner && $emailOwner['member_srl'] === $session['member_srl'])) {
        $updated_row = $this->member_model->updateRecord($data);
        $updated_row['msg'] = "SUCCESS";
        parent::getSessionData();
      }
      else {
        $updated_row['msg'] = "DUPLICATED_EMAIL";
      }
    }
    else
      $updated_row['msg'] = $verificationResult;

    echo json_encode($updated_row);
  }

  public function index()
	{
    if(parent::getSessionData()) {
      $data['congregations'] = $this->congregation_model->getRecords();
      parent::view('member', $data);
    }
    else {
      header('Location: main');
    }
	}
}
