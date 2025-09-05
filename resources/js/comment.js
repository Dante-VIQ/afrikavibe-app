    document.addEventListener('alpine:init', () => {
            Alpine.store('commentModal', {
                isOpen: false,
                commentableId: null,
                commentableType: null,
                commentableModel: null,

                open(commentableId, commentableType, modelData = null) {
                    this.commentableId = commentableId;
                    this.commentableType = commentableType;
                    this.commentableModel = modelData;
                    this.isOpen = true;
                },

                close() {
                    this.isOpen = false;
                    this.commentableId = null;
                    this.commentableType = null;
                    this.commentableModel = null;
                },

                getCommentableTitle() {
                    if (!this.commentableModel) return 'Item';

                    return this.commentableModel.title ||
                        this.commentableModel.name ||
                        this.commentableModel.subject ||
                        'Item';
                }
            });
        });
    