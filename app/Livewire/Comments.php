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
    
    // Accordion functionality
    public $showReplies = [];
    
    // Session storage for persistent state
    protected $sessionKey = 'comment_discussions_open';

    protected $listeners = [
        'refreshComments' => '$refresh',
        'updateTurnstileToken' => 'updateTurnstileToken'
    ];

    public function mount($post)
    {
        $this->post = $post;
        $this->loadComments();
        
        // Restore discussion state from session
        $sessionKey = $this->sessionKey . '_' . $this->post->id;
        $this->showReplies = session($sessionKey, []);
    }

    public function loadComments()
    {
        // Load parent comments
        $this->comments = Comment::where('commentable_type', get_class($this->post))
            ->where('commentable_id', $this->post->id)
            ->where('status', CommentStatus::Approved)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();

        // For each parent comment, load all replies in flat structure and count them
        foreach ($this->comments as $comment) {
            // Use the new descendants() method
            $descendants = $comment->descendants();
            // Filter only approved comments
            $flatReplies = $descendants->filter(function ($reply) {
                return $reply->status === CommentStatus::Approved;
            })->sortBy('created_at'); // Sort chronologically
            
            $comment->flatReplies = $flatReplies;
            $comment->all_children_count = $flatReplies->count();
        }
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
        // Add debugging for main comment Turnstile validation
        if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile') {
            \Log::info('Main Comment Turnstile Validation Debug', [
                'turnstile_value' => $this->turnstile,
                'turnstile_empty' => empty($this->turnstile),
                'turnstile_length' => strlen($this->turnstile ?? ''),
            ]);
        }

        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Add specific debugging for Turnstile validation
            if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile') {
                \Log::info('Main Comment Turnstile Validation Failed', [
                    'turnstile_value' => $this->turnstile,
                    'validation_errors' => $e->errors(),
                ]);
            }
            throw $e;
        }

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
        // If switching to a different reply form, reset Turnstile
        if ($this->showReplyForm && $this->replyTo !== $commentId) {
            $this->reset(['replyTurnstile']);
            if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile') {
                $this->dispatch('reset-turnstile');
            }
        }
        
        $this->replyTo = $commentId;
        $this->showReplyForm = true;
        $this->reset(['replyName', 'replyEmail', 'replyContent', 'replyTurnstile', 'replyFormMessage', 'replyFormError']);
        
        // Find the parent comment and ensure its discussion stays open
        $comment = Comment::find($commentId);
        if ($comment) {
            // If this is a reply to a reply, find the root parent
            $rootParentId = $comment->parent_id ?? $commentId;
            while ($comment && $comment->parent_id) {
                $parentComment = Comment::find($comment->parent_id);
                if ($parentComment && $parentComment->parent_id === null) {
                    $rootParentId = $parentComment->id;
                    break;
                } elseif ($parentComment) {
                    $comment = $parentComment;
                } else {
                    break;
                }
            }
            
            // Keep the discussion open for the root parent
            $this->showReplies[$rootParentId] = true;
            
            // Save to session immediately
            $this->saveDiscussionState();
        }
        
        // Reload comments to ensure fresh data
        $this->loadComments();
    }

    public function hideReply()
    {
        // Find the parent comment before hiding to keep discussion open
        $rootParentId = null;
        if ($this->replyTo) {
            $comment = Comment::find($this->replyTo);
            if ($comment) {
                // Find the root parent
                $rootParentId = $comment->parent_id ?? $this->replyTo;
                while ($comment && $comment->parent_id) {
                    $parentComment = Comment::find($comment->parent_id);
                    if ($parentComment && $parentComment->parent_id === null) {
                        $rootParentId = $parentComment->id;
                        break;
                    } elseif ($parentComment) {
                        $comment = $parentComment;
                    } else {
                        break;
                    }
                }
            }
        }
        
        $this->showReplyForm = false;
        $this->replyTo = null;
        $this->reset(['replyName', 'replyEmail', 'replyContent', 'replyTurnstile', 'replyFormMessage', 'replyFormError']);
        
        // Keep the discussion open if we found a root parent
        if ($rootParentId) {
            $this->showReplies[$rootParentId] = true;
            $this->saveDiscussionState();
        }
        
        // Reload comments to ensure fresh data
        $this->loadComments();
    }

    public function toggleReplies($commentId)
    {
        if (isset($this->showReplies[$commentId]) && $this->showReplies[$commentId]) {
            $this->showReplies[$commentId] = false;
        } else {
            $this->showReplies[$commentId] = true;
        }
        
        // Save to session for persistence
        $this->saveDiscussionState();
        
        // Always reload comments to ensure fresh data and proper flatReplies
        $this->loadComments();
    }

    public function submitReply()
    {
        try {
            $this->validate($this->replyRules());
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Add specific debugging for Turnstile validation
            if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile') {
                \Log::info('Reply Turnstile Validation Debug', [
                    'replyTurnstile_value' => $this->replyTurnstile,
                    'replyTurnstile_empty' => empty($this->replyTurnstile),
                    'validation_errors' => $e->errors(),
                ]);
            }
            throw $e;
        }

        $targetComment = Comment::find($this->replyTo);
        
        if (!$targetComment) {
            $this->replyFormError = 'Komentar yang ingin Anda balas tidak ditemukan.';
            return;
        }

        // Find the root parent for Twitter-style flat replies
        $rootParent = $targetComment->parent_id ? Comment::find($targetComment->parent_id) : $targetComment;
        while ($rootParent && $rootParent->parent_id) {
            $rootParent = Comment::find($rootParent->parent_id);
        }

        Comment::create([
            'commentable_type' => get_class($this->post),
            'commentable_id' => $this->post->id,
            'name' => $this->replyName,
            'email' => $this->replyEmail,
            'content' => $this->replyContent,
            'status' => CommentStatus::Pending,
            'parent_id' => $this->replyTo, // Keep the direct parent for @mentions
        ]);

        // Find root parent to keep discussion open
        $rootParentId = $targetComment->parent_id ?? $targetComment->id;
        while ($targetComment && $targetComment->parent_id) {
            $parentComment = Comment::find($targetComment->parent_id);
            if ($parentComment && $parentComment->parent_id === null) {
                $rootParentId = $parentComment->id;
                break;
            } elseif ($parentComment) {
                $targetComment = $parentComment;
            } else {
                break;
            }
        }

        $this->replyFormMessage = 'Balasan Anda telah berhasil dikirim dan sedang menunggu persetujuan.';
        $this->reset(['replyName', 'replyEmail', 'replyContent', 'replyTurnstile']);
        $this->showReplyForm = false;
        
        // Keep the discussion open
        $this->showReplies[$rootParentId] = true;
        $this->saveDiscussionState();
        
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
            // When Turnstile is updated, ensure the discussion stays open
            if ($this->replyTo && $propertyName === 'replyTurnstile') {
                $this->maintainDiscussionState();
            }
            return;
        }

        // Real-time validation for other fields
        if (str_starts_with($propertyName, 'reply')) {
            $this->validateOnly($propertyName, $this->replyRules());
        } else {
            $this->validateOnly($propertyName);
        }
    }

    private function maintainDiscussionState()
    {
        if ($this->replyTo) {
            $comment = Comment::find($this->replyTo);
            if ($comment) {
                // Find the root parent
                $rootParentId = $comment->parent_id ?? $this->replyTo;
                while ($comment && $comment->parent_id) {
                    $parentComment = Comment::find($comment->parent_id);
                    if ($parentComment && $parentComment->parent_id === null) {
                        $rootParentId = $parentComment->id;
                        break;
                    } elseif ($parentComment) {
                        $comment = $parentComment;
                    } else {
                        break;
                    }
                }
                
                // Keep the discussion open
                $this->showReplies[$rootParentId] = true;
                
                // Save to session
                $this->saveDiscussionState();
                
                \Log::info('Discussion state maintained', [
                    'rootParentId' => $rootParentId,
                    'replyTo' => $this->replyTo,
                    'showReplies' => $this->showReplies
                ]);
            }
        }
    }

    public function updateTurnstileToken($propertyName, $token)
    {
        \Log::info('updateTurnstileToken called', [
            'propertyName' => $propertyName,
            'token_length' => strlen($token),
            'token_preview' => substr($token, 0, 20) . '...'
        ]);
        
        // Skip re-render to prevent state loss
        $this->skipRender();
        
        if (in_array($propertyName, ['turnstile', 'replyTurnstile'])) {
            $this->$propertyName = $token;
            \Log::info('Token successfully set via updateTurnstileToken', [
                'property' => $propertyName,
                'value_set' => !empty($this->$propertyName)
            ]);
            
            // Maintain discussion state when token is set via callback
            if ($propertyName === 'replyTurnstile') {
                $this->maintainDiscussionState();
            }
        } else {
            \Log::warning('Invalid property name for Turnstile token', ['propertyName' => $propertyName]);
        }
    }

    public function hydrate()
    {
        // This runs after every Livewire request to maintain state
        
        // Always restore discussion state from session first
        $sessionKey = $this->sessionKey . '_' . $this->post->id;
        $sessionState = session($sessionKey, []);
        if (!empty($sessionState)) {
            $this->showReplies = $sessionState;
            \Log::info('Restored discussion state from session', [
                'showReplies' => $this->showReplies,
                'replyTo' => $this->replyTo,
                'showReplyForm' => $this->showReplyForm
            ]);
        }
        
        // Also maintain state if reply form is open
        if ($this->replyTo && $this->showReplyForm) {
            $this->maintainDiscussionState();
        }
    }

    private function saveDiscussionState()
    {
        $sessionKey = $this->sessionKey . '_' . $this->post->id;
        session([$sessionKey => $this->showReplies]);
    }

    public function render()
    {
        return view('livewire.comments');
    }
}