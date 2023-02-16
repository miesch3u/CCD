let boutonRecherche = () =>{
    let val = document.querySelector('#filter').value
    let key = document.querySelector('#rechTxt').value
    let url = new URL(location.href)
    url.searchParams.set('cat',val );
    url.searchParams.set('key',key );
    location.href = url.toString()
}

window.onload = ()=>{
    try
    {
        document.querySelector('#rech').onclick = boutonRecherche
        document.querySelector('#filter').onchange = boutonRecherche
        let url = new URL(location.href)
        let id = url.searchParams.get('cat')
        document.querySelector('#filter').options[id].selected = true;
        console.log(id)
    }
    catch (e){
        console.log(e)
    }
}