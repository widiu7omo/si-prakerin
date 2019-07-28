var mapId = "ts-map-hero";

function GetMap(){
    "use strict";

    //==================================================================================================================
    // VARIABLES
    // =================================================================================================================
    var newMarkers = [];
    var loadedMarkersData = [];
    var allMarkersData;
    var lastInfobox;
    var lastInfoboxHtml;
    var lastMarker;
    var map;

    if ($("#" + mapId).length) {

        //==============================================================================================================
        // MAP SETTINGS
        // =============================================================================================================

        var mapElement = $(document.getElementById(mapId));
        var mapDefaultZoom = parseInt(mapElement.attr("data-ts-map-zoom"), 10);
        var centerLatitude = mapElement.attr("data-ts-map-center-latitude");
        var centerLongitude = mapElement.attr("data-ts-map-center-longitude");
        var bingMapApiKey = mapElement.attr("data-ts-bing-map-api-key");
        var bingMapTypeId = mapElement.attr("data-ts-bing-map-type-id");
        var locale = mapElement.attr("data-ts-locale");
        var currency = mapElement.attr("data-ts-currency");
        var unit = mapElement.attr("data-ts-unit");
        var controls = parseInt(mapElement.attr("data-ts-map-controls"), 10);
        ( controls === 0 ) ? controls = false : controls = true;
        var scrollWheel = parseInt(mapElement.attr("data-ts-map-scroll-wheel"), 10);
        ( scrollWheel === 0 ) ? scrollWheel = true : scrollWheel = false;
        var layer;

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

        //==================================================================================================================
        // MAP ELEMENT
        // =================================================================================================================

        map = new Microsoft.Maps.Map("#" + mapId, {
            credentials: bingMapApiKey,
            center: new Microsoft.Maps.Location(centerLatitude, centerLongitude),
            mapTypeId: eval(bingMapTypeId),
            zoom: mapDefaultZoom,
            disableScrollWheelZoom: scrollWheel,
            showZoomButtons: controls
        });

        //==================================================================================================================
        // LOAD DATA
        // =================================================================================================================

        loadData();
    }
    function loadData(parameters) {
        $.ajax({
            url: "assets/db/items.json",
            dataType: "json",
            method: "GET",
            cache: false,
            success: function (results) {

                if (typeof parameters !== "undefined" && parameters["formData"]) {
                    loadFormData(parameters);
                }
                else {
                    allMarkersData = results;
                    loadedMarkersData = allMarkersData;
                }

                createMarkers(); // call function to create markers
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    //==================================================================================================================
    // Create DIV with the markers data
    // =================================================================================================================
    function createMarkers() {

        //Register the custom module.
        Microsoft.Maps.registerModule('HtmlPushpinLayerModule', 'assets/js/HtmlPushpinLayerModule.js');

        //Load the module.
        Microsoft.Maps.loadModule('HtmlPushpinLayerModule', function () {

            for (var i = 0; i < loadedMarkersData.length; i++) {
                var markerContent = document.createElement('div');
                markerContent.innerHTML =
                    '<div class="ts-marker-wrapper"><a href="#" class="ts-marker" data-ts-id="' + loadedMarkersData[i]["id"] + '">' +
                    ( ( loadedMarkersData[i]["ribbon"] !== undefined ) ? '<div class="ts-marker__feature">' + loadedMarkersData[i]["ribbon"] + '</div>' : "" ) +
                    ( ( loadedMarkersData[i]["title"] !== undefined ) ? '<div class="ts-marker__title">' + loadedMarkersData[i]["title"] + '</div>' : "" ) +
                    ( ( loadedMarkersData[i]["price"] !== undefined && loadedMarkersData[i]["price"] > 0 ) ? '<div class="ts-marker__info">' + formatPrice(loadedMarkersData[i]["price"]) + '</div>' : "" ) +
                    ( ( loadedMarkersData[i]["marker_image"] !== undefined ) ? '<div class="ts-marker__image ts-black-gradient" style="background-image: url(' + loadedMarkersData[i]["marker_image"] + ')"></div>' : '<div class="ts-marker__image ts-black-gradient" style="background-image: url(assets/img/marker-default-img.png)"></div>' ) +
                    '</a></div>';

                placeBingMarker({"i": i, "markerContent": markerContent});
            }

            layer = new HtmlPushpinLayer(newMarkers);
            map.layers.insert(layer);


            //Microsoft.Maps.loadModule("Microsoft.Maps.Clustering", function () {
                //var clusterLayer = new Microsoft.Maps.ClusterLayer(newMarkers);
                //map.layers.insert(clusterLayer);
            //});

            // After the markers are created, do the rest

            markersDone();

        });
    }

    //==================================================================================================================
    // When markers are placed, do the rest
    // =================================================================================================================
    function markersDone() {

        Microsoft.Maps.Events.addHandler(map, 'viewchangeend', createSideBarResult );
        createSideBarResult();
    }

    //==================================================================================================================
    // Google Rich Marker plugin
    // =================================================================================================================

    function placeBingMarker(parameters) {

        var i = parameters["i"];
        var location = new Microsoft.Maps.Location(loadedMarkersData[i]["latitude"], loadedMarkersData[i]["longitude"]);
        var marker = new HtmlPushpin(location, parameters["markerContent"].innerHTML, {anchor: new Microsoft.Maps.Point(50, 12)});

        marker.loopNumber = i;
        newMarkers.push(marker);

        // Open Popup on click

        $(marker._element.firstChild).on("click", function () {
            if (lastMarker && lastMarker._element) {
                $(lastMarker._element.firstChild).removeClass("ts-hide-marker");
            }
            openInfobox({
                "id": $(this).find(".ts-marker").attr("data-ts-id"),
                "parentMarker": marker,
                "i": i,
                "url": "assets/db/items.json"
            });
        })
    }

    //==================================================================================================================
    // Open InfoBox on marker click
    // =================================================================================================================
    function openInfobox(parameters) {

        var i = parameters["i"];
        var parentMarker = parameters["parentMarker"];
        var id = parameters["id"];
        var infoboxHtml = document.createElement('div');

        // First create an HTML for infobox
        createInfoBoxHTML({"i": i, "infoboxHtml": infoboxHtml});

        //==============================================================================================================
        // Set InfoBox options
        //==============================================================================================================

        var infobox = new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(loadedMarkersData[i]["latitude"], loadedMarkersData[i]["longitude"]), {
            htmlContent: infoboxHtml.innerHTML,
            offset: new Microsoft.Maps.Point(-47, -30)
        });

        //==============================================================================================================
        // Before showing new InfoBox, close the last one
        //==============================================================================================================

        // Check if the last InfoBox exists and hide it
        if( lastInfoboxHtml ){
            $(lastInfoboxHtml).closest(".infobox-wrapper").removeClass("ts-show");
        }

        // Wait for the hiding animation and remove InfoBox from the map
        setTimeout(function(){
            if( lastInfobox !== undefined ){
                lastInfobox.setMap(null);
            }
            // Set new "Last" opened InfoBox
            lastInfobox = infobox;
        }, 200);

        // Set the new "Last" opened marker
        lastMarker = parentMarker;

        // Hide the current marker, so only InfoBox is visible
        $(parentMarker._element.firstChild).addClass("ts-hide-marker");

        // Open infobox
        infobox.setMap(map);

        lastInfoboxHtml = $(".ts-infobox[data-ts-id='" + id + "']").closest(".infobox-wrapper");

        setTimeout(function () {
            $(".ts-infobox[data-ts-id='" + id + "']").closest(".infobox-wrapper").addClass("ts-show");

            $(".ts-infobox[data-ts-id='" + id + "'] .ts-close").on("click", function () {
                $(".ts-infobox[data-ts-id='" + id + "']").closest(".infobox-wrapper").removeClass("ts-show");
                $(parentMarker._element.firstChild).removeClass("ts-hide-marker");
                setTimeout(function(){
                    infobox.setMap(null);
                }, 200);
            });
        }, 50);

    }

    //==================================================================================================================
    // Create Infobox HTML element
    //==================================================================================================================

    function createInfoBoxHTML(parameters) {

        var i = parameters["i"];
        var infoboxHtml = parameters["infoboxHtml"];

        infoboxHtml.innerHTML =
            '<div class="infobox-wrapper">' +
                '<div class="ts-infobox" data-ts-id="' + loadedMarkersData[i]["id"] + '">' +
                    '<img src="assets/img/infobox-close.svg" class="ts-close">' +

                    ( ( loadedMarkersData[i]["ribbon"] !== undefined ) ? '<div class="ts-ribbon">' + loadedMarkersData[i]["ribbon"] + '</div>' : "" ) +
                    ( ( loadedMarkersData[i]["ribbon_corner"] !== undefined ) ? '<div class="ts-ribbon-corner"><span>' + loadedMarkersData[i]["ribbon_corner"] + '</span></div>' : "" ) +

                    '<a href="' + loadedMarkersData[i]["url"] + '" class="ts-infobox__wrapper ts-black-gradient">' +
                        ( ( loadedMarkersData[i]["badge"] !== undefined && loadedMarkersData[i]["badge"].length > 0 ) ? '<div class="badge badge-dark">' + loadedMarkersData[i]["badge"] + '</div>' : "" ) +
                        '<div class="ts-infobox__content">' +
                            '<figure class="ts-item__info">' +
                                ( ( loadedMarkersData[i]["price"] !== undefined && loadedMarkersData[i]["price"] > 0 ) ? '<div class="ts-item__info-badge">' + formatPrice(loadedMarkersData[i]["price"]) + '</div>' : "" ) +
                                ( ( loadedMarkersData[i]["title"] !== undefined && loadedMarkersData[i]["title"].length > 0 ) ? '<h4>' + loadedMarkersData[i]["title"] + '</h4>' : "" ) +
                                ( ( loadedMarkersData[i]["address"] !== undefined && loadedMarkersData[i]["address"].length > 0 ) ? '<aside><i class="fa fa-map-marker mr-2"></i>' + loadedMarkersData[i]["address"] + '</aside>' : "" ) +
                            '</figure>' +
                            additionalInfoHTML({display: displayAdditionalInfo, i: i}) +
                        '</div>' +
                        '<div class="ts-infobox_image" style="background-image: url(' + loadedMarkersData[i]["marker_image"] + ')"></div>' +
                    '</a>' +
                '</div>' +
            '</div>';
    }

    //==================================================================================================================
    // Create Additional Info HTML element
    //==================================================================================================================

    function additionalInfoHTML(parameters) {
        var i = parameters["i"];
        var displayParameter;

        var additionalInfoHtml = "";
        for (var a = 0; a < parameters["display"].length; a++) {
            displayParameter = parameters["display"][a];
            if (loadedMarkersData[i][displayParameter[0]] !== undefined) {
                additionalInfoHtml +=
                    '<dl>' +
                        '<dt>' + displayParameter[1] + '</dt>' +
                        '<dd>' + loadedMarkersData[i][displayParameter[0]] + ((displayParameter[a] === "area") ? unit : "") + '</dd>' +
                    '</dl>';
            }
        }
        if (additionalInfoHtml) {
            return '<div class="ts-description-lists">' + additionalInfoHtml + '</div>';
        }
        else {
            return "";
        }
    }

    //==================================================================================================================
    // Create SideBar HTML Results
    //==================================================================================================================
    function createSideBarResult() {

        var visibleMarkersOnMap = [];
        var resultsHtml = [];



        for (var i = 0; i < loadedMarkersData.length; i++) {
            //visibleMarkersOnMap.push( newMarkers[i] );
            //console.log(newMarkers[i].getLocation());

            if ( map.getBounds().contains( newMarkers[i].getLocation() )) {
                visibleMarkersOnMap.push(newMarkers[i]);
                newMarkers[i].setOptions({visible: true});
            }
            else {
                newMarkers[i].setOptions({visible: false});
            }

        }

        for (i = 0; i < visibleMarkersOnMap.length; i++) {
            var id = visibleMarkersOnMap[i].loopNumber;
            var additionalInfoHtml = "";

            if (loadedMarkersData[id]["additional_info"]) {
                for (var a = 0; a < loadedMarkersData[id]["additional_info"].length; a++) {
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
                    '<a href="' + loadedMarkersData[id]["url"] + '" class="card ts-item ts-card ts-result">' +
                        ( ( loadedMarkersData[i]["ribbon"] !== undefined ) ? '<div class="ts-ribbon">' + loadedMarkersData[i]["ribbon"] + '</div>' : "" ) +
                        ( ( loadedMarkersData[i]["ribbon_corner"] !== undefined ) ? '<div class="ts-ribbon-corner"><span>' + loadedMarkersData[i]["ribbon_corner"] + '</span></div>' : "" ) +
                        '<div href="detail-01.html" class="card-img ts-item__image" style="background-image: url(' + loadedMarkersData[id]["marker_image"] + ')"></div>' +
                        '<div class="card-body">' +
                            '<div class="ts-item__info-badge">' + formatPrice(loadedMarkersData[id]["price"]) + '</div>' +
                            '<figure class="ts-item__info">' +
                                '<h4>' + loadedMarkersData[id]["title"] + '</h4>' +
                                '<aside>' +
                                '<i class="fa fa-map-marker mr-2"></i>' + loadedMarkersData[id]["address"] + '</aside>' +
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

        if ($("#ts-results .ts-sly-frame").hasClass("ts-loaded")) {
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

    function formatPrice(price) {
        return Number(price).toLocaleString(locale, {style: 'currency', currency: currency}).replace(/\D\d\d$/, '');
    }
}




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCTIONS ///////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function simpleMap(latitude, longitude, markerImage, mapStyle, mapElement, markerDrag){
    if (!markerDrag){
        markerDrag = false;
    }
    var mapCenter = new google.maps.LatLng(latitude,longitude);
    var mapOptions = {
        zoom: 13,
        center: mapCenter,
        disableDefaultUI: true,
        scrollwheel: false,
        styles: mapStyle
    };
    var element = document.getElementById(mapElement);
    var map = new google.maps.Map(element, mapOptions);
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(latitude,longitude),
        map: map,
        icon: markerImage,
        draggable: markerDrag
    });
}
