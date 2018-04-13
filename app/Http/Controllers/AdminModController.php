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
use App\Http\Controllers\ConfigPrams;
use Illuminate\Http\Request;

class AdminModController extends Controller
{
    /**
     * 管理员编辑操作提交参数判断
     *
     * @param array   $params  提交参数
     * @param string  $params[text]  内容
     * @param string  $params[id]  内容id
     * @param array   $result 处理结果
     * @return $result
     */
    public static function checkSubmitParams($params){
        if(!in_strlen_range($params['text'],1,255)){
            $result['Code'] = ConfigPrams::ADMIN_MESSAGE_CODE;
            $result['msg']  = ConfigPrams::ADMIN_MESSAGE_CODE_MSG;
            return_json($result);
        }
        if(!get_username() || !get_login()  || !is_admin()){
            $result['Code'] = ConfigPrams::ADMIN_MESSAGE_LOGIN_CODE;
            $result['msg']  = ConfigPrams::ADMIN_MESSAGE_LOGIN_CODE_MSG;
            return_json($result);
        }

        if(!isset($params['id']) || !intval($params['id'])){
            $result['Code'] = ConfigPrams::ADMIN_MESSAGE_ID_CODE;
            $result['msg']  = ConfigPrams::ADMIN_MESSAGE_ID_CODE_MSG;
            return_json($result);
        }
        return true;
    }
    /**
     * 管理员删除操作提交参数判断
     *
     * @param array   $params  提交参数
     * @param string  $params[child]  1为回复，其他为发言
     * @param string  $params[id]  内容id
     * @param array   $result 处理结果
     * @return $result
     */
    public static function checkDelsubParams($params){
        if(!get_username() || !get_login()  || !is_admin()){
            $result['Code'] = ConfigPrams::ADMIN_MESSAGE_LOGIN_CODE;
            $result['msg']  = ConfigPrams::ADMIN_MESSAGE_LOGIN_CODE_MSG;
            return_json($result);
        }
        if(!isset($params['id']) || !intval($params['id'])){
            $result['Code'] = ConfigPrams::ADMIN_MESSAGE_ID_CODE;
            $result['msg']  = ConfigPrams::ADMIN_MESSAGE_ID_CODE_MSG;
            return_json($result);
        }
        return true;
    }
    /**
     * 管理员编辑留言内容
     *
     * @param array   $params  提交的参数
     * @param string  $params[text]  用户评论内容
     * @param string  $params[id]    用户评论留言对象id
     * @param array   $result 处理结果
     * @return $result
     */
    public static function commentEdit($params){
        $result = array('Code'=>ConfigPrams::SSUCCES_CODE,'msg'=>'编辑成功！');
        $data = Content::where('id',$params['id'])->first();
        if($data){
            //编辑内容不变
            if($data['content']==$params['text']){
                return $result;
            }
        }else{
            $result['Code'] = ConfigPrams::ADMIN_MESSAGE_CONTENT_CODE;
            $result['msg']  = ConfigPrams::ADMIN_MESSAGE_CONTENT_CODE_MSG;
            return_json($result);
        }
        $content = new Content();
        $content = Content::find($params['id']);
        $content->time          = time();
        $content->content      = $params['text'];
        if($content->save()){
            return $result;
        }else{
            $result['Code'] = ConfigPrams::ADMIN_MESSAGE_FAIL_CODE;
            $result['msg']  = ConfigPrams::ADMIN_MESSAGE_FAIL_CODE_MSG;
            return_json($result);
        }
    }
    /**
     * 管理员删除留言内容
     *
     * @param array   $params  提交的参数
     * @param string  $params[chid]  1为回复其他为发言
     * @param string  $params[id]    用户评论留言对象id
     * @param array   $result 处理结果
     * @return $result
     */
    public static function commentDelete($params){
        $result = array('Code'=>ConfigPrams::SSUCCES_CODE,'msg'=>'删除成功！');
        $data = Content::where('id',$params['id'])->first();
        if($data){
            //删除发言和相关回复
            if($data['parent']==0){
                $content = new Content();
                if($content->where('id', $params['id'])->orWhere('parent', $params['id'])->delete()){
                    return $result;
                }else{
                    $result['Code'] = ConfigPrams::ADMIN_FAIL_DELETE_CODE;
                    $result['msg']  = ConfigPrams::ADMIN_FAIL_DELETE_CODE_MSG;
                    return_json($result);
                }

            }else{//删除单条回复内容
                $comment = Content::find($params['id']);
                if($comment){
                    if($comment->delete()){
                        $content = Content::find($data['parent']);
                        $content->number = $content->number-1;
                        $content->save();
                        return $result;
                    }
                }else{
                    $result['Code'] = ConfigPrams::ADMIN_FAIL_DELETE_CODE;
                    $result['msg']  = ConfigPrams::ADMIN_FAIL_DELETE_CODE_MSG;
                    return_json($result);
                }
            }
        }else{
            $result['Code'] = ConfigPrams::ADMIN_MESSAGE_DELETE_CODE;
            $result['msg']  = ConfigPrams::ADMIN_MESSAGE_DELETE_CODE_MSG;
            return_json($result);
        }

    }

}