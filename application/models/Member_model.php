<?php
class Member_model extends CI_Model {
  public $table = 'js_member';

  public function __construct()
  {
    $this->load->database();
  }

  public function deleteRecord($data)
  {
    $this->db->delete($this->table, $data);
    return $this->db->affected_rows();
  }

  public function getRecord($member_srl, $id = NULL, $email = NULL)
  {
    if($id != NULL)
      $this->db->where('id', $id);
    else if($email != NULL)
      $this->db->where('email', $email);
    else
      $this->db->where('member_srl', $member_srl);

    $query = $this->db->get($this->table);
    return $query->row_array();
  }

  public function getRecords($congregation_srl = NULL)
  {
    if($congregation_srl != NULL)
      $this->db->where('congregation', $congregation_srl);

    $this->db->order_by('name', 'asc');
    $query = $this->db->get($this->table);
    return $query->result_array();
  }

  public function recordLastActivity($member_srl)
  {
    $this->db->query('UPDATE js_member SET last_activity = NOW() WHERE member_srl = '.$member_srl);
  }

  public function login($id, $password)
  {
    $this->db->where('id', $id);
    $query = $this->db->get($this->table);
    $result = $query->row_array();

    if($query->num_rows() === 1 && password_verify($password, $result['password']))
      return self::setSession($id, $result);

    return NULL;
  }

  public function setSession($id, $member_info = NULL)
  {
    $result = $member_info;
    if($result === NULL) {
      $this->db->where('id', $id);
      $query = $this->db->get($this->table);
      $result = $query->row_array();
    }

    $cong = $this->congregation_model->getRecord($result['congregation']);
    $session_info = [
      'member_srl' => $result['member_srl'],
      'id' => $result['id'],
      'name' => $result['name'],
      'email' => $result['email'],
      'auth' => $result['auth'],
      'phone' => $result['phone'],
      'congregation_srl' => $cong['congregation_srl'],
      'congregation_name' => $cong['name'],
      'congregation_number' => $cong['unique_number'],
      'filter_day' => 'all'
    ];
    $this->session->set_userdata('logged_in', $session_info);

    return $session_info;
  }

  public function writeRecord($data)
  {
    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
    $this->db->insert($this->table, $data);
    $result = NULL;
    if($this->db->affected_rows() > 0) {
      $result = $this->db->where('member_srl', $this->db->insert_id())->get($this->table)->row_array();
      return $result;
    }
    else
      return $result;
  }

  public function issueNewPassword($email, $password)
  {
    $this->db->where('email', $email);
    $result = $this->db->get($this->table);
    $data = $result->row_array();
    $data['password'] = $password;

    if($this->db->affected_rows() > 0) {
      return self::updateRecord($data);
    }
    return NULL;
  }

  public function updateRecord($data)
  {
    if(isset($data['password']))
      $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

    $this->db->where('member_srl', $data['member_srl']);
    $this->db->update($this->table, $data);
    $result = NULL;
    if($this->db->affected_rows() > 0) {
      $this->db->where('member_srl', $data['member_srl']);
      $result = $this->db->get($this->table);
      return $result->row_array();
    }
    else
      return $result;
  }
}
