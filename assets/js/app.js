$(document).ready(function(){
	// dataTable    
        if($(".dtable").length > 0)
            $(".dtable").dataTable({bFilter: false, bInfo: false, bPaginate: false, bLengthChange: false,                                                                       
                                   bSort: true,
                                   bAutoWidth: true,
                                   "aoColumnDefs": [{"bSortable": false,
                                                     "aTargets": [ -1 , 0]}]});    
        if($(".fTable").length > 0)
            $(".fTable").dataTable({bSort: true, 
                                    "iDisplayLength": 20, "aLengthMenu": [20,40,80,120], // can be removed for basic 10 items per page
                                    "aoColumnDefs": [{"bSortable": false,
                                                     "aTargets": [ -1 , 0]}]});
        
        if($(".fpTable").length > 0)
            $(".fpTable").dataTable({bSort: true, 
                                     bAutoWidth: true,
                                    "iDisplayLength": 20, "aLengthMenu": [20,40,80,120], // can be removed for basic 10 items per page
                                    "sPaginationType": "full_numbers",
                                    "aoColumnDefs": [{"bSortable": false,
                                                     "aTargets": [ -1 , 0]}]});
        
        if($(".aTable").length > 0)
            $(".aTable").dataTable({bSort: true,                                     
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": true,
                                    "sAjaxSource": 'php/ajax_datatable.php'});        
        
    // eif dataTable   
});