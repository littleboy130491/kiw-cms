<?php

namespace App\Livewire;

use Livewire\Component;
use Littleboy130491\Sumimasen\Models\Comment;
use Littleboy130491\Sumimasen\Enums\CommentStatus;
use Illuminate\Validation\Rule;

class Comments extends Component
{
    public $post;
    public $comments;
    
    // Form fields for new comment
    public $name = '';
    public $email = '';
    public $content = '';
    public $turnstile = '';
    
    // Reply form fields
    public $replyTo = null;
    public $replyName = '';
    public $replyEmail = '';
    public $replyContent = '';
    public $replyTurnstile = '';
    public $showReplyForm = false;
    public $replyFormMessage = '';
    public $replyFormError = '';

    protected $listeners = ['refreshComments' => '$refresh'];

    public function mount($post)
    {
        $this->post = $post;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = Comment::where('commentable_type', get_class($this->post))
            ->where('commentable_id', $this->post->id)
            ->where('status', CommentStatus::Approved)
            ->whereNull('parent_id')
            ->with(['children' => function ($query) {
                $query->where('status', CommentStatus::Approved)
                      ->with(['children' => function ($subQuery) {
                          $subQuery->where('status', CommentStatus::Approved);
                      }]);
            }])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|max:1000',
        ];

        // Add Turnstile validation rule if enabled
        if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile') {
            $rules['turnstile'] = 'required|turnstile';
        }

        return $rules;
    }

    public function replyRules()
    {
        $rules = [
            'replyName' => 'required|string|max:255',
            'replyEmail' => 'required|email|max:255',
            'replyContent' => 'required|string|max:1000',
        ];

        // Add Turnstile validation rule if enabled
        if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile') {
            $rules['replyTurnstile'] = 'required|turnstile';
        }

        return $rules;
    }

    public function submitComment()
    {
        $this->validate();

        Comment::create([
            'commentable_type' => get_class($this->post),
            'commentable_id' => $this->post->id,
            'name' => $this->name,
            'email' => $this->email,
            'content' => $this->content,
            'status' => CommentStatus::Pending,
            'parent_id' => null,
        ]);

        $this->reset(['name', 'email', 'content', 'turnstile']);
        
        session()->flash('message', 'Komentar Anda telah berhasil dikirim dan sedang menunggu persetujuan.');
        
        // Reset Turnstile widget if enabled
        if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile') {
            $this->dispatch('reset-turnstile');
        }
        
        $this->loadComments();
    }

    public function showReply($commentId)
    {
        $this->replyTo = $commentId;
        $this->showReplyForm = true;
        $this->reset(['replyName', 'replyEmail', 'replyContent', 'replyTurnstile', 'replyFormMessage', 'replyFormError']);
    }

    public function hideReply()
    {
        $this->showReplyForm = false;
        $this->replyTo = null;
        $this->reset(['replyName', 'replyEmail', 'replyContent', 'replyTurnstile', 'replyFormMessage', 'replyFormError']);
    }

    public function submitReply()
    {
        $this->validate($this->replyRules());

        $parentComment = Comment::find($this->replyTo);
        
        if (!$parentComment) {
            $this->replyFormError = 'Komentar yang ingin Anda balas tidak ditemukan.';
            return;
        }

        Comment::create([
            'commentable_type' => get_class($this->post),
            'commentable_id' => $this->post->id,
            'name' => $this->replyName,
            'email' => $this->replyEmail,
            'content' => $this->replyContent,
            'status' => CommentStatus::Pending,
            'parent_id' => $this->replyTo,
        ]);

        $this->replyFormMessage = 'Balasan Anda telah berhasil dikirim dan sedang menunggu persetujuan.';
        $this->reset(['replyName', 'replyEmail', 'replyContent', 'replyTurnstile']);
        $this->showReplyForm = false;
        
        // Reset Turnstile widget if enabled
        if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile') {
            $this->dispatch('reset-turnstile');
        }
        
        $this->loadComments();
    }

    public function isBotProtectionEnabled()
    {
        $type = $this->getBotProtectionType();
        return $type === 'turnstile' && $this->isTurnstileEnabled();
    }

    public function getBotProtectionType()
    {
        return config('cms.bot_protection_type', 'turnstile');
    }

    public function isTurnstileEnabled()
    {
        return !empty(env('TURNSTILE_SITE_KEY')) && !empty(env('TURNSTILE_SECRET_KEY'));
    }

    public function updated($propertyName)
    {
        // Skip validation for bot protection fields during typing
        if (in_array($propertyName, ['turnstile', 'replyTurnstile'])) {
            return;
        }

        // Real-time validation for other fields
        if (str_starts_with($propertyName, 'reply')) {
            $this->validateOnly($propertyName, $this->replyRules());
        } else {
            $this->validateOnly($propertyName);
        }
    }

    public function render()
    {
        return view('livewire.comments');
    }
}