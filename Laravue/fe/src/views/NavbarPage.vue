<template>
  <div class="navbar">
    <div class="hamburger" @click="toggleMenu">
      &#9776; <!-- Ký tự hamburger -->
    </div>
    <ul :class="{ 'navbar-menu': true, 'navbar-menu--active': isMenuOpen }">
      <li class="navbar-item"><router-link to="/">Trang chủ</router-link></li>
      <li class="navbar-item">
        <router-link to="/info">Giới thiệu</router-link>
      </li>
      <li class="navbar-item">
        <router-link to="/noti">Thông báo</router-link>
      </li>
      <li class="navbar-item">
        <router-link to="/tasks">Công việc</router-link>
      </li>
      <li class="navbar-item dropdown">
        <a href="#" @click.prevent="toggleDropdownAdmin" class="dropdown-toggle">Quản lý</a>
        <ul v-if="dropdownAdminOpen" class="dropdown-menu">
          <li>
            <router-link to="/admin-tasks">Quản lý công việc</router-link>
          </li>
          <li>
            <router-link to="/admin-member">Quản lý thành viên</router-link>
          </li>
        </ul>
      </li>
      <li class="navbar-item dropdown" v-if="username">
        <a href="#" @click.prevent="toggleDropdown" class="dropdown-toggle">Xin chào: <i>{{ username }}</i></a>
        <ul v-if="dropdownOpen" class="dropdown-menu">
          <li><router-link to="/profile">Hồ sơ</router-link></li>
          <li><a @click="logout">Đăng xuất</a></li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref } from "vue";

const username = sessionStorage.getItem("username");
const isMenuOpen = ref(false);
const dropdownOpen = ref(false);
const dropdownAdminOpen = ref(false);

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};

const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value;
  dropdownAdminOpen.value = false;
};

const toggleDropdownAdmin = () => {
  dropdownAdminOpen.value = !dropdownAdminOpen.value;
  dropdownOpen.value = false;
};

const logout = () => {
  sessionStorage.removeItem("id");
  sessionStorage.removeItem("username");
  window.location.href = "/login";
};
</script>

<style scoped>
/* Navbar CSS */
.navbar {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  background-color: #333;
  width: 100%;
  padding: 20px;
  height: 100vh;
  box-sizing: border-box;
  position: relative;
  z-index: 1000;
}

/* Hamburger Menu */
.hamburger {
  display: none;
  font-size: 30px;
  cursor: pointer;
  color: white;
}

/* Navbar Menu */
.navbar-menu {
  list-style-type: none;
  padding: 0;
  margin: 0;
  width: 100%;
  display: flex;
  flex-direction: column;
}

.navbar-item {
  margin: 10px 0;
}

.navbar-item a {
  text-decoration: none;
  color: white;
  font-size: 18px;
  display: block;
  padding: 10px;
}

.navbar-item a:hover {
  background-color: #575757;
  color: #ddd;
}

/* Media Queries for Small Screens */
@media (max-width: 768px) {
  .navbar {
    height: auto;
    flex-direction: column;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
  }

  .hamburger {
    display: block;
  }

  .navbar-menu {
    display: none;
    flex-direction: column;
    width: 100%;
    height: auto;
    margin: 0;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #333;
  }

  .navbar-menu--active {
    display: flex;
  }

  .navbar-item {
    margin: 0;
  }

  .navbar-item a {
    font-size: 16px;
    padding: 10px 15px;
  }
}

/* Dropdown CSS */
.dropdown-toggle {
  cursor: pointer;
}

.dropdown-menu {
  display: none;
  list-style-type: none;
  padding: 0;
  margin: 0;
  background-color: #333;
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
}

.dropdown-menu li {
  margin: 0;
}

.dropdown-menu li a {
  display: block;
  padding: 10px;
  color: white;
  text-decoration: none;
}

.dropdown-menu li a:hover {
  background-color: #575757;
}

/* Hiển thị menu dropdown khi mở */
.dropdown .dropdown-menu {
  display: block;
}
</style>
