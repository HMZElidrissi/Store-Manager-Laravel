<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ClientRepository;

class ClientController extends Controller
{
    public function __construct(protected ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Display a listing of the client.
     */
    public function index()
    {
        $clients = $this->clientRepository->getAllClients();
        return view('backOffice.clients.index', compact('clients'));
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit($id)
    {
        $client = $this->clientRepository->getById($id);
        return view('backOffice.clients.edit', compact('client'));
    }

    /**
     * Update the specified client in storage.
     */
    public function update(UpdateClientRequest $request, $id)
    {
        $attributes = $request->validated();
        $this->clientRepository->update($attributes, $id);
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified client from storage.
     */
    public function destroy($id)
    {
        $client = $this->clientRepository->getById($id);
        if ($client->avatar) {
            Storage::delete($client->avatar);
        }
        $this->clientRepository->delete($id);
        return redirect()->route('clients.index');
    }
}
