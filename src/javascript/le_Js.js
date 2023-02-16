let boutonRecherche = () =>{
    let val = document.querySelector('#filter').value
    let key = document.querySelector('#rechTxt').value
    let url = new URL(location.href)
    console.log(val)
    url.searchParams.set('cat',val );
    url.searchParams.set('key',key );
    location.href = url.toString()
}

window.onload = ()=>{
    document.querySelector('#rech').onclick = boutonRecherche
    document.querySelector('#filter').onchange = boutonRecherche
}