<template>
    <section class="text-center">
        <h1 class="fw-bold fs-1">Сборник рецептов</h1>
        <h2 class="fw-bold fs-1">"RecipeLib"</h2>
    </section>
    <div class="mainContent">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <span class="text-reset fs-3 fw-bold">Категории</span>
                </div>
            </div>
            <div class="row d-flex justify-content-center-lg text-center">
                <div class="col-lg-3 col-md-4 col-6 fw-bold fs-4 mb-5">
                    <a href="" class="category-card">Все товары</a>
                </div>

                <div class="col-lg-3 col-md-4 col-6 fw-bold fs-4 mb-5">
                    <a href="" class="category-card">$categorie -> category</a>
                </div>
            </div>
            <div class="row mb-5">
                <div
                    class="col-12 d-flex align-items-center justify-content-center mb-5"
                >
                    <span class="fs-3 fw-bold"> </span>
                    <span class="product-count fw-bold">{{}}</span>
                </div>
                <div class="col-12 text-break">
                    <form action="sortBy" method="get">
                        <div class="filters d-flex justify-content-around">
                            <a href="" class="text-reset filter"
                                ><span>Цена (по возрастанию)</span>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-filter-2-down"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    />
                                    <path d="M4 6h16" />
                                    <path d="M6 12h12" />
                                    <path d="M9 18h3" />
                                    <path d="M19 16v6" />
                                    <path d="M19 22l3 -3" />
                                    <path d="M19 22l-3 -3" />
                                </svg>
                            </a>
                            <a href="" class="text-reset filter"
                                ><span>Цена (по убыванию)</span>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-filter-2-up"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    />
                                    <path d="M4 6h16" />
                                    <path d="M6 12h12" />
                                    <path d="M9 18h3" />
                                    <path d="M19 22v-6m0 0l3 3m-3 -3l-3 3" />
                                </svg>
                            </a>
                            <a href="" class="text-reset filter"
                                ><span>Новые</span>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-sort-ascending"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    />
                                    <path d="M4 6l7 0" />
                                    <path d="M4 12l7 0" />
                                    <path d="M4 18l9 0" />
                                    <path d="M15 9l3 -3l3 3" />
                                    <path d="M18 6l0 12" />
                                </svg>
                            </a>
                            <a href="" class="text-reset filter"
                                ><span>Старые</span>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-sort-descending"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    />
                                    <path d="M4 6l9 0" />
                                    <path d="M4 12l7 0" />
                                    <path d="M4 18l7 0" />
                                    <path d="M15 15l3 3l3 -3" />
                                    <path d="M18 6l0 12" />
                                </svg>
                            </a>
                            <a href="" class="text-reset filter"
                                ><span>Наименование</span>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-sort-ascending-letters"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    />
                                    <path
                                        d="M15 10v-5c0 -1.38 .62 -2 2 -2s2 .62 2 2v5m0 -3h-4"
                                    />
                                    <path d="M19 21h-4l4 -7h-4" />
                                    <path d="M4 15l3 3l3 -3" />
                                    <path d="M7 6v12" />
                                </svg>
                            </a>
                            <a href="" class="text-reset filter"
                                ><span>Наименование</span>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-sort-descending-letters"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    />
                                    <path
                                        d="M15 21v-5c0 -1.38 .62 -2 2 -2s2 .62 2 2v5m0 -3h-4"
                                    />
                                    <path d="M19 10h-4l4 -7h-4" />
                                    <path d="M4 15l3 3l3 -3" />
                                    <path d="M7 6v12" />
                                </svg>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 col-lg-4 col-12 mb-3" v-for="recipe in recipes">
                    <a href="" class="cardcol" >
                        <div class="card">
                            <img
                                :src="PUBLIC + recipe.photo"
                                class="card-img-top object-fit-fill"
                                alt="..."
                            />

                            <div class="card-body text-center">
                                <div class="title mb-4">
                                    <div class="d-flex flex-column">
                                        <h4
                                            class="fw-bold text-break text-reset text-start"
                                        >
                                            {{ recipe.title }}
                                        </h4>
                                        <div
                                            class="d-flex align-items-centerjustify-content-between"
                                        >
                                            <div class="product-category">
                                                <span class="fw-semibold">
                                                    {{ recipe.difficulty }}
                                                </span>
                                            </div>
                                            <div class="product-category">
                                                <span class="fw-semibold">
                                                    {{ recipe.cook_time }} мин.
                                                </span>
                                            </div>
                                            <div class="product-category">
                                                <span class="fw-semibold">
                                                    {{ recipe.category.name }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button href="" class="btn-fill fw-semibold""
                                    >Смотреть рецепт</button
                                >
                            </div>
                        </div>
                        
                    </a>
                </div>
            </div>
            <div class="d-flex align-items-cente justify-content-center">
                <a class="btn btn-outline fs-5" style="margin-right: 10px; padding: 5px;" v-if="page > 1" href="#" @click.prevent="getRecipes(page - 1)"><<< Предыдущая страница</a>
                <a class="btn btn-outline fs-5" style="margin-left: 10px; padding: 5px;" v-if="page < last_page" href="#" @click.prevent="getRecipes(page + 1)">Следущая страница >>></a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'HomePage',
    data() {
        return {
            recipes: {},
            categories: [],
            selectCategories: [],
            selectTime: '',
            selectDif: '',
            serch: '',
            sort: {
                field: 'created_at',
                by: 'desc',
            },
            sortOptions: [
                { text: 'От новых к старым', field: 'created_at', by: 'desc' },
                { text: 'От старых к новым', field: 'created_at', by: 'asc' },
                {
                    text: 'Время готовки по возрастанию',
                    field: 'cook_time',
                    by: 'asc',
                },
                {
                    text: 'Время готовки по убыванию',
                    field: 'cook_time',
                    by: 'desc',
                },
            ],
            isfilter: false,
            selectSort: 0,
            page: 1,
            last_page: 1,
        };
    },
    props: ['changePage', 'server', 'user', 'PUBLIC'],
    components: {},
    mounted() {
        this.getRecipes();
        this.getCategories();
    },
    methods: {
        getRecipes(page = 1) {
            let formdata = new FormData();
            formdata.append('sort', JSON.stringify(this.sort));
            if (this.isfilter) {
                if (this.checkedCategories.length > 0) {
                    formdata.append(
                        'categories',
                        JSON.stringify(this.selectCategories),
                    );
                }
                if (this.selectDif) {
                    formdata.append('difficulty', this.selectDif);
                }
                if (this.selectTime) {
                    formdata.append('checkedTime', this.selectTime);
                }
                if (this.search) {
                    formdata.append('search', this.search);
                }
            }
            this.server('recipes?page=' + page, 'POST', formdata)
                .then((result) => {
                    this.recipes = result.data;
                    console.log(this.recipes);
                    this.page = result.current_page;
                    this.last_page = result.last_page;
                })
                .catch((error) => console.log('error', error));
        },
        getCategories() {
            this.server('category').then((result) => {
                this.categories = result;
            });
        },
        changeSort(event) {
            this.sort.field = this.sortOptions[event.target.value].field;
            this.sort.by = this.sortOptions[event.target.value].by;
            this.getRecipes();
        },
        filterOn() {
            if (this.isUser) {
                this.isfilter = true;
                this.getRecipes();
            } else {
                alert('Зарегистрируйтесь что бы использовать фильтры');
            }
        },
    },
};
</script>
