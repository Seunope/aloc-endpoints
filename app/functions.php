<?php

use App\Models\ApiCallIpAddress;

function subjectArray (){
   return ['english', 'mathematics', 'commerce', 'accounting', 'biology', 'physics', 'chemistry', 'englishlit', 'government', 'crk', 'geography', 'economics', 'irk', 'civiledu', 'insurance', 'currentaffairs', 'history'];
}

function examTypeArray(){
    return ['waec', 'jamb', 'neco', 'post-utme'];
}

function querySampleArray1(){
    return ['https://questions.aloc.ng/api/q?subject=english',
        'https://questions.aloc.ng/api/q?subject=english&year=2010',
        'https://questions.aloc.ng/api/q?subject=insurance&type=wassce',
        'https://questions.aloc.ng/api/q?subject=english&year=2009&type=utme'];
}

function querySampleArray2(){
    return ['https://questions.aloc.ng/api/q/0?subject=english',
        'https://questions.aloc.ng/api/q/1?subject=english&year=2010',
        'https://questions.aloc.ng/api/q/2?subject=insurance&type=wassce',
        'https://questions.aloc.ng/api/q/3?subject=english&year=2009&type=utme'];
}

function randomSubjects(){
    return array_random(subjectArray(), 7);

}

function storeQuestionRequestByIP($subject){
    $userIp = request()->getClientIp(true);
    $res =  ApiCallIpAddress::where(['ipAddress' => $userIp,'subject' => $subject] )->get();
    if(!$res->isEmpty()){
        $res = $res->first();
        $count = $res->requestCount + 1;
        $res::where('id','=', $res->id)->update(['requestCount'=>$count]);
    }else{
        $data['subject'] = $subject;
        $data['ipAddress'] = $userIp;
        ApiCallIpAddress::create($data);
    }
}
