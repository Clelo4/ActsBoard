<?php
	// $d1=date('Y-m-d',strtotime('2017-13-3'));
	// $d2=date('Y-m-d',strtotime('2017-9-2'));
	// if($d1=='1970-01-1') { echo "ok"; }
	// $d1=date("Y-m-d");
	// echo $d1;
	// echo "明天:",date('Y-m-d',strtotime('+1 day'));
// 	function curl_get_https($url){
// 		$curl = curl_init(); // 启动一个CURL会话
// 		curl_setopt($curl, CURLOPT_URL, $url);
// 		curl_setopt($curl, CURLOPT_HEADER, 0);
// 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
// 		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
// 		$tmpInfo = curl_exec($curl);     //返回api的json对象
// 		//关闭URL请求
// 		curl_close($curl);
// 		return $tmpInfo;    //返回json对象
// 	}

// 	function postHttps($url, $param){
// 		// if(!is_array($param)){
// 		// 	throw new Exception("参数必须为array");
// 		// }

// 		$curl = curl_init(); // 启动一个CURL会话
// 		curl_setopt($curl, CURLOPT_URL, $url);
// 		curl_setopt($curl, CURLOPT_HEADER, 0);
// 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
// 		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在

// 		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
// 		curl_setopt($curl, CURLOPT_POST, 1);//设置为POST方式 
// 		curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
// 		curl_setopt($curl, CURLOPT_TIMEOUT,30);          //设置超时

// 		$rst=curl_exec($curl);  // 执行操作

// 		curl_close($curl);
// 		return $rst;
// 	}
// 	$arr=json_encode(array(
// 		'button'=>array(
// 			array(
// 			'type'=>'view',
// 			'name'=>'ActsBoard',
// 			'url'=>'http://music.163.com',
// 			'sub_button'=>[]
// 			),
// 			array(
// 				'type'=>'view',
// 				'name'=>'Acts11',
// 				'url'=>'http://music.163.com',
// 				'sub_button'=>[]
// 			),
				
// 		)
// 		)
// 	$URL='https://api.weixin.qq.com/cgi-bin/menu/create?access_token=8_qqQPwMG4DZ_PkdujtRb2E8EIOdJaZj_1R_GG07k-qls091nENw9CyfUFxi3BjWeh9PFtmNUi7Y6-M48KbioIN5TOrQhbVgJhQspp1x6pjxi6HR0dSjH_3yI2xPbEuMdkY8nthzqGIbzTRz1aASRcAHATLK';
// 	echo postHttps($URL,$arr);


// echo "今天是 " . date('YmdHi') . "<br>";
// echo "今天是 " . date("Y.m.d") . "<br>";
// echo "今天是 " . date("Y-m-d") . "<br>";
// echo "今天是 " . date("l");
	// $test='{"access_token":"8_FVdbUb9dpYIyZh6wNwIR2QH3lehbhqd6Lzjs_a90XhG6wELlWocyQR-d2dRX7eiaEi5h7o9ZEuESHIP_AlIYWrEvmhNnDdLSraVjS8qQddY","expires_in":7200,"refresh_token":"8_6yyJxZhvbjoUqAI9pxMhBjSgd2dkynRhvSVVJOPzCY0iucZM8LuZ1ROm2osp3HCQb2ar5-ds_nbryMRkLtwXhexxDpHafiC-thfhd4I6wl8","openid":"oKvv71Ur9gf7ikUZNv0ifRbRrMBQ","scope":"snsapi_base"}';
	// $result=json_encode($test);
	// $arr=[];
	// $arr['1']=11;
	// echo json_encode($arr);

	/**
	 * 生成活动的唯一id
	 * author：jack
	 * email：jack0000davis@gmail.com
	 */
	function generateId(){
		$id='';
		$currentTime=date('YmdHms');
		$id=substr(date('Y'),2,2).date('z').substr(crc32($currentTime),-3,3).rand(0,9).rand(0,9);
		$num=0;
		for($i=0;$i!=10;$i++){
			$num+=substr($id,$i,1);
		}
		$id=$id.$num%10;
		return $id;
	}
	
	echo "ok";
	echo $id;
?>

	