<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends My_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->load->helper('common');
        $cid = $this->input->get('cid');
        $cid = base64_decode(urldecode($cid));

        $pwd = $this->input->get('pwd');
        $pwd = base64_decode(urldecode($pwd));

        $cnt = $this->input->get('cnt');
        $cnt = base64_decode(urldecode($cnt));

    }

}
