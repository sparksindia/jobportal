<?php

class Default_AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
		
    }
	
	public function loginAction()
	{
		/*$baseURL = 'http://mjobportal.com/';
		$callbackURL = 'http://mjobportal.com/default/auth/login';
		$linkedinApiKey = '75xyx472vxmwdx';
		$linkedinApiSecret = '0UBjMGu0JqJZ5ger';
		$linkedinScope = 'r_basicprofile r_emailaddress rw_company_admin w_share';*/

		$this->checkIdentity();
		
		/*if (isset($_GET["oauth_problem"]) && $_GET["oauth_problem"] <> "") {
		  // in case if user cancel the login. redirect back to home page.
		  $_SESSION["err_msg"] = $_GET["oauth_problem"];
		  //header("location:index.php");
		  exit;
		}
		
		$client = new LinkedIn_OauthClient;
		
		$client->debug = false;
		$client->debug_http = true;
		$client->redirect_uri = $callbackURL;

		$client->client_id = $linkedinApiKey;
		$application_line = __LINE__;
		$client->client_secret = $linkedinApiSecret;

		if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
		  die('Please go to LinkedIn Apps page https://www.linkedin.com/secure/developer?newapp= , '.
					'create an application, and in the line '.$application_line.
					' set the client_id to Consumer key and client_secret with Consumer secret. '.
					'The Callback URL must be '.$client->redirect_uri).' Make sure you enable the '.
					'necessary permissions to execute the API calls your application needs.';*/

		/* 
		 *	API permissions
		 */
		/*$client->scope = $linkedinScope;
		if (($success = $client->Initialize())) {
		  if (($success = $client->Process())) {
			if (strlen($client->authorization_error)) {
			  $client->error = $client->authorization_error;
			  $success = false;
			} elseif (strlen($client->access_token)) {
			  $success = $client->CallAPI(
							'http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)', 
							'GET', array(
								'format'=>'json'
							), array('FailOnAccessError'=>true), $user);
			}
		  }
		  $success = $client->Finalize($success);
		}
		if ($client->exit) exit;
		if ($success) {
			echo "<pre>";print_r($user);die;
			//$user_id = $db->checkUser($user);
			//$_SESSION['loggedin_user_id'] = $user_id;
			//$_SESSION['user'] = $user;
		} else {
			 $_SESSION["err_msg"] = $client->error;
		}*/

		if($this->getRequest()->isPost()) {
			
			$postData = $this->getRequest()->getPost();
			$authAdapter = new Sparks_Auth_Adapter($this->_getParam('username'), $this->_getParam('password'));
			
			$result = Zend_Auth::getInstance()->authenticate($authAdapter);
			$this->checkIdentity();
		}
		
		try {
			$dbNameSpace = new Zend_Session_Namespace('db');
			
			$db = $dbNameSpace->dbAdapter;
			
			
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function checkIdentity()
	{
		if(Zend_Auth::getInstance()->hasIdentity()) {
			switch(Zend_Auth::getInstance()->getIdentity()['role']) {
				case 'admin':
					$this->_redirect('/admin/');
					break;
				case 'employeer':
					$this->_redirect('/employeer/');
					break;
				case 'specialist':
					$this->_redirect('/specialist/');
					break;
				default:
					$this->_redirect('/');
			}
		}
	}
	
	public function logoutAction()
	{
		Zend_Auth::getInstance()->clearIdentity();
		
		$aclNamespace = new Zend_Session_Namespace('Acl');
		$menuNamespace = new Zend_Session_Namespace('Menu');
		unset($aclNamespace->aclobj);
		unset($menuNamespace->menuobj);
		
		$this->_redirect('/');
	}


}