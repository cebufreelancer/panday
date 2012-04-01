<?php
class Cases extends CI_Model {

  var $title   = '';
  var $description = '';
  var $user_id  = '';
  var $budget_id  = '';
  var $zipcode  = '';
  var $address = '';
  var $city  = '';
  var $telno  = '';
  var $branch_codes  = '';
  
  function __construct()
  {
      parent::__construct();
  } 
  
  function latest($limit=10)
  {
    $rows = array();
    $query = $this->db->query("select cases.id, title, description, budget_id, address, zipcode, city, telno, user_id, status, created_at, branch_codes, prices.label, prices.value1 from cases left join prices ON cases.budget_id = prices.id ORDER BY created_at DESC LIMIT 0,$limit");

    return $query->result_array();
  }
  
  function create($post, $user)
  {
    $this->title        = $post['title'];
    $this->description  = $post['description'];
    $this->user_id      = $user['id'];
    $this->budget_id    = $post['budget_id'];
    $this->zipcode      = $post['zipcode'];
    $this->address      = $post['address'];
    $this->city         = $post['city'];
    $this->telno        = $post['telno'];
    $branch_codes = '';
    foreach($post['branches'] as $b)
    {
      $branch_codes += $b . ", ";
    }
    
    $this->branch_codes = $branch_codes;
    $this->created_at = date("Y-m-d H:i:s");

    $ret = $this->db->insert('cases', $this);
    return $ret;
  }
  
  function mycases($user_id)
  {
    $query = $this->db->query("select cases.id, title, description, budget_id, address, zipcode, city, telno, user_id, status, created_at, branch_codes, prices.label, prices.value1 from cases  LEFT JOIN prices ON cases.budget_id = prices.id WHERE cases.user_id = '$user_id' ORDER BY created_at DESC");

    return $query->result_array();    
  }

    function by_id($id)
    {
      $query = $this->db->query("select cases.id, title, description, budget_id, address, zipcode, city, telno, user_id, status, created_at, branch_codes, prices.label, prices.value1 from cases  LEFT JOIN prices ON cases.budget_id = prices.id  WHERE cases.id=$id ORDER BY created_at DESC");

      $ret = $query->result_array();
      return $ret[0];
    }

  function by_user_id($id, $user_id)
  {
    $query = $this->db->query("select cases.id, title, description, budget_id, address, zipcode, city, telno, user_id, status, created_at, branch_codes, prices.label, prices.value1 from cases  LEFT JOIN prices ON cases.budget_id = prices.id  WHERE cases.user_id = '$user_id' AND cases.id=$id ORDER BY created_at DESC");

    $ret = $query->result_array();
    return $ret[0];
  }

  
}

?>