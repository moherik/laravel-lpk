<?php

namespace App\Http\Livewire\Location;

use App\Models\Location;
use App\Models\LocationType;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $editId;

    public $images = [];
    public $title;
    public $address;
    public $phone;
    public $lat_long;
    public $description;
    public $website;
    public $status;
    public $location_type_id;

    protected $rules = [
        'images.*' => 'image|max:1024|mimes:png,jpg,jpeg',
        'title' => 'required|string|max:100',
        'address' => 'required|string',
        'phone' => 'nullable',
        'lat_long' => 'required',
        'description' => 'nullable',
        'website' => 'nullable',
        'status' => 'required',
        'location_type_id' => 'required',
    ];

    protected $messages = [
        'required' => ':attribute harus diisi',
        'max' => ':attribute maksimal :max karakter',
        'string' => ':attribute harus berupa string',
        'image' => ':attribute harus berupa file gambar',
        'mimes' => ':attribute harus format png, jpg, jpeg'
    ];

    protected $validationAttributes = [
        'images.*' => 'Gambar',
        'title' => 'Nama lokasi', 
        'address' => 'Alamat', 
        'phone' => 'Nomor telepon', 
        'lat_long' => 'Latitude Longitude', 
        'description' => 'Deskripsi', 
        'website' => 'Website', 
        'status' => 'Status',
        'location_type_id' => 'Tipe lokasi',
    ];

    protected $listeners = ['setLatLong'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function getLocationTypesProperty()
    {
        return LocationType::orderBy('title', 'ASC')->get();
    }

    public function mount()
    {
        if($this->editId != null)
            $this->edit($this->editId);
    }

    public function render()
    {
        return view('livewire.location.form');
    }

    public function save()
    {
        $validatedData = $this->validate();
        $validatedData["user_id"] = auth()->user()->id;
        $validatedData["is_verif"] = 1;
        $store = Location::create($validatedData);
        if($store) {
            return redirect()->route('location.index');
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        if($this->editId == null)
            return redirect()->route('location.index');            
    
        $location = Location::where('id', $this->editId)->first();
        if($location) {
            $location->update($validatedData);
            return redirect()->route('location.index');
        }
    }

    public function edit($id)
    {
        $location = Location::where('id', $id)->first();
        if(!$location)
            return redirect()->route('location.index');

        $this->title = $location->title;
        $this->address = $location->address;
        $this->phone = $location->phone;
        $this->lat_long = $location->lat_long;
        $this->description = $location->description;
        $this->website = $location->website;
        $this->status = $location->status;
        $this->location_type_id = $location->type->id ?? null;
    }

    public function setLatLong($lat_long)
    {
        $this->lat_long = $lat_long;
    }
}
