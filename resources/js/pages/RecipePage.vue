<template>
    <div class="mainContent">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 d-inline d-lg-flex mb-lg-0 mb-5">
                    <div
                        class="colform d-flex productimg align-self-start mb-lg-0 mb-5 justify-self-start"
                    >
                        <img :src="PUBLIC + this.recipe.photo" alt="" />
                    </div>
                    <div class="colform aboutProduct align-self-start">
                        <div class="d-flex m-lg-0 m-3">
                            <span class="fw-bold">Название:</span>
                            <span
                                style="margin-left: 15px"
                                class="text-break"
                                >{{ this.recipe.title }}</span
                            >
                        </div>
                        <div class="d-flex m-lg-0 m-3">
                            <span class="fw-bold">Категория:</span>
                            <p style="margin-left: 15px" class="text-break">
                                {{ this.category }}
                            </p>
                        </div>
                        <div class="d-flex m-lg-0 m-3">
                            <span class="fw-bold">Описание: </span>
                            <p style="margin-left: 15px" class="text-break">
                                {{ this.recipe.recipe_description }}
                            </p>
                        </div>
                        <div class="d-flex m-lg-0 m-3">
                            <button
                                v-if="this.isUser"
                                @click="favorite(this.recipe.id)"
                                class="btn"
                                :class="{
                                    'btn-fill': isLiked == false,
                                    'btn-outline': isLiked,
                                }"
                            >
                                {{
                                    this.isLiked
                                        ? 'удалить из избранного'
                                        : 'Добавить в избранное'
                                }}
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="col-12 col-lg-4 d-flex flex-column justify-content-center justify-content-lg-start"
                >
                    <h2>Ингредиенты</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Ингредиент</th>
                                    <th scope="col">Количество</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="recipe_ingredients.length == 0">
                                    <td colspan="4" class="text-center">
                                        Ингредиенты не найдены
                                    </td>
                                </tr>
                                <tr v-for="ingredient in recipe_ingredients">
                                    <td>
                                        {{ ingredient.ingredient.name }}
                                    </td>
                                    <td>
                                        {{
                                            ingredient.quantity +
                                            ' (' +
                                            ingredient.ingredient.unit +
                                            ')'
                                        }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 d-flex colform flex-column m-lg-5">
                    <div class="d-flex mx-auto mb-3 gap-2">
                        <a
                            v-if="
                                this.recipe.steps[step]?.step_number != '1' &&
                                this.recipe.steps.length
                            "
                            @click.prevent="stepChange('back')"
                            class="btn btn-outline fs-5 m-2"
                            >Назад</a
                        >
                        <h2 class="mb-3">
                            {{
                                this.recipe.steps?.length
                                    ? 'Шаг ' +
                                      this.recipe.steps[step].step_number
                                    : 'Шаги не найдены'
                            }}
                        </h2>
                        <a
                            v-if="
                                this.recipe.steps[step]?.step_number <=
                                this.recipe.steps.length - 1
                            "
                            @click.prevent="stepChange('next')"
                            class="btn btn-outline fs-5 m-2"
                            >Дальше</a
                        >
                    </div>

                    <img
                        v-if="this.recipe.steps[step]?.image"
                        :src="PUBLIC + this.recipe.steps[step]?.image"
                        alt=""
                        class="mx-auto mb-3"
                        style="width: 35%; height: auto"
                    />
                    <p class="fs-4 text-break">
                        {{ this.recipe.steps[step]?.description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'RecipePage',
    data() {
        return {
            recipe: {
                steps: [],
            },
            recipe_ingredients: [],
            category: null,
            errors: {},
            step: 0,
            isLiked: false,
        };
    },
    props: ['changePage', 'server', 'isUser', 'PUBLIC', 'pageId'],
    components: {},
    mounted() {
        this.getRecipe();
        this.getIngredientsRecipe();
    },
    methods: {
        favorite(recipe) {
            this.server('favorite/' + recipe, 'POST')
                .then((result) => {
                    this.isLiked = result.isLike;
                })
                .catch((error) => console.log('error', error));
        },
        stepChange(event) {
            if (event == 'next' && this.step < this.recipe.steps.length - 1) {
                this.step++;
                if (this.isUser) this.UserStep();
            }
            if (event == 'back' && this.step > 0) {
                this.step--;
                if (this.isUser) this.UserStep();
            }
        },
        UserStep() {
            let formdata = new FormData();
            formdata.append('step_number', this.step);
            this.server('UserStep/' + this.recipe.id, 'POST', formdata);
        },
        LoadStep() {
            this.server('LoadStep/' + this.recipe.id)
                .then((result) => {
                    this.step = result?.step_number ?? 0;
                })
                .catch((error) => console.log('error', error));
        },
        getRecipe() {
            this.server(
                (this.isUser ? 'recipe/' : 'recipeWOAuth/') + this.pageId,
            )
                .then((result) => {
                    this.recipe = result.recipe;
                    this.category = result.recipe.category.name;
                    this.isLiked = result.isLike;
                    console.log(result);
                    if (this.isUser) {
                        this.LoadStep();
                    }
                })
                .catch((error) => console.log('error', error));
        },
        getIngredientsRecipe() {
            this.server('recipeIngredient/' + this.pageId).then((result) => {
                this.recipe_ingredients = result;
            });
        },
    },
};
</script>
