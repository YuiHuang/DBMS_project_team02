document.addEventListener('DOMContentLoaded', function() {
    var storedData = localStorage.getItem('storedData');

    if (storedData) {
        // 如果有存儲的資料，直接使用它
        populateDropdown(JSON.parse(storedData));
    } else {
        // 否則，向後端發送請求並保存資料到本地存儲
        fetchDataAndSave();
    }

    // 監聽輸入框變化事件，當輸入框內容改變時，更新下拉選單
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
            
            // 將資料保存到本地存儲
            localStorage.setItem('storedData', JSON.stringify(data));

            // 將資料加入下拉式選單
            populateDropdown(data);
        }
    };

    xhr.send();
}

function populateDropdown(data) {
    var dropdown = document.getElementById('dataDropdown');
    // 清空下拉式選單
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

        // 根據搜尋內容隱藏或顯示下拉選單項目
        if (optionText.includes(searchTerm.toLowerCase())) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    }
}
