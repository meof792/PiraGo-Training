<template>
  <div class="navbar">
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
        <a href="#" @click.prevent="toggleDropdownAdmin" class="dropdown-toggle"
          >Quản lý</a>
        <ul v-if="dropdownAdminOpen" class="dropdown-menu">
          <li><router-link to="/admin-tasks">Quản lý công việc</router-link></li>
          <li><router-link to="/admin-member">Quản lý nhân viên</router-link></li>
        </ul>
      </li>
      <li class="navbar-item dropdown" v-if="username">
        <a href="#" @click.prevent="toggleDropdown" class="dropdown-toggle"
          >Xin chào: <i>{{ username }}</i></a
        >
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
// import { useRouter } from "vue-router";

const username = localStorage.getItem("username");
const isMenuOpen = ref(false);
const dropdownOpen = ref(false);
const dropdownAdminOpen = ref(false);
// const router = useRouter();

const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value;
};
const toggleDropdownAdmin = () => {
  dropdownAdminOpen.value = !dropdownAdminOpen.value; // Thêm hàm để toggle dropdown Quản lý
};


const logout = () => {
  localStorage.removeItem("id");
  localStorage.removeItem("username");
  // router.push('/');
  window.location.href="/login";
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
  height: 100vh;
  padding: 20px;
  box-sizing: border-box;
  position: relative;
  z-index: 1000;
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
  align-content: center;
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
    flex-direction: row;
    align-items: center;
    position: fixed; /* Giữ Navbar cố định ở phía trên */
    top: 0; /* Đặt Navbar ở vị trí trên cùng */
    left: 0;
    right: 0;
    z-index: 1000; /* Đảm bảo Navbar luôn nằm trên cùng */
  }

  .navbar-menu {
    flex-direction: row;
    width: auto;
    height: auto;
    margin: 0;
  }

  .navbar-item {
    margin: 0 10px;
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
