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
    <li>
        {{item.title}}
        <ul v-if="item.children">
            <MenuItem v-for="(child, i) in item.children" :key="i" :item="child" />
        </ul>
    </li>
</template>

<style scoped>

</style>
