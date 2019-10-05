export default {
    getPlayer() {
        return window.axios.get(`get-player`);
    },
    move(direction) {
        return window.axios.post('move', { direction });
    },
    pickup(item_id) {
        return window.axios.post('pickup', {item_id});
    }
}