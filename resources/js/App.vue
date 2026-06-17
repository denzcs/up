<template>
    <HeaderComponent
        :server="server"
        :isUser="isUser"
        :successUser="successUser"
        :logout="logout"
        :changePage="changePage"
        :PUBLIC="PUBLIC"
        :user="user"
        :class="{ 'mb-3': page != 'HomePage' }"
        id="header"
    />
    <template v-if="isLoad">
        <HomePage
            v-if="page == 'HomePage'"
            :changePage="changePage"
            :PUBLIC="PUBLIC"
            :server="server"
            :user="user"
        />
        <AdminPage
            v-if="page == 'AdminPage'"
            :server="server"
            :changePage="changePage"
            :PUBLIC="PUBLIC"
        />
        <EditPage
            v-if="page == 'EditPage'"
            :server="server"
            :changePage="changePage"
            :PUBLIC="PUBLIC"
            :pageId="pageId"
        />
        <RecipePage
            v-if="page == 'RecipePage'"
            :changePage="changePage"
            :PUBLIC="PUBLIC"
            :server="server"
            :isUser="isUser"
            :pageId="pageId"
        />
        <UserPage
            v-if="page == 'UserPage'"
            :changePage="changePage"
            :PUBLIC="PUBLIC"
            :server="server"
            :user="user"

        />
    </template>

    <template v-else>
        <h1>ЗАГРУЗКА...</h1>
    </template>
    <FooterComponent />
</template>
<script>
import FooterComponent from './components/FooterComponent.vue';
import HeaderComponent from './components/HeaderComponent.vue';
import AdminPage from './pages/AdminPage.vue';
import EditPage from './pages/EditPage.vue';
import HomePage from './pages/HomePage.vue';
import RecipePage from './pages/RecipePage.vue';
import UserPage from './pages/UserPage.vue';

export default {
    name: 'App',
    data() {
        return {
            page: localStorage.getItem('page') || 'HomePage',
            pageId: localStorage.getItem('pageId') || 'pageId',
            API: 'http://127.0.0.1:8000/api/',
            PUBLIC: 'http://127.0.0.1:8000/storage/',
            isUser: false,
            isLoad: false,
            user: {},
        };
    },
    methods: {
        changePage(page, pageId = null) {
            this.page = page;
            this.pageId = pageId;
            localStorage.setItem('page', this.page);
            localStorage.setItem('pageId', this.pageId);
        },
        getUser() {
            this.server('user')
                .then((result) => {
                    this.user = result;
                    this.isUser = true;
                    this.isLoad = true;
                    // console.log(this.user);
                })
                .catch((error) => console.error(error));
        },
        successUser(token) {
            localStorage.setItem('token', token);
            this.isUser = true;
            this.getUser();
            
        },
        logout() {
            localStorage.removeItem('token');
            localStorage.removeItem('page');
            localStorage.removeItem('pageId');
            this.user = {};
            this.isUser = false;
            this.isLoad = true;
        },
        getCategories() {
            this.server('category').then((result) => {
                this.categories = result;
            });
        },
        async server(route, method = 'GET', FormData = null) {
            let myHeaders = new Headers();
            myHeaders.append('Accept', 'application/json');
            if (localStorage.getItem('token')) {
                myHeaders.append(
                    'Authorization',
                    'Bearer ' + localStorage.getItem('token'),
                );
            }

            let requestOptions = {
                method: method,
                headers: myHeaders,
                redirect: 'follow',
            };

            if (method != 'GET') {
                requestOptions.body = FormData;
            }

            return await fetch(this.API + route, requestOptions).then(
                (response) => {
                    if (response.status == 401) {
                        this.logout();
                    }
                    return response.json();
                },
            );
            // .then((result) => console.log(result))
            // .catch((error) => console.error(error));
        },
    },
    components: {
        HeaderComponent,
        HomePage,
        FooterComponent,
        AdminPage,
        EditPage,
        RecipePage,
        UserPage,
    },
    mounted() {
        if (localStorage.getItem('token')) {
            this.getUser();
        } else {
            this.isLoad = true;
        }
    },
};
</script>
