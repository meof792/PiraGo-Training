<template>
  <div class="signup-container">
    <div class="signup-form">
      <h2>Đăng ký</h2>
      <form @submit.prevent="register">
        <div class="form-group">
          <label for="username">Tên</label>
          <input
            type="text"
            id="username"
            v-model="username"
            placeholder="Nhập Tên của bạn"
            required
          />
          <small>Đây là tên sẽ hiển thị với các thành viên khác</small>
        </div>
        <div class="form-group">
          <label for="password">Mật khẩu</label>
          <input
            type="password"
            id="password"
            v-model="password"
            placeholder="Nhập mật khẩu"
            required
          />
          <small>Mật khẩu phải có tối thiểu 6 kí tự</small>
        </div>
        <div class="form-group">
          <label for="confirm-password">Nhập lại mật khẩu</label>
          <input
            type="password"
            id="confirm-password"
            v-model="confirmPassword"
            placeholder="Nhập mật khẩu"
            required
          />
        </div>
        <div class="form-group">
          <label for="company">Nhập tên công ty/tổ chức</label>
          <input
            type="text"
            id="company"
            v-model="company"
            placeholder="Nhập tên công ty/tổ chức"
            required
          />
          <small>Mặc định bạn sẽ là người quản lý công ty</small>
        </div>
        Đã có tài khoản? <router-link to="/login">Đăng nhập</router-link> ngay
        <button type="submit">Đăng ký</button>
        <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
      </form>
    </div>
  </div>
</template>
  
  <script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const username = ref("");
const company = ref("");
const password = ref("");
const confirmPassword = ref("");
const errorMessage = ref("");

const router = useRouter();

const register = async () => {
  if (password.value !== confirmPassword.value) {
    errorMessage.value = "Vui lòng nhập đúng mật khẩu";
    return;
  }

  try {
    const response = await axios.post("http://127.0.0.1:8000/api/register", {
      username: username.value,
      company: company.value,
      password: password.value,
    });

    if (response.data.success) {
      alert("Đăng kí thành công! Mã đăng nhập của bạn là " + response.data.id);
      router.push("/login"); // Redirect to login page
    } else {
      errorMessage.value = response.data.msg;
    }
  } catch (error) {
    console.error(error);
  }
};
</script>
  
  <style scoped>
.signup-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f0f0f0;
}

.signup-form {
  background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  width: 100%;
}

.signup-form h2 {
  margin-bottom: 20px;
  text-align: center;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

button {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: white;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}

.error-message {
  color: red;
  text-align: center;
  margin-top: 10px;
}
</style>
  