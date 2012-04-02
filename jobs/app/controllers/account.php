<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('cart');
    $this->load->library('encrypt');
    $this->load->model("Cart"); 
    $this->load->model("User"); 
    $this->load->model('News');    
  }

  public function update()
  {
    if(!$this->session->userdata('email')) {
      redirect("/", "location");
    }
    
    $name = $_POST['name'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $city = $_POST['city'];
    $telno = $_POST['telno'];
    
    $sql = "UPDATE users SET name='$name', address='$address', zipcode='$zipcode', city='$city', telno='$telno'";
    $this->db->query($sql);
    redirect("/account?updated=1", "location");
  }
  
  public function checkout()
  {
    if(!$this->session->userdata('email')) {
      redirect("/checkout", "locattion");
    }
    
    $this->load->model("Invoices");
    $cart = $this->Cart->mycart($this->session->userdata('id'));

    if (!empty($cart)){
      $user_id = $this->session->userdata('id');
      $invoice = $this->Invoices->createnew($user_id);
      $this->db->query("Delete from carts where user_id = '$user_id'");
    }
    redirect("/account/paid?id=" . $this->session->userdata('id') . "&invoice_id=" . $invoice['id'], 'location');
  }
  
  public function paid()
  {
    $this->load->library('email');
    //TODO: send pdf invoice to email
    $this->email->from('michaxze@gmail.com', 'Michael Gimena');
    $this->email->to('michaxze@gmail.com');
    $this->email->subject('You have successfully created a case.');
    $this->email->message("To manage your created cases, please login with your email and password.");
    $this->email->send();
        
    redirect("/account/bought", 'location');
  }
  
  public function bought()
  {
    if(!$this->session->userdata('email')) {
      redirect("/", "location");
    }
    $this->load->model("Invoices");
    
	  $vars['title'] = "Invoices";
	  $vars['active'] = "Account::Cases";
	  $vars['content_view'] = "account/invoices";
	  $vars['invoices'] = $this->Invoices->myinvoices($this->session->userdata('id'));
    $vars['news'] = $this->News->latest(2);	  
	  $this->load->view('template', $vars);
  }

  public function cart_delete()
  {
    $this->load->model("Cart");
    $id = $_GET['id'];
    $user_id = $this->session->userdata('id');
    $cart_session = $this->session->userdata('cart_session');

    if ($user_id){
      $this->db->query("Delete from carts where user_id='$user_id' AND id='$id'");
    }else{
      $this->db->query("Delete from carts where cart_session='$cart_session' AND id='$id'");
    }
    
    redirect("/account/cart", "location");
  }
  
  public function cart_empty()
  {
    if(!$this->session->userdata('email')) {
      redirect("/", "location");
    }
    $this->load->model("Cart");
    $id = $this->session->userdata('id');
    $this->db->query("Delete from carts where user_id = '$id'");
    redirect("/account/cart?empty=1", 'location');
  }
  
	public function cases()
	{
	  if(!$this->session->userdata('email')) {
      redirect("/", "location");
    }

	  $this->load->model('Cases');
	  $this->load->model("Invoices");
	  
	  $vars['title'] = "Cases";
	  $vars['active'] = "Account::Cases";
	  $vars['content_view'] = "account/cases";
	  $vars['cases'] = $this->Cases->mycases($this->session->userdata('id'));
	  $vars['case'] = NULL;

	  if (isset($_GET['id'])){	    
	    $user_id = $this->session->userdata('id');
	    $id = $_GET['id'];
	    $case =  $this->Cases->by_user_id($id, $user_id);
      $vars['case'] = $case;
      
      // get companies who buy this case
      $companies = $this->Invoices->get_companies($case['id']);
	    $vars['companies'] = $companies;
	  }
    $vars['news'] = $this->News->latest(2);	  
	  $this->load->view('template', $vars);

	}

	public function cart()
	{
    
	  $this->load->model('Cart');
	  
	  $vars['title'] = "Cart";
	  $vars['active'] = "Account::Cart";
	  $vars['content_view'] = "account/cart";
  
    if ($this->session->userdata('email')){
      $vars['items'] = $this->Cart->mycart($this->session->userdata('id'));
    }else{
	    $vars['items'] = $this->Cart->mycartsession($this->session->userdata('cart_session'));
    }
    $vars['news'] = $this->News->latest(2);	  
	  $this->load->view('template', $vars);

	}

	public function changepw()
	{
    if(!$this->session->userdata('email')) {
      redirect("/", "location");
    }	  
	  $this->load->model("User");
	  
	  $vars['title'] = "Change Password";
	  $vars['active'] = "Change Password";
	  $vars['content_view'] = "account/changepw";

	  if (isset($_POST['sent'])){
	    $user= $this->User->find_by_email($this->session->userdata('email'));
	    if ($user['password'] == ($this->encrypt->sha1($_POST['curpassword'], PASSWD_SALT))){
	      if ($_POST['password'] == $_POST['cpassword']){
	        $newpassword = $this->encrypt->sha1($_POST['password'], PASSWD_SALT);
	        $this->db->query("Update users set password='$newpassword' WHERE email = '" . $this->session->userdata('email') . "'");
	        $vars['changed'] = true;
	      }else{
	        $vars['error'] = ERROR_102;
	      }
	    }else{
	      $vars['error'] = ERROR_101;
	    }
	  }	  
    $vars['news'] = $this->News->latest(2);
	  $this->load->view('template', $vars);
	}

	public function index()
	{
    if(!$this->session->userdata('email')) {
      redirect("/", "location");
    }
    
	  $this->load->model('User');
	  $this->load->model('Prices');
	  $vars['user'] = NULL;

	  $vars['title'] = "Account";
	  $vars['active'] = "Account";
	  $vars['content_view'] = "account/index";
    $vars['user'] = $this->User->find_by_email($this->session->userdata('email'));

    $vars['news'] = $this->News->latest(2);    
	  $this->load->view('template', $vars);

	}
	

	
}
