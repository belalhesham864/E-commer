<?php

namespace App\Livewire\Website\Dashboard;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Reiview extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $user, $screen = 'dashboard';
    public $editingReviewId = null;
    public $editComment = '';
    public $showEditModal = false;

    public function mount($user)
    {
        $this->user = $user;
    }

    #[On('Reiview')]
    public function updateScreen($screen)
    {
        $this->screen = $screen;
    }

    public function deleteReview($id)
    {
        $review = $this->user->reviews()->find($id);
        if ($review) {
            $review->delete();
            $this->dispatch('success-message', 'Review deleted successfully.');
        }
    }

    public function editReview($id)
    {
        $review = $this->user->reviews()->find($id);
        if ($review) {
            $this->editingReviewId = $id;
            $this->editComment = $review->comment;
            $this->showEditModal = true;
        }
    }

    public function updateReview()
    {
        $this->validate([
            'editComment' => 'required|min:3|max:1000',
        ]);

        $review = $this->user->reviews()->find($this->editingReviewId);
        if ($review) {
            $review->update([
                'comment' => $this->editComment,
            ]);
            $this->closeEditModal();
            $this->dispatch('success-message', 'Review updated successfully.');
        }
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->editingReviewId = null;
        $this->editComment = '';
        $this->resetValidation();
    }

    public function render()
    {
        $reiviews = $this->user->reviews()->with('product.images')->latest()->paginate(4);

        return view('livewire.website.dashboard.reiview', compact('reiviews'));
    }
}

