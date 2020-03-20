// SHOPPING CART TOGGLE
let cartTogg = document.getElementById('cart-toggle');
let cart = document.getElementById('cart');
let cartobj = {};

cartTogg.addEventListener('click',()=>{
    cart.classList.toggle('cart-toggled');
    document.getElementById('cartnot').style.display = 'none';
});

//Cart items

function plusHandler(e){
    e.nextElementSibling.textContent = parseInt(e.nextElementSibling.textContent) + 1;
}


function minusHandler(e){
    if (parseInt(e.nextElementSibling.nextElementSibling.textContent)>0) {
        e.nextElementSibling.nextElementSibling.textContent = parseInt(e.nextElementSibling.nextElementSibling.textContent) - 1;
    }
    if (parseInt(e.nextElementSibling.nextElementSibling.textContent)==0) {
        
        e.parentElement.remove();
        delete cartobj[e.previousSibling.data];
    }
}





document.querySelectorAll('.addcart').forEach(a =>{
    
    a.addEventListener('click',(e)=>{
        let li = document.createElement('li');
        li.classList.add('list-group-item');
        li.classList.add('d-flex');
        li.classList.add('justify-content-between');
        li.classList.add('align-items-center');
        let img = e.target.parentElement.parentElement.parentElement.childNodes[1].childNodes[0].attributes[1].value;
        let ttl = e.target.parentElement.parentElement.parentElement.childNodes[3].childNodes[1].childNodes[1].innerText;
        let prc = e.target.parentElement.parentElement.parentElement.childNodes[3].childNodes[1].childNodes[5].innerText;
        if (typeof(cartobj[ttl])=='undefined') {
            cartobj[ttl] = ttl;
            li.innerHTML = `
            <img width="50" src="${img}"/>${ttl}<box-icon onclick="minusHandler(this)" class="minus float-right" type='solid' name='minus-square'></box-icon><box-icon onclick="plusHandler(this)" class="plus float-right" name='plus-square' type='solid' ></box-icon><span id="nbI" class="badge badge-light badge-pill">1</span><p class="mt-3 float-right badge badge-light">x${prc}</p>`
            document.getElementById('cartnot').style.display = 'inline';
            document.getElementById('cartL').appendChild(li);
            iziToast.success({
                title: 'OK',
                message: `${ttl} a été ajouté au panier`,
                color: '#7C4DFF',
                messageColor: '#fff',
                titleColor: '#fff',
                iconColor: '#fff',
                theme: 'dark'
            });
        }else{
            iziToast.error({
                title: 'ERROR',
                message: `${ttl} déjà dans le panier`,
                color: '#7C4DFF',
                messageColor: '#fff',
                titleColor: '#fff',
                iconColor: '#fff',
                theme: 'dark'
            });
        }
    })
})

document.getElementById('cou').addEventListener('click',e=>{
    let jsonString = '{';
    for (let i = 1; i < e.target.parentElement.childNodes[5].childNodes.length; i++) {
        let name = e.target.parentElement.childNodes[5].childNodes[i].childNodes[2].textContent;
        let img = e.target.parentElement.childNodes[5].childNodes[i].childNodes[1].attributes[1].value;
        let qte = e.target.parentElement.childNodes[5].childNodes[i].childNodes[5].innerText;
        let price = ((e.target.parentElement.childNodes[5].childNodes[i].childNodes[6].innerText).substr(1,)).substr(0,((e.target.parentElement.childNodes[5].childNodes[i].childNodes[6].innerText).substr(1,)).length-2);
        
        jsonString+=`"item${i}":{"name":"${name}","img":"${img}","qte":"${qte}","price":"${price}"},`

        if (i==e.target.parentElement.childNodes[5].childNodes.length-1) {
            jsonString+=`"item${i}":{"name":"${name}","img":"${img}","qte":"${qte}","price":"${price}"}`
        }
    }
    jsonString+='}';

    window.location.href = `checkout.php?json=${encodeURI(jsonString)}`;
})

document.getElementById('lo').addEventListener('click',()=>{
    iziToast.success({
        title: 'OK',
        message: 'Deconnectee',
        color: '#7C4DFF',
        messageColor: '#fff',
        titleColor: '#fff',
        iconColor: '#fff',
        theme: 'dark'
    });
})