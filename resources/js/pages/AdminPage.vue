<template>
    <div class="main-content">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 d-flex flex-column">
                    <h1 class="fw-bold text-break">
                        Управление рецептами и категориями
                    </h1>
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
                                        v-model="recipeName"
                                        value=""
                                    />
                                    <p class="red" v-if="errors.title">
                                        {{ errors.title.join('. ') }}
                                    </p>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="category">Категория *</label>
                                    <select v-model="category">
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
                                        v-model="recipeDescription"
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
                                        v-model="cooktime"
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
                                        @click="newRecipe()"
                                        class="btn-fill fw-semibold mb-3"
                                    >
                                        Отправить
                                    </button>
                                    <div
                                        v-if="message.recipe"
                                        class="alert alert-success d-flex align-items-center"
                                        :class="{ fade: true, show: showAlert }"
                                        role="alert"
                                        style="width: 35%"
                                    >
                                        <i class="fa-solid fa-circle-check"></i>
                                        <div>Рецепт успешно добавлен</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" id="categoryCreateForm">
                    <div class="colform mb-5">
                        <h2 class="fw-bold">Добавить Категорию</h2>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <label
                                        for="createCategory"
                                        class="fw-semibold"
                                        >Категория*</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="createCategory"
                                        name="name"
                                        v-model="categoryName"
                                        style="width: 70%"
                                    />
                                    <p class="red" v-if="errors.name">
                                        {{ errors.name.join('. ') }}
                                    </p>
                                    <label
                                        for="categoryDescription"
                                        class="fw-semibold"
                                        >Описание*</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="categoryDescription"
                                        name="categoryDescription"
                                        v-model="categoryDescription"
                                        style="width: 70%"
                                    />
                                    <p class="red" v-if="errors.description">
                                        {{ errors.description.join('. ') }}
                                    </p>
                                </div>
                                <div class="col-12">
                                    <button
                                        @click="newCategory()"
                                        class="btn-fill fw-semibold mb-3"
                                    >
                                        Отправить
                                    </button>
                                    <div
                                        v-if="message.category"
                                        class="alert alert-success d-flex align-items-center"
                                        :class="{ fade: true, show: showAlert }"
                                        role="alert"
                                        style="width: 35%"
                                    >
                                        <i class="fa-solid fa-circle-check"></i>
                                        <div>Категория успешно добавлена</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" id="indredientCreateForm">
                    <div class="colform mb-5">
                        <h2 class="fw-bold">
                            {{
                                this.ingredientUpdateId
                                    ? 'Изменить'
                                    : 'Добавить'
                            }}
                            ингредиент
                        </h2>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <label
                                        for="ingredientName"
                                        class="fw-semibold"
                                        >название ингредиента*</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="ingredientName"
                                        name="name"
                                        v-model="ingredientName"
                                        style="width: 70%"
                                    />
                                    <p class="red" v-if="errors.name">
                                        {{ errors.name.join('. ') }}
                                    </p>
                                    <label
                                        for="ingredientUnit"
                                        class="fw-semibold"
                                        >Единица измерения категории*</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="ingredientUnit"
                                        name="ingredientUnit"
                                        v-model="ingredientUnit"
                                        placeholder="гр."
                                        style="width: 70%"
                                    />
                                    <p class="red" v-if="errors.description">
                                        {{ errors.description.join('. ') }}
                                    </p>
                                </div>
                                <div class="col-12">
                                    <button
                                        @click="
                                            this.ingredientUpdateId
                                                ? updateIngredient(
                                                      this.ingredientUpdateId,
                                                  )
                                                : newIngredient()
                                        "
                                        class="btn-fill fw-semibold mb-3"
                                    >
                                        Отправить
                                    </button>
                                    <div
                                        v-if="message.ingredient"
                                        class="alert alert-success d-flex align-items-center"
                                        :class="{ fade: true, show: showAlert }"
                                        role="alert"
                                        style="width: 35%"
                                    >
                                        <i class="fa-solid fa-circle-check"></i>
                                        <div>
                                            {{ message.ingredient }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="colform mb-5">
                        <h2 class="fw-bold">Все категории</h2>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">
                                                        Категория
                                                    </th>
                                                    <th scope="col">
                                                        Описание
                                                    </th>
                                                    <th scope="col">
                                                        Действие
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="category in categories"
                                                >
                                                    <th scope="row">
                                                        {{ category.id }}
                                                    </th>
                                                    <td>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="categoryNameUpdate"
                                                            style="width: 40%"
                                                            :value="
                                                                category.name
                                                            "
                                                            disabled
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="categoryDescriptionUpdate"
                                                            style="width: 40%"
                                                            :value="
                                                                category.description
                                                            "
                                                            disabled
                                                        />
                                                    </td>
                                                    <td>
                                                        <a
                                                            href=""
                                                            @click.prevent="
                                                                deleteCategory(
                                                                    category.id,
                                                                )
                                                            "
                                                            class="text-reset"
                                                            ><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="24"
                                                                height="24"
                                                                viewBox="0 0 24 24"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash"
                                                            >
                                                                <path
                                                                    stroke="none"
                                                                    d="M0 0h24v24H0z"
                                                                    fill="none"
                                                                />
                                                                <path
                                                                    d="M4 7l16 0"
                                                                />
                                                                <path
                                                                    d="M10 11l0 6"
                                                                />
                                                                <path
                                                                    d="M14 11l0 6"
                                                                />
                                                                <path
                                                                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"
                                                                />
                                                                <path
                                                                    d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"
                                                                />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="colform mb-5" id="recipes">
                        <h2 class="fw-bold">Все рецепты</h2>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">
                                                        Фото рецепта
                                                    </th>
                                                    <th scope="col">
                                                        Название рецепта
                                                    </th>
                                                    <th scope="col">
                                                        Категория
                                                    </th>
                                                    <th scope="col">
                                                        Описание
                                                    </th>
                                                    <th scope="col">
                                                        Сложность
                                                    </th>
                                                    <th scope="col">
                                                        Время готовки
                                                    </th>
                                                    <th scope="col">
                                                        Действие
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="recipe in recipes">
                                                    <th scope="row">
                                                        {{ recipe.id }}
                                                    </th>
                                                    <td>
                                                        <img
                                                            :src="
                                                                PUBLIC +
                                                                recipe.photo
                                                            "
                                                            alt=""
                                                            style="
                                                                width: auto;
                                                                height: 45px;
                                                            "
                                                        />
                                                    </td>
                                                    <td class="text-break">
                                                        {{ recipe.title }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            recipe.category.name
                                                        }}
                                                    </td>
                                                    <td class="text-break">
                                                        {{
                                                            recipe.recipe_description
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{ recipe.difficulty }}
                                                    </td>
                                                    <td>
                                                        {{ recipe.cook_time }}
                                                        мин.
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center"
                                                        >
                                                            <a
                                                                href="#header"
                                                                @click="
                                                                    changePage(
                                                                        'EditPage',
                                                                        recipe.id,
                                                                    )
                                                                "
                                                                style="
                                                                    margin-right: 5px;
                                                                "
                                                                class="text-reset"
                                                                ><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="24"
                                                                    height="24"
                                                                    viewBox="0 0 24 24"
                                                                    fill="none"
                                                                    stroke="currentColor"
                                                                    stroke-width="2"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit"
                                                                >
                                                                    <path
                                                                        stroke="none"
                                                                        d="M0 0h24v24H0z"
                                                                        fill="none"
                                                                    />
                                                                    <path
                                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"
                                                                    />
                                                                    <path
                                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"
                                                                    />
                                                                    <path
                                                                        d="M16 5l3 3"
                                                                    />
                                                                </svg>
                                                            </a>
                                                            <a
                                                                href=""
                                                                @click.prevent="
                                                                    deleteRecipe(
                                                                        recipe.id,
                                                                    )
                                                                "
                                                                class="text-reset"
                                                            >
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
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash"
                                                                >
                                                                    <path
                                                                        stroke="none"
                                                                        d="M0 0h24v24H0z"
                                                                        fill="none"
                                                                    />
                                                                    <path
                                                                        d="M4 7l16 0"
                                                                    />
                                                                    <path
                                                                        d="M10 11l0 6"
                                                                    />
                                                                    <path
                                                                        d="M14 11l0 6"
                                                                    />
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"
                                                                    />
                                                                    <path
                                                                        d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"
                                                                    />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="colform mb-5">
                        <div class="title" id="allOrders">
                            <h2 class="fw-bold">Все Ингредиенты</h2>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">
                                                        Название
                                                    </th>
                                                    <th scope="col">
                                                        Единица измерения
                                                    </th>
                                                    <th scope="col">
                                                        Действие
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="ingredient in ingredients"
                                                >
                                                    <th scope="row">
                                                        {{ ingredient.id }}
                                                    </th>
                                                    <td>
                                                        {{ ingredient.name }}
                                                    </td>
                                                    <td>
                                                        {{ ingredient.unit }}
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center"
                                                        >
                                                            <a
                                                                href="#categoryCreateForm"
                                                                @click="
                                                                    updateIngredientForm(
                                                                        ingredient.id,
                                                                    )
                                                                "
                                                                style="
                                                                    margin-right: 5px;
                                                                "
                                                                class="text-reset"
                                                                ><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="24"
                                                                    height="24"
                                                                    viewBox="0 0 24 24"
                                                                    fill="none"
                                                                    stroke="currentColor"
                                                                    stroke-width="2"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit"
                                                                >
                                                                    <path
                                                                        stroke="none"
                                                                        d="M0 0h24v24H0z"
                                                                        fill="none"
                                                                    />
                                                                    <path
                                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"
                                                                    />
                                                                    <path
                                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"
                                                                    />
                                                                    <path
                                                                        d="M16 5l3 3"
                                                                    />
                                                                </svg>
                                                            </a>
                                                            <a
                                                                href=""
                                                                @click.prevent="
                                                                    deleteIngredient(
                                                                        ingredient.id,
                                                                    )
                                                                "
                                                                class="text-reset"
                                                            >
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
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash"
                                                                >
                                                                    <path
                                                                        stroke="none"
                                                                        d="M0 0h24v24H0z"
                                                                        fill="none"
                                                                    />
                                                                    <path
                                                                        d="M4 7l16 0"
                                                                    />
                                                                    <path
                                                                        d="M10 11l0 6"
                                                                    />
                                                                    <path
                                                                        d="M14 11l0 6"
                                                                    />
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"
                                                                    />
                                                                    <path
                                                                        d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"
                                                                    />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
    props: ['server', 'changePage', 'PUBLIC'],
    data() {
        return {
            categoryName: null,
            categoryDescription: null,
            recipeName: null,
            recipeDescription: null,
            category: null,
            cooktime: null,
            difficulty: null,
            photo: null,
            recipeCategory: null,
            ingredientName: null,
            ingredientUnit: null,
            ingredientUpdateId: null,
            errors: {},
            message: {},
            recipes: [],
            ingredients: [],
            categories: [],
            showAlert: true,
        };
    },
    mounted() {
        this.getCategories();
        this.getRecipes();
        this.getIngredients();
    },
    methods: {
        newRecipe() {
            let formdata = new FormData();
            if (this.recipeName) formdata.append('title', this.recipeName);
            if (this.category) formdata.append('category', this.category);
            if (this.recipeDescription)
                formdata.append('recipe_description', this.recipeDescription);
            if (this.cooktime) formdata.append('cook_time', this.cooktime);
            if (this.difficulty) formdata.append('difficulty', this.difficulty);
            let photo = document.querySelector('#formFile');
            if (photo.files[0]) {
                formdata.append('photo', photo.files[0]);
            }
            this.server('recipe', 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    }

                    if (result.message == 'ok') {
                        this.message.recipe = result.message;
                        setTimeout(() => {
                            this.showAlert = false;
                            setTimeout(() => {
                                this.message.recipe = null;
                                this.showAlert = true;
                            }, 200);
                        }, 5000);

                        this.recipeName = null;
                        this.recipeDescription = null;
                        this.category = null;
                        this.cooktime = null;
                        this.difficulty = null;
                        this.photo = null;
                        this.getRecipes();
                    }
                })
                .catch((error) => console.log('error', error));
        },
        getRecipes() {
            this.server('recipe').then((result) => {
                this.recipes = result;
                console.log(result);
            });
        },
        deleteRecipe(recipe) {
            this.server('recipe/' + recipe, 'DELETE').then((result) => {
                if (result) {
                    this.getRecipes();
                }
            });
        },
        newCategory() {
            let formdata = new FormData();
            if (this.categoryName) formdata.append('name', this.categoryName);
            if (this.categoryDescription)
                formdata.append('description', this.categoryDescription);
            this.server('category', 'POST', formdata).then((result) => {
                if (result.message == 'ok') {
                    this.message.category = result.message;
                    setTimeout(() => {
                        this.showAlert = false;
                        setTimeout(() => {
                            this.message.category = null;
                            this.showAlert = true;
                        }, 200);
                    }, 5000);
                    this.categoryName = null;
                    this.categoryDescription = null;
                    this.getCategories();
                }
                if (result.errors) {
                    this.errors = result.errors;
                }
            });
        },
        getCategories() {
            this.server('category').then((result) => {
                this.categories = result;
            });
        },
        deleteCategory(category) {
            this.server('category/' + category, 'DELETE').then((result) => {
                if (result) {
                    this.getCategories();
                    this.getRecipes();
                }
            });
        },
        newIngredient() {
            let formdata = new FormData();
            if (this.ingredientName)
                formdata.append('ingredient_name', this.ingredientName);
            if (this.ingredientUnit)
                formdata.append('unit', this.ingredientUnit);
            this.server('ingredient', 'POST', formdata).then((result) => {
                if (result.message == 'ok') {
                    this.message.ingredient = 'Ингредиент успешно добавлен';
                    setTimeout(() => {
                        this.showAlert = false;
                        setTimeout(() => {
                            this.message.ingredient = null;
                            this.showAlert = true;
                        }, 200);
                    }, 5000);
                    console.log(result);
                    this.ingredientName = null;
                    this.ingredientUnit = null;
                    this.getIngredients();
                }
                if (result.errors) {
                    this.errors = result.errors;
                }
            });
        },
        updateIngredient(ingredient) {
            let formdata = new FormData();
            if (this.ingredientName)
                formdata.append('ingredient_name', this.ingredientName);
            if (this.ingredientUnit)
                formdata.append('unit', this.ingredientUnit);
            this.server('ingredient/' + ingredient, 'POST', formdata).then(
                (result) => {
                    if (result.message == 'ok') {
                        this.message.ingredient = 'Ингредиент успешно изменён';
                        this.ingredientName = null;
                        this.ingredientUnit = null;
                        this.ingredientUpdateId = null;
                        this.getIngredients();
                    }
                    if (result.errors) {
                        this.errors = result.errors;
                    }
                },
            );
        },
        updateIngredientForm(ingredient) {
            this.server('ingredient/' + ingredient).then((result) => {
                if (result) {
                    console.log(result);
                    this.ingredientUpdateId = result.id;
                    this.ingredientName = result.name;
                    this.ingredientUnit = result.unit;
                    this.getIngredients();
                }
                if (result.errors) {
                    this.errors = result.errors;
                }
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
