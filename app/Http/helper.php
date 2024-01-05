<?php
 

if(! function_exists('pay_payping') ) {
    function pay_payping(   $price , $myuser ,  $myrequest  )
    {
        
        
                    $token = "PJ__XCI8AR-pL5c4GCOQc3auTQzk2wPPKJ7hgYKq3U0";
                    $args = array(
                        "amount" => $price,
                        "payerIdentity" => $myuser->user_email,
                        "payerName" => $myuser->user_name ,
                        "description" => $myuser->user_tell ,
                        "returnUrl" => 'https://azmoonpte.com/servicepay/user/callback/payping/' . $myrequest->req_rnd,
                        "clientRefId" => "$myrequest->req_rnd"
                    );

                    try {
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                                CURLOPT_URL => "https://api.payping.ir/v2/pay",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_POSTFIELDS => json_encode($args),
                                CURLOPT_HTTPHEADER => array(
                                    "accept: application/json",
                                    "authorization: Bearer " . $token,
                                    "cache-control: no-cache",
                                    "content-type: application/json"
                                ),
                            )
                        );
                        $result = curl_exec($curl);
                        curl_close($curl);
                        $transaction_info = json_decode($result, true);
                        // dd($result);
                        if ($transaction_info['code']) {
                            // $order->transactionId = $transaction_info['code'];
                            // $order->save();
                            // session_start();
                            if (isset($_SESSION['refresh2'])) unset($_SESSION['refresh2']);
                            if (isset($_SESSION['refresh'])) unset($_SESSION['refresh']);
                            return redirect('https://api.payping.ir/v2/pay/gotoipg/' . $transaction_info['code']);
                        } else throw new \Exception("مشکلی در پرداخت وجود دارد");

                    } catch (\Exception $e) {
                        echo $e->getMessage();

                    }


    }
}


 