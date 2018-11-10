<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests\RegistRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;     
use Illuminate\Support\Facades\Cache;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;


class RegisterController extends Controller
{
    //
    public function register(){
        return view('home.register');
    }

    public function sendcode(Request $req){
        $code = rand(100000,999999);
        $name = 'code-'.$req->mobile;
        Cache::put($name,$code,11);//存起来一分钟
        $config =[
            'accessKeyId'    => 'LTAItkpPFd4YJidB',
            'accessKeySecret' => '9Veh8nTu6QeN5kNHyHNroizZTK9ZA1',
            
        ];
        $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($req->mobile);
        $sendSms->setSignName('刘佳怡的');
        $sendSms->setTemplateCode('SMS_136680080');
        $sendSms->setTemplateParam(['code'=>$code]);

        // 发送
        print_r($client->execute($sendSms));
    }
    public function doregist(RegistRequest $req){
        $name = 'code-'.$req->mobile;
        $code = Cache::get($name);
        if(!$code || $code != $req->code){
            return back()->withErrors(['code'=>'验证码错误']);
        }
        $password = Hash::make($req->password);
        $user = new User;
        //把表单中手机号设置到模型中
        $user->mobile = $req->mobile;
        $user->password = $password;
        $user->uname = $req->uname;
        //保存到表中
        $user->save();
        // 跳转到登陆页面
        return redirect()->route('home_login');




    }
}
