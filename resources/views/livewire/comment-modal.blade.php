<div x-data="commentModal()" x-cloak>
    <!-- Modal Backdrop -->
    <div x-show="Alpine.store('commentModal').isOpen" 
         x-transition.opacity 
         @click.away="closeModal()"
         @keydown.escape.window="closeModal()"
         class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50">
        
        <!-- Modal Content -->
        <div @click.stop class="bg-white rounded-lg w-full max-w-md max-h-[90vh] flex flex-col shadow-xl m-4">
            <!-- Header -->
            <div class="p-4 border-b flex justify-between items-center">
                <div>
                    <h2 class="font-bold text-lg">Comments</h2>
                    <p class="text-sm text-gray-600" x-text="getCommentableTitle()"></p>
                </div>
                <button @click="closeModal()" class="text-gray-500 hover:text-gray-700">
                    ✕
                </button>
            </div>

            <!-- Comments List -->
            <div class="flex-1 overflow-y-auto p-4 space-y-4" x-ref="commentsContainer">
                <template x-for="comment in comments" :key="comment.id">
                    <div class="border-b pb-4 last:border-b-0">
                        <!-- Comment Content -->
                        <div class="flex items-start gap-3">
                            <img :src="comment.user.avatar_url || `https://i.pravatar.cc/40?u=${comment.user.email}`" 
                                 :alt="comment.user.name" 
                                 class="w-10 h-10 rounded-full object-cover">
                            
                            <div class="flex-1">
                                <div class="flex items-baseline justify-between">
                                    <div>
                                        <span class="font-semibold" x-text="comment.user.name"></span>
                                        <span class="text-gray-500 text-xs ml-2" x-text="formatDate(comment.created_at)"></span>
                                    </div>
                                </div>

                                <p class="mt-1 text-gray-800" x-text="comment.content"></p>

                                <!-- Reply Button -->
                                <button @click="setReplyTo(comment.id)" 
                                        class="mt-2 text-sm text-blue-500 hover:text-blue-700">
                                    Reply
                                </button>
                            </div>
                        </div>

                        <!-- Replies -->
                        <template x-if="comment.replies && comment.replies.length > 0">
                            <div class="ml-12 mt-3 space-y-3 border-l-2 border-gray-100 pl-3">
                                <template x-for="reply in comment.replies" :key="reply.id">
                                    <div class="pt-2">
                                        <div class="flex items-start gap-2">
                                            <img :src="reply.user.avatar_url || `https://i.pravatar.cc/30?u=${reply.user.email}`" 
                                                 :alt="reply.user.name" 
                                                 class="w-8 h-8 rounded-full">
                                            <div>
                                                <div class="flex items-baseline justify-between">
                                                    <span class="font-medium text-sm" x-text="reply.user.name"></span>
                                                    <span class="text-gray-500 text-xs ml-2" x-text="formatDate(reply.created_at)"></span>
                                                </div>
                                                <p class="text-sm text-gray-700" x-text="reply.content"></p>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </template>

                <!-- Empty State -->
                <div x-show="comments.length === 0" class="text-center py-6 text-gray-500">
                    No comments yet. Be the first to comment!
                </div>
            </div>

            <!-- Comment Form -->
            <form @submit.prevent="submitComment()" class="p-4 border-t">
                <div class="flex gap-3">
                    <!-- User Avatar -->
                    <img :src="userAvatar" alt="Your profile" class="w-10 h-10 rounded-full">
                    
                    <!-- Comment Input -->
                    <div class="flex-1">
                        <input type="hidden" x-model="parentId">
                        <textarea 
                            x-model="content" 
                            x-ref="commentInput"
                            :placeholder="parentId ? 'Write your reply...' : 'Write your comment...'" 
                            rows="2"
                            class="w-full p-3 border rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                        ></textarea>
                        <p x-show="error" class="mt-1 text-sm text-red-600" x-text="error"></p>
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-2">
                    <button 
                        type="button" 
                        x-show="parentId" 
                        @click="cancelReply()"
                        class="px-4 py-2 text-gray-500 hover:text-gray-700"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
                        :disabled="isSubmitting"
                    >
                        <span x-show="!isSubmitting">Post</span>
                        <span x-show="isSubmitting">Posting...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function commentModal() {
    return {
        comments: [],
        content: '',
        parentId: null,
        isSubmitting: false,
        error: null,
        userAvatar: 'https://i.pravatar.cc/40',
        
        init() {
            // Load user avatar if authenticated
            this.loadUserData();
            
            // Watch for modal open to load comments
            this.$watch('$store.commentModal.isOpen', (isOpen) => {
                if (isOpen) {
                    this.loadComments();
                }
            });
        },
        
        getCommentableTitle() {
            return Alpine.store('commentModal').getCommentableTitle();
        },
        
        async loadComments() {
            const store = Alpine.store('commentModal');
            if (!store.commentableId || !store.commentableType) return;
            
            try {
                const response = await fetch(`/api/comments?commentable_id=${store.commentableId}&commentable_type=${store.commentableType}`);
                this.comments = await response.json();
            } catch (error) {
                console.error('Error loading comments:', error);
            }
        },
        
        async submitComment() {
            this.isSubmitting = true;
            this.error = null;
            
            const store = Alpine.store('commentModal');
            
            try {
                const response = await fetch('/api/comments', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        commentable_id: store.commentableId,
                        commentable_type: store.commentableType,
                        content: this.content,
                        parent_id: this.parentId
                    })
                });
                
                if (response.ok) {
                    this.content = '';
                    this.parentId = null;
                    await this.loadComments(); // Reload comments
                    this.$refs.commentInput.focus();
                } else {
                    this.error = 'Failed to post comment';
                }
            } catch (error) {
                this.error = 'Network error. Please try again.';
            }
            
            this.isSubmitting = false;
        },
        
        setReplyTo(commentId) {
            this.parentId = commentId;
            this.$nextTick(() => {
                this.$refs.commentInput.focus();
            });
        },
        
        cancelReply() {
            this.parentId = null;
        },
        
        closeModal() {
            Alpine.store('commentModal').close();
            this.comments = [];
            this.content = '';
            this.parentId = null;
            this.error = null;
        },
        
        formatDate(dateString) {
            return new Date(dateString).toLocaleDateString();
        },
        
        loadUserData() {
            // You can implement user data loading here
            // For example, if you have a global user object:
            if (window.user) {
                this.userAvatar = window.user.avatar_url || `https://i.pravatar.cc/40?u=${window.user.email}`;
            }
        }
    }
}
</script>