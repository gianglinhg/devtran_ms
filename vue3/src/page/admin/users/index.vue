<template>
  <a-card title="Tài khoản" style="width: 100%">
    <div class="row mb-3">
      <div class="col-12 d-flex justify-content-end">
        <a-button type="primary">
          <router-link :to="{ name: 'admin-users-create' }">
            <i class="fa-solid fa-plus"></i>
          </router-link>
        </a-button>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a-table :dataSource="users" :columns="columns" :scroll="{ x: 576 }">
          <template #bodyCell="{ column, index, record }">
            <template v-if="column.key === 'index'">
              <span> {{ index + 1 }}</span>
            </template>
            <template v-if="column.key === 'status'">
              <span v-if="record.status_id == 1" class="text-primary">{{
                record.status
              }}</span>
              <span v-else-if="record.status_id == 2" class="text-danger">{{
                record.status
              }}</span>
            </template>
            <template v-if="column.key === 'action'">
              <router-link
                :to="{ name: 'admin-users-edit', params: { id: record.id } }"
              >
                <a-button type="primary" class="m-1">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a-button>
              </router-link>
              <a-button
                type="danger"
                class="m-1"
                @click.prevent="deleteUser(record.id)"
              >
                <i class="fa-solid fa-trash"></i>
              </a-button>
            </template>
          </template>
        </a-table>
      </div>
    </div>
  </a-card>
</template>

<script>
import { defineComponent, ref } from "vue";
import { message } from "ant-design-vue";
import { useMenu } from "../../../stores/use-menu.js";
export default defineComponent({
  setup() {
    useMenu().onSelectedKeys(["admin-users"]);

    const users = ref([]);
    const columns = [
      {
        title: "#",
        key: "index",
      },
      {
        title: "Tài khoản",
        dataIndex: "username",
        key: "username",
      },
      {
        title: "Họ tên",
        dataIndex: "name",
        key: "name",
      },
      {
        title: "Phòng ban",
        dataIndex: "department",
        key: "department",
        responsive: ["sm"],
      },
      {
        title: "Vai trò",
        dataIndex: "",
        key: "",
      },
      {
        title: "Tình trạng",
        dataIndex: "status",
        key: "status",
      },
      {
        title: "Công cụ",
        key: "action",
        fixed: "right",
      },
    ];
    const messages = ref({});
    const getUsers = () => {
      axios
        .get("http://localhost:8000/api/users")
        .then((response) => {
          users.value = response.data;
        })
        .catch((error) => {
          // handle error
          console.log(error);
        });
    };
    getUsers();
    const deleteUser = (id) => {
      var confirm = confirm("Bạn có chắc chắn muốn xóa không?");
      if (confirm == true) {
        axios
          .delete(`http://localhost:8000/api/users/${id}`)
          .then((response) => {
            if (response.status == 200) {
              message.success(response.data);
              // location.reload();
            } else message.error(response.data);
            console.log(response);
          });
        // .catch((error) => {
        //   messages.value = response.data;
        // });
      }
    };
    return {
      users,
      columns,
      messages,
      deleteUser,
    };
  },
});
</script>
