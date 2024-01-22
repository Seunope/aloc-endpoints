<?php

namespace App\Http\Controllers\Api\v2;

use App\Models\QLoader;
use App\Models\QBoardLog;
use App\Models\AccessToken;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\ReportQuestion;
use App\Models\AccessTokenCall;
use App\Models\ApiCallIpAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class QuestionController extends Controller
{

    public function index()
    {
        $processReq =  $this->processRequest();
        if($processReq['shouldReturn']){
            unset($processReq['shouldReturn']);
            return response()->json($processReq, 406, [], JSON_PRETTY_PRINT);
        }

        $input = request()->all();

        if (isset($input['subject']) && $input['subject'] != "") {

            $subjectTable = strtolower($input['subject']);
            try {
                $question = new QLoader;
                $question->setTable($subjectTable);

                if(!isset($input['random'])){
                    $random = 'true';
                }else{
                    $random = strtolower($input['random']);
                }

                if (isset($input['year']) && isset($input['type'])) {
                    $examType = strtolower($input['type']);
                    if($random === 'true'){
                        $data = $question->where(['examtype' => $examType, 'examyear' => $input['year']])->inRandomOrder()->first();
                    }else{
                        $data = $question->where(['examtype' => $examType, 'examyear' => $input['year']])->first();
                    }
                } else if (isset($input['year'])) {
                    if($random === 'true'){
                        $data = $question->where(['examyear' => $input['year']])->inRandomOrder()->first();
                    }else{
                        $data = $question->where(['examyear' => $input['year']])->first();

                    }
                } else if (isset($input['type'])) {
                    $examType = strtolower($input['type']);
                    if($random === 'true'){
                        $data = $question->where(['examtype' => $examType])->inRandomOrder()->first();
                    }else{
                        $data = $question->where(['examtype' => $examType])->first();
                    }
                } else {
                    if($random === 'true'){
                        $data = $question->inRandomOrder()->first();
                    }else{
                        $data = $question->first();
                    }
                }

                if (empty($data)) {
                    $res['message'] = "We could not find what you asked for, but got you this";
                    $data = $question->inRandomOrder()->first();
                }

                $count = $data->requestCount + 1;
                $question->where(['id' => $data->id])->update(['requestCount' => $count]);
                if(!env('APP_DEBUG')){
                    storeQuestionRequestByIP($subjectTable);
                }

                $res['subject'] = $subjectTable;
                $res['status'] = 200;
                $res['data'] = $question::FormatQuestionData($data, $subjectTable);

                $this->tokenQuestions(1, $subjectTable, $processReq['userId'], $processReq['token'] );

                return response()->json($res, 200, [], JSON_PRETTY_PRINT);

            } catch (\Exception $e) {
                print($e);
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

    public function show($recordLimit)
    {
        $processReq =  $this->processRequest();
        if($processReq['shouldReturn']){
            unset($processReq['shouldReturn']);
            return response()->json($processReq, 406, [], JSON_PRETTY_PRINT);
        }

        $input = request()->all();
        $limit = $recordLimit;
        if (isset($input['subject']) && $input['subject'] != "") {

            if (!is_numeric($recordLimit)) {
                $limit = 1;
            } else if ($recordLimit > 40) {
                $limit = 40;
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

                if(!env('APP_DEBUG')){
                    foreach ($data as $datum) {
                        $count = $datum->requestCount + 1;
                        $question->where(['id' => $datum->id])->update(['requestCount' => $count]);
                        storeQuestionRequestByIP($subjectTable);
                    }
                }


                $res['subject'] = $subjectTable;  
                $res['status'] = 200;
                $res['data'] = $question::FormatQuestionsData($data, $subjectTable);

                $this->tokenQuestions($recordLimit, $subjectTable, $processReq['userId'], $processReq['token'] );

                return response()->json($res, 200, [], JSON_PRETTY_PRINT);

            } catch (\Exception $e) {
                // dd($e);
                $subject = (object) subjectArray();
                $type = (object) examTypeArray();
                $querySample = (object) querySampleArray2();
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

    public function questionById($questionId){

        $processReq =  $this->processRequest();
        if($processReq['shouldReturn']){
            unset($processReq['shouldReturn']);
            return response()->json($processReq, 406, [], JSON_PRETTY_PRINT);
        }
        $input = request()->all();
        if (isset($input['subject']) && $input['subject'] != "") {

            if (!is_numeric($questionId)) {
                $data ['error'] = "Supply numbers only";
                $data['status'] = 400;
                return response()->json($data, 400, [], JSON_PRETTY_PRINT);
            }

            $subjectTable = strtolower($input['subject']);
            try {
                $question = new QLoader;
                $question->setTable($subjectTable);
                $data = $question->find($questionId);

                if (!empty($data)) {
                    $res['subject'] = $subjectTable;
                    $res['status'] = 200;
                    $res['data'] = $question::FormatQuestionData($data,$subjectTable);

                    $count = $data->requestCount + 1;
                    $question->where(['id' => $data->id])->update(['requestCount' => $count]);
                    if(!env('APP_DEBUG')){
                        storeQuestionRequestByIP($subjectTable);
                    }
                    $this->tokenQuestions(1, $subjectTable, $processReq['userId'], $processReq['token'] );
                    return response()->json($res, 200, [], JSON_PRETTY_PRINT);

                } else {
                    $res['subject'] = $subjectTable;
                    $res['question_id'] = $questionId;
                    $res['status'] = 204;
                    $res['error'] = "No content found";
                    return response()->json($res, 400, [], JSON_PRETTY_PRINT);
                }

            } catch (\Exception $e) {
                //dd($e);
                $subject = (object) subjectArray();
                $querySample = (object) querySampleArray2();
                $data = null;
                $data ['error'] = "Something strange just happened";
                $data['status'] = 406;
                $data ['hint'] = ['message-1' => 'This is the list of supported subjects.', 'Subjects' => $subject,
                    'message-2' => 'Query samples.', 'Queries' => $querySample,];

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
        }else{

            $data['status'] = 406;
            $data['message'] = "The parameters you sent does not match our requirement. You should provide subject and question_id";
            return response()->json($data, 406, [], JSON_PRETTY_PRINT);
        }

    }

    public function allSubjects(){

        $subject = (object) subjectArray();
        $data['message'] = "List of subjects supported";
        $data['status'] = 200;
        $data['subjects'] = $subject;
        return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }

    public function comprehensionYears(){

        $processReq =  $this->processRequest();
        if($processReq['shouldReturn']){
            unset($processReq['shouldReturn']);
            return response()->json($processReq, 406, [], JSON_PRETTY_PRINT);
        }

        $input = request()->all();
        if (isset($input['subject']) && $input['subject'] != "") {

            $subjectTable = strtolower($input['subject']);
            if($subjectTable !== 'english'){
                $data ['error'] = "Subject not supplied. Only english language is supported";
                $data['status'] = 400;
                return response()->json($data, 400, [], JSON_PRETTY_PRINT);
            }

            try {
                $question = new QLoader;
                $question->setTable($subjectTable);
                $data = $question->where(['hasPassage' => true])->select(['examyear'])->groupBy('examyear')->get();


                $res['subject'] = $subjectTable;
                $res['status'] = 200;
                $res['data'] = $data;

                return response()->json($res, 200, [], JSON_PRETTY_PRINT);

            } catch (\Exception $e) {
                //dd($e);
                $data = null;
                $data ['error'] = "Something strange just happened. Check your input";
                $data['status'] = 406;
                return response()->json($data, 406, [], JSON_PRETTY_PRINT);
            }

        } else {
            $data ['error'] = "Subject not supplied";
            $data['status'] = 400;
            return response()->json($data, 400, [], JSON_PRETTY_PRINT);
        }
    }


    public function manyQuestions(){

        $processReq =  $this->processRequest();
        if($processReq['shouldReturn']){
            unset($processReq['shouldReturn']);
            return response()->json($processReq, 406, [], JSON_PRETTY_PRINT);
        }

        $input = request()->all();
        $questionLimit = 40;
        if (isset($input['subject']) && $input['subject'] != "") {

            $subjectTable = strtolower($input['subject']);
            try {
                $question = new QLoader;
                $question->setTable($subjectTable);

                if (isset($input['year']) && isset($input['type'])) {
                    $examType = strtolower($input['type']);
                    $data = $question->where(['examtype' => $examType, 'examyear' => $input['year']])
                                     ->inRandomOrder()->take($questionLimit)->get();
                } else if (isset($input['year'])) {
                    $data = $question->where(['examyear' => $input['year']])
                                     ->inRandomOrder()->take($questionLimit)->get();
                } else if (isset($input['type'])) {
                    $examType = strtolower($input['type']);
                    $data = $question->where(['examtype' => $examType])
                                     ->inRandomOrder()->take($questionLimit)->get();
                } else {
                    $data = $question->inRandomOrder()->take($questionLimit)->get();
                }

                if (empty($data)) {
                    $res['message'] = "We could not find what you asked for, but got you this";
                    $data = $question->inRandomOrder()->take($questionLimit)->get();
                }

                if(!env('APP_DEBUG')){
                    foreach ($data as $datum) {
                        $count = $datum->requestCount + 1;
                        $question->where(['id' => $datum->id])->update(['requestCount' => $count]);
                        storeQuestionRequestByIP($subjectTable);
                    }
                }

                $qResult = $question::FormatQuestionsData($data, $subjectTable);
                $res['subject'] = $subjectTable;
                $res['status'] = 200;
                $res['total'] = count($qResult);
                $res['data'] = $qResult;

                $this->tokenQuestions(40, $subjectTable, $processReq['userId'], $processReq['token'] );
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

    public function hugeQuestions($questionLimit){

        if($questionLimit > 120){
            $data ['error'] = "Maximum questions support is 120";
            $data['status'] = 400;
            return response()->json($data, 400, [], JSON_PRETTY_PRINT);
        }

        $processReq =  $this->processRequest($questionLimit);
        if($processReq['shouldReturn']){
            unset($processReq['shouldReturn']);
            return response()->json($processReq, 406, [], JSON_PRETTY_PRINT);
        }

        $input = request()->all();
        // $questionLimit = 40;
        //dd($input);
        if (isset($input['subject']) && $input['subject'] != "") {

            $subjectTable = strtolower($input['subject']);

            if(!isset($input['random'])){
                $random = 'true';
            }else{
                $random = strtolower($input['random']);
            }

            if(!isset($input['withComprehension'])){
                $withComprehension = 'false';
            }else{
                $withComprehension = strtolower($input['withComprehension']);
            }

            try {
                $question = new QLoader;
                $question->setTable($subjectTable);

                if (isset($input['year']) && isset($input['type'])) {
                    $examType = strtolower($input['type']);
                    if($random === 'true'){
                        $data = $question->where(['examtype' => $examType, 'examyear' => $input['year']])
                                        ->inRandomOrder()->take($questionLimit)->get();
                    }else{
                        $data = $question->where(['examtype' => $examType, 'examyear' => $input['year']])->take($questionLimit)->get();
                    }
                } else if (isset($input['year'])) {
                    if($random === 'true'){
                        $data = $question->where(['examyear' => $input['year']])->inRandomOrder()->take($questionLimit)->get();
                    }else{
                        $data = $question->where(['examyear' => $input['year']])->take($questionLimit)->get();
                    }

                } else if (isset($input['type'])) {
                    $examType = strtolower($input['type']);
                    if($random === 'true'){
                         $data = $question->where(['examtype' => $examType])
                                     ->inRandomOrder()->take($questionLimit)->get();
                    }else{
                        $data = $question->where(['examtype' => $examType])->take($questionLimit)->get();
                    }
                } else {
                    if($random === 'true'){
                      $data = $question->inRandomOrder()->take($questionLimit)->get();
                    }else{
                        $data = $question->take($questionLimit)->get();
                    }
                }

                if (empty($data)) {
                    $res['message'] = "We could not find what you asked for, but got you this";
                    $data = $question->inRandomOrder()->take($questionLimit)->get();
                }

                if(!env('APP_DEBUG')){
                    foreach ($data as $datum) {
                        $count = $datum->requestCount + 1;
                        $question->where(['id' => $datum->id])->update(['requestCount' => $count]);
                        storeQuestionRequestByIP($subjectTable);
                    }
                }

                $qResult = $question::FormatQuestionsData($data, $subjectTable, $withComprehension);
                $res['subject'] = $subjectTable;
                $res['status'] = 200;
                $res['total'] = count($qResult);
                $res['data'] = $qResult;

                if( $res['total'] == 0 && isset($input['withComprehension'])){
                    $data = null;
                    $data ['error'] = "Comprehension not supported for subject or year";
                    $data['status'] = 406;
                    $data ['hint'] = ['message-1' => 'This is the list of supported subjects.', 'Subjects' => 'english',
                    'message-2' => 'Supported years. 2000, 2001, 2002, 2011,2012, 2013, 2014, 2015,2016, 2017, 2018, 2019,2020, 2021, 2022', 'Exams' => 'utme'];
                    return response()->json($data, 406, [], JSON_PRETTY_PRINT);

                }

                $this->tokenQuestions($questionLimit, $subjectTable, $processReq['userId'], $processReq['token'] );
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


    public function groupSubjectsQuestions(Request $request)
    {
        $processReq =  $this->processRequest();
        if($processReq['shouldReturn']){
            unset($processReq['shouldReturn']);
            return response()->json($processReq, 406, [], JSON_PRETTY_PRINT);
        }

        $input = $request->all();

        $rules = array(
            'subject1'   => 'required', 
            'number'=> 'required|numeric');

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()){
            $res['status'] = 406;
            $res['message'] = $validator->errors();
            return response()->json($res,406);
        }

        try{

            $questions['subject1'] = $this->getBySubject($input['subject1'], $input['number'],$processReq);

            if (isset($input['subject2']) && $input['subject2'] != "") {
                $questions['subject2'] = $this->getBySubject($input['subject2'], $input['number'],$processReq);
            }

            if (isset($input['subject3']) && $input['subject3'] != "") {
                $questions['subject3'] = $this->getBySubject($input['subject3'], $input['number'],$processReq);
            }

            if (isset($input['subject4']) && $input['subject4'] != "") {
                $questions['subject4'] = $this->getBySubject($input['subject4'], $input['number'],$processReq);
            }

            $res['status'] = 200;
            $res['data'] = $questions;
            $res['message'] = 'Group questions was fetched';

            return response()->json($res, 200, [], JSON_PRETTY_PRINT);

        } catch (\Exception $e) {
            print($e);
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

    }

    public function topQuestion(){

        try{
            $randSubjects = randomSubjects();
            $question = new QLoader;
            $data = Array();
            foreach ( $randSubjects as $key => $subject ){
                $question->setTable( $subject);
                $questionSet = $question->where('id','!=', 0)->latest('updated_at')->inRandomOrder()->limit(2)->get();

                foreach ($questionSet as $eachQuestion){

                    $eachQuestion['subject'] = $subject;
                    $data[] = $eachQuestion;
                    if(!env('APP_DEBUG')) {
                        storeQuestionRequestByIP($subject);
                    }
                    // $count = $eachQuestion->requestCount + 1;
                    // $question->where(['id' => $eachQuestion->id])->update(['requestCount' => $count]);
                }
            }
            shuffle($data);
            $res['status'] = 200;
            $res['data'] = $question::FormatTopQuestionsData($data);
            return response()->json($res, 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            $data = null;
            $data ['error'] = "Something strange just happened";
            $data['status'] = 406;
            return response()->json($data, 406, [], JSON_PRETTY_PRINT);
        }
    }

    private function processRequest($questions = 40){
        $computeCount = ceil($questions/40);
        $accessToken =  request()->header('AccessToken');
        if(!$accessToken){
            $data['status'] = 400;
            $data['shouldReturn'] = true;
            $data ['error'] = "Access token not provide on request header";
            return $data;
        }

        $res = AccessToken::whereToken($accessToken)->first();
        if(!is_null($res)){

            $subscription = Subscription::whereUserId($res->user_id)->first();
            if($res->count >= $subscription->limit){
                $data['status'] = 400;
                $data['shouldReturn'] = true;
                $data ['error'] = "You have used up your quota. Please, upgrade your plan to continue";
                return $data;
            }
            $newCount =  $res->count + $computeCount;

            if($newCount > $subscription->limit){
                $newCount = $subscription->limit;
            }
            $data['status'] = 200;
            $data['shouldReturn'] = false;
            $data['userId'] = $res->user_id;
            $data['token'] = $accessToken;
            $res->update(['count'=> $newCount]);
        }else{
            $data['status'] = 406;
            $data['shouldReturn'] = true;
            $data ['error'] = "Access token not valid or deactivated";
        }
        return $data;
    }

    private function tokenQuestions($questionNumber,$subject, $userId, $token){

        $res =  AccessTokenCall::where(['token' =>$token,'subject' => $subject])->first();
        if(!is_null($res)){
            $count = $res->requestCount + $questionNumber;
            $res->update(['requestCount'=>$count]);
        }else{

            $data['subject'] =$subject;
            $data['requestCount'] = $questionNumber ;
            $data['token'] = $token ;
            $data['user_id'] =$userId;
            AccessTokenCall::create($data);
        }

        $this->saveQuestionsRequestByMonth($questionNumber,$subject);
    }


    private function saveQuestionsRequestByMonth ($questionNumber,$subject){

        $year = date('Y');
        $month = date('M');
        $res =  QBoardLog::where(['month' =>$month,'year' =>$year,'subject' => $subject])->first();
        if(!is_null($res)){
            $count = $res->requestCount + 1;
            $countQ = $res->questionCount + $questionNumber;
            $res->update(['requestCount'=>$count, 'questionCount'=>$countQ]);
        }else{

            $data['subject'] =$subject;
            $data['requestCount'] = 1 ;
            $data['questionCount'] = $questionNumber ;
            $data['month'] = $month ;
            $data['year'] =$year;
            QBoardLog::create($data);
        }
    }

    private function getBySubject($subject, $recordLimit, $processReq)
    {
      
        $limit = $recordLimit;
        if ($subject != "") {

            if (!is_numeric($recordLimit)) {
                $limit = 1;
            } else if ($recordLimit > 20) {
                $limit = 20;
            }

            $subjectTable = strtolower($subject);
            try {
                $question = new QLoader;
                $question->setTable($subjectTable);
 
                if($subject === 'english'){
                    $data = $question->where(['hasPassage' => false])->inRandomOrder()->limit($limit)->get();
                }else{
                    $data = $question->inRandomOrder()->limit($limit)->get();
                }

                if(!env('APP_DEBUG')){
                    foreach ($data as $datum) {
                        $count = $datum->requestCount + 1;
                        $question->where(['id' => $datum->id])->update(['requestCount' => $count]);
                        storeQuestionRequestByIP($subjectTable);
                    }
                }


                $res['subject'] = $subjectTable;  
                $res['data'] = $question::FormatQuestionsData($data, $subjectTable);

                $this->tokenQuestions($recordLimit, $subjectTable, $processReq['userId'], $processReq['token'] );

                return $res;

            } catch (\Exception $e) {
                // dd($e);
                $res['subject'] = $subject;  
                $res['data'] = [];
            }

        } else {
            $res['subject'] = $subject;  
            $res['data'] = [];
        }
    }

}
