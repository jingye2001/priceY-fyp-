@extends('layout')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<style>
    .center-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .filter-container {
        display: flex;
        justify-content: center; 
        align-items: flex-start;
    }

    .filter {
        flex: 0 0 calc(20% - 20px); /* Adjust the basis and margin based on your preference */
        margin: 0 10px; /* Add margin for spacing between filters */
        box-sizing: border-box;
    }

    .filter button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }
    .moreFilter{
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
        text-wrap: nowrap;
    }

    #results {
        margin-top: 20px;
    }

    #results ul {
        list-style-type: none;
        padding: 0;
    }

    #results li {
        margin-bottom: 10px;
        background-color: #f2f2f2;
        padding: 10px;
        border-radius: 5px;
    }
    .sub-category {
        display: none;
    }

    .arrow {
        cursor: pointer;
        margin-right: 5px;
    }

    /* Range Slider styles */
.range-slider {
    width: 300px;
    margin: auto;
    text-align: center;
    position: relative;
    height: 6em;
}

.slider {
position: relative;
width: calc(100% - 25px); /* Adjust the width based on input widths */
margin: 10px auto; /* Center the slider */
}
.slider input[type=range] {
width: 100%;
position: absolute;
-webkit-appearance: none; /* Override default appearance */
background: transparent; /* Transparent track */
z-index: 2;
}
.slider input[type=range]::-webkit-slider-thumb {
-webkit-appearance: none;
height: 20px;
width: 20px;
border-radius: 50%;
background: currentColor;
cursor: pointer;
margin-top: -8px; /* Adjust this based on the thumb size */
}
.slider input[type=range]:first-of-type {
z-index: 3; /* Ensures this thumb is above the second thumb */
}
.slider input[type=range]:first-of-type::-webkit-slider-thumb {
background: #2196F3; /* Red thumb */
}
.slider input[type=range]:last-of-type::-webkit-slider-thumb {
background: #2196F3; /* Green thumb */
}
.slider::before {
content: '';
display: block;
position: absolute;
top: 50%;
transform: translateY(-50%);
width: 100%;
height: 4px;
background: #ddd;
z-index: 1; /* Ensure the track is below the thumbs */
}
.slider::after {
content: '';
display: block;
position: absolute;
top: 50%;
transform: translateY(-50%);
background: #009688;
height: 4px;
z-index: 1; /* Same as ::before to stay under thumbs */
left: 0;
right: 0;
}

/**sidebar */
.sidebar {
    height: auto;
    width: 0;
    background-color: darkgray;
    color: white;
    position: absolute;
    left: 0;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 20px;
    padding-bottom: 20px;
    text-align: left; 
    z-index: 9;  
    top : 0;
}

.fixed-sidebar {
    position: fixed; /* 固定定位 */
    top: 85px; /* 固定在距离页面顶部10px的位置 */
    /* ...其他样式，如宽度、阴影等... */
}

.sidebar a {
    padding: 8px 8px 8px 5px;
    text-decoration: none;
    font-size: 25px;
    color: white;
    display: block;
    transition: 0.3s;
}
.sidebar button{
    -webkit-box-align: center;
    align-items: center;
    color: white;
    cursor: pointer;
    display: flex;
    flex-direction: row;
    padding: 0.5rem;
    text-align: left;
    width: 100%;
    box-shadow: rgb(255, 208, 102) 0px -2px 0px inset;
    background-color: rgba(5, 30, 46, 0.05);
    border:none;
    position: relative;
}
.sidebar a:hover {
    color: #f1f1f1;
}

.filter-options {
    max-height: 300px; /* 调整固定高度 */
    overflow-y: auto; /* 添加滚动条 */
}

/**display */
#results {
    display: flex;
    flex-wrap: wrap;
}

.laptop-list {
    display: flex;
    flex-wrap: wrap;
}

.col-md-3 {
    width: 25%; /* Adjust the width based on your design */
}

.product-grid {
    border: 1px solid #ddd; /* Add borders or styling as needed */
    padding: 10px;
    text-align: center;
    margin-top: 15px;
    height: 95%;
}

.product-image{
    height: 65%;
    
}

.product-image img {
    max-width: 100%;
    height: auto;
}

.product-content {
    padding: 10px;
}

.title a {
    color: #333;
    text-decoration: none;
}

.memory {
    margin-top: 5px;
    font-size: 14px;
    color: #777;
}

