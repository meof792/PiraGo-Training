<template>
  <div class="container">
    <div class="additional-div"></div>
    <div>
      <h3>Danh sách thành viên:</h3>
      <button class="btn btn-info">Thêm nhân viên</button>
      <div class="row">
        <div
          class="col-lg-3 col-md-6 col-sm-6 col-6"
          style="padding: 10px"
          v-for="member in paginatedMember"
          :key="member.id"
        >
        <router-link class="card" style="width: 100%; height: 100%" to="#">
          <img src="test.png" alt="Avatar"  style="width: 100%; height:250px" />
          <div class="username">{{ member.username }}</div>
          <div class="info">
            <span class="info-label">Lương:</span> {{ member.salary }}
          </div>
          <div class="info">
            <span class="info-label">Ngày sinh:</span>
            {{ member.birthday }}
          </div>
          <div class="info">
            <span class="info-label">Thành viên từ:</span>
            {{ member.since }}
          </div>
        </router-link>
        </div>
        <div class="pagination">
          <button
            type="button"
            @click="prevPageAndScroll"
            :disabled="currentPage === 1"
          >
            Previous
          </button>
          <span v-for="page in displayPages" :key="page">
            <button
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
// const tasks = ref([]);

const members = ref([]);
const currentPage = ref(1);
const itemsPerPage = ref(8);

const totalPages = computed(() => {
  return Math.ceil(members.value.length / itemsPerPage.value);
});

const paginatedMember = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  const end = start + itemsPerPage.value;
  return members.value.slice(start, end);
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
const fetchUsers = async () => {
  try {
    const response = await axios.get(
      "http://127.0.0.1:8000/api/get-users",
      {
        params: {
          id: localStorage.getItem("id"), // id người dùng
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
  if (!localStorage.getItem("id")) {
    router.push("/login");
  }
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
  .additional-div {
    display: block;
    height: 100px;
  }
}
</style>