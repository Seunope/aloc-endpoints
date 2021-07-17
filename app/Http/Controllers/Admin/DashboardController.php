<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use App\Models\AccessTokenCall;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index (){
        $data['tracker'] = $this->questionRequest();
        $data['topMetrics'] = $this->topMetrics();
        //dd($data);
        return view('admin.dashboard')->with($data);
    }


    private function questionRequest(){

        $userId =auth()->user()->id;
        $res= AccessTokenCall::whereUserId(['$userId'=> $userId])->get()
             ->groupBy('subject');
        $data = Array();
        $questionCalls = 0;
        if(!$res->isEmpty()){

            $subjectCount = 0;
            foreach ($res as $subjectCalls){
                 $groupCounter = 0;
                 $requestCount = 0 ;
                 foreach ($subjectCalls as $calls){
                     $groupCounter++;
                     $requestCount += $calls->requestCount;
                     $questionCalls += $calls->requestCount;
                     $data[$subjectCount]['subject'] = $calls->subject;
                     $data[$subjectCount]['count'] = $requestCount;
                     $data[$subjectCount]['lastCall'] = $calls->updated_at;
                     $data[$subjectCount]['token'] = $groupCounter;
                 }
                 $subjectCount++;
             }
        }
        $finalData['questionCalls'] = $questionCalls;
        $finalData['subjectTracker'] = $data;

        return $finalData;
    }

    private function topMetrics(){
        $user =auth()->user();
        $access = AccessToken::whereUserId($user->id)->first();

        $data['accessCount'] = $access->count;
        $data['plan'] = $user->pricePlan;
        return $data;

    }
}
