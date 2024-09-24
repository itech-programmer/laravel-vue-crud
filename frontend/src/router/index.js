import { createRouter, createWebHistory } from 'vue-router'

const ProductsListView = () => import('@/views/ProductListView.vue');
const ProductCreateView = () => import('@/views/ProductCreateView.vue');
const ProductEditView = () => import('@/views/ProductEditView.vue');
const ProductView = () => import('@/views/ProductView.vue');

const routes = [
    {
        path: '/',
        name: 'home',
        component: ProductsListView,
    },
    {
        path: '/products/create',
        name: 'product-create',
        component: ProductCreateView,
    },
    {
        path: '/products/edit/:id',
        name: 'product-edit',
        component: ProductEditView,
    },
    {
        path: '/products/show/:id',
        name: 'product-show',
        component: ProductView,
    },
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
})

export default router
