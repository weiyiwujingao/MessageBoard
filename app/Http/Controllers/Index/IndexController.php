<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 2018/4/11
 * Time: 15:56
 */
namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use App\Content;


class IndexController extends Controller
{
    /**
     * 首页视图显示
     * @return view
     */
    public function get()
    {
        return view('index.index');
    }
    /**
     * 用户发言内容提交
     *
     * @param array   $params  登录参数
     * @param string  $params[content]  用户邮箱
     * @param array   $result 处理结果
     * @return $result
     */
    public function content(Request $request)
    {
        $params = $request->all();
        //参数提交判断是否合法
        MessageController::checkSubmitParams($params);
        $result =  MessageController::userContentSubmit($params);
        return_json($result);
    }
    /**
     * 用户发言分页
     *
     * @param array   $params  登录参数
     * @param string  $params[content]  用户邮箱
     * @param array   $result 处理结果
     * @return $result
     */
    public function comment(Request $request)
    {
        $result =  Content::where('parent',0)
            ->orderBy('id','desc')
            ->paginate(5);
        return_json($result);
    }
    /**
     * 用户回复评论内容提交
     *
     * @param array   $params  登录参数
     * @param string  $params[text]  用户评论内容
     * @param string  $params[id]    用户评论留言对象id
     * @param array   $result 处理结果
     * @return $result
     */
    public function sub(Request $request)
    {
        $params = $request->all();
        //参数提交判断是否合法
        MessageController::checkSubmitParams($params);
        $result =  MessageController::commentSubmit($params);
        return_json($result);
    }
    /**
     * 用户发言分页
     *
     * @param array   $params  登录参数
     * @param string  $params[content]  用户邮箱
     * @param array   $result 处理结果
     * @return $result
     */
    public function subreview(Request $request)
    {
        $params = $request->all();
        //参数提交判断是否合法
        MessageController::checkSubParams($params);
        $result =  Content::where('parent',$params['id'])
            ->orderBy('id','desc')
            ->paginate(100);
        return_json($result);
    }
}