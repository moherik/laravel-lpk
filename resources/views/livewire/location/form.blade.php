<div>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 md:flex md:flex-row md:gap-8 flex-wrap">
        <div class="w-full bg-white overflow-hidden shadow-xl py-4 px-5 sm:rounded-lg">
            <h4 class="text-xl font-semibold text-gray-800">Form</h4>

            <form wire:submit.prevent="{{ $editId == null ? 'save' : 'update' }}" enctype="multipart/form-data">
                <div class="md:flex mt-4 gap-x-9 text-gray-800">
                    <div class="md:w-full">
                        <div class="md:flex md:gap-x-5 mb-4">
                            <label for="title" class="md:w-3/12 mt-3">Foto: <span class="text-red-500">*</span></label>
                            <div class="md:flex-1 w-full md:w-6/12">
                                <input type="file" wire:model="images" multiple class="form-input w-full rounded-md shadow-sm block {{ $errors->has('images') ? 'border-red-500' : '' }}" />
                                @if(isset($images) && $images != null)
                                <div class="mt-2 flex gap-5">
                                    @foreach($images as $key => $image)
                                        <img src="{{ $image->temporaryUrl() }}" width="120px" class=""/>
                                    @endforeach
                                </div>
                                @endif
                                @error('images') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="md:flex md:gap-x-5 mb-4">
                            <label for="title" class="md:w-3/12 mt-3">Nama Lokasi: <span class="text-red-500">*</span></label>
                            <div class="md:flex-1 w-full md:w-6/12">
                                <input type="text" name="title" wire:model="title" class="form-input w-full rounded-md shadow-sm block {{ $errors->has('title') ? 'border-red-500' : '' }}" placeholder="Nama Lokasi"/>
                                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="md:flex md:gap-x-5 mb-4">
                            <label for="address" class="mt-3 md:w-3/12">Alamat: <span class="text-red-500">*</span></label>
                            <div class="md:flex-1 w-full md:w-6/12">
                                <textarea name="address" wire:model="address" class="form-input w-full rounded-md shadow-sm block {{ $errors->has('address') ? 'border-red-500' : '' }}" placeholder="Alamat"></textarea>
                                @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="md:flex md:gap-x-5 mb-4">
                            <label for="lat_long" class="md:w-3/12 mt-3">Latitude, Longtude: <span class="text-red-500">*</span></label>
                            <div class="md:flex-1 w-full md:w-6/12">
                                <input type="text" name="lat_long" id="latLong" wire:model="lat_long" class="form-input w-full rounded-md shadow-sm block {{ $errors->has('lat_long') ? 'border-red-500' : '' }}" placeholder="Contoh: -7.468098470354285, 112.22876843944812"/>
                                <button id="getPosition" type="button" class="inline-flex items-center px-4 py-2 bg-cool-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase mt-2 outline-none">Get current position</button>
                                @if(isset($lat_long) && $lat_long != null)
                                    <p class="mt-2 text-sm block">Cek <a href="http://www.google.com/maps/place/{{$lat_long}}" target="_blank" class="text-blue-500 hover:underline">http://www.google.com/maps/place/{{$lat_long}}</a></p>
                                @endif
                                @error('lat_long') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @enderror
                           </div>
                        </div>
                        <div class="md:flex md:gap-x-5 mb-4">
                            <label for="description" class="mt-3 md:w-3/12">Deskripsi: </label>
                            <div class="md:flex-1 w-full md:w-6/12">
                                <textarea name="description" wire:model="description" class="form-input w-full rounded-md shadow-sm block {{ $errors->has('description') ? 'border-red-500' : '' }}" placeholder="Deskripsi lokasi/tempat"></textarea>
                                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="md:flex md:gap-x-5 mb-4">
                            <label for="phone" class="md:w-3/12 mt-3">No. Telepon:</label>
                            <div class="md:flex-1 w-full md:w-6/12">
                                <input type="tel" name="phone" wire:model="phone" class="form-input w-full rounded-md shadow-sm block {{ $errors->has('phone') ? 'border-red-500' : '' }}" placeholder="Contoh: 08563XXX"/>
                                @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="md:flex md:gap-x-5 mb-4">
                            <label for="website" class="md:w-3/12 mt-3">Website:</label>
                            <div class="md:flex-1 w-full md:w-6/12">
                                <input type="text" name="website" wire:model="website" class="form-input w-full rounded-md shadow-sm {{ $errors->has('website') ? 'border-red-500' : '' }}" placeholder="Contoh: google.com (tanpa http:// atau https://)"/>
                                    @error('website') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                        </div>
                        <div class="md:flex md:gap-x-5 mb-4">
                            <label for="type" class="md:w-3/12 mt-3">Tipe Lokasi: <span class="text-red-500">*</span></label>
                            <div class="md:flex-1 w-full md:w-6/12">
                                <select name="type" wire:model="location_type_id" class="form-input w-full rounded-md shadow-sm {{ $errors->has('location_type_id') ? 'border-red-500' : '' }}">
                                    <option value="">Pilih Tipe Lokasi</option>
                                    @foreach($this->location_types as $loc_type)
                                        <option value="{{$loc_type->id}}">{{$loc_type->title}}</option>
                                    @endforeach
                                </select>
                                @error('location_type_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="md:flex md:gap-x-5 mb-4">
                            <label for="status" class="md:w-3/12 mt-3">Status: <span class="text-red-500">*</span></label>
                            <div class="md:flex-1 w-full md:w-6/12">
                                <select name="status" wire:model="status" class="form-input w-full rounded-md shadow-sm {{ $errors->has('status') ? 'border-red-500' : '' }}">
                                    <option value="">Pilih Status Post</option>
                                    <option value="DRAFT">Draft</option>
                                    <option value="PUBLISH">Publish</option>
                                </select>
                                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-6 mb-4 text-right">
                            <a href="{{ route('location.index') }}" class="inline-flex items-center px-4 py-2 bg-cool-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cool-gray-800 active:hover:bg-cool-gray-800 focus:outline-none focus:border-cool-gray-800 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-auto">Batal</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-auto">
                                <span wire:loading.remove wire:target="save">Save</span>
                                <span wire:loading wire:target="save">Saving...</span>
                            </button>
                        </div>
                    </div>

                    <!-- <div class="md:w-4/12">
                        Gambar disini
                    </div> -->
                </div>
            </form>
        </div>
    </div>
</div>
