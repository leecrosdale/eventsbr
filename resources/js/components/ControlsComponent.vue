<template>

    <div>
        <div class="row py-2">
            <div class="col-md-12">
                <button class="btn btn-primary" @click="move('N')">UP</button>
                <button class="btn btn-primary" @click="move('NE')">UP-RIGHT</button>
                <button class="btn btn-primary" @click="move('E')">RIGHT</button>
                <button class="btn btn-primary" @click="move('SE')">DOWN-RIGHT</button>
                <button class="btn btn-primary" @click="move('S')">DOWN</button>
                <button class="btn btn-primary" @click="move('SW')">DOWN-LEFT</button>
                <button class="btn btn-primary" @click="move('W')">LEFT</button>
                <button class="btn btn-primary" @click="move('NW')">UP-LEFT</button>
            </div>
        </div>
    </div>

</template>

<script>

    import {mapGetters, mapActions} from 'vuex'
    import playerApi from '../api/player';

    export default {
        mounted() {

        },

        data() {
            return {

            }
        },
        methods: {

            // Move
            move(direction) {

                if (this.player.pivot.stamina >= 50) {

                    playerApi.move(direction).then((response) => {
                        this.addAction(response.data.action);
                    });

                    playerApi.getPlayer().then((response) => {
                        this.setPlayer(response.data);
                    });
                }
            },
            ...mapActions({
                addAction: 'action/addAction',
                setPlayer: 'player/setPlayer',
            }),


            // Stance

            // Shoot

            // Pickup

            // End Turn
        },
        computed: {
            ...mapGetters({
                player: 'player/getPlayer',
            })
        },
    }
</script>
