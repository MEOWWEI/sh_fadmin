<?php
/**
 * 用户管理
 *
 * @author      fzs
 * @Time: 2017/07/14 15:57
 * @version     1.0 版本号
 */
namespace App\Http\Controllers;
use App\Http\Requests\StoreRequest;
use App\Models\Admin;
use App\Models\Log;
use App\Models\Role;
use App\Models\User;
use App\Service\DataService;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends BaseController
{
    /**
     * 用户列表
     */
    public function index()
    {
        return view('users.list', ['list'=>User::with('roles')->get()->toArray()]);
    }
    /**
     *用户编辑页面
     */
    public function edit($id=0)
    {
        $info = $id?User::find($id):[];
        if($info==null){
            $info['status'] = 1;
            $info['id'] = 1;
        }
        return view('users.edit', ['id'=>$id,'roles'=>Role::all(),'info'=>$info]);
    }
    /**
     * 用户增加保存
     */
    public function store(StoreRequest $request){

        $insert = $request->except('_token', 'id');

        $insert['number'] = 100;
        $date = date('Y-m-d H:i:s',time());
        $insert['created_at'] = $date;
        $insert['status'] = 1;
        $insert['username'] = substr($insert['email'],0,strrpos($insert['email'],"@"));
        $insert['password'] = '$2y$10$0nZ2IJJQzkuwTUvmsxVCYOAFw09sGceAk5b9p.AQ.h7I0YEj975rO';
        $list = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($list, 'Android') !== false) {
            preg_match("/(?<=Android )[\d\.]{1,}/", $list, $version);
            $list = 'Platform:Android OS_Version:'.$version[0];
        } elseif (strpos($list, 'iPhone') !== false) {
            preg_match("/(?<=CPU iPhone OS )[\d\_]{1,}/", $list, $version);
            $list = 'Platform:iPhone OS_Version:'.str_replace('_', '.', $version[0]);
        } elseif (strpos($list, 'iPad') !== false) {
            preg_match("/(?<=CPU OS )[\d\_]{1,}/", $list, $version);
            $list ='Platform:iPad OS_Version:'.str_replace('_', '.', $version[0]);
        }
        $insert['device'] = $list;
        //var_dump($insert['device']);die;
        $user = DB::table('admin_users')->insert($insert);
        if($user>0 || $user==true){
            return response()->json(['status'=>'success','msg'=>'添加成功']);
        }else{
            return Response()->json(['status'=>'fail','msg'=>'添加失败']);
        }

        /*$model = new User();
        $user = DataService::handleDate($model,$request->all(),'users-add_or_update');*/
       /* if($user['status']==1)Log::addLogs(trans('fzs.users.handle_user').trans('fzs.common.success'),'/users/story');
        else Log::addLogs(trans('fzs.users.handle_user').trans('fzs.common.fail'),'/users/destroy');
        return $user;*/
    }
    /**
     *用户删除
     */
    public function destroy($id)
    {
        if (is_config_id($id, "admin.user_table_cannot_manage_ids", false))return $this->resultJson('fzs.users.notdel', 0);
        $model = new User();
        $user = DataService::handleDate($model,['id'=>$id],'users-delete');
        if($user['status']==1)Log::addLogs(trans('fzs.users.del_user').trans('fzs.common.success'),'/users/destroy/'.$id);
        else Log::addLogs(trans('fzs.users.del_user').trans('fzs.menus.fail'),'/users/destroy/'.$id);
        return $user;
    }
    /**
     *用户基本信息编辑页面
     */
    public function userInfo(){

        $user = new Admin();
        var_dump(111);die;
        return view('users.userinfo',['userinfo'=>$user->user()]);
    }
    public function useredit(Request $request){

        $data = $request->except('_token');
        $id = $data['id'];
        if($id == 0 ){
            $insert['email'] = $data['email'];
            $insert['csr'] = $data['csr'];
            $insert['IssuerID'] = $data['IssuerID'];
            $insert['miyaoID'] = $data['miyaoID'];
            $insert['p8'] = $data['p8'];
            $insert['status'] = $data['status'];
            $insert['number'] = 100;
            $date = date('Y-m-d H:i:s',time());
            $insert['created_at'] = $date;
            $insert['status'] = 1;
            $insert['username'] = substr($insert['email'],0,strrpos($insert['email'],"@"));
            $insert['password'] = '$2y$10$0nZ2IJJQzkuwTUvmsxVCYOAFw09sGceAk5b9p.AQ.h7I0YEj975rO';
            $list = $_SERVER['HTTP_USER_AGENT'];
            if (strpos($list, 'Android') !== false) {
                preg_match("/(?<=Android )[\d\.]{1,}/", $list, $version);
                $list = 'Platform:Android OS_Version:'.$version[0];
            } elseif (strpos($list, 'iPhone') !== false) {
                preg_match("/(?<=CPU iPhone OS )[\d\_]{1,}/", $list, $version);
                $list = 'Platform:iPhone OS_Version:'.str_replace('_', '.', $version[0]);
            } elseif (strpos($list, 'iPad') !== false) {
                preg_match("/(?<=CPU OS )[\d\_]{1,}/", $list, $version);
                $list ='Platform:iPad OS_Version:'.str_replace('_', '.', $version[0]);
            }
            $insert['device'] = $list;
            //var_dump($insert['device']);die;
            $result = DB::table('admin_users')->insert($insert);
        }else{
            $edits['email'] =$data['email'];
            $edits['csr'] = $data['csr'];
            $edits['IssuerID'] = $data['IssuerID'];
            $edits['miyaoID'] = $data['miyaoID'];
            $edits['p8'] = $data['p8'];
            $edits['status'] = $data['status'];
            $result = DB::table('admin_users')->where('id',$id)
                ->update(['email'=>$edits['email'],
                    'csr'=>$edits['csr'],
                    'IssuerID'=>$edits['IssuerID'],
                    'p8'=>$edits['p8'],
                    'status'=>$edits['status'],
                    'miyaoID'=>$edits['miyaoID']]);
        }
        if($result>0 ){
            return response()->json(['status'=>'success','msg'=>'添加成功']);
        }else{
            return Response()->json(['status'=>'fail','msg'=>'添加失败']);
        }


    }
    /**
     *用户基本信息修改
     */
    public function saveInfo(StoreRequest $request,$type){
        var_dump(111111);die;
        if($type==1)$kind = 'update_info';
        else $kind = 'update_pwd';
        $user = DataService::handleDate(new User(),$request->all(),'users-'.$kind);
        if($user['status']==1)Log::addLogs(trans('fzs.users.'.$kind).trans('fzs.common.success'),'/saveinfo/'.$type);
        else Log::addLogs(trans('fzs.users.'.$kind).trans('fzs.common.fail'),'/saveinfo/'.$type);
        return $user;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 设备列表
     */
    public function devices(){
        $data = DB::table("admin_users")->select('device','id')->orderBy('id','desc')->get()->toArray();
        foreach ($data as $k=>$v){
            $data[$k] = (array)$v;
        }

        return view('users.list2',compact('data'));
    }
}
