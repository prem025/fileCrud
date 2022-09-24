<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$hdata['heading'] = 'Add Product';
		$data=NULL;
        // $hdata['btn'] = '<button class="btn btn-primary pull-right btn-sm " onclick="addClub()">Add Club</buttton>';
        // $hdata['btn'] = '<a target="_blank" class="btn btn-warning btn-sm" href="'.base_url().'club/addClubView'.'">Add Club</a>';
        // $category = $this->CommonModel->getRecords('clubtypes');
        
        $hdata['view'] = 'welcome_message';
        $hdata['data'] = '';
       
        $this->load->view('include/header', $hdata);
		// $this->load->view('welcome_message');
	}
}
