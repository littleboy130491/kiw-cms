@pushOnce('before_head_close')
    @if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile')
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit" async defer></script>
    @endif
@endPushOnce

<!-- Start Comment Section -->
<section id="post-form-comment" class="bg-[--color-transit]">

    <!--Start Form-->
    <div class="py-18 lg:py-30 px-4 sm:px-6 lg:px-0 flex flex-col gap-7 lg:w-[1200px] lg:mx-auto">
        <!--title-->
        <div class="flex flex-col gap-5">
            <h2 class="text-center">Tinggalkan Komentar</h2>
            <p class="text-center">Alamat email Anda tidak akan dipublikasikan.</p>
        </div>

        <!--form-->
        @if (!session()->has('message'))
            <form wire:submit="submitComment" class="flex flex-col sm:flex-row sm:flex-wrap sm:justify-center gap-5">
                <div class="sm:w-[48.5%] lg:w-[49%]">
                    <label for="name" class="hidden">Nama</label>
                    <input type="text" id="name" wire:model="name" placeholder="Masukkan nama Anda" required
                        class="mt-1 w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="sm:w-[48.5%] lg:w-[49%]">
                    <label for="email" class="hidden">Email</label>
                    <input type="email" id="email" wire:model="email" placeholder="Alamat email contoh@email.com" required
                        class="mt-1 w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="sm:w-full">
                    <label for="content" class="hidden">Komentar</label>
                    <textarea id="content" wire:model="content" rows="8" placeholder="Tulis komentar Anda di sini..."
                        required
                        class="w-full px-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror">
                                                                                                            </textarea>
                    @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                <button type="submit" class="w-fit btn1 mt-5 flex items-center gap-2 text-white self-center"
                    wire:loading.attr="disabled" wire:target="submitComment">
                    <span wire:loading.remove wire:target="submitComment">Kirim Komentar</span>
                    <span wire:loading wire:target="submitComment">Mengirim...</span>
                    <span wire:loading.remove wire:target="submitComment">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
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
    @if($comments->count() > 0)
        <ol class="pb-18 lg:pb-30 px-4 sm:px-6 lg:px-0 flex flex-col gap-9 lg:w-[1200px] lg:mx-auto">
            @foreach($comments as $comment)
                <li id="comment-{{ $comment->id }}">
                    <!-- Main Comment -->
                    <article class="mb-5">
                        <header class="flex flex-col gap-1">
                            <h5 class="name">{{ $comment->name }}</h5>
                        </header>
                        <section class="my-3">
                            <p>{{ $comment->content }}</p>
                        </section>
                        <div class="flex flex-row justify-between items-center mt-5">
                            <div class="flex gap-2">
                                <div class="gradient-blue text-white w-fit px-2 py-1 text-[.85em]">
                                    <button wire:click="showReply({{ $comment->id }})"
                                        class="reply-button cursor-pointer">Balas</button>
                                </div>
                                @if($comment->all_children_count > 0)
                                    <div class="bg-gray-600 text-white w-fit px-2 py-1 text-[.85em]">
                                        <button wire:click="toggleReplies({{ $comment->id }})"
                                            class="cursor-pointer">
                                            @if(isset($showReplies[$comment->id]) && $showReplies[$comment->id])
                                                Sembunyikan Diskusi ({{ $comment->all_children_count }})
                                            @else
                                                Lihat Diskusi ({{ $comment->all_children_count }})
                                            @endif
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <time datetime="{{ $comment->created_at->setTimezone('Asia/Jakarta')->format('c') }}"
                                class="text-[var(--color-text)] text-[.9em]">
                                {{ $comment->created_at->setTimezone('Asia/Jakarta')->format('M d, Y \\a\\t g:i a') }}
                            </time>
                        </div>
                    </article>

                    <!-- Reply Form -->
                    @if($showReplyForm && $replyTo == $comment->id)
                        <form wire:submit="submitReply"
                            class="reply-form flex flex-col sm:flex-row justify-between gap-2 flex-wrap mt-4 bg-white p-4 border border-[var(--color-border)] rounded">
                            <div class="sm:w-full">
                                <label for="reply-content-{{ $comment->id }}" class="hidden">Balasan</label>
                                <textarea wire:model="replyContent"
                                    class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyContent') border-red-500 @enderror"
                                    placeholder="Tulis balasan Anda" id="reply-content-{{ $comment->id }}" rows="4"
                                    required></textarea>
                                @error('replyContent') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="sm:w-[49%] lg:w-[49%]">
                                <label for="reply-name-{{ $comment->id }}" class="hidden">Nama</label>
                                <input type="text" wire:model="replyName" placeholder="Masukkan nama Anda" required
                                    id="reply-name-{{ $comment->id }}"
                                    class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyName') border-red-500 @enderror">
                                @error('replyName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="sm:w-[49%] lg:w-[49%]">
                                <label for="reply-email-{{ $comment->id }}" class="hidden">Email</label>
                                <input type="email" wire:model="replyEmail" placeholder="Alamat email contoh@email.com" required
                                    id="reply-email-{{ $comment->id }}"
                                    class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyEmail') border-red-500 @enderror">
                                @error('replyEmail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            @if ($this->isBotProtectionEnabled())
                                <div class="w-full flex justify-center mt-4">
                                    @if ($this->getBotProtectionType() === 'turnstile')
                                        <x-turnstile id="replyTurnstile{{ $comment->id }}" wire:model="replyTurnstile" />
                                    @endif
                                </div>
                                @error('replyTurnstile')
                                    <span class="text-red-500 text-sm mt-2 w-full text-center">{{ $message }}</span>
                                @enderror
                            @endif

                            <div class="flex gap-2 mt-2">
                                <button type="submit"
                                    class="px-3 py-1 bg-[var(--color-black)] w-fit text-white rounded cursor-pointer"
                                    wire:loading.attr="disabled" wire:target="submitReply">
                                    <span wire:loading.remove wire:target="submitReply">Kirim</span>
                                    <span wire:loading wire:target="submitReply">Mengirim...</span>
                                </button>
                                <button type="button" wire:click="hideReply"
                                    class="px-3 py-1 bg-gray-500 w-fit text-white rounded cursor-pointer">
                                    Batal
                                </button>
                            </div>
                        </form>
                    @endif

                    <!-- Reply Form Messages -->
                    @if($replyFormMessage && $replyTo == $comment->id)
                        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
                            {{ $replyFormMessage }}
                        </div>
                    @endif

                    @if($replyFormError && $replyTo == $comment->id)
                        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                            {{ $replyFormError }}
                        </div>
                    @endif

                    <!-- Twitter-style Flat Discussion -->
                    @if($comment->all_children_count > 0 && isset($showReplies[$comment->id]) && $showReplies[$comment->id])
                        <div class="ml-8 mt-4 space-y-4">
                            
                            @if($comment->flatReplies)
                                @foreach($comment->flatReplies as $reply)
                                <article class="bg-gray-50 p-4 border border-[var(--color-border)] rounded">
                                    <header class="flex flex-col gap-1">
                                        @if($reply->parent)
                                            <p class="italic text-[.8em] text-gray-600">
                                                Membalas <span class="font-medium">{{ $reply->parent->name }}</span>: 
                                                "{{ Str::limit($reply->parent->content, 50) }}"
                                            </p>
                                        @endif
                                        <h5 class="name font-medium">{{ $reply->name }}</h5>
                                    </header>
                                    <section class="my-3">
                                        <p>{{ $reply->content }}</p>
                                    </section>
                                    <div class="flex flex-row justify-between items-center mt-3">
                                        <div class="gradient-blue text-white w-fit px-2 py-1 text-[.75em]">
                                            <button wire:click="showReply({{ $reply->id }})"
                                                class="reply-button cursor-pointer">Balas</button>
                                        </div>
                                        <time datetime="{{ $reply->created_at->setTimezone('Asia/Jakarta')->format('c') }}"
                                            class="text-[var(--color-text)] text-[.8em]">
                                            {{ $reply->created_at->setTimezone('Asia/Jakarta')->format('M d, Y \\a\\t g:i a') }}
                                        </time>
                                    </div>

                                    <!-- Reply Form -->
                                    @if($showReplyForm && $replyTo == $reply->id)
                                        <form wire:submit="submitReply"
                                            class="reply-form flex flex-col gap-3 mt-4 bg-white p-3 border border-[var(--color-border)] rounded">
                                            <div>
                                                <label for="flat-reply-content-{{ $reply->id }}" class="hidden">Balasan</label>
                                                <textarea wire:model="replyContent"
                                                    class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyContent') border-red-500 @enderror"
                                                    placeholder="Tulis balasan Anda" id="flat-reply-content-{{ $reply->id }}" rows="3"
                                                    required></textarea>
                                                @error('replyContent') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="flex gap-2">
                                                <div class="w-1/2">
                                                    <input type="text" wire:model="replyName" placeholder="Nama" required
                                                        class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyName') border-red-500 @enderror">
                                                    @error('replyName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="w-1/2">
                                                    <input type="email" wire:model="replyEmail" placeholder="Email" required
                                                        class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyEmail') border-red-500 @enderror">
                                                    @error('replyEmail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            @if ($this->isBotProtectionEnabled())
                                                <div class="flex justify-center">
                                                    @if ($this->getBotProtectionType() === 'turnstile')
                                                        <x-turnstile id="flatReplyTurnstile{{ $reply->id }}" wire:model="replyTurnstile" />
                                                    @endif
                                                </div>
                                                @error('replyTurnstile')
                                                    <span class="text-red-500 text-sm text-center">{{ $message }}</span>
                                                @enderror
                                            @endif

                                            <div class="flex gap-2">
                                                <button type="submit"
                                                    class="px-3 py-1 bg-[var(--color-black)] text-white rounded text-sm"
                                                    wire:loading.attr="disabled" wire:target="submitReply">
                                                    <span wire:loading.remove wire:target="submitReply">Kirim</span>
                                                    <span wire:loading wire:target="submitReply">Mengirim...</span>
                                                </button>
                                                <button type="button" wire:click="hideReply"
                                                    class="px-3 py-1 bg-gray-500 text-white rounded text-sm">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    @endif

                                    <!-- Reply Form Messages -->
                                    @if($replyFormMessage && $replyTo == $reply->id)
                                        <div class="mt-3 bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded text-sm">
                                            {{ $replyFormMessage }}
                                        </div>
                                    @endif

                                    @if($replyFormError && $replyTo == $reply->id)
                                        <div class="mt-3 bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded text-sm">
                                            {{ $replyFormError }}
                                        </div>
                                    @endif
                                </article>
                                @endforeach
                            @endif
                        </div>
                    @endif
                </li>
            @endforeach
        </ol>
    @endif
    <!--End Comment Area-->

</section>
<!-- End Comment Section -->

@if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile')
    <script>
        document.addEventListener('livewire:init', function () {
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
                            
                            // Store discussion state before any Livewire updates
                            const discussionStates = {};
                            document.querySelectorAll('[wire\\:click*="toggleReplies"]').forEach(btn => {
                                const match = btn.getAttribute('wire:click').match(/toggleReplies\((\d+)\)/);
                                if (match) {
                                    const commentId = match[1];
                                    const isVisible = btn.textContent.includes('Sembunyikan');
                                    if (isVisible) {
                                        discussionStates[commentId] = true;
                                        console.log('Stored discussion state for comment', commentId, ':', true);
                                    }
                                }
                            });
                            
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
                                    if (container.closest('.reply-form') || container.id.includes('reply')) {
                                        propertyName = 'replyTurnstile';
                                    }
                                    
                                    console.log('Setting property:', propertyName, 'with token');
                                    
                                    // Set discussion states in Livewire component
                                    try {
                                        component.set('showReplies', discussionStates);
                                        console.log('✓ Discussion states preserved');
                                    } catch (error) {
                                        console.error('Error preserving discussion states:', error);
                                    }
                                    
                                    // Try multiple methods to set the token
                                    try {
                                        component.set(propertyName, token);
                                        console.log('✓ Token set via component.set()');
                                        
                                        // Verify the token was set
                                        setTimeout(() => {
                                            const currentValue = component.get(propertyName);
                                            console.log('Current value of', propertyName + ':', currentValue ? 'SET ✓' : 'EMPTY ✗');
                                        }, 100);
                                        
                                    } catch (setError) {
                                        console.error('Error setting token via component.set():', setError);
                                        
                                        // Fallback: Try updating via Livewire directly
                                        try {
                                            Livewire.emit('updateTurnstileToken', propertyName, token);
                                            console.log('✓ Token set via Livewire.emit()');
                                        } catch (emitError) {
                                            console.error('Error setting token via emit:', emitError);
                                        }
                                    }
                                } else {
                                    console.error('✗ Livewire component not found with ID:', livewireId);
                                }
                            } else {
                                console.error('✗ Livewire component container not found');
                                console.log('Available elements with wire:id:', document.querySelectorAll('[wire\\:id]'));
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
            Livewire.hook('morph.added', ({ el }) => {
                console.log('DOM morphed, checking for new Turnstile widgets');
                setTimeout(() => {
                    renderTurnstiles(el);
                }, 100);
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