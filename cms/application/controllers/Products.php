<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . "../vendor/autoload.php");

class Products extends CI_Controller
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
        $view["products"] = [];
        $response = $this->client->request('GET', API_URI.'/products')->getBody()->getContents();
        $response = json_decode($response,true);
        if($response['success']){
            $view["products"] = $response['data'];
        }
        $this->load->view('products/list', $view);
    }

    public function view($id=null){
        $view = [];
        $view["product"] = [];
        $view["back"] =($this->input->get('back')!=null)?base_url($this->input->get('back')):'';
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