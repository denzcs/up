<template>
    <div class="main-content">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="profile-banner d-flex">
                        <div class="avatar">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="136"
                                height="136"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                class="icon icon-tabler icons-tabler-filled icon-tabler-user"
                            >
                                <path
                                    stroke="none"
                                    d="M0 0h24v24H0z"
                                    fill="none"
                                />
                                <path
                                    d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z"
                                />
                                <path
                                    d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z"
                                />
                            </svg>
                        </div>
                        <div class="profile-content d-flex flex-column">
                            <div
                                class="profile-content-title d-flex flex-column mb-3"
                            >
                                <h2 class="fw-bold text-break">
                                    {{ this.user.name }}
                                </h2>
                                <div class="user-role justify-self-start">
                                    <span class="fw-bold">{{
                                        this.user.role
                                    }}</span>
                                </div>
                            </div>

                            <p class="email fw-semibold text-break">
                                {{ this.user.email }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-4 mb-lg-0 mb-5">
                    <div class="colform mb-5">
                        <div class="profile-title mb-3">
                            <span class="fs-3 fw-semibold">Ваш профиль</span>
                        </div>
                        <div class="profile-content">
                            <div class="profile-content-title mb-3">
                                <span class="fs-4 fw-semibold mb-3"
                                    >Основная информация</span
                                >
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label
                                            for="username"
                                            class="fw-semibold"
                                            >Имя пользователя</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control fw"
                                            id="username"
                                            style="width: 70%"
                                            disabled
                                            :placeholder="this.user.name"
                                        />
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label
                                            for="username"
                                            class="fw-semibold"
                                            >Email</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control fw"
                                            id="username"
                                            style="width: 70%"
                                            disabled
                                            :placeholder="this.user.email"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="colform justify-self-start">
                        <div class="cartstatistic">
                            <div class="cartstatistic-title mb-3">
                                <span class="fw-bold fs-4">Избранное</span>
                            </div>
                            <div class="row mb-3">
                                <h2 class="mb-3 text-center">
                                    {{
                                        favorites.length
                                            ? 'Рецепты'
                                            : 'Рецепты не найдены'
                                    }}
                                </h2>
                                <div
                                    class="col-md-6 col-lg-4 col-12 mb-3"
                                    v-for="recipe in favorites"
                                >
                                    <a
                                        href=""
                                        @click.prevent="
                                            changePage(
                                                'RecipePage',
                                                recipe.recipe?.id,
                                            )
                                        "
                                        class="cardcol"
                                    >
                                        <div class="card">
                                            <img
                                                :src="
                                                    PUBLIC +
                                                    recipe.recipe?.photo
                                                "
                                                style="
                                                    width: 500px;
                                                    height: auto;
                                                "
                                                class="card-img-top object-fit-fill"
                                                alt="..."
                                            />

                                            <div class="card-body text-center">
                                                <div class="title mb-4">
                                                    <div
                                                        class="d-flex flex-column"
                                                    >
                                                        <h4
                                                            class="fw-bold text-break text-reset text-start"
                                                        >
                                                            {{
                                                                recipe.recipe
                                                                    ?.title
                                                            }}
                                                        </h4>
                                                        <div
                                                            class="d-flex align-items-centerjustify-content-between"
                                                        >
                                                            <div
                                                                class="product-category"
                                                            >
                                                                <span
                                                                    class="fw-semibold"
                                                                >
                                                                    {{
                                                                        recipe
                                                                            .recipe
                                                                            ?.difficulty
                                                                    }}
                                                                </span>
                                                            </div>
                                                            <div
                                                                class="product-category"
                                                            >
                                                                <span
                                                                    class="fw-semibold"
                                                                >
                                                                    {{
                                                                        recipe
                                                                            .recipe
                                                                            ?.cook_time
                                                                    }}
                                                                    мин.
                                                                </span>
                                                            </div>
                                                            <div
                                                                class="product-category"
                                                            >
                                                                <span
                                                                    class="fw-semibold"
                                                                >
                                                                    {{
                                                                        recipe
                                                                            .recipe
                                                                            ?.category
                                                                            ?.name
                                                                    }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button
                                                    @click="
                                                        changePage(
                                                            'RecipePage',
                                                            recipe.recipe?.id,
                                                        )
                                                    "
                                                    class="btn-fill fw-semibold"
                                                >
                                                    Смотреть рецепт
                                                </button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-cente justify-content-center"
                            >
                                <a
                                    class="btn btn-outline fs-5 m-2"
                                    v-if="page > 1"
                                    href="#"
                                    @click.prevent="favoritesUser(page - 1)"
                                    ><<< Предыдущая страница</a
                                >
                                <a
                                    class="btn btn-outline fs-5 m-2"
                                    v-if="page < last_page"
                                    href="#"
                                    @click.prevent="favoritesUser(page + 1)"
                                    >Следущая страница >>></a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'UserPage',
    data() {
        return {
            favorites: {
                data: [],
                current_page: 1,
                last_page: 1,
            },
            category: null,
            errors: {},
            recipe: {
                photo: null,
                title: null,
            },
            page: 1,
            last_page: 1,
        };
    },
    props: ['changePage', 'server', 'user', 'PUBLIC'],
    components: {},
    mounted() {
        this.favoritesUser();
    },
    methods: {
        favoritesUser(page = 1) {
            let formdata = new FormData();
            this.server('favoritesUser?page=' + page, 'GET', formdata)
                .then((result) => {
                    this.favorites = result.data;
                    this.page = result.current_page;
                    this.last_page = result.last_page;
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
