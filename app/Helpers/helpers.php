<?php
/****************************************************************
 * 全局公共函数 v1.0
 *---------------------------------------------------------------
 * $author:wujg $addtime:2018-04-11
 ****************************************************************/

/**
 * 输出友好的调试信息
 *
 * @param mixed $vars 需要判断的日期
 * @return mixed
 */
function t($vars)
{
    if(is_array($vars))
        exit("<pre><br>" . print_r($vars, TRUE) . "<br></pre>".rand(1000,9999));
    else
        exit($vars);
}
/**
 * 返回json结构,并支持ajax跨域
 *
 * @param array  $data 数组
 * @param string $call 匿名函数
 * @return json
 */
function return_json($data = array(), $call = '')
{
    exit(empty($call) ? json_encode($data) : $call.'('.json_encode($data).')');
}
/**
 * 判断是否为邮箱地址
 *
 * @param string  $mail 邮箱地址
 * @param string $call 匿名函数
 * @return boolean
 */
function preg_email($mail='')
{
    if(!$mail) return false;
    $pattern = '/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/i';   //正则表达式
    if(preg_match($pattern, $mail, $matches)){
        return true;
    }else{
        return false;
    }
}
/**
 * 判断字符串是否满足条件
 * @param string  $str  字符串
 * @param int     $min  最小
 * @param int     $max  最大
 * @return boolean
 */
function in_strlen_range($str='',$min=4,$max=16) {
    if(!$str){
        return false;
    }
    if(strlen($str)>=$min && strlen($str)<=$max){
        return true;
    }else{
        return false;
    }
}
/**
 * 密码加密处理函数 后期根据需求设置
 * @param string  $str  字符串
 *
 */
function PasswordEncrypt($param) {
    return md5($param);
}
/**
 * @ setCnfolCookie 注册,登录设置cookie
 *
 */
 function set_cookie($user, $auto=0) {
    $expiretime = time() + 60*60*24*7;//7天
    if($auto) {
        $expiretime = time() + 60*60*24*30;//30天
    }
    foreach($user as $k=>$v){
        setcookie($k, $v,  $expiretime); //用户名
    }
   /// setcookie('username', $user['username'],  $expiretime); //用户名
}
/**
 * @ get_Login 获取用户名称
 *
 * @access private
 * @return string
 */
function get_login() {
    $username = '';
    if(isset($_COOKIE['user_name'])) {
        $username = $_COOKIE['user_name'];
        return $username;
    }else{
        return false;
    }
}
/**
 * @ get_username 获取用户名称
 *
 * @access private
 * @return string
 */
function get_username() {
    $username = '';
    if(isset($_COOKIE['user_name'])) {
        $username = $_COOKIE['user_name'];
        return $username;
    }else{
        return false;
    }
}
/**
 * @ is_admin 判断是否为管理员
 *
 * @access private
 * @return string
 */
function is_admin() {
    $username = '';
    if(isset($_COOKIE['user_name']) && isset($_COOKIE['user_type']) && $_COOKIE['user_type']=='1') {
        $username = $_COOKIE['user_name'];
        return $username;
    }else{
        return false;
    }
}
/* End of file func_helper.php */
/* Location: ./application/helpers/func_helper.php */