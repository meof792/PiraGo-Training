<template>
  <div class="login-container">
    <div class="login-form">
      <h2>Đăng nhập</h2>
      <form @submit.prevent="login">
        <div class="form-group">
          <label for="id">Mã số đăng nhập</label>
          <input
            type="text"
            id="id"
            v-model="id"
            placeholder="Nhập mã số đăng nhập"
            required
          />
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
        </div>
        Chưa có tài khoản? <router-link to="/register">Đăng ký</router-link> ngay
        <button type="submit">Xác nhận</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const id = ref('');
const password = ref('');
const router = useRouter();

const login = async () => {
  try {
    const response = await axios.post(
      'http://127.0.0.1:8000/api/login',
      {
        id: id.value,
        password: password.value,
      },
      {
        headers: {
          'X-CSRF-TOKEN': document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content'),
        },
      }
    );

    if (response.data.success) {
      localStorage.setItem('id', response.data.id);
      localStorage.setItem('username', response.data.username);
      alert('Đăng nhập thành công!');
      // router.push('/');
      window.location.href="/";
    } else {
      alert('Tên tài khoản hoặc mật khẩu không đúng');
    }
  } catch (error) {
    console.error(error);
  }
};
onMounted(() => {
  if (localStorage.getItem("id")) {
    router.push("/");
  }
});
</script>

<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f0f0f0;
}

.login-form {
  background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  width: 100%;
}

.login-form h2 {
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
</style>
