let i = 0;
let elems = [];
let collections;
const form = document.forms['form'];
form.addEventListener('submit', displayResults);
document.querySelector("#addToPlaylist").addEventListener('click', addToPlaylist);
// fetch('/get_collections').then(onResponse).then(fillOptions);  // C'è bisogno?
function displayResults(event){
    event.preventDefault();
    if(form.searchtag.value.length > 0) fetch("/do_search", {method: 'post', body: new FormData(form)}).then(onResponse).then(onJson);
}
function onResponse(event){
    return event.json();
}

function onJson(json){
    const res = JSON.parse(json);
    const wrapper = document.querySelector("#content-group");
    wrapper.innerHTML="";
    i = 0;
    for(track of res.tracks.items){
        elems.push(track);
        wrapper.appendChild(createCard(
            track.album.images[0].url,
            track.name,
            track.album.name,
            track.artists[0].name,
            track.uri
        ));
    }

}

function createCard(url_img, title, albumName, artists, uri){
    const cardHeader = document.createElement("div");
    cardHeader.classList.add("card-header");
    cardHeader.textContent = formatString(title, 24);

    //
    const artistUl = document.createElement("ul");
    artistUl.classList.add("list-group");
    artistUl.classList.add("list-group-flush");
    // artistUl.classList.add("d-none");

    //MORE BUTTON
    const more_btn = document.createElement('button');
    more_btn.textContent = "Show details";
    more_btn.classList.add('btn-secondary');
    more_btn.classList.add('btn');
    more_btn.classList.add('btn-sm');

    more_btn.dataset.target = i; //Un id univoco (?)
    more_btn.addEventListener('click', viewMore);
   
    //Save button
    const save_btn = document.createElement('button');
    save_btn.textContent = "Add to collection";
    save_btn.classList.add('btn-secondary');
    save_btn.classList.add('btn');
    save_btn.classList.add('btn-sm');
    save_btn.classList.add('float-right');
    save_btn.addEventListener('click', displayModal);
    
    //
    const buttons = document.createElement("div");
    buttons.classList.add("card-body");
    buttons.classList.add("p-1");
    buttons.appendChild(more_btn);
    buttons.appendChild(save_btn);

    
    
    //Div che contiene le informazioni aggiuntive
    const divDetails = document.createElement("div");
    divDetails.classList.add("collapse");
    divDetails.id = i;
    // Nome artista
    const artistText = document.createElement("li");
    artistText.classList.add("list-group-item");
    artistText.classList.add("bg-dark");    
    artistText.textContent = "Artista: " +artists;
    artistUl.appendChild(artistText);
    // Nome Album
    const albumText = document.createElement("li");
    albumText.classList.add("list-group-item");
    albumText.classList.add("bg-dark");
    albumText.textContent = "Album: " + formatString(albumName, 24);
    artistUl.appendChild(albumText);

    //Titolo completo
    const titleBig = document.createElement("li");
    titleBig.classList.add("font-weight-light");
    titleBig.classList.add("list-group-item");
    titleBig.classList.add("bg-dark");
    titleBig.dataset.bigtitle="1"; //Serve per capire qual è il titolo intero quando costruisco la modale
    titleBig.textContent = "Titolo completo: "+ title;
    artistUl.appendChild(titleBig);

    //
    const cardBody = document.createElement("div");
    divDetails.appendChild(artistUl);

    //
    const img = document.createElement("img");
    img.classList.add("card-img-top");
    img.src = url_img;
    img.dataset.uri = uri;
    //da settare i valori
    const card = document.createElement("div");
    card.classList.add("card");
    // card.classList.add("col-sm-3"); 
    card.classList.add("m-2");
    card.classList.add("p-0"); 
    card.classList.add("text-white"); 
    card.classList.add("bg-dark");
    card.classList.add("border-white");
      
    //append figli
    card.appendChild(img);
    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    card.appendChild(divDetails);
    card.appendChild(buttons);
    card.dataset.id = i;
    
    i = i + 1;
    return card;
    //devo settare i dataset
}

function formatString(string, len){
    if(string.length > len) return string.substring(0,len) + "[...]";
    else    return string;
}
function viewMore(event){
  let id = event.currentTarget.dataset.target;
  console.log(id);

  $("#"+id).collapse('toggle');
  // document.querySelector("#"+id).collapse('toggle');
}
function fillOptions(json){
  const select = document.querySelector("#selectBar");
  for(collection of json){
    const option = document.createElement("option");
    option.value = collection.id;
    option.textContent = collection.titolo;
    select.appendChild(option);
  }
}

function displayModal(event){
  //Costruisco la modale e poi ogni volta che viene chiamata la riempio
  console.log(elems);
  console.log(event.currentTarget.parentNode.parentNode);
  const divCard = event.currentTarget.parentNode.parentNode;
  const img_selected = divCard.querySelector("img").src;
  const bigTitle = divCard.querySelector("[data-bigtitle='1']").textContent;
  document.querySelector("#modalTitle").textContent = bigTitle;
  document.querySelector("#modalTitle").dataset.id = divCard.dataset.id;
  document.querySelector("#modalImg").src = img_selected;
  
  $('#modalAdd').modal('show');
}

function addToPlaylist(event){
  event.preventDefault();
  const index = document.querySelector("#modalTitle").dataset.id;
  const addForm = document.forms['addCollection'];
  if(addForm.collection === 'none'){
    alert("Non hai selezionato nessuna raccolta!");
  }
  else{
    console.log(addForm);
    formData = new FormData(addForm);
    formData.append('title', elems[index].name);
    formData.append('artist', elems[index].artists[0].name);
    formData.append('image_url', elems[index].album.images[0].url);
    formData.append('album_name', elems[index].album.name);
    formData.append('spotify_uri', elems[index].uri);
    console.log(formData);
    // fetch('/track', {method:'post', body: formData});
    fetch('/track', {method:'post', body: formData}).then(function(){
      alert("Canzone inserita!");
      $('#modalAdd').modal('hide');
    });
  }
}