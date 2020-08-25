(function(){
    let httpRequest

    //  REGISTER DROPDOWNS
    const regionDropdown = document.getElementById("geo-region");
    const districtDropdown = document.getElementById("geo-district");
    const townShipDropdown = document.getElementById("geo-township");
    const townDropdown = document.getElementById("geo-town");


    function makeRequest(target,apiURL, getFunction){
        httpRequest = new XMLHttpRequest();
        if (!httpRequest){
            alert('cannot create an XMLHTTP instance');
            return false;
        }
        httpRequest.onreadystatechange = getFunction;
        httpRequest.open('GET', apiURL + target.value);
        httpRequest.send();
    }

    regionDropdown.addEventListener('change', makeDistrictRequest);

    function makeDistrictRequest(){
        makeRequest(regionDropdown, '/api/getDistricts?regionId=', getDistricts)
    }

    function getDistricts(){
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                const response = JSON.parse(httpRequest.response);
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
    districtDropdown.addEventListener('change', makeTownShipRequest);

    function makeTownShipRequest(){
        makeRequest(districtDropdown, '/api/getTownShips?districtId=', getTownShips)
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

    townShipDropdown.addEventListener('change', makeTownRequest);

    function makeTownRequest(){
        makeRequest(townShipDropdown, "/api/getTowns?townShipId=", getTowns)
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
