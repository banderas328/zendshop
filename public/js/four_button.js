/**
 * Created with JetBrains PhpStorm.
 * User: Anton_Zhavrid
 * Date: 1/22/13
 * Time: 5:53 AM
 * To change this template use File | Settings | File Templates.
 */
$.fn.dataTableExt.oPagination.four_button = {
    /*
     * Function: oPagination.four_button.fnInit
     * Purpose:  Initalise dom elements required for pagination with a list of the pages
     * Returns:  -
     * Inputs:   object:oSettings - dataTables settings object
     *           node:nPaging - the DIV which contains this pagination control
     *           function:fnCallbackDraw - draw function which must be called on update
     */
    "fnInit": function ( oSettings, nPaging, fnCallbackDraw )
    {
        nFirst = document.createElement( 'span' );
        nPrevious = document.createElement( 'span' );
        nNext = document.createElement( 'span' );
        nLast = document.createElement( 'span' );

        nFirst.appendChild( document.createTextNode( first ) );
        nPrevious.appendChild( document.createTextNode( prev ) );
        nNext.appendChild( document.createTextNode( next ) );
        nLast.appendChild( document.createTextNode( last ) );

        nFirst.className = "btn btn-warning";
        nPrevious.className = "btn btn-warning";
        nNext.className="btn btn-warning";
        nLast.className = "btn btn-warning";

        nPaging.appendChild( nFirst );
        nPaging.appendChild( nPrevious );
        nPaging.appendChild( nNext );
        nPaging.appendChild( nLast );

        $(nFirst).click( function () {
            oSettings.oApi._fnPageChange( oSettings, "first" );
            fnCallbackDraw( oSettings );
        } );

        $(nPrevious).click( function() {
            oSettings.oApi._fnPageChange( oSettings, "previous" );
            fnCallbackDraw( oSettings );
        } );

        $(nNext).click( function() {
            oSettings.oApi._fnPageChange( oSettings, "next" );
            fnCallbackDraw( oSettings );
        } );

        $(nLast).click( function() {
            oSettings.oApi._fnPageChange( oSettings, "last" );
            fnCallbackDraw( oSettings );
        } );

        /* Disallow text selection */
        $(nFirst).bind( 'selectstart', function () { return false; } );
        $(nPrevious).bind( 'selectstart', function () { return false; } );
        $(nNext).bind( 'selectstart', function () { return false; } );
        $(nLast).bind( 'selectstart', function () { return false; } );
        $(".send").bind("click",show_orders)   ;
    },

    /*
     * Function: oPagination.four_button.fnUpdate
     * Purpose:  Update the list of page buttons shows
     * Returns:  -
     * Inputs:   object:oSettings - dataTables settings object
     *           function:fnCallbackDraw - draw function which must be called on update
     */
    "fnUpdate": function ( oSettings, fnCallbackDraw )
    {

        if ( !oSettings.aanFeatures.p )
        {
            return;
        }

        /* Loop over each instance of the pager */
        var an = oSettings.aanFeatures.p;
        for ( var i=0, iLen=an.length ; i<iLen ; i++ )
        {
            var buttons = an[i].getElementsByTagName('span');
            if ( oSettings._iDisplayStart === 0 )
            {
                buttons[0].className = "btn btn-warning";
                buttons[1].className = "btn btn-warning";
            }
            else
            {
                buttons[0].className = "btn btn-warning";
                buttons[1].className = "btn btn-warning";
            }

            if ( oSettings.fnDisplayEnd() == oSettings.fnRecordsDisplay() )
            {
                buttons[2].className = "btn btn-warning";
                buttons[3].className = "btn btn-warning";
            }
            else
            {
                buttons[2].className = "btn btn-warning";
                buttons[3].className = "btn btn-warning";
            }
        }
        $(".send").bind("click",show_orders);


    }
};
