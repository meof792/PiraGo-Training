<template>
  <div class="addmember-container">
    <div class="additional-div"></div>
    <div class="addmember-form">
      <h2>Đăng ký thành viên</h2>
      <form @submit.prevent="addMember">
        <div class="form-group">
          <label for="username">Tên</label>
          <input
            type="text"
            id="username"
            v-model="username"
            @input="errorMessage = ''"
            placeholder="Nhập tên của thành viên"
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
            @input="errorMessage = ''"
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
            @input="errorMessage = ''"
            placeholder="Nhập mật khẩu"
            required
          />
        </div>
        <div class="form-group">
          <label for="salary">Mức lương</label>
          <input
            type="number"
            id="salary"
            v-model="salary"
            @input="errorMessage = ''"
            placeholder="Có thể bỏ trống"
          />
        </div>
        <button type="submit">Đăng ký</button>
        <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();
const username = ref("");
const salary = ref("");
const password = ref("");
const confirmPassword = ref("");
const errorMessage = ref("");

const addMember = async () => {
  if (password.value !== confirmPassword.value) {
    errorMessage.value = "Vui lòng nhập đúng mật khẩu";
    return;
  }

  try {
    const response = await axios.post("http://127.0.0.1:8000/api/add-member", {
      id: sessionStorage.getItem("id"), //id người gửi
      username: username.value,
      salary: salary.value,
      password: password.value,
    });

    if (response.data.success) {
      alert(
        "Đăng kí thành công! Mã đăng nhập của thành viên là " + response.data.id
      );
      router.push("/admin-member");
    } else {
      errorMessage.value = response.data.msg;
    }
  } catch (error) {
    console.error(error);
  }
};

onMounted(() => {
  if (
    !sessionStorage.getItem("id") ||
    sessionStorage.getItem("is_manager") != 1
  ) {
    router.push("/login");
  }
});
</script>

<style scoped>
.addmember-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f0f0f0;
}

.addmember-form {
  background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  width: 100%;
}

.addmember-form h2 {
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