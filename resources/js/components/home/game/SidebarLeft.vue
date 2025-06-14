<template>
    <div class="sidebar-left">
        <div class="sidebar-block">
            <div class="block-label">Ressources</div>

            <div class="block-content block-resources" v-if="opened_blocks.includes('resources')">
                <div class="resources-line" v-for="r in resources" :key="r.label">
                    <div class="line-left">{{ r.label }}</div>

                    <div class="line-right">
                        <div>{{ this[ r.var_amount ] }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-block">
            <div class="block-label">Unités</div>
        </div>

        <div class="sidebar-block">
            <div class="block-label">Population</div>
        </div>

        <div class="sidebar-block">
            <div class="block-label">Villes</div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            opened_blocks: [ 'resources' ],

            resources: [
                { label: 'Monnaie', var_amount: 'money', var_upkeep: '' },
            ],
        }
    },

    computed: {
        influence: function () { return this.$store.getters['resources/get_resource']('influence') },
        money: function () { return this.$store.getters['resources/get_resource']('money') },
        wood: function () { return this.$store.getters['resources/get_resource']('wood') },
    },
}
</script>

<style lang="scss" scoped>
.sidebar-left {
    background-color: #1A1E29;
    border-top: 1px solid #5388AA;
    height: 100%;
    padding: 16px;
    width: 300px;

    .sidebar-block {
        margin-bottom: 16px;

        .block-content {
            margin-top: 8px;

            &.block-resources {
                .resources-line {
                    color: white;
                    display: flex;
                    font-size: 15px;
                    justify-content: space-between;
                }
            }
        }

        .block-label {
            color: white;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
        }
    }
}
</style>