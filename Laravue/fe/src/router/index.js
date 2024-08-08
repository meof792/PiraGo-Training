import { createRouter, createWebHistory } from 'vue-router';

// Import các component cho các routes
import MainPage from '../views/MainPage.vue';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import Noti from '../views/Noti.vue';

// Định nghĩa các routes
const routes = [
  {
    path: '/noti',
    name: 'Noti',
    component: Noti
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/',
    name: 'MainPage',
    component: MainPage
  },
];

// Tạo router instance
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router;
