<html>
<head>
    <title> Form Dinamis </title>
</head>
<body>
<a href='#' onclick="tambah_form(); return false;" >Add</a>
<a href='#' onclick="kurangi_form(); return false;">Remove</a>
<form method="post" action="">
    <div id="formku">
        <tr><td><select></select></td></tr>
    </div>
<input type="submit" name="ok" value="Submit">
</form>
<script>
function tambah_form(){
    var target=document.getElementById("formku");
    var select=document.createElement("select");
    var option=document.createElement("option");

    target.appendChild(select);
    

    select.setAttribute('name','inputan[]');
}
function kurangi_form(){
    var target=document.getElementById("formku");
    var akhir=target.lastChild;
    target.removeChild(akhir);
}
 
</script>
</body>
</html>