<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailer extends CI_Controller {

    public function company_activation_link($to, $name)
    {

	    $this->load->library('email');
	    $this->load->model("User");
	    $this->load->model("Tokens");
	    
      $this->email->from('michaxze@gmail.com', 'JOBS company');
      $user = $this->User->find_by_email($to);

      $t_id = $this->Tokens->createnew($user);
      $token = $this->Tokens->by_id($t_id);
      $base_url = $this->config->item('base_url');

      $link = $base_url . "/activate?email=" .  urlencode($user['email']) . "&token=" . $token['token'];
      $message = "Hi $name,

Please activate your account by clicking the link below:
$link

The Company Team
      ";
      $this->email->to($to);
      $this->email->subject("Activation link for Company");
      $this->email->message($message);
      $this->email->send();  
    }
    

    public function user_activation_link($to, $name)
    {

	    $this->load->library('email');
	    $this->load->model("User");
	    $this->load->model("Tokens");

      $this->email->from('michaxze@gmail.com', 'JOBS company');
      $user = $this->User->find_by_email($to);

      $t_id = $this->Tokens->createnew($user);
      $token = $this->Tokens->by_id($t_id);
      $base_url = $this->config->item('base_url');

      $link = $base_url . "/activate?email=" .  urlencode($user['email']) . "&token=" . $token['token'];
      $message = "Hi $name,

Please activate your account by clicking the link below:
$link

The Company Team
      ";
      $this->email->to($to);
      $this->email->subject("Please activate your account at Company");
      $this->email->message($message);
      $this->email->send();  
    }    
    
    public function password_link($user, $subject= '')
    {
      $this->load->model("User");
      $this->load->model("Tokens");
	    $this->load->library('email');
      
      if ($subject == ""){
        $subject  = "Reset your password";
      }

      $t_id = $this->Tokens->createnew($user);
      $token = $this->Tokens->by_id($t_id);
      $base_url = $this->config->item('base_url');
      $link = $base_url . "/password_reset?email=" .  urlencode($user['email']) . "&token=" . $token['token'];
      $name = $user['name'];
$message = "
Hi $name

We receive a request to reset your password for your account. 

If you want to reset your password.  click the link below 
$link;

The Company Team
";
      $this->email->from('michaxze@gmail.com', 'JOBS company');
      $this->email->to($user['email']);
      $this->email->subject($subject);
      $this->email->message($message);
      $this->email->send();    
    }
    
}

?>