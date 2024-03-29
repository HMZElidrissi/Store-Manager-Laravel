<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ClientRepository;
use App\Http\Requests\UpdateClientRequest;

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
        $this->authorize('viewAny', User::class);
        $clients = $this->clientRepository->getAllClients();
        return view('backOffice.clients.index', compact('clients'));
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit($id)
    {
        $this->authorize('update', User::class);
        $client = $this->clientRepository->getById($id);
        return view('backOffice.clients.edit', compact('client'));
    }

    /**
     * Update the specified client in storage.
     */
    public function update(UpdateClientRequest $request, $id)
    {
        $this->authorize('update', User::class);
        $attributes = $request->validated();
        $attributes = $this->clientRepository->uploadAvatar($request, $attributes);
        $this->clientRepository->update($id, $attributes);
        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');
    }

    /**
     * Remove the specified client from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete', User::class);
        $client = $this->clientRepository->getById($id);
        if ($client->avatar) {
            Storage::delete($client->avatar);
        }
        $this->clientRepository->delete($id);
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully!');
    }
}
