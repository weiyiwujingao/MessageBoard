<?php
/**
 * 留言板用户发言回复模型层  v1.0
 * User: colin
 * Date: 2018/4/12
 * Time: 13:49
 */
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Content;
use App\Users;
use App\Http\Controllers\ConfigPrams;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * 用户发言内容提交
     *
     * @param array   $params  登录参数
     * @param string  $params[content]  用户邮箱
     * @param array   $result 处理结果
     * @return $result
     */
    public static function userContentSubmit($params)
    {
        $result = array('Code'=>ConfigPrams::SSUCCES_CODE,'msg'=>'发言提交成功！');
        $username = get_username();
        $userid = Users::where('user_name',$username)->first(['user_id']);
        if($userid){
            $userid = $userid->user_id;
        }else{
            $result['Code'] = ConfigPrams::SUBMIT_MESSAGE_LOGIN_CODE;
            $result['msg']  = ConfigPrams::SUBMIT_MESSAGE_LOGIN_CODE_MSG;
            return_json($result);
        }
        if($userid){
            $content = new Content();
            $content->time          = time();
            $content->user_id      = $userid;
            $content->content      = $params['text'];
            $content->user_name    = $username;
            if($content->save()){
                return $result;
            }else{
                $result['Code'] = ConfigPrams::SUBMIT_MESSAGE_FAIL_CODE;
                $result['msg']  = ConfigPrams::SUBMIT_MESSAGE_FAIL_CODE_MSG;
                return_json($result);
            }
        }else{
            $result['Code'] = ConfigPrams::SUBMIT_MESSAGE_USER_CODE;
            $result['msg']  = ConfigPrams::SUBMIT_MESSAGE_USER_CODE_MSG;
            return $result;
        }

    }
    /**
     * 用户登录参数合法性判断
     *
     * @param array   $params  提交参数
     * @param string  $params[text]  内容
     * @param string  $params[id]  内容id
     * @param array   $result 处理结果
     * @return $result
     */
    public static function checkSubmitParams($params){
        if(!in_strlen_range($params['text'],1,255)){
            $result['Code'] = ConfigPrams::SUBMIT_MESSAGE_CODE;
            $result['msg']  = ConfigPrams::SUBMIT_MESSAGE_CODE_MSG;
            return_json($result);
        }
        if(!get_username() || !get_login()){
            $result['Code'] = ConfigPrams::SUBMIT_MESSAGE_LOGIN_CODE;
            $result['msg']  = ConfigPrams::SUBMIT_MESSAGE_LOGIN_CODE_MSG;
            return_json($result);
        }
        if(isset($params['id'])){
            if(!intval($params['id'])){
                $result['Code'] = ConfigPrams::COMMENT_MESSAGE_ID_CODE;
                $result['msg']  = ConfigPrams::COMMENT_MESSAGE_ID_CODE_MSG;
                return_json($result);
            }
        }
        return true;
    }
    /**
     * 用户分页参数合法性判断
     *
     * @param array   $params  登录参数
     * @param string  $params[page]  用户邮箱
     * @param string  $params[pagesize]  用户密码
     * @param array   $result 处理结果
     * @return $result
     */
    public static function checkPageParams($params){
        if(!intval($params['pagesize']) || !intval($params['page'])){
            $result['Code'] = ConfigPrams::MESSAGE_PAGE_CODE;
            $result['msg']  = ConfigPrams::MESSAGE_PAGE_CODE_MSG;
            return_json($result);
        }
        return true;
    }
    //前台分页查询评论集
    public function comments($params)
    {
        return Content::where('parent',0)
            ->orderBy('id','desc')
            ->paginate(6);
    }
    /**
     * 用户评论提交入库
     *
     * @param array   $params  提交的参数
     * @param string  $params[text]  用户评论内容
     * @param string  $params[id]    用户评论留言对象id
     * @param array   $result 处理结果
     * @return $result
     */
    public static function commentSubmit($params){
        $result = array('Code'=>ConfigPrams::SSUCCES_CODE,'msg'=>'评论提交成功！');
        $username = get_username();
        $userid = Users::where('user_name',$username)->first(['user_id']);
        if($userid){
            $userid = $userid->user_id;
        }else{
            $result['Code'] = ConfigPrams::COMMENT_MESSAGE_LOGIN_CODE;
            $result['msg']  = ConfigPrams::COMMENT_MESSAGE_LOGIN_CODE_MSG;
            return_json($result);
        }
        if($userid){
            $content = new Content();
            $content->time          = time();
            $content->user_id      = $userid;
            $content->content      = $params['text'];
            $content->user_name    = $username;
            $content->parent       = $params['id'];
            if($content->save()){
                $content = new Content();
                $content = Content::find($params['id']);
                $content->number = $content->number+1;
                if($content->save()){
                    return $result;
                }else{
                    $result['Code'] = ConfigPrams::COMMENT_MESSAGE_UPFAIL_CODE;
                    $result['msg']  = ConfigPrams::COMMENT_MESSAGE_UPFAIL_CODE_MSG;
                    return_json($result);
                }
            }else{
                $result['Code'] = ConfigPrams::COMMENT_MESSAGE_USER_CODE;
                $result['msg']  = ConfigPrams::COMMENT_MESSAGE_USER_CODE_MSG;
                return_json($result);
            }
        }else{
            $result['Code'] = ConfigPrams::COMMENT_MESSAGE_FAIL_CODE;
            $result['msg']  = ConfigPrams::COMMENT_MESSAGE_FAIL_CODE_MSG;
            return $result;
        }
    }
    /**
     * 用户查看回复参数合法性判断
     *
     * @param array   $params  提交参数
     * @param string  $params[id]  内容id
     * @param array   $result 处理结果
     * @return $result
     */
    public static function checkSubParams($params){
            if(!isset($params['id']) || !intval($params['id'])){
                $result['Code'] = ConfigPrams::MESSAGE_SUB_CODE;
                $result['msg']  = ConfigPrams::MESSAGE_SUB_CODE_MSG;
                return_json($result);
            }
        return true;
    }

}