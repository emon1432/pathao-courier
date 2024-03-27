<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pathao Courier</title>
</head>

<body>
    <select name="city" id="city">
        <option value="">Select City</option>
    </select>

    <select name="zone" id="zone">
        <option value="">Select Zone</option>
    </select>

    <select name="area" id="area">
        <option value="">Select Area</option>
    </select>

    <div id="table-container"></div>
    <div id="pagination"></div>




    <script>
        //document ready
        var currentPage = 1;
        var perPage = 10; // Number of items per page
        document.addEventListener('DOMContentLoaded', function() {

            loadStores(currentPage);
            loadCities();
        });

        function loadCities() {
            // ajax request
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://127.0.0.1:8000/city-list', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var cities = JSON.parse(xhr.responseText);
                    // console.log(cities);
                    var citySelect = document.getElementById('city');
                    for (var i = 0; i < cities.length; i++) {
                        var option = document.createElement('option');
                        option.text = cities[i].city_name;
                        option.value = cities[i].city_id;
                        citySelect.add(option);
                    }
                }
            }
            xhr.send();
        }


        function loadStores(page) {
            // ajax request
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://127.0.0.1:8000/store-list?page=' + page, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    var stores = response.data.data;
                    var totalStores = response.data.total;

                    // Calculate total number of pages
                    var totalPages = Math.ceil(totalStores / perPage);

                    // Update current page
                    currentPage = page;

                    // Clear previous table content
                    var tableContainer = document.getElementById('table-container');
                    tableContainer.innerHTML = '';

                    // Create table element
                    var table = document.createElement('table');
                    table.border = '1';

                    // Create table header
                    var thead = document.createElement('thead');
                    var headerRow = document.createElement('tr');
                    for (var key in stores[0]) {
                        var th = document.createElement('th');
                        th.textContent = key;
                        headerRow.appendChild(th);
                    }
                    thead.appendChild(headerRow);
                    table.appendChild(thead);

                    // Create table body
                    var tbody = document.createElement('tbody');
                    stores.forEach(function(store) {
                        var row = document.createElement('tr');
                        for (var key in store) {
                            var cell = document.createElement('td');
                            cell.textContent = store[key];
                            row.appendChild(cell);
                        }
                        tbody.appendChild(row);
                    });
                    table.appendChild(tbody);

                    // Append table to container
                    tableContainer.appendChild(table);

                    // Add pagination buttons
                    addPaginationButtons(totalPages);
                }
            }
            xhr.send();
        }

        function addPaginationButtons(totalPages) {
            var paginationDiv = document.getElementById('pagination');
            paginationDiv.innerHTML = '';

            var prevButton = document.createElement('button');
            prevButton.textContent = 'Previous';
            prevButton.addEventListener('click', function() {
                if (currentPage > 1) {
                    loadStores(currentPage - 1);
                }
            });
            paginationDiv.appendChild(prevButton);

            var nextButton = document.createElement('button');
            nextButton.textContent = 'Next';
            nextButton.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    loadStores(currentPage + 1);
                }
            });
            paginationDiv.appendChild(nextButton);
        }

        document.getElementById('city').addEventListener('change', function() {
            var cityId = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://127.0.0.1:8000/zone-list/' + cityId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var zones = JSON.parse(xhr.responseText);
                    // console.log(zones);
                    var zoneSelect = document.getElementById('zone');
                    zoneSelect.innerHTML = '<option value="">Select Zone</option>';
                    for (var i = 0; i < zones.length; i++) {
                        var option = document.createElement('option');
                        option.text = zones[i].zone_name;
                        option.value = zones[i].zone_id;
                        zoneSelect.add(option);
                    }
                }
            }
            xhr.send();
        });

        document.getElementById('zone').addEventListener('change', function() {
            var zoneId = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://127.0.0.1:8000/area-list/' + zoneId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var areas = JSON.parse(xhr.responseText);
                    // console.log(areas);
                    var areaSelect = document.getElementById('area');
                    areaSelect.innerHTML = '<option value="">Select Area</option>';
                    for (var i = 0; i < areas.length; i++) {
                        var option = document.createElement('option');
                        option.text = areas[i].area_name;
                        option.value = areas[i].area_id;
                        areaSelect.add(option);
                    }
                }
            }
            xhr.send();
        });
    </script>
</body>

</html>
