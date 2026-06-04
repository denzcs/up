<template>
    <div>
        <section class="p-4">
            <div class="container">
                <div class="category-hero d-flex align-items-center mb-4">
                    <div class="category-hero-icon me-4">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-1" style="color: #b3446c">
                            {{ Categorie ? Categorie.name : 'Загрузка...' }}
                        </h2>
                    </div>
                </div>

                <div style="border-bottom: 3px solid #b3446c"></div>
            </div>
        </section>
        <section class="p-0" v-if="Categorie">
            <div class="category-banner">
                <img
                    :src="Categorie.image"
                    :alt="Categorie.name"
                    class="category-banner-img"
                />
                <div class="category-banner-overlay">
                    <div class="category-banner-content">
                        <h1 class="category-banner-title d-none d-lg-block">
                            {{ Categorie.name }}
                        </h1>
                        <p class="category-banner-subtitle">
                            Откройте для себя нашу коллекцию - элегантность и
                            комфорт в каждой детали
                        </p>
                        <div class="category-banner-divider"></div>
                        <p class="category-banner-desc d-none d-lg-block">
                            <i class="fas fa-star me-2"></i>Только качественные
                            материалы
                            <span class="mx-3">·</span>
                            <i class="fas fa-heart me-2"></i>Для вашего комфорта
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="p-4">
            <div class="container">
                <h4 class="fw-semibold mb-3">Комментарии</h4>

                <div
                    style="
                        border-bottom: 3px solid #b3446c;
                        width: 80%;
                        margin: 0 auto 24px;
                    "
                ></div>
                <div class="comment-form-wrapper mb-4" v-if="isUser">
                    <h5 class="fw-semibold mb-3">Оставить комментарий</h5>

                    <form class="comment-input-box" @submit.prevent="submit">
                        <textarea
                            v-model="content"
                            class="form-control form"
                            placeholder="Напишите ваш комментарий..."
                            rows="3"
                        ></textarea>

                        <div class="mt-3">
                            <label class="btn btn-outline mb-0">
                                <i class="fas fa-camera me-2"></i>
                                Добавить фото
                                <input
                                    ref="imagesInput"
                                    type="file"
                                    class="d-none"
                                    accept="image/*"
                                    multiple
                                    @change="handleImages"
                                />
                            </label>

                            <div
                                v-if="imagePreviews.length"
                                class="comment-previews d-flex mt-3 flex-wrap gap-2"
                            >
                                <div
                                    v-for="preview in imagePreviews"
                                    :key="preview.id"
                                    class="comment-preview-item"
                                >
                                    <img
                                        :src="preview.url"
                                        :alt="preview.name"
                                    />
                                    <span>{{ preview.name }}</span>
                                </div>
                            </div>
                        </div>

                        <div
                            class="d-flex justify-content-between align-items-center mt-3"
                        >
                            <button
                                class="btn btn-fill"
                                type="submit"
                                :disabled="sending"
                            >
                                <i class="fas fa-paper-plane me-2"></i>
                                {{ sending ? 'Отправка...' : 'Отправить' }}
                            </button>

                            <span
                                v-if="selectedImages.length"
                                class="text-muted"
                                style="font-size: 13px"
                            >
                                Выбрано {{ selectedImages.length }} из 3
                            </span>
                        </div>

                        <p
                            v-if="error"
                            class="text-danger mt-2"
                            style="font-size: 13px"
                        >
                            <i class="fas fa-exclamation-circle me-1"></i
                            >{{ error }}
                        </p>
                    </form>
                </div>

                <div v-else class="comment-auth-notice mb-4">
                    <i class="fas fa-lock me-2"></i>
                    Чтобы оставить комментарий, необходимо
                    <a
                        href=""
                        @click.prevent="regAuthPage('AuthComponent')"
                        style="color: #b3446c"
                        data-bs-toggle="modal"
                        data-bs-target="#auth"
                        >войти в аккаунт</a
                    >
                </div>
                <div class="row">
                    <CommentComponent
                        v-for="comment in comments"
                        :comment="comment"
                        :user="user"
                        :PUBLIC="PUBLIC"
                        :server="server"
                        :getComments="getComments"
                    />
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import CommentComponent from '../components/CommentComponent.vue';

export default {
    name: 'CategoriePage',
    components: { CommentComponent },
    props: ['changePage', 'CategoryId', 'server', 'isUser', 'user', 'PUBLIC'],
    data() {
        return {
            Categorie: null,
            comments: [],
            content: '',
            sending: false,
            error: null,
            regAuth: null,
            selectedImages: [],
            imagePreviews: [],
        };
    },
    mounted() {
        this.getCategory();
        this.getComments();
    },
    
    methods: {
        clearImagePreviews() {
            this.imagePreviews.forEach((preview) => {
                URL.revokeObjectURL(preview.url);
            });
            this.imagePreviews = [];
        },
        resetImagesInput() {
            if (this.$refs.imagesInput) {
                this.$refs.imagesInput.value = '';
            }
        },
        handleImages(event) {
            let files = Array.from(event.target.files || []);

            if (files.length > 3) {
                this.error = 'Можно добавить не более 3 фотографий';
                this.selectedImages = [];
                this.clearImagePreviews();
                this.resetImagesInput();
                return;
            }

            this.error = null;
            this.selectedImages = files;
            this.clearImagePreviews();
            this.imagePreviews = files.map((file) => ({
                id: `${file.name}-${file.lastModified}`,
                name: file.name,
                url: URL.createObjectURL(file),
            }));
        },
        submit() {
            if (this.selectedImages.length > 3) {
                this.error = 'Можно добавить не более 3 фотографий';
                return;
            }

            this.sending = true;
            this.error = null;

            let formData = new FormData();
            formData.append('content', this.content);
            formData.append('categorie_id', this.CategoryId);
            this.selectedImages.forEach((image) => formData.append('images[]', image));

            this.server('comments', 'POST', formData)
                .then((result) => {
                    if (result.id) {
                        this.content = '';
                        this.selectedImages = [];
                        this.clearImagePreviews();
                        this.resetImagesInput();
                        this.getComments();
                        this.$emit('submitted');
                    } else {
                        this.error = 'Не удалось отправить комментарий';
                    }
                })
                .catch(() => {
                    this.error = 'Ошибка при отправке';
                })
                .finally(() => {
                    this.sending = false;
                });
        },
        getCategory() {
            if (!this.CategoryId) return;
            this.server('category/' + this.CategoryId).then((result) => {
                this.Categorie = result;
            });
        },
        getComments() {
            this.server('comments/' + this.CategoryId).then((result) => {
                this.comments = result;
            });
        },
    },
};
</script>
