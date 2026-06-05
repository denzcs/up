<template>
    <header>
        <div class="container">
        <div class="row d-flex">
            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-start align-items-center">
                <div class="logo">
                    <a href="{{route('index')}}" class="text-reset fw-semibold fs-2">Мир цветов</a>
                </div>
            </div>
            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-end align-items-center">
                @auth
                <a class="cart" href="{{route('cart')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="42px" viewBox="0 -960 960 960" width="42px"
                        fill="#948e9e">
                        <path
                            d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
                    </svg>
                    <span class="cartCount">

                        {{ count(Auth::User()->carts) }}
                    </span>

                </a>
                <div class="userbar">
                    <div class="userbtn">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                                <path
                                    d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                            </svg></span>
                        <span class="drop-username fw-semibold">{{Auth::user()->name}}</span>
                        <span class="droparrow">▼</span>
                    </div>
                    <div class="dropdown-usermenu d-flex flex-column justify-content-around">
                        <a href="{{route('userProfile')}}"
                            class="fs-6 fw-semibold text-reset dropdown-usermenu-item">Личный кабинет</a>
                        @if(Auth::user()->role=='admin')
                        <a href="{{ route('adminPanel') }}" class="fs-6 fw-semibold text-reset dropdown-usermenu-item">Админ
                            панель</a>
                        @endif
                        <a href="{{ route('logout') }}" class="fs-6 fw-semibold text-reset dropdown-usermenu-item">Выйти</a>
                    </div>
                </div>
                @else
                <!-- для не авторизированного -->
                <a href="" role="button" class="btn-outline fw-semibold mb-1 mb-lg-0 " data-bs-toggle="modal"
                    data-bs-target='#auth'>Авторизация</a>
                <a href="#reg" role="button" class="btn-fill fw-semibold" data-bs-toggle="modal"
                    data-bs-target='#reg'>Регистрация</a>
                @endauth
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
                                <h3 class="text-center">Авторизация</h3>
                                <form action="{{ route('authform') }}" method="post">
                                    @csrf
                                    <label for="username1">Логин</label>
                                    <input type="text" class="form-control mb-3" name="username1">
                                    @error('username1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="password1">Пароль</label>
                                    <input type="text" class="form-control mb-3" name="password1">
                                    @error('password1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="submit" class="btn btn-outline-dark" value="Войти">
                                </form>
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
