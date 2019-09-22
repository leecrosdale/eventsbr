<template>

    <div>
        <div class="row py-2">
            <div class="col-md-12">
                <button class="btn btn-primary" @click="move('N')">N</button>
                <button class="btn btn-primary" @click="move('NE')">NE</button>
                <button class="btn btn-primary" @click="move('E')">E</button>
                <button class="btn btn-primary" @click="move('SE')">SE</button>
                <button class="btn btn-primary" @click="move('S')">S</button>
                <button class="btn btn-primary" @click="move('SW')">SW</button>
                <button class="btn btn-primary" @click="move('W')">W</button>
                <button class="btn btn-primary" @click="move('NW')">NW</button>
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

                playerApi.move(direction).then((response) => {
                    this.addAction(response.data.action);
                });

            },
            ...mapActions({
                addAction: 'action/addAction'
            })

            // Stance

            // Shoot

            // Pickup

            // End Turn
        }
    }
</script>
