<template>
    <div class="my-canvas-wrapper">
        <canvas ref="map-canvas" width="420px" height="420px" style="background: #fff; margin:20px;"></canvas>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                // By creating the provider in the data property, it becomes reactive,
                // so child components will update when `context` changes.
                provider: {
                    // This is the CanvasRenderingContext that children will draw to.
                    context: null
                }
            }
        },

        // Allows any child component to `inject: ['provider']` and have access to it.
        provide() {
            return {
                provider: this.provider
            }
        },

        mounted() {
            // We can't access the rendering context until the canvas is mounted to the DOM.
            // Once we have it, provide it to all child components.
            this.provider.context = this.$refs['map-canvas'].getContext('2d');

            // Resize the canvas to fit its parent's width.
            // Normally you'd use a more flexible resize system.
            this.$refs['map-canvas'].width = this.$refs['map-canvas'].parentElement.clientWidth;
            this.$refs['map-canvas'].height = this.$refs['map-canvas'].parentElement.clientHeight;
            this.render();

        },
        methods: {

            render () {
                // Since the parent canvas has to mount first, it's *possible* that the context may not be
                // injected by the time this render function runs the first time.
                console.log("render");
                if(!this.provider.context) return;
                const ctx = this.provider.context;
                console.log(ctx);


                ctx.beginPath();

                // Draw the new rectangle.
                ctx.rect(0,0, 100, 100);
                ctx.fillStyle = '#f11f41';
                ctx.fill();

                // // Draw the text
                // ctx.fillStyle = '#000'
                // ctx.font = '28px sans-serif';
                // ctx.textAlign = 'center';
                // ctx.fillText(Math.floor(this.value), (newBox.x + (newBox.w / 2)), newBox.y - 14)
            }

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