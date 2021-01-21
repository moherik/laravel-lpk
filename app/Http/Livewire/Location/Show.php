<?php

namespace App\Http\Livewire\Location;

use App\Models\Location;
use App\Models\LocationType;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    protected $model;
    protected const PAGINATE_LENGTH = 6;

    public $type = null;
    public $requestDeleteId;

    public function __construct()
    {
        $this->model = new Location();
    }

    public function mount()
    {
        $this->type = request()->get('type');
    }

    public function getLocationsProperty()
    {
        if($this->type != null) {
            $type = LocationType::where('slug', $this->type)->first();
            if($type)
                return $this->model->where('location_type_id', $type->id)->orderBy('id', 'DESC')->paginate(self::PAGINATE_LENGTH);
        }

        return $this->model->orderBy('id', 'DESC')->paginate(self::PAGINATE_LENGTH);
    }

    public function getLocationTypesProperty()
    {
        return LocationType::orderBy('id', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.location.show');
    }

    public function confirmDelete($id)
    {
        $this->requestDeleteId = $id;
    }

    public function destroy($id)
    {
        $location = $this->model->where('id', (int)$id)->firstOrFail();

        if($location->delete())
            $this->resetPage();
    }

    public function changeVerif($id, $verif)
    {
        $location = $this->model->where('id', (int)$id)->first();
        if($location) {
            $location->update(['is_verif' => $verif]);
            $this->resetPage();
        }
    }
}
