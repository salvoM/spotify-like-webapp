const user = document.querySelector("#username");
user.addEventListener('blur', onBlur);
function onBlur(event){
    if(user.value !== "")   fetch("users/check/"+user.value).then(onResponse).then(final_result);
}
function onResponse(response){
    return response.text();
}
function final_result(testo){
    //Mostra o meno l'errore
    if(testo === "taken"){
        //username preso
        document.querySelector("#usernameError").classList.remove("d-none");
    }
    else{
        //username libero
        document.querySelector("#usernameError").classList.add("d-none");
    }
}