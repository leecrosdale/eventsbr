<template>

    <div>

        <!-- Lobby -->

        <!-- Play -->

        <div class="row">
            <div class="col-md-8">
                <map-overview-component></map-overview-component>
            </div>
            <div class="col-md-4">

                <controls-component></controls-component>

            </div>
        </div>

        <!-- Dead-->

        <!-- Ended-->

        <!-- Game Log (What's happening in the game -->
        <!-- Chat (Maybe) -->
        <!-- Game Status, Players Remaining -->

    </div>

</template>

<script>
    export default {
        mounted() {

        },
        props: ['player'],
        data() {
            return {
                state: 0 // Lobby, Playing, Dead, Ended
            }
        },
        methods: {

            // Move

            // Stance

            // Shoot

            // Pickup

            // End Turn

        }
    }
</script>
