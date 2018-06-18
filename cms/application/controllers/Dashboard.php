<?php
/**
 * Created by PhpStorm.
 * User: mohammed.rafique
 * Date: 10/06/18
 * Time: 3:21 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function index()
    {
        $this->load->view('dashboard');
    }
}