<div
    x-data="datatables({
        ajaxData: @js($getAjaxData()),
        autoWidth: @js($getAutoWidth()),
        caption: @js($getCaption()),
        data: @js($getData()),
        deferLoading: @js($getDeferLoading()),
        deferRender: @js($getDeferRender()),
        destroy: @js($getDestroy()),
        displayStart: @js($getDisplayStart()),
        columns: @js($getColumns()),
        info: @js($getInfo()),
        lengthChange: @js($getLengthChange()),
        lengthMenu: @js($getLengthMenu()),
        livewireId: @js($getLivewire()->getId()),
        order: @js($getOrder()),
        ordering: @js($getOrdering()),
        orderMulti: @js($getOrderMulti()),
        pageLength: @js($getPageLength()),
        paging: @js($getPaging()),
        pagingType: @js($getPagingType()),
        processing: @js($getProcessing()),
        renderer: @js($getRenderer()),
        retrieve: @js($getRetrieve()),
        rowId: @js($getRowId()),
        scrollCollapse: @js($getScrollCollapse()),
        scrollX: @js($getScrollX()),
        scrollY: @js($getScrollY()),
        search: @js($getSearch()),
        searchCols: @js($getSearchCols()),
        searchDelay: @js($getSearchDelay()),
        searching: @js($getSearching()),
        serverSide: @js($getServerSide())
    })"
    x-init="
        setErrorMode(
            @js($getErrorMode())
        )
    "
    wire:ignore
>
    <table x-ref="table" id="{{ $getId() }}"></table>
</div>
