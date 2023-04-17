import "./bootstrap";

import { createApp } from "vue";
import App from "./components/app.vue";
import router from "./router";
import store from "./store";
import { library } from "@fortawesome/fontawesome-svg-core";
import $ from 'jquery'
import { fas } from "@fortawesome/free-solid-svg-icons";
import { far } from "@fortawesome/free-regular-svg-icons";
import { fab } from "@fortawesome/free-brands-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(fas, far, fab);


const app = createApp(App).component("font-awesome-icon", FontAwesomeIcon);
app.config.globalProperties.asset = function (path) {
    return import.meta.env.BASE_URL + path;
  };
app.use(router);
app.use(store);

app.mount("#app");
