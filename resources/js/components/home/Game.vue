<template>
    <div class="game">
        <Header />

        <div class="game-body">
            <sidebar-left />
            <Map />
        </div>
    </div>
</template>

<script>
import Header from './game/Header.vue'
import Map from './game/Map.vue'
import SidebarLeft from './game/SidebarLeft.vue'

export default {
    components: { Header, Map, SidebarLeft },

    computed: {
        save_id: function () { return this.$store.getters['game/get_save_id'] },
    },

    created: function () {
        this.loadSave()
    },

    methods: {
        loadSave: function () {
            axios.post('/save/retrieve', { save_id: this.save_id })
                .then((res) => {
                    let data = res.data.data

                    const coord_position_view = data.position_view_tile.coord_x+'/'+data.position_view_tile.coord_y

                    this.$store.commit('game/set_save_name', data.save_name)
                    this.$store.commit('game/set_tour', data.tour)

                    this.$store.commit('map/set_coord_position_view', coord_position_view)

                    this.$store.commit('resources/set_resource', { resource: 'unlockable_tiles', amount: data.nb_unlockable_tiles })

                    for (let r in data.resources) {
                        this.$store.commit('resources/set_resource', { resource: r, amount: data.resources[r] })
                    }

                    for (let u in data.upkeep) {
                        this.$store.commit('resources/set_upkeep', { resource: u, amount: data.upkeep[u] })
                    }

                    for (let p in data.production) {
                        this.$store.commit('resources/set_production', { resource: p, amount: data.production[p] })
                    }

                    for (let pb in data.production_balance) {
                        this.$store.commit('resources/set_production_balance', { resource: pb, amount: data.production_balance[pb] })
                    }
                })
                .catch((e) => {})
        },
    },
}
</script>

<style lang="scss" scoped>
.game {
    .game-body {
        display: flex;
        height: calc(100vh - 96px);
        width: 100%;
    }
}
</style>