<?php
/**
 * 应用上传
 *
 * @author      MEOWWEI
 * @Time: 2019-11-12 11:04:05
 * @version     1.0 版本号
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Service\DataService;
use http\Env\Response;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends BaseController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *  应用大致显示
     */
    public function index()
    {
        $data = DB::table('admin_app')->orderBy('id', 'desc')->select('id', 'app_title', 'icon', 'edition', 'a_down', 'a_down_limit')->get()->toArray();
        foreach ($data as $k => $v) {
            $data[$k] = (array)$v;
        }
        return view('app.list', compact('data'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 应用详情
     */
    public function applist($id)
    {
        $data = DB::table('admin_app')->where('id', $id)->first();
        $data = get_object_vars($data);//转数组

        $img = $data['img'];
        if (strpos($img, '|') == false) {
            $data['img'] = $img;
            $data['img1'] = $img;
        } else {
            $data['img1'] = substr($img, 0, strrpos($img, '|'));
            $data['img'] = substr($img, strripos($img, '|') + 1);
        }

        return view('app.appxq', compact('data'));
    }

    /**
     * @param $id
     * @param Request $request
     * 图标icon上传
     */
    public function appicon($id, Request $request)
    {
        if ($request->isMethod('POST')) { //判断文件是否是 POST的方式上传
            $tmp = $request->file('file');
            $path = '/uploads/ico'; //public下的article
            if ($tmp->isValid()) { //判断文件上传是否有效
                $FileType = $tmp->getClientOriginalExtension(); //获取文件后缀

                $FilePath = $tmp->getRealPath(); //获取文件临时存放位置

                $FileName = date('YmdHis') . uniqid() . '.' . $FileType; //定义文件名

                Storage::disk('article')->put($FileName, file_get_contents($FilePath)); //存储文件

                //路径存数据库
                $pathdb = $path . '/' . $FileName;
                $db = DB::table('admin_app')->where('id', $id)->update(['icon' => $pathdb]);
                if ($db > 0) {
                    return redirect('/apps');
                }
            }
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 二维码
     */
    public function appeq($id, Request $request)
    {
        if ($request->isMethod('POST')) { //判断文件是否是 POST的方式上传
            $tmp = $request->file('file');
            $path = '/uploads/ico'; //public下的article
            if ($tmp->isValid()) { //判断文件上传是否有效
                $FileType = $tmp->getClientOriginalExtension(); //获取文件后缀

                $FilePath = $tmp->getRealPath(); //获取文件临时存放位置

                $FileName = date('YmdHis') . uniqid() . '.' . $FileType; //定义文件名

                Storage::disk('article')->put($FileName, file_get_contents($FilePath)); //存储文件

                //路径存数据库
                $pathdb = $path . '/' . $FileName;
                $db = DB::table('admin_app')->where('id', $id)->update(['a_qr' => $pathdb]);
                if ($db > 0) {
                    return redirect('/apps');
                }
            }
        }
    }

    /**
     * @return int
     * 既点既改
     */
    public function apptitles()
    {
        $arr = Input::get();//接收ajax传递的参数
        $result = DB::table('admin_app')->where('id', $arr['id'])->update(['app_title' => $arr['username']]);
        //var_dump($result);
        if ($result) {
            $status = 1;
        } else {
            $status = 2;
        }
        return $status; //将结果返回给展示页面
    }

    public function editjdjg()
    {
        $arr = Input::get();//接收ajax传递的参数
        $result = DB::table('admin_app')->where('id', $arr['id'])->update(['f_title' => $arr['username']]);
        //var_dump($result);
        if ($result) {
            $status = 1;
        } else {
            $status = 2;
        }
        return $status; //将结果返回给展示页面
    }

    public function fage()
    {
        $arr = Input::get();
        $result = DB::table('admin_app')->where('id', $arr['id'])->update(['f_age' => $arr['username']]);
        if ($result) {
            $status = 1;
        } else {
            $status = 2;
        }
        return $status; //将结果返回给展示页面
    }

    public function clas()
    {
        $arr = Input::get();
        $result = DB::table('admin_app')->where('id', $arr['id'])->update(['f_class' => $arr['username']]);
        if ($result) {
            $status = 1;
        } else {
            $status = 2;
        }
        return $status; //将结果返回给展示页面
    }

    public function rlak()
    {
        $arr = Input::get();
        $result = DB::table('admin_app')->where('id', $arr['id'])->update(['f_ranking' => $arr['username']]);
        if ($result) {
            $status = 1;
        } else {
            $status = 2;
        }
        return $status; //将结果返回给展示页面
    }

    public function score()
    {
        $arr = Input::get();
        $result = DB::table('admin_app')->where('id', $arr['id'])->update(['f_score' => $arr['username']]);
        if ($result) {
            $status = 1;
        } else {
            $status = 2;
        }
        return $status; //将结果返回给展示页面
    }

    public function nums()
    {
        $arr = Input::get();
        $result = DB::table('admin_app')->where('id', $arr['id'])->update(['f_score_num' => $arr['username']]);
        if ($result) {
            $status = 1;
        } else {
            $status = 2;
        }
        return $status; //将结果返回给展示页面
    }

    public function brief()
    {
        $arr = Input::get();
        $result = DB::table('admin_app')->where('id', $arr['id'])->update(['f_brief' => $arr['username']]);
        if ($result) {
            $status = 1;
        } else {
            $status = 2;
        }
        return $status; //将结果返回给展示页面
    }

    public function atitle()
    {
        $arr = Input::get();
        $result = DB::table('admin_app')->where('id', $arr['id'])->update(['a_title' => $arr['username']]);
        if ($result) {
            $status = 1;
        } else {
            $status = 2;
        }
        return $status; //将结果返回给展示页面
    }

    public function aname()
    {
        $arr = Input::get();
        $result = DB::table('admin_app')->where('id', $arr['id'])->update(['a_name' => $arr['username']]);
        if ($result) {
            $status = 1;
        } else {
            $status = 2;
        }
        return $status; //将结果返回给展示页面
    }

    public function limitnum()
    {
        $arr = Input::get();
        $result = DB::table('admin_app')->where('id', $arr['id'])->update(['a_down_limit' => $arr['username']]);
        if ($result) {
            $status = 1;
        } else {
            $status = 2;
        }
        return $status; //将结果返回给展示页面
    }

    public function adesc()
    {
        $arr = Input::get();
        $result = DB::table('admin_app')->where('id', $arr['id'])->update(['a_desc' => $arr['username']]);
        if ($result) {
            $status = 1;
        } else {
            $status = 2;
        }
        return $status; //将结果返回给展示页面
    }


    /**
     * @param $id
     * @param Request $request
     * @return mixed
     * 图片
     */
    public function uploadsimgs($id, Request $request)
    {
        $datass  = DB::table('admin_app')->where('id',$id)->select('img')->first();
        $datass = get_object_vars($datass);
        $datass = $datass['img'];
        $file = $request->except('_token');
        $file = $file['goods_imgs'];
        $path = '/uploads/ico';
        if (!is_array($file)) {
            //if ($file->isValid()) {
            //获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            echo 111;
            var_dump($originalName);
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg

            if (!in_array($ext, ['jpg', 'jpeg', 'gif', 'png'])) return false;
            // 上传
            $filename = date('YmdHis') . '-' . uniqid() . '.' . $ext;

            Storage::disk('article')->put($filename, file_get_contents($realPath)); //存储文件
            //路径存数据库
            $pathdb = $path . '/' . $filename;

            if($datass !='' || $datass != null){
                $pathdb = $datass.'|'.$pathdb;
                $db = DB::table('admin_app')->where('id', $id)->update(['img' => $pathdb]);
            }else{
                $db = DB::table('admin_app')->where('id', $id)->update(['img' => $pathdb]);
            }
            if ($db > 0) {
                return redirect('/apps');
            }
        } else {
            $data = [];
            $path = '/uploads/ico';
            foreach ($file as $files) {
                //if ($files->isValid()) {
                // 获取文件相关信息
                $originalName = $files->getClientOriginalName(); // 文件原名
                $ext = $files->getClientOriginalExtension();     // 扩展名
                $realPath = $files->getRealPath();   //临时文件的绝对路径
                $type = $files->getClientMimeType();     // image/jpeg

                if (!in_array($ext, ['jpg', 'jpeg', 'gif', 'png'])) return false;
                // 上传文件
                $file_name = date('YmdHis') . '-' . uniqid() . '.' . $ext;
                Storage::disk('article')->put($file_name, file_get_contents($realPath)); //存储文件
                //路径存数据库
                $pathdb = $path . '/' . $file_name;
                if($datass !='' || $datass != null){
                    $pathdb = $datass.'|'.$pathdb;
                    $db = DB::table('admin_app')->where('id', $id)->update(['img' => $pathdb]);
                }else{
                    $db = DB::table('admin_app')->where('id', $id)->update(['img' => $pathdb]);
                }
                if ($db > 0) {
                    return redirect('/apps');
                }
            }
        }
    }
    /*if ($request->isMethod('POST')) { //判断文件是否是 POST的方式上传
        $tmp = $request->file('file');
        $path = '/uploads/ico'; //public下的article
        if ($tmp->isValid()) { //判断文件上传是否有效
            $FileType = $tmp->getClientOriginalExtension(); //获取文件后缀

            $FilePath = $tmp->getRealPath(); //获取文件临时存放位置

            $FileName = date('YmdHis') . uniqid() . '.' . $FileType; //定义文件名

            Storage::disk('article')->put($FileName, file_get_contents($FilePath)); //存储文件

            //路径存数据库
            $pathdb = $path.'/'.$FileName;
            $cat = DB::table('admin_app')->where('id',$id)->select('img')->first();
            $cat = get_object_vars($cat);
            $cat = $cat['img'];
            if($cat != ''){
                $pathdb = $cat.'|'.$pathdb;
                $db= DB::table('admin_app')->where('id',$id)->update(['img'=>$pathdb]);
            }else{
                $db = DB::table('admin_app')->where('id',$id)->update(['img'=>$pathdb]);
            }
            if($db>0){
                return redirect('/apps');
            }
        }
    }*/


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 应用上传显示
     */
    public function uploads()
    {
        return view('app.upload');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 上传处理
     */
    public function fileuploads(Request $request)
    {

        //$data = $request->all();
        $file = $request->file('picture');    //获取文件所有信息
        if ($file == null || $file == '') {
            return redirect('/apps');
        }
        $path = '';

        $fileextension = $file->getClientOriginalName();//获取文件原名称
        $filesize = $file->getClientSize();//文件大小b
        $filesize = round($filesize / 1024 / 1024, 2);//文件大小

        //var_dump($filesize);
        if ($file->isValid()) { //判断文件是否存在
            $clientName = $file->getClientOriginalName();    //客户端文件名称..
            $entension = $file->getClientOriginalExtension();   //上传文件的后缀.
            $newName = md5(date('Ymdhis') . $clientName) . "." . $entension;    //定义      上传文件的新名称
            $path = $file->move('public/file', $newName);    //把缓存文件移动到指定文件夹

            $db = DB::table('admin_app')->insert(['app_title' => $fileextension, 'app_id' => $fileextension, 'filesize' => $filesize, 'a_title' => $fileextension, 'path' => $path]);
            if ($db > 0) {
                return redirect('/apps');
            }
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *  软件删除，注会同时删除本地上传的
     */
    public function deldata($id)
    {
        $src = DB::table('admin_app')->select('path')->where('id', $id)->first();
        $src = (array)$src;
        $src = $src['path'];
        $db = DB::table('admin_app')->where('id', $id)->delete();
        if ($db > 0) {
            if ($src != null || $src != '') {
                $res = unlink($src);
                return redirect('/apps/');
            } else {
                return redirect('/apps/');
            }
        } else {
            return redirect('/apps/');
        }


    }


}