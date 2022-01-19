var districtObject = {
    "Galle": ["Akmeemana", "Ambalangoda", "Baddegama", "Benthota", "Elpitiya", "Galle-City", "Habaraduwa", "Hikkaduwa", "Neluwa", "Udugama", "Weligama"],
    "Matara": ["Akuressa", "Deniyaya", "Dickwella", "Hakmana", "Kamburupitiya", "Matara-City"],
    "Colombo": ["Avissawella", "Colombo Fort", "Dehiwala-Mt. Lavinia", "Homagama", "Kaduwela", "Maharagama", "Moratuwa", "Nugegoda", "Padukka", "Sri Jayawardanapura Kotte"]
}


window.onload = function() {

    var disSel = document.getElementById("district");
    var townSel = document.getElementById("close_town");
    for (var x in districtObject) {
        disSel.options[disSel.options.length] = new Option(x, x);
    }
    disSel.onchange = function() {

        townSel.length = 1;
        var y = districtObject[disSel.value];
        for (var i = 0; i < y.length; i++) {
            townSel.options[townSel.options.length] = new Option(y[i], y[i]);
        }
    }

    // -----------------
    var disSell = document.getElementById("dis");
    var townSell = document.getElementById("close");
    for (var x in districtObject) {
        disSell.options[disSell.options.length] = new Option(x, x);
    }
    disSell.onchange = function() {

        townSell.length = 1;
        var y = districtObject[disSell.value];
        for (var i = 0; i < y.length; i++) {
            townSell.options[townSell.options.length] = new Option(y[i], y[i]);
        }
    }
}