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
                        <h2 class="fw-bold">
                            isset($product) ? 'Изменить товар' : 'Добавить
                            товар'
                        </h2>
                        <form
                            action=""
                            method="post"
                            enctype="multipart/form-data"
                        >
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label
                                            for="productname"
                                            class="fw-semibold"
                                            >Название*</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            id="productname"
                                            style="width: 70%"
                                            value="{{isset($product)?$product->name:''}}"
                                        />
                                        @error('name')
                                        <div class="alert alert-danger">
                                            $message
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label for="category"
                                            >Категория *</label
                                        >
                                        <select
                                            name="category"
                                            class="form-select"
                                            style="width: 70%"
                                        >
                                            @isset($categories)
                                            @foreach($categories as $categorie)
                                            <option value="">
                                                $categorie -> category
                                            </option>
                                            @endforeach @endisset
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label for="price" class="fw-semibold"
                                            >Цена</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="price"
                                            name="price"
                                            style="width: 70%"
                                            value=""
                                        />
                                        @error('price')
                                        <div class="alert alert-danger">
                                            $message
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label
                                            for="quantity"
                                            class="fw-semibold"
                                            >наличие</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="quantity"
                                            name="quantity"
                                            style="width: 20%"
                                            value=""
                                        />
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <div class="mb-3">
                                            <label
                                                for="formFile"
                                                class="form-label fw-semibold"
                                                >Изображение товара</label
                                            >
                                            <input
                                                class="form-control"
                                                type="file"
                                                id="formFile"
                                                name="file"
                                            />
                                            @error('file')
                                            <div class="alert alert-danger">
                                                $message
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input
                                            type="submit"
                                            class="btn-fill fw-semibold"
                                        />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12">
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
                                        class="btn-fill fw-semibold"
                                    >
                                        Отправить
                                    </button>
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
                                                        Действие
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <form
                                                        action=""
                                                        method="post"
                                                    >
                                                        @csrf
                                                        <th scope="row">
                                                            $categorie->id
                                                        </th>
                                                        <td>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="name"
                                                                style="
                                                                    width: 40%;
                                                                "
                                                                value=""
                                                            />

                                                            <div
                                                                class="alert alert-danger"
                                                            >
                                                                $message
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button
                                                                type="submit"
                                                                class="btn-fill fw-semibold"
                                                                style="
                                                                    height: 40px;
                                                                "
                                                            >
                                                                Обновить данные
                                                            </button>
                                                            <a
                                                                href="{{ route('categoryDelete', $categorie) }}"
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
                                                    </form>
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
                        <h2 class="fw-bold">Все товары</h2>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">
                                                        Фото товара
                                                    </th>
                                                    <th scope="col">
                                                        Название товара
                                                    </th>
                                                    <th scope="col">
                                                        Категория
                                                    </th>
                                                    <th scope="col">Цена</th>
                                                    <th scope="col">Наличие</th>
                                                    <th scope="col">
                                                        Действие
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($products) @foreach
                                                ($products as $product)
                                                <tr>
                                                    <th scope="row">
                                                        $product -> id
                                                    </th>
                                                    <td>
                                                        <img
                                                            src=""
                                                            alt=""
                                                            style="
                                                                width: auto;
                                                                height: 45px;
                                                            "
                                                        />
                                                    </td>
                                                    <td>$product->name</td>
                                                    <td>
                                                        $categorie->category
                                                    </td>
                                                    <td>$product->price</td>
                                                    <td>$product->quantity</td>
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center"
                                                        >
                                                            <a
                                                                href=""
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
                                                @endforeach @endisset
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
                            <h2 class="fw-bold">Все Заказы</h2>
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
                                                        Дата создания
                                                    </th>
                                                    <th scope="col">Фио</th>
                                                    <th scope="col">
                                                        Адрес доставки
                                                    </th>
                                                    <th scope="col">
                                                        Номер телефона
                                                    </th>
                                                    <th scope="col">
                                                        Дата доставки
                                                    </th>
                                                    <th scope="col">колво</th>
                                                    <th scope="col">Статус</th>
                                                    <th scope="col">Оплата</th>
                                                    <th scope="col">
                                                        Сообщение для
                                                        пользователя
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form action="" method="post">
                                                    <tr>
                                                        <th scope="row">
                                                            $order->id
                                                        </th>
                                                        <td>
                                                            $order->created_at
                                                        </td>
                                                        <td>$order->name</td>
                                                        <td>$order->address</td>
                                                        <td>$order->phone</td>
                                                        <td>$order->when</td>
                                                        <td>
                                                            $order->quantity
                                                        </td>
                                                        <td>
                                                            <div
                                                                class="userbar"
                                                            >
                                                                <div
                                                                    class="userbtn"
                                                                >
                                                                    <span
                                                                        class="drop-username fw-semibold"
                                                                    >
                                                                        $order->status
                                                                    </span>
                                                                    <span
                                                                        class="droparrow"
                                                                        >▼</span
                                                                    >
                                                                </div>
                                                                <div
                                                                    class="dropdown-usermenu d-flex flex-column justify-content-around"
                                                                    style="
                                                                        width: 400px;
                                                                    "
                                                                >
                                                                    <div
                                                                        class="container"
                                                                    >
                                                                        <div
                                                                            class="row"
                                                                        >
                                                                            <div
                                                                                class="col-3"
                                                                            >
                                                                                <input
                                                                                    type="submit"
                                                                                    name="status"
                                                                                    class="fs-7 fw-semibold text-reset dropdown-usermenu-item form-control text-center"
                                                                                    style="
                                                                                        height: 25px;
                                                                                        font-size: 10px;
                                                                                        transition: 0.5s;
                                                                                        border: 2px
                                                                                            solid
                                                                                            #f1f5f9;
                                                                                    "
                                                                                    value="new"
                                                                                />
                                                                            </div>
                                                                            <div
                                                                                class="col-3"
                                                                            >
                                                                                <input
                                                                                    type="submit"
                                                                                    name="status"
                                                                                    class="fs-7 fw-semibold text-reset dropdown-usermenu-item form-control text-center"
                                                                                    style="
                                                                                        height: 25px;
                                                                                        font-size: 10px;
                                                                                        transition: 0.5s;
                                                                                        border: 2px
                                                                                            solid
                                                                                            #f1f5f9;
                                                                                    "
                                                                                    value="inproccess"
                                                                                />
                                                                            </div>
                                                                            <div
                                                                                class="col-3"
                                                                            >
                                                                                <input
                                                                                    type="submit"
                                                                                    name="status"
                                                                                    class="fs-7 fw-semibold text-reset dropdown-usermenu-item form-control text-center"
                                                                                    style="
                                                                                        height: 25px;
                                                                                        font-size: 10px;
                                                                                        transition: 0.5s;
                                                                                        border: 2px
                                                                                            solid
                                                                                            #f1f5f9;
                                                                                    "
                                                                                    value="success"
                                                                                />
                                                                            </div>
                                                                            <div
                                                                                class="col-3"
                                                                            >
                                                                                <input
                                                                                    type="submit"
                                                                                    name="status"
                                                                                    class="fs-7 fw-semibold text-reset dropdown-usermenu-item form-control text-center"
                                                                                    style="
                                                                                        height: 25px;
                                                                                        font-size: 10px;
                                                                                        transition: 0.5s;
                                                                                        border: 2px
                                                                                            solid
                                                                                            #f1f5f9;
                                                                                    "
                                                                                    value="declined"
                                                                                />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$order->payment</td>
                                                        <td>
                                                            $order->declinedTed

                                                            <div class="d-flex">
                                                                <input
                                                                    type="text"
                                                                    class="form-control mb-3"
                                                                    name="declinedTed"
                                                                    value=""
                                                                />

                                                                <input
                                                                    type="submit"
                                                                    name="status"
                                                                    class="fw-semibold btn-fill text-center"
                                                                    style="
                                                                        height: 40px;
                                                                        margin-left: 10px;
                                                                    "
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#declinedform"
                                                                    value="declined"
                                                                />
                                                            </div>

                                                            <div
                                                                class="alert alert-danger"
                                                            >
                                                                $message
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </form>
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
            errors: {},
        };
    },
    mounted() {},
    methods: {
        newCategory() {
            let formdata = new FormData();
            if (this.categoryName) formdata.append('name', this.categoryName);
            if (this.categoryDescription)
                formdata.append('description', this.categoryDescription);
            this.server('category', 'POST', formdata).then((result) => {
                if (result) {
                    this.categoryName = null;
                    this.categoryDescription = null;
                }
                if (result.errors) {
                    this.errors = result.errors;
                }
            });
        },
    },
};
</script>
