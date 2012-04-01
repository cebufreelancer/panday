<?php
class Tokens extends CI_Model {

  var $email = "";
  var $token = "";
  var $type = "password";
  
  function __construct()
  {
      parent::__construct();
  } 

  function createnew($user)
  {
    $this->email =  $user['email'];
    $date = date("Y-m-d H:i:s");
    $this->created_at = $date;
    $this->token =  $this->encrypt->sha1($date, PASSWD_SALT);
    $this->type = "password";
    
    $ret = $this->db->insert('tokens', $this);
    $id = $this->db->insert_id() ;
    $this->db->close();

    return $id;
  }
  
  function by_id($id)
  {
    $query = $this->db->query("select * from tokens where id=$id");
    $ret = $query->result_array();
    return $ret[0];
  }

  function update_token($token)
  {
    $data = array('is_used' => 1);
   $this->db->where('id', $token['id']);
   $this->db->update('tokens', $data);
  }
  
  function by_token($token)
  {
    $query = $this->db->query("select * from tokens where token='$token'");
    $ret = $query->result_array();

    if (sizeof($ret) > 0){
      return $ret[0];
    }else{
      return NULL;
    }
  }


}

?>