<template>
  <div class="container">
    <div class="additional-div"></div>
    <div>
      <h3>Danh sách thành viên:</h3>
      <input
        type="text"
        placeholder="Nhập tên thành viên muốn tìm"
        v-model="searchQuery"
        @keyup.enter="searchMembers"
        class="form-control mb-3"
      />
      <div class="row">
        <div
          class="col-lg-3 col-md-6 col-sm-6 col-6"
          style="padding: 10px; padding-left: 80px"
          v-for="member in paginatedMember"
          :key="member.id"
        >
          <router-link class="card" style="width: 70%; height: 100%; text-align: center; align-items: center; justify-content: center;" to="#">
            <img
              src="test.png"
              alt="Avatar"
              style="width: 100%; height: 200px;"
            />
            <div class="username"><b>{{ member.username }}</b></div>
            <div class="info">
              <span class="info-label">Mã đăng nhập:</span>
              {{ member.id }}
            </div>
            <div class="info">
              <span class="info-label">Ngày sinh:</span>
              {{ member.birthday }}
            </div>
            <div class="info">
              <span class="info-label">Lương:</span> {{ member.salary }}
            </div>
            <div class="info">
              <span class="info-label">Thành viên từ:</span>
              {{ member.since }}
            </div>
          </router-link>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
          <router-link to="/add-member" class="btn btn-info"
            >Thêm thành viên</router-link
          >
        </div>
      </div>
      <div class="row">
        <div class="pagination">
          <button
            class="page-link"
            type="button"
            @click="prevPageAndScroll"
            :disabled="currentPage === 1"
          >
            Previous
          </button>
          <span v-for="page in displayPages" :key="page">
            <button
              class="page-link"
              v-if="page !== '...'"
              type="button"
              @click="goToPage(page)"
              :class="{ active: page === currentPage }"
            >
              {{ page }}
            </button>
            <span v-else>...</span>
          </span>
          <button
            class="page-link"
            type="button"
            @click="nextPageAndScroll"
            :disabled="currentPage === totalPages"
          >
            Next
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();
const members = ref([]);
const currentPage = ref(1);
const itemsPerPage = ref(8);
const searchQuery = ref(""); // For storing the search query

const totalPages = computed(() => {
  return Math.ceil(filteredMembers.value.length / itemsPerPage.value);
});

const filteredMembers = computed(() => {
  // Filter members based on the search query
  return members.value.filter((member) =>
    member.username.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

const paginatedMember = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  const end = start + itemsPerPage.value;
  return filteredMembers.value.slice(start, end);
});

const displayPages = computed(() => {
  const totalPagesValue = totalPages.value;
  const currentPageValue = currentPage.value;
  let pages = [];
  let startPage = 1;
  let endPage = totalPagesValue;
  const maxVisiblePages = 5; // Số lượng trang hiển thị tối đa

  if (totalPagesValue > maxVisiblePages) {
    if (currentPageValue <= 3) {
      endPage = maxVisiblePages;
    } else if (currentPageValue >= totalPagesValue - 2) {
      startPage = totalPagesValue - maxVisiblePages + 1;
    } else {
      startPage = currentPageValue - 2;
      endPage = currentPageValue + 2;
    }
  }

  if (startPage !== 1) {
    pages.push(1);
    if (startPage > 2) {
      pages.push("...");
    }
  }

  for (let i = startPage; i <= endPage; i++) {
    pages.push(i);
  }

  if (endPage !== totalPagesValue) {
    if (endPage < totalPagesValue - 1) {
      pages.push("...");
    }
    pages.push(totalPagesValue);
  }

  return pages;
});

const goToPage = (page) => {
  if (page === "...") return;
  currentPage.value = page; // Cập nhật currentPage
  scrollToNew();
};

const nextPageAndScroll = () => {
  nextPage();
  scrollToNew();
};

const prevPageAndScroll = () => {
  prevPage();
  scrollToNew();
};

const scrollToNew = () => {
  const element = document.getElementById("new");
  if (element) {
    element.scrollIntoView({ behavior: "smooth" });
  }
};

const nextPage = () => {
  // Ensure you have a method to check if the current page is not the last page
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
};

const prevPage = () => {
  // Ensure you have a method to check if the current page is not the first page
  if (currentPage.value > 1) {
    currentPage.value--;
  }
};

const searchMembers = () => {
  currentPage.value = 1; // Reset to first page when searching
};

const fetchUsers = async () => {
  try {
    const response = await axios.get(
      "http://127.0.0.1:8000/api/get-users",
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
    members.value = response.data;
    members.value = response.data.map((member) => {
      // Convert timestamp to date
      return {
        ...member,
        since: new Date(member.since).toLocaleDateString(), // Assuming `since` is a Unix timestamp in seconds
      };
    });
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
  document.title = "Quản lí thành viên"
  fetchUsers();
});
</script>

<style scoped>
a {
  display: block;
  text-decoration: none;
  color: #333;
  transition: opacity 0.3s ease; /* Smooth transition */
}

a:hover {
  opacity: 0.7; /* Fade effect */
}
.container {
  max-width: 100%;
  overflow-x: hidden;
  padding: 15px;
  height: 100vh;
}
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}

.pagination button {
  margin: 0 10px;
}
@media (max-width: 768px) {
}
</style>