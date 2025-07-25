<template>
    <div class="map" ref="map">
        <div class="map-container">
            <div class="map-line" v-for="line in map_tiles" :key="line.coord_y">
                <div class="map-tile" v-for="t in line.tiles" :key="t" :style="styleTile(t)" :class="t.classes" v-tippy="t.coord_x+'/'+t.coord_y" @click="clickTile(t)">
                    <component v-if="t?.building?.type in tiles_types" :is="tiles_types[ t.building.type ]" />

                    <template v-else>
                        <div v-if="t?.unlockable" class="tile-unlockable"></div>

                        <div class="tile-building" v-if="t.building && displayCoordLabel(t.building, t.coord_x, t.coord_y)">
                            <div class="tile-military-base" v-if="t.type === 'military_base'">
                                <div class="military-base-left-border" v-if="t.classes.includes('military-base-left-border')"></div>
                                <div class="military-base-right-border" v-if="t.classes.includes('military-base-right-border')"></div>
                                <div class="military-base-top-border" v-if="t.classes.includes('military-base-top-border')"></div>
                                <div class="military-base-bottom-border" v-if="t.classes.includes('military-base-bottom-border')"></div>
                            </div>

                            <div class="building-name">{{ t.building.name }}</div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <modale-building-detail :save_id="save_id" />
</template>

<script>
import TileHorizontalRoad from './map/tiles/TileHorizontalRoad.vue'
import TileIntersectionRoadBottom from './map/tiles/TileIntersectionRoadBottom.vue'
import TileVerticalRoad from './map/tiles/TileVerticalRoad.vue'

import ModaleBuildingDetail from './map/ModaleBuildingDetail.vue'

export default {
    components: {
        ModaleBuildingDetail, TileHorizontalRoad, TileIntersectionRoadBottom, TileVerticalRoad
    },

    data: function () {
        return {
            mounted: false,

            max_coord: null,
            min_coord: null,

            map_tiles: [],

            road_types: [ 'horizontal_road', 'intersection_road_bottom', 'vertical_road' ],

            tiles_types: {
                horizontal_road: 'tile-horizontal-road',
                intersection_road_bottom: 'tile-intersection-road-bottom',
                vertical_road: 'tile-vertical-road',
            },
        }
    },

    computed: {
        save_id: function () { return this.$store.getters['game/get_save_id'] },

        coord_position_view: function () { return this.$store.getters['map/get_coord_position_view'] },

        height_tile: function () { return this.$store.getters['map/get_height_tile'] },
        width_tile: function () { return this.$store.getters['map/get_width_tile'] },

        height_tile_px: function () { return this.height_tile+'px' },
        width_tile_px: function () { return this.width_tile+'px' },

        height_unlockable_px: function () { return (this.height_tile - 1)+'px' },
        width_unlockable_px: function () { return (this.width_tile - 1)+'px' },
    },

    watch: {
        coord_position_view: function (new_coord) {
            if (!this.mounted) {
                return
            }

            this.generateMap(new_coord)
        },
    },

    mounted: function () {
        this.mounted = true

        if (this.coord_position_view !== null) {
            this.generateMap(this.coord_position_view)
        }
    },

    methods: {
        clickTile: function (tile) {
            if (tile.building) {
                EventBus.emit('open_modale_building_details', { building_id: tile.building.id, coord_x: tile.coord_x, coord_y: tile.coord_y })
            }
        },

        generateMap: function (coordinates) {
            let [ x, y ] = coordinates.split('/')

            x = parseInt(x)
            y = parseInt(y)

            let map_height = this.$refs.map.offsetHeight
            let map_width = this.$refs.map.offsetWidth

            let max_tile_with_height = Math.floor(map_height / this.height_tile)
            let max_tile_with_width = Math.floor(map_width / this.width_tile)

            max_tile_with_height -= 1
            max_tile_with_width -= 1

            let height_odd_or_even = max_tile_with_height & 1
            let width_odd_or_even = max_tile_with_width & 1

            if (height_odd_or_even === 0) {
                max_tile_with_height -= 1
            }

            if (width_odd_or_even === 0) {
                max_tile_with_width -= 1
            }

            let half_height = (max_tile_with_height - 1) / 2
            let half_width = (max_tile_with_width - 1) / 2

            let x_start = x - half_width
            let y_start = y - half_height

            let x_max = x_start + (max_tile_with_width - 1)
            let y_max = y_start + (max_tile_with_height - 1)

            axios.post('/map/tiles_content', { save_id: this.save_id, x_start: x_start, y_start: y_start, x_max: x_max, y_max: y_max })
                .then((res) => {
                    let data = res.data.data

                    let buildings = data.buildings
                    let tiles = data.tiles

                    let map_tiles = []

                    for (let tile_y = y_start; tile_y <= y_max; tile_y++) {
                        let tiles_line = []

                        for (let tile_x = x_start; tile_x <= x_max; tile_x++) {
                            let key_tile = tile_x+'/'+tile_y
                            let tile = tiles[ key_tile ]

                            let classes = []

                            if (tile.type === 'military_base') {
                                let left_neighbor_tile = (tile_x - 1)+'/'+tile_y
                                let right_neighbor_tile = (tile_x + 1)+'/'+tile_y

                                let top_neighbor_tile = tile_x+'/'+(tile_y - 1)
                                let bottom_neighbor_tile = tile_x+'/'+(tile_y + 1)

                                if (left_neighbor_tile in tiles && tiles[ left_neighbor_tile ].type !== 'military_base') {
                                    classes.push('military-base-left-border')
                                }

                                if (right_neighbor_tile in tiles && tiles[ right_neighbor_tile ].type !== 'military_base') {
                                    classes.push('military-base-right-border')
                                }

                                if (top_neighbor_tile in tiles && tiles[ top_neighbor_tile ].type !== 'military_base') {
                                    classes.push('military-base-top-border')
                                }

                                if (bottom_neighbor_tile in tiles && tiles[ bottom_neighbor_tile ].type !== 'military_base') {
                                    classes.push('military-base-bottom-border')
                                }
                            }

                            if (tile.building && tile.building.coordinates.length > 1) {
                                let left_neighbor_tile = (tile_x - 1)+'/'+tile_y
                                let top_neighbor_tile = tile_x+'/'+(tile_y - 1)

                                if (left_neighbor_tile in buildings && buildings[ left_neighbor_tile ].id === tile.building.id) {
                                    classes.push('no-left-border');
                                }

                                if (top_neighbor_tile in buildings && buildings[ top_neighbor_tile ].id === tile.building.id) {
                                    classes.push('no-top-border');
                                }
                            }

                            if (tile.building && this.road_types.includes(tile.building.type)) {
                                let left_neighbor_tile = (tile_x - 1)+'/'+tile_y
                                let top_neighbor_tile = tile_x+'/'+(tile_y - 1)

                                if (left_neighbor_tile in buildings && this.road_types.includes(buildings[ left_neighbor_tile ].type)) {
                                    classes.push('no-left-border');
                                }

                                if (top_neighbor_tile in buildings && this.road_types.includes(buildings[ top_neighbor_tile ].type)) {
                                    classes.push('no-top-border');
                                }
                            }

                            tile.classes = classes

                            tiles_line.push(tile)
                        }

                        map_tiles.push({ coord_y: tile_y, tiles: tiles_line })
                    }

                    this.map_tiles = map_tiles
                })
        },

        displayCoordLabel: function (building, tile_x, tile_y) {
            return building.display_label_coord.x === tile_x && building.display_label_coord.y === tile_y
        },

        styleTile: function () {
            return {
                'border-bottom': '1px solid black',
                'border-left': '1px solid black',
                'border-right': '1px solid black',
                'border-top': '1px solid black',
            }
        },
    },
}
</script>

