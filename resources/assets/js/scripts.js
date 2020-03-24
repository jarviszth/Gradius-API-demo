(function($) {

    'use strict';
    var $APP_URL_TO_DELETE = '';
    var $APP_DATA_ID_TO_HIDE = '';
    var $ID_SELECTD_FOR_DELETE_ALL = '';
    $(document).ready(function() {
        // Initializes search overlay plugin.
        // Replace onSearchSubmit() and onKeyEnter() with 
        // your logic to perform a search and display results
       $(".list-view-wrapper").scrollbar();

       $('[data-pages="search"]').search({
            // Bind elements that are included inside search overlay
            searchField: '#overlay-search',
            closeButton: '.overlay-close',
            suggestions: '#overlay-suggestions',
            brand: '.brand',
             // Callback that will be run when you hit ENTER button on search box
            onSearchSubmit: function(searchString) {
                console.log("Search for: " + searchString);
            },
            // Callback that will be run whenever you enter a key into search box. 
            // Perform any live search here.  
            onKeyEnter: function(searchString) {
                console.log("Live search for: " + searchString);
                var searchField = $('#overlay-search');
                var searchResults = $('.search-results');

                /* 
                    Do AJAX call here to get search results
                    and update DOM and use the following block 
                    'searchResults.find('.result-name').each(function() {...}'
                    inside the AJAX callback to update the DOM
                */

                // Timeout is used for DEMO purpose only to simulate an AJAX call
                clearTimeout($.data(this, 'timer'));
                searchResults.fadeOut("fast"); // hide previously returned results until server returns new results
                var wait = setTimeout(function() {

                    searchResults.find('.result-name').each(function() {
                        if (searchField.val().length != 0) {
                            $(this).html(searchField.val());
                            searchResults.fadeIn("fast"); // reveal updated results
                        }
                    });
                }, 500);
                $(this).data('timer', wait);

            }
        })

		
		
		
	$('.theme-color').on('click', function(e){
        e.preventDefault();
        var main_color = $(this).data('color');
        var main_name = $(this).attr('data-main');
        $('body').removeClass (function (index, css) {
            return (css.match (/(^|\s)color-\S+/g) || []).join(' ');
        });
        $('body').addClass('color-'+main_name);
		//alert('main_color='+main_color+' main_name='+main_name);
	

    });


        /* Basic portlet for standard panel */
        $('.portlet-basic-v').portlet({
            progress: 'circle',//circle,bar
            progressColor: 'danger',//success,danger,warning,info
            onRefresh: function() {
                // Timeout to simulate AJAX response delay

                //setTimeout(function() {
                //    // Hides progress indicator
                //    $('.portlet-basic-v').portlet({
                //        refresh: false
                //    });
                //}, 2000);
            }
        });

        /* select province for change amphur */
        $("body").on("change", ".onChangeAmphurByProvince", function(){
            var provinceId = $("#app_province_select").val();
            //alert('province='+provinceId);

            if(provinceId){
                /* loading porlet*/
                $('.portlet-basic-v').portlet({refresh: true});
                //$("#app_amphur_select").children().remove() ;
                $("#app_amphur_select").empty();
                $.ajax({
                    type: "POST",
                    url: "ajaxprovinceonchangeamphur",
                    contentType: "application/x-www-form-urlencoded", //For encode to utf8
                    data: "appprovince="+provinceId,
                    cache: false,
                    success: function(html){
                        $("#app_amphur_select").prepend(html);

                        /* hide loading porlet*/
                        $('.portlet-basic-v').portlet({refresh: false});

                        //seleted frist option
                        $("#app_amphur_select").val($("#app_amphur_select option:first").val());


                    }
                });
            }
        });
        /* select amphur for change district */
        $("body").on("change", ".onChangeDistrictByAmphur", function(){
            var amphurId = $("#app_amphur_select").val();
            //alert('province='+provinceId);

            if(amphurId){
                /* loading porlet*/
                $('.portlet-basic-v').portlet({refresh: true});

                //$("#app_district_select").children().remove() ;
                $("#app_district_select").empty();
                $.ajax({
                    type: "POST",
                    url: "ajaxamphuronchangedistrict",
                    contentType: "application/x-www-form-urlencoded", //For encode to utf8
                    data: "appamphur="+amphurId,
                    cache: false,
                    success: function(html){
                        $("#app_district_select").prepend(html);

                        /* hide loading porlet*/
                        $('.portlet-basic-v').portlet({refresh: false});
                        //seleted frist option
                        $("#app_district_select").val($("#app_district_select option:first").val());
                    }
                });
            }
        });
    });

    
    $('.panel-collapse label').on('click', function(e){
        e.stopPropagation();
    })
    //select all checkbox
    $("#checkBoxAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    /* START APP DELETE CONFIRM */
    $("body").on("click", ".app-delete-seleted-confirm", function(){

        //desable click outside
        $('#modal-app-delete-seleted-confirm').modal({
            backdrop: 'static',
            keyboard: false
        });
        //$('#modal-app-delete-seleted-confirm').modal('show');


        $APP_URL_TO_DELETE = $(this).attr('href');
        $APP_DATA_ID_TO_HIDE = $(this).attr('data-id-hide');
        //clear err from modal
        $('#modal-app-delete-seleted-confirm-err').html('');
        return false;
    });
    $("body").on("click", ".app-delete-seleted-confirm-yes", function(){
        $('#modal-app-delete-seleted-confirm-loading').fadeIn('fast');
        var trHideId = $APP_DATA_ID_TO_HIDE;
        $.ajax({
            type: "POST",
            url: $APP_URL_TO_DELETE,//when send parameter from url in Controller get value of parameter with $_GET
            contentType: "application/x-www-form-urlencoded", //For encode to utf8
            //data: "appamphur=111&id=99",//when send parameter from url in Controller get value of parameter with $_POST
            cache: false,
            success: function(html){

                if(html!=''){
                    $('#modal-app-delete-seleted-confirm-err').html(html);
                }else{
                    $('#modal-app-delete-seleted-confirm').modal('hide');
                    $('#'+trHideId).hide();
                }
            }
        });

        //reset delete variable
        $APP_URL_TO_DELETE = '';
        $APP_DATA_ID_TO_HIDE = '';
        $('#modal-app-delete-seleted-confirm-loading').fadeOut();
        return false;
    });
    /* END APP DELETE CONFIRM */

    /* START APP DELETE ALL CONFIRM */
    $("body").on("click", ".app-delete-seletedall-confirm", function(){

        var selected = []; // initialize empty array
        $("input:checkbox[name=check]:checked").each(function() {
            selected.push($(this).val());
        });
        /*
        $("input:checkbox[name=type]:checked").each(function(){
            checkArray.push($(this).val());
        });*/
        if(selected!=''){
            var selectId="";


            // selected.forEach(function(entry) {
            //     console.log(entry);
            // });

            var index;
            for (index = 0; index < selected.length; ++index) {
                if(index==0){
                    selectId +=selected[index];
                }else{
                    selectId +="_"+selected[index];
                }
                // console.log(selected[index]);
            }
            $ID_SELECTD_FOR_DELETE_ALL = selectId;
            // alert('checked arr='+selected);
            // console.log('checked id='+selectId);
            $('#modal-app-delete-seleted-all-confirm').modal({
                backdrop: 'static',
                keyboard: false
            });
        }else{
            alert('Please Select Some rec');
        }
        return false;
    });
    $("body").on("click", ".app-delete-seleted-all-confirm-yes", function(){
        $('#modal-app-delete-seleted-all-confirm-loading').fadeIn('fast');

        $.ajax({
            type: "POST",
            url: $BASE_URL+'accountdeleteAll',//when send parameter from url in Controller get value of parameter with $_GET
            data: "_id_selected="+$ID_SELECTD_FOR_DELETE_ALL,//when send parameter from url in Controller get value of parameter with $_POST
            contentType: "application/x-www-form-urlencoded", //For encode to utf8
            cache: false,
            success: function(html){
                // console.log(html);
                location.reload();
            }
        });
        $ID_SELECTD_FOR_DELETE_ALL='';
        //reset delete variable
        $('#modal-app-delete-seleted-all-confirm-loading').fadeOut();
        return false;
    });
    /* END APP DELETE ALL CONFIRM */


    /* START APP DELETE LOG */
    $("body").on("click", ".app-delete-logs-confirm", function(){

        //desable click outside
        $('#modal-app-delete-logs-confirm').modal({
            backdrop: 'static',
            keyboard: false
        });
        //$('#modal-app-delete-seleted-confirm').modal('show');


        //clear err from modal
        $('#modal-app-delete-logs-confirm-err').html('');
        return false;
    });
    $("body").on("click", ".app-delete-logs-confirm-yes", function(){
        $('#modal-app-delete-logs-confirm-loading').fadeIn('fast');
        $.ajax({
            type: "POST",
            url: $BASE_URL+'logsdelete',//when send parameter from url in Controller get value of parameter with $_GET
            contentType: "application/x-www-form-urlencoded", //For encode to utf8
            //data: "appamphur=111&id=99",//when send parameter from url in Controller get value of parameter with $_POST
            cache: false,
            success: function(html){
                location.reload();
            }
        });

        //reset delete variable
        $('#modal-app-delete-logs-confirm-loading').fadeOut();
        return false;
    });
    /* END APP DELETE LOG */

    /* START BACKUP DB */
    $("body").on("click", ".app-maintenances-backup", function(){
        var serverOs = $(this).attr('data-os');
        if(serverOs!='windows'){
            $('#modal-app-ajax-loding').modal({
                backdrop: 'static',
                keyboard: false
            });
            $.ajax({
                type: "POST",
                url: $BASE_URL+'maintenancesDbBackup',//when send parameter from url in Controller get value of parameter with $_GET
                contentType: "application/x-www-form-urlencoded", //For encode to utf8
                cache: false,
                success: function(html){
                    $('#modal-app-ajax-loding').modal('hide');
                    // alert(html);
                    location.reload();
                }
            });
            return false;
        }else{
            location.href = $BASE_URL+'maintenancesDbBackup';
        }
    });
    $("body").on("click", ".app-maintenances-delete", function(){
        var fileName = $(this).attr('data-file-name');
            $('#modal-app-ajax-loding').modal({
                backdrop: 'static',
                keyboard: false
            });
            $.ajax({
                type: "GET",
                url: $BASE_URL+'maintenancesDbDelete?_db='+fileName,//when send parameter from url in Controller get value of parameter with $_GET
                //data: "_db="+fileName,
                contentType: "application/x-www-form-urlencoded", //For encode to utf8
                cache: false,
                success: function(html){
                    $('#modal-app-ajax-loding').modal('hide');
                    location.reload();
                }
            });

            return false;
    });
    /* END BACKUP DB */

    

    /* START FREERADIUS STOP*/
    $("body").on("click", ".maintanace-freeradius-stop", function(){
        $('#modal-app-ajax-loding').modal({
            backdrop: 'static',
            keyboard: false
        });
        $.ajax({
            type: "POST",
            url: $BASE_URL+'stopfreeradius',//when send parameter from url in Controller get value of parameter with $_GET
            // data: "_user_name="+userName+"&_spanStatusId="+spanStatusId,
            contentType: "application/x-www-form-urlencoded", //For encode to utf8
            cache: false,
            success: function(html){
                $('#modal-app-ajax-loding').modal('hide');
                alert(html);
            }
        });
        return false;
    });
    /* START FREERADIUS STOP*/


    
})(window.jQuery);