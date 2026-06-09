<template>
    <div class="register-card">
        <h3 class="register-title">Регистрация</h3>

        <div class="register-row">
            <label for="name">Имя</label>
            <input
                id="name"
                type="text"
                class="form-control"
                placeholder="Имя"
                v-model="name"
            />
            <p class="red" v-if="errors.name">
                {{ errors.name.join('. ') }}
            </p>
        </div>

        <label for="password">Пароль</label>
        <input
            id="password"
            type="password"
            class="form-control"
            placeholder="Минимум 8 символов"
            v-model="password"
        />
        <p class="red" v-if="errors.password">
            {{ errors.password.join('. ') }}
        </p>

        <label for="email">Email</label>
        <input
            id="email"
            type="email"
            class="form-control"
            placeholder="email@example.com"
            v-model="email"
        />
        <p class="red" v-if="errors.email">{{ errors.email.join('. ') }}</p>

        <button
            type="button"
            @click="register()"
            class="btn btn-outline register-submit"
        >
            Зарегистрироваться
        </button>
    </div>
</template>
<script>
export default {
    name: 'RegisterComponent',
    data() {
        return {
            name: null,
            password: null,
            email: null,
            errors: {},
        };
    },
    props: ['server', 'successUser'],
    methods: {
        register() {
            let formdata = new FormData();

            formdata.append('name', this.name || '');
            formdata.append('email', this.email || '');
            formdata.append('password', this.password || '');
            this.server('register', 'POST', formdata).then((result) => {
                this.errors = result.errors || {};
                if (result.token) {
                    this.successUser(result.token);
                }
            });
        },
    },
};
</script>
