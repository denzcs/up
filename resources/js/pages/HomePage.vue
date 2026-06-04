<template>
    <section class="p-2">
        <h3 class="m-5 text-center">Категории товаров</h3>
        <div class="container">
            <div class="row text-center">
                <div
                    class="col-lg-6 col-12 fs-5 fw-semibold d-flex flex-column align-items-center"
                >
                    <a
                        href=""
                        @click.prevent="changePage('CategoriePage', 1)"
                        style="color: #b3446c"
                    >
                        <img
                            class="mb-3"
                            src="https://www.siluet-classic.ru/upload/iblock/800/38e1nusb162ljf58spubdpu0fygzrtji/Siluet_4_Big_2.jpg"
                            width="200"
                            alt="Бюстгалтеры"
                        />
                        <p>Бюстгалтеры</p>
                    </a>
                </div>
                <div
                    class="col-lg-6 col-12 fs-5 fw-semibold d-flex flex-column align-items-center"
                >
                    <a
                        href=""
                        @click.prevent="changePage('CategoriePage', 2)"
                        style="color: #b3446c"
                    >
                        <img
                            class="mb-3"
                            src="https://www.siluet-classic.ru/upload/iblock/559/euiderueljwmlrvt61jpfucj4tx0ki5r/Siluet_3_Big_2.jpg"
                            width="200"
                            alt="Трусы"
                        />
                        <p>Трусы</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="p-0-lg p-5">
        <h4 class="m-5-lg m-0 p-3 p-0 mb-3">Последние комментарии</h4>
        <div class="container">
            <div class="row">
                <div
                    class="col-12 mb-3"
                    style="
                        border-bottom: 3px solid #b3446c;
                        width: 80%;
                        margin: 0 auto;
                    "
                ></div>
                <CommentComponent v-for="comment in comments" :comment="comment" :user="user" :PUBLIC="PUBLIC" :server="server" :getComments="getComments" />
            </div>
        </div>
    </section>
</template>
<script>
import { comments } from '@/actions/App/Http/Controllers/AdminController';
import CommentComponent from '../components/CommentComponent.vue';
export default {
    name: 'HomePage',
    data() {
        return {
            comments: [],
        };
    },
    props: ['changePage', 'server' ,'user', 'PUBLIC'],
    components: {
        CommentComponent,
    },
    mounted() {
        this.getComments();
    },
    methods: {
        getComments() {
            this.server('comments').then((result) => {
                this.comments = result;
                console.log(result);
            });
        },
        // getUsers() {
        //     this.server('users').then((result) => {
        //         this.users = Array.isArray(result) ? result : [];
        //     }).finally(() => { this.loading = false; });
        // },
    },
};
</script>