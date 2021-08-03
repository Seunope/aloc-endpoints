<?php

use App\Models\ApiCallIpAddress;
use Illuminate\Support\Arr;

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
    return Arr::random(subjectArray(), 7);

}

function storeQuestionRequestByIP($subject){
    $userIp =  request()->getClientIp(true);
    $locationData = \Location::get( $userIp);
    //dd($locationData);

    $res =  ApiCallIpAddress::where(['ipAddress' => $userIp,'subject' => $subject] )->get();
    if(!$res->isEmpty()){
        $res = $res->first();
        $count = $res->requestCount + 1;
        $res::where('id','=', $res->id)->update(['requestCount'=>$count,'countryCode'=>$locationData->countryCode,
            'countryName'=>$locationData->countryName,'regionName'=>$locationData->regionName,]);
    }else{

        $data['countryCode'] = $locationData->countryCode;
        $data['countryName'] = $locationData->countryName ;
        $data['regionCode'] = $locationData->regionCode ;
        $data['regionName'] = $locationData->regionName ;
        $data['cityName'] = $locationData->cityName ;
        $data['zipCode'] = $locationData->zipCode;
        $data['latitude'] = $locationData->latitude ;
        $data['longitude'] = $locationData->longitude;

        $data['subject'] = $subject;
        $data['ipAddress'] = $userIp;
        ApiCallIpAddress::create($data);
    }
}

function formatNumber($num)
{
    return number_format($num, 0, '.', ',');
}

function payStackVerifyTransaction ($transactionReference) {

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => env('PAYSTACK_BASE_URL')."/transaction/verify/".$transactionReference,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        return $err;
    } else {
        return json_decode($response);
    }
}
