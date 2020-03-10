import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/backend/Home.vue';
import Category from './components/backend/Category.vue';
import Post from './components/backend/Post.vue';
Vue.use(VueRouter);

const routes = [
    {
        path : '/',
        component : Home
    },
    {
        path : '/category',
        component : Category
    },
    {
        path : '/post',
        component : Post
    },
];

export default new VueRouter({
    routes,
    mode : 'history'
});