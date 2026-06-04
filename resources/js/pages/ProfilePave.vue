<template>
    <div>
        <section class="p-4">
            <div class="container">
                <div class="d-flex align-items-center mb-4">
                    <div class="category-hero-icon me-4">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0" style="color: #b3446c">
                            Личный кабинет
                        </h2>
                        <span class="text-muted" style="font-size: 13px"
                            >Управление профилем</span
                        >
                    </div>
                </div>
                <div style="border-bottom: 3px solid #b3446c"></div>
            </div>
        </section>

        <section class="p-4 pt-0" v-if="user">
            <div class="container">
                <div class="profile-card mb-4">
                    <div class="d-flex align-items-center flex-wrap gap-4">
                        <div class="avatar-wrapper">
                            <img
                                :src="
                                    user.avatar
                                        ? PUBLIC + user.avatar
                                        : 'https://via.placeholder.com/100x100?text=Фото'
                                "
                                width="100"
                                height="100"
                                class="rounded-circle avatar-img"
                                style="
                                    object-fit: cover;
                                    border: 3px solid #b3446c;
                                "
                            />
                            <label
                                class="upload-avatar-btn mt-2"
                                title="Загрузить аватар"
                            >
                                <i class="fas fa-camera"></i>
                                <input
                                    type="file"
                                    accept="image/*"
                                    @change="uploadAvatar"
                                    hidden
                                />
                            </label>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">{{ user.fullname }}</h4>
                            <span class="text-muted">@{{ user.username }}</span>
                            <div class="mt-2">
                                <span
                                    class="user-role-badge"
                                    v-if="user.role === 'admin'"
                                >
                                    <i class="fas fa-shield-alt me-1"></i
                                    >Администратор
                                </span>
                                <span class="user-role-badge user" v-else>
                                    <i class="fas fa-user me-1"></i>Пользователь
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-card mb-4">
                    <h5 class="fw-semibold mb-3">
                        <i class="fas fa-edit me-2" style="color: #b3446c"></i
                        >Личные данные
                    </h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <label
                                class="form-label text-muted"
                                style="font-size: 13px"
                                >ФИО</label
                            >
                            <input
                                v-model="form.fullname"
                                type="text"
                                class="form-control form"
                                placeholder="Введите ФИО"
                            />
                            <p class="red" v-if="errors.fullname">
                                {{ errors.fullname.join('. ') }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label
                                class="form-label text-muted"
                                style="font-size: 13px"
                                >Номер телефона</label
                            >
                            <input
                                v-model="form.phone"
                                type="tel"
                                class="form-control form"
                                placeholder="+7(999)-999-99-99"
                                @input="formatPhone"
                                maxlength="18"
                            />
                            <p class="red" v-if="errors.phone">
                                {{ errors.phone.join('. ') }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label
                                class="form-label text-muted"
                                style="font-size: 13px"
                                >Email</label
                            >
                            <input
                                v-model="form.email"
                                type="email"
                                class="form-control form"
                                placeholder="email@example.com"
                            />
                            <p class="red" v-if="errors.email">
                                {{ errors.email.join('. ') }}
                            </p>
                        </div>
                        <div class="col-12">
                            <button
                                class="btn btn-fill"
                                @click="saveProfile"
                                :disabled="saving"
                            >
                                <i class="fas fa-save me-2"></i>
                                {{
                                    saving
                                        ? 'Сохранение...'
                                        : 'Сохранить изменения'
                                }}
                            </button>
                        </div>
                        <div v-if="errors.general" class="mt-2">
                            <p class="text-danger" style="font-size: 13px">
                                {{ errors.general.join('. ') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="profile-card mb-4">
                    <h5 class="fw-semibold mb-3">
                        <i class="fas fa-tag me-2" style="color: #b3446c"></i
                        >Полученные услуги
                    </h5>
                    <div
                        v-if="user.services && user.services.length"
                        class="mb-3"
                    >
                        <div
                            v-for="service in user.services"
                            :key="service.id"
                            class="service-item d-flex justify-content-between align-items-center"
                        >
                            <div>
                                <span class="category-badge me-2">{{
                                    service.categorie?.name
                                }}</span>
                                <span
                                    class="text-muted"
                                    style="font-size: 13px"
                                >
                                    <i class="fas fa-calendar me-1"></i
                                    >{{ formatDate(service.received_at) }}
                                </span>
                            </div>
                            <button
                                class="btn-danger-outline"
                                @click="removeService(service.id)"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p v-else class="text-muted" style="font-size: 14px">
                        Услуги ещё не добавлены
                    </p>
                    <div class="add-service-form">
                        <h6 class="fw-semibold mb-2" style="font-size: 14px">
                            Добавить услугу
                        </h6>
                        <div class="row g-2 align-items-end">
                            <div class="col-md-5">
                                <label
                                    class="form-label text-muted"
                                    style="font-size: 12px"
                                    >Категория</label
                                >
                                <select
                                    v-model="newService.categorie_id"
                                    class="form-control form"
                                >
                                    <option value="" disabled>
                                        Выберите категорию
                                    </option>
                                    <option
                                        v-for="cat in categories"
                                        :key="cat.id"
                                        :value="cat.id"
                                    >
                                        {{ cat.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label
                                    class="form-label text-muted"
                                    style="font-size: 12px"
                                    >Дата получения</label
                                >
                                <input
                                    v-model="newService.received_at"
                                    type="date"
                                    class="form-control form"
                                />
                            </div>
                            <div class="col-md-2">
                                <button
                                    class="btn btn-fill w-100"
                                    @click="addService"
                                    :disabled="
                                        !newService.categorie_id ||
                                        !newService.received_at
                                    "
                                >
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div v-else class="py-5 text-center">
            <div class="spinner-border" style="color: #b3446c"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProfilePage',
    props: ['server', 'PUBLIC', 'changePage'],
    data() {
        return {
            user: null,
            categories: [],
            form: { fullname: '', phone: '', email: '' },
            newService: { categorie_id: '', received_at: '' },
            saving: false,
            errors: {},
        };
    },
    mounted() {
        this.getProfile();
        this.getCategories();
    },
    methods: {
        getProfile() {
            this.server('profile').then((result) => {
                this.user = result;
                this.form.fullname = result.fullname;
                this.form.phone = result.phone;
                this.form.email = result.email;
            });
        },
        getCategories() {
            this.server('categories').then((result) => {
                this.categories = Array.isArray(result) ? result : [];
            });
        },
        saveProfile() {
            this.saving = true;
            this.errors = {};

            let formData = new FormData();
            formData.append('fullname', this.form.fullname);
            formData.append('phone', this.form.phone);
            formData.append('email', this.form.email);

            this.server('profile/update', 'POST', formData).then((result) => {
                this.saving = false;
                if (result.errors) {
                    this.errors = result.errors;
                } else {
                    this.user.fullname = result.fullname;
                    this.user.phone = result.phone;
                    this.user.email = result.email;
                }
            });
        },
        uploadAvatar(event) {
            let file = event.target.files[0];
            let formData = new FormData();
            formData.append('avatar', file);
            this.server('profile/avatar', 'POST', formData).then((result) => {
                this.user.avatar = result.avatar;
            });
        },
        addService() {
            let formData = new FormData();
            formData.append('categorie_id', this.newService.categorie_id);
            formData.append('received_at', this.newService.received_at);
            this.server('profile/services', 'POST', formData).then((result) => {
                if (result.id) {
                    this.user.services.push(result);
                    this.newService = { categorie_id: '', received_at: '' };
                }
            });
        },
        removeService(id) {
            this.server('profile/services/' + id, 'DELETE').then(() => {
                this.user.services = this.user.services.filter(
                    (s) => s.id !== id,
                );
            });
        },
        formatPhone(event) {
            let val = event.target.value.replace(/\D/g, '');

            if (val.startsWith('8')) val = '7' + val.slice(1);
            if (!val.startsWith('7')) val = '7' + val;
            val = val.slice(0, 11);

            let res = '+7';
            if (val.length > 1) res += '(' + val.slice(1, 4);
            if (val.length >= 4) res += ')';
            if (val.length > 4) res += '-' + val.slice(4, 7);
            if (val.length > 7) res += '-' + val.slice(7, 9);
            if (val.length > 9) res += '-' + val.slice(9, 11);

            this.form.phone = res;
        },
        formatDate(date) {
            if (!date) return '';
            let d = new Date(date);
            return d.toLocaleDateString('ru-RU');
        },
    },
};
</script>
