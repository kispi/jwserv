<?php
require_once('JSController.php');

class Admin extends JSController {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('congregation_model');
    $this->load->model('member_model');
  }

  public function deleteRecord()
  {
    $result = NULL;
    $data = $this->input->post();
    $member = $this->member_model->getRecord($data['member_srl']);
    if($member['auth'] != 'a') {
      $affected_rows = $this->member_model->deleteRecord($data);
      if($affected_rows > 0)
      {
        $result['msg'] = 'SUCCESS';
        $result['deleted_rows'] = $affected_rows;
      } else {
        $result['msg'] = 'NO_CHANGE';
        $result['deleted_rows'] = $affected_rows;
      }
    } else {
      $result['msg'] = 'TRY_TO_DELETE_ADMIN';
    }
    echo json_encode($result);
  }

  public function updateRecord()
  {
    $session = parent::getSessionData();
    $updated_row = NULL;

    $numOfAdmins = 0;
    $members = $this->member_model->getRecords($session['congregation_srl']);
    foreach($members as $member)
      if($member['auth'] === 'a')
        $numOfAdmins++;

    $data = $this->input->post();
    $member = $this->member_model->getRecord($data['member_srl']);
    $try_no_admin = FALSE;

    // 관리자 권한에서 다른 권한으로 변경 시도시
    if($member['auth'] === 'a' && $data['auth'] != 'a') {
      // 관리자가 1명을 초과할때만 변경 가능
      if($numOfAdmins <= 1)
        $try_no_admin = TRUE;
    }

    $emailOwner = $this->member_model->getRecord(NULL, NULL, $data['email']);
    if($emailOwner && ($emailOwner['member_srl'] != $data['member_srl'])) {
      $updated_row['msg'] = "DUPLICATED_EMAIL";
    }
    else if($try_no_admin === TRUE)
      $updated_row['msg'] = "NO_ADMIN";
    else {
      $updated_row = $this->member_model->updateRecord($data);
      $updated_row['msg'] = "SUCCESS";
    }

    echo json_encode($updated_row);
  }

  public function index()
	{
    $session = parent::getSessionData();
    if($session != NULL && $session['auth'] === 'a') {
      $data['members'] = $this->member_model->getRecords($session['congregation_srl']);
      parent::view('admin', $data);
    }
    else {
      header('Location: main');
    }
	}
}
