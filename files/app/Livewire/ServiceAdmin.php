<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Service;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ServiceAdmin extends Component
{
    use WithFileUploads;

    public $mediaFiles = [];
    public $storedMedia = [];
    public $videoUrl;
    public $serviceId;
    public $title;
    public $description;
    public $price;
    public $status = true;
    public $category_id;
    public $isEditing = false;
    public $showForm = false;
    public $filesToDelete = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|min:50',
        'price' => 'required|numeric|min:100',
        'category_id' => 'required|exists:categories,id',
        'mediaFiles.*' => 'mimes:jpg,jpeg,png,mp4,mov,avi|max:5120',
        'videoUrl' => 'nullable|url',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addMediaFiles($files)
{
    dd( $this->mediaFiles);
    foreach ($files as $file) {
        $this->mediaFiles[] = $file;
    }
}

public function removeSelectedImage($index)
{
    if (isset($this->mediaFiles[$index])) {
        unset($this->mediaFiles[$index]);
        $this->mediaFiles = array_values($this->mediaFiles); // إعادة ترتيب الفهرس
    }
}

    public function deleteStoredMedia($mediaId)
    {
        $media = Media::with('service')->findOrFail($mediaId);
        
        $this->authorize('delete', $media->service);
        
        Storage::disk('public')->delete($media->file_path);
        $media->delete();

        $this->storedMedia = collect($this->storedMedia)
            ->reject(fn ($item) => $item['id'] == $mediaId)
            ->values()
            ->toArray();
    }

 
    public function render()
    {
        return view('livewire.service-admin', [
            'services' => Service::with(['media', 'category'])
                ->where('user_id', Auth::id())
                ->latest()
                ->get(),
            'categories' => Category::all()
        ])->layout('layouts.dashboard');
    }
    public function showAddForm()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showForm = true;
    }

    public function createService()
    {
        $this->validate();

        $service = Service::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status,
            'user_id' => Auth::id(),
            'category_id' => $this->category_id,
        ]);

        $this->handleMediaUpload($service);

        session()->flash('message', 'تم إضافة الخدمة بنجاح!');
        $this->resetForm();
    }

    public function editService($id)
    {
        $service = Service::with(['media', 'category'])
            ->whereUserId(Auth::id())
            ->findOrFail($id);

        $this->serviceId = $service->id;
        $this->fill($service->only([
            'title', 'description', 'price', 'status', 'category_id'
        ]));
        
        $this->storedMedia = $service->media->map(fn ($media) => [
            'id' => $media->id,
            'url' => Storage::url($media->file_path),
            'type' => $media->file_type
        ])->toArray();

        $this->isEditing = true;
        $this->showForm = true;
    }

    public function updateService()
    {
        $this->validate();

        $service = Service::whereUserId(Auth::id())
            ->findOrFail($this->serviceId);

        $service->update($this->only([
            'title', 'description', 'price', 'status', 'category_id'
        ]));

        $this->handleMediaUpload($service);
        $this->deleteMarkedFiles();

        session()->flash('message', 'تم تحديث الخدمة بنجاح!');
        $this->resetForm();
    }

    public function deleteService($id)
    {
        $service = Service::with('media')
            ->whereUserId(Auth::id())
            ->findOrFail($id);

        $this->authorize('delete', $service);
        
        foreach ($service->media as $media) {
            Storage::disk('public')->delete($media->file_path);
        }
        
        $service->media()->delete();
        $service->delete();

        session()->flash('message', 'تم الحذف بنجاح!');
    }

    protected function handleMediaUpload(Service $service)
    {
        foreach ($this->mediaFiles as $file) {
            $path = $file->store(
                "services/{$service->id}/" . date('Y-m'), 
                'public'
            );
            
            $service->media()->create([
                'file_path' => $path,
                'file_type' => $this->getFileType($file),
                'user_id' => Auth::id()
            ]);
        }
    }

    protected function deleteMarkedFiles()
    {
        if (!empty($this->filesToDelete)) {
            Media::whereIn('id', $this->filesToDelete)
                ->whereUserId(Auth::id())
                ->delete();
        }
    }

    private function getFileType($file)
    {
        return str_starts_with($file->getMimeType(), 'video/') 
            ? 'video' 
            : 'image';
    }

    public function resetForm()
    {
        $this->reset([
            'serviceId',
            'title',
            'description',
            'price',
            'status',
            'category_id',
            'mediaFiles',
            'storedMedia',
            'videoUrl',
            'showForm',
            'isEditing',
            'filesToDelete'
        ]);
    }
}