let i = 0;
for(btn of document.querySelectorAll("[data-delete]")){
    btn.addEventListener('click', deleteCollection);
    console.log(btn);
}
console.log(document.forms.length);
const form = document.forms['form_create'];
if(typeof form !== "undefined"){
    form.addEventListener('submit', newCollection);
}
const content = document.querySelector("#content-group .row");
console.log(content);
function newCollection(event){
    event.preventDefault();
    //Inserisci nel db
    if(form.playlist.value !== "") fetch("/collection", {method:'post', body: new FormData(form)}).then(onResponse).then(onText);
}

function onResponse(event){
    return event.text();   
}
function onText(text){
    console.log(text)
    content.appendChild(
        createCardCollection("/images/background6.jpg",
        form.playlist.value,
        text
        )
    );

}
function createCardCollection(url_img, title, id){
    const link = document.createElement("a");
    link.classList.add("btn");
    link.classList.add("btn-secondary");
    link.textContent = "Apri";
    link.href = "/collection/"+id;
    link.dataset.link = i;
    //
    const pText = document.createElement("p");
    pText.classList.add("card-text");
    pText.textContent = title;
    //
    const deleteButton = document.createElement("button");
    deleteButton.dataset.id = id;
    deleteButton.classList.add("btn");
    deleteButton.classList.add("btn-danger");
    deleteButton.classList.add("float-right");
    deleteButton.textContent = "Elimina";
    deleteButton.addEventListener('click', deleteCollection);
    //    
    const body = document.createElement("div");
    body.classList.add("card-body");
    body.appendChild(pText);
    body.appendChild(link);
    body.appendChild(deleteButton);
    //
    const img = document.createElement("img");
    img.classList.add("card-img-top");
    img.src = url_img;
    img.alt = "Card image cap";
    // style="width: auto; height: 300px"
    //
    const divCard = document.createElement("div");
    divCard.classList.add("card");
    divCard.classList.add("text-white");
    divCard.classList.add("bg-dark");
    divCard.classList.add("border-white");
    divCard.appendChild(img);
    divCard.appendChild(body);
    //
    const divWrapper = document.createElement("div");
    divWrapper.classList.add("col-sm-4");
    divWrapper.classList.add("my-2");
    divWrapper.appendChild(divCard);
    
    return divWrapper;
}
function deleteCollection(event){
    console.log("sono stato chiamato");
    console.log(event.currentTarget.dataset.id);
    let id_collection = event.currentTarget.dataset.id;
    fetch("/collection/"+id_collection, 
    {headers: {
        "X-CSRF-Token": $('input[name="_token"]').val()
    },
    method:"delete",
    }).then(onResponse).then(refresh);
    // fetch("/collection/"+id_collection+"/1",
    // {headers: {
    //     "X-CSRF-Token": $('input[name="_token"]').val()
    // },
    // method:"delete"
    // }).then(onResponse).then(refresh);
}
function refresh(text){
    if(text === "OK")   window.location.href = "/collection";
    console.log(text);
}
const firstForm = document.forms['firstPlaylist'];
if(typeof firstForm !=="undefined"){
    firstForm.addEventListener('submit', addPlaylist);
}
function addPlaylist(event){
    event.preventDefault();
    if(firstForm.playlist.value !== ""){
        fetch('/collection', {method :'post', body: new FormData(firstForm)});
        location.reload();
    }
}
