<template>
    <div class="main-content">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 d-flex flex-column">
                    <h1 class="fw-bold text-break" id="stepadd">
                        {{
                            this.editPage == 'steps'
                                ? 'Редактирование шагов'
                                : 'Редактирование рецепта'
                        }}
                    </h1>
                    <span class="fs-5 mb-3">{{
                        this.editPage == 'steps'
                            ? 'Добавляйте, удаляйте и редактируйте шаги рецепта'
                            : 'Добавляйте, удаляйте и редактируйте рецептами и категории'
                    }}</span>
                    <div
                        class="col-lg-3 col-sm-6 d-flex justify-content-between"
                    >
                        <button
                            class="btn btn-fill"
                            @click="changePage('AdminPage')"
                        >
                            Назад
                        </button>
                        <button
                            class="btn btn-fill"
                            @click="
                                this.editPage == 'steps'
                                    ? changeEditPage('recipe')
                                    : changeEditPage('steps')
                            "
                        >
                            {{
                                this.editPage == 'steps'
                                    ? 'Вернуться к рецепту'
                                    : 'Редакторивание шагов'
                            }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="row" v-if="editPage == 'steps'">
                <div class="col-12">
                    <div class="colform mb-5">
                        <h2 class="fw-bold mb-3">
                            {{
                                this.stepUpdateId
                                    ? 'Редактировать'
                                    : 'Добавить'
                            }}
                            шаг
                        </h2>

                        <div class="container">
                            <h4 class="fw-bold">
                                Шаг №{{this.stepUpdateId?this.step_number:(this.recipe.steps.length? this.recipe.steps.length + 1: '1')
                                }}
                            </h4>
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="productname" class="fw-semibold"
                                        >Описание*</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        id="productname"
                                        style="width: 70%"
                                        v-model="step_description"
                                        value=""
                                    />
                                    <p
                                        class="red"
                                        v-if="errors.step_description"
                                    >
                                        {{ errors.step_description.join('. ') }}
                                    </p>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="mb-3">
                                        <label
                                            for="formFile"
                                            class="form-label fw-semibold"
                                            >Изображение шага</label
                                        >
                                        <input
                                            class="form-control"
                                            type="file"
                                            id="stepFile"
                                            name="file"
                                        />
                                        <p class="red" v-if="errors.step_photo">
                                            {{ errors.step_photo.join('. ') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button
                                        @click="this.stepUpdateId?updateStep(this.stepUpdateId):step()"
                                        class="btn-fill fw-semibold mb-3"
                                    >
                                        {{this.stepUpdateId?'Изменить':'Добавить'}}
                                    </button>
                                    <div
                                        v-if="this.message.step"
                                        class="alert alert-success d-flex align-items-center"
                                        :class="{ fade: true, show: showAlert }"
                                        role="alert"
                                        style="width: 35%"
                                    >
                                        <i class="fa-solid fa-circle-check"></i>
                                        <div>{{this.message.step}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="colform mb-5">
                        <div class="title" id="allOrders">
                            <h2 class="fw-bold">Добавленные шаги</h2>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">№</th>
                                                    <th scope="col">фото</th>
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
                                                    v-for="step in this.recipe
                                                        .steps"
                                                >
                                                    <th scope="row">
                                                        {{ step.step_number }}
                                                    </th>
                                                    <td>
                                                        <img
                                                            v-if="step.image"
                                                            :src="
                                                                PUBLIC +
                                                                step.image
                                                            "
                                                            alt=""
                                                            style="
                                                                width: auto;
                                                                height: 45px;
                                                            "
                                                        />
                                                    </td>
                                                    <td class="text-break">
                                                        {{ step.description }}
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center"
                                                        >
                                                            <a
                                                                href="#stepadd"
                                                                @click="
                                                                    updateStepForm(
                                                                        step.id,
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
                                                                    deleteStep(
                                                                        step,
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
            <div class="row" v-if="editPage == 'recipe'">
                <div class="col-12">
                    <div class="colform mb-5">
                        <h2 class="fw-bold">Редактировать рецепт</h2>

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
                                        class="btn-fill fw-semibold mb-3"
                                    >
                                        обновить
                                    </button>
                                    <div
                                        v-if="message.recipe"
                                        class="alert alert-success d-flex align-items-center"
                                        :class="{ fade: true, show: showAlert }"
                                        role="alert"
                                        style="width: 35%"
                                    >
                                        <i class="fa-solid fa-circle-check"></i>
                                        <div>Рецепт успешно изменен</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="colform mb-5">
                        <h2 class="fw-bold">Добавить ингредиенты</h2>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="ingredient" class="fw-semibold"
                                        >Выберите ингредиент*</label
                                    >
                                    <select
                                        v-model="ingredient"
                                        id="ingredient"
                                    >
                                        <option
                                            v-for="ingredient in ingredients"
                                            type="radio"
                                            :value="ingredient.id"
                                        >
                                            {{ ingredient.name }} ({{
                                                ingredient.unit
                                            }})
                                        </option>
                                    </select>
                                    <p class="red" v-if="errors.ingredient">
                                        {{ errors.ingredient.join('. ') }}
                                    </p>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <input
                                        type="text"
                                        v-model="quantity"
                                        placeholder="Количество"
                                        class="form-control"
                                        style="width: 40%"
                                    />
                                    <p class="red" v-if="errors.quantity">
                                        {{ errors.quantity.join('. ') }}
                                    </p>
                                </div>
                                <div class="col-12">
                                    <button
                                        @click="recipeIngredient"
                                        class="btn-fill fw-semibold mb-3"
                                    >
                                        Добавить
                                    </button>
                                    <div
                                        v-if="message.recipeIngredient"
                                        class="alert alert-success d-flex align-items-center"
                                        :class="{ fade: true, show: showAlert }"
                                        role="alert"
                                        style="width: 35%"
                                    >
                                        <i class="fa-solid fa-circle-check"></i>
                                        <div>Ингредиент успешно добавлен</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="colform mb-5">
                        <div class="title" id="allOrders">
                            <h2 class="fw-bold">Добавленные ингредиенты</h2>
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
                                                        Количество
                                                    </th>
                                                    <th scope="col">
                                                        Действие
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="ingredient in recipe_ingredients"
                                                >
                                                    <th scope="row">
                                                        {{
                                                            ingredient
                                                                .ingredient.id
                                                        }}
                                                    </th>
                                                    <td>
                                                        {{
                                                            ingredient
                                                                .ingredient.name
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            ingredient.quantity +
                                                            ' (' +
                                                            ingredient
                                                                .ingredient
                                                                .unit +
                                                            ')'
                                                        }}
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center"
                                                        >
                                                            <a
                                                                href=""
                                                                @click.prevent="
                                                                    deleteIngredientsRecipe(
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
    props: ['server', 'changePage', 'PUBLIC', 'pageId'],
    data() {
        return {
            recipe: { category: {} },
            difficulty: null,
            selectedCategory: null,
            quantity: null,
            photo: null,
            recipe_ingredients: [],
            ingredient: null,
            errors: {},
            message: {},
            categories: [],
            ingredients: [],
            showAlert: true,
            editPage: 'recipe',
            steps: 0,
            step_description: null,
            step_photo: null,
            step_number: null,
            stepUpdateId: null,
        };
    },
    mounted() {
        this.getRecipe(this.pageId);
        this.getIngredients();
        this.getCategories();
        this.getIngredientsRecipe();
    },
    methods: {
        changeEditPage(page) {
            this.editPage = page;
        },
        step() {
            let formdata = new FormData();
            formdata.append('step_number', this.recipe.steps.length + 1);
            if (this.step_description)
                formdata.append('description', this.step_description);
            let step_photo = document.querySelector('#stepFile');
            if (step_photo.files[0]) {
                formdata.append('photo', step_photo.files[0]);
            }
            this.server('step/' + this.pageId, 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    }
                    if (result.message == 'ok') {
                        this.message.step = 'Шаг успешно добавлен';
                        this.step_description = null;
                        this.step_photo = null;
                        setTimeout(() => {
                            this.showAlert = false;
                            setTimeout(() => {
                                this.message.step = null;
                                this.showAlert = true;
                            }, 200);
                        }, 5000);
                        this.getRecipe(this.pageId);
                    }
                })
                .catch((error) => console.log('error', error));
        },
        updateStep(step) {
            let formdata = new FormData();
            formdata.append('description', this.step_description);
            let step_photo = document.querySelector('#stepFile');
            if (step_photo.files[0]) {
                formdata.append('photo', step_photo.files[0]);
            }
            this.server('stepUpdate/' + step, 'POST', formdata).then((result) => {
                if (result.message == 'ok') {
                    this.message.step = 'Шаг успешно изменён';
                    this.step_description = null;
                    this.step_photo = null;
                    setTimeout(() => {
                            this.showAlert = false;
                            setTimeout(() => {
                                this.message.step = null;
                                this.showAlert = true;
                            }, 200);
                        }, 5000);
                    this.stepUpdateId = null;
                    this.getRecipe(this.pageId);
                }
                if (result.errors) {
                    this.errors = result.errors;
                }
            });
        },
        updateStepForm(step) {
            this.server('step/' + step).then((result) => {
                if (result) {
                    this.stepUpdateId = result.id;
                    this.step_description = result.description;
                    this.step_photo = result.image;
                    this.step_number = result.step_number
                    this.getRecipe(this.pageId);
                }
                if (result.errors) {
                    this.errors = result.errors;
                }
            });
        },
        deleteStep(step) {
            let stepnumber = step.step_number;
            this.server('step/' + step.id, 'DELETE').then((result) => {
                if (result) {
                    this.recipe.steps.forEach((element) => {
                        if (element.step_number > stepnumber) {
                            let formdata = new FormData();
                            formdata.append('description', element.description);
                            formdata.append('step_number', element.step_number);
                            this.server(
                                'stepNumberUpdate/' + element.id,
                                'POST',
                                formdata,
                            );
                        }
                    });
                    this.getRecipe(this.pageId);
                }
            });
        },
        recipeIngredient() {
            let formdata = new FormData();
            formdata.append('recipe', this.pageId);
            if (this.quantity) formdata.append('quantity', this.quantity);
            if (this.ingredient) formdata.append('ingredient', this.ingredient);
            this.server('recipeIngredient', 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                        console.log(result.errors);
                    }
                    if (result.message == 'ok') {
                        this.message.recipeIngredient = result.message;
                        setTimeout(() => {
                            this.showAlert = false;
                            setTimeout(() => {
                                this.message.recipeIngredient = null;
                                this.showAlert = true;
                            }, 200);
                        }, 5000);
                        this.getIngredientsRecipe();
                    }
                })
                .catch((error) => console.log('error', error));
        },
        getIngredientsRecipe() {
            this.server('recipeIngredient/' + this.pageId)
                .then((result) => {
                    this.recipe_ingredients = result;
                })
                .catch((error) => console.log('error', error));
        },
        deleteIngredientsRecipe(ingredient) {
            this.server('recipeIngredient/' + ingredient, 'DELETE').then(
                (result) => {
                    if (result) {
                        this.getIngredientsRecipe();
                    }
                },
            );
        },
        updateRecipe(recipe) {
            let formdata = new FormData();
            if (this.recipe.title) formdata.append('title', this.recipe.title);
            if (this.selectedCategory)
                formdata.append('category', this.selectedCategory);
            if (this.recipe.recipe_description)
                formdata.append(
                    'recipe_description',
                    this.recipe.recipe_description,
                );
            if (this.recipe.cook_time)
                formdata.append('cook_time', this.recipe.cook_time);
            if (this.difficulty) formdata.append('difficulty', this.difficulty);
            let photo = document.querySelector('#formFile');
            if (photo.files[0]) {
                formdata.append('photo', photo.files[0]);
            }
            this.server('recipe/' + recipe, 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    }

                    if (result.message == 'ok') {
                        console.log(result.message);
                        this.message.recipe = result.message;
                        setTimeout(() => {
                            this.showAlert = false;
                            setTimeout(() => {
                                this.message.recipe = null;
                                this.showAlert = true;
                            }, 200);
                        }, 5000);
                        this.getRecipe(this.pageId);
                    }
                })
                .catch((error) => console.log('error', error));
        },
        getRecipe(recipe) {
            this.server('recipe/' + recipe).then((result) => {
                console.log(result.steps);
                this.recipe = result;
                this.selectedCategory = result.category.id;
                this.difficulty = result.difficulty;
            });
        },
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
    },
};
</script>
