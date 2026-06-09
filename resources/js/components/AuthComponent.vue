<template>
    <h3 class="text-center">Авторизация</h3>
    <label for="email">Email</label>
    <input
        type="text"
        class="form-control mb-3"
        name="email"
        placeholder="email@example.com"
        v-model="email"
    />
    <p class="red" v-if="errors.email">
        {{ errors.email.join('. ') }}
    </p>
    <label for="password">Пароль</label>
    <input
        type="password"
        class="form-control mb-3"
        name="password"
        v-model="password"
    />
    <p class="red" v-if="errors.password">
        {{ errors.password.join('. ') }}
    </p>
    <input type="submit" class="btn btn-outline-dark" @click="login()" value="Войти" />
</template>
<script>
export default {
    name: 'AuthComponent',
    data() {
        return {
            email: null,
            password: null,
            errors: {},
        };
    },
    props: ['server', 'successUser'],
    methods: {
        login() {
            let formdata = new FormData();
            if (this.email) formdata.append('email', this.email);
            if (this.password) formdata.append('password', this.password);

            this.server('login', 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    }
                    if (result.token) {
                        this.successUser(result.token);
                    }
                });
        },
    },
};
</script>
