<template>
    <section class="text-center">
        <h1 class="fw-bold fs-1">Сборник рецептов</h1>
        <h2 class="fw-bold fs-1">"RecipeLib"</h2>
    </section>
    <div class="mainContent">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="filter-panel p-md-4 p-3">
                        <p class="filter-title">Сортировка и фильтры</p>
                        <div class="d-flex flex-column flex-sm-row mb-4 gap-5">
                            <select
                                v-model="selectSort"
                                @change="changeSort"
                                class="form-select filter-select"
                            >
                                <option
                                    v-for="(sort, key) in sortOptions"
                                    :value="key"
                                >
                                    {{ sort.text }}
                                </option>
                            </select>

                            <div class="d-flex gap-2">
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="search"
                                    placeholder="Поиск рецепта"
                                />
                                <button
                                    @click="getRecipes(1, true)"
                                    type="button"
                                    class="btn btn-fill"
                                >
                                    Найти
                                </button>
                            </div>
                        </div>

                        <div class="row g-3 border-top pt-3">
                            <div class="col-12 col-sm-4 col-md-3">
                                <p class="filter-group-label">Категория</p>
                                <div
                                    v-for="category in categories"
                                    :key="category.id"
                                    class="filter-option"
                                >
                                    <input
                                        v-model="selectCategories"
                                        :value="category.id"
                                        type="checkbox"
                                        :id="category.id"
                                        class="filter-input"
                                    />
                                    <label
                                        :for="category.id"
                                        class="filter-label"
                                        >{{ category.name }}</label
                                    >
                                </div>
                            </div>

                            <div class="col-12 col-sm-4 col-md-3">
                                <p class="filter-group-label">Время</p>
                                <div class="filter-option">
                                    <input
                                        v-model="selectTime"
                                        value="[0, 30]"
                                        type="radio"
                                        name="btnradios"
                                        id="selectTime1"
                                        class="filter-input"
                                    />
                                    <label
                                        for="selectTime1"
                                        class="filter-label"
                                        >до 30 мин</label
                                    >
                                </div>
                                <div class="filter-option">
                                    <input
                                        v-model="selectTime"
                                        value="[30, 60]"
                                        type="radio"
                                        name="btnradios"
                                        id="selectTime2"
                                        class="filter-input"
                                    />
                                    <label
                                        for="selectTime2"
                                        class="filter-label"
                                        >30–60 мин</label
                                    >
                                </div>
                                <div class="filter-option">
                                    <input
                                        v-model="selectTime"
                                        value="[60, 6100]"
                                        type="radio"
                                        name="btnradios"
                                        id="selectTime3"
                                        class="filter-input"
                                    />
                                    <label
                                        for="selectTime3"
                                        class="filter-label"
                                        >более 60 мин</label
                                    >
                                </div>
                            </div>

                            <div class="col-12 col-sm-4 col-md-3">
                                <p class="filter-group-label">Сложность</p>
                                <div class="filter-option">
                                    <input
                                        v-model="selectDif"
                                        value="Легко"
                                        type="radio"
                                        name="btnradio"
                                        id="selectDif1"
                                        class="filter-input"
                                    />
                                    <label for="selectDif1" class="filter-label"
                                        >Легко</label
                                    >
                                </div>
                                <div class="filter-option">
                                    <input
                                        v-model="selectDif"
                                        value="Средне"
                                        type="radio"
                                        name="btnradio"
                                        id="selectDif2"
                                        class="filter-input"
                                    />
                                    <label for="selectDif2" class="filter-label"
                                        >Средне</label
                                    >
                                </div>
                                <div class="filter-option">
                                    <input
                                        v-model="selectDif"
                                        value="Сложно"
                                        type="radio"
                                        name="btnradio"
                                        id="selectDif3"
                                        class="filter-input"
                                    />
                                    <label for="selectDif3" class="filter-label"
                                        >Сложно</label
                                    >
                                </div>
                            </div>

                            <div
                                class="col-12 col-md-3 d-flex align-items-end justify-content-start justify-content-md-end flex-column gap-2"
                            >
                                <button
                                    @click="getRecipes(1, false)"
                                    class="btn btn-outline w-100 w-md-auto"
                                >
                                    Сбросить фильтры
                                </button>
                                <button
                                    @click="getRecipes(1, true)"
                                    class="btn btn-fill w-100 w-md-auto"
                                >
                                    Применить
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <h2 class="mb-3 text-center">
                    {{ recipes.length ? 'Рецепты' : 'Рецепты не найдены' }}
                </h2>
                <div
                    class="col-md-6 col-lg-4 col-12 mb-3"
                    v-for="recipe in recipes"
                >
                    <a href="" class="cardcol">
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
                                <button @click="changePage('RecipePage', recipe.id)" class="btn-fill fw-semibold">
                                    Смотреть рецепт
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="d-flex align-items-cente justify-content-center">
                <a
                    class="btn btn-outline fs-5 m-2"
                    v-if="page > 1"
                    href="#"
                    @click.prevent="getRecipes(page - 1)"
                    ><<< Предыдущая страница</a
                >
                <a
                    class="btn btn-outline fs-5 m-2"
                    v-if="page < last_page"
                    href="#"
                    @click.prevent="getRecipes(page + 1)"
                    >Следущая страница >>></a
                >
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
            search: '',
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
        getRecipes(page = 1, isfilter = false) {
            let formdata = new FormData();
            formdata.append('sort', JSON.stringify(this.sort));
            if (isfilter) {
                if (this.selectCategories.length > 0) {
                    formdata.append(
                        'categories',
                        JSON.stringify(this.selectCategories),
                    );
                }
                if (this.selectDif) {
                    formdata.append('difficulty', this.selectDif);
                }
                if (this.selectTime) {
                    formdata.append('selectTime', this.selectTime);
                }
                if (this.search) {
                    formdata.append('search', this.search);
                }
            }
            else{
                this.selectDif = null;
                this.selectTime = null;
                this.search = null;
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
    },
};
</script>
