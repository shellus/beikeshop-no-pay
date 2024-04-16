<?php

namespace Plugin\NoPay\Controllers;

use App\Http\Controllers\Controller;
use Beike\Models\Order;
use Beike\Services\StateMachineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CallbackController extends Controller
{
    /**
     * 微信扫码支付轮训订单状态接口
     */
    public function orderStatus(Request $request)
    {
        $orderNumber = $request->get('number');
        $order = Order::query()->where('number', $orderNumber)->firstOrFail();

        if ($order->status !== 'paid') {
            StateMachineService::getInstance($order)->changeStatus('paid', '订单已支付', true);
            $order->refresh();
            Log::info('no_pay: success.', ['order' => $order->number]);
        } else {
            Log::info('no_pay: order already paid.', ['order' => $order->number]);
        }

        $data = [
            'number' => $orderNumber,
            'status' => $order->status ?? 'unknown',
        ];

        return json_success('', $data);
    }
}
