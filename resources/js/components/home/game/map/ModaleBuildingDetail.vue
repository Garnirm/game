<template>
    <div class="modal-wrapper" v-if="visible">
        <div class="modal" style="width: 800px;" v-click-outside="outside">
            <div class="modal-header">
                <div class="modal-header-title">{{ building_name }} ( {{ building_coordinates }} )</div>

                <div class="modal-header-close" @click="outside">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 9.4L22.6 8L16 14.6L9.4 8L8 9.4L14.6 16L8 22.6L9.4 24L16 17.4L22.6 24L24 22.6L17.4 16L24 9.4Z" fill="black"/>
                    </svg>
                </div>
            </div>

            <div class="modal-body">
                <div class="block-jobs">
                    <div class="block-jobs-label">Emplois</div>

                    <div class="block-jobs-list">
                        <div class="jobs-list-item" v-for="j in jobs" :key="j.id">
                            <div>{{ j.label }}</div>

                            <div>{{ j.taken }} emplois occupés / {{ j.amount }}</div>
                        </div>
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
            building_name: null,
            building_coordinates: null,

            jobs: [],

            visible: false,
        }
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

                    this.building_name = data.building.name
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