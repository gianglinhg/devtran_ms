<template>
  <form @submit.prevent="createUser()">
    <a-card title="Tạo mới tài khoản" style="width: 100%">
      <div class="row">
        <div class="col-12 col-sm-4">
          <div class="row">
            <div
              class="col-12 d-flex aligns-item-center justify-content-center mb-3"
            >
              <a-avatar shape="square" :size="200">
                <template #icon>
                  <!-- <UserOutlined /> -->
                  <img src="/src/assets/vuelogo.png" alt="avatar" />
                </template>
              </a-avatar>
            </div>
            <div class="col-12 d-flex justify-content-center">
              <a-button type="primary">
                <i class="fa-solid fa-plus me-2"></i>
                <span>Chọn ảnh</span>
              </a-button>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-8">
          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{ 'text-danger': errors.status_id }"
                  >Tình trạng:</span
                >
              </label>
            </div>
            <div class="col-12 col-sm-6">
              <a-select
                show-search
                placeholder="Tình trạng"
                style="width: 100%"
                :options="users_status"
                :filter-option="filterOption"
                allow-clear
                v-model:value="status_id"
                :class="{ 'input-danger': errors.status_id }"
              ></a-select>
              <!-- <div class="w-100"></div> -->
              <small v-if="errors.status_id" class="text-danger">{{
                errors.status_id[0]
              }}</small>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{ 'text-danger': errors.username }"
                  >Tên tài khoản:</span
                >
              </label>
            </div>
            <div class="col-12 col-sm-6">
              <a-input
                placeholder="Tên tài khoản"
                v-model:value="username"
                allow-clear
                :class="{ 'input-danger': errors.username }"
              />
              <small v-if="errors.username" class="text-danger">{{
                errors.username[0]
              }}</small>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{ 'text-danger': errors.name }">Họ và tên:</span>
              </label>
            </div>
            <div class="col-12 col-sm-6">
              <a-input
                placeholder="Họ và tên"
                v-model:value="name"
                allow-clear
                :class="{ 'input-danger': errors.name }"
              />
              <small v-if="errors.name" class="text-danger">{{
                errors.name[0]
              }}</small>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{ 'text-danger': errors.email }">Email:</span>
              </label>
            </div>
            <div class="col-12 col-sm-6">
              <a-input
                placeholder="Email"
                v-model:value="email"
                :class="{ 'input-danger': errors.email }"
                allow-clear
              />
              <small v-if="errors.email" class="text-danger">{{
                errors.email[0]
              }}</small>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{ 'text-danger': errors.department_id }"
                  >Phòng ban:</span
                >
              </label>
            </div>
            <div class="col-12 col-sm-6">
              <a-select
                show-search
                placeholder="Phòng ban"
                style="width: 100%"
                :options="departments"
                :filter-option="filterOption"
                v-model:value="department_id"
                :class="{ 'input-danger': errors.department_id }"
                allow-clear
              ></a-select>
              <small v-if="errors.department_id" class="text-danger">{{
                errors.department_id[0]
              }}</small>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{ 'text-danger': errors.password }"
                  >Mật khẩu:</span
                >
              </label>
            </div>
            <div class="col-12 col-sm-6">
              <a-input-password
                placeholder="Mật khẩu"
                v-model:value="password"
                allow-clear
                :class="{ 'input-danger': errors.password }"
              />
              <small v-if="errors.password" class="text-danger">{{
                errors.password[0]
              }}</small>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{ 'text-danger': errors.password_confirmation }"
                  >Nhập lại mật khẩu:</span
                >
              </label>
            </div>
            <div class="col-12 col-sm-6">
              <a-input-password
                placeholder="Mật khẩu"
                v-model:value="password_confirmation"
                allow-clear
                :class="{ 'input-danger': errors.password_confirmation }"
              />
              <small v-if="errors.password_confirmation" class="text-danger">{{
                errors.password_confirmation[0]
              }}</small>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 d-grid mx-auto d-sm-flex justify-content-sm-end">
          <a-button class="me-sm-2 mb-1 me-0 mb-sm-0">
            <router-link :to="{ name: 'admin-users' }">
              <span>Hủy</span>
            </router-link>
          </a-button>
          <a-button type="primary" htmlType="submit">
            <span>Lưu</span>
          </a-button>
        </div>
      </div>
    </a-card>
  </form>
</template>

<script>
import { useRouter } from "vue-router";
import { message } from "ant-design-vue";
import { defineComponent, ref, reactive, toRefs } from "vue";
import { useMenu } from "../../../stores/use-menu.js";

export default defineComponent({
  setup() {
    useMenu().onSelectedKeys(["admin-users"]);

    const router = useRouter();
    const users_status = ref([]);
    const departments = ref([]);
    const users = reactive({
      name: "",
      username: "",
      email: "",
      password: "",
      password_confirmation: "",
      department_id: [],
      status_id: [],
    });
    const errors = ref({});

    const getUsersCreate = () => {
      axios
        .get("http://localhost:8000/api/users/create")
        .then((response) => {
          users_status.value = response.data.users_status;
          departments.value = response.data.departments;
        })
        .catch((error) => {
          console.log(error);
        });
    };
    getUsersCreate();

    const filterOption = (input, option) => {
      return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
    };

    const createUser = () => {
      axios
        .post("http://localhost:8000/api/users", users)
        .then((response) => {
          if (response.status == 200) {
            message.success("Tạo mới thành công !");
            router.push({ name: "admin-users" });
          }
        })
        .catch((error) => {
          console.log(error);
          errors.value = error.response.data.errors;
        });
    };

    return {
      users_status,
      departments,
      errors,
      ...toRefs(users),
      filterOption,
      createUser,
    };
  },
});
</script>

<style>
.input-danger {
  border: 1px solid red;
}
</style>
