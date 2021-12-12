<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Resources\Order\ClientOrderResource;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderController extends Controller
{
    public function index(Request $request): ResourceCollection
    {
        $pageSize = $request->pageSize ?? 15;
        $clientOrders = $request->clientOrders ?? false;
        $orders = Order::when($request->client_id, function(Builder $builder, int $client_id) {
            $builder->where('client_id', $client_id);
        })->orderBy('id','DESC')
                       ->paginate($pageSize);

        return $clientOrders ? ClientOrderResource::collection($orders) : OrderResource::collection($orders);
    }

    public function store(OrderRequest $request): OrderResource
    {
        $validated = $request->validated();
        $order = Order::create($validated);

        return new OrderResource($order);
    }

    public function show(Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    public function update(OrderRequest $request, Order $order): OrderResource
    {
        $validated = $request->validated();
        $order->update($validated);

        return new OrderResource($order);
    }

    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json(['msg' => 'deleted'], JsonResponse::HTTP_NO_CONTENT);
    }
}
