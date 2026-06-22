document.getElementById("pilihSemua").onclick = function(){

let item =
document.querySelectorAll(".pilih-item");

item.forEach(function(i){
    i.checked =
    document.getElementById("pilihSemua").checked;
});

}