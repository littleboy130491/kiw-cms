@php
    // Reusable SVG spinner for buttons
    $spinner =
        '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';

    // Reusable SVG spinner for text links
    $textSpinner =
        '<svg class="animate-spin h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
@endphp

@pushOnce('before_head_close')
    @if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile')
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit" async defer></script>
    @endif
@endPushOnce

<!-- Start Comment Section -->
<section id="post-form-comment" class="bg-[var(--color-transit)]">

    <!--Start Form-->
    <div class="py-18 lg:py-30 px-4 sm:px-6 lg:px-0 flex flex-col gap-7 lg:w-[1200px] lg:mx-auto">
        <!--title-->
        <div class="flex flex-col gap-5">
            <h3 class="text-center">Tinggalkan Komentar</h3>
            <p class="text-center">Alamat email Anda tidak akan dipublikasikan.</p>
        </div>

        <!--form-->
        @if (!session()->has('message'))
            <form wire:submit="submitComment" class="flex flex-col sm:flex-row sm:flex-wrap sm:justify-center gap-5">
                <div class="sm:w-[48.5%] lg:w-[49%]">
                    <label for="name" class="hidden">Nama</label>
                    <input type="text" id="name" wire:model="name" placeholder="Masukkan nama Anda" required
                        class="mt-1 w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="sm:w-[48.5%] lg:w-[49%]">
                    <label for="email" class="hidden">Email</label>
                    <input type="email" id="email" wire:model="email" placeholder="Alamat email contoh@email.com"
                        required
                        class="mt-1 w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="sm:w-full">
                    <label for="content" class="hidden">Komentar</label>
                    <textarea id="content" wire:model="content" rows="8" placeholder="Tulis komentar Anda di sini..." required
                        class="w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror">
                                                                                                            </textarea>
                    @error('content')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                @if ($this->isBotProtectionEnabled())
                    <div class="w-full flex justify-center mt-4">
                        @if ($this->getBotProtectionType() === 'turnstile')
                            <x-turnstile id="mainCommentTurnstile" wire:model="turnstile" />
                        @endif
                    </div>
                    @error('turnstile')
                        <span class="text-red-500 text-sm mt-2 w-full text-center">{{ $message }}</span>
                    @enderror
                @endif

                <!--Button-->
                <button type="submit"
                    class="w-fit btn1 mt-5 flex items-center gap-2 text-white self-center cursor-pointer rounded-md"
                    wire:loading.attr="disabled" wire:loading.class="cursor-wait" wire:target="submitComment">
                    <span wire:loading wire:target="submitComment">
                        {!! $spinner !!}
                    </span>
                    Kirim Komentar
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </form>
        @endif

        <!-- Success/Error Messages -->
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <!--End Form-->

    <!--Start Comment Area-->
    @if ($comments->count() > 0)
        <div class="comment-area py-18 lg:py-30 px-4 sm:px-6 lg:px-0 flex flex-col gap-7 lg:w-[1200px] lg:mx-auto">
            <h3 class="comment-area-title">Diskusi</h3>
            <ol class="pb-18 lg:pb-30 px-4 sm:px-6 lg:px-0 flex flex-col gap-9 lg:w-[1200px] lg:mx-auto">
                @foreach ($comments as $comment)
                    <li id="comment-{{ $comment->id }}" class="border-b border-gray-300">
                        <!-- Main Comment -->
                        <div class="mb-5">
                            <div class="comment-name flex flex-col gap-1">
                                <h5 class="name">{{ $comment->name }}</h5>
                            </div>
                            <div class="comment-content my-3">
                                <p>{{ $comment->content }}</p>
                            </div>
                            <div class="flex flex-row justify-between items-center mt-5">
                                <div class="flex gap-2">
                                    <button wire:click="showReply({{ $comment->id }})" wire:loading.attr="disabled"
                                        wire:loading.class="cursor-wait" wire:target="showReply({{ $comment->id }})"
                                        class="reply-button cursor-pointer flex items-center gradient-blue text-white w-fit px-2 py-1 text-[.85em] rounded-md">
                                        <span wire:loading wire:target="showReply({{ $comment->id }})"
                                            class="-ml-1 mr-2">
                                            {!! $spinner !!}
                                        </span>
                                        Balas
                                    </button>
                                    @if ($comment->all_children_count > 0)
                                        <button wire:click="toggleReplies({{ $comment->id }})"
                                            wire:loading.attr="disabled" wire:loading.class="cursor-wait"
                                            wire:target="toggleReplies({{ $comment->id }})"
                                            class="cursor-pointer flex items-center text-gray-500 hover:text-gray-700 text-[.85em]">
                                            <span wire:loading wire:target="toggleReplies({{ $comment->id }})"
                                                class="mr-2">
                                                {!! $textSpinner !!}
                                            </span>
                                            @if (isset($showReplies[$comment->id]) && $showReplies[$comment->id])
                                                Sembunyikan
                                            @else
                                                Lihat Diskusi ({{ $comment->all_children_count }})
                                            @endif
                                        </button>
                                    @endif
                                </div>
                                <time datetime="{{ $comment->created_at->setTimezone('Asia/Jakarta')->format('c') }}"
                                    class="text-[var(--color-text)] text-[.9em]">
                                    {{ $comment->created_at->setTimezone('Asia/Jakarta')->format('M d, Y \\a\\t g:i a') }}
                                </time>
                            </div>
                        </div>

                        <!-- Reply Form -->
                        @if ($showReplyForm && $replyTo == $comment->id)
                            <form wire:submit="submitReply"
                                class="reply-form flex flex-col sm:flex-row justify-between gap-2 flex-wrap mt-4 bg-white p-4 border border-[var(--color-border)] rounded">
                                <div class="sm:w-full">
                                    <label for="reply-content-{{ $comment->id }}" class="hidden">Balasan</label>
                                    <textarea wire:model="replyContent"
                                        class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyContent') border-red-500 @enderror"
                                        placeholder="Tulis balasan Anda" id="reply-content-{{ $comment->id }}" rows="4" required></textarea>
                                    @error('replyContent')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="sm:w-[49%] lg:w-[49%]">
                                    <label for="reply-name-{{ $comment->id }}" class="hidden">Nama</label>
                                    <input type="text" wire:model="replyName" placeholder="Masukkan nama Anda"
                                        required id="reply-name-{{ $comment->id }}"
                                        class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyName') border-red-500 @enderror">
                                    @error('replyName')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="sm:w-[49%] lg:w-[49%]">
                                    <label for="reply-email-{{ $comment->id }}" class="hidden">Email</label>
                                    <input type="email" wire:model="replyEmail"
                                        placeholder="Alamat email contoh@email.com" required
                                        id="reply-email-{{ $comment->id }}"
                                        class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyEmail') border-red-500 @enderror">
                                    @error('replyEmail')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if ($this->isBotProtectionEnabled())
                                    <div class="w-full flex justify-center mt-4">
                                        @if ($this->getBotProtectionType() === 'turnstile')
                                            <x-turnstile id="replyTurnstile{{ $comment->id }}"
                                                wire:model="replyTurnstile" />
                                        @endif
                                    </div>
                                    @error('replyTurnstile')
                                        <span
                                            class="text-red-500 text-sm mt-2 w-full text-center">{{ $message }}</span>
                                    @enderror
                                @endif

                                <div class="flex gap-2 mt-2">
                                    <button type="submit"
                                        class="px-2 py-1 text-[.85em] gradient-blue w-fit text-white rounded-md cursor-pointer flex items-center"
                                        wire:loading.attr="disabled" wire:loading.class="cursor-wait"
                                        wire:target="submitReply">
                                        <span wire:loading wire:target="submitReply">
                                            {!! $spinner !!}
                                        </span>
                                        Kirim
                                    </button>
                                    <button type="button" wire:click="hideReply" wire:loading.attr="disabled"
                                        wire:loading.class="cursor-wait" wire:target="hideReply"
                                        class="text-[.85em] text-red-500 hover:text-red-700 cursor-pointer flex items-center">
                                        <span wire:loading wire:target="hideReply" class="mr-2">
                                            {!! $textSpinner !!}
                                        </span>
                                        Batal
                                    </button>
                                </div>
                            </form>
                        @endif

                        <!-- Reply Form Messages -->
                        @if ($replyFormMessage && $replyTo == $comment->id)
                            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
                                role="alert">
                                {{ $replyFormMessage }}
                            </div>
                        @endif

                        @if ($replyFormError && $replyTo == $comment->id)
                            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"
                                role="alert">
                                {{ $replyFormError }}
                            </div>
                        @endif

                        <!-- Comment reply section -->
                        @if ($comment->all_children_count > 0 && isset($showReplies[$comment->id]) && $showReplies[$comment->id])
                            <div class="comment-reply-section ml-2 sm:ml-8 mt-4 space-y-4">

                                @if ($comment->flatReplies)
                                    @foreach ($comment->flatReplies as $reply)
                                        <div class="p-4 border-b border-[var(--color-border)] last:border-b-0">
                                            <div class="flex flex-col gap-1">
                                                @if ($reply->parent)
                                                    <p class="italic text-[.8em] text-gray-600">
                                                        Membalas <span
                                                            class="font-medium">{{ $reply->parent->name }}</span>:
                                                        "{{ Str::limit($reply->parent->content, 50) }}"
                                                    </p>
                                                @endif
                                                <h5 class="name font-medium">{{ $reply->name }}</h5>
                                            </div>
                                            <div class="my-3">
                                                <p>{{ $reply->content }}</p>
                                            </div>
                                            <div class="flex flex-row justify-between items-center mt-3">
                                                <button wire:click="showReply({{ $reply->id }})"
                                                    wire:loading.attr="disabled" wire:loading.class="cursor-wait"
                                                    wire:target="showReply({{ $reply->id }})"
                                                    class="reply-button cursor-pointer flex items-center gradient-blue text-white w-fit px-2 py-1 text-[.75em] rounded-md">
                                                    <span wire:loading wire:target="showReply({{ $reply->id }})"
                                                        class="-ml-1 mr-2">
                                                        {!! $spinner !!}
                                                    </span>
                                                    Balas
                                                </button>
                                                <time
                                                    datetime="{{ $reply->created_at->setTimezone('Asia/Jakarta')->format('c') }}"
                                                    class="text-[var(--color-text)] text-[.8em]">
                                                    {{ $reply->created_at->setTimezone('Asia/Jakarta')->format('M d, Y \\a\\t g:i a') }}
                                                </time>
                                            </div>

                                            <!-- Reply Form -->
                                            @if ($showReplyForm && $replyTo == $reply->id)
                                                <form wire:submit="submitReply"
                                                    class="reply-form flex flex-col gap-3 mt-4 bg-white p-3 border border-[var(--color-border)] rounded">
                                                    <div>
                                                        <label for="flat-reply-content-{{ $reply->id }}"
                                                            class="hidden">Balasan</label>
                                                        <textarea wire:model="replyContent"
                                                            class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyContent') border-red-500 @enderror"
                                                            placeholder="Tulis balasan Anda" id="flat-reply-content-{{ $reply->id }}" rows="3" required></textarea>
                                                        @error('replyContent')
                                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="flex gap-2">
                                                        <div class="w-1/2">
                                                            <input type="text" wire:model="replyName"
                                                                placeholder="Nama" required
                                                                class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyName') border-red-500 @enderror">
                                                            @error('replyName')
                                                                <span
                                                                    class="text-red-500 text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="w-1/2">
                                                            <input type="email" wire:model="replyEmail"
                                                                placeholder="Email" required
                                                                class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyEmail') border-red-500 @enderror">
                                                            @error('replyEmail')
                                                                <span
                                                                    class="text-red-500 text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    @if ($this->isBotProtectionEnabled())
                                                        <div class="flex justify-center">
                                                            @if ($this->getBotProtectionType() === 'turnstile')
                                                                <x-turnstile
                                                                    id="flatReplyTurnstile{{ $reply->id }}"
                                                                    wire:model="replyTurnstile" />
                                                            @endif
                                                        </div>
                                                        @error('replyTurnstile')
                                                            <span
                                                                class="text-red-500 text-sm text-center">{{ $message }}</span>
                                                        @enderror
                                                    @endif

                                                    <div class="flex gap-2">
                                                        <button type="submit"
                                                            class="px-2 py-1 text-[.75em] gradient-blue text-white rounded-md cursor-pointer flex items-center"
                                                            wire:loading.attr="disabled"
                                                            wire:loading.class="cursor-wait"
                                                            wire:target="submitReply">
                                                            <span wire:loading wire:target="submitReply">
                                                                {!! $spinner !!}
                                                            </span>
                                                            Kirim
                                                        </button>
                                                        <button type="button" wire:click="hideReply"
                                                            wire:loading.attr="disabled"
                                                            wire:loading.class="cursor-wait" wire:target="hideReply"
                                                            class="text-[.75em] text-red-500 hover:text-red-700 cursor-pointer flex items-center">
                                                            <span wire:loading wire:target="hideReply" class="mr-2">
                                                                {!! $textSpinner !!}
                                                            </span>
                                                            Batal
                                                        </button>
                                                    </div>
                                                </form>
                                            @endif

                                            <!-- Reply Form Messages -->
                                            @if ($replyFormMessage && $replyTo == $reply->id)
                                                <div
                                                    class="mt-3 bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded text-sm">
                                                    {{ $replyFormMessage }}
                                                </div>
                                            @endif

                                            @if ($replyFormError && $replyTo == $reply->id)
                                                <div
                                                    class="mt-3 bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded text-sm">
                                                    {{ $replyFormError }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    @endif
    <!--End Comment Area-->

</section>
<!-- End Comment Section -->

@if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile')
    <script>
        document.addEventListener('livewire:init', function() {
            // Function to render Turnstiles with error handling
            function renderTurnstiles(root = document) {
                if (typeof turnstile === 'undefined') {
                    console.log('Turnstile not available yet');
                    return;
                }

                root.querySelectorAll('.cf-turnstile:not([data-rendered])').forEach((container) => {
                    try {
                        let params = {
                            sitekey: container.dataset.sitekey,
                        };

                        // Create a generic callback that finds the right Livewire property
                        params.callback = function(token) {
                            console.log('Turnstile callback triggered');
                            console.log('Container ID:', container.id);
                            console.log('Token (first 20 chars):', token.substring(0, 20) + '...');

                            // Find the Livewire component - try multiple approaches
                            let livewireComponent = container.closest('[wire\\:id]');

                            if (!livewireComponent) {
                                // Try finding parent document if in iframe/different context
                                livewireComponent = document.querySelector('[wire\\:id]');
                            }

                            if (livewireComponent) {
                                const livewireId = livewireComponent.getAttribute('wire:id');
                                console.log('Found Livewire component ID:', livewireId);

                                const component = Livewire.find(livewireId);

                                if (component) {
                                    // Determine which property to set based on the container's context
                                    let propertyName = 'turnstile'; // default for main form

                                    // Check if this is in a reply form
                                    if (container.closest('.reply-form') || container.id.includes(
                                            'reply')) {
                                        propertyName = 'replyTurnstile';
                                    }

                                    console.log('Setting property:', propertyName, 'with token');

                                    // Use the listener method to avoid re-rendering
                                    component.call('updateTurnstileToken', propertyName, token);
                                    console.log('✓ Token set via updateTurnstileToken listener');

                                } else {
                                    console.error('✗ Livewire component not found with ID:',
                                        livewireId);
                                }
                            } else {
                                console.error('✗ Livewire component container not found');
                                console.log('Available elements with wire:id:', document
                                    .querySelectorAll('[wire\\:id]'));
                            }
                        };

                        console.log('Rendering Turnstile for container:', container.id);
                        let widgetId = turnstile.render(container, params);

                        if (widgetId !== undefined) {
                            container.dataset.rendered = 'true';
                            container.dataset.widgetId = widgetId;
                            console.log('✓ Turnstile rendered successfully, widget ID:', widgetId);
                        } else {
                            console.error('✗ Turnstile render returned undefined');
                        }
                    } catch (error) {
                        console.error('✗ Error rendering Turnstile:', error);
                    }
                });
            }

            // Wait for Turnstile to be available
            function waitForTurnstile() {
                if (typeof turnstile !== 'undefined') {
                    console.log('✓ Turnstile is available, rendering widgets');
                    renderTurnstiles();
                } else {
                    console.log('⏳ Waiting for Turnstile...');
                    setTimeout(waitForTurnstile, 100);
                }
            }

            // Start waiting for Turnstile
            waitForTurnstile();

            // Hook for dynamically added widgets  
            Livewire.hook('morph.added', ({
                el
            }) => {
                console.log('DOM morphed, checking for new Turnstile widgets');
                setTimeout(() => {
                    renderTurnstiles(el);
                }, 100);
            });

            // Hook to preserve state before morph
            Livewire.hook('morph.updating', ({
                el,
                component
            }) => {
                // Store current discussion state before update
                const discussionStates = {};
                el.querySelectorAll('[data-discussion-id]').forEach(discussion => {
                    const id = discussion.dataset.discussionId;
                    const isOpen = discussion.classList.contains('open') ||
                        discussion.style.display !== 'none';
                    discussionStates[id] = isOpen;
                });
                window.tempDiscussionStates = discussionStates;
            });

            // Hook to restore state after morph
            Livewire.hook('morph.updated', ({
                el
            }) => {
                if (window.tempDiscussionStates) {
                    Object.entries(window.tempDiscussionStates).forEach(([id, isOpen]) => {
                        const discussion = el.querySelector(`[data-discussion-id="${id}"]`);
                        if (discussion && isOpen) {
                            discussion.classList.add('open');
                            discussion.style.display = 'block';
                        }
                    });
                    delete window.tempDiscussionStates;
                }
            });

            // Reset Turnstile when needed
            Livewire.on('reset-turnstile', () => {
                console.log('Resetting Turnstile widgets');
                if (typeof turnstile !== 'undefined') {
                    document.querySelectorAll('.cf-turnstile[data-rendered]').forEach((container) => {
                        if (container.dataset.widgetId) {
                            try {
                                turnstile.reset(container.dataset.widgetId);
                                console.log('✓ Reset widget:', container.dataset.widgetId);
                            } catch (error) {
                                console.error('✗ Error resetting Turnstile:', error);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endif
