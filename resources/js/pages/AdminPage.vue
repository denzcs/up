<template>
    <div>
        <section class="p-4">
            <div class="container">
                <div class="d-flex align-items-center mb-4">
                    <div class="category-hero-icon me-4">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0" style="color: #b3446c">
                            Панель администратора
                        </h2>
                        <span class="text-muted" style="font-size: 13px"
                            >Управление комментариями и пользователями</span
                        >
                    </div>
                </div>
                <div style="border-bottom: 3px solid #b3446c"></div>
            </div>
        </section>

        <section class="p-4 pt-0">
            <div class="container">
                <div class="admin-tabs mb-4">
                    <button
                        class="admin-tab"
                        :class="{ active: activeTab === 'comments' }"
                        @click="activeTab = 'comments'"
                    >
                        <i class="far fa-comment me-2"></i>Комментарии
                        <span class="tab-badge">{{ comments.length }}</span>
                    </button>
                    <button
                        class="admin-tab"
                        :class="{ active: activeTab === 'users' }"
                        @click="
                            activeTab = 'users';
                            getUsers();
                        "
                    >
                        <i class="fas fa-users me-2"></i>Пользователи
                        <span class="tab-badge">{{ users.length }}</span>
                    </button>
                </div>
                <div v-if="loading" class="py-5 text-center">
                    <div class="spinner-border" style="color: #b3446c"></div>
                </div>
                <div v-else-if="activeTab === 'comments'">
                    <div
                        v-if="comments.length === 0"
                        class="text-muted py-5 text-center"
                    >
                        <i
                            class="far fa-comment-dots fa-3x mb-3"
                            style="opacity: 0.4"
                        ></i>
                        <p>Комментариев пока нет</p>
                    </div>
                    <div
                        v-for="comment in comments"
                        :key="comment.id"
                        class="admin-comment-card mb-3"
                    >
                        <div
                            class="d-flex justify-content-between align-items-start mb-2"
                        >
                            <div class="d-flex align-items-center">
                                <img
                                    :src="PUBLIC + comment.user?.avatar || ''"
                                    width="36"
                                    height="36"
                                    class="rounded-circle me-2"
                                    style="
                                        object-fit: cover;
                                        border: 2px solid #e29cb6c9;
                                    "
                                />
                                <div>
                                    <span class="fw-semibold">{{
                                        comment.user?.name ||
                                        comment.user?.username
                                    }}</span>
                                    <span
                                        class="text-muted ms-2"
                                        style="font-size: 12px"
                                        >{{
                                            formatDate(comment.created_at)
                                        }}</span
                                    >
                                    <span class="category-badge ms-2">{{
                                        comment.categorie?.name
                                    }}</span>
                                </div>
                            </div>
                            <button
                                class="btn btn-sm btn-danger-outline"
                                @click="deleteComment(comment.id)"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>

                        <p class="comment-text mb-2">{{ comment.content }}</p>

                        <div
                            v-if="comment.images && comment.images.length"
                            class="admin-comment-images d-flex mb-2 flex-wrap gap-2"
                        >
                            <div
                                v-for="img in comment.images"
                                :key="img.id"
                                class="admin-comment-thumb"
                            >
                                <img
                                    :src="img.url"
                                    :alt="img.path"
                                    class="admin-thumb-img"
                                />
                            </div>
                        </div>

                        <div
                            class="d-flex align-items-center mb-2"
                            style="font-size: 13px; color: #888"
                        >
                            <i class="far fa-heart me-1"></i
                            >{{ comment.likes?.length || 0 }}
                            <i class="far fa-comment me-1 ms-3"></i
                            >{{ comment.replies?.length || 0 }}
                        </div>
                        <div
                            v-if="comment.replies && comment.replies.length"
                            class="replies-block mb-2"
                        >
                            <div
                                v-for="reply in comment.replies"
                                :key="reply.id"
                                class="reply-item d-flex justify-content-between align-items-start"
                            >
                                <div>
                                    <span
                                        class="fw-semibold"
                                        style="font-size: 13px"
                                        >{{
                                            reply.user?.name ||
                                            reply.user?.username
                                        }}</span
                                    >
                                    <span
                                        class="text-muted ms-2"
                                        style="font-size: 11px"
                                        >{{
                                            formatDate(reply.created_at)
                                        }}</span
                                    >
                                    <p
                                        class="mb-0 mt-1"
                                        style="font-size: 13px"
                                    >
                                        {{ reply.content }}
                                    </p>
                                </div>
                                <button
                                    class="btn btn-sm btn-danger-outline"
                                    @click="deleteComment(reply.id)"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div
                            v-if="replyingTo === comment.id"
                            class="reply-form d-flex align-items-center mt-2"
                        >
                            <input
                                v-model="replyBody"
                                type="text"
                                class="form-control form me-2"
                                placeholder="Ваш ответ..."
                                style="font-size: 13px"
                            />
                            <button
                                class="btn btn-fill btn-sm me-2"
                                @click="
                                    submitReply(
                                        comment.id,
                                        comment.categorie_id,
                                    )
                                "
                            >
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button
                                class="btn btn-outline btn-sm"
                                @click="replyingTo = null"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <button
                            v-else
                            class="btn btn-outline btn-sm mt-1"
                            @click="
                                replyingTo = comment.id;
                                replyBody = '';
                            "
                        >
                            <i class="far fa-comment me-1"></i>Ответить
                        </button>
                    </div>
                </div>
                <div v-else-if="activeTab === 'users'">
                    <div
                        v-if="users.length === 0"
                        class="text-muted py-5 text-center"
                    >
                        <i
                            class="fas fa-users fa-3x mb-3"
                            style="opacity: 0.4"
                        ></i>
                        <p>Пользователей нет</p>
                    </div>
                    <div
                        v-for="user in users"
                        :key="user.id"
                        class="admin-user-card d-flex align-items-center justify-content-between admin-user-card-clickable mb-3 flex-wrap"
                        @click="changePage('UserPage', user.id)"
                    >
                        <div
                            class="d-flex align-items-center flex-grow-1 flex-wrap gap-3"
                        >
                            <img
                                :src="
                                    user.avatar
                                        ? PUBLIC + user.avatar
                                        : 'https://via.placeholder.com/48'
                                "
                                width="48"
                                height="48"
                                class="rounded-circle"
                                style="
                                    object-fit: cover;
                                    border: 2px solid #e29cb6c9;
                                    flex-shrink: 0;
                                "
                            />
                            <div>
                                <p class="fw-semibold mb-1">
                                    {{ user.fullname }}
                                </p>
                                <p
                                    class="text-muted mb-1"
                                    style="font-size: 13px"
                                >
                                    @{{ user.username }}
                                </p>
                                <p
                                    class="text-muted mb-1"
                                    style="font-size: 13px"
                                >
                                    {{ user.email }}
                                </p>
                                <p
                                    class="text-muted mb-1"
                                    style="font-size: 13px"
                                >
                                    Телефон: {{ user.phone }}
                                </p>
                                <div
                                    class="d-flex flex-wrap gap-2"
                                    style="font-size: 12px"
                                >
                                    <span class="category-badge">{{
                                        user.role === 'user'
                                            ? 'Пользователь'
                                            : 'Админ'
                                    }}</span>
                                    <span class="text-muted"
                                        >Регистрация:
                                        {{ formatDate(user.created_at) }}</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: 'AdminPage',
    props: ['server', 'changePage', 'PUBLIC'],
    data() {
        return {
            activeTab: 'comments',
            comments: [],
            users: [],
            loading: false,
            replyingTo: null,
            replyBody: '',
        };
    },
    mounted() {
        this.getComments();
        this.getUsers();
    },
    methods: {
        getComments() {
            this.loading = true;
            this.server('admin/comments')
                .then((result) => {
                    this.comments = result;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        getUsers() {
            this.loading = true;
            this.server('admin/users')
                .then((result) => {
                    this.users = Array.isArray(result) ? result : [];
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        deleteComment(id) {
            this.server('admin/comments/' + id, 'DELETE').then(() => {
                this.getComments();
            });
        },

        submitReply(parentId, categorieId) {
            let formData = new FormData();
            formData.append('content', this.replyBody);
            formData.append('categorie_id', categorieId);
            formData.append('comment_id', parentId);
            this.server('comments', 'POST', formData).then(() => {
                this.replyingTo = null;
                this.replyBody = '';
                this.getComments();
            });
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
    },
};
</script>
