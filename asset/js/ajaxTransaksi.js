
var keywordTransaksi = document.getElementById('keyword-transaksi')
var tableContentTransaksi = document.getElementById('table-content-transaksi');
var searchButton = document.getElementById('tombol-cari');

keywordTransaksi.addEventListener('keyup', () => {
    
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            tableContentTransaksi.innerHTML = xhr.responseText
        }
    }

    xhr.open('GET', '../ajax/transaksi.php?keyword='+ keywordTransaksi.value, true);
    xhr.send();
        
})