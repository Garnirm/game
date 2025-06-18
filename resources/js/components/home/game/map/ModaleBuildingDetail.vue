<template>
    <div class="modal-wrapper" v-if="visible">
        <div class="modal" style="width: 800px;" v-click-outside="outside">
            <div class="modal-header">
                <div class="modal-header-title">{{ building.name }} ( {{ building_coordinates }} )</div>

                <div class="modal-header-close" @click="outside">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 9.4L22.6 8L16 14.6L9.4 8L8 9.4L14.6 16L8 22.6L9.4 24L16 17.4L22.6 24L24 22.6L17.4 16L24 9.4Z" fill="black"/>
                    </svg>
                </div>
            </div>

            <div class="modal-body">
                <div class="block-jobs" v-if="jobs.length > 0">
                    <div class="block-jobs-label">Emplois</div>

                    <div class="block-jobs-list">
                        <div class="jobs-list-item" v-for="j in jobs" :key="j.id">
                            <div>{{ j.label }}</div>

                            <div>{{ j.taken }} emplois occupés / {{ j.amount }}</div>
                        </div>
                    </div>
                </div>

                <div class="block-housing" v-if="building.housing > 0">
                    <div class="block-housing-label">Répartition des logements (Capacité : {{ building.housing }})</div>

                    <div class="block-housing-repartition">
                        <table>
                            <thead>
                                <tr>
                                    <th>Catégorie de pop</th>
                                    <th>Nombre de pops</th>
                                    <th>Logements occupés</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(amount, housing_class) in building.housing_repartition" :key="housing_class">
                                    <td>{{ housing_class }}</td>
                                    <td>{{ amount }}</td>
                                    <td>{{ amount * this['consumption_'+housing_class] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer flex-space-between">
                <button class="btn btn-round btn-primary" @click="update">
                    <span>Modifier</span>
                </button>

                <button class="btn btn-round btn-secondary" @click="outside">
                    <span>Annuler</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

export default {
    directives: { clickOutside: vClickOutside.directive },

    props: [ 'save_id' ],

    data: function () {
        return {
            building: {},
            building_coordinates: null,

            jobs: [],

            visible: false,
        }
    },

    computed: {
        consumption_worker: function () { return this.$store.getters['game/get_housing_consumption']('worker') },
        consumption_specialist: function () { return this.$store.getters['game/get_housing_consumption']('specialist') },
        consumption_engineer: function () { return this.$store.getters['game/get_housing_consumption']('engineer') },
        consumption_elite: function () { return this.$store.getters['game/get_housing_consumption']('elite') },
    },

    created: function () {
        EventBus.on('open_modale_building_details', (data) => {
            this.getDetails(data)
        })
    },

    methods: {
        getDetails: function (data_event) {
            axios.post('/building/details', { save_id: this.save_id, building_id: data_event.building_id })
                .then((res) => {
                    let data = res.data.data

                    this.building = data.building
                    this.building_coordinates = data_event.coord_x+' / '+data_event.coord_y

                    this.jobs = data.jobs

                    this.visible = true
                })
                .catch((e) => {})
        },
        outside: function (e) {
            let path = e.composedPath()

            var visible = false

            for (let p of path) {
                if ('classList' in p && p.classList.contains('confirm-wrapper')) {
                    visible = true

                    break
                }
            }

            this.visible = visible
        },
    }
}
</script>

<style lang="scss" scoped>
.block-housing {
    .block-housing-label {
        font-size: 18px;
        margin-bottom: 16px;
    }

    .block-housing-repartition {
        table {
            width: 100%;
        }
    }
}

.block-jobs {
    .block-jobs-label {
        font-size: 18px;
        margin-bottom: 16px;
    }

    .block-jobs-list {
        .jobs-list-item {
            display: flex;
            justify-content: space-between;
        }
    }
}
</style>