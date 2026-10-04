<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\OrderShippingRequest;
use App\Models\Order;
use App\Models\Transaction;
use App\services\website\OrderServices;
use App\Services\Website\PaymentServices;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(private OrderServices $orderServices, private PaymentServices $paymentServices) {}
    public function index()
    {
        return view('website.check-out');
    }

    public function checkout(OrderShippingRequest $request)
    {
        $data = $request->validated();
        $invoiceValue = $this->orderServices->getInvoiceValue($data);
        if ($invoiceValue < 1 && $invoiceValue == null) {
            return redirect()->back()->withErrors('cart is empty');
        }
        $paymentData = [
            'CustomerName'       => $data['first_name'] . ' ' . $data['last_name'],
            'NotificationOption' => 'LNK',
            'InvoiceValue'       => $invoiceValue,
            'DisplayCurrencyIso' => 'EGP',
            'MobileCountryCode'  => '+20',
            'CustomerMobile' => $data['user_phone'],
            'CustomerEmail'      =>  $data['user_email'],
            'CallBackUrl'        => 'http://127.0.0.1:8000/checkout/callback',
            'ErrorUrl'           => 'http://127.0.0.1:8000/checkout/error',
            'Language'           => 'en',
        ];


        $checkout = $this->paymentServices->checkout($paymentData);

        if ($url = $checkout['Data']['InvoiceURL']) {
            $createOrder = $this->orderServices->createOrder($data);
            if (!$createOrder) {
                session()->flash('error', 'Something went wrong');
                return redirect()->route('checkout');
            }

            $createTranscation = $this->orderServices->createTranscation($checkout, $createOrder->id);
            if (!$createTranscation) {
                session()->flash('error', 'Something went wrong');
                return redirect()->route('checkout');
            }

            return redirect($url);
        } else {

            session()->flash('error', 'Something went wrong');
            return redirect()->route('checkout');
        }
    }

   public function callback(){
    $data=[];
    $data['Key']=request()->paymentId;
    $data['KeyType']='paymentId';


    $responce=$this->paymentServices->getPaymentStatus($data);
    if($responce['IsSuccess']==true){
        $user_id=Transaction::where('transaction_id',$responce['Data']['InvoiceId'])->pluck('user_id');
        $order_id=Transaction::where('transaction_id',$responce['Data']['InvoiceId'])->pluck('order_id');
        Order::where('user_id',$user_id)->where('id',$order_id)->update(['status'=>'completed']);
        $cart=auth('web')->user()->cart;
        $this->orderServices->clearCart($cart);
flash()->success('The order was paid successfully');
        return redirect()->route('Home.index');
    }

    session()->flash('error', 'Something went wrong');
    return redirect()->route('checkout');
    }
    public function error()
    {
        $data = [];
        $data['Key'] = request()->paymentId;
        $data['KeyType'] = 'paymentId';

        $responce = $this->paymentServices->getPaymentStatus($data);
        if ($responce && $responce['IsSuccess'] == true) {
            $transaction = Transaction::where('transaction_id', $responce['Data']['InvoiceId'])->first();
            if ($transaction) {
                Order::where('id', $transaction->order_id)
                    ->where('user_id', $transaction->user_id)
                    ->update(['status' => 'cancelled']);
            }
        }

        flash()->error('Payment failed. Please try again later.');
        return redirect()->route('checkout');
    }
}