/* iPhone (portrait) */
@media only screen and (max-width: 480px) {
    .filter-container {
        flex-direction: row; /* 将过滤器从上到下更改为从左到右 */
        flex-wrap: wrap; /* 允许过滤器在一行中换行 */
        justify-content: center; /* 居中对齐过滤器 */
    }

    .filter {
        width: 48%; /* 设置过滤器的宽度，以便在一行中容纳两个过滤器，并留有一些间距 */
        margin: 0 1%; /* 为过滤器之间添加一些水平间距 */
        margin-bottom: 10px; /* 为每个过滤器底部添加一些垂直间距 */
    }

    .moreFilter {
        width: 96%; /* 使"更多过滤器"按钮占用一行的宽度，并留有一些间距 */
    }
    .sidebar{
        height: 100%;
    }
    .sidebar .filter{
        width: 90%;
    }

    .product-content {
        padding: 0px;
    }
    .title {
        font-size: 1.0rem;
    }

    .product-image{
        height: 35%;
    }
    .price{
        font-size:  16px;
    }
}

/* iPad (portrait and landscape) */
@media only screen and (min-width: 481px) and (max-width: 1024px) {
    .filter-container {
        flex-direction: row; /* 将过滤器从上到下更改为从左到右 */
        flex-wrap: wrap; /* 允许过滤器在一行中换行 */
        justify-content: center; /* 居中对齐过滤器 */
    }

    .filter {
        width: 48%; /* 设置过滤器的宽度，以便在一行中容纳两个过滤器，并留有一些间距 */
        margin: 0 1%; /* 为过滤器之间添加一些水平间距 */
        margin-bottom: 10px; /* 为每个过滤器底部添加一些垂直间距 */
    }

    .moreFilter {
        width: 96%; /* 使"更多过滤器"按钮占用一行的宽度，并留有一些间距 */
    }
    .sider{
        width: 40%;
        padding-left: 45px;
    }
    .sidebar .filter{
        width: 90%;
    }

    .product-content {
        padding: 0px;
    }   
    .product-image{
        height: 45%;
    }
    .price{
        font-size:26px;
    }
    .price{
        font-size: 22px;
    }
    .title{
        font-size: 14px;
    }
}

@media only screen and (min-width: 1024px) and (max-width: 2732px) {
    .filter-container {
        flex-direction: row; /* 将过滤器从上到下更改为从左到右 */
        flex-wrap: nowrap; /* 允许过滤器在一行中换行 */
        justify-content: center; /* 居中对齐过滤器 */
    }

    .filter {
        width: 48%; /* 设置过滤器的宽度，以便在一行中容纳两个过滤器，并留有一些间距 */
        margin: 0 1%; /* 为过滤器之间添加一些水平间距 */
        margin-bottom: 10px; /* 为每个过滤器底部添加一些垂直间距 */
    }

    .moreFilter {
        width: 96%; /* 使"更多过滤器"按钮占用一行的宽度，并留有一些间距 */
    }
    .sidebar .filter{
        width: 90%;
    }
  }
</style>

