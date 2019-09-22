<template>
    <div>
        <p v-for="item in items">
            {{ item.id }}
        </p>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['items']
    }
</script>
