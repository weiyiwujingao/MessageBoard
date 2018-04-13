<?php
/**
 * 留言板ajax参数定义  v1.0
 * User: colin
 * Date: 2018/4/12
 * Time: 13:49
 */
namespace App\Http\Controllers;

final class ConfigPrams
{
    const SSUCCES_CODE = 200;//回调函数成功的时候统一返回200

    /*  登录回调参数定义 */
    const LOGIN_EMAIL_CODE      = 302;
    const LOGIN_EMAIL_CODE_MSG  = '用户邮箱地址不符合规定';

    const LOGIN_PASSWORD_CODE      = 303;
    const LOGIN_PASSWORD_CODE_MSG  = '密码不可以是空字符';

    const LOGIN_FAIL_CODE      = 501;
    const LOGIN_FAIL_CODE_MSG = '登录失败请确认！';

    /*  注册回调参数定义 */
    const REGISTER_USERNAME_CODE      = 201;
    const REGISTER_USERNAME_CODE_MSG  = '用户名长度不符合规定';

    const REGISTER_EMAIL_CODE      = 202;
    const REGISTER_EMAIL_CODE_MSG = '用户邮箱地址不符合规定';

    const REGISTER_PASSWORD_CODE     = 203;
    const REGISTER_PASSWORD_CODE_MSG = '密码不一致';

    const REGISTER_FAIL_USERNAME_CODE      = 501;
    const REGISTER_FAIL_USERNAME_CODE_MSG = '注册失败,用户名已存在请确认！';

    const REGISTER_FAIL_EMAIL_CODE      = 502;
    const REGISTER_FAIL_EMAIL_CODE_MSG = '注册失败,邮箱已存在请确认！';

    const REGISTER_FAIL_DATABASE_CODE      = 503;
    const REGISTER_FAIL_DATABASE_CODE_MSG = '注册失败,数据入库发生错误请确认！';

    /*  发言回调参数定义 */
    const SUBMIT_MESSAGE_CODE      = 201;
    const SUBMIT_MESSAGE_CODE_MSG  = '发言长度不符合规定';

    const SUBMIT_MESSAGE_LOGIN_CODE      = 202;
    const SUBMIT_MESSAGE_LOGIN_CODE_MSG  = '用户未登录';

    const SUBMIT_MESSAGE_USER_CODE      = 502;
    const SUBMIT_MESSAGE_USER_CODE_MSG = '发言失败,用户获取错误！';

    const SUBMIT_MESSAGE_FAIL_CODE      = 503;
    const SUBMIT_MESSAGE_FAIL_CODE_MSG = '发言失败,数据入库发生错误请确认！';

    /*  评论回调参数定义 */
    const COMMENT_MESSAGE_CODE      = 201;
    const COMMENT_MESSAGE_CODE_MSG  = '评论长度不符合规定';

    const COMMENT_MESSAGE_LOGIN_CODE      = 202;
    const COMMENT_MESSAGE_LOGIN_CODE_MSG  = '用户未登录';

    const COMMENT_MESSAGE_ID_CODE      = 203;
    const COMMENT_MESSAGE_ID_CODE_MSG  = '用户提交非法参数';

    const COMMENT_MESSAGE_USER_CODE      = 502;
    const COMMENT_MESSAGE_USER_CODE_MSG = '评论失败,用户获取错误！';

    const COMMENT_MESSAGE_FAIL_CODE      = 503;
    const COMMENT_MESSAGE_FAIL_CODE_MSG = '评论失败,数据入库发生错误请确认！';

    const COMMENT_MESSAGE_UPFAIL_CODE      = 504;
    const COMMENT_MESSAGE_UPFAIL_CODE_MSG = '评论成功,评论数量更新发生错误请确认！';

    /*  发言分页回调参数定义 */
    const MESSAGE_PAGE_CODE      = 301;
    const MESSAGE_PAGE_CODE_MSG  = '发言内容分页参数非法';

    /*  回复回调参数定义 */
    const MESSAGE_SUB_CODE      = 301;
    const MESSAGE_SUB_CODE_MSG  = '提交非法参数';

    /*  管理员管理页面回调参数定义 */
    const ADMIN_MESSAGE_CODE      = 201;
    const ADMIN_MESSAGE_CODE_MSG  = '编辑字符串长度不符合规定';

    const ADMIN_MESSAGE_LOGIN_CODE      = 202;
    const ADMIN_MESSAGE_LOGIN_CODE_MSG  = '非法提交用户';

    const ADMIN_MESSAGE_ID_CODE      = 203;
    const ADMIN_MESSAGE_ID_CODE_MSG  = '用户提交非法参数';

    const ADMIN_MESSAGE_CONTENT_CODE      = 501;
    const ADMIN_MESSAGE_CONTENT_CODE_MSG = '编辑字符串失败,内容获取失败！';

    const ADMIN_MESSAGE_USER_CODE      = 502;
    const ADMIN_MESSAGE_USER_CODE_MSG = '编辑字符串失败,用户获取错误！';

    const ADMIN_MESSAGE_FAIL_CODE      = 503;
    const ADMIN_MESSAGE_FAIL_CODE_MSG = '编辑字符串失败,数据入库发生错误请确认！';

    const ADMIN_MESSAGE_DELETE_CODE      = 501;
    const ADMIN_MESSAGE_DELETE_CODE_MSG = '删除字符串失败,内容获取失败！';

    const ADMIN_FAIL_DELETE_CODE      = 502;
    const ADMIN_FAIL_DELETE_CODE_MSG = '删除字符串失败,内容获取失败！';



}