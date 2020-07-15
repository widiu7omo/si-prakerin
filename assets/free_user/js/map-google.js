$(document).ready(function($) {
    "use strict";

    //==================================================================================================================
    // VARIABLES
    // =================================================================================================================
    var mapId = "ts-map-hero";
    var newMarkers = [];
    var loadedMarkersData = [];
    var allMarkersData;
    var lastInfobox;
    var lastMarker;
    var map;
    var markerCluster;

    if( $("#"+mapId).length ) {

        var mapElement = $(document.getElementById(mapId));
        var mapDefaultZoom = parseInt(mapElement.attr("data-ts-map-zoom"), 10);
        var centerLatitude = mapElement.attr("data-ts-map-center-latitude");
        var centerLongitude = mapElement.attr("data-ts-map-center-longitude");
        var zoomPosition = mapElement.attr("data-ts-map-zoom-position");
        var controls = parseInt(mapElement.attr("data-ts-map-controls"), 10);
        ( controls === 0 ) ? controls = true : controls = false;
        var locale = mapElement.attr("data-ts-locale");
        var currency = mapElement.attr("data-ts-currency");
        var unit = mapElement.attr("data-ts-unit");
        var scrollWheel = mapElement.attr("data-ts-map-scroll-wheel");
        var mapStyle = mapElement.attr("data-ts-google-map-style");

        if (mapElement.attr("data-ts-display-additional-info")) {
            var displayAdditionalInfoTemp = mapElement.attr("data-ts-display-additional-info").split(";");
            var displayAdditionalInfo = [];
            for (var i = 0; i < displayAdditionalInfoTemp.length; i++) {
                displayAdditionalInfo.push(displayAdditionalInfoTemp[i].split("_"));
            }
        }

        // Default map zoom
        if (!mapDefaultZoom) {
            mapDefaultZoom = 14;
        }


        if( controls !== 0 && zoomPosition ){
            zoomPosition = eval(zoomPosition);
        }

        //==============================================================================================================
        // MAP ELEMENT
        // =============================================================================================================
        map = new google.maps.Map(document.getElementById("ts-map-hero"), {
            zoom: mapDefaultZoom,
            scrollwheel: scrollWheel,
            center: new google.maps.LatLng(centerLatitude, centerLongitude),
            mapTypeId: "roadmap",
            disableDefaultUI: controls,
            zoomControlOptions: {
                position: eval(zoomPosition)
            },
            styles: eval(mapStyle)
        });


        //==============================================================================================================
        // LOAD DATA
        // =============================================================================================================
        loadData();

    }

    function loadData(parameters) {
        $.ajax({
            url: "assets/db/items.json",
            dataType: "json",
            method: "GET",
            cache: false,
            success: function(results){

                if( typeof parameters !== "undefined" && parameters["formData"] ){

                }
                else {
                    allMarkersData = results;
                    loadedMarkersData = allMarkersData;
                }

                createMarkers(); // call function to create markers
            },
            error : function (e) {
                console.log(e);
            }
        });
    }

    /*
    $("#search-btn").on("click", function (e) {
        e.preventDefault();
        var formData = $(this).closest("form").serializeArray();
        loadData({"formData": formData})
    });
    */

    //==================================================================================================================
    // Create DIV with the markers data
    // =================================================================================================================
    function createMarkers(){

        for (var i = 0; i < loadedMarkersData.length; i++) {

            var markerContent = document.createElement('div');

            markerContent.innerHTML =
            '<a href="#" class="ts-marker" data-ts-id="'+ loadedMarkersData[i]["id"] +'">' +
                ( ( loadedMarkersData[i]["ribbon"] !== undefined ) ? '<div class="ts-marker__feature">'+ loadedMarkersData[i]["ribbon"] +'</div>' : "" ) +
                ( ( loadedMarkersData[i]["title"] !== undefined ) ? '<div class="ts-marker__title">'+ loadedMarkersData[i]["title"] +'</div>' : "" ) +
                //( ( loadedMarkersData[i]["price"] !== undefined && loadedMarkersData[i]["price"] > 0 ) ? '<div class="ts-marker__info">'+ currency  + loadedMarkersData[i]["price"] +'</div>' : "" ) +
                ( ( loadedMarkersData[i]["price"] !== undefined && loadedMarkersData[i]["price"] > 0 ) ? '<div class="ts-marker__info">'+ formatPrice(loadedMarkersData[i]["price"]) +'</div>' : "" ) +
                ( ( loadedMarkersData[i]["marker_image"] !== undefined ) ? '<div class="ts-marker__image ts-black-gradient" style="background-image: url('+ loadedMarkersData[i]["marker_image"] +')"></div>' : '<div class="ts-marker__image ts-black-gradient" style="background-image: url(assets/img/marker-default-img.png)"></div>' ) +
            '</a>';

            placeRichMarker({"i": i, "markerContent": markerContent, "method": "latitudeLongitude"});

        }

        // After the markers are created, do the rest

        markersDone();
    }

    //==================================================================================================================
    // When markers are placed, do the rest
    // =================================================================================================================
    function markersDone(){

        //==================================================================================================================
        // GOOGLE MAPS MARKER CLUSTERER
        // =============================================================================================================
        var clusterStyles = [
            {
                url: 'assets/img/cluster.png',
                height: 48,
                width: 48
            }
        ];
        markerCluster = new MarkerClusterer(map, newMarkers, { styles: clusterStyles, maxZoom: 13, ignoreHidden: true });

        google.maps.event.trigger(map, 'idle');

        google.maps.event.addListener(map, 'idle', function(){
            createSideBarResult();
        });

    }

    //==================================================================================================================
    // Google Rich Marker plugin
    // =================================================================================================================
    function placeRichMarker(parameters){

        var i = parameters["i"];

        marker = new RichMarker({
            position: new google.maps.LatLng( loadedMarkersData[i]["latitude"], loadedMarkersData[i]["longitude"] ),
            map: map,
            draggable: false,
            content: parameters["markerContent"],
            flat: true,
            id: loadedMarkersData[i]["id"]
        });

        marker.content.className = "ts-marker-wrapper";
        marker.loopNumber = i;

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                if( lastMarker ){
                    $(lastMarker.content).removeClass("ts-hide-marker");
                }

                openInfobox({"id": $(this.content.firstChild).attr("data-ts-id"), "parentMarker": this, "i": i, "url": "assets/db/items.json" });

                /*
                if( markerTarget == "sidebar"){
                    openSidebarDetail( $(this.content.firstChild).attr("data-id") );
                }
                else if( markerTarget == "infobox" ){
                    openInfobox( $(this.content.firstChild).attr("data-id"), this, i );
                }
                else if( markerTarget == "modal" ){
                    openModal($(this.content.firstChild).attr("data-id"), "modal_item.php", false, isFullScreen);
                }
                */
            }
        })(marker, parameters["i"]));

        newMarkers.push(marker);

    }

    //==================================================================================================================
    // Open InfoBox on marker click
    // =================================================================================================================
    function openInfobox(parameters){

        var i = parameters["i"];
        var parentMarker = parameters["parentMarker"];
        var id = parameters["id"];
        var infoboxHtml = document.createElement('div');

        // First create and HTML for infobox
        createInfoBoxHTML({"i": i, "infoboxHtml": infoboxHtml});

        //==============================================================================================================
        // Set InfoBox options
        //==============================================================================================================
        var infoboxOptions = {
            content: infoboxHtml,
            disableAutoPan: false,
            pixelOffset: new google.maps.Size(-21, -13),
            zIndex: null,
            alignBottom: true,
            boxClass: "infobox-wrapper",
            enableEventPropagation: true,
            infoBoxClearance: new google.maps.Size(1, 1)
        };

        //==============================================================================================================
        // Before showing new InfoBox, close the last one
        //==============================================================================================================

        // Check if the last InfoBox exists and hide it
        if( lastInfobox !== undefined ){
            $(lastInfobox.content_).closest(".infobox-wrapper").removeClass("ts-show");
        }

        // Wait for the hiding animation and remove InfoBox from the map
        setTimeout(function(){
            if( lastInfobox !== undefined ){
                lastInfobox.close();
            }
            // Set new "Last" opened InfoBox
            lastInfobox = newMarkers[i].infobox;
        }, 200);

        // Hide the current marker, so only InfoBox is visible
        $(parentMarker.content).addClass("ts-hide-marker");

        // Set the new "Last" opened marker
        lastMarker = parentMarker;

        // Open new InfoBox
        newMarkers[i].infobox = new InfoBox(infoboxOptions);
        newMarkers[i].infobox.open(map, parentMarker);

        setTimeout(function(){
            $(".ts-infobox[data-ts-id='"+ id +"']").closest(".infobox-wrapper").addClass("ts-show");

            $(".ts-infobox[data-ts-id='"+ id +"'] .ts-close").on("click", function () {
                $(".ts-infobox[data-ts-id='"+ id +"']").closest(".infobox-wrapper").removeClass("ts-show");
                $(parentMarker.content).removeClass("ts-hide-marker");
                setTimeout(function(){
                    newMarkers[i].infobox.close();
                }, 200);
            });
        }, 50);
    }

    //==================================================================================================================
    // Create Infobox HTML element
    //==================================================================================================================

    function createInfoBoxHTML(parameters){

        var i = parameters["i"];
        var infoboxHtml = parameters["infoboxHtml"];
        //var additionalInfoHtml = "";
        //var key = Object.keys(obj)[0];
        //console.log( Object.keys(loadedMarkersData[0]).length );
        //console.log( loadedMarkersData[0]["name"] );
        /*
        if( loadedMarkersData[i]["additional_info"] ){
            for( var a = 0; a < loadedMarkersData[i]["additional_info"].length; a++ ){
                additionalInfoHtml +=
                '<dl>' +
                    '<dt>' + loadedMarkersData[i]["additional_info"][a]["title"] + '</dt>' +
                    '<dd>' + loadedMarkersData[i]["additional_info"][a]["value"] + '</dd>' +
                '</dl>';
            }
        }
        */
        infoboxHtml.innerHTML =
        '<div class="ts-infobox" data-ts-id="'+ loadedMarkersData[i]["id"] +'">' +
            '<img src="assets/img/infobox-close.svg" class="ts-close">' +

            ( ( loadedMarkersData[i]["ribbon"] !== undefined ) ? '<div class="ts-ribbon">'+ loadedMarkersData[i]["ribbon"] +'</div>' : "" ) +
            ( ( loadedMarkersData[i]["ribbon_corner"] !== undefined ) ? '<div class="ts-ribbon-corner"><span>'+ loadedMarkersData[i]["ribbon_corner"] +'</span></div>' : "" ) +

            '<a href="'+ loadedMarkersData[i]["url"] +'" class="ts-infobox__wrapper ts-black-gradient">' +
                ( ( loadedMarkersData[i]["badge"] !== undefined && loadedMarkersData[i]["badge"].length > 0 ) ? '<div class="badge badge-dark">'+ loadedMarkersData[i]["badge"] +'</div>' : "" ) +
                '<div class="ts-infobox__content">' +
                    '<figure class="ts-item__info">' +
                        ( ( loadedMarkersData[i]["price"] !== undefined && loadedMarkersData[i]["price"] > 0 ) ? '<div class="ts-item__info-badge">'+ formatPrice(loadedMarkersData[i]["price"]) +'</div>' : "" ) +
                        ( ( loadedMarkersData[i]["title"] !== undefined && loadedMarkersData[i]["title"].length > 0 ) ? '<h4>'+ loadedMarkersData[i]["title"] +'</h4>' : "" ) +
                        ( ( loadedMarkersData[i]["address"] !== undefined && loadedMarkersData[i]["address"].length > 0 ) ? '<aside><i class="fa fa-map-marker mr-2"></i>'+ loadedMarkersData[i]["address"] +'</aside>' : "" ) +
                    '</figure>' +
                        additionalInfoHTML({display: displayAdditionalInfo, i: i}) +
                    //( ( loadedMarkersData[i]["additional_info"] !== undefined && loadedMarkersData[i]["additional_info"].length > 0 ) ? '<div class="ts-description-lists">'+ additionalInfoHtml +'</div>' : "" ) +
                '</div>' +
                '<div class="ts-infobox_image" style="background-image: url('+ loadedMarkersData[i]["marker_image"] +')"></div>' +
            '</a>' +
        '</div>';
    }

    //==================================================================================================================
    // Create Additional Info HTML element
    //==================================================================================================================

    function additionalInfoHTML(parameters){
        var i = parameters["i"];
        var displayParameter;


        /*
        var additionalInfoHtml = "";
        for( var a = 0; a < parameters["display"].length; a++ ){
            displayParameter = parameters["display"][a];
            if( loadedMarkersData[i][ displayParameter ] !== undefined ) {
                additionalInfoHtml +=
                '<dl>' +
                    '<dt>' + loadedMarkersData[i][ displayParameter ]["title"] + '</dt>' +
                    '<dd>' + loadedMarkersData[i][ displayParameter ]["value"] + ((displayParameter === "area") ? unit : "") + '</dd>' +
                '</dl>';
            }
        }
        if( additionalInfoHtml ){
            return '<div class="ts-description-lists">' + additionalInfoHtml +'</div>';
        }
        else {
            return "";
        }
        */
        //var temp = parameters["display"].split("_");

        var additionalInfoHtml = "";
        for( var a = 0; a < parameters["display"].length; a++ ){
            displayParameter = parameters["display"][a];
            if( loadedMarkersData[i][ displayParameter[0] ] !== undefined ) {
                additionalInfoHtml +=
                '<dl>' +
                    '<dt>' + displayParameter[1] + '</dt>' +
                    '<dd>' + loadedMarkersData[i][ displayParameter[0] ] + ((displayParameter[a] === "area") ? unit : "") + '</dd>' +
                '</dl>';
            }
        }
        if( additionalInfoHtml ){
            return '<div class="ts-description-lists">' + additionalInfoHtml +'</div>';
        }
        else {
            return "";
        }
    }

    //==================================================================================================================
    // Create SideBar HTML Results
    //==================================================================================================================
    function createSideBarResult(){

        //var visibleMarkersId = [];
        var visibleMarkersOnMap = [];
        var resultsHtml = [];

        for( var i = 0; i < loadedMarkersData.length; i++ ){
            if ( map.getBounds().contains( newMarkers[i].getPosition()) ){
                visibleMarkersOnMap.push( newMarkers[i] );
                newMarkers[i].setVisible(true);
            }
            else {
                newMarkers[i].setVisible(false);
            }
        }

        markerCluster.repaint();

        for( i = 0; i < visibleMarkersOnMap.length; i++ ){
            var id = visibleMarkersOnMap[i].loopNumber;
            var additionalInfoHtml = "";

            if( loadedMarkersData[id]["additional_info"] ){
                for( var a = 0; a < loadedMarkersData[id]["additional_info"].length; a++ ){
                    additionalInfoHtml +=
                    '<dl>' +
                        '<dt>' + loadedMarkersData[id]["additional_info"][a]["title"] + '</dt>' +
                        '<dd>' + loadedMarkersData[id]["additional_info"][a]["value"] + '</dd>' +
                    '</dl>';
                }
            }

            resultsHtml.push(
                '<div class="ts-result-link" data-ts-id="' + loadedMarkersData[id]["id"] + '" data-ts-ln="' + newMarkers[id].loopNumber + '">' +
                    '<span class="ts-center-marker"><img src="assets/img/result-center.svg"></span>' +
                    '<a href="'+ loadedMarkersData[id]["url"] +'" class="card ts-item ts-card ts-result">' +
                        ( ( loadedMarkersData[i]["ribbon"] !== undefined ) ? '<div class="ts-ribbon">'+ loadedMarkersData[i]["ribbon"] +'</div>' : "" ) +
                        ( ( loadedMarkersData[i]["ribbon_corner"] !== undefined ) ? '<div class="ts-ribbon-corner"><span>'+ loadedMarkersData[i]["ribbon_corner"] +'</span></div>' : "" ) +
                        '<div href="detail-01.html" class="card-img ts-item__image" style="background-image: url('+ loadedMarkersData[id]["marker_image"] +')"></div>' +
                        '<div class="card-body">' +
                            '<div class="ts-item__info-badge">'+ formatPrice(loadedMarkersData[id]["price"]) +'</div>' +
                            '<figure class="ts-item__info">' +
                                '<h4>'+ loadedMarkersData[id]["title"] +'</h4>' +
                                '<aside>' +
                                    '<i class="fa fa-map-marker mr-2"></i>'+ loadedMarkersData[id]["address"] +'</aside>' +
                            '</figure>' +
                            additionalInfoHTML({display: displayAdditionalInfo, i: i}) +
                        '</div>' +
                        '<div class="card-footer">' +
                            '<span class="ts-btn-arrow">Detail</span>' +
                        '</div>' +
                    '</a>' +
                '</div>'
            );
        }


        $(".ts-results-wrapper").html(resultsHtml);

        if( $("#ts-results .ts-sly-frame").hasClass("ts-loaded") ){
            $("#ts-results .ts-sly-frame").sly("reload");
        }
        else {
            initializeSly();
        }

        var resultsBar = $(".scroll-wrapper.ts-results__vertical-list, .scroll-wrapper.ts-results__grid");
        if ($(window).width() < 575) {
            resultsBar.find(".ts-results__vertical").css("pointer-events", "none");
            resultsBar.on("click", function () {
                $(this).addClass("ts-expanded");
                $(this).find(".ts-results__vertical").css("pointer-events", "auto");
                $("#ts-map-hero").addClass("ts-dim-map");
            });

            $("#ts-map-hero").on("click", function(){
                if (resultsBar.hasClass("ts-expanded")) {
                    resultsBar.removeClass("ts-expanded");
                    $("#ts-map-hero").removeClass("ts-dim-map");
                    resultsBar.find(".ts-results__vertical").css("pointer-events", "none");
                }
            });
        }
        else {
            resultsBar.removeClass("ts-expanded");
            resultsBar.find(".ts-results__vertical").css("pointer-events", "auto");
            $("#ts-map-hero").removeClass("ts-dim-map");
        }

    }

    // Highlight marker on result hover
    //==============================================================================================================

    var timer;
    $(document).on({
        mouseenter: function () {
            var id = $(this).parent().attr("data-ts-id");
            timer = setTimeout(function(){
                $(".ts-marker").parent().addClass("ts-marker-hide");
                $(".ts-marker[data-ts-id='" + id + "']").parent().addClass("ts-active-marker");
            }, 500);
        },
        mouseleave: function () {
            clearTimeout(timer);
            $(".ts-marker").parent().removeClass("ts-active-marker").removeClass("ts-marker-hide");
        }
    }, ".ts-result");

    function formatPrice(price){
        return Number(price).toLocaleString(locale, { style: 'currency', currency: currency }).replace(/\D\d\d$/, '');
    }

    var simpleMapId = "ts-map-simple";
    if( $("#"+simpleMapId).length ){

        mapElement = $(document.getElementById(simpleMapId));
        mapDefaultZoom = parseInt( mapElement.attr("data-ts-map-zoom"), 10 );
        centerLatitude = mapElement.attr("data-ts-map-center-latitude");
        centerLongitude = mapElement.attr("data-ts-map-center-longitude");
        scrollWheel = parseInt( mapElement.attr("data-ts-map-scroll-wheel"), 10 );
        var markerDrag = parseInt( mapElement.attr("data-ts-map-marker-drag"), 10 );
        ( markerDrag === 1 ) ? markerDrag = true : markerDrag = false;
        controls =  parseInt( mapElement.attr("data-ts-map-controls"), 10 );
        ( controls === 1 ) ? controls = false : controls = true ;
        mapStyle = mapElement.attr("data-ts-google-map-style");

        if( !mapDefaultZoom ){
            mapDefaultZoom = 14;
        }

        var mapCenter = new google.maps.LatLng(centerLatitude,centerLongitude);
        var mapOptions = {
            zoom: mapDefaultZoom,
            center: mapCenter,
            disableDefaultUI: controls,
            scrollwheel: scrollWheel,
            styles: mapStyle
        };
        var element = document.getElementById(simpleMapId);
        map = new google.maps.Map(element, mapOptions);
        var marker = new google.maps.Marker({
            position: mapCenter,
            map: map,
            icon: "assets/img/marker-small.png",
            draggable: markerDrag
        });
    }

});


