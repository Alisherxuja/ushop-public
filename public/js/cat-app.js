function openCity(evt, cityName) {
    var i, das, cat;
    das = document.getElementsByClassName("das");
    for (i = 0; i < das.length; i++) {
        das[i].style.display = "none";
    }
    cat = document.getElementsByClassName("cat");
    for (i = 0; i < cat.length; i++) {
        cat[i].className = cat[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