<!--sidebar -->
<div class="sidebar" id="mySidebar">
    <a href="javascript:void(0)" class="close-btn" onclick="closeSidebar()">X</a>
    <!-- 这里是过滤器的表单 -->
    <form action="{{ route('laptopFilter.filter') }}" method="GET" id="sidebarLaptopFilterForm">

       <!-- Display Technology Filter -->
        <div class="filter" name="display-technology" id="displayTechToggle">
            <button type="button" class="filter-options" onclick="toggleDisplayTechOptions()">Display Technology<span id="displayTechArrow">&#9660;</span></button>
            
            <div class="display-tech-options" id="displayTechOptions" style="display:flex; flex-direction: column; text-align: left; padding: 13px 12px;">
                <label><input type="checkbox" class="filter-options" name="display-tech[]" value="lcd"> LCD</label>
                <label><input type="checkbox" class="filter-options" name="display-tech[]" value="oled"> OLED</label>
                <label><input type="checkbox" class="filter-options" name="display-tech[]" value="ips"> IPS</label>
                <label><input type="checkbox" class="filter-options" name="display-tech[]" value="va"> VA</label>
            </div>
        </div>

        <!-- Screen Size Filter -->
        <div class="filter" name="screen-size" id="screenSizeToggle">
            <button type="button" class="filter-options" onclick="toggleScreenSizeOptions()">Screen Size<span id="screenSizeArrow">&#9660;</span></button>
            
            <div class="screen-size-options" id="screenSizeOptions" style="display: none; text-align: left; padding: 13px 12px;">
                <input type="number" name="screen-size-from" id="screen_size_from" value="0" min="0" max="19" class="filter-options-input">
                to
                <input type="number" name="screen-size-to" id="screen_size_to" value="19" min="0" max="19" class="filter-options-input">
                inch
                <div class="slider">
                    <input type="range" value="0" min="0" max="19" class="filter-options-range" id="lower">
                    <input type="range" value="19" min="0" max="19" class="filter-options-range" id="upper">
                    <svg width="100%" height="24">
                        <line x1="4" y1="12" x2="296" y2="12" stroke="#444" stroke-width="12" stroke-dasharray="1, 28"></line>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Screen Resolution Filter -->
        <div class="filter" name="screen-resolution" id="screenResolutionToggle">
            <button type="button" class="filter-options" onclick="toggleScreenResolutionOptions()">Screen Resolution<span id="screenResolutionArrow">&#9660;</span></button>
            
            <div class="screen-resolution-options" id="screenResolutionOptions" style="display: flex; flex-direction: column; text-align: left; padding: 13px 12px;">
                <label><input type="checkbox" class="filter-options" name="screen-resolution[]" value="2560x1600"> 2560x1600</label>
                <label><input type="checkbox" class="filter-options" name="screen-resolution[]" value="1920x1080"> 1920x1080</label>
                <label><input type="checkbox" class="filter-options" name="screen-resolution[]" value="2880x1864"> 2880x1864</label>
                <label><input type="checkbox" class="filter-options" name="screen-resolution[]" value="3024x1964"> 3024x1964</label>
                <label><input type="checkbox" class="filter-options" name="screen-resolution[]" value="3456x2234"> 3456x2234</label>
                <label><input type="checkbox" class="filter-options" name="screen-resolution[]" value="1366x768"> 1366x768</label>
            </div>
        </div>

        <!-- Memory Filter -->
        <div class="filter" name="memory" id="memoryToggle">
            <button type="button" class="filter-options" onclick="toggleMemoryOptions()">Memory<span id="memoryArrow">&#9660;</span></button>

            <div class="memory-options" id="memoryOptions" style="display: none; text-align: left; padding: 13px 12px;">
                <input type="number" name="memory-from" id="memory_from" value="0" min="0" max="64" class="memory-input">
                to
                <input type="number" name="memory-to" id="memory_to" value="64" min="0" max="64" class="memory-input">
                GB Ram
                
                <div class="slider">
                    <input type="range" value="0" min="0" max="64" class="memory-range" id="lower">
                    <input type="range" value="64" min="0" max="64" step="1" class="memory-range" id="upper">
                    <svg width="100%" height="24">
                        <line x1="4" y1="12" x2="296" y2="12" stroke="#444" stroke-width="12" stroke-dasharray="1, 28"></line>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Storage Filter -->
        <div class="filter" name="storage" id="storageToggle">
            <button type="button" class="filter-options" onclick="toggleStorageOptions()">Storage<span id="storageArrow">&#9660;</span></button>

            <div class="storage-options" id="storageOptions" style="display: none; text-align: left; padding: 13px 12px;">
                <input type="number" name="storage-from" id="storage_from" value="0" min="0" max="512" class="storage-input">
                to
                <input type="number" name="storage-to" id="storage_to" value="512" min="0" max="512" class="storage-input">
                GB

                <div class="slider">
                    <input type="range" value="0" min="0" max="512" class="storage-range" id="lower">
                    <input type="range" value="512" min="0" max="512" class="storage-range" id="upper">
                    <svg width="100%" height="24">
                        <line x1="4" y1="12" x2="296" y2="12" stroke="#444" stroke-width="12" stroke-dasharray="1, 28"></line>
                    </svg>
                </div>
            </div>
        </div>
                
        <!-- Operating System Filter -->
        <div class="filter" name="operating-system" id="osToggle">
            <button type="button" class="filter-options" onclick="toggleOSOptions()">Operating System<span id="osArrow">&#9660;</span></button>
            
            <div class="os-options" id="osOptions" style="display: flex; flex-direction: column; text-align: left; padding: 13px 12px;">
                <label><input type="checkbox" class="filter-options" name="os[]" value="windows"> Windows</label>
                <label><input type="checkbox" class="filter-options" name="os[]" value="mac"> Mac OS</label>
                <label><input type="checkbox" class="filter-options" name="os[]" value="chrome"> Google Chrome OS</label>
            </div>
        </div>

        <!-- Battery Filter -->
        <div class="filter" name="battery" id="batteryToggle">
            <button type="button" class="filter-options" onclick="toggleBatteryOptions()">Battery(Whr)<span id="batteryArrow">&#9660;</span></button>

            <div class="battery-options" id="batteryOptions" style="display: none; text-align: left; padding: 13px 12px;">
                <label><input type="checkbox" class="filter-options" name="battery[]" value="0-20"> 0-20</input></label>
                <label><input type="checkbox" class="filter-options" name="battery[]" value="21-40"> 21-40</input></label>
                <label><input type="checkbox" class="filter-options" name="battery[]" value="41-60"> 41-60</input></label>
                <label><input type="checkbox" class="filter-options" name="battery[]" value="61-80"> 61-80</input></label>
                <label><input type="checkbox" class="filter-options" name="battery[]" value="81-100"> 81-100</input></label>
            </div>
        </div>

        <!-- Laptop Type Filter -->
        <div class="filter" name="laptop-type" id="laptopTypeToggle">
            <button type="button" class="filter-options" onclick="toggleLaptopTypeOptions()">Laptop Type<span id="laptopTypeArrow">&#9660;</span></button>
            
            <div class="laptop-type-options" id="laptopTypeOptions" style="display: flex; flex-direction: column; text-align: left; padding: 13px 12px;">
                <label><input type="checkbox" class="filter-options" name="laptop-type[]" value="chromebook"> Chromebook</label>
                <label><input type="checkbox" class="filter-options" name="laptop-type[]" value="gaming-laptop"> Gaming Laptop</label>
                <label><input type="checkbox" class="filter-options" name="laptop-type[]" value="laptop-10-13"> Laptop 10-13</label>
                <label><input type="checkbox" class="filter-options" name="laptop-type[]" value="laptop-14-16"> Laptop 14-16</label>
                <label><input type="checkbox" class="filter-options" name="laptop-type[]" value="macbook-air"> MacBook Air</label>
                <label><input type="checkbox" class="filter-options" name="laptop-type[]" value="macbook-pro"> MacBook Pro</label>
                <label><input type="checkbox" class="filter-options" name="laptop-type[]" value="macbook"> MacBook</label>
                <label><input type="checkbox" class="filter-options" name="laptop-type[]" value="thinkpad"> ThinkPad</label>
                <label><input type="checkbox" class="filter-options" name="laptop-type[]" value="windows-laptop"> Windows Laptop</label>
            </div>
        </div>

        <!--filter-->
        <div class="filter" name="laptop-filter" id="filterToggle">
            <button type="button" class="filter-options" onclick="toggleFilterOptions()">Filter<span id="filterArrow">&#9660;</span></button>
            
            <div class="laptop-filter-options" id="filterOptions" style="display: flex; flex-direction: column; text-align: left; padding: 13px 12px;">
                <label><input type="checkbox" class="filter-options" name="laptop-filter[]" value="it"> Engineering and Computer Science</label>
                <label><input type="checkbox" class="filter-options" name="laptop-filter[]" value="art"> Design and Fine Arts</label>
                <label><input type="checkbox" class="filter-options" name="laptop-filter[]" value="business"> Business and Finance</label>
                <label><input type="checkbox" class="filter-options" name="laptop-filter[]" value="office"> Office</label>
                <label><input type="checkbox" class="filter-options" name="laptop-filter[]" value="office"> Education and Educational Technology</label>
            </div>
        </div>
    </form>
