<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Anupam Oza <anupam.oza@tecogis.com>
 * @copyright (c) 2017, Anupam Oza
 * @link http://192.168.9.24/plastindia/login/
 */
//session_start(); //we need to start session in order to access it through CI

Class Login extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        // Load database
        $this->load->model('login_model');

        // Load security
        $this->load->helper('security');
    }

    // Show login page
    public function index()
    {
        $this->load_view('login_view');
    }

    // Show registration page
    public function user_registration_show()
    {
        $this->load_view('registration_form_view');
    }

    // Validate and store registration data in database
    public function new_user_registration()
    {

        // Check validation for user input in SignUp form
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email_value', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load_view('registration_form_view');
        } else
        {
            $data = array(
                'user_name' => $this->input->post('username'),
                'user_email' => $this->input->post('email_value'),
                'user_password' => $this->input->post('password')
            );
            $result = $this->login_model->registration_insert($data);
            if ($result == TRUE)
            {
                $data['message_display'] = 'Registration Successfully !';
                $this->load_view('login_view', $data);
            } else
            {
                $data['message_display'] = 'Username already exist!';
                $this->load_view('registration_form_view', $data);
            }
        }
    }

    // Check for user login process
    public function user_login_process()
    {

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE)
        {
            if (isset($this->session->userdata['logged_in']))
            {
                $this->load_view('login_dashboard');
            } else
            {
                $this->load_view('login_view');
            }
        } else
        {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $result = $this->login_model->login($data);
            if ($result == TRUE)
            {

                $username = $this->input->post('username');
                $result = $this->login_model->read_user_information($username);
                if ($result != false)
                {
                    $session_data = array(
                        'username' => $result[0]->user_name,
                        'email' => $result[0]->user_email,
                    );
                    // Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    $this->load_view('login_dashboard');
                }
            } else
            {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load_view('login_view', $data);
            }
        }
    }

    // Logout from admin page
    public function logout()
    {

        // Removing session data
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load_view('login_view', $data);
    }

    // Load View
    public function load_view($view_name = '', $data = array())
    {
        $this->load->view('header');
        $this->load->view($view_name, $data);
        $this->load->view('footer');
    }

}

?>