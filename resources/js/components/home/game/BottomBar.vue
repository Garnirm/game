<template>
    <div class="game-bottom-bar">
        <div class="bottom-bar-container">
            <div class="bottom-bar">
                <div class="bottom-bar-navigation">
                    <div>
                        <sprite-green-triangle :orientation="270" @click="navigate('left')" />
                    </div>

                    <div class="navigation-column-center">
                        <sprite-green-triangle :orientation="0" @click="navigate('top')" />

                        <input type="number" class="input" v-model="interval_navigation" />

                        <sprite-green-triangle :orientation="180" @click="navigate('bottom')" />
                    </div>

                    <div>
                        <sprite-green-triangle :orientation="90" @click="navigate('right')" />
                    </div>

                    <div class="navigation-border-right">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SpriteGreenTriangle from '../../sprites/SpriteGreenTriangle.vue'

export default {
    components: { SpriteGreenTriangle },

    data: function () {
        return {
            interval_navigation: 1,
        }
    },

    computed: {
        coord_position_view: {
            get: function () { return this.$store.getters['map/get_coord_position_view'] },
            set: function (coord) { this.$store.commit('map/set_coord_position_view', coord) },
        },
    },

    methods: {
        navigate: function (direction) {
            let split = this.coord_position_view.split('/')

            let x = parseInt(split[0])
            let y = parseInt(split[1])

            if (direction === 'top') {
                y -= this.interval_navigation
            } else if (direction === 'left') {
                x -= this.interval_navigation
            } else if (direction === 'bottom') {
                y += this.interval_navigation
            } else if (direction === 'right') {
                x += this.interval_navigation
            }

            this.coord_position_view = x+'/'+y
        },
    },
}
</script>

<style lang="scss" scoped>
.game-bottom-bar {
    bottom: 32px;
    left: 300px;
    position: absolute;
    width: calc(100% - 300px);
    z-index: 2;

    .bottom-bar-container {
        display: flex;
        justify-content: center;

        .bottom-bar {
            align-items: center;
            background-color: rgba(50, 28, 178, 0.95);
            border-radius: 32px;
            display: flex;
            height: 160px;
            justify-content: space-between;
            padding-left: 24px;
            padding-right: 32px;
            position: relative;
            width: 80%;

            .bottom-bar-navigation {
                align-items: center;
                display: flex;
                height: 100%;

                div:not(.navigation-border-right) {
                    display: flex;
                    flex-direction: column;

                    &.navigation-column-center {
                        align-items: center;

                        input {
                            -moz-appearance: textfield;

                            margin: 8px;
                            width: 45px;

                            &::-webkit-outer-spin-button, &::-webkit-inner-spin-button {
                                -webkit-appearance: none;
                                margin: 0;
                            }
                        }
                    }

                    svg {
                        cursor: pointer;
                    }
                }

                .navigation-border-right {
                    background-color: gray;
                    border-radius: 2px;
                    height: 80%;
                    margin-left: 24px;
                    width: 4px;
                }
            }
        }
    }
}
</style>