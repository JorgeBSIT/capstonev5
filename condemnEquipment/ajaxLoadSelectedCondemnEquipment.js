function loadSelectedData() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("selected").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "condemnEquipment/toLoadSelectedCondemnEquipment.php", true);
    xhttp.send();
}