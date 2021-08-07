require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';

import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import mitt from 'mitt'

window.emitter = mitt()
const el = document.getElementById('app');
 

window.flash=function(msg,color){
  return  emitter.emit('flash', {msg,color})
}

window.showBox=function(friend){
    return  emitter.emit('showBox', friend)
}
  
createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .mount(el);

// InertiaProgress.init({ color: '#4B5563' });
InertiaProgress.init({
    
  
    // The color of the progress bar.
    color: '#29d',
  
    // Whether to include the default NProgress styles.
    includeCSS: true,
  
    // Whether the NProgress spinner will be shown.
    showSpinner: true,
  })
