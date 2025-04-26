import { createRouter, createWebHistory } from 'vue-router';
import store from './store';
import Login from './components/Auth/Login.vue';
import Register from './components/Auth/Register.vue';
import ProductList from './components/Products/ProductList.vue';

const routes = [
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { 
        path: '/products', 
        component: ProductList, 
        meta: { requiresAuth: true } 
    },
    { path: '/', redirect: '/products' }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.auth.isAuthenticated) {
        next('/login');
    } else {
        next();
    }
});

export default router;