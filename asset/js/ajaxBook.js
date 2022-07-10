var keywordBook = document.getElementById('keyword-book');
var keywordAnggota = document.getElementById('keyword-anggota')
var tableContentBook = document.getElementById('table-content-book');
var tableContentAnggota = document.getElementById('table-content-anggota');
var searchButton = document.getElementById('tombol-cari');

    keywordBook.addEventListener('keyup', () => {
    
        var xhr = new XMLHttpRequest();
    
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                tableContentBook.innerHTML = xhr.responseText
            }
        }
    
        xhr.open('GET', '../ajax/buku.php?keyword=' + keywordBook.value, true);
        xhr.send();
            
    });

