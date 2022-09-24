<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("ProductModel");
       
    }

	public function index()
	{
		$hdata['heading'] = 'Add Product';
		$data=NULL;
        
        $hdata['data'] ='';
        $hdata['view'] = 'product_view';
        
        $this->load->view('include/header', $hdata);
		
	}

    function getProductData()
    {
        $data = $this->ProductModel->getProduct();

        if (count($data) > 0) {
            $response['status'] = TRUE;
            $response['data'] = $data;
        } else {
            $response['data'] = [];
            $response['message'] = "No Data Found";
        }
        echo json_encode($response);
    }

    public function deleteProduct($id, $type)
    {
        $response = ['status' => FALSE, 'data' => NULL, 'message' => 'Invalid Parameters'];

        if ($id > 0) {
            $res = $this->ProductModel->deleteProduct($id, $type);
            
            if ($res) {
                if ($type == '0') {

                    $message = "Product Activeted Successfully";
                } else {
                    $message = "Product Deleted Successfully";
                }
                $response['status'] = TRUE;
                $response['message'] = $message;
            }
        } else {
            $response['message'] = "No Parameters Received";
        }

        echo json_encode($response);
    }


    function productAddEdit()
    {
        $response = ['status' => FALSE, 'data' => NULL, 'message' => 'Invalid Parameters'];
        $post = $this->input->post();

        
   
        $product_image= array();
        if($_FILES['product_image']['name'][0] != ''){
            $j=0;
            
            foreach($_FILES['product_image']['name'] as $k1=>$v1){
                if (!empty($_FILES['product_image']['tmp_name'][$j])) {
                    $ext = pathinfo($_FILES['product_image']['name'][$j])['extension'];
                    if (!is_dir(FCPATH . "assets/product/")) {
                        mkdir(FCPATH . "assets/product/", 777);
                    }
                    $target = "assets/product/". date('YmdHis').rand(100,1000) . "." . $ext;
                    if (move_uploaded_file($_FILES['product_image']['tmp_name'][$j], FCPATH . $target)) {
                        $imageurl = base_url()  . $target;
                    }
                }
                $j++;
                array_push($product_image,$imageurl);
            }
            $post['product_image'] = json_encode($product_image);
        }
        else{
            
            $post['product_image'] = json_encode($post['image_item']);
        }
         
       
        
    
         unset($post['image_item']);
         $product_id = $post['product_id'];
         unset($post['product_id']);
         
         $res = $this->ProductModel->productAddEdit($post,$product_id);
       
         
        if ($res) {
                if($product_id !=0){
                    $response['message'] = "Product Updated Successfully";
        
                }
                else{
                    $response['message'] = "Product Added Successfully";
                }
           
                $response['status'] = TRUE;
        } else {
            $response['message'] = "Not Added";
        }
        sendJSONOutput($response);
    }

    function editProductData()
    {
        $post = $this->input->post();
       
        $data = $this->ProductModel->editProductData($post['id']);
        
        
        if (count($data) > 0) {
            $response['status'] = TRUE;
            $response['data'] = $data;
        } else {
            $response['data'] = [];
            $response['message'] = "No Data Found";
        }
        echo json_encode($response);
    }
}
