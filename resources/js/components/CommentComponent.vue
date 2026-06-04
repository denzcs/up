<template>
    <div class="col-12 comment-form mb-3">
        <div class="comment-header d-flex justify-content-center flex-column">
            <span v-if="comment.categorie" class="category-badge mb-2">
                <i class="fas fa-tag me-1"></i>{{ comment.categorie.name }}
            </span>
            <div>
                <img
                    width="32px"
                    height="32px"
                    :src="PUBLIC + comment.user.avatar"
                    alt=""
                />
                <span class="fw-semibold ml-5">
                    {{ comment.user.fullname }}
                </span>
                <span class="ml-5" style="color: #b3446c">
                    {{ formatDate(comment.created_at) }}
                </span>
            </div>
        </div>

        <div class="comment-body d-flex flex-column ml-15">
            <p class="text-break">
                {{ comment.content }}
            </p>

            <div v-if="comment.images && comment.images.length" class="comment-images d-flex flex-wrap gap-2 mb-3">
                <div v-for="img in comment.images" :key="img.id" class="comment-image-item" style="max-width: 180px">
                    <img :src="img.url" :alt="img.path" style="width:100%; height:auto; border-radius:6px; object-fit:cover;" />
                </div>
            </div>

            <div
                class="comment-body-likesComments-section d-flex align-items-center mb-3"
            >
                <a
                    v-if="user.role == 'admin'"
                    href=""
                    @click.prevent="showReplayForm"
                    class="btn btn-outline"
                >
                    Ответить на комментарий
                </a>

                <a
                    href=""
                    @click.prevent="likeAdd(comment.id)"
                    class="text-reset text-decoration-none ml-10"
                >
                    <i
                        class="far fa-heart"
                        :class="{
                            fas: isLiked(comment),
                            liked: isLiked(comment),
                        }"
                    ></i>
                    <span class="ml-5">{{ getLikesCount(comment) }}</span>
                </a>

                <a href="" class="text-reset text-decoration-none ml-10">
                    <i class="far fa-comment"></i>
                    <span class="ml-5">{{ comment.replies_count }}</span>
                </a>
            </div>
        </div>

        <div
            v-if="showReplayFormOn"
            class="reply-input-form d-flex align-items-center ml-15 mb-3"
        >
            <img width="32px" height="32px" :src="PUBLIC + this.user.avatar " alt="" />
            <input
                type="text"
                class="form-control form ml-10"
                placeholder="Ваш комментарий"
                style="width: 50%"
                v-model="replyBody"
            />
            <button
                type="submit"
                class="btn btn-outline ml-15"
                @click="submitReply(comment.id, comment.categorie_id)"
            >
                Отправить
            </button>
        </div>

        <div
            v-for="reply in comment.replies"
            :key="reply.id"
            v-if="comment.replies"
            class="reply-comments replies-block"
        >
            <div class="comment-header d-flex justify-content-center flex-column">
                <div class="mb-1">
                    <img width="32px" height="32px" :src="PUBLIC + reply.user?.avatar " alt="" />
                    <span class="fw-semibold">{{ reply.user?.fullname }}</span>
                    <span class="ml-5" style="color: #b3446c">
                        {{ formatDate(reply.created_at) }}
                    </span>
                </div>
                <div class="user-role">
                    <span>Администратор</span>
                </div>
            </div>

            <div class="comment-body d-flex flex-column ml-15">
                <p class="text-break">
                    {{ reply.content }}
                </p>

                <div v-if="reply.images && reply.images.length" class="comment-images d-flex flex-wrap gap-2 mb-3">
                    <div v-for="rimg in reply.images" :key="rimg.id" class="comment-image-item" style="max-width: 140px">
                        <img :src="rimg.url" :alt="rimg.path" style="width:100%; height:auto; border-radius:6px; object-fit:cover;" />
                    </div>
                </div>

                <div
                    class="comment-body-likesComments-section d-flex align-items-center mb-3"
                >
                    <a
                        href=""
                        @click.prevent="likeAdd(reply.id)"
                        class="text-reset text-decoration-none ml-10"
                    >
                        <i
                            class="far fa-heart"
                            :class="{
                                fas: isLiked(reply),
                                liked: isLiked(reply),
                            }"
                        ></i>
                        <span class="ml-5">{{ getLikesCount(reply) }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CommentComponent',
    props: ['comment', 'user', 'PUBLIC', 'server', 'getComments'],
    data() {
        return {
            showReplayFormOn: false,
            replyBody: null,
        };
    },
    methods: {
        isLiked(item) {
            if (!item || !Array.isArray(item.likes) || !this.user) {
                return false;
            }

            return item.likes.some((like) => like.user_id === this.user.id);
        },
        getLikesCount(item) {
            return item && Array.isArray(item.likes) ? item.likes.length : 0;
        },
        likeAdd(id) {
            this.server('comments/' + id + '/like', 'POST').then(() => {
                this.getComments();
            });
        },

        showReplayForm() {
            this.showReplayFormOn = !this.showReplayFormOn;
        },

        formatDate(date) {
            let d = new Date(date);
            return (
                d.toLocaleDateString('ru-RU') +
                ' ' +
                d.toLocaleTimeString('ru-RU', {
                    hour: '2-digit',
                    minute: '2-digit',
                })
            );
        },

        submitReply(parentId, categorieId) {
            let formData = new FormData();
            formData.append('content', this.replyBody);
            formData.append('categorie_id', categorieId);
            formData.append('comment_id', parentId);

            this.server('comments', 'POST', formData).then((result) => {
                if (result.id) {
                    result.likes = [];
                    this.comment.replies.push(result);
                    this.replyBody = '';
                    this.showReplayFormOn = false;
                    this.getComments();
                } else {
                    this.error = 'Не удалось отправить комментарий';
                }
            });
        },
    },
};
</script>
