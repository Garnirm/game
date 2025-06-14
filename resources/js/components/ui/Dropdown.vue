<template>
    <div :id="dropdown_id" class="dropdown w-100">
        <div class="dropdown-header" @click="displayDropdownAction()">
            <div class="header-title placeholder" v-if="selected === null">{{ placeholder }}</div>

            <slot name="header_content" v-else-if="header_content_enabled"></slot>

            <div class="header-title" v-else>
                {{ selected }}

                <icon-close v-if="display_reset_icon" :height="32" :width="32" @click.stop="reset()" />
            </div>

            <div class="header-arrow" :class="{ opened: display_dropdown }">
                <icon-vertical-arrow :height="24" :width="24" />
            </div>
        </div>

        <div class="dropdown-menu w-100" v-click-outside="outside" :class="{ show: display_dropdown }">
            <div class="menu-search" v-if="enable_search">
                <input type="search" v-model="search" class="input w-100" :placeholder="$t('search')" />
            </div>

            <div class="menu-list">
                <slot name="entities_list" :entities="entities" :search="search" v-if="entities_slot_enabled"></slot>

                <template v-for="e in entities" v-else>
                    <div class="menu-list-item" :key="e[ key_item ]" v-if="!enable_search || !search || regexSearch(getSearchItems(e))" @click="select(e)">
                        {{ e[ label_item ] }}
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import dropdown_mixin from '@/mixins/dropdown'

export default {
    mixins: [ dropdown_mixin ],
}
</script>
