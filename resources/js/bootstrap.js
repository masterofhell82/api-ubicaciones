import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import L from 'leaflet/dist/leaflet.js';

window.L = L;

import Swal from 'sweetalert2/dist/sweetalert2.js'

window.Swal = Swal



