export default {
    getPlayer() {
        return window.axios.get(`get-player`);
    },
    move(direction) {
        return window.axios.post('move', { direction })
    }
}