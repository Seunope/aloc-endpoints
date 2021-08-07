
@extends('admin.layouts.base')

@section('content')
    <div id="wrapper">
        @include('admin.layouts.partials._sidebar')

        <div id="page-wrapper" class="gray-bg">
            @include('admin.layouts.partials._top_toolbar')
            <div class="wrapper wrapper-content">

                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="contact-box">
                                <div class="col-sm-12">
                                    <h2><strong>Access Plan</strong></h2>
                                    <p>{{formatNumber($pricing[0]['unit_limit'])}} free API calls</p>
                                    <p>Default units: {{formatNumber($pricing[0]['default_unit'])}}</p>
                                    <p>Bonus units: {{formatNumber($pricing[0]['bonus_unit'])}}</p>
                                    <h3>Price: FREE</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="contact-box">
                                <div class="col-sm-12">
                                    <h2><strong>Basic Plan</strong></h2>
                                    <p>{{formatNumber($pricing[1]['unit_limit'])}} API calls</p>
                                    <p>Default units: {{formatNumber($pricing[1]['default_unit'])}}</p>
                                    <p>Bonus units: {{formatNumber($pricing[1]['bonus_unit'])}}</p>
                                    <h3>Price: ₦{{formatNumber($pricing[1]['price'] )}}</h3>
                                    <h3/>
                                    <p onclick="payWithPaystack({{$pricing[1]['price']}},{{$pricing[1]['id']}})" class="btn btn-sm btn-primary m-t-n-xs" type="button"><strong>Buy Now</strong></p>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="contact-box">
                                <div class="col-sm-12">
                                    <h2><strong>Huge Plan</strong></h2>
                                    <p>{{ formatNumber($pricing[2]['unit_limit'])}} API calls</p>
                                    <p>Default units: {{ formatNumber($pricing[2]['default_unit'])}}</p>
                                    <p>Bonus units: {{ formatNumber($pricing[2]['bonus_unit'])}}</p>
                                    <h3>Price: ₦{{ formatNumber($pricing[2]['price'])}}</h3>
                                    <h3/>
                                    <p onclick="payWithPaystack({{$pricing[2]['price']}}, {{$pricing[2]['id']}})" class="btn btn-sm btn-primary m-t-n-xs" type="button"><strong>Buy Now</strong></p>

                                </div>

                                <div class="clearfix"></div>

                            </div>


                        </div>

                    </div>

                    </div>

                 @include('admin.layouts.partials._footer_note')

        </div>
    </div>


@stop
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="{{env('PAYSTACK_URL')}}"></script>
    @php  $email = auth()->user()->email;
        $name = auth()->user()->name;
    @endphp
    <script>


        function payWithPaystack(amount, plan){
            var handler = PaystackPop.setup({
                key: '{{env('PAYSTACK_PUBLIC_KEY')}}',
                email: '{{$email}}',
                amount: amount*100,
                currency: "NGN",
                metadata: {
                    custom_fields: [
                        {
                            display_name: "{{$name}}",
                        }
                    ]
                },
                callback: function(response){
                    //alert('success. transaction ref is ' + response.reference);
                    console.log(response);
                    var url = "{{url('/admin/pricing/paystack/callback')}}"
                    var name = "{{$name}}"
                    var email = "{{$email}}"
                    var data = { amount: amount, name: "{{$name}}", paystack_ref:response.reference, email:"{{$email}}", "_token": "{{ csrf_token() }}"}
                    console.log(data);
                    window.location.href = "/admin/pricing/paystack/callback?amount="+amount+"&plan="+plan+"&name="+name+"&transReference="+response.reference;
                },
                onClose: function(){
                    alert('window closed');
                }
            });
            handler.openIframe();
        }
    </script>
@endsection

