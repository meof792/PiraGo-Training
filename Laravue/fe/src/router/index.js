import { createRouter, createWebHistory } from 'vue-router';

// Import các component cho các routes
import MainPage from '../views/MainPage.vue';
import LoginPage from '../views/LoginPage.vue';
import RegisterPage from '../views/RegisterPage.vue';
import NotiPage from '../views/NotiPage.vue';
import MemberPage from '../views/MemberPage.vue';
import AddMember from '../views/AddMember.vue';
import ProfilePage from '../views/ProfilePage.vue';

// Định nghĩa các routes
const routes = [
  {
    path: '/profile',
    name: 'ProfilePage',
    component: ProfilePage
  },
  {
    path: '/add-member',
    name: 'AddMember',
    component: AddMember
  },
  {
    path: '/admin-member',
    name: 'MemberPage',
    component: MemberPage
  },
  {
    path: '/noti',
    name: 'NotiPage',
    component: NotiPage
  },
  {
    path: '/register',
    name: 'RegisterPage',
    component: RegisterPage
  },
  {
    path: '/login',
    name: 'LoginPage',
    component: LoginPage
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
