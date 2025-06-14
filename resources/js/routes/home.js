export default [
    { path: '/', component: () => import('@/components/home/Home.vue') },
    { path: '/create', component: () => import('@/components/home/Create.vue') },
    { path: '/game', component: () => import('@/components/home/Game.vue') },
]
