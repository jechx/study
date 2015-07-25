<?php
namespace App\Controllers;

use xing\Controller;

/**
 * Index controller
 */

class Index extends Controller{

    public function index(){
        $this->assign('title','test');
        $this->display();
    }
}