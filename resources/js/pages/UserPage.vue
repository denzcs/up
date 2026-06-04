<template>
    <div>
        <section class="p-4">
            <div class="container">
                <div class="d-flex align-items-center mb-4">
                    <button class="btn btn-outline btn-sm me-3" @click="backToAdmin">
                        <i class="fas fa-arrow-left me-1"></i>Назад
                    </button>
                    <div>
                        <h2 class="mb-0 fw-bold" style="color: #b3446c;">Пользователь</h2>
                        <span class="text-muted" style="font-size: 13px;">Информация о пользователе</span>
                    </div>
                </div>
                <div style="border-bottom: 3px solid #b3446c;"></div>
            </div>
        </section>

        <section class="p-4" v-if="loading">
            <div class="text-center py-5">
                <div class="spinner-border" style="color: #b3446c;"></div>
            </div>
        </section>

        <section class="p-4" v-else-if="user">
            <div class="container">
                <div class="profile-card mb-4">
                    <div class="d-flex align-items-center gap-4 flex-wrap">
                        <img
                            :src="user.avatar ? PUBLIC + user.avatar : 'https://via.placeholder.com/100'"
                            width="100"
                            height="100"
                            class="rounded-circle"
                            style="object-fit: cover; border: 3px solid #b3446c;"
                        />
                        <div>
                            <h4 class="fw-bold mb-1">{{ user.fullname }}</h4>
                            <p class="mb-1 text-muted">@{{ user.username }}</p>
                            <p class="mb-1">Email: {{ user.email }}</p>
                            <p class="mb-1">Телефон: {{ user.phone }}</p>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <span class="category-badge">{{ user.role === 'admin' ? 'Админ' : 'Пользователь' }}</span>
                                <span class="text-muted">Регистрация: {{ formatDate(user.created_at) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile-card mb-4">
                    <h5 class="fw-semibold mb-3" style="color: #b3446c;">Выбранные категории</h5>
                    <div v-if="user.services && user.services.length">
                        <div v-for="service in user.services" :key="service.id" class="service-item d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="category-badge me-2">{{ service.categorie?.name }}</span>
                                <span class="text-muted" style="font-size: 13px;">{{ formatDate(service.received_at) }}</span>
                            </div>
                        </div>
                    </div>
                    <p v-else class="text-muted" style="font-size: 14px;">Категории не добавлены</p>
                </div>

                <div class="profile-card mb-4">
                    <h5 class="fw-semibold mb-3" style="color: #b3446c;">Комментарии пользователя</h5>
                    <div v-if="user.comments && user.comments.length">
                        <div v-for="comment in user.comments" :key="comment.id" class="admin-comment-card mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <span class="category-badge me-2">{{ comment.categorie?.name || 'Без категории' }}</span>
                                    <span class="text-muted" style="font-size: 12px;">{{ formatDate(comment.created_at) }}</span>
                                </div>
                            </div>
                            <p class="comment-text mb-2">{{ comment.content }}</p>
                            <div v-if="comment.images && comment.images.length" class="admin-comment-images d-flex flex-wrap gap-2 mb-2">
                                <div v-for="img in comment.images" :key="img.id" class="admin-comment-thumb">
                                    <img :src="img.url" :alt="img.path" class="admin-thumb-img" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <p v-else class="text-muted" style="font-size: 14px;">Комментариев нет</p>
                </div>
            </div>
        </section>

        <section class="p-4" v-else>
            <div class="text-center py-5 text-muted">Пользователь не найден</div>
        </section>
    </div>
</template>

<script>
export default {
    name: 'UserPage',
    props: ['server', 'PUBLIC', 'changePage', 'pageId'],
    data() {
        return {
            user: null,
            loading: false,
        };
    },
    mounted() {
        this.fetchUser();
    },
    methods: {
        backToAdmin() {
            this.changePage('AdminPage');
        },
        fetchUser() {
            this.loading = true;
            this.server('admin/users/' + this.pageId)
                .then((result) => {
                    this.user = result || null;
                })
                .catch(() => {
                    this.user = null;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        formatDate(date) {
            if (!date) return '';
            let d = new Date(date);
            return d.toLocaleDateString('ru-RU') + ' ' + d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
        },
    },
};
</script>
