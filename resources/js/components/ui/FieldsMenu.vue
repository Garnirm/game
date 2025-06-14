<template>
    <div class="actions-fields" v-click-outside="outsideFieldsMenu">
        <div class="fields-button" @click="displayFieldsMenu()">Show columns</div>

        <div class="fields-menu" v-if="visible_fields_menu">
            <div class="menu-field" v-for="f in fields" :key="f.value">
                <input type="checkbox" class="checkbox" :id="f.id" :value="f.value" v-model="$parent.enabled_fields" />
                <label :for="f.id">{{ f.label }}</label>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

export default {
    directives: { clickOutside: vClickOutside.directive },
    props: [ 'fields' ],
    data: function () {
        return {
            visible_fields_menu: false,
        }
    },
    methods: {
        outsideFieldsMenu: function () {
            this.visible_fields_menu = false
        },
        displayFieldsMenu: function () {
            this.visible_fields_menu = !this.visible_fields_menu
        },
    }
}
</script>