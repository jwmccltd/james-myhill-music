import { createApp } from 'vue/dist/vue.esm-bundler';

//import Slides from './components/Slides.vue';

import { Slides } from '@jwmsoftware/slideshow-with-text-transition';
import '@jwmsoftware/slideshow-with-text-transition/dist/style.css';

const app = createApp({
    components: {
        Slides
    }
});

const mountedApp = app.mount("#app");