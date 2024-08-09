<template>
  <div class="container">
    <div class="additional-div"></div>
    <div>
      <div class="row mb-4">
        <div class="col-lg-12 col-md-12 col-12">
          <div class="noti-box">
            <div class="noti-content" v-if="notifications">
              <h3>
                Thông báo:
                <router-link to="#">{{ notifications.title }}</router-link>
              </h3>
              <div class="noti-header">
                <img src="test.png" alt="Avatar" class="avatar" />
                <div class="user-info">
                  <p class="username">{{ notifications.by }}</p>
                  <small class="date">{{ notifications.timestamp }}</small>
                </div>
              </div>
              <div class="noti-body">
                <div style="max-height: 100px; overflow-y: auto">
                  <p>
                    {{ notifications.content }}
                  </p>
                </div>
                <div class="noti-actions">
                  <router-link to="#" class="btn like-btn"
                    >Xem chi tiết</router-link
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-lg-6 col-md-6 col-12 mb-4">
          <div class="task-box">
            <h3>Công việc:</h3>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
          <div class="task-box">
            <h3>Công việc:</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
          <div class="last-box">
            <h3>Tiến độ:</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from 'vue-router';

const router = useRouter();
const notifications = ref({});
// const tasks = ref([]);

const fetchNoti = async () => {
  try {
    const response = await axios.get(
      "http://127.0.0.1:8000/api/first-noti",
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
    notifications.value = response.data;
  } catch (error) {
    console.error(error);
  }
};

onMounted(() => {
  if (!sessionStorage.getItem("id")) {
    router.push("/login");
  }
  fetchNoti();
});

</script>

<style scoped>
.container {
  max-width: 100%;
  overflow-x: hidden;
  padding: 15px;
}

a {
  text-decoration: none;
  color: #f01212;
}

/* Section 1 */
.noti-box {
  width: 100%;
  height: 300px;
  background-color: #fff;
  border-radius: 15px; /* Bo góc */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Đổ bóng */
  padding: 20px;
  box-sizing: border-box;
}
.noti-header {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-right: 10px;
}

.user-info {
  display: flex;
  flex-direction: column;
}

.username {
  font-weight: bold;
  margin: 0;
}

.date {
  color: #888;
}

.noti-body {
  margin-top: 10px;
  height: 200px;
}

.noti-actions {
  margin-top: 15px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.btn {
  padding: 10px 15px;
  margin-right: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.like-btn {
  background-color: #007bff;
  color: white;
}
/* End Section 1 */

/* Section 2 */
.task-box {
  width: 100%;
  height: 300px;
  background-color: #fff;
  border-radius: 15px; /* Bo góc */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Đổ bóng */
  padding: 20px;
  box-sizing: border-box;
  margin-bottom: 15px; /* Add margin-bottom for spacing */
}
/* End Section 2 */

/* Section 3 */
.last-box {
  width: 100%;
  height: 180px;
  background-color: #fff;
  border-radius: 15px; /* Bo góc */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Đổ bóng */
  padding: 20px;
  box-sizing: border-box;
  margin-bottom: 15px; /* Add margin-bottom for spacing */
}
/* End Section 3 */

@media (max-width: 768px) {
  .noti-box {
    width: 100%;
    height: 300px;
    background-color: #fff;
    border-radius: 15px; /* Bo góc */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Đổ bóng */
    padding: 20px;
    box-sizing: border-box;
  }
}
</style>
