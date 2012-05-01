<?php
class Admins extends CI_Model {

  var $username   = '';
  var $password  = '';
  var $status  = '';
  var $date_login  = '';
  
  function __construct()
  {
      parent::__construct();
      $this->load->helper('date');
      $this->load->library('encrypt');      
      $this->load->helper(array('form', 'url'));      
  } 
  
  function login($username, $password)
  {
    $password = $password;
    $query = $this->db->query("SELECT * FROM admins WHERE status=1 AND username='" . $username . "' AND password='" . $password . "' LIMIT 1");
    return $query->row_array();
  }

}

?>