<style lang="scss" scoped>
.map {
    align-items: center;
    display: flex;
    justify-content: center;
    width: calc(100% - 300px);

    .map-container {
        .map-line {
            display: flex;

            &:not(:last-child) {
                .map-tile {
                    border-bottom: unset !important;
                }
            }

            .map-tile {
                cursor: pointer;
                height: v-bind(height_tile_px);
                position: relative;
                width: v-bind(width_tile_px);

                &:not(:last-child) {
                    border-right: unset !important;
                }

                &.no-left-border {
                    border-left: unset !important;
                }

                &.no-top-border {
                    border-top: unset !important;
                }

                .tile-building {
                    font-size: 11px;
                    height: 100%;
                    left: 0;
                    position: absolute;
                    top: 0;
                    width: 100%;

                    .building-name {
                        padding-left: 6px;
                        padding-right: 6px;
                        padding-top: 6px;
                    }

                    .tile-military-base {
                        .military-base-left-border, .military-base-right-border, .military-base-top-border, .military-base-bottom-border {
                            background-color: black;
                            position: absolute;
                            z-index: 1;
                        }

                        .military-base-left-border {
                            left: 0;
                            height: 100%;
                            top: 0;
                            width: 2px;
                        }

                        .military-base-right-border {
                            height: 100%;
                            right: 0;
                            top: 0;
                            width: 2px;
                        }

                        .military-base-top-border {
                            left: 0;
                            height: 2px;
                            top: 0;
                            width: 100%;
                        }

                        .military-base-bottom-border {
                            bottom: 0;
                            left: 0;
                            height: 2px;
                            width: 100%;
                        }
                    }
                }

                .tile-unlockable {
                    background: linear-gradient(315deg,#608A32 15px,white 0);
                    height: v-bind(height_unlockable_px);
                    position: absolute;
                    width: v-bind(width_unlockable_px);
                    z-index: 1;
                }
            }
        }
    }
}
</style>