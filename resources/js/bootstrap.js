import axios from 'axios';
import router from "./Router.js";
window.axios = axios;

axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost';
axios.defaults.withXSRFToken = true;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Accept'] = 'application/json';


