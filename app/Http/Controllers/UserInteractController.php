<?php
/**
 * 留言板用户交互数据处理模型层  v1.0
 * User: colin
 * Date: 2018/4/12
 * Time: 13:49
 */
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Users;
use App\Http\Controllers\ConfigPrams;

class UserInteractController extends Controller
{
    /**
     * 用户登录处理
     *
     * @param array   $params  登录参数
     * @param string  $params[user_email]  用户邮箱
     * @param string  $params[user_password]  用户密码
     * @param array   $result 处理结果
     * @return $result
     */
    public static function userLogin($params)
    {
        $result = array('Code'=>ConfigPrams::SSUCCES_CODE,'msg'=>'登录成功！');
        $params['user_password'] = PasswordEncrypt($params['user_password']);
        $user = Users::where(['user_email'=>$params['user_email'],'user_password'=>$params['user_password']])->first(['user_id','user_name', 'user_type']);
        if($user){
            $dataname = json_decode(json_encode($user),true);
            set_cookie($dataname);
            return $result;
        }else{
            $result['Code'] = ConfigPrams::LOGIN_FAIL_CODE;
            $result['msg']  = ConfigPrams::LOGIN_FAIL_CODE_MSG;
            return $result;
        }

    }
    /**
     * 用户登录参数合法性判断
     *
     * @param array   $params  登录参数
     * @param string  $params[user_email]  用户邮箱
     * @param string  $params[user_password]  用户密码
     * @param array   $result 处理结果
     * @return $result
     */
    public static function checkLoginParams($params){
        if(!preg_email($params['user_email'])){
            $result['Code'] = ConfigPrams::LOGIN_EMAIL_CODE;
            $result['msg']  = ConfigPrams::LOGIN_EMAIL_CODE_MSG;
            return_json($result);
        }
        if(!isset($params['user_password']) || !trim($params['user_password'])){
            $result['Code'] = ConfigPrams::LOGIN_PASSWORD_CODE;
            $result['msg']  = ConfigPrams::LOGIN_PASSWORD_CODE_MSG;
            return_json($result);
        }
        return true;
    }
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
    public static function userRegister($params)
    {
        $result = array('Code'=>ConfigPrams::SSUCCES_CODE,'msg'=>'注册成功！');
        $params['user_password'] = PasswordEncrypt($params['user_password']);
        $user = Users::where('user_name',$params['user_name'])->first(['user_name']);
        if(!$user){
            $user = Users::where('user_email',$params['user_email'])->first(['user_name']);
            if(!$user){
                $user = new Users();
                $user->time           = time();
                $user->user_sex      = $params['user_gender'];
                $user->user_name     = $params['user_name'];
                $user->user_email    = $params['user_email'];
                $user->user_password = $params['user_password'];
                if($user->save()){
                    $dataname = array('user_name'=>$params['user_name']);
                    set_cookie($dataname);
                    return $result;
                }else{
                    $result['Code'] = ConfigPrams::REGISTER_FAIL_DATABASE_CODE;
                    $result['msg']  = ConfigPrams::REGISTER_FAIL_DATABASE_CODE_MSG;
                    return $result;
                }
            }else{
                $result['Code'] = ConfigPrams::REGISTER_FAIL_EMAIL_CODE;
                $result['msg']  = ConfigPrams::REGISTER_FAIL_EMAIL_CODE_MSG;
                return $result;
            }
        }else{
            $result['Code'] = ConfigPrams::REGISTER_FAIL_USERNAME_CODE;
            $result['msg']  = ConfigPrams::REGISTER_FAIL_USERNAME_CODE_MSG;
            return $result;
        }

    }
    /**
     * 用户注册参数合法性判断
     *
     * @param array   $params  登录参数
     * @param string  $params[user_name]  用户名称
     * @param string  $params[user_email]  用户邮箱
     * @param string  $params[user_password]  用户密码
     * @param array   $result 处理结果
     * @return $result
     */
    public static function checkRegisterParams($params){
        if(!in_strlen_range($params['user_name'])){
            $result['Code'] = ConfigPrams::REGISTER_USERNAME_CODE;
            $result['msg']  = ConfigPrams::REGISTER_USERNAME_CODE_MSG;
            return_json($result);
        }
        if(!preg_email($params['user_email'])){
            $result['Code'] = ConfigPrams::REGISTER_EMAIL_CODE;
            $result['msg']  = ConfigPrams::REGISTER_EMAIL_CODE_MSG;
            return_json($result);
        }
        if(!isset($params['user_password']) || $params['user_password'] != $params['user_password_confirmation']) {
            $result['Code'] = ConfigPrams::REGISTER_PASSWORD_CODE;
            $result['msg'] = ConfigPrams::REGISTER_PASSWORD_CODE;
            return_json($result);
        }
        return true;
    }
}