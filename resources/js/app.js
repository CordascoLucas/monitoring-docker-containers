import './bootstrap';

import {createApp} from 'vue'
import app from '../vue/app.vue'
import {LoadingPlugin} from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faTrash, faPlay, faStop, faRotateRight } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faPlay, faTrash, faStop, faRotateRight)

createApp(app)
.use(LoadingPlugin)
.component('font-awesome-icon', FontAwesomeIcon)
.mount("#app")