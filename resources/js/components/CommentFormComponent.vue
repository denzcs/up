<template>
    <div class="comment-form-wrapper mb-4" v-if="isUser">
        <h5 class="fw-semibold mb-3">Оставить комментарий</h5>

        <form class="comment-input-box">
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
                        <img :src="preview.url" :alt="preview.name" />
                        <span>{{ preview.name }}</span>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <button @click="submit" class="btn btn-fill" type="submit" :disabled="sending">
                    <i class="fas fa-paper-plane me-2"></i>
                    Отправить
                </button>

                <span
                    v-if="selectedImages.length"
                    class="text-muted"
                    style="font-size: 13px"
                >
                    Выбрано {{ selectedImages.length }} из 3
                </span>
            </div>

            <p v-if="error" class="text-danger mt-2" style="font-size: 13px">
                <i class="fas fa-exclamation-circle me-1"></i>{{ error }}
            </p>
        </form>
    </div>

    <div v-else class="comment-auth-notice mb-4">
        <i class="fas fa-lock me-2"></i>
        Чтобы оставить комментарий, необходимо
        <a
            href=""
            
            style="color: #b3446c"
            
            >войти в аккаунт</a
        >
    </div>
</template>

<script>
export default {
    name: 'CommentForm',
    props: ['server', 'CategoryId', 'isUser', 'changePage'],
    data() {
        return {
            content: '',
            sending: false,
            error: null,
            regAuth: null,
            selectedImages: [],
            imagePreviews: [],
        };
    },
    beforeUnmount() {
        this.clearImagePreviews();
    },
    methods: {
        regAuthPage(page) {
            this.regAuth = page;
        },
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
            } else {
                this.error = null;
                this.selectedImages = files;
                this.clearImagePreviews();
                this.imagePreviews = files.map((file) => ({
                    id: `${file.name}-${file.lastModified}`,
                    name: file.name,
                    url: URL.createObjectURL(file),
                }));
            }
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
            this.selectedImages.forEach((image) =>
                formData.append('images[]', image),
            );

            this.server('comments', 'POST', formData)
                .then((result) => {
                    if (result.id) {
                        this.content = '';
                        this.selectedImages = [];
                        this.clearImagePreviews();
                        this.resetImagesInput();
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
    },
};
</script>
