const admin = [
  {
    path: "/admin",
    component: () => import("../layout/admin.vue"),
    children: [
      //Quản lí users
      {
        path: "users",
        name: "admin-users",
        component: () => import("../page/admin/users/index.vue"),
      },
      {
        path: "users/create",
        name: "admin-users-create",
        component: () => import("../page/admin/users/create.vue"),
      },
      {
        path: "users/:id/edit",
        name: "admin-users-edit",
        component: () => import("../page/admin/users/edit.vue"),
      },
      //Quản lí vai trò
      {
        path: "roles",
        name: "admin-roles",
        component: () => import("../page/admin/roles/index.vue"),
      },
      //Cài đặt
      {
        path: "settings",
        name: "admin-settings",
        component: () => import("../page/admin/settings/index.vue"),
      },
    ],
  },
];
export default admin;
