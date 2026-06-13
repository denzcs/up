<template>
    <div class="main-content">
        <div class="container">
            <div class="row mb-5">
                <div class="col-2 d-flex flex-column">
                    <button class="btn btn-fill" @click="changePage('AdminPage')">Назад</button>
                </div>
                <div class="col-12 d-flex flex-column">
                    <h1 class="fw-bold text-break">Редактирование рецепта</h1>
                    <span class="fs-5"
                        >Добавляйте, удаляйте и редактируйте рецептами и
                        категории</span
                    >
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="colform mb-5">
                        <h2 class="fw-bold">Добавить рецепт</h2>

                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="productname" class="fw-semibold"
                                        >Название*</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        id="productname"
                                        style="width: 70%"
                                        v-model="recipe.title"
                                        value=""
                                    />
                                    <p class="red" v-if="errors.title">
                                        {{ errors.title.join('. ') }}
                                    </p>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="category">Категория *</label>
                                    <select v-model="selectedCategory">
                                        <option
                                            v-for="category in categories"
                                            type="radio"
                                            :value="category.id"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                    <p class="red" v-if="errors.category">
                                        {{ errors.category.join('. ') }}
                                    </p>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="price" class="fw-semibold"
                                        >Описание рецепта</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="price"
                                        name="price"
                                        style="width: 70%"
                                        value=""
                                        v-model="recipe.recipe_description"
                                    />
                                    <p
                                        class="red"
                                        v-if="errors.recipeDescription"
                                    >
                                        {{
                                            errors.recipeDescription.join('. ')
                                        }}
                                    </p>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="quantity" class="fw-semibold"
                                        >Время готовки (в минутах)</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="quantity"
                                        name="quantity"
                                        style="width: 40%"
                                        v-model="recipe.cook_time"
                                    />
                                    <p class="red" v-if="errors.cooktime">
                                        {{ errors.cooktime.join('. ') }}
                                    </p>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="diff" class="fw-semibold"
                                        >Выберите сложность</label
                                    >
                                    <select v-model="difficulty">
                                        <option value="Легко" type="radio">
                                            Легко
                                        </option>
                                        <option value="Средне" type="radio">
                                            Средне
                                        </option>
                                        <option value="Сложно" type="radio">
                                            Сложно
                                        </option>
                                    </select>
                                    <p class="red" v-if="errors.difficulty">
                                        {{ errors.difficulty.join('. ') }}
                                    </p>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="mb-3">
                                        <label
                                            for="formFile"
                                            class="form-label fw-semibold"
                                            >Изображение рецепта</label
                                        >
                                        <input
                                            class="form-control"
                                            type="file"
                                            id="formFile"
                                            name="file"
                                        />
                                        <p class="red" v-if="errors.photo">
                                            {{ errors.photo.join('. ') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button
                                        @click="updateRecipe(recipe.id)"
                                        class="btn-fill fw-semibold"
                                    >
                                        обновить
                                    </button>
                                </div>
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
    name: 'AdminPage',
    props: ['server', 'changePage', 'PUBLIC', 'pageId'],
    data() {
        return {
            categoryName: null,
            categoryDescription: null,
            recipe: { category: {} },
            difficulty: null,
            selectedCategory: null,
            difficulty: null,
            photo: null,
            ingredientName: null,
            ingredientUnit: null,
            ingredientUpdateId: null,
            errors: {},
            categories: [],
            ingredients: [],
        };
    },
    mounted() {
        this.getRecipe(this.pageId);
        this.getIngredients();
        this.getCategories();
    },
    methods: {
        updateRecipe(recipe) {
            let formdata = new FormData();
            if (this.recipe.title) formdata.append('title', this.recipe.title);
            if (this.selectedCategory) formdata.append('category', this.selectedCategory);
            if (this.recipe.recipe_description)
                formdata.append('recipe_description', this.recipe.recipe_description);
            if (this.recipe.cook_time) formdata.append('cook_time', this.recipe.cook_time);
            if (this.difficulty) formdata.append('difficulty', this.difficulty);
            let photo = document.querySelector('#formFile');
            if (photo.files[0]) {
                formdata.append('photo', photo.files[0]);
            }
            this.server('recipe/'+recipe, 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    }

                    if (result.message == 'ok') {
                        this.getRecipe(this.pageId);
                    }
                })
                .catch((error) => console.log('error', error));
        },
        getRecipe(recipe) {
            this.server('recipe/' + recipe).then((result) => {
                this.recipe = result;
                this.selectedCategory = result.category.id;
                this.difficulty = result.difficulty;
                console.log(this.recipe);
            });
        },
        // deleteRecipe(recipe) {
        //     this.server('recipe/' + recipe, 'DELETE').then((result) => {
        //         if (result) {
        //             this.getRecipes();
        //         }
        //     });
        // },
        getCategories() {
            this.server('category').then((result) => {
                this.categories = result;
            });
        },
        getIngredients() {
            this.server('ingredient').then((result) => {
                this.ingredients = result;
            });
        },
        deleteIngredient(ingredient) {
            this.server('ingredient/' + ingredient, 'DELETE').then((result) => {
                if (result) {
                    this.getIngredients();
                }
            });
        },
    },
};
</script>
