<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Models\QLoader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input =request()->all();
        if($input['subject'] != ""){
            $subjectTable = $input['subject'];
            try{
                $question = new QLoader;
                $question->setTable($subjectTable);

                if(isset($input['year']) && isset($input['type'])  ){
                    $data = $question->where(['examtype' =>$input['type'],'examyear' =>$input['year']])->inRandomOrder()->first();
                }else if(isset($input['year'])  ){
                    $data = $question->where(['examyear' =>$input['year'] ])->inRandomOrder()->first();
                }else if(isset($input['type'])  ){
                    $data = $question->where(['examtype' =>$input['type'] ])->inRandomOrder()->first();
                }else{
                    $data = $question->inRandomOrder()->first();
                }

                if(empty($data)){
                    $data['message'] = "No record found or Bad request.";
                    $data['status'] = 400;
                    return response()->json($data, 400, [], JSON_PRETTY_PRINT);
                }

//                $question->requestCount=1;
//                $question->update(['requestCount' =>1]);
                $res['subject'] = $subjectTable;
                $res['status'] = 200;
                $res['data']  = $data;
                return response()->json($res, 200, [], JSON_PRETTY_PRINT);


            }catch (\Exception $e){
                $subject = (object) ['english','mathematics','commerce', 'account','biology','physics','chemistry','englishlit','government','crk','geography','economics','irk','civiledu','insurance','currentaffairs','history'];
                $type = (object) ['waec', 'jamb', 'neco','post-utme'];
                $querySample = (object) ['q?subject=account',
                                        'q?subject=account&year=2010',
                                        'q?subject=account&type=waec',
                                        'q?subject=account&year=2014&type=jamb'];

                $data ['error'] = "Something strange just happened";
                $data['status'] = 406;
                $data ['hint'] = ['message-1'=>'This is the list of supported subjects.', 'Subjects'=> $subject,
                                  'message-2'=>'Supported exam types.', 'Exams'=> $type,
                                  'message-3'=>'Query samples.', 'Queries'=> $querySample,];


                return response()->json($data, 406, [], JSON_PRETTY_PRINT);
            }

        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