</div>

<!--content -->
<div class="content-container">
    <div class="center-content">
        <h1>Laptop Manufacturer Filter</h1>

        <div class="content">
            <form action="{{ route('laptopFilter.filter') }}" method="GET" id="laptopFilterForm">
            <div class="filter-container  col-sm-10 col-12">

                <div class="filter" name="price" id="priceToggle">
                    <button type="button" class="filter-options" onclick="togglePriceRange()">Price<span id="priceArrow">&#9660;</span></button>
                    
                    <div class="price-options" id="priceOptions" style="display: none; text-align: center; padding: 13px 12px; position: absolute; z-index: 5; background-color:ghostwhite;">
                        Rm
                        <input type="number" name="price_from" id="price_from" value="0" min="0" max="20000" class="price-input">
                        to
                        <input type="number" name="price_to" id="price_to" value="20000" min="0" max="20000" class="price-input">

                        <div class="slider">
                            <input type="range" min="0" max="20000" value="0" class="price-input-range" id="lower">
                            <input type="range" min="0" max="20000" value="20000" class="price-input-range" id="upper">
                            <svg width="100%" height="24">
                                <line x1="4" y1="12" x2="296" y2="12" stroke="#444" stroke-width="12" stroke-dasharray="1, 28"></line>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="filter" name="manufacturer" id="manufacturerToggle">
                    <button type="button" onclick="toggleManufacturerOptions()">Manufacturer<span id="manufacturerArrow">&#9660;</span></button>
                
                    <div class="manufacturer-options" id="manufacturerOptions" style="display: none; text-align: left; padding: 13px 12px; position: absolute; z-index: 5; background-color:ghostwhite;">
                        <div><label><input type="checkbox" class="filter-options" name="manufacturer[]" value="apple"> Apple</label></div>
                        <div><label><input type="checkbox" class="filter-options" name="manufacturer[]" value="asus"> Asus</label></div>
                        <div><label><input type="checkbox" class="filter-options" name="manufacturer[]" value="lenovo"> Lenovo</label></div>
                        <div><label><input type="checkbox" class="filter-options" name="manufacturer[]" value="microsoft"> Microsoft</label></div>
                        <div><label><input type="checkbox" class="filter-options" name="manufacturer[]" value="msi"> MSI</label></div>
                        <div><label><input type="checkbox" class="filter-options" name="manufacturer[]" value="acer"> Acer</label></div>
                        <div><label><input type="checkbox" class="filter-options" name="manufacturer[]" value="dell"> Dell</label></div>
                        <div><label><input type="checkbox" class="filter-options" name="manufacturer[]" value="hp"> HP</label></div>
                    </div>
                </div>
                
                <div class="filter" name="process_model" id="processModelToggle">
                    <button type="button" onclick="toggleProcessModelOptions()">Processor<span id="processModelArrow">&#9660;</span></button>

                    <div class="processModelOptions" id="processModelOptions" style="display: none; text-align: left; padding: 13px 12px; position: absolute; z-index: 5; background-color:ghostwhite;">
                        <div><label><input type="checkbox" class="filter-options" name="process_model[]" value="apple"> Apple</label></div>
                        <div><label><input type="checkbox" class="filter-options" name="process_model[]" value="amd"> AMD</label></div>
                        <div><label><input type="checkbox" class="filter-options" name="process_model[]" value="Intel"> Intel</label></div>
                        <div><label><input type="checkbox" class="filter-options" name="process_model[]" value="media_tek"> MediaTek</label></div>
                    </div>
                </div>

                <div class="filter" name="graphics" id="graphicsToggle">
                    <button type="button" onclick="toggleGraphicsOptions()">Graphics<span id="graphicsOptionsArrow">&#9660;</span></button>
                    
                    <div class="graphics-options" id="graphicsOptions" style="display: none; text-align: left; padding: 13px 11px; width: 180px; position: absolute; z-index: 5; background-color:ghostwhite;">
                        <div>
                            <label>
                                <input type="checkbox" class="filter-options" name="graphics_option[]" value="apple"> Apple
                            </label>
                        </div>

                        <div>
                            <label>
                                <input type="checkbox" class="filter-options" name="graphics_option[]" value="adreno"> Adreno
                            </label>
                        </div>

                        <div>
                            <label>
                                <input type="checkbox" class="filter-options" name="graphics_option[]" value="intel" onclick="toggleSubCategory(event)"> Intel
                            </label>
                        </div>
            
                        <div>
                            <label>
                                <input type="checkbox" class="filter-options" name="graphics_option[]" value="geforce"> GeForce </input>
                                <span class="arrow" onclick="toggleSubCategory(event)">&#9660;</span>
                            </label>
                            <div id="geforceSubCategory" class="sub-category" style="margin-left: 20px; display: none;">
                                <div><label><input type="checkbox" class="filter-options" name="graphics_option[]" value="geforce_gtx"> GeForce GTX</label></div>
                                <div><label><input type="checkbox" class="filter-options" name="graphics_option[]" value="geforce_rtx"> GeForce RTX</label></div>
                            </div>
                        </div>
                        
                        <!-- Quadro -->
                        <div>
                            <label>
                                <input type="checkbox" class="filter-options" name="graphics_option[]" value="quadro" onclick="toggleSubCategory(event)"> Quadro
                            </label>
                        </div>

                        <!-- Radeon -->
                        <div>
                            <label>
                                <input type="checkbox" class="filter-options" name="graphics_option[]" value="radeon" onclick="toggleSubCategory(event)"> Radeon
                            </label>
                        </div>
                    </div>
                </div>

                <button class="moreFilter" type="button" class="open-btn" onclick="openSidebar()">More filter</button>

            </div>
            </form>
        </div>
        
        <div id="results">
            <!-- Results will be displayed here -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var mainForm = $('#laptopFilterForm');
        var sidebarForm = $('#sidebarLaptopFilterForm'); 
        var debounceTimer;

    // 防抖函数，用于减少函数执行频率
    function debounce(func, delay) {
        return function() {
            var context = this;
            var args = arguments;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                func.apply(context, args);
            }, delay);
        };
    }

    // 更新内容的函数现在被防抖包装
    var debouncedUpdateContent = debounce(function() {
        updateContent();
    }, 500);
    
    // Prevent default form submission and use AJAX instead
    mainForm.on('change', function(e) {
        e.preventDefault();
        debouncedUpdateContent();
    });

    // Event handling for Price filter
    mainForm.find('.price-input, .price-input-range').on('input', function() {
        debouncedUpdateContent();
    });
    mainForm.find('.price-input2, .price-input-range2').on('input', function() {
        debouncedUpdateContent();
    });
    //sidebar
    sidebarForm.on('change', function(e) {
        e.preventDefault();
        debouncedUpdateContent();
    });
    // Event handling for Screen Size filterq
    sidebarForm.find('.screen-size, .screen-size-range').on('input', function() {
        debouncedUpdateContent();
    });

    sidebarForm.find('.memory, .memory-range').on('input', function() {
        debouncedUpdateContent();
    }); 

    sidebarForm.find('.storage, .storage-range').on('input', function() {
        debouncedUpdateContent();
    });

    sidebarForm.find('.battery, .battery-range').on('input', function() {
        debouncedUpdateContent();
    });

    updateContent();
});

