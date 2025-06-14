import { createRouter, createWebHistory } from 'vue-router'

import home from './home'

export default createRouter({
    history: createWebHistory(),
    routes: [
        ...home,
    ]
})
