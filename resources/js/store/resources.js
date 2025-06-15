// State
var resources = {}
var productions = {}
var production_balance = {}
var upkeep = {}

// Getters
function get_resource (state) {
    return (resource) => {
        return state.resources[ resource ] ?? null
    }
}

function get_production (state) {
    return (resource) => {
        return state.productions[ resource ] ?? null
    }
}

function get_production_balance (state) {
    return (resource) => {
        return state.production_balance[ resource ] ?? null
    }
}

function get_upkeep (state) {
    return (resource) => {
        return state.upkeep[ resource ] ?? null
    }
}

// Mutations
function set_resource (state, data) {
    state.resources[ data.resource ] = data.amount
}

function set_production (state, data) {
    state.productions[ data.resource ] = data.amount
}

function set_production_balance (state, data) {
    state.production_balance[ data.resource ] = data.amount
}

function set_upkeep (state, data) {
    state.upkeep[ data.resource ] = data.amount
}

// Export
export const stateResources = {
    resources, productions, production_balance, upkeep,
}

export const gettersResources = {
    get_resource, get_production, get_production_balance, get_upkeep,
}

export const mutationsResources = {
    set_resource, set_production, set_production_balance, set_upkeep,
}