//固定sidebar
window.addEventListener('scroll', function() {
    var sidebar = document.getElementById('mySidebar');
    var sidebarTop = sidebar.getBoundingClientRect().top;

    if (sidebarTop <= 85) { // 当侧边栏顶部距离视窗顶部小于或等于10px时
        sidebar.classList.add('fixed-sidebar');
    } else {
        sidebar.classList.remove('fixed-sidebar');
    }
});


    function displayResults(laptops) {
        var resultsContainer = $('#results');
        var html = '';
        var base_url = "{{ url('/') }}";
        
        if(laptops.length === 0) {
            html = '<p>No laptops found.</p>';
        } else {
            html = '<div class="laptop-list">';
            laptops.forEach(function(laptop) {
                html += `<div class="col-md-3 col-sm-3  col-6">
                            <div class="product-grid">
                            <div class="product-image">
                               <img src="images/${laptop.manufacturer}/${laptop.image}" onclick="event.preventDefault();">
                            </div>

                            <div class="product-content">
                                <h5 class="title"><a href="${base_url}/laptopDetails/${laptop.id}"> ${laptop.name} ${laptop.process_model}</a></h5>
                                <div class="memory">${laptop.screen_size} ${laptop.memory} ${laptop.storage}</div>
                                <h4 class="price">RM${laptop.price}</h4>
                            </div>
                            </div>
                        </div> `;
            });
            html += '</div>';
        }

        resultsContainer.html(html);
    }

    function updateContent(filterName, rangeInputFrom, rangeInputTo, numberInputFrom, numberInputTo) {
        var mainForm = $('#laptopFilterForm');
        var sidebarForm = $('#sidebarLaptopFilterForm'); // 假设侧边栏表单的ID是sidebarLaptopFilterForm

        var mainFormData = mainForm.serialize();
        var sidebarFormData = sidebarForm.serialize();
            
        var fromValue = $('#' + rangeInputFrom).val();
        var toValue = $('#' + rangeInputTo).val();
        var fromRangeValue = $('#' + numberInputFrom).val();
        var toRangeValue = $('#' + numberInputTo).val();

        var formData = mainFormData + '&' + sidebarFormData + '&' + filterName + '_from=' + fromValue + '&' + filterName + '_to=' + toValue + '&' + filterName + '_from_range=' + fromRangeValue + '&' + filterName + '_to_range=' + toRangeValue;

        $.ajax({
            type: 'GET',
            url: "{{ route('laptopFilter.filter') }}",
            data: formData,
            dataType: 'json',
            success: function (response) {
                displayResults(response.laptops);
            },
            error: function (error) {
                console.error('Error:', error);
                $('#results').html('<p>Error loading results.</p>');
            }
        });
    }


