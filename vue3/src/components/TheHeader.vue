<template>
  <div class="container-fuild">
    <div class="row text-white" style="background-color: #0c713d; padding: 0.5rem">
      <div class="col-1 d-flex d-sm-none align-items-center justify-content-center">
        <span @click="showDrawer()">
          <font-awesome-icon icon="align-justify" />
        </span>
      </div>
      <div class="col-10 col-sm-9 d-flex align-items-center justify-content-center justify-content-sm-start">
        <img src="../assets/vue.svg" alt="logo" />
        <span class="d-none d-sm-flex ml-3">QUẢN TRỊ</span>
      </div>
      <div class="col-sm-3 d-sm-flex d-none align-items-center justify-content-sm-end">
        Admin
      </div>
      <div class="col-1 d-flex d-sm-none align-items-center justify-content-center">
        <span @click="showDrawerUser()">
          <font-awesome-icon icon="fa-solid fa-user" /></span>
      </div>
    </div>
  </div>

  <a-drawer v-model:visible="visible" title="Danh mục" placement="left">
    <TheMenu />
  </a-drawer>
  <a-drawer v-model:visible="visible_user" title="Admin" placement="right">
    <p>Some contents...</p>
    <p>Some contents...</p>
    <p>Some contents...</p>
  </a-drawer>
</template>

<script>
import TheMenu from "../components/TheMenu.vue";
import { defineComponent, ref } from "vue";
export default defineComponent({
  components: {
    TheMenu,
  },
  setup() {
    const visible = ref(false);
    const visible_user = ref(false);
    const showDrawer = () => {
      visible.value = true;
    };
    const showDrawerUser = () => {
      visible_user.value = true;
    };
    return {
      visible,
      visible_user,
      showDrawer,
      showDrawerUser,
    };
  },
});
</script>
