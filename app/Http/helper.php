<?php

if(! function_exists('pay_zarinpal') ) {
    function pay_zarinpal(   $price , $myuser ,  $myrequest  )
    {

//  start zarinpal
 

$data = array("merchant_id" => "f373affa-e1bd-11e8-bcb5-005056a205be",
"amount" => $price,
"callback_url" => "https://azmoonpte.com/servicepay/user/verify_buy.php?req_rnd=".$myrequest->req_rnd,
"description" => $myuser->user_name,
"metadata" => [ "email" => $myuser->user_email,"mobile"=>$myuser->user_tell],
);
$jsonData = json_encode($data);
$ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($jsonData)
));

$result = curl_exec($ch);
$err = curl_error($ch);
$result = json_decode($result, true, JSON_PRETTY_PRINT);
curl_close($ch);



if ($err) {
echo "cURL Error #:" . $err;
} else {
if (empty($result['errors'])) {
    if ($result['data']['code'] == 100) {
        // header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
        $url ='https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"];
        // header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
        // return Redirect::to($url);
        return redirect()->away($url);
    }
} else {
     echo'Error Code: ' . $result['errors']['code'];
     echo'message: ' .  $result['errors']['message'];

}
}


//  end zarinpal

    }
}



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



if(! function_exists('callback_payping_v1') ) {
    function callback_payping_v1(   $price , $myuser ,  $myrequest  )
    {
        

    }
}