//open and close
    function togglePriceRange() {
        var priceOptions = document.getElementById('priceOptions');
        var priceArrow = document.getElementById('priceArrow');

        if (priceOptions.style.display === 'none' || priceOptions.style.display === '') {
            priceOptions.style.display = 'block';
            priceOptions.style.border = '1px solid #ccc';
            priceArrow.innerHTML = '&#9650;'; // 向上的箭头
        } else {
            priceOptions.style.display = 'none';
            priceOptions.style.border = 'none';
            priceArrow.innerHTML = '&#9660;'; // 向下的箭头
        }
    }
    
    function toggleManufacturerOptions() {
        var options = document.getElementById('manufacturerOptions');
        var arrow = document.getElementById('manufacturerArrow');

        if (options.style.display === 'none' || options.style.display === '') {
            options.style.display = 'block';
            options.style.border = '1px solid #ccc';
            arrow.innerHTML = '&#9650;'; // Change to up arrow
        } else {
            options.style.display = 'none';
            options.style.border = 'none';
            arrow.innerHTML = '&#9660;'; // Change to down arrow
        }
    }

    function toggleProcessModelOptions() {
        var processModelToggle = document.getElementById('processModelOptions');
        var processModelArrow = document.getElementById('processModelArrow');

        if (processModelToggle.style.display === 'none' || processModelToggle.style.display === '') {
            processModelToggle.style.display = 'block';
            processModelToggle.style.border = '1px solid #ccc';
            processModelArrow.innerHTML = '&#9650;';
        } else {
            processModelToggle.style.display = 'none';
            processModelToggle.style.border = 'none';
            processModelArrow.innerHTML = '&#9660;';
        }
        
    }

    function toggleGraphicsOptions() {
        var graphicsOptions = document.getElementById('graphicsOptions');
        var graphicsOptionsArrow = document.getElementById('graphicsOptionsArrow');

        if (graphicsOptions.style.display === 'none' || graphicsOptions.style.display === '') {
            graphicsOptions.style.display = 'block';
            graphicsOptions.style.border = '1px solid #ccc';
            graphicsOptionsArrow.innerHTML = '&#9650;';
        } else {
            graphicsOptions.style.display = 'none';
            graphicsOptions.style.border = 'none';
            graphicsOptionsArrow.innerHTML = '&#9660;';
        }
    }

    function toggleDisplayTechOptions() {
        var options = document.getElementById('displayTechOptions');
        var arrow = document.getElementById('displayTechArrow');

        toggleOptions(options, arrow);
    }

    function toggleScreenSizeOptions() {
        var options = document.getElementById('screenSizeOptions');
        var arrow = document.getElementById('screenSizeArrow');

        toggleOptions(options, arrow);
    }

    function toggleScreenResolutionOptions() {
        var options = document.getElementById('screenResolutionOptions');
        var arrow = document.getElementById('screenResolutionArrow');

        toggleOptions(options, arrow);
    }

    function toggleMemoryOptions() {
        var options = document.getElementById('memoryOptions');
        var arrow = document.getElementById('memoryArrow');

        toggleOptions(options, arrow);
    }

    function toggleStorageOptions() {
        var options = document.getElementById('storageOptions');
        var arrow = document.getElementById('storageArrow');

        toggleOptions(options, arrow);
    }

    function toggleOSOptions() {
        var options = document.getElementById('osOptions');
        var arrow = document.getElementById('osArrow');

        toggleOptions(options, arrow);
    }

    function toggleBatteryOptions() {
        var options = document.getElementById('batteryOptions');
        var arrow = document.getElementById('batteryArrow');

        toggleOptions(options, arrow);
    }

    function toggleLaptopTypeOptions() {
        var options = document.getElementById('laptopTypeOptions');
        var arrow = document.getElementById('laptopTypeArrow');

        toggleOptions(options, arrow);
    }

    function toggleFilterOptions() {
        var options = document.getElementById('filterOptions');
        var arrow = document.getElementById('filterArrow');

        toggleOptions(options, arrow);
    }

