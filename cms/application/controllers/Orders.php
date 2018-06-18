<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . "../vendor/autoload.php");

class Orders extends CI_Controller
{
    private $client;
    public function __construct()
    {
        parent::__construct();
        $this->client = new GuzzleHttp\Client();
    }

    public function index()
    {
        $view = [];
        $view["orders"] = [];
        $response = $this->client->request('GET', API_URI.'/orders')->getBody()->getContents();
        $response = json_decode($response,true);

        if($response['success']){
            $view["orders"] = $response['data'];
        }
        $this->load->view('orders/list', $view);
    }

    public function view($id=null){
        $view = [];
        $view["order"] = [];
        if(is_null($id)){
           $this->session->set_flashdata('error', 'Order ID missing');
            redirect("/orders");
            exit;
        }else{
            $response = $this->client->request('GET', API_URI.'/orders/'.$id)->getBody()->getContents();
            $response = json_decode($response,true);
            if($response['success']){
                $view["order"] = $response['data'];
            }
            $this->load->view('orders/view', $view);
        }

    }
    public function add(){

            $this->load->view('products/add');


    }
}