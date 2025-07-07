<template>
    <div class="sidebar-left">
        <div class="sidebar-unlockable-tiles">
            <div class="unlockable-tiles-left">Cases débloquables</div>

            <div class="unlockable-tiles-right">{{ unlockable_tiles }}</div>
        </div>

        <div class="sidebar-block">
            <div class="block-label">Ressources</div>

            <div class="block-content block-resources" v-if="opened_blocks.includes('resources')">
                <div class="resources-line" v-for="r in resources" :key="r.label">
                    <div class="line-left">{{ r.label }}</div>

                    <div class="line-right">
                        <div>{{ this[ r.var_amount ]?.toLocaleString('fr-FR') }}</div>

                        <div v-if="this[ r.var_balance ]">{{ this[ r.var_balance ].toLocaleString('fr-FR') }}</div>
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

            <div class="block-content block-cities"></div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            opened_blocks: [ 'resources' ],

            resources: [
                { label: 'Monnaie', var_amount: 'money', var_balance: 'production_balance_money' },
                { label: 'Influence', var_amount: 'influence', var_balance: 'production_balance_influence' },
                { label: 'Nourriture', var_amount: 'food', var_balance: 'production_balance_food' },
                { label: 'Blé', var_amount: 'wheat', var_balance: 'production_balance_wheat' },
                { label: 'Acier', var_amount: 'steel', var_balance: 'production_balance_steel' },
                { label: 'Béton', var_amount: 'concrete', var_balance: 'production_balance_concrete' },
                { label: 'Bois', var_amount: 'wood', var_balance: 'production_balance_wood' },
            ],
        }
    },

    computed: {
        unlockable_tiles: function () { return this.$store.getters['resources/get_resource']('unlockable_tiles') },

        concrete: function () { return this.$store.getters['resources/get_resource']('concrete') },
        food: function () { return this.$store.getters['resources/get_resource']('food') },
        wheat: function () { return this.$store.getters['resources/get_resource']('wheat') },
        influence: function () { return this.$store.getters['resources/get_resource']('influence') },
        money: function () { return this.$store.getters['resources/get_resource']('money') },
        steel: function () { return this.$store.getters['resources/get_resource']('steel') },
        wood: function () { return this.$store.getters['resources/get_resource']('wood') },

        production_balance_concrete: function () { return this.$store.getters['resources/get_production_balance']('concrete') },
        production_balance_food: function () { return this.$store.getters['resources/get_production_balance']('food') },
        production_balance_wheat: function () { return this.$store.getters['resources/get_production_balance']('wheat') },
        production_balance_influence: function () { return this.$store.getters['resources/get_production_balance']('influence') },
        production_balance_money: function () { return this.$store.getters['resources/get_production_balance']('money') },
        production_balance_steel: function () { return this.$store.getters['resources/get_production_balance']('steel') },
        production_balance_wood: function () { return this.$store.getters['resources/get_production_balance']('wood') },
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

            &.block-cities {}

            &.block-resources {
                .resources-line {
                    color: white;
                    display: flex;
                    font-size: 15px;
                    justify-content: space-between;

                    .line-right {
                        text-align: right;
                    }
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

    .sidebar-unlockable-tiles {
        color: white;
        display: flex;
        font-size: 18px;
        justify-content: space-between;
        margin-bottom: 24px;
    }
}
</style>