// Helper function to toggle options display
function toggleOptions(options, arrow) {
    if (options.style.display === 'none' || options.style.display === '') {
        options.style.display = 'flex';
        options.style.flexDirection = 'column';
        options.style.border = '1px solid #ccc';
        arrow.innerHTML = '&#9650;'; // Change to up arrow
    } else {
        options.style.display = 'none';
        options.style.border = 'none';
        arrow.innerHTML = '&#9660;'; // Change to down arrow
    }
}

// Graphics里的小选项
var isAppleChecked = false;
var isGeForceChecked = false;
var isQuadroChecked = false;
var isRadeonChecked = false;
var isIntelChecked = false; // 新增变量

function toggleSubCategory(event) {
    var targetElement = event.target;

    if (targetElement.type === 'checkbox') {
        if (targetElement.value === 'apple') {
            isAppleChecked = !isAppleChecked;
            toggleSubCategoryVisibility('appleSubCategory', isAppleChecked);
        } else if (targetElement.value === 'geforce') {
            isGeForceChecked = !isGeForceChecked;
            toggleSubCategoryVisibility('geforceSubCategory', isGeForceChecked);
        } else if (targetElement.value === 'quadro') {
            isQuadroChecked = !isQuadroChecked;
            toggleSubCategoryVisibility('quadroSubCategory', isQuadroChecked);
        } else if (targetElement.value === 'radeon') {
            isRadeonChecked = !isRadeonChecked;
            toggleSubCategoryVisibility('radeonSubCategory', isRadeonChecked);
        } else if (targetElement.value === 'intel') {
            isIntelChecked = !isIntelChecked;
            toggleSubCategoryVisibility('intelSubCategory', isIntelChecked);
        }
    } else if (targetElement.classList.contains('arrow')) {
        var subCategoryId = targetElement.previousElementSibling.value + 'SubCategory';
        toggleSubCategoryVisibility(subCategoryId);
    }
}

