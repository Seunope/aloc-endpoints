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
            $subjectTable = ucfirst($input['subject']);
            try{
                $question = new QLoader;
                $question->setTable($subjectTable);
                $data = $question->inRandomOrder()->first();

//                $question->requestCount=1;
//                $question->update(['requestCount' =>1]);

                return response()->json($data, 200, [], JSON_PRETTY_PRINT);
            }catch (\Exception $e){
                $subject = (object) ['english','mathematics','commerce', 'account','biology','physics','chemistry'];
                $data ['error'] = "Something strange just happened";
                $data ['hint'] = ['message'=>'This is the list of supported subjects.', 'subject'=> $subject];

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
