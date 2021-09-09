import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);


import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import Dashboard from './components/admins/Dashboard.vue';
import NotFound from './components/NotFound.vue';

//Home
import Home from './components/admins/pages/Home.vue';
//Profile
import Profile from './components/admins/pages/profile/index.vue';
import Profile_Edit from './components/admins/pages/profile/edit.vue';
//User
import User from './components/admins/pages/users/index.vue';
import User_Create from './components/admins/pages/users/create.vue';
import User_Edit from './components/admins/pages/users/edit.vue';
//Category
import Category from './components/admins/pages/categories/index.vue';
import Category_Create from './components/admins/pages/categories/create.vue';
import Category_Edit from './components/admins/pages/categories/edit.vue';
//Product
import Product from './components/admins/pages/products/index.vue';
import Product_Create from './components/admins/pages/products/create.vue';
import Product_Edit from './components/admins/pages/products/edit.vue';

//Frontend
import Dashboard_Frontend from './components/frontend/Dashboard.vue';
import Home_Frontend from './components/frontend/pages/Home.vue';
import Shop from './components/frontend/pages/Shop.vue';
import Blog from './components/frontend/pages/Blog.vue';
import About from './components/frontend/pages/About.vue';
import Contact from './components/frontend/pages/Contact.vue';
import Cart from './components/frontend/pages/Cart.vue';
import ProductDetail from './components/frontend/pages/ProductDetail.vue';

import axios from 'axios';
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
        //Admin
        {
            path: '/admin-manager',
            name: 'dashboard',
            component: Dashboard,
            beforeEnter: (to, form, next ) =>{
                axios.get('/api/authenticated').then(() => {
                    next();
                }).catch(() => {
                    return next({name: 'login'});
                });
            },
            children: [
                 //Home
                 {
                    path: '/',
                    component: Home,
                },
                //Profile
                {
                    path: 'profile',
                    name: 'profile',
                    component: Profile,
                },
                {
                    path: 'profile/edit/:id',
                    name: 'profile-edit',
                    component: Profile_Edit,
                },
                //User
                {
                    path: '/user',
                    name: 'user',
                    component: User,
                },
                {
                    path: 'user/create',
                    name: 'user-create',
                    component: User_Create,
                },
                {
                    path: 'user/edit/:id',
                    name: 'user-edit',
                    component: User_Edit,
                },

                //Category
                {
                    path: 'category',
                    name: 'category',
                    component: Category,
                }, 
                {
                    path: 'category/create',
                    name: 'category-create',
                    component: Category_Create,
                },
                {
                    path: 'category/edit/:id',
                    name: 'category-edit',
                    component: Category_Edit
                },

                //Product
                {
                    path: 'product',
                    name: 'product',
                    component: Product,
                },
                {
                    path: 'product/create',
                    name: 'product-create',
                    component: Product_Create,
                },
                {
                    path: 'product/edit/:id',
                    name: 'product-edit',
                    component: Product_Edit
                },      
            ]
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