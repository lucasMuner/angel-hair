export default (wireModel, selectId, placeholder = 'Selecione as opções...') => ({
    init() {
        this.$nextTick(() => {
            const $select = $(`#${selectId}`);

            $select.select2({ placeholder, allowClear: true, width: '100%' });

            $select.on('change', () => {
                this.$wire.set(wireModel, $select.val() || []);
            });
        });

        window.addEventListener('select2-set-values', (e) => {
            if (e.detail.id !== selectId) return;
            this.$nextTick(() => {
                $(`#${selectId}`).val(e.detail.values).trigger('change.select2');
            });
        });

        window.addEventListener('select2-set-disabled', (e) => {
            if (e.detail.id !== selectId) return;
            this.$nextTick(() => {
                $(`#${selectId}`)
                    .prop('disabled', e.detail.disabled)
                    .trigger('change.select2');
            });
        });
    }
});
