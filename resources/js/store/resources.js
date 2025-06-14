// State
var money = null
var influence = null
var wood = null

// Getters
function get_resource (state) {
    return (resource) => {
        return state[ resource ]
    }
}

// Mutations
function set_resource (state, data) {
    state[ data.resource ] = data.amount
}

// Export
export const stateResources = {
    money, influence, wood,
}

export const gettersResources = {
    get_resource,
}

export const mutationsResources = {
    set_resource,
}
