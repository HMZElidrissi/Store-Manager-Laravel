@extends('backOffice.layouts.app')

@section('title', 'Manage permissions')

@section('content')
<div>
    <main class="flex-1">
        <div class="py-6">
            <div class="space-y-6 space-x-6 px-6">
                <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Assign Permission</h3>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form class="space-y-6" action="{{ route('permissions.assign') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="role" class="block text-sm font-medium text-gray-700"> Role
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <select id="role" name="role"
                                                class="mt-1 focus:ring-amber-500 focus:border-amber-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="permission" class="block text-sm font-medium text-gray-700"> Permission
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <select id="permission" name="permission"
                                                class="mt-1 focus:ring-amber-500 focus:border-amber-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                @foreach ($permissions as $permission)
                                                <option value="{{ $permission->id }}">{{ $permission->permission }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <a type="button"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500"
                                        href="{{ route("permissions.index") }}">
                                        Cancel</a>
                                    <button type="submit"
                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection