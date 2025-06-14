import { createApp } from 'vue'

import 'tippy.js/dist/tippy.css'

import Tippy from 'vue-tippy'
import Toaster from '@meforma/vue-toaster'

import Layout from './components/Layout.vue'

import routes from './routes/app'
import store from './store/app'

import { EventEmitter } from 'events'
import axios from 'axios'

EventEmitter.defaultMaxListeners = 1000

window.EventBus = new EventEmitter()

window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content

var app = createApp({})

app.config.devtools = false
app.config.performance = true

app.use(routes)
app.use(store)

app.use(Tippy, { directive: 'tippy', component: 'tippy', defaultProps: { placement: 'auto-end', allowHTML: false } })
app.use(Toaster, { position: 'top-right', duration: 3000 })

app.component('layout', Layout)

app.mount('#app')

window.Vue = app
