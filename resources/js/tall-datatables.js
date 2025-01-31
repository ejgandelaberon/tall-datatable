import DataTable from 'datatables.net-dt';

const TallDatatable = (Alpine) => {
    Alpine.data('datatables', ({
        ajaxData = {},
        autoWidth = undefined,
        caption = undefined,
        columns = [],
        data = [],
        deferLoading = null,
        deferRender = null,
        destroy = null,
        displayStart = null,
        info = true,
        lengthChange = false,
        lengthMenu = [10, 25, 50, 100],
        livewireId,
        order = [],
        ordering = true,
        orderMulti = false,
        pageLength = null,
        paging = true,
        pagingType = null,
        processing = true,
        renderer = null,
        retrieve = null,
        rowId = undefined,
        scrollCollapse = false,
        scrollX = false,
        scrollY = null,
        search = null,
        searchCols = null,
        searchDelay,
        searching,
        serverSide,
    }) => ({
        init() {
            this.table = new DataTable(this.$refs.table, {
                ajax: this._ajaxCallback,
                autoWidth,
                caption,
                columns,
                // // columnDefs: undefined,
                data,
                deferLoading,
                deferRender,
                destroy,
                displayStart: displayStart || undefined,
                info,
                // // language: undefined,
                // // layout: undefined,
                lengthChange,
                lengthMenu,
                // // orderCellsTop: undefined,
                // // orderClasses: undefined,
                // // orderDescReverse: undefined,
                order,
                // // orderFixed: undefined,
                ordering,
                orderMulti,
                pageLength,
                paging,
                pagingType,
                processing,
                renderer,
                retrieve,
                rowId: rowId || undefined,
                scrollCollapse,
                scrollX,
                scrollY,
                search,
                searchCols: searchCols || undefined,
                searchDelay,
                searching,
                serverSide,
                // // stateDuration: undefined,
                // // stateSave: undefined,
                // // stripeClasses: undefined,
                // // tabIndex: undefined,
                // // createdRow: undefined,
                // // drawCallback: undefined,
                // // footerCallback: undefined,
                // // formatNumber: undefined,
                // // headerCallback: undefined,
                // // infoCallback: undefined,
                // // initComplete: undefined,
                // // preDrawCallback: undefined,
                // // rowCallback: undefined,
                // // stateLoadCallback: undefined,
                // // stateLoaded: undefined,
                // // stateLoadParams: undefined,
                // // stateSaveCallback: undefined,
                // // stateSaveParams: undefined,
                }
            );
        },

        async _ajaxCallback(data, callback) {
            callback(
                await Livewire.find(livewireId).fetch({
                    ...data,
                    ...ajaxData,
                })
            );
        },

        setErrorMode(mode) {
            if (typeof mode !== 'string') {
                DataTable.ext.errMode = async function (_, techNote, message) {
                    await Livewire.find(livewireId).handleError(techNote, message);
                };
            } else {
                DataTable.ext.errMode = mode;
            }
        }
    }));
};

document.addEventListener('alpine:init', () => {
    window.Alpine.plugin([
        TallDatatable,
    ]);
});
