export default {
    getPlayer() {
        return window.axios.get(`get-player`);
    }
}