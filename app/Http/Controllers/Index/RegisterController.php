<?php
/**
 * 留言板用户注册操作类  v1.0
 * User: colin
 * Date: 2018/4/12
 * Time: 13:49
 */

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserInteractController;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * 用户注册处理
     *
     * @param array   $params  注册参数
     * @param string  $params[user_name]  用户名称
     * @param string  $params[user_email]  用户邮箱
     * @param string  $params[user_password]  用户密码
     * @param string  $params[user_gender]  用户性别
     * @param array   $result 处理结果
     * @return $result
     */
    public function register(Request $request)
    {
        $params = $request->all();
        //注册参数合法性判断
        UserInteractController::checkRegisterParams($params);
        $result = UserInteractController::userRegister($params);
        return_json($result);
    }
    /**
     * 用户注册界面
     * @return view
     */
    public function get()
    {
       if (get_login()){//已经登录自动跳转主页
           return redirect('/');
       }
        if (view()->exists('index.register')) {
            return view('index.register');
        }else{
            return '注册页面为更新中';
        }


    }
}
