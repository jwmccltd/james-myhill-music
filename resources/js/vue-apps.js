import { createApp } from 'vue/dist/vue.esm-bundler';

//import Slides from './components/Slides.vue';

import { Slides } from '@jwmccltd/slideshow-with-text-transition';
import '@jwmccltd/slideshow-with-text-transition/dist/style.css';

const app = createApp({
    components: {
        Slides
    }
});

const mountedApp = app.mount("#app");