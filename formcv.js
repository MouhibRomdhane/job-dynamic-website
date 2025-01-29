let formulaire = document.getElementById('form1');
formulaire.addEventListener('submit',function(e){
  
    let name=document.getElementById("nompren");
  
    let mail = document.getElementById("adrmail");

    let regExNom=/^[a-zA-Z\s]+$/;
    let regExEmail= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
   
    
    // controle du nom
   if(regExNom.test(name.value)==false){
    let myError=document.getElementById('erreurnompren');
    myError.style.color='red';
		myError.innerHTML="Le champ nom doit être composé de lettres ou d'espaces";
		e.preventDefault();
    }
    

   

    //controle de l'email
   
      if(regExEmail.test(mail.value)==false){
        let myError=document.getElementById('erreuremail');
        myError.style.color='red';
		myError.innerHTML="L'adresse email n'est pas valide";
		e.preventDefault();
      }
 
 //controle checkbox competance
 let listeCHK = document.getElementsByName('competance[]');
 let listecomp = "";
for (let i = 0; i < listeCHK.length; i++) {
if (listeCHK[i].checked)
listecomp += listeCHK[i].value + ' ';
}


  if (listecomp.trim()=='')
    {	let myError=document.getElementById('erreurcompet');
    myError.style.color='red';
		myError.innerHTML='Veuillez cocher au moins une compétence';
		e.preventDefault();
    }
//control etat civil radio box
let listeR = document.form1.etatvivil;
let etatCivil="";
for (let i = 0; i < listeR.length; i++) {
if (listeR[i].checked)
etatCivil = listeR[i].value;
}
if (listeR.trim()=='')
{	let myError=document.getElementById('erreurcivil');
myError.style.color='red';
    myError.innerHTML='Veuillez choisir votre etat civile';
    e.preventDefault();
}



})
let formulaire2 = document.getElementById('form1');
formulaire.addEventListener('submit',function(e){
  
    let name=document.getElementById("nompren");
  
    let mail = document.getElementById("adrmail");

    let regExNom=/^[a-zA-Z\s]+$/;
    let regExEmail= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
   
    
    // controle du nom
   if(regExNom.test(name.value)==false){
    let myError=document.getElementById('erreurnompren');
    myError.style.color='red';
		myError.innerHTML="Le champ nom doit être composé de lettres ou d'espaces";
		e.preventDefault();
    }
    

   

    //controle de l'email
   
      if(regExEmail.test(mail.value)==false){
        let myError=document.getElementById('erreuremail');
        myError.style.color='red';
		myError.innerHTML="L'adresse email n'est pas valide";
		e.preventDefault();
      }
 
 //controle checkbox competance
 let listeCHK = document.getElementsByName('competance[]');
 let listecomp = "";
for (let i = 0; i < listeCHK.length; i++) {
if (listeCHK[i].checked)
listecomp += listeCHK[i].value + ' ';
}


  if (listecomp.trim()=='')
    {	let myError=document.getElementById('erreurcompet');
    myError.style.color='red';
		myError.innerHTML='Veuillez cocher au moins une compétence';
		e.preventDefault();
    }
//control etat civil radio box
let listeR = document.form1.etatvivil;
let etatCivil="";
for (let i = 0; i < listeR.length; i++) {
if (listeR[i].checked)
etatCivil = listeR[i].value;
}
if (listeR.trim()=='')
{	let myError=document.getElementById('erreurcivil');
myError.style.color='red';
    myError.innerHTML='Veuillez choisir votre etat civile';
    e.preventDefault();
}



})