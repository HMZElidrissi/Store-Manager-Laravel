@extends('backOffice.layouts.app')

@section('title', 'Manage permissions')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-xl font-semibold text-gray-900">Permissions</h1>
      <p class="mt-2 text-sm text-gray-700">A list of all roles and their permissions.</p>
    </div>
    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
      <a href="{{ route('permissions.add') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-amber-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 sm:w-auto">+ Assign a permission</a>
    </div>
  </div>
  <div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="py-3.5 pl-3 pr-4 text-left text-sm font-semibold text-gray-900 sm:pr-6">Permission</th>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Roles</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
              @foreach ($permissions as $permission)
              <tr>
                <td class="py-3 pl-3 pr-4 text-left text-sm text-gray-500 sm:pr-6">{{ $permission->permission }}</td>
                <td class="py-3 pl-4 pr-3 text-left text-sm text-gray-500 sm:pl-6">
                  @foreach ($permission->roles as $role)
                  <div class="flex space-x-4">
                    <ul class="list-none">
                      <li>{{ $role->role }}</li>
                    </ul>
                    <form action="{{ route('permissions.revoke', [$role, $permission]) }}" method="POST">
                      @csrf
                      <button type="submit">
                        <svg class="w-5 h-5" fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path fill="#ef4444" fill-rule="evenodd" d="M5 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0Zm-2 9a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1Zm13-6a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z" clip-rule="evenodd"/>
                        </svg>
                      </button>
                    </form>
                  </div>
                  @endforeach
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