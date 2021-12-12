<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Transaction\OrderTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionController extends Controller
{
    public function index(Request $request): ResourceCollection
    {
        $pageSize = $request->pageSize ?? 15;
        $transactions = OrderTransaction::when($request->order_id, function (Builder $builder, $order_id) {
            $builder->where('order_id',$order_id);
        })
         ->paginate($pageSize);

        return TransactionResource::collection($transactions);
    }

    public function store(TransactionRequest $request): TransactionResource
    {
        $validated = $request->validated();
        $transaction = OrderTransaction::create($validated);

        return new TransactionResource($transaction);
    }

    public function show(OrderTransaction $order_transaction): TransactionResource
    {
        return new TransactionResource($order_transaction);
    }

    public function update(TransactionRequest $request, OrderTransaction $order_transaction): TransactionResource
    {
        $validated = $request->validated();
        $order_transaction->update($validated);

        return new TransactionResource($order_transaction);
    }

    public function destroy(OrderTransaction $order_transaction): JsonResponse
    {
        $order_transaction->delete();

        return response()->json(['msg' => $order_transaction], JsonResponse::HTTP_NO_CONTENT);
    }
}
