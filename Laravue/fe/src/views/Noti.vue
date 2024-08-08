<template>
  <div>
    <div class="additional-div"></div>
    <div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
          <div class="noti-box">
            <h3>Thông báo:</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-6">
          <div class="task-box">
            <h3>Công việc:</h3>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-6">
          <div class="task-box">
            <h3>Công việc:</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
          <div class="last-box">
            <h3>Công việc:</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  name: "Noti",
  components: {},
};
</script>
  
<style>
.additional-div {
  display: none; /* Ẩn mặc định */
}

.task-box {
  width: 100%;
  height: 200px;
  background-color: #fff;
  border-radius: 15px; /* Bo góc */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Đổ bóng */
  padding: 20px;
  margin: 20px;
  box-sizing: border-box;
}

.noti-box {
  width: 100%;
  height: 400px;
  background-color: #fff;
  border-radius: 15px; /* Bo góc */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Đổ bóng */
  padding: 20px;
  margin: 20px;
  box-sizing: border-box;
}

.last-box {
  width: 100%;
  height: 180px;
  background-color: #fff;
  border-radius: 15px; /* Bo góc */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Đổ bóng */
  padding: 20px;
  margin: 20px;
  box-sizing: border-box;
}

@media (max-width: 768px) {
  .additional-div {
    display: block;
    height: 100px;
  }
  .noti-box {
    width: 100%;
    height: 300px;
    background-color: #fff;
    border-radius: 15px; /* Bo góc */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Đổ bóng */
    padding: 20px;
    margin: 20px;
    box-sizing: border-box;
  }
}
</style>