<?php
/** 下载  */

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Service\DataService;
use http\Env\Response;
use phpDocumentor\Reflection\File;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DownAppController extends Controller
{

    public function showdown($id = 13)
    {
        if ($id !== 13) {
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
            return view('index.dewnloads', compact('data'));
        } else {
            $id = DB::table('admin_app')->orderBy('id', 'desc')->select('id')->first();
            //这里是没有id的
            $id = get_object_vars($id);
            $id = $id['id'];
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
            return view('index.dewnloads', compact('data'));
        }

    }

    public function downloads($id,Request $request){
        $filepath = DB::table('admin_app')->where('id',$id)->select('path')->first();
        if($filepath != null || $filepath!=''){
            $filename = DB::table('admin_app')->where('id',$id)->select('app_title')->first();
            $filepath = get_object_vars($filepath);
            $filename = get_object_vars($filename);
            $filename = $filename['app_title'];
            $filepath = $filepath['path'];
            return response()->download($filepath,$filename);
        }else{
            return redirect('/');
        }




    }
}
