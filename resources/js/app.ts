require('./bootstrap.js');

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init({
    delay: 250,
    color: '#ff5714',
    includeCSS: true,
    showSpinner: false,
})

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .mount(el)
    },
})
