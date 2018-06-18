<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . "../vendor/autoload.php");

class Categories extends CI_Controller
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
        $view["categories"] = [];
        $response = $this->client->request('GET', API_URI.'/categories')->getBody()->getContents();
        $response = json_decode($response,true);

        if($response['success']){
            $view["categories"] = $response['data'];
        }
        $this->load->view('categories/list', $view);
    }

    public function view($id=null){
        $view = [];
        $view["product"] = [];
        if(is_null($id)){
           $this->session->set_flashdata('error', 'Product ID missing');
            redirect("/products");
            exit;
        }else{
            $response = $this->client->request('GET', API_URI.'/products/'.$id)->getBody()->getContents();
            $response = json_decode($response,true);
            if($response['success']){
                $view["product"] = $response['data'];
            }
            $this->load->view('products/view', $view);
        }

    }
    public function add(){

            $this->load->view('products/add');


    }
}