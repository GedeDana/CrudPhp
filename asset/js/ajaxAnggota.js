
var keywordAnggota = document.getElementById('keyword-anggota')
var tableContentAnggota = document.getElementById('table-content-anggota');
var searchButton = document.getElementById('tombol-cari');

keywordAnggota.addEventListener('keyup', () => {
    
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            tableContentAnggota.innerHTML = xhr.responseText
        }
    }

    xhr.open('GET', '../ajax/anggota.php?keyword='+ keywordAnggota.value, true);
    xhr.send();
        
})