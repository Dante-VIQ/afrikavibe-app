<div x-data="commentModal()" x-cloak>
    <!-- Modal -->
    <div x-show="$wire.showModal"
         x-transition.opacity
         class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50">

        <div class="bg-white rounded-lg w-full max-w-md max-h-[90vh] flex flex-col shadow-xl m-4">
            <!-- Header -->
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="font-bold text-lg">Comments</h2>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    ✕
                </button>
            </div>

            <!-- Loading State -->
            <div wire:loading wire:target="loadComments" class="p-8 text-center">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                <p class="mt-2 text-gray-600">Loading comments...</p>
            </div>

            <!-- Comments List -->
            <div wire:loading.remove wire:target="loadComments"
                 class="flex-1 overflow-y-auto p-4 space-y-4">

                @forelse($comments as $comment)
                    <div class="border-b pb-4 last:border-b-0">
                        <div class="flex items-start gap-3">
                            <img src="{{ $comment->user->avatar_url ?? 'https://i.pravatar.cc/40?u=' . $comment->user->email }}"
                                alt="{{ $comment->user->name }}"
                                class="w-10 h-10 rounded-full object-cover">

                            <div class="flex-1">
                                <div class="flex items-baseline justify-between">
                                    <span class="font-semibold">{{ $comment->user->name }}</span>
                                    <span class="text-gray-500 text-xs ml-2">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                <p class="mt-1 text-gray-800">{{ $comment->content }}</p>

                                <button wire:click="reply({{ $comment->id }})"
                                        class="mt-2 text-sm text-blue-500 hover:text-blue-700">
                                    Reply
                                </button>
                            </div>
                        </div>

                        <!-- Replies -->
                        @if ($comment->replies->count() > 0)
                            <div class="ml-12 mt-3 space-y-3 border-l-2 border-gray-100 pl-3">
                                @foreach ($comment->replies as $reply)
                                    <div class="pt-2">
                                        <div class="flex items-start gap-2">
                                            <img src="{{ $reply->user->avatar_url ?? 'https://i.pravatar.cc/30?u=' . $reply->user->email }}"
                                                alt="{{ $reply->user->name }}"
                                                class="w-8 h-8 rounded-full">
                                            <div class="flex-1">
                                                <div class="flex items-baseline justify-between">
                                                    <span class="font-medium text-sm">{{ $reply->user->name }}</span>
                                                    <span class="text-gray-500 text-xs ml-2">
                                                        {{ $reply->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                                <p class="text-sm text-gray-700">{{ $reply->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-500">
                        No comments yet. Be the first to comment!
                    </div>
                @endforelse

                @if($error)
                    <div class="p-4 bg-red-50 text-red-700 rounded-lg">
                        {{ $error }}
                    </div>
                @endif
            </div>

            <!-- Comment Form -->
            <form wire:submit="save" class="p-4 border-t">
                @csrf
                <div class="flex gap-3">
                    @auth
                    <img src="{{ auth()->user()->avatar_url ?? 'https://i.pravatar.cc/40?u=' . auth()->user()->email }}"
                         alt="Your profile"
                         class="w-10 h-10 rounded-full">

                         @else
                         <img src="{{ 'https://i.pravatar.cc/40?u=' }}"
                         alt="Your profile"
                         class="w-10 h-10 rounded-full">

                         @endauth
                    <div class="flex-1">
                        <input type="hidden" wire:model="parentId">
                        <textarea
                            wire:model="content" 
                            x-ref="commentInput"
                            placeholder="{{ $parentId ? 'Write your reply...' : 'Write your comment...' }}"
                            rows="2"
                            class="w-full p-3 border rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            wire:loading.attr="disabled"
                        ></textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-2">
                    <!-- Cancel Reply Button (conditionally shown) -->
                    @if($parentId)
                        <button
                            type="button"
                            wire:click="cancelReply"
                            class="px-4 py-2 text-gray-500 hover:text-gray-700"
                            wire:loading.attr="disabled"
                        >
                            Cancel
                        </button>
                    @endif

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition disabled:opacity-50"

                    >
                        <span wire:loading.remove>Post</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function commentModal() {
    return {
        init() {
            // Focus on input when reply is started
            Livewire.on('reply-started', () => {
                this.$nextTick(() => {
                    const input = this.$refs.commentInput;
                    if (input) {
                        input.focus();
                    }
                });
            });

            // Close modal when clicking outside (using Livewire)
            document.addEventListener('click', (e) => {
                if (this.$wire.showModal && !e.target.closest('.bg-white')) {
                    this.$wire.closeModal();
                }
            });

            // Close modal with Escape key (using Livewire)
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.$wire.showModal) {
                    this.$wire.closeModal();
                }
            });
        }
    }
}
</script>
