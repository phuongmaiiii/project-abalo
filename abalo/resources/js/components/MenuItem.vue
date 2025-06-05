<script>
export default {
    name: "MenuItem",
    props: {
        item: {
            type: Object,
            required: true
        }
    }
}
</script>

<template>
    <li class="menu__item">
        {{item.title}}
        <ul v-if="item.children" class="menu__submenu">
            <MenuItem v-for="(child, i) in item.children" :key="i" :item="child" class="menu__submenu--item" />
        </ul>
    </li>
</template>

<style scoped>

</style>
