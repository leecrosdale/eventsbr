<template>
    <div class="my-canvas-wrapper">
        Status: {{ renderingStatus }}
        <canvas ref="map-canvas" width="448px" height="448px" style="background: #000;"></canvas>
        <slot></slot>
    </div>
</template>

<script>

    import {mapGetters, mapActions} from 'vuex'
    import mapApi from '../api/map'

    export default {
        data() {
            return {
                // By creating the provider in the data property, it becomes reactive,
                // so child components will update when `context` changes.
                provider: {
                    // This is the CanvasRenderingContext that children will draw to.
                    context: null,
                    tileW: 64,
                    tileH: 64,
                },
                terrainColors: [
                    '#228B22',
                    '#808000',
                    '#7CFC00',
                    '#00BFFF'
                ],
                renderingStatus: 'Not Rendering'
            }
        },

        // Allows any child component to `inject: ['provider']` and have access to it.
        provide() {
            return {
                provider: this.provider
            }
        },

        mounted() {
            mapApi.getMap(this.gameId).then((response) => {
                this.setMap(response.data);

                // We can't access the rendering context until the canvas is mounted to the DOM.
                // Once we have it, provide it to all child components.
                this.provider.context = this.$refs['map-canvas'].getContext('2d');

                // Resize the canvas to fit its parent's width.
                // Normally you'd use a more flexible resize system.
                this.$refs['map-canvas'].width = this.$refs['map-canvas'].parentElement.clientWidth;
                this.$refs['map-canvas'].height = this.$refs['map-canvas'].parentElement.clientHeight;


                this.render();
            });


        },
        methods: {

            ...mapActions({
                setMap: 'map/setMap'
            }),

            render() {
                // Since the parent canvas has to mount first, it's *possible* that the context may not be
                // injected by the time this render function runs the first time.
                if (!this.provider.context) return;
                const ctx = this.provider.context;


                this.renderingStatus = 'Rendering';


                let yCount = 0;
                let xCount = 0;


                for (let y in this.map) {

                    xCount = 0;

                    let row = this.map[y];

                    for (let x in row) {

                        let col = this.map[y][x];

                        // ctx.fillStyle = '#'+Math.floor(Math.random()*16777215).toString(16);
                        ctx.fillStyle = this.terrainColors[col.terrain.type];
                        ctx.fillRect(xCount * this.provider.tileW, yCount * this.provider.tileH, this.provider.tileW, this.provider.tileH);
                        ctx.fillStyle = '#000000';
                        ctx.fillText(x + ',' + y, xCount * this.provider.tileW + 5, yCount * this.provider.tileH + 10);

                        if (col.players !== undefined)
                        {
                            for (let p in col.players) {

                                let player = col.players[p];

                                ctx.beginPath();
                                ctx.arc(xCount * this.provider.tileW + this.provider.tileW / 2 , yCount * this.provider.tileH + this.provider.tileH / 2, 10, 0, 2 * Math.PI, false);
                                ctx.fillStyle = 'green';
                                ctx.fill();
                                ctx.lineWidth = 5;
                                ctx.strokeStyle = '#003300';
                                ctx.stroke();

                            }
                        }

                        if (col.items !== undefined)
                        {
                            for (let i in col.items) {

                                let item = col.items[i];

                                ctx.beginPath();
                                ctx.rect(
                                    xCount * this.provider.tileW + this.provider.tileW / 2 ,
                                    yCount * this.provider.tileH + this.provider.tileH / 2,
                                    this.provider.tileW / 4,
                                    this.provider.tileH / 4
                                );
                                ctx.fillStyle = 'blue';
                                ctx.fill();
                                ctx.lineWidth = 5;
                                ctx.strokeStyle = '#003300';
                                ctx.stroke();

                            }
                        }


                        this.renderingStatus = 'Rendered ' + xCount + ',' + yCount;
                        xCount++;
                    }
                    yCount++;
                }

                console.log(yCount);
                console.log(xCount);

                this.renderingStatus = 'Rendering Complete';

            }

        },
        computed: {
            ...mapGetters({
                map: 'map/getMap'
            }),
        }
    }
    //
    // var bw = 400;
    // var bh = 400;
    // var p = 10;
    // var cw = bw + (p*2) + 1;
    // var ch = bh + (p*2) + 1;
    //
    // var canvas = document.getElementById("canvas");
    // var context = canvas.getContext("2d");
    // function drawBoard(){
    //     for (var x = 0; x <= bw; x += 40) {
    //         context.moveTo(0.5 + x + p, p);
    //         context.lineTo(0.5 + x + p, bh + p);
    //     }
    //
    //     for (var x = 0; x <= bh; x += 40) {
    //         context.moveTo(p, 0.5 + x + p);
    //         context.lineTo(bw + p, 0.5 + x + p);
    //     }
    //
    //     context.strokeStyle = "black";
    //     context.stroke();
    // }
    //
    // drawBoard();

</script>