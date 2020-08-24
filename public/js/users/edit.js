(function(){
    var httpRequest

    //  GET DISTRICTS SELECTION
    var regions = document.getElementById("geo-region");
    var districtDropdown = document.getElementById("geo-district");
    var townShipDropdown = document.getElementById("geo-township");
    var townDropdown = document.getElementById("geo-town");
    var selectedRegionId = regions.options[regions.selectedIndex].value;



    regions.addEventListener('change', makeDistrictRequest);

    function makeDistrictRequest(event){
        makeRequest(event, '/api/getDistricts?regionId=', getDistricts)
    }

    function makeRequest(event,apiURL, getFunction){
        console.log(event.target.value);
        httpRequest = new XMLHttpRequest();
        if (!httpRequest){
            alert('cannot create an XMLHTTP instance');
            return false;
        }
        httpRequest.onreadystatechange = getFunction;
        httpRequest.open('GET', apiURL + event.target.value);
        httpRequest.send();
    }

    function getDistricts(){
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                const response = JSON.parse(httpRequest.response);
                console.log(response.length, response, response[0].geoDistrictId, response[0].geoDistrictName);
                districtDropdown.innerHTML=""
                for (var i = 0; i<response.length;i++){
                    districtDropdown.appendChild(createDistrictOption(response[i]));
                }
                townShipDropdown.innerHTML=""
                townDropdown.innerHTML=""
            } else {
                alert('There was a problem with the request.');
            }
        }
    }
    function createDistrictOption(response){
        return new Option(response.geoDistrictName, response.geoDistrictId);
    }

    //    GET TOWNSHIPS SELECTION
    var selectedDistrictId = districtDropdown.options[districtDropdown.selectedIndex].value;
    districtDropdown.addEventListener('change', makeTownShipRequest);

    function makeTownShipRequest(event){
        makeRequest(event, '/api/getTownShips?districtId=', getTownShips)
    }

    function getTownShips(){
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                const response = JSON.parse(httpRequest.response);
                townShipDropdown.innerHTML=""
                for (var i = 0; i<response.length;i++){
                    townShipDropdown.appendChild(createTownShipOption(response[i]));
                }
                townDropdown.innerHTML=""
            } else {
                alert('There was a problem with the request.');
            }
        }
    }
    function createTownShipOption(response){
        return new Option(response.geoTownShipName, response.geoTownShipId);
    }


    // GET TOWN SELECTION
    var selectedTownShip = townShipDropdown.options[townDropdown.selectedIndex].value;
    townShipDropdown.addEventListener('change', makeTownRequest);
    function makeTownRequest(event){
        makeRequest(event, "/api/getTowns?townShipId=", getTowns)
    }

    function getTowns(){
        if (httpRequest.readyState === XMLHttpRequest.DONE){
            if (httpRequest.status === 200){
                const response = JSON.parse(httpRequest.response);
                townDropdown.innerHTML=""
                for (var i = 0; i<response.length;i++){
                    townDropdown.appendChild(createTownOption(response[i]));
                }
            } else {
                alert('There was a problem with the request.');
            }
        }
    }

    function createTownOption(response){
        return new Option(response.geoTownName, response.geoTownId)
    }
})();
