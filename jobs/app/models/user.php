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
    $password = $this->encrypt->sha1($password, PASSWD_SALT);
    $query = $this->db->query("SELECT * FROM users WHERE status=1 AND email='" . $email . "' AND password='" . $password . "' LIMIT 1");
    return $query->row_array();
  }

  function createcompany($post)
  {
    $this->load->library('encrypt');
    $this->company_name  = $post['company_name'];
    $this->description = $post['description'];
    $this->address = $post['address'];
    $this->zipcode = $post['zipcode'];
    $this->city = $post['city'];
    $this->contact_person = $post['contact_person'];
    $this->cvrnumber = $post['cvrnumber'];
    $this->city = $post['city'];
    $this->website = $post['website'];
    $this->usertype = "company";
    
    $this->email = $post['email'];
    $this->telno = $post['telno'];
    
    $this->password = $this->encrypt->sha1($post['password'], PASSWD_SALT);
    $this->created_at = date("Y-m-d H:i:s");

    $branch_codes = '';
    foreach($post['branches'] as $b)
    {
      $branch_codes += $b . ", ";
    }
    $this->branch_codes = $branch_codes;
    $ret = $this->db->insert('users', $this);

    $this->db->close();
    return $ret;
  }
  
  function create($post)
  {
    $this->name  = $post['name'];
    $this->address = $post['address'];
    $this->zipcode = $post['zipcode'];
    $this->city = $post['city'];
    $this->email = $post['email'];
    $this->telno = $post['telno'];
    $this->password = $this->encrypt->sha1($post['password'], PASSWD_SALT);
    $this->created_at = date("Y-m-d H:i:s");

    $ret = $this->db->insert('users', $this);
    $this->db->close();
    return $ret;
  }
  
  function update_record($user_id, $post)
  {

    $this->name  = $post['name'];
    $this->address = $post['address'];
    $this->zipcode = $post['zipcode'];
    $this->city = $post['city'];
    $this->email = $post['email'];
    $this->telno = $post['telno'];
    if (isset($post['password'])) {
      $this->password = $this->encrypt->sha1($post['password'], PASSWD_SALT);
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
    $query = $this->db->query("SELECT * FROM users WHERE id='" . $id . "' LIMIT 1");
    return $query->row_array();
  }
  
  function companies()
  {
    $query = $this->db->query("SELECT * FROM users WHERE usertype='company'");
    return $query->result_array();
  }
  
  function activate($user)
  {
    $data = array('status' => "1");
    $this->db->where('id', $user['id']);
    $this->db->update('users', $data);
  }

  function all($status='', $type=''){
    
    if ($status != ''){
      $this->db->where("status", $status);
    }
    if ($type == 'c'){
      $this->db->where("usertype", 'company');
    }else{
      $this->db->where("usertype", 'regular');
    }
    
    $this->db->order_by("id", "desc");
    $result = $this->db->get('users');
    return $result->result_array();
    
  }
  
}

?>