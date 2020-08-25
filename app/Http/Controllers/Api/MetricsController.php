<?php

namespace App\Http\Controllers\Api;

use App\Models\QLoader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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

    public function availableSubjects(){
        $subjects = subjectArray();
        $res['message'] = "Subject available";
        $res['status'] = 200;
        $res['data'] = (object)$subjects;

        return response()->json($res, 200, [], JSON_PRETTY_PRINT);
    }

    public function subjectAvailableForYear($year)
    {
        if (isset($year) && $year != "") {

            if(!is_numeric($year)){
                $res['message'] = 'Enter numbers only';
                $res['status'] = 400;
                $res['data'] = array();

                return response()->json($res, 400, [], JSON_PRETTY_PRINT);
            }
            $subjectTable = subjectArray();
            $subjectNub = count($subjectTable);
            $subjectAvailable = array();

            try {

                $question = new QLoader;
                $itemCounter = 0;
                for($i=0; $i < $subjectNub; $i++){
                    $question->setTable($subjectTable[$i]);
                    $resData= $question->where(['examyear' => $year])->get();
                    if(!$resData->isEmpty()){
                        $subjectAvailable[$itemCounter]['subject'] = $subjectTable[$i];
                        $subjectAvailable[$itemCounter]['questions'] = count($resData);
                        $itemCounter++;
                    }
                }
                $res['message'] = 'Subjects available for year'.$year;
                $res['status'] = 200;
                $res['data'] =  $subjectAvailable;

                return response()->json($res, 200, [], JSON_PRETTY_PRINT);

            } catch (\Exception $e) {
                //dd($e);
                $data = null;
                $data ['error'] = "Something strange just happened";
                $data['status'] = 406;

                return response()->json($data, 406, [], JSON_PRETTY_PRINT);
            }

        } else {
            $data ['error'] = "Year not supplied";
            $data['status'] = 400;
            return response()->json($data, 400, [], JSON_PRETTY_PRINT);
        }
    }

    public function yearAvailableForSubject($subject)
    {
        if (isset($subject) && $subject != "") {

            try {

                $question = new QLoader;
                $question->setTable($subject);
                $resData= $question ->select(DB::raw('count(*) as questions, examyear'))->groupBy('examyear')->get();

                $res['message'] = 'Years available for '.$subject;
                $res['status'] = 200;
                $res['data'] =  $resData;

                return response()->json($res, 200, [], JSON_PRETTY_PRINT);

            } catch (\Exception $e) {
                $subject = (object) subjectArray();
                $type = (object) examTypeArray();
                $querySample = (object) querySampleArray1();
                $data = null;
                $data ['error'] = "Something strange just happened";
                $data['status'] = 406;
                $data ['hint'] = ['message-1' => 'This is the list of supported subjects.', 'Subjects' => $subject,
                    'message-2' => 'Supported exam types.', 'Exams' => $type,
                    'message-3' => 'Query samples.', 'Queries' => $querySample,];

                return response()->json($data, 406, [], JSON_PRETTY_PRINT);
            }

        } else {
            $data ['error'] = "Subject not supplied";
            $data['status'] = 400;
            return response()->json($data, 400, [], JSON_PRETTY_PRINT);
        }
    }

    public function subjectQuestions($subject)
    {
        if (isset($subject) && $subject != "") {

            try {

                $question = new QLoader;
                $question->setTable($subject);
                $resData= $question->get();

                $data['subject'] = $subject;
                $data['questions'] =  count($resData);

                $res['message'] = 'Action was successful';
                $res['status'] = 200;
                $res['data'] =  $data;

                return response()->json($res, 200, [], JSON_PRETTY_PRINT);

            } catch (\Exception $e) {
                //dd($e);
                $subject = (object) subjectArray();
                $type = (object) examTypeArray();
                $querySample = (object) querySampleArray1();
                $data = null;
                $data ['error'] = "Something strange just happened";
                $data['status'] = 406;
                $data ['hint'] = ['message-1' => 'This is the list of supported subjects.', 'Subjects' => $subject,
                    'message-2' => 'Supported exam types.', 'Exams' => $type,
                    'message-3' => 'Query samples.', 'Queries' => $querySample,];

                return response()->json($data, 406, [], JSON_PRETTY_PRINT);
            }

        } else {
            $data ['error'] = "Subject not supplied";
            $data['status'] = 400;
            return response()->json($data, 400, [], JSON_PRETTY_PRINT);
        }
    }


}
