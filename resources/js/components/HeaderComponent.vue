<template>
    <header>
        <div class="container header">
            <div class="row d-flex justify-content-lg-between justify-content-center">
                <div class="col-lg-3 col-12 mb-lg-0 mb-3 text-center text-lg-start">
                    <a href="" @click.prevent="changePage('HomePage')" class="fs-1 text-decoration-none" style="color: #67B7DF;">CookHelper</a>
                </div>
                
                <div class="col-lg-3 col-12 d-flex justify-content-center justify-content-lg-end align-items-center">
                    <div class="userbar" v-if="isUser">
                        <div class="userbtn">
                            <span>
                                
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                                    <path
                                        d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                                </svg>
                            </span>
                            <span class="drop-username fw-semibold">{{ this.user.name }}</span>
                            <span class="droparrow">▼</span>
                        </div>
                        <div class="dropdown-usermenu d-flex flex-column justify-content-around">
                            <a href="" @click.prevent="changePage('UserPage')"
                                class="fs-6 fw-semibold dropdown-usermenu-item">Личный кабинет</a>
                            <a href="" v-if="this.user.role == 'admin'" @click.prevent="changePage('AdminPage')" class="fs-6 fw-semibold dropdown-usermenu-item">Админ
                                панель</a>
                            <a href="" @click.prevent="logout()" class="fs-6 fw-semibold dropdown-usermenu-item">Выйти</a>
                        </div>
                    </div>
                    <div class="d-flex" v-if="!isUser">
                        <a href="" role="button" class="btn btn-outline fw-semibold mb-1 mb-lg-0 " data-bs-toggle="modal"
                        data-bs-target='#auth' @click.prevent="regAuthPage('AuthComponent')">Авторизация</a>
                        <a href="" role="button" class="btn btn-fill fw-semibold" data-bs-toggle="modal"
                        data-bs-target='#auth' @click.prevent="regAuthPage('RegisterComponent')">Регистрация</a>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="modal fade" id="auth" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row d-flex justify-content-between">
                                <div class="col-12">
                                    <AuthComponent v-if="regAuth == 'AuthComponent'" :server="server" :successUser="successUser"/>
                                    <RegisterComponent v-if="regAuth == 'RegisterComponent'" :server="server" :successUser="successUser" getUser="getUser"/>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
</template>
<script>
import AuthComponent from './AuthComponent.vue';
import RegisterComponent from './RegisterComponent.vue';


export default {
    name: 'HeaderComponent',
    data() {
        return {
            regAuth: null,
        }
    },
    props: ['server', 'isUser', 'successUser', 'changePage', 'logout', 'PUBLIC', 'user'],
    components: {
        RegisterComponent,
        AuthComponent,
    },
    methods: {
        regAuthPage(page){
            this.regAuth = page;
        },
    },
    

};
</script>
