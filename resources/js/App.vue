<template>
    <HeaderComponent
        :server="server"
        :isUser="isUser"
        :successUser="successUser"
        :logout="logout"
        :changePage="changePage"
        :PUBLIC="PUBLIC"
        :user="user"
        :class="{'mb-3': page!='HomePage'}"
        id="header"
    />
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
    <!-- <CategoriePage
        v-if="page == 'CategoriePage'"
        :changePage="changePage"
        :PUBLIC="PUBLIC"
        :server="server"
        :CategoryId="pageId"
        :isUser="isUser"
        :user="user"
    />
    <ProfilePave
        v-if="page == 'ProfilePave'"
        :server="server"
        :PUBLIC="PUBLIC"
        :changePage="changePage"
    />
    <UserPage
        v-if="page == 'UserPage'"
        :server="server"
        :PUBLIC="PUBLIC"
        :changePage="changePage"
        :pageId="pageId"
    /> -->
    <FooterComponent />
</template>
<script>
import FooterComponent from './components/FooterComponent.vue';
import HeaderComponent from './components/HeaderComponent.vue';
import AdminPage from './pages/AdminPage.vue';
import EditPage from './pages/EditPage.vue';
import HomePage from './pages/HomePage.vue';


export default {
    name: 'App',
    data() {
        return {
            page: localStorage.getItem('page') || 'HomePage',
            pageId: localStorage.getItem('pageId') || 'pageId',
            API: 'http://127.0.0.1:8000/api/',
            PUBLIC: 'http://127.0.0.1:8000/storage/',
            isUser: false,
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
    },
    mounted() {
        if (localStorage.getItem('token')) {
            this.getUser();
        }
    },
};
</script>
