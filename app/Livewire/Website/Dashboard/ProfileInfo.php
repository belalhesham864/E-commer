<?php

namespace App\Livewire\Website\Dashboard;

use App\Models\City;
use App\Models\Country;
use App\Models\Governrate;
use App\utils\ImageManger;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileInfo extends Component
{
    use WithFileUploads;

    public $user;
    protected ImageManger $imageManger;
    public $screen = 'dashboard';

    public $name, $phone, $email;
    public $country_id, $governrate_id, $city_id;
    public $image;
    public $existingImage;

    public $countries = [];
    public $governrates = [];
    public $cities = [];

    public function mount($user = null)
    {
        $this->user = $user ?? auth('web')->user();

        $this->name          = $this->user->name;
        $this->email         = $this->user->email;
        $this->phone         = $this->user->phone;
        $this->country_id    = $this->user->country_id;
        $this->governrate_id = $this->user->governrate_id;
        $this->city_id       = $this->user->city_id;
        $this->existingImage = $this->user->image;

        $this->countries = Country::all();

        if ($this->country_id) {
            $this->governrates = Governrate::where('country_id', $this->country_id)->get();
        }

        if ($this->governrate_id) {
            $this->cities = City::where('governrate_id', $this->governrate_id)->get();
        }
    }

    public function boot(ImageManger $imageManger)
    {
        $this->imageManger = $imageManger;
    }

    public function updatedCountryId($value)
    {
        $this->governrates   = $value ? Governrate::where('country_id', $value)->get() : [];
        $this->governrate_id = null;
        $this->cities        = [];
        $this->city_id       = null;
    }

    public function updatedGovernrateId($value)
    {
        $this->cities  = $value ? City::where('governrate_id', $value)->get() : [];
        $this->city_id = null;
    }

    #[On('profileInfoselectScreen')]
    public function updateScreen($screen)
    {
        $this->screen = $screen;
    }

    public function rules()
    {
        return [
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'phone'         => 'required|string|max:20|unique:users,phone,' . $this->user->id,
            'country_id'    => 'nullable|exists:countries,id',
            'governrate_id' => 'nullable|exists:governrates,id',
            'city_id'       => 'nullable|exists:cities,id',
            'image'         => 'nullable|image|max:5120',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function updateProfile()
    {
        $this->validate();

        $data = [
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'country_id'    => $this->country_id,
            'governrate_id' => $this->governrate_id,
            'city_id'       => $this->city_id,
        ];

        if ($this->image) {
            if ($this->existingImage) {
                $this->imageManger->deleteImageFromLocal('uploads/users/' . $this->existingImage);
            }
            $data['image'] = $this->imageManger->uploadSingeImage('/', $this->image, 'users');
            $this->existingImage = $data['image'];
        }

        $update = $this->user->update($data);

        if (!$update) {
            $this->dispatch('error-message', 'Profile Updated failed');
            return;
        }

        $this->image = null;
        $this->dispatch('success-message', 'Profile Updated Successfully');
    } 

    public function render()
    {
        return view('livewire.website.dashboard.profile-info');
    }
}
