<?php
class User extends CI_Model {

  var $name   = '';
  var $email = '';
  var $password  = '';
  var $address  = '';
  var $zipcode  = '';
  var $city  = '';
  var $telno  = '';
  
  function __construct()
  {
      parent::__construct();
      $this->load->helper('date');
      $this->load->library('encrypt');      
  } 
  
  function login($email, $password)
  {
    $salt = "this is not the salt that you wanted";
    $password = $this->encrypt->sha1($password, $salt);
    $query = $this->db->query("SELECT * FROM users WHERE email='" . $email . "' AND password='" . $password . "' LIMIT 1");
    return $query->row_array();
  }
  
  function create($post)
  {
    $salt = "this is not the salt that you wanted";

    $this->name  = $post['name'];
    $this->address = $post['address'];
    $this->zipcode = $post['zipcode'];
    $this->city = $post['city'];
    $this->email = $post['email'];
    $this->telno = $post['telno'];
    $this->password = $this->encrypt->sha1($post['password'], $salt);
    $this->created_at = date("Y-m-d H:i:s");

    $ret = $this->db->insert('users', $this);
    $this->db->close();
    return $ret;
  }
  
  function update_record($user_id, $post)
  {
    $salt = "this is not the salt that you wanted";

    $this->name  = $post['name'];
    $this->address = $post['address'];
    $this->zipcode = $post['zipcode'];
    $this->city = $post['city'];
    $this->email = $post['email'];
    $this->telno = $post['telno'];
    if (isset($post['password'])) {
      $this->password = $this->encrypt->sha1($post['password'], $salt);
    }
    $this->db->update('users', $this);
  }
  
  function find_by_email($email)
  {
    $query = $this->db->query("SELECT * FROM users WHERE email='" . $email . "' LIMIT 1");
    return $query->row_array();
  }

  function find_by_id($id)
  {
    $query = $this->db->query("SELECT * FROM users WHERE id='" . $email . "' LIMIT 1");
    return $query->row_array();
  }

  
}

?>