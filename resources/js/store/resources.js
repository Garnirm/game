// State
var unlockable_tiles = null

var concrete = null
var food = null
var money = null
var influence = null
var steel = null

var production_concrete = null
var production_food = null
var production_money = null
var production_influence = null
var production_steel = null

var production_balance_concrete = null
var production_balance_food = null
var production_balance_money = null
var production_balance_influence = null
var production_balance_steel = null

var upkeep_concrete = null
var upkeep_food = null
var upkeep_money = null
var upkeep_influence = null
var upkeep_steel = null

// Getters
function get_resource (state) {
    return (resource) => {
        return state[ resource ]
    }
}

function get_production (state) {
    return (resource) => {
        return state[ 'production_'+resource ]
    }
}

function get_production_balance (state) {
    return (resource) => {
        return state[ 'production_balance_'+resource ]
    }
}

function get_upkeep (state) {
    return (resource) => {
        return state[ 'upkeep_'+resource ]
    }
}

// Mutations
function set_resource (state, data) {
    state[ data.resource ] = data.amount
}

// Export
export const stateResources = {
    food, money, influence, steel, unlockable_tiles, concrete,

    upkeep_food, upkeep_money, upkeep_influence, upkeep_steel, upkeep_concrete,

    production_food, production_money, production_influence, production_steel, production_concrete,

    production_balance_food, production_balance_money, production_balance_influence, production_balance_steel, production_balance_concrete,
}

export const gettersResources = {
    get_resource, get_production, get_production_balance, get_upkeep,
}

export const mutationsResources = {
    set_resource,
}
