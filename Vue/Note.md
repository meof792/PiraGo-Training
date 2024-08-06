# Note đơn giản

## Basics

- Tạo ứng dụng Vue

```vue
import { createApp } from 'vue'
// import the root component App from a single-file component.
import App from './App.vue'

const app = createApp(App)
app.mount('#app')
```

- Syntax
    - sử dụng cú pháp hai dấu ngoặc nhọn ({{ }}) để chèn dữ liệu vào HTML
    - sử dụng v-html chèn html thô vào
    ```vue
    <template>
    <p v-html="rawHtml"></p>
    </template>

    <script>
    export default {
    data() {
        return {
        rawHtml: '<span style="color: red">This should be red.</span>'
        };
    }
    };
    </script>
    ```
    - @click, v-bind, v-if, v-for,...

- Lifecycle hooks

## Reactivity

## Methods

- Là nơi định nghĩa các hàm có thể gọi được trong component
- Dùng để xử lý sự kiện, logic, thay đổi dữ liệu
```vue
<script>
methods:{
//code here
}
</script>
```

## Computed

- Dùng để xử lý hoặc biến đổi dữ liệu trước khi hiển thị
- Khác biệt so với Methods:
    - Không nhận tham số
    - Lưu bộ nhớ vào cache, chỉ được tính toán lại khi các phụ thuộc thay đổi, còn methods luôn được gọi lại mỗi khi component render lại

## Watch, Deep watch, Eager watch (Immediate Watch)

- Watch theo dõi các thay đổi của một thuộc tính hoặc một biểu thức cụ thể

```vue
<template>
  <div>
    <input v-model="message" />
    <p>{{ message }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: 'Hello Vue!'
    };
  },
  watch: {
    message(newVal, oldVal) {
      console.log(`Message changed from ${oldVal} to ${newVal}`);
    }
  }
};
</script>
```

- Vue chỉ theo dõi các thay đổi ở cấp độ gốc của một đối tượng hoặc một mảng
- Điều này có nghĩa là nếu một thuộc tính sâu bên trong một đối tượng thay đổi, Vue sẽ không phát hiện ra thay đổi đó trừ khi sử dụng tùy chọn`1deep`

```vue
<template>
  <div>
    <input v-model="user.name" />
    <p>{{ user.name }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        name: 'John Doe',
        address: {
          street: '123 Main St',
          city: 'Hometown'
        }
      }
    };
  },
  watch: {
    user: {
      handler(newVal, oldVal) {
        console.log('User object changed:', newVal, oldVal);
      },
      deep: true
    }
  }
};
</script>
```

- Eager watch (Immediate Watch) sẽ thực hiện ngay 1 lần đầu tiên, và sẽ được gọi sau đó nếu có thay đổi thì mới thực hiện

```vue
<template>
  <div>
    <input v-model="message" />
    <p>{{ message }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: 'Hello Vue!'
    };
  },
  watch: {
    message: {
      handler(newVal, oldVal) {
        console.log(`Message changed from ${oldVal} to ${newVal}`);
      },
      immediate: true
    }
  }
};
</script>
```

## Binding and Event Handling

## Component

- Props cho phép truyền dữ liệu từ component cha sang component con

    - ParentComponent.vue:

    ```vue
    <template>
    <div>
        <ChildComponent :message="parentMessage" />
    </div>
    </template>

    <script>
    import ChildComponent from './ChildComponent.vue';

    export default {
    components: {
        ChildComponent
    },
    data() {
        return {
        parentMessage: 'Hello from Parent'
        };
    }
    };
    </script>
    ```

    - ChildComponent.vue

    ```vue
    <template>
    <div>
        <h2>{{ message }}</h2>
    </div>
    </template>

    <script>
    export default {
    props: {
        message: String
    }
    };
    </script>
    ```
- Để truyền dữ liệu hoặc sự kiện từ component con lên component cha, sử dụng this.$emit.

    - ChildComponent.vue

    ```vue 
    <template>
    <div>
        <button @click="sendMessage">Send Message</button>
    </div>
    </template>

    <script>
    export default {
    methods: {
        sendMessage() {
        this.$emit('message-sent', 'Hello from Child');
        }
    }
    };
    </script>
    ```

    - ParentComponent.vue

    ```vue
    <template>
    <div>
        <ChildComponent @message-sent="handleMessage" />
    </div>
    </template>

    <script>
    import ChildComponent from './ChildComponent.vue';

    export default {
    components: {
        ChildComponent
    },
    methods: {
        handleMessage(message) {
        console.log(message);
        }
    }
    };
    </script>
    ```

- Slots cho phép chèn nội dung vào component từ bên ngoài