(function(){
    var httpRequest
    var regions = document.getElementById("geo-region");
    var selectedRegionId = regions.options[regions.selectedIndex].value;
    regions.addEventListener('change', makeRequest);
    function makeRequest(event){
        console.log(event.target.value);
        httpRequest = new XMLHttpRequest();

        if (!httpRequest){
            alert('cannot create an XMLHTTP instance');
            return false;
        }
        httpRequest.onreadystatechange = getDistricts;
        httpRequest.open('GET', '/api/getDistricts?regionId=' + event.target.value);
        httpRequest.send();
    }

    function getDistricts(){
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                const response = JSON.parse(httpRequest.response);
                console.log(response.length, response, response[0].geoDistrictId, response[0].geoDistrictName);
                districtDropdown = document.getElementById("geo-district");
                for (var i = 0; i<response.length;i++){
                    districtDropdown.appendChild(createDistrictOption(response[i]));
                }
            } else {
                alert('There was a problem with the request.');
            }
        }
    }
    function createDistrictOption(response){
        let newOption = new Option(response.geoDistrictName, response.geoDistrictId);
        return newOption;
    }
})();




