import { createApp } from "vue";
import router from "./router";
import App from "./App.vue";
import { createPinia } from "pinia";
import {
  Menu,
  List,
  Drawer,
  Button,
  message,
  Card,
  Table,
  Avatar,
  Checkbox,
  Select,
  Input,
} from "ant-design-vue";
import axios from "axios";
window.axios = axios;

import "./static/fontawesome/css/all.min.css";
import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { fab } from "@fortawesome/free-brands-svg-icons";
import { far } from "@fortawesome/free-regular-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
library.add(fas, fab, far);

import "ant-design-vue/dist/antd.css";
import "bootstrap/dist/css/bootstrap-grid.min.css";
import "bootstrap/dist/css/bootstrap-utilities.min.css";

const app = createApp(App);
app.component("font-awesome-icon", FontAwesomeIcon);
app.use(createPinia());
app.use(router);
app.use(Input);
app.use(Select);
app.use(Button);
app.use(Card);
app.use(Table);
app.use(Drawer);
app.use(List);
app.use(Checkbox);
app.use(message);
app.use(Avatar);
app.use(Menu);
app.mount("#app");

app.config.globalProperties.$message = message;
