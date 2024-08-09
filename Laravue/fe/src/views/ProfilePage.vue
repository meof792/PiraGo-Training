<template>
  <div class="container">
    <div class="additional-div"></div>
    <div class="profile-container">
      <div class="avatar-container">
        <img src="test.png" alt="Avatar" class="avatar" />
      </div>
      <div class="details-container">
        <div class="left-section">
          <div class="form-group">
            <label for="id">Mã số đăng nhập:</label>
            <input
              type="text"
              id="id"
              class="form-control"
              v-model="id"
              :placeholder="id"
              disabled
            />
          </div>
          <div class="form-group">
            <label for="newPassword">Đổi mật khẩu:</label>
            <input
              type="password"
              id="newPassword"
              class="form-control"
              placeholder="Nhập mật khẩu mới"
              v-model="newPassword"
            />
          </div>
          <div class="form-group">
            <label for="confirm-password">Nhập lại mật khẩu:</label>
            <input
              type="password"
              id="confirm-password"
              class="form-control"
              v-model="confirmPassword"
              placeholder="Nhập lại mật khẩu mới"
            />
          </div>
        </div>
        <div class="right-section">
          <div class="form-group">
            <label for="email">Email:</label>
            <input
              type="email"
              id="email"
              class="form-control"
              v-model="email"
              :placeholder="email || 'Bạn chưa nhập email'"
            />
          </div>
          <div class="form-group">
            <label for="birthday">Ngày sinh:</label>
            <input
              type="date"
              id="birthday"
              class="form-control"
              v-model="birthday"
            />
          </div>
          <div class="form-group">
            <label for="salary">Lương:</label>
            <input
              type="text"
              id="salary"
              class="form-control"
              :placeholder="salary + ' VNĐ' || 0 + ' VNĐ'"
              disabled
            />
          </div>
        </div>
      </div>
      <div class="text-center">
        <div class="form-group">
          <label for="password">Nhập mật khẩu hiện tại để xác nhận:</label>
          <input
            type="password"
            id="password"
            class="form-control"
            v-model="password"
            placeholder="Nhập mật khẩu hiện tại để xác nhận"
          />
        </div>
        <button class="btn btn-primary" @click="updateProfile">Cập nhật</button>
      </div>
    </div>
  </div>
</template>
  
<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();

const id = ref("");
const salary = ref("");
const newPassword = ref("");
const confirmPassword = ref("");
const password = ref("");
const email = ref("");
const birthday = ref("");

onMounted(() => {
  if (!sessionStorage.getItem("id")) {
    router.push("/login");
  }
  fetchUsers();
});

const fetchUsers = async () => {
  try {
    const response = await axios.get(
      "http://127.0.0.1:8000/api/get-user",
      {
        params: {
          id: sessionStorage.getItem("id"), // id người dùng
        },
      },
      {
        headers: {
          "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        },
      }
    );
    id.value = response.data.id;
    email.value = response.data.email;
    salary.value = response.data.salary;
    birthday.value = response.data.birthday;
  } catch (error) {
    console.error(error);
  }
};

const updateProfile = async () => {
  if (newPassword.value !== confirmPassword.value) {
    alert("Mật khẩu mới và mật khẩu xác nhận không khớp.");
    return;
  }

  try {
    const response = await axios.post(
      "http://127.0.0.1:8000/api/update",
      {
        id: sessionStorage.getItem("id"),
        email: email.value,
        birthday: birthday.value,
        password: password.value,
        newPassword: newPassword.value,
      },
      {
        headers: {
          "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        },
      }
    );
    if(response.data.success){
        alert("Cập nhật thành công");
        fetchUsers();
    }else{
        alert(response.data.msg)
    }
  } catch (error) {
    console.error("Cập nhật thất bại", error);
  }
};
</script>
  
<style scoped>
.container {
  padding-top: 70px;
}

.avatar-container {
  text-align: center;
}

.details-container {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.left-section,
.right-section {
  width: 45%;
}

.form-group {
  margin-bottom: 20px;
}

.form-control {
  width: 100%;
  padding: 15px;
  font-size: 18px;
  height: 50px;
  box-sizing: border-box;
}

.avatar {
  width: 250px;
  height: 300px;
  border-radius: 50px;
  margin-bottom: 20px;
}

.btn-primary {
  padding: 10px 20px;
  font-size: 18px;
}
</style>
  