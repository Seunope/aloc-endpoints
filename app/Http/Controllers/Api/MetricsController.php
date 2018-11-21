<?php

namespace App\Http\Controllers\Api;

use App\Models\QLoader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class MetricsController extends Controller
{
    public function subjectsApiCallCounts(){

        $subjectTable = subjectArray();
        $totalSubject = count($subjectTable);
        $question = new QLoader;
        $totalQuestionsAPiCalls  = 0;
        $data = [];
        for ($i=0; $i < $totalSubject; $i++){

            try{
                $question->setTable($subjectTable[$i]);
                $subject = $question->get()->sum('requestCount');
                $totalQuestionsAPiCalls = $totalQuestionsAPiCalls + $subject;
                $data[] = ucfirst($subjectTable[$i])." =>".formatNumber($subject);
            }catch (\Exception $e){
                $data[] = ucfirst($subjectTable[$i])." =>Not found";
            }
        }
        $res['message'] = "Metrics on API subject calls";
        $res['status'] = 200;
        $res['data'] = (object) $data;
        $res['questions-called-by-api'] = formatNumber($totalQuestionsAPiCalls);


        return response()->json($res, 200, [], JSON_PRETTY_PRINT);

    }
}
