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
//Slider
import Slider from './components/admins/pages/sliders/index.vue';
import Slider_Create from './components/admins/pages/sliders/create.vue';
import Slider_Edit from './components/admins/pages/sliders/edit.vue';
//Banner
import Banner from './components/admins/pages/banners/index.vue';
import Banner_Create from './components/admins/pages/banners/create.vue';
import Banner_Edit from './components/admins/pages/banners/edit.vue';


import axios from 'axios';
const router = new VueRouter({  
    mode: 'history',
    base: '/be',
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
            path: '/',
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
                    name: 'dashboard',
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
                    path: 'user',
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
                
                  //Slider
                 {
                    path: 'slider',
                    name: 'slider',
                    component: Slider,
                },
                {
                    path: 'slider/create',
                    name: 'slider-create',
                    component: Slider_Create,
                },
                {
                    path: 'slider/edit/:id',
                    name: 'slider-edit',
                    component: Slider_Edit
                },    
                //Banner
                {
                    path: 'banner',
                    name: 'banner',
                    component: Banner,
                },
                {
                    path: 'banner/create',
                    name: 'banner-create',
                    component: Banner_Create,
                },
                {
                    path: 'banner/edit/:id',
                    name: 'banner-edit',
                    component: Banner_Edit
                },   
            ]
        },
    ]
})

export default router;