var autocomplete;
function initialize() {
    input = document.getElementById('autocompleteLocation');
    if( input ) {
        autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', fillInAddress);
    }
    if( typeof $function_after_location_set=="function" ){
        $function_after_location_set();
    }
}

function fillInAddress() {
    city_name = google_location = full_address = postcode_address = street_name = temp_address = '';
    var addressArr = [];
    var place = autocomplete.getPlace();
    for (var i = 0; i < place.address_components.length; i++) {
        
        full_address += (i == 0) ? '' + place.address_components[i].long_name : ',' + place.address_components[i].long_name;

        for (var j = 0; j < place.address_components[i].types.length; j++) {
            if (place.address_components[i].types[j] == "street_number") {
                addressArr['street_number'] = place.address_components[i].long_name;
            } else if (place.address_components[i].types[j] == "route") {
                addressArr['route'] = place.address_components[i].long_name;
            } else if (place.address_components[i].types[j] == "postal_code") {
                postcode_address = place.address_components[i].long_name;
            } else if (place.address_components[i].types[j] == "country") {
                country_code = place.address_components[i].short_name;
                country_name = place.address_components[i].long_name;
            } else if (place.address_components[i].types[j] == "administrative_area_level_2") {
                city_name = place.address_components[i].long_name;
            } else if (place.address_components[i].types[j] == "administrative_area_level_1") {
                state_name = place.address_components[i].long_name;
            }
        }
    }
    var geo_location = place.geometry.location;
    latitude = geo_location.lat();
    longitude = geo_location.lng();
    place_id = place.place_id;
    google_location = $('#autocompleteLocation').val();
    saveLocationLocally();
}

function saveLocationLocally() {
//    if (typeof(Storage) !== "undefined") {
//        localStorage.setItem("latitude",latitude);
//        localStorage.setItem("longitude",longitude);
//        localStorage.setItem("place_id",place_id);
//        localStorage.setItem("full_address",full_address);
//        localStorage.setItem("google_location",google_location);
//    }
    show_location_values();
    if( typeof $function_after_location_set=="function" ){
        $function_after_location_set();
    }
}

function show_location_values() {
    
    if( document.getElementById("full_address") )  {
        document.getElementById("full_address").value=full_address;
        document.getElementById("autocompleteLocation").value=google_location;
        document.getElementById("place_id").value=place_id;
        document.getElementById("longitude").value=longitude;
        document.getElementById("latitude").value=latitude;
    }
}

function commonAjx(pageUrl, replaceDivId, serializdeDivId, ajaxRespDivReplaceFrom, method, jsonObject, functionAfterSuccess, functionParms, functionAfterError, errorfunctionParms, fileFlag) {
    var $csrfToken = false;
    var $return = '';
    if (typeof csrf !== 'undefined') {
        $csrfToken = JSON.parse(getLocalStorageItem('csrf'));
        var tokenName = $csrfToken.name;
        var tokenValue = $csrfToken.hash;
    }
    var postData = '';
    if (typeof serializdeDivId !== 'undefined' && serializdeDivId != '') {
        var postData = $('#' + serializdeDivId + " :input").serialize();
    }
    method = (typeof method !== 'undefined' && method != '') ? method : 'POST';
    if (typeof jsonObject == 'object') {
        if (typeof fileFlag !== 'undefined' && fileFlag === true) {
            postData = jsonObject;
        } else {
            if (postData != '') {
                postData += '&';
            }
            postData += $.param(jsonObject);
        }
    }

    if ($csrfToken && method.toLowerCase() == 'post') {
        if (typeof postData == 'object' && fileFlag) {
            postData.append(tokenName, tokenValue);
        } else {
            if (postData != '') {
                postData += '&';
            }
            postData += tokenName + '=' + tokenValue;
        }
    }
    var contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
    var processData = true;
    if (typeof fileFlag !== 'undefined' && fileFlag === true) {
        contentType = false;
        processData = false;
    }
    $.ajax({
        url: pageUrl,
        type: method,
        data: postData,
        contentType: contentType,
        processData: processData,
        beforeSend: function () {
            showLoadingDiv();
        }, success: function (respData) {
            hideLoadingDiv();
            if (typeof functionAfterSuccess == 'function') {
                if ($csrfToken) {
                    setLocalStorageItem('csrf', JSON.stringify(JSON.parse(respData).csrf));
                }
                functionAfterSuccess(respData, functionParms);
            } else if (typeof replaceDivId !== 'undefined' && replaceDivId != '') {
                if (typeof ajaxRespDivReplaceFrom !== 'undefined' && ajaxRespDivReplaceFrom != '') {
                    respData = $('#' + ajaxRespDivReplaceFrom, respData).html();
                }

                //console.log(respData);
                $('#' + replaceDivId).html(respData);
            } else {
                if ($csrfToken) {
                    setLocalStorageItem('csrf', JSON.stringify(JSON.parse(respData).csrf));
                }
            }

        }, error: function (error) {
            hideLoadingDiv();
            if (typeof functionAfterError == 'function') {
                functionAfterError(error, errorfunctionParms);
            }
        }
    });
}

function showLoadingDiv(){show_loading_div();}
function hideLoadingDiv(){ hide_loading_div();}
function show_loading_div() {
    jQuery('.loader_div').removeClass("d-none");
}
function hide_loading_div() {
    jQuery('.loader_div').addClass("d-none");
}
function get_states(country_id){ 
    commonAjx(base_url+"/ajax/get_states", "", "",
"", "post",{country_id:country_id}, set_states);
}
function set_states(response){
    var $resp = JSON.parse(response);
    var $html = "";
    jQuery($resp.data).each(function($key,$state){
        $html+="<option value='"+$state.id+"'>"+$state.name+"</option>";
    });
    jQuery(":input[name='state'] option[value!='']").remove();
    jQuery(":input[name='state']");
    jQuery(":input[name='state']").append($html);
}
function get_cities(country_id,state_id,city_id){ 
    commonAjx(base_url+"/ajax/get_cities", "", "",
"", "post",{"country_id":country_id,"state_id":state_id,'city_id':city_id}, set_cities);
}
function set_cities(response){
    var $resp = JSON.parse(response);
    var $html = "";
    jQuery($resp.data).each(function($key,$cities){
        $html+="<option value='"+$cities.id+"' "+( ( typeof $cities.selected !="undefined" && $cities.selected==true ) ? "selected=''" :"" )+">"+$cities.name+"</option>";
    });
    jQuery(":input[name='city'] option[value!='']").remove();
    jQuery(":input[name='city']");
    jQuery(":input[name='city']").append($html);
}

function error_message($message) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toastr-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.error($message);
}
function success_message($message){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toastr-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.success($message);
}
$(function(){
    jQuery(document).on("change",":input[name=country]",function(){
      get_states( $(this).val() ); 
    }); 
    jQuery(document).on("change",":input[name=state]",function(){
       get_cities($(":input[name=country]").val(), $(this).val() ); 
    });
    if( $('.date_picker').length> 0) {
        $('.date_picker').flatpickr({
            enableTime:!1,dateFormat:"d-m-Y"
        });
    }

});