<?php
/**
* 短信接口精简代码整理（仅仅用于给家中国房地产网）
* 备注：
* 原SDK里有接口日志写文件的操作，且调用了其他类文件，实际上接口日志存入数据库、缓存或者队列中的场景更多，所以去掉了这部分的逻辑。
* 源码都是开放的，感觉不放心的话，自己可以和SDK源文件进行比对。
*
* @author: iwen fang 基于阿里大鱼SDK（版本：top-sdk-php-20151012）小修改，自己修改传入的参数值后测试，有问题联系我。请熟读文档，功能很简单，不要想复杂了，不要忽略文档用现成的。
* @email: ceophp@163.com
* @date 2016-08-31 19:55
*/
require('request/AlibabaAliqinFcSmsNumSendRequest.php');
require('TopClient.php');

var_dmup($_POST['username']);
exit;

	$c = new TopClient;
 	$c->appkey = '2344504911';
   	$c->secretKey = '7cc48a70df1fb9cbcb7c55c744e3877511';

    $req = new AlibabaAliqinFcSmsNumSendRequest;
    $str = rand(1000,9999);
    $req->setSmsType('normal');
    $req->setSmsFreeSignName('大鱼测试');
    $req->setSmsParam('{"code":"'.$str.'","product":"给家中国"}');
    $req->setRecNum('15079852038');
    $req->setSmsTemplateCode('SMS_137161021');

//print_r($req->getApiParas());//此处即得到按照API接口文档组装后的url参数,仅作调试查看，可以和官方API文档的参数格式比对排错

    $resp = $c->execute($req);
    $response = json_decode($resp, true);
   //var_dump($response);
    
	//返回值自己按照需要处理！
    if(!empty($response['alibaba_aliqin_fc_sms_num_send_response'])){
    		//发送成功
    		$data = $response['alibaba_aliqin_fc_sms_num_send_response']['result'];
			//return $data;
            //echo "<pre>";
           // var_dump($data);
          
            if($data['err_code'] == 0){
                echo '短信发送成功，您的验证码是'.$str.'';
            }else{
                echo "短信发送失败";
            }
            //echo "</pre>";
	}
	if(!empty($response['error_response'])){
		//发送异常
		$data = $response['error_response'];
		var_dump($data);
	}
    //var_dump($data);
