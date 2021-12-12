<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientPostRequest;
use App\Http\Resources\Client\ClientsResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Client\Client;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClientController extends Controller
{
    public function index(Request $request): ResourceCollection
    {
        $pageSize = $request->pageSize ?? 15;
        $clients = Client::filter($request)->paginate($pageSize);

        return ClientsResource::collection($clients);
    }

    public function store(ClientPostRequest $request): ClientsResource
    {
        $validated = $request->validated();
        $client = Client::create($validated);

        return new ClientsResource($client);
    }

    public function show(Client $client): ClientsResource
    {
        return ClientsResource($client);
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
}
