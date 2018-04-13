<?php
/**
 * 留言板用户登录操作类  v1.0
 * User: colin
 * Date: 2018/4/12
 * Time: 13:49
 */

namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Http\Controllers\UserInteractController;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * 用户登录界面,已登录用户直接跳转首页
     * @return view
     */
    public function get(Request $request)
    {
        if(get_login()){
            return redirect('/');
        }else {
            return view('index.login');
        }
    }
    /**
     * 用户登录处理
     *
     * @param array   $params  登录参数
     * @param string  $params[user_email]  用户邮箱
     * @param string  $params[user_password]  用户密码
     * @param array   $result 处理结果
     * @return $result
     */
    public function login(Request $request)
    {
        $params = $request->all();
        UserInteractController::checkLoginParams($params);//判断参数是否合法
        $result = UserInteractController::userLogin($params);//登录操作
        return_json($result);
    }

}