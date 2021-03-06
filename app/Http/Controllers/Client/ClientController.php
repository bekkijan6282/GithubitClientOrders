<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientPostRequest;
use App\Http\Resources\Client\ClientOrdersResource;
use App\Http\Resources\Client\ClientsResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Client\Client;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index(Request $request): ResourceCollection
    {
        $pageSize = $request->pageSize ?? 15;
        $withOrders = $request->withOrders ?? false;

        $clients = Client::filter($request)->paginate($pageSize);

        return $withOrders ? ClientOrdersResource::collection($clients) : ClientsResource::collection($clients);
    }

    public function store(ClientPostRequest $request): ClientsResource
    {
        $validated = $request->validated();
        $client = Client::create($validated);

        return new ClientsResource($client);
    }

    public function show(Client $client): ClientsResource
    {
        $withOrders = $request->withOrders ?? false;

        return $withOrders ? new ClientOrdersResource($client) : ClientsResource($client);
    }

    public function update(ClientPostRequest $request, Client $client): ClientsResource
    {
        $validated = $request->validated();
        $client->update($validated);

        return new ClientsResource($client);
    }

    public function destroy(Client $client): JsonResponse
    {
        $client->delete();

        return response()->json(['msg' => 'deleted'], JsonResponse::HTTP_NO_CONTENT);
    }

    public function getUserTransactions(Request $request): JsonResponse
    {
        $client_id = $request->client_id ?? null;
        if($client_id)
        {
            $transactions = DB::
            select("SELECT * FROM order_transactions WHERE order_id IN (SELECT id FROM orders WHERE client_id = ?)",[$client_id]);
            return response()->json(['data' => $transactions]);
        }
        return response()->json(['data' => 'Client not found'], JsonResponse::HTTP_NOT_FOUND);
    }
}
