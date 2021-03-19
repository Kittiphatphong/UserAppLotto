<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AirTimeController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\OTP;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\SendMassageController;
class CustomerApiController extends Controller
{
    protected $SendMassageController;
    protected $AirTimeController;
    public function __construct(SendMassageController $sendMassageController,AirTimeController $airTimeController)
    {
        $this->SendMassageController = $sendMassageController;
        $this->AirTimeController = $airTimeController;
    }

    public function login(Request $request){
        $validator=  Validator::make($request->all(), [
            'phone' => 'required|min:10|max:10|exists:customers,phone',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "msg" => $validator->errors(),
            ], 422);
        }
        $customer = Customer::where('phone',$request->phone)->first();

        if( $customer->otps->status != 1){
            return response()->json(['status' => false ,'msg' => 'This number is not verify'],422);
        }
        if(! $customer || !Hash::check($request->password,$customer->password)){

            return response()->json(['status' => false ,'msg' => 'This password is not correct'],422);
        }

        $customer->tokens()->delete();
        $customer->device_token = $request->device_name;
        $customer->save();
        $token =    $customer->createToken($request->device_name)->plainTextToken;
        return response()->json(['status' => true ,'data' => ['customer'=>Customer::find($customer->id),'token'=>$token]]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => true ,'msg' => 'logout']);
    }

    public function registerPhone(Request $request){
        $validator=  Validator::make($request->all(), [
            'phone' => 'required|max:10|min:10|unique:customers',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "msg" => $validator->errors(),
            ], 422);
    }
        $customer = new Customer();
        $customer->phone =$request->phone;
        $customer->firstname = 'N/A';
        $customer->lastname = 'N/A';
        $customer->gender = 'N/A';
        $customer->address= 'N/A';
        $customer->save();
        $customer->requestNewOTP();

        $customerPhone = $customer->phone;
        $contentSms= "Your OTP is ". $customer->otps->otp_number;
        $this->SendMassageController->sendOTP($customerPhone,$contentSms);

        return response()->json(['status' => true,'msg' => 'successful'],201);
    }

    public function requestOTP(Request $request){
        $validator=  Validator::make($request->all(), [
            'phone' => 'required|min:10|max:10|exists:customers,phone'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "msg" => $validator->errors(),
            ], 422);
        }

        $customer = Customer::where('phone',$request->phone)->first();
        $otps = OTP::where('customer_id',$customer->id)->pluck('id');

        if($customer->otps){
            $start = $customer->otps->updated_at->addMinutes(3);
            if($start->gt(Carbon::now('Asia/Vientiane'))){
                $timeWait = $start->diffInSeconds(Carbon::now('Asia/Vientiane'));
                return response()->json(['status' => false ,'msg' => 'Waiting about '.gmdate('i:s', $timeWait).' for request new OTP'],422);
            }
        }

        if ($otps->count() > 0){
            $otp = OTP::find($otps->first());
            $otp->otp_number = rand(1000,9999);
            $otp->save();

            if($otp->status == 1){
                return response()->json(['status' => false ,'msg' => 'This number is verify'],422);
            }

            $customerPhone = $customer->phone;
            $contentSms= "Your OTP is ".  $otp->otp_number;
            $this->SendMassageController->sendOTP($customerPhone,$contentSms);
            return response()->json(['status' => true, 'mgs' => 'Request new OTP successful'],201);

        }


    }

    public function verifyOTP(Request $request){
        $validator=  Validator::make($request->all(), [
            'otp_verify' => 'required|numeric',
            'phone' => 'min:10|max:10|exists:customers,phone'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "msg" => $validator->errors(),
            ], 422);
        }

        $customer = Customer::where('phone',$request->phone)->first();
        $start = $customer->otps->updated_at->addMinutes(3);
        //Check OTP number
        if($request->otp_verify == $customer->otps->otp_number){

            $otps = OTP::where('customer_id','=',$customer->id)->pluck('id');
            $otp = OTP::find($otps->first());

            if($otp->status == 1){
                return response()->json(['status' => false ,'msg' => 'This number is verified'],422);
            }

            if($start->lt(Carbon::now('Asia/Vientiane'))){
                return response()->json(['status' => false ,'msg' => 'OTP is expried'],422);
            }

            $otp->status = 1;
            $otp->save();
            return response()->json(['status' => true,'msg' => 'Verify OTP successful']);

        }else{
            return response()->json(['status' => false ,'msg' => 'OTP is incorrect'],422);
        }
    }

    public function setPassword(Request $request){
        $validator= Validator::make($request->all(),[
            'password' => 'required|min:8|same:password_confirm',
            'phone' => 'min:10|max:10|exists:customers,phone',
            'device_token' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "msg" => $validator->errors(),
            ], 422);
        }

        $customer = Customer::where('phone',$request->phone)->first();
        if($customer->otps->status == 0 ){
            return response()->json(['status' => false ,'msg' => 'This number is not verify'],422);
        }
            $customer->tokens()->delete();
            $customer->password = Hash::make($request->password);
            $customer->device_token = $request->device_token;
            $customer->save();

        $token =    $customer->createToken($request->device_token)->plainTextToken;
        return response()->json(['status' => true ,'data' => ['customer'=>Customer::find($customer->id),'token'=>$token]]);

    }
    public function profileupload(Request $request)
    {

        $customerId = $request->user()->currentAccessToken()->tokenable->id;
        $customer = Customer::find($customerId);
        if ($request->hasFile("image")) {
            $imageNames = time().'.'.$request->image->extension();
            $stringImageReformat = base64_encode('_' . time());
            $ext = $request->file('image')->getClientOriginalExtension();
            Storage::delete("public/customer_image/".str_replace('/storage/customer_image/','',$customer->image));

            
            $imageEncode = File::get($request->image);
            $customer->image = "/storage/customer_image/" . $imageNames;
            $customer->save();
            Storage::disk('local')->put('public/customer_image/' . $imageNames, $imageEncode);

        }

        return response()->json(['status' => true, 'msg' => 'Success']);
    }
    public function moreAccount(Request $request){
        $validator = Validator::make($request->all(),[
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'file|image|max:50000|mimes:jpeg,png,jpg',
        ]);
        if($validator->fails()){
            return response()->json([
            "status" => false,
            "msg" => $validator->errors()  ,
            ],422);

        }


        $customerId = $request->user()->currentAccessToken()->tokenable->id;
        $customer = Customer::find($customerId);
        $customer->makeCustomer($request->firstname,$request->lastname,$request->birthday,$request->gender,$request->address);
        $customer->status = true ;
        $customer->save();


        if($request->hasFile("image")){
            if($customer->image == null){
                $stringImageReformat = base64_encode('_'.time());
                $ext = $request->file('image')->getClientOriginalExtension();
                $imageName = $stringImageReformat.".".$ext;
                $imageEncode = File::get($request->image);
                $customer->image = "/storage/customer_image/".$imageName;
                $customer->save();
                Storage::disk('local')->put('public/customer_image/'.$imageName, $imageEncode);
            }else{
                Storage::delete("public/customer_image/".str_replace('/storage/customer_image/','',$customer->image));
                $request->image->storeAs("public/customer_image",str_replace('/storage/customer_image/','',$customer->image));
            }

        }

        return response()->json(['status' => true , 'data' => $customer]);
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(),[
            'oldPassword' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required|same:password'

        ]);
        if($validator->fails()){
            return response()->json([
                "status" => false,
                "msg" => $validator->errors() ,
            ],422);

        }
        $customerId = $request->user()->currentAccessToken();
        $customer=Customer::find($customerId->tokenable->id);

        if(!(Hash::check($request->get('oldPassword'),$customer->password))){
            return response()->json([
                "status" => false,
                "msg" => ['oldPassword' => 'old password invalid'] ,
            ],422);

        }else{
            $customer->password = Hash::make($request->get('password'));
            $customer->save();
            return response()->json(['status' => true , 'msg' => "Change new password success"]);

        }
    }

    public function customerInfo(Request $request){
        $customer = $request->user()->currentAccessToken()->tokenable;
        $customerData = Customer::where('id',$customer->id)
            ->select('id','firstname','lastname','phone','birthday','gender','address','status','image')
            ->withCount('notification')->first();
        $balance = $this->AirTimeController->viewBalance($customer->phone);
        return response()->json(['status' => true , 'data' => $customerData,'balance' => $balance]);
    }



}
