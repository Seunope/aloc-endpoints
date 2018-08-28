<?php

namespace App\Http\Controllers\Api;

use App\Models\QLoader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class QuestionController extends Controller
{

    public function index()
    {
        $input = request()->all();
        if (isset($input['subject']) && $input['subject'] != "") {
            $subjectTable = $input['subject'];
            try {
                $question = new QLoader;
                $question->setTable($subjectTable);

                if (isset($input['year']) && isset($input['type'])) {
                    $data = $question->where(['examtype' => $input['type'], 'examyear' => $input['year']])->inRandomOrder()->first();
                } else if (isset($input['year'])) {
                    $data = $question->where(['examyear' => $input['year']])->inRandomOrder()->first();
                } else if (isset($input['type'])) {
                    $data = $question->where(['examtype' => $input['type']])->inRandomOrder()->first();
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
                $subject = (object)['english', 'mathematics', 'commerce', 'account', 'biology', 'physics', 'chemistry', 'englishlit', 'government', 'crk', 'geography', 'economics', 'irk', 'civiledu', 'insurance', 'currentaffairs', 'history'];
                $type = (object)['waec', 'jamb', 'neco', 'post-utme'];
                $querySample = (object)['https://questions.aloc.ng/api/q?subject=english',
                    'https://questions.aloc.ng/api/q?subject=english&year=2010',
                    'https://questions.aloc.ng/api/q?subject=insurance&type=wassce',
                    'https://questions.aloc.ng/api/q?subject=english&year=2009&type=utme'];

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

            $subjectTable = $input['subject'];
            try {
                $question = new QLoader;
                $question->setTable($subjectTable);

                if (isset($input['year']) && isset($input['type'])) {
                    $data = $question->where(['examtype' => $input['type'], 'examyear' => $input['year']])->inRandomOrder()->limit($limit)->get();
                } else if (isset($input['year'])) {
                    $data = $question->where(['examyear' => $input['year']])->inRandomOrder()->limit($limit)->get();
                } else if (isset($input['type'])) {
                    $data = $question->where(['examtype' => $input['type']])->inRandomOrder()->limit($limit)->get();
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
                $subject = (object)['english', 'mathematics', 'commerce', 'account', 'biology', 'physics', 'chemistry', 'englishlit', 'government', 'crk', 'geography', 'economics', 'irk', 'civiledu', 'insurance', 'currentaffairs', 'history'];
                $type = (object)['waec', 'jamb', 'neco', 'post-utme'];
                $querySample = (object)['https://questions.aloc.ng/api/q/0?subject=english',
                    'https://questions.aloc.ng/api/q/1?subject=english&year=2010',
                    'https://questions.aloc.ng/api/q/2?subject=insurance&type=wassce',
                    'https://questions.aloc.ng/api/q/3?subject=english&year=2009&type=utme'];

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

        dd('sdsdsd');
        $input = $request->all();

        if(isset($input['question_id']) && isset($input['subject'])){

            try{

                ReportQuestion:create($input);
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