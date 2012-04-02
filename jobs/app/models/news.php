<?php
class News extends CI_Model {

  var $title   = '';
  var $contents = '';
  var $image  = '';
  
  function __construct()
  {
      parent::__construct();
  } 
  
  function latest($limit=2)
  {
    $rows = array();
    $query = $this->db->query("select * from news ORDER BY created_at DESC LIMIT 0,$limit");
    return $query->result_array();
  }
  
  function create($post)
  {
    $this->title     = $post['title'];
    $this->contents  = $post['description'];
    $this->image      = $user['id'];
    $this->created_at = date("Y-m-d H:i:s");
    $this->updated_at = date("Y-m-d H:i:s");
    $ret = $this->db->insert('news', $this);
    return $ret;
  }
  
    function by_id($id)
    {
      $query = $this->db->query("select * from news  WHERE id=$id ORDER BY created_at DESC");
      $ret = $query->result_array();

      if (sizeof($ret) > 0 ){
        return $ret[0];
      }else{
        return NULL;
      }
    }

  
}

?>