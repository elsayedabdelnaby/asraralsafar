function getStates(country_id,url) {
    let getStatesURL = url;
    getStatesURL     = getStatesURL.replace('country_id', country_id);
    $.ajax({
            url: getStatesURL,
            type: 'get',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#state_id').html(`<option>Select State</option>`);
                response.data.forEach(function (item) {
                    $('#state_id').append(`<option value="${item.id}">${item.name}</option>`)
                });
            }
        }
    );
}

function getCities(state_id,url) {
    let getCitiesURL = url;
    getCitiesURL     = getCitiesURL.replace('country_id', $('#country_id').val());
    getCitiesURL     = getCitiesURL.replace('state_id', state_id);
    $.ajax({
            url: getCitiesURL,
            type: 'get',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#city_id').html(`<option>Select City</option>`);
                response.data.forEach(function (item) {
                    $('#city_id').append(`<option value="${item.id}">${item.name}</option>`)
                });
            }
        }
    );
}
