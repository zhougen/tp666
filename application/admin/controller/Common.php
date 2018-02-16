<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
class Common extends Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!session('admin.admin_id')){
			$this->redirect("admin/login/login");
		}


	}

}
