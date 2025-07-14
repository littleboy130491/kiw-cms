@pushOnce('before_head_close')
    @if ($this->isBotProtectionEnabled() && $this->getBotProtectionType() === 'turnstile')
        @turnstileScripts()
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
                    <article class="mb-5">
                        <header class="flex flex-col gap-1">
                            <h5 class="name">{{ $comment->name }}</h5>
                        </header>
                        <section class="my-3">
                            <p>{{ $comment->content }}</p>
                        </section>
                        <div class="flex flex-row justify-between mt-5">
                            <div class="gradient-blue text-white w-fit px-2 py-1 text-[.85em]">
                                <button wire:click="showReply({{ $comment->id }})"
                                    class="reply-button cursor-pointer">Balas</button>
                            </div>
                            <time datetime="{{ $comment->created_at->setTimezone('Asia/Jakarta')->format('c') }}"
                                class="text-[var(--color-text)] text-[.9em]">
                                {{ $comment->created_at->setTimezone('Asia/Jakarta')->format('M d, Y \a\t g:i a') }}
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
                                <div class="w-full flex justify-center mt-4 bg-yellow-100 p-4 border">
                                    <div>
                                        <p class="text-sm mb-2">DEBUG: Bot protection enabled, type: {{ $this->getBotProtectionType() }}</p>
                                        @if ($this->getBotProtectionType() === 'turnstile')
                                            <p class="text-sm mb-2">DEBUG: About to render Turnstile with ID: replyTurnstile{{ $comment->id }}</p>
                                            <div class="border-2 border-red-500 p-2">
                                                <x-turnstile id="replyTurnstile{{ $comment->id }}" wire:model="replyTurnstile" />
                                            </div>
                                            <p class="text-sm mt-2">DEBUG: Turnstile component rendered above (in red border)</p>
                                        @else
                                            <p class="text-sm">DEBUG: Not turnstile type</p>
                                        @endif
                                    </div>
                                </div>
                                @error('replyTurnstile')
                                    <span class="text-red-500 text-sm mt-2 w-full text-center">{{ $message }}</span>
                                @enderror
                            @else
                                <div class="w-full flex justify-center mt-4 bg-red-100 p-4 border">
                                    <p class="text-sm">DEBUG: Bot protection is NOT enabled</p>
                                </div>
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

                    <!-- Reply Form Messages (shown independently of form) -->
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

                    <!-- Replies -->
                    @if($comment->children->count() > 0)
                        <ol class="ml-5">
                            @foreach($comment->children as $reply)
                                <li class="my-4">
                                    <article class="bg-white p-4 border border-[var(--color-border)]">
                                        <header class="flex flex-col gap-1">
                                            <p class="italic text-[.8em] reply">Membalas <span
                                                    class="from-name">{{ $comment->name }}</span>
                                                <span class="parent-message">: "{{ Str::limit($reply->content, 100) }}"
                                                </span>
                                            </p>
                                            <h5 class="name">{{ $reply->name }}</h5>
                                        </header>
                                        <section class="my-3">
                                            <p>{{ $reply->content }}</p>
                                        </section>
                                        <div class="flex flex-row justify-between mt-5">
                                            <div class="gradient-blue text-white w-fit px-2 py-1 text-[.85em]">
                                                <button wire:click="showReply({{ $reply->id }})"
                                                    class="reply-button cursor-pointer">Balas</button>
                                            </div>
                                            <time datetime="{{ $reply->created_at->setTimezone('Asia/Jakarta')->format('c') }}"
                                                class="text-[var(--color-text)] text-[.9em]">
                                                {{ $reply->created_at->setTimezone('Asia/Jakarta')->format('M d, Y \a\t g:i a') }}
                                            </time>
                                        </div>
                                    </article>

                                    <!-- Nested Reply Form -->
                                    @if($showReplyForm && $replyTo == $reply->id)
                                        <form wire:submit="submitReply"
                                            class="reply-form flex flex-col sm:flex-row justify-between gap-2 flex-wrap mt-4 bg-white p-4 border border-[var(--color-border)] rounded ml-0">
                                            <div class="sm:w-full">
                                                <label for="nested-reply-content-{{ $reply->id }}" class="hidden">Balasan</label>
                                                <textarea wire:model="replyContent"
                                                    class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyContent') border-red-500 @enderror"
                                                    placeholder="Tulis balasan Anda" id="nested-reply-content-{{ $reply->id }}" rows="4"
                                                    required></textarea>
                                                @error('replyContent') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="sm:w-[49%] lg:w-[49%]">
                                                <label for="nested-reply-name-{{ $reply->id }}" class="hidden">Nama</label>
                                                <input type="text" wire:model="replyName" placeholder="Masukkan nama Anda" required
                                                    id="nested-reply-name-{{ $reply->id }}"
                                                    class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyName') border-red-500 @enderror">
                                                @error('replyName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="sm:w-[49%] lg:w-[49%]">
                                                <label for="nested-reply-email-{{ $reply->id }}" class="hidden">Email</label>
                                                <input type="email" wire:model="replyEmail" placeholder="Alamat email contoh@email.com"
                                                    required id="nested-reply-email-{{ $reply->id }}"
                                                    class="w-full p-2 border border-[var(--color-border)] focus:outline-none focus:ring-2 focus:ring-blue-500 @error('replyEmail') border-red-500 @enderror">
                                                @error('replyEmail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>

                                            @if ($this->isBotProtectionEnabled())
                                                <div class="w-full flex justify-center mt-4">
                                                    @if ($this->getBotProtectionType() === 'turnstile')
                                                        <x-turnstile id="nestedReplyTurnstile{{ $reply->id }}" wire:model="replyTurnstile" />
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

                                    <!-- Nested Reply Form Messages (shown independently of form) -->
                                    @if($replyFormMessage && $replyTo == $reply->id)
                                        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
                                            role="alert">
                                            {{ $replyFormMessage }}
                                        </div>
                                    @endif

                                    @if($replyFormError && $replyTo == $reply->id)
                                        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                                            {{ $replyFormError }}
                                        </div>
                                    @endif

                                    <!-- Nested Replies -->
                                    @if($reply->children->count() > 0)
                                        <ol class="ml-0">
                                            @foreach($reply->children as $nestedReply)
                                                <li class="my-4">
                                                    <article class="bg-white p-4 border border-[var(--color-border)]">
                                                        <header class="flex flex-col gap-1">
                                                            <p class="italic text-[.8em] reply">Membalas <span
                                                                    class="from-name">{{ $reply->name }}</span>
                                                                <span class="parent-message">: "{{ Str::limit($reply->content, 100) }}"
                                                                </span>
                                                            </p>
                                                            <h5 class="name">{{ $nestedReply->name }}</h5>
                                                        </header>
                                                        <section class="my-3">
                                                            <p>{{ $nestedReply->content }}</p>
                                                        </section>
                                                        <div class="flex flex-row justify-between mt-5">
                                                            <div class="gradient-blue text-white w-fit px-2 py-1 text-[.85em]">
                                                                <button wire:click="showReply({{ $nestedReply->id }})"
                                                                    class="reply-button cursor-pointer">Balas</button>
                                                            </div>
                                                            <time
                                                                datetime="{{ $nestedReply->created_at->setTimezone('Asia/Jakarta')->format('c') }}"
                                                                class="text-[var(--color-text)] text-[.9em]">
                                                                {{ $nestedReply->created_at->setTimezone('Asia/Jakarta')->format('M d, Y \a\t g:i a') }}
                                                            </time>
                                                        </div>
                                                    </article>
                                                </li>
                                            @endforeach
                                        </ol>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
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
        console.log('DEBUG: Turnstile script section loaded');
        
        document.addEventListener('livewire:init', function () {
            console.log('DEBUG: Livewire init event fired');
            console.log('DEBUG: Turnstile available?', typeof turnstile !== 'undefined');
            
            // Check for Turnstile widgets on page
            setInterval(() => {
                const widgets = document.querySelectorAll('.cf-turnstile');
                console.log('DEBUG: Found', widgets.length, 'Turnstile widgets on page');
                widgets.forEach((widget, index) => {
                    console.log('DEBUG: Widget', index, 'ID:', widget.id, 'Rendered:', widget.hasChildNodes());
                });
            }, 2000);
            
            // Reset Turnstile when needed
            Livewire.on('reset-turnstile', () => {
                console.log('DEBUG: Reset turnstile event received');
                if (typeof turnstile !== 'undefined') {
                    const widgets = document.querySelectorAll('.cf-turnstile');
                    console.log('DEBUG: Resetting', widgets.length, 'widgets');
                    widgets.forEach(widget => {
                        turnstile.reset(widget);
                    });
                } else {
                    console.log('DEBUG: Turnstile not available for reset');
                }
            });
            
            // Listen for Livewire updates that might add new widgets
            Livewire.on('$refresh', () => {
                console.log('DEBUG: Livewire refresh event - checking for new widgets');
                setTimeout(() => {
                    const newWidgets = document.querySelectorAll('.cf-turnstile:not([data-initialized])');
                    console.log('DEBUG: Found', newWidgets.length, 'uninitialized widgets');
                    newWidgets.forEach(widget => {
                        console.log('DEBUG: Attempting to initialize widget', widget.id);
                        widget.setAttribute('data-initialized', 'true');
                    });
                }, 500);
            });
        });
        
        // Check if Turnstile loads after page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DEBUG: DOM loaded, checking Turnstile...');
            
            function checkTurnstile() {
                if (typeof turnstile !== 'undefined') {
                    console.log('DEBUG: Turnstile is available!');
                    const widgets = document.querySelectorAll('.cf-turnstile');
                    console.log('DEBUG: Found widgets:', widgets.length);
                } else {
                    console.log('DEBUG: Turnstile not yet available, retrying...');
                    setTimeout(checkTurnstile, 1000);
                }
            }
            
            checkTurnstile();
        });
    </script>
@endif