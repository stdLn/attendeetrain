<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use Illuminate\Support\Str;
use View;
class AttendanceController extends Controller
{
    public function getQRcode( $courseCode, $section){
        $r=Attendance::where('courseCode',$courseCode)->where('section',$section)->first();
        $tkey=Str::random(32);
        $r->key=$tkey;
        $r->count=0;
        $r->save();

        $data=array(
            "courseCode"=>$courseCode,
            "section"=>$section,
            "src"=>"https://chart.googleapis.com/chart?cht=qr&chs=500x500&chl=".urlencode($courseCode.';'.$section.";".$tkey)
        );
        // echo $data['src'];
        return View::make("attendance")->with("data",$data);

    }
}
