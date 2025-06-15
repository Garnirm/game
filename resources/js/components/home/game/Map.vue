<template>
    <div class="map" ref="map">
        <div class="map-container">
            <div class="map-line" v-for="line in map_tiles" :key="line.coord_y">
                <div class="map-tile" v-for="t in line.tiles" :key="t" :style="styleTile(t)" :class="t.classes">
                    <component v-if="t?.building?.type in tiles_types" :is="tiles_types[ t.building.type ]" />

                    <template v-else>
                        <div v-if="t?.unlockable" class="tile-unlockable"></div>

                        <div class="tile-building" v-if="t.building">
                            {{ t.building.name }}
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TileVerticalRoad from './map/TileVerticalRoad.vue'

export default {
    components: { TileVerticalRoad },

    data: function () {
        return {
            mounted: false,

            max_coord: null,
            min_coord: null,

            map_tiles: [],

            tiles_types: {
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

                            tile.classes = classes

                            tiles_line.push(tile)
                        }

                        map_tiles.push({ coord_y: tile_y, tiles: tiles_line })
                    }

                    this.map_tiles = map_tiles
                })
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
                    font-size: 13px;
                    left: 8px;
                    position: absolute;
                    top: 8px;
                }

                .tile-unlockable {
                    background: linear-gradient(315deg,#608A32 25px,white 0);
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