<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Admin
                </h2>
                <div class="ml-auto">
                    <button wire:click="toggleModal" class="px-4 py-2 bg-cool-gray-600 outline-none rounded-md text-sm text-gray-200 hover:bg-cool-gray-800 focus:outline-none">
                        Tambah Admin
                        <svg wire:loading wire:target="toggleModal" class="animate-spin -mr-1 ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="w-full">
                    <thead class="font-bold text-sm uppercase h-6 text-left bg-cool-gray-700 text-white">
                        <tr>
                            <th class="p-4 w-15">#</th>
                            <th class="p-4">Nama</th>
                            <th class="p-4">Email</th>
                            <th class="p-4">Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->users as $user)
                        <tr class="hover:bg-cool-gray-200">
                            <td class="p-4">{{ $loop->iteration }}</td> 
                            <td class="p-4">{{ $user->name }}</td>
                            <td class="p-4">{{ $user->email }}</td>
                            <td class="p-4">{{ $user->created_at->format('d-m-Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-20 text-center">
                                <p>Tidak ada data.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="fixed z-10 inset-0 overflow-y-auto {{ $showModal ? '' : 'hidden'}}">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <form wire:submit.prevent="store">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-semibold text-gray-900 mb-5" id="modal-headline">
                                Tambah Admin
                            </h3>
                            <div class="mt-2">
                                <div class="group mb-3">
                                    <label for="name" class="text-sm">Nama <span class="text-red-600">*</span></label>
                                    <input type="text" wire:model="name" name="name" class="form-input rounded-md shadow-sm mt-1 block w-full {{ $errors->has('name') ? 'border-red-600 border' : '' }}"/>
                                    @error('name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="group mb-3">
                                    <label for="email" class="text-sm">Email <span class="text-red-600">*</span></label>
                                    <input type="text" wire:model="email" name="email" class="form-input rounded-md shadow-sm mt-1 block w-full {{ $errors->has('email') ? 'border-red-600 border' : '' }}"/>
                                    @error('email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="group mb-3">
                                    <label for="password" class="text-sm">Password <span class="text-red-600">*</span></label>
                                    <input type="password" wire:model="password" name="password" class="form-input rounded-md shadow-sm mt-1 block w-full {{ $errors->has('password') ? 'border-red-600 border' : '' }}"/>
                                    @error('password') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 mb-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-cool-gray-600 text-base font-medium text-white hover:bg-cool-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Save
                            <svg wire:loading wire:target="store" class="animate-spin -mr-1 ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                        <button wire:click="toggleModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
