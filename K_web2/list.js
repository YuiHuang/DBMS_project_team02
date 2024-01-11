document.addEventListener('DOMContentLoaded', function() {
    var storedData = localStorage.getItem('storedData');

    if (storedData) {
        populateDropdown(JSON.parse(storedData));
    } else {
        fetchDataAndSave();
    }
    
    var searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function() {
        console.log(searchInput.value);
        filterDropdown(searchInput.value);
    });
});

function fetchDataAndSave() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'list.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            
            //store in cookie
            localStorage.setItem('storedData', JSON.stringify(data));
            //generate data
            populateDropdown(data);
        }
    };

    xhr.send();
}

function populateDropdown(data) {
    var dropdown = document.getElementById('dataDropdown');

    dropdown.innerHTML = '';

    data.forEach(function(item) {
        var option = document.createElement('option');
        option.value = item.id;
        option.textContent = item.ingr_name;
        dropdown.appendChild(option);
    });
}

function filterDropdown(searchTerm) {
    var dropdown = document.getElementById('dataDropdown');
    var options = dropdown.querySelectorAll('option');
    options.forEach(function(option) {
        option.style.display = 'none';
    });

    for (var i = 0; i < options.length; i++) {
        var option = options[i];
        var optionText = option.textContent.toLowerCase();

        if (optionText.includes(searchTerm.toLowerCase())) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    }
}
