<?php

namespace App\Http\Controllers\Api;

use App\Models\QLoader;
use App\Models\ReportQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class QuestionController extends Controller
{

    public function index()
    {
        $input = request()->all();
        if (isset($input['subject']) && $input['subject'] != "") {

            $subjectTable = strtolower($input['subject']);
            try {
                $question = new QLoader;
                $question->setTable($subjectTable);

                if (isset($input['year']) && isset($input['type'])) {
                    $examType = strtolower($input['type']);
                    $data = $question->where(['examtype' => $examType, 'examyear' => $input['year']])->inRandomOrder()->first();
                } else if (isset($input['year'])) {
                    $data = $question->where(['examyear' => $input['year']])->inRandomOrder()->first();
                } else if (isset($input['type'])) {
                    $examType = strtolower($input['type']);
                    $data = $question->where(['examtype' => $examType])->inRandomOrder()->first();
                } else {
                    $data = $question->inRandomOrder()->first();
                }

                if (empty($data)) {
                    $res['message'] = "We could not find what you asked for, but got you this";
                    $data = $question->inRandomOrder()->first();
                }

                $count = $data->requestCount + 1;
                $question->where(['id' => $data->id])->update(['requestCount' => $count]);

                $res['subject'] = $subjectTable;
                $res['status'] = 200;
                $res['data'] = $question::FormatQuestionData($data);

                return response()->json($res, 200, [], JSON_PRETTY_PRINT);

            } catch (\Exception $e) {

                $subject = (object) subjectArray();
                $type = (object) examTypeArray();
                $querySample = (object) querySampleArray1();

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


    public function show($recordLimit)
    {
        $input = request()->all();
        $limit = $recordLimit;
        if (isset($input['subject']) && $input['subject'] != "") {

            if (!is_numeric($recordLimit)) {
                $limit = 1;
            } else if ($recordLimit > 7) {
                $limit = 7;
            }

            $subjectTable = strtolower($input['subject']);
            try {
                $question = new QLoader;
                $question->setTable($subjectTable);

                if (isset($input['year']) && isset($input['type'])) {
                    $examType = strtolower($input['type']);
                    $data = $question->where(['examtype' => $examType, 'examyear' => $input['year']])->inRandomOrder()->limit($limit)->get();
                } else if (isset($input['year'])) {
                    $data = $question->where(['examyear' => $input['year']])->inRandomOrder()->limit($limit)->get();
                } else if (isset($input['type'])) {
                    $examType = strtolower($input['type']);
                    $data = $question->where(['examtype' => $examType])->inRandomOrder()->limit($limit)->get();
                } else {
                    $data = $question->inRandomOrder()->limit($limit)->get();
                }

                if ($data->isEmpty()) {
                    $res['message'] = "We could not find what you asked for, but got you this";
                    $data = $question->inRandomOrder()->limit($limit)->get();
                }

                foreach ($data as $datum) {
                    $count = $datum->requestCount + 1;
                    $question->where(['id' => $datum->id])->update(['requestCount' => $count]);
                }

                $res['subject'] = $subjectTable;
                $res['status'] = 200;
                $res['data'] = $question::FormatQuestionsData($data);
                return response()->json($res, 200, [], JSON_PRETTY_PRINT);

            } catch (\Exception $e) {
                $subject = (object) subjectArray();
                $type = (object) examTypeArray();
                $querySample = (object) querySampleArray2();

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

    public function reportQuestion(Request $request){

        $input = $request->all();
        if(isset($input['message'])){$input['message'] = ucfirst($input['message']);}
        if(isset($input['full_name'])){$input['full_name'] = ucfirst($input['full_name']);}
        if(isset($input['question_id']) && isset($input['subject'])){

            $questionID = (int) $input['question_id'];
            $questionID = abs($questionID);
            $subject =  strtolower($input['subject']);
            $subjectList = subjectArray();

            if( $questionID == 0 ){
                $data ['error'] = "You supplied wrong question id";
                $data ['status'] = 400;
                return response()->json($data, 400, [], JSON_PRETTY_PRINT);
            }

            if(!in_array ( $subject, $subjectList )){
                $data ['error'] = "Wrong subject not supplied";
                $data ['status'] = 400;
                return response()->json($data, 400, [], JSON_PRETTY_PRINT);
            }

            try{

                ReportQuestion::create($input);
                $data['status'] = 200;
                $data['message'] = "We have received your report on the question. Thank you.";
                return response()->json($data, 200, [], JSON_PRETTY_PRINT);

            }catch(\Exception $e){
                $data['status'] = 406;
                $data['message'] = "Something strange went wrong.";
                return response()->json($data, 406, [], JSON_PRETTY_PRINT);
            }
        }

    }
}