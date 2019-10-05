<template>
    <div>
        <p v-for="item in items">
            {{ item.name }} - <button @click="pickUp(item)" class="btn btn-success">PickUp</button>
        </p>
    </div>
</template>

<script>

    import playerApi from '../api/player';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
          pickUp(item) {

              playerApi.pickup(item.id).then(response => {
                  console.log(response);
              });

          }
        },
        props: ['items']
    }
</script>