function toggleSubCategoryVisibility(subCategoryId, isChecked) {
    var subCategory = document.getElementById(subCategoryId);
    
    if ((isChecked !== undefined && isChecked) || subCategory.style.display === 'none' || subCategory.style.display === '') {
        subCategory.style.display = 'block';
    } else {
        subCategory.style.display = 'none';
    }
}

//select range
function setupRangeInputs(rangeSelector, numberSelector) {
    var rangeInputs = document.querySelectorAll(rangeSelector);
    var numberInputs = document.querySelectorAll(numberSelector);

    rangeInputs.forEach(function (el, index) {
        el.addEventListener("input", function () {
            var slide1 = parseFloat(rangeInputs[0].value);
            var slide2 = parseFloat(rangeInputs[1].value);

            if (!isNaN(slide1) && !isNaN(slide2)) {
                if (slide1 > slide2) {
                    [slide1, slide2] = [slide2, slide1];
                }

                numberInputs[0].value = slide1;
                numberInputs[1].value = slide2;
            }
        });
    });

    numberInputs.forEach(function (el, index) {
        el.addEventListener("input", function () {
            var number1 = parseFloat(numberInputs[0].value);
            var number2 = parseFloat(numberInputs[1].value);

            if (!isNaN(number1) && !isNaN(number2)) {
                if (number1 > number2) {
                    [number1, number2] = [number2, number1];
                }

                rangeInputs[0].value = number1;
                rangeInputs[1].value = number2;
            }
        });
    });
}

// Example usage for the price filter
setupRangeInputs(".price-input-range", ".price-input");
// Use the same function for other filters
setupRangeInputs(".filter-options-range", ".filter-options-input");

setupRangeInputs(".memory-range", ".memory-input");
setupRangeInputs(".storage-range", ".storage-input");


//open and close the sidebar
function openSidebar() {
    var sidebar = document.getElementById("mySidebar");
    if (window.innerWidth <= 768) {
        // 在小屏幕上设置为占据整个页面的宽度
        sidebar.style.width = "100%";
    } else {
        // 在其他设备上设置为 300px 宽度
        sidebar.style.width = "25%";
    }
    sidebar.style.paddingLeft = "35px";
    sidebar.style.paddingRight = "20px";
    sidebar.style.boxShadow = "0 0 10px rgba(0, 0, 0, 0.3)";
    sidebar.style.overflowY = "auto";
    sidebar.style.height = "100%";
}

function closeSidebar() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("mySidebar").style.paddingLeft = "0";
    document.getElementById("mySidebar").style.paddingRight = "0";
    document.getElementById("mySidebar").style.boxShadow = "none";
    document.getElementById("mySidebar").style.overflowY = "hidden";
    document.getElementsByClassName("content")[0].style.marginLeft = "0";
}

</script>

@endsection
