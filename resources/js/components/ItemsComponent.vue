<template>
    <div>
        <p v-for="item in items">
            {{ item.name }} - <button @click="pickUp(item)" class="btn btn-success">PickUp</button>
        </p>
    </div>
</template>

<script>

    import {mapGetters, mapActions} from 'vuex'
    import playerApi from '../api/player';


    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            ...mapActions({
                addAction: 'action/addAction',
                setPlayer: 'player/setPlayer',
            }),
          pickUp(item) {

              playerApi.pickup(item.id).then(response => {
                  this.addAction(response.data.action);
              });

          }
        },
        props: ['items']
    }
</script>
