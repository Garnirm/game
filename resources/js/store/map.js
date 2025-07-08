// State
var coord_position_view = null

var height_tile = 70
var width_tile = 70

// Getters
function get_coord_position_view (state) {
    return state.coord_position_view
}

function get_height_tile (state) {
    return state.height_tile
}

function get_width_tile (state) {
    return state.width_tile
}

// Mutations
function set_coord_position_view (state, coord_position_view) {
    state.coord_position_view = coord_position_view
}

function set_height_tile (state, height_tile) {
    state.height_tile = height_tile
}

function set_width_tile (state, width_tile) {
    state.width_tile = width_tile
}

// Export
export const stateMap = {
    coord_position_view, height_tile, width_tile,
}

export const gettersMap = {
    get_coord_position_view, get_height_tile, get_width_tile,
}

export const mutationsMap = {
    set_coord_position_view, set_height_tile, set_width_tile,
}
