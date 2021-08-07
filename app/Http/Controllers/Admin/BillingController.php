<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PricePlan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    public function index (){
        $data['pricing'] = PricePlan::get();
        return view('admin.subscription.billing')->with($data);
    }

    public function paystackCallBack(Request $request)
    {
        $input = $request->all();
        $user = auth()->user();
        $userId =$user->id;
        $rules = array(
            'transReference'   => 'required',
            'amount'      => 'required',
            'plan' => 'required');

        $validator = Validator::make($input, $rules);

        if ($validator->passes())
        {
            try
            {

                $verifyData = $this->verifyPaystackTrans($input['transReference'],$userId);

                $pay['amount'] =  $input['amount'] ;
                $pay['plan_id'] =  $input['plan'] ;
                $pay['price'] = $input['amount'] ;
                $pay['trans_reference'] = $input['transReference'] ;
                $pay['user_id'] = $userId;
                $pay['message'] =$verifyData['message'];

                if(!$verifyData['status']){
                    flash('Aw! Could not verify transaction, please contact admin')->error();
                    Payment::create($pay);
                    return back();
                }

                $plan  = PricePlan::find($input['plan']);

                if(is_null($plan)){
                    $pay['plan_id'] = $plan->id ;
                    $pay['message'] ='Oops! Something wried just happened. Plan not found';
                    Payment::create($pay);
                    flash('Oops! Something wried just happened, please contact admin')->warning();
                    return back();
                }

                $pay['plan_id'] =   $plan->id ;
                $pay['price'] = $plan->price ;

                if($plan->price != $input['amount']){
                    $pay['message'] ='Oops! Wried stuff just happened. Amount does not match';
                    Payment::create($pay);
                    flash('Oops! Wried stuff just happened, please contact admin')->warning();
                    return back();
                }

                $subscription = Subscription::whereUser_id($userId)->first();
                $pay['status'] = 1;

                DB::beginTransaction();

                Payment::create($pay);
                $newLimit = $subscription->limit + $plan->unit_limit;
                $subscription->update(['limit' => $newLimit,'paying' => 1, 'plan_id' => $plan->id]);

                User::where(['id'=> $userId])->update(['price_plan' => $plan->id]);

                DB::commit();

                flash('Yeah! Payment was processed successfully')->warning();
                return redirect('admin/dashboard');

            }
            catch(\Exception $e)
            {
                //dd($e);
                DB::rollback();
                flash('App logic got crashed. Payment not saved, contact Admin')->error();
                return back();
            }
        }else{

            flash('Parameter not properly set. contact Admin')->warning();
            return back();
        }

    }

    private function verifyPaystackTrans($transReference, $userId)
    {
        $responseData = [];
        try {
            $res =payStackVerifyTransaction($transReference);
            if($res->status){
                $responseData['status'] = true;
                $responseData['message'] = $res->message;
                $responseData['amount'] = $res->data->amount/100;
            }else{
                $responseData['status'] = false;
                $responseData['message'] = $res->message;
                $responseData['amount'] = 0;
            }

        } catch (\Exception $e) {
            //dd($e);
            $responseData['status'] = false;
            $responseData['message'] = 'Logic error';
            $responseData['amount'] = 0;
        }

        return $responseData;
    }

}
