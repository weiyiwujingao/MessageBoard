<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 2018/4/11
 * Time: 15:56
 */
namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminModController;
use Illuminate\Http\Request;
//use App\Content;


class AdminController extends Controller
{
    /**
     * 管理页面
     * @return view
     */
    public function admin()
    {
        if(is_admin()){
            return view('index.admin');
        }else {
            return redirect('/');
        }
    }
    /**
     * 管理员编辑用户发言
     *
     * @param array   $params  登录参数
     * @param string  $params[text]  用户评论内容
     * @param string  $params[id]    用户评论留言对象id
     * @param array   $result 处理结果
     * @return $result
     */
    public function edit(Request $request)
    {
        $params = $request->all();
        //参数提交判断是否合法
        AdminModController::checkSubmitParams($params);
        $result =  AdminModController::commentEdit($params);
        return_json($result);
    }
    /**
     * 管理员编辑用户发言
     *
     * @param array   $params  登录参数
     * @param string  $params[chid]  1为回复 其他的为发言
     * @param string  $params[id]    用户评论留言对象id
     * @param array   $result 处理结果
     * @return $result
     */
    public function delete(Request $request)
    {
        $params = $request->all();
        //参数提交判断是否合法
        AdminModController::checkDelsubParams($params);
        $result =  AdminModController::commentDelete($params);
        return_json($result);
    }
}