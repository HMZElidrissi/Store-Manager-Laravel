@extends('backOffice.layouts.app')

@section('title', 'Manage sales')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-xl font-semibold text-gray-900">Sales</h1>
      <p class="mt-2 text-sm text-gray-700">A list of all sales.</p>
    </div>
  </div>
  <div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Product</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Client</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Quantity</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total Price</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
              @foreach ($sales as $sale)
                  <tr>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                  <div class="flex items-center">
                    <div class="ml-4">
                      <div class="font-medium text-gray-900">{{ $sale->product->title }}</div>
                      <div class="text-gray-500">{{ Str::limit($sale->product->description, 25) }}</div>
                    </div>
                  </div>
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                  <div class="text-gray-900">{{ $sale->client->name }}</div>
                </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                      <div class="text-gray-900">{{ $sale->quantity }}</div>
                  </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                  <div class="text-gray-900">{{ $sale->product->price * $sale->quantity }}</div>
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <div class="py-1 px-2 rounded border text-center {{ $sale->status == 'delivered' ? 'border-green-500 text-green-500' : 'border-amber-500 text-amber-500' }}">
                        {{ ucfirst($sale->status) }}
                    </div>
                </td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                  <div class="flex space-x-2">
                    <form action="{{ route('sales.markAsDelivered', $sale->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                      <button type="submit">
                          <svg class="inline w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                              <path fill="#16a34a" fill-rule="evenodd" d="M12 2a3 3 0 0 0-2.1.9l-.9.9a1 1 0 0 1-.7.3H7a3 3 0 0 0-3 3v1.2c0 .3 0 .5-.2.7l-1 .9a3 3 0 0 0 0 4.2l1 .9c.2.2.3.4.3.7V17a3 3 0 0 0 3 3h1.2c.3 0 .5 0 .7.2l.9 1a3 3 0 0 0 4.2 0l.9-1c.2-.2.4-.3.7-.3H17a3 3 0 0 0 3-3v-1.2c0-.3 0-.5.2-.7l1-.9a3 3 0 0 0 0-4.2l-1-.9a1 1 0 0 1-.3-.7V7a3 3 0 0 0-3-3h-1.2a1 1 0 0 1-.7-.2l-.9-1A3 3 0 0 0 12 2Zm3.7 7.7a1 1 0 1 0-1.4-1.4L10 12.6l-1.3-1.3a1 1 0 0 0-1.4 1.4l2 2c.4.4 1 .4 1.4 0l5-5Z" clip-rule="evenodd"/>
                          </svg>
                          <span class="ml-1.5 text-green-600">Mark as delivered</span>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
