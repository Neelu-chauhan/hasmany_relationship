@extends('layouts.app')
@section('content')
    <!-- BEGIN : Main Content-->
    <style>
        .help-block {
            color: red;
        }

        #map {
            height: 300px;
            width: 100%;
        }
        /* .marker-add{
            position: absolute;
            width: 100%;
        } */

        .gm-ui-hover-effect{
            /* height: 15px !important; */
            display: none !important;

        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <section id ="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header row m-0" style="border-bottom:1px solid #ccc">
                        <div class="col-6 p-0">
                            <h4 class="card-title">Agency Branch/State Create</h4>
                            <p>{{ $agency_data->agency_name }}</p>
                        </div>
                        <div class="col-6 text-right mb-1 p-0">
                            <input type="button" class="btn-success btn mb-0" onclick="window.history.back()"
                                value="Back" />
                        </div>
                    </div>
                    @if ($message = Session::get('error'))
                        <div id="alert-container"></div>
                        <div class="col-lg-12" >
                        <div class="alert alert-icon-right alert-danger alert-dismissible mb-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Sorry!</strong> {{ $message }} <a href="#" class="alert-link"></a>
                        </div>
                        </div>
                    @endif
                    <div class="card-content">
                        <div class="card-body card-dashboard table-responsive ">
                            {!! Form::open(['url' => '/agency/branch/store', 'method' => 'post','id'=>'add_branch']) !!}
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="basicInput">Country <span>*</span></label>
                                            <select name="country_id_fk" id="country_id_fk" class="form-control" >
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['countries_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {!! Form::hidden('agency_id_fk', $agency_id) !!}
                                            <div id="error-country_id_fk" class="help-block"></div>

                                        </fieldset>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-12 mb-1">
                                        <fieldset class="form-group">

                                            <label for="basicInput" class="w-100">Region <span>*</span> <a id="ref_region"
                                                    class="float-right"><img src="{{ asset('app-assets/img/refresh.png') }}"
                                                        alt="Add new Region" title="refresh"></i></a>
                                                <a onClick="window.open('/region2');return false;" title="Add new Region"
                                                    class="float-right"><img
                                                        src="{{ asset('app-assets/img/plus-small.png') }}"
                                                        alt="Add new Region" title="Add new Region"></a></label>

                                            {!! Form::select('region2', ['' => 'Select Region'], '', ['class' => 'form-control', 'id' => 'region2']) !!}
                                            <div id="error-region2" class="help-block"></div>

                                        </fieldset>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="basicInput" class="w-100">City <span>*</span> <a id="ref_city"
                                                    class="float-right"><img src="{{ asset('app-assets/img/refresh.png') }}"
                                                        alt="Add new City" title="refresh"></i></a>
                                                <a onClick="window.open('/city2');return false;" title="Add new City"
                                                    class="float-right"><img
                                                        src="{{ asset('app-assets/img/plus-small.png') }}"
                                                        alt="Add new City" title="Add new City"></a></label>


                                            {!! Form::select('city2', ['' => 'Select City'], '', ['class' => 'form-control', 'id' => 'city2']) !!}
                                            <div id="error-city2" class="help-block"></div>

                                        </fieldset>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="basicInput" class="w-100">Suburb <span>*</span> <a id="ref_suburb"
                                                    class="float-right"><img
                                                        src="{{ asset('app-assets/img/refresh.png') }}"
                                                        alt="Add new Suburb" title="refresh"></i></a>
                                                <a onClick="window.open('/suburb/create');return false;"
                                                    title="Add new Suburb" class="float-right"><img
                                                        src="{{ asset('app-assets/img/plus-small.png') }}"
                                                        alt="Add new Suburb" title="Add new Suburb"></a></label>
                                            {!! Form::select('suburb', ['' => 'Select Suburb'], '', ['class' => 'form-control', 'id' => 'suburb']) !!}
                                            <div id="error-suburb" class="help-block"></div>

                                        </fieldset>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="basicInput">Location <span>*</span></label>
                                            <input id="place-input" type="text" placeholder="Enter a place"
                                                class="form-control" name="place_name">
                                            <input id="place_id" type="text" class="form-control" name="place_id" hidden>
                                            <input id="reference" type="text" class="form-control" name="reference" hidden>
                                            <input id="title" type="text" class="form-control" name="title" hidden>
                                            <input id="formatted_address" type="text" class="form-control" name="formatted_address" hidden>
                                            <div id="error-place_name" class="help-block"></div>

                                        </fieldset>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="basicInput" class="w-100">Email</label>
                                            <input id="email" type="text" class="form-control" name="email"
                                                placeholder="Enter Email" value="{{@$agency_data->agency_email}}">
                                            <div id="error-email" class="help-block"></div>

                                        </fieldset>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="basicInput" class="w-100">Post Code <span>*</span></label>
                                            <input id="post_code" type="text" class="form-control" name="post_code"
                                                placeholder="Post code" readonly>
                                            <div id="error-post_code" class="help-block"></div>

                                        </fieldset>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="basicInput" class="w-100">Latitude <span>*</span></label>
                                            <input id="lat" type="text" class="form-control" name="latitude"
                                                placeholder="Latitude" readonly>
                                            <div id="error-latitude" class="help-block"></div>

                                        </fieldset>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="basicInput" class="w-100">Longitude <span>*</span></label>
                                            <input id="lng" type="text" class="form-control" name="longitude"
                                                placeholder="longitude" readonly>
                                            <div id="error-longitude" class="help-block"></div>
                                        </fieldset>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="basicInput">Status </label>
                                            {!! Form::select('status', ['1' => 'Active'], false, ['class' => 'form-control', 'id' => 'status']) !!}
                                           
                                            <div id="error-messages" class="help-block"></div>

                                        </fieldset>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 mb-1 mt-2">
                                        <div id="map"></div>
                                    </div>

                                    <div class="col-xl-12 text-center">
                                        <button type="submit" class="btn btn-raised btn-raised btn-primary mt-2" id="saveBtn" data-agency_id={{ $agency_id }}> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAj3ofG6IUDV2xya1sNaVLNbDzjUwrsgk0&libraries=places"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="autocomplete.js"></script>
    
<script>
    $(document).ready(function() {
        $('#country_id_fk').select2(
            {
                placeholder: 'Select Country',
                allowClear: true,
            }
        );
        $('#region2').select2(
            {
                placeholder: 'Select Region',
                allowClear: true,
            }
        );
        $('#city2').select2(
            {
                placeholder: 'Select City',
                allowClear: true,
            }
        );
        $('#suburb').select2(
            {
                placeholder: 'Select Suburb',
                allowClear: true,
            }
        );
    });


    $(document).ready(function() {

        $('#country_id_fk').change(function() {

            var countryId = $(this).val();
            if (countryId) {
                showLoader();
                $.ajax({

                    type: "GET",
                    url: "{{ url('/city2/getcity2') }}?country_id=" + countryId,
                    success: function(res) {
                        if (res) {
                            hideLoader();
                            $("#region2").empty();
                            // $("#region2").append('<option>Select</option>');
                            $("#region2").append('<option  value="">Select</option>');

                            $.each(res, function(key, value) {
                                $("#region2").append('<option value="' + value +'">' + key + '</option>');
                                // $("#region2").append('<option value="'+value+'">'+key+'</option>');

                            });

                        } else {
                            hideLoader();
                            $("#region2").empty();
                        }
                    }
                });
            } else {
                hideLoader();
                $("#region2").empty();
            }
        });
   
        $('#region2').change(function() {

            var region2 = $(this).val();

            if (region2) {
                showLoader();

                $.ajax({

                    type: "GET",
                    url: "{{ url('/suburb/getregion2') }}?region_id=" + region2,
                    success: function(res) {
                        if (res) {
                            hideLoader();
                            $("#city2").empty();
                            $("#city2").append('<option value="">Select</option>');
                            $.each(res, function(key, value) {
                                $("#city2").append('<option value="' + value +
                                    '">' + key + '</option>');
                            });

                        } else {
                            hideLoader();
                            $("#city2").empty();
                        }
                    }
                });
            } else {
                hideLoader();
                $("#city2").empty();
            }
        });
   


        $('#city2').change(function() {

            var city = $(this).val();
            var agency_id = '{{ $agency_id }}';
            if (city) {

                showLoader();
                $.ajax({
                    type: "GET",
                    url: "{{ url('/agency/getsuburb') }}?city_id=" + city + "&agency_id=" +
                        agency_id,
                    success: function(res) {
                        if (res) {
                            hideLoader();
                            $("#suburb").empty();
                            $("#suburb").append('<option value="">Select</option>');
                            $.each(res, function(key, value) {
                                $("#suburb").append('<option value="' + value +
                                    '">' + key + '</option>');
                            });

                        } else {
                            hideLoader();
                            $("#suburb").empty();
                        }
                    }
                });
            } else {
                hideLoader();
                $("#suburb").empty();
            }
        });
    });

    $("#ref_suburb").on('click', function() {

        const city_id_fk = $("#city2").val();
        if (city_id_fk != undefined && city_id_fk > 0) {

            refresh_suburb(city_id_fk);
        }
    });

    $("#ref_city").on('click', function() {
        const region_id_fk = $("#region2").val();
        if (region_id_fk != undefined && region_id_fk > 0) {

            refresh_city(region_id_fk);
        }
    });


    $("#ref_region").on('click', function() {

        const country_id_fk = $("#country_id_fk").val();
        if (country_id_fk != undefined && country_id_fk > 0) {
            refresh_region(country_id_fk);
        }
    });

    var refresh_region = function(country_id_fk) {

        $("#region2").empty();
        $.ajax({
            type: "GET",
            url: "{{ url('/city2/getcity2?country_id=') }}" + country_id_fk,
            success: function(res) {
                if (res) {

                    $("#region2").append('<option value="">Select Region</option>');
                    $.each(res, function(key, value) {
                        $("#region2").append('<option value="' + value + '">' + key +
                            '</option>');
                    });
                }
            }
        });
    }

    var refresh_city = function(region_id_fk) {

        $("#city2").empty();
        $.ajax({
            type: "GET",
            url: "{{ url('/suburb/getregion2?region_id=') }}" + region_id_fk,
            success: function(res) {
                if (res) {

                    $("#city2").append('<option value="">Select City</option>');
                    $.each(res, function(key, value) {
                        $("#city2").append('<option value="' + value + '">' + key +
                            '</option>');
                    });
                }
            }
        });
    }

    var refresh_suburb = function(city_id_fk) {

        var agency_id = '{{ $agency_id }}';
        $("#suburb").empty();
        $.ajax({
            type: "GET",
            url: "{{ url('/agency/getsuburb') }}?city_id=" + city_id_fk + "&agency_id=" + agency_id,
            success: function(res) {
                if (res) {

                    $("#suburb").append('<option value="">Select Suburb</option>');
                    $.each(res, function(key, value) {
                        $("#suburb").append('<option value="' + value + '">' + key +
                            '</option>');
                    });
                }
            }
        });
    }

    // place api locationn get 
    //    map show   //
    let map, marker;
    async function initMap() {
        console.log('Initializing map...');
        const {
            Map
        } = await google.maps.importLibrary("maps");

        map = new Map(document.getElementById("map"), {
            center: {
                lat: 7.8731,
                lng: 80.7718
            }, // Default location
            zoom: 2,
        });
        marker = new google.maps.Marker({
            map: map,
            visible: false
        });

        initAutocomplete();
    }
    initMap();

    //  Place Auto Complete  //
    $('#country_id_fk').change(function() {

        var country_id = $('#country_id_fk').val();
        $.ajax({
            type: "GET",
            url: "{{ url('/get_iso_code') }}" + "/" + country_id,
            success: function(res) {
                initAutocomplete(res);
                //   searchPlaces(res);
            }
        });
    });


    function initAutocomplete(res) {
        var input = document.getElementById('place-input');
        var iso = res.countries_iso_code;
        var autocomplete = new google.maps.places.Autocomplete(input, {
            componentRestrictions: {
                country: iso
            } 
        });
        autocomplete.addListener('place_changed', function() {
            var place       = autocomplete.getPlace();
            var place_name  = place.formatted_address;
            var lat         = place.geometry.location.lat();
            var lng         = place.geometry.location.lng();
            var place_id    = place.place_id;
            var reference   = place.reference;
            var title       = place.name;

            // Set map center and zoom to the selected place
            map.setCenter(place.geometry.location);	
            map.setZoom(17);

            // Update marker position and make it visible
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var infoWindow = new google.maps.InfoWindow({
                content: `<div class="marker-add"><strong>Location:</strong> ${place_name}</div>`
            });

            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });

            marker.addListener('mouseover', function() {
                infoWindow.open(map, marker);
            });

            marker.addListener('mouseout', function() {
                infoWindow.close();
            });

            // document.getElementById('place-input').value = place_name;
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
            document.getElementById('place_id').value = place_id;
            document.getElementById('reference').value = reference;
            document.getElementById('title').value = title;
            document.getElementById('formatted_address').value = place_name;
            fetchPlaceDetails(place_id);
        });
    }

    async function fetchPlaceDetails(place_id) {
            var service = new google.maps.places.PlacesService(document.createElement('div'));
            service.getDetails({
                placeId: place_id
            }, function(place, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    var postalCode = '';

                    for (var i = 0; i < place.address_components.length; i++) {
                        var component = place.address_components[i];
                        if (component.types.includes('postal_code')) {
                            postalCode = component.long_name;
                            break;
                        }
                    }
                    document.getElementById('post_code').value = postalCode;
                } else {
                    console.error('Failed to fetch place details:', status);
                }
            });
    }    


// save the form data using ajax
    $(document).ready(function() {

        $('#add_branch').on('submit', function(e) {
            e.preventDefault(); 
            var agency_id = $('#saveBtn').attr('data-agency_id');
            var formData = $(this).serialize();
            showLoader('Loading..', 'Please wait we are saving your data.');
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    hideLoader();
                                     
                    if(response.success){
                        Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message,
                    });
                        window.location.assign(`{{ url('agency/branch/list/${agency_id}') }}`);
                    }else{
                        Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                      });
                    }
                },
                error: function(xhr) {
                    hideLoader();
                    $('.help-block').empty(); 
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#error-' + key).append('<strong>' + value[0] + '</strong>');

                        });
                    } else {
                        Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                    });
                    }
                }
            });
        });
    });
</script>
    
@endsection
