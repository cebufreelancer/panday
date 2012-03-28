<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('cart');
    $this->load->library('encrypt');
    $this->load->model("Cart"); 
  }

  public function cart_empty()
  {
    $this->load->model("Cart");
    $id = $this->session->userdata('id');
    $this->db->query("Delete from carts where user_id = '$id'");
    redirect("/account/cart?empty=1", 'location');
  }
  
	public function cases()
	{
	  $this->load->model('Cases');
	  $vars['title'] = "Cases";
	  $vars['active'] = "Account::Cases";
	  $vars['content_view'] = "account/cases";
	  $vars['cases'] = $this->Cases->mycases($this->session->userdata('id'));
	  $vars['case'] = NULL;

	  if (isset($_GET['id'])){	    
	    $user_id = $this->session->userdata('id');
	    $id = $_GET['id'];
//	    $res = $this->db->query("select * from cases where user_id = '$user_id' AND id='$id'");
//	    $res = $res->result_array();
	    $vars['case'] = $this->Cases->by_user_id($id, $user_id);
	  }
	  
	  $this->load->view('template', $vars);

	}

	public function cart()
	{
	  $this->load->model('Cart');
	  
	  $vars['title'] = "Cart";
	  $vars['active'] = "Account::Cart";
	  $vars['content_view'] = "account/cart";
	  $vars['items'] = $this->Cart->mycart($this->session->userdata('id'));
	  
	  $this->load->view('template', $vars);

	}

	public function changepw()
	{
	  $this->load->model("User");
	  
	  $vars['title'] = "Change Password";
	  $vars['active'] = "Change Password";
	  $vars['content_view'] = "account/changepw";
    print_r($_POST);
    die('here');
	  
	  if (isset($_POST['name'])){
	    $user= $this->User->find_by_email($this->session->userdata('email'));
	    if ($user['password'] == ($this->encrypt->sha1($_POST['curpassword'], PASSWD_SALT))){
	      if ($_POST['password'] == $_POST['cpassword']){
	        $newpassword = $this->encrypt->sha1($post['password'], PASSWD_SALT);
	        $this->db->query("Update users set password='$newpassword' WHERE email = '" . $this->session->userdata('email') . "'");
	      }else{
	        $vars['error'] = ERROR_102;
	      }
	    }else{
	      $vars['error'] = ERROR_101;
	    }
	  }	  
	  
	  $this->load->view('template', $vars);
	}

	public function index()
	{
	  $this->load->model('User');
	  $this->load->model('Prices');
	  $vars['user'] = NULL;

	  $vars['title'] = "Account";
	  $vars['active'] = "Account";
	  $vars['content_view'] = "account/index";
    $vars['user'] = $this->User->find_by_email($this->session->userdata('email'));
    
	  $this->load->view('template', $vars);

	}
	
}
