<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitorController extends Controller
{

    public $apiUrl ="https://api.buildo.xyz/api/v1/visitor";
    protected $token="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjkxMTI0ZmY3OTFkZmYxMzg3MzAyZmVhYTM5NzFhMGVjYjRkYjA3MzE3OWMwNmJiZWYxYjFjNzFkNGRlYjAzZTgyNTZjNzkzOTg1NjNiOWIyIn0.eyJhdWQiOiIxIiwianRpIjoiOTExMjRmZjc5MWRmZjEzODczMDJmZWFhMzk3MWEwZWNiNGRiMDczMTc5YzA2YmJlZjFiMWM3MWQ0ZGViMDNlODI1NmM3OTM5ODU2M2I5YjIiLCJpYXQiOjE2NTQxNzI3NzUsIm5iZiI6MTY1NDE3Mjc3NSwiZXhwIjoxNjY5OTgzOTc1LCJzdWIiOiIxIiwic2NvcGVzIjpbInN1cGVyX2FkbWluIiwiZW50ZXJwcmlzZV9zdGFuZGFyZCIsInN0YW5kYXJkX3N0YWZmIl19.gUPVWMUycpxNWyu8YgIhgqI8qoi5boHqpSIwiuoPO3eqjVR4BWOXu2LkBHDUpMrVC3evf7Xiexma9AkOWgyIK-jBTNvJ2T0UlD14ntTRfmNudxC_G4H1uhaBLnNdau8v69FGnTb21hPYoKZqU_JG0RdG4FvIavmSlNELkxs1pbLC4AAF-9w3MktGtDx_d8bbXz8HASuDFYCyuaRK1i6HPYtJU8ev5t2F9sFUXU4_6HWCP3KCJVma9kF3MGfYf0jm5X6O_FAiXReohMRrMwrAkoM54fSuOZmqpNBv89h75ttN3wHZ-EaaN0QaC0xgdFWUAypXHi3dzBy7nT0e70bamVP4Xgn5FjWTxjQptHR-tB6WtJsrzvhdJVN4imgAV94WAMsl2z2zbmQq5m7Kf-3s5JvmD6EV070EZVHq_yS_PeOYachRNLQP9RTQ0MxKkEjcoz17t8vxx9WI-Tl1nqSAFiGoo-eUgZhq1bCFoskxtuZ0vQV9UvivnfE06sEwLRhEAiyfScM1DO70pdNQbk_ViJHliz0ScDOG3NSP4NOd-OMrmzNAVX9evf2dXUnB2ShGYs-EqUm3hPLTZJs5YHB_JIsNsaw1M0_mDZxVP6pAZxsMCi6VP_C3jA7WLm_YYGAoZeO7tNqCIpau6Pnii_g_bS1SyzrMzAjEJ9Fl1pxt2-4";

    /*
        Functionality: list all the visitors method using curl
        @params: $propertyId
        @return response of data/error
    */
    public function index()
    {
        $propertyId = 1;
        $response = $this->curlCall($propertyId, $this->apiUrl, $this->token, "GET");
        print_r(json_decode($response));


    }

    /*
        Functionality: store new visitor method using curl
        @params: $propertyId, $request data
        @return response of data/error
    */
    public function store()
    {
        $propertyId = 1;
        $data = [
            'propertyId'=> $propertyId,
            'unitId'=> 1,
            'name'=> "Mahmud Ibrahim",
            'email'=> "eng.ibrahim.mahmud@gmail.com",
            'phone'=> 1231231232,
        ];

        $response = $this->curlCall($propertyId, $this->apiUrl, $this->token, 'POST', $data);
        print_r(json_decode($response));
    }


    /*
        Functionality: update new visitor method using curl
        @params: $propertyId, $request data
        @return response of data/error
    */
    public function update()
    {
        $propertyId = 1;
        $data = [
            'propertyId'=> $propertyId,
            'unitId'=> 1,
            'name'=> "Mahmud Ibrahim",
            'email'=> "testvisitor@test1.com",
            'phone'=> 1231231232,
        ];

        $response = $this->curlCall($propertyId, $this->apiUrl, $this->token, 'PUT', $data);
        print_r(json_decode($response));
    }


    /*
        Functionality: delete existing visitor method using curl
        @params: $propertyId, $request data=""
        @return response of data/error
    */
    public function delete()
    {
        $propertyId = 1;
        $data="";

        $response = $this->curlCall($propertyId, $this->apiUrl, $this->token, "DELETE", $data);
        print_r(json_decode($response));
    }


        /*
        Functionality: curl based api end point call
        @params: $propertyId, $apiUrl, $auth_token, $methodName, $data = if any
        @return response of data/error
    */
    public function curlCall($propertyId, $apiUrl, $token, $methodName, $data=NULL)
    {
        try {
            $curl = curl_init();
            $conetent_type ="application/json";
            $formData = '';
            if($methodName == 'PUT'){
                $formData = $data;
                $conetent_type =  "Content-Type: application/x-www-form-urlencoded";
            }
            $formData = json_encode($data);

            curl_setopt_array($curl, array(
                CURLOPT_URL => $apiUrl."?propertyId=".$propertyId,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $methodName,
                CURLOPT_POSTFIELDS => $formData,
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: '.$conetent_type,
                    "Authorization: Bearer ".$token,
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return $response;
        } catch (\Exception $e) {
            return [
                'curl_err' => $err,
                'exception' => $e->getMessage()
            ];
        }

    }

    public function filterByMobile(Request $request)
    {
        $mobile_given = request('phone');
        //$mobile_given= "01717295256";
        $propertyId = 1;
        try {
            $curl = curl_init();
            $conetent_type ="application/json";
            $formData = '';


            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->apiUrl."?propertyId=".$propertyId.'&phone='.$mobile_given,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_POSTFIELDS => $formData,
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: '.$conetent_type,
                    "Authorization: Bearer ".$this->token,
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            print_r(json_decode($response));

        } catch (\Exception $e) {
            return [
                'curl_err' => $err,
                'exception' => $e->getMessage()
            ];
        }
    }
}
