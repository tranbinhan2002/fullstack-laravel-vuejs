import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);


import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import NotFound from './components/NotFound.vue';

//Frontend
import Dashboard_Frontend from './components/frontend/Dashboard.vue';
import Home_Frontend from './components/frontend/pages/Home.vue';
import Shop from './components/frontend/pages/Shop.vue';
import Blog from './components/frontend/pages/Blog.vue';
import About from './components/frontend/pages/About.vue';
import Contact from './components/frontend/pages/Contact.vue';
import Cart from './components/frontend/pages/Cart.vue';
import ProductDetail from './components/frontend/pages/ProductDetail.vue';

const router = new VueRouter({  
    mode: 'history',
    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        //User
        {
            path: '/',
            component: Dashboard_Frontend,
            children: [
                {
                    path: '/',
                    name: 'home',
                    component: Home_Frontend
                },
                {
                    path: '/shop',
                    name: 'shop',
                    component: Shop
                },
                {
                    path: '/blog',
                    name: 'blog',
                    component: Blog
                },  
                {
                    path: '/about',
                    name: 'about',
                    component: About
                },
                {
                    path: '/contact',
                    name: 'contact',
                    component: Contact
                },  
                {
                    path: '/cart',
                    name: 'cart',
                    component: Cart
                }, 
                {
                    path: '/product-detail',
                    name: 'product-detail',
                    component: ProductDetail
                },  
            ]
        }
    ]
})

export default router;