<template>
    <div class="register-card">
        <h3 class="register-title">Регистрация</h3>

        <div class="register-row">
            <div class="register-group">
                <label for="fullname">ФИО</label>
                <input
                    id="fullname"
                    type="text"
                    class="form-control"
                    placeholder="Введите ФИО"
                    v-model="fullname"
                />
                <p class="red" v-if="errors.fullname">{{ errors.fullname.join('. ') }}</p>
            </div>

            <div class="register-avatar-block">
                <input
                    type="file"
                    name="avatar"
                    id="avatar"
                    hidden
                    @change="handleAvatarChange"
                />
                <label for="avatar" class="upload-avatar-btn register-avatar-btn">
                    <img
                        v-if="avatarPreview"
                        class="register-avatar-preview"
                        :src="avatarPreview"
                        alt="Аватар"
                    />
                    <div v-else class="register-avatar-placeholder">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="28"
                            height="28"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="icon icon-tabler icons-tabler-filled icon-tabler-user"
                        >
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z"
                            />
                            <path
                                d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z"
                            />
                        </svg>
                        <span>Загрузить аватар</span>
                    </div>
                </label>
                <p class="red" v-if="errors.avatar">{{ errors.avatar.join('. ') }}</p>
            </div>
        </div>

        <div class="register-group">
            <label for="username">Логин</label>
            <input
                id="username"
                type="text"
                class="form-control"
                placeholder="Придумайте логин"
                v-model="username"
            />
            <p class="red" v-if="errors.username">{{ errors.username.join('. ') }}</p>
        </div>

        <div class="register-group">
            <label for="password">Пароль</label>
            <input
                id="password"
                type="password"
                class="form-control"
                placeholder="Минимум 8 символов"
                v-model="password"
                autocomplete="new-password"
            />
            <p class="red" v-if="errors.password">{{ errors.password.join('. ') }}</p>
        </div>

        <div class="register-group">
            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                class="form-control"
                placeholder="email@example.com"
                v-model="email"
            />
            <p class="red" v-if="errors.email">{{ errors.email.join('. ') }}</p>
        </div>

        <div class="register-group">
            <label for="phone">Номер телефона</label>
            <input
                id="phone"
                type="tel"
                class="form-control"
                placeholder="+7(999)-999-99-99"
                v-model="phone"
                @input="formatPhone"
                maxlength="18"
                pattern="\+7\(\d{3}\)-\d{3}-\d{2}-\d{2}"
            />
            <small class="field-hint">Формат: +7(XXX)-XXX-XX-XX</small>
            <p class="red" v-if="errors.phone">{{ errors.phone.join('. ') }}</p>
        </div>

        <button type="button" @click="register()" class="btn btn-outline register-submit">
            Зарегистрироваться
        </button>
    </div>
</template>
<script>
export default {
    name: 'RegisterComponent',
    data() {
        return {
            avatarFile: null,
            avatarPreview: null,
            fullname: null,
            username: null,
            password: null,
            email: null,
            phone: null,
            errors: {},
        };
    },
    props: ['server', 'successUser'],
    methods: {
        handleAvatarChange(event) {
            let file = event.target.files[0];

            if (file) {
                this.avatarFile = file;
                this.avatarPreview = URL.createObjectURL(file);
            }
        },
        formatPhone(event) {
            let value = event.target.value || '';
            let digits = value.replace(/\D/g, '');

            if (!digits) {
                this.phone = '';
                return;
            }

            if (digits[0] === '8') {
                digits = '7' + digits.slice(1);
            }

            if (digits[0] !== '7') {
                digits = '7' + digits;
            }

            digits = digits.slice(0, 11);

            let formatted = '+7';
            if (digits.length > 1) {
                formatted += '(' + digits.slice(1, Math.min(4, digits.length));
            }
            if (digits.length >= 4) {
                formatted += ')';
            }
            if (digits.length > 4) {
                formatted += '-' + digits.slice(4, Math.min(7, digits.length));
            }
            if (digits.length > 7) {
                formatted += '-' + digits.slice(7, Math.min(9, digits.length));
            }
            if (digits.length > 9) {
                formatted += '-' + digits.slice(9, 11);
            }

            this.phone = formatted;
        },
        register() {
            let formdata = new FormData();

            formdata.append('fullname', this.fullname || '');
            formdata.append('username', this.username || '');
            formdata.append('email', this.email || '');
            formdata.append('password', this.password || '');
            formdata.append('phone', this.phone || '');

            if (this.avatarFile) {
                formdata.append('avatar', this.avatarFile);
            }

            this.server('register', 'POST', formdata)
                .then((result) => {
                    this.errors = result.errors || {};
                    if (result.token) {
                        this.successUser(result.token);
                    }
                });
        },
    },
};
</script>
