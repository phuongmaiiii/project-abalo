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
        <!-- Nếu có url thì dùng router-link -->
        <a v-if="item.url" :href="item.url">{{ item.title }}</a>
        <!-- Nếu có submenu -->
        <template v-else>
            {{item.title}}
            <ul v-if="item.children" class="menu__submenu">
                <MenuItem v-for="(child, i) in item.children" :key="i" :item="child" class="menu__submenu--item" />
            </ul>
        </template>
    </li>
</template>

<style scoped>
a {
    color: inherit;         /* Giữ nguyên màu chữ như phần tử cha */
    text-decoration: none;  /* Bỏ gạch chân */
}

a:hover {
    text-decoration: none;  /* Bỏ gạch chân khi hover */
    color: inherit;         /* Không đổi màu khi hover */
}

</style>
