<?php

namespace app\admin\model\token;

use app\admin\model\Common;

class AccessToken extends Common{

	protected $name = "access_token";


	public function getAccessToken(){
		$data = $this->where('type',2)->select();
		$access_token = $data[0]['access_token'];
		return $access_token;
	}
}