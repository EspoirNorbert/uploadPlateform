//traiter le formulaire en ajax avec fetch
document.querySelector('#formUpload').addEventListener('submit' ,function (e) { 

  //remove all create span
  e.preventDefault();
  //get form
  const form = e.target;
  let spanRemove = form.querySelectorAll('span');

   if (spanRemove.length != 0){
     //get parent
      for (const iterator of spanRemove) {
          console.log(iterator.parentNode.removeChild(iterator));
      }

    }
    //get form data and check this
    const username = form.querySelector('#username')
    const foldername = form.querySelector('#foldername')
    const folder = form.querySelector('#folder').files[0];
     
    console.log(folder);
    /* console.log(username.value, ' ' , foldername.value,' ', folder); */
    //check field input values
    if(username.value == '' || foldername.value=='' || folder == undefined){
      //create span to display into input
      let span = `<span class='text-danger'>All field is required</span>`;
      //insert after input
      form.querySelector('small').insertAdjacentHTML('afterend', span)
      return ; //block script
    } 
    else {
      //is not empty
      //check every field
      let _validityName = validity_name(username, 'username')
      let _validityFolder = validity_name(foldername, 'foldername')
   
      if (_validityFolder != '') {
        //display message
        //create span to display into input
        let span = `<span class='text-danger'>${_validityFolder}</span>`;
        //insert after input
        form.querySelector('#foldername').insertAdjacentHTML('afterend', span) 
        //return ;
      }
      
      if (_validityName != '') {
        //display message
        //create span to display into input
        let span = `<span class='text-danger'>${_validityName}</span>`;
        //insert after input
        form.querySelector('#username').insertAdjacentHTML('afterend', span) 
        //return ;
      }
      else if (_validityName == '' && _validityFolder == ''){
      //add data to data     
      const data = new FormData(form);
    
      upload_folder_to_server(data)
      }
  }
 });

function upload_folder_to_server(data) {
  //get button
  const button = form.querySelector('button');
  //disabled button
  button.disabled  = true;
  let span = ` <span class="spinner-border spinner-border-sm"></span>Sending..`;
  //insert after input
  button.innerHTML =span; 
 
  fetch('upload' , {
    method: 'post',
     body: data
   })
   .then(response =>  response.json())
   .then(data => {
     button.disabled  = false;
     button.innerHTML = 'Publish your folder'

     if(data.status == 'success'){
       alert(data.message);
       window.location.href = 'folder'
     }
      else if (data.status == 'failed'){
      const erros = data.errors;
      //foreach table
      for (const iterator of erros) {
           //foreach each key creat fild
           let username = iterator.username;
           let foldername = iterator.foldername;
           let folder = iterator.folder
           
           if(username != undefined){
             console.log('username undefined');
           } 
           if(foldername != undefined){
             let span = `<span class='text-danger'>${foldername}</span>`;
             //insert after input
             form.querySelector('#foldername').insertAdjacentHTML('afterend', span)
           }
           if(folder != undefined){
             let span = `<span class='text-danger'>${folder}</span>`;
             //insert after input
             form.querySelector('#folder').insertAdjacentHTML('afterend', span) 
           }
      }
     }
   })
   .catch( (error)   => {
      console.log(JSON.stringify(error));
    })
  
}  

function validity_name (input, param) {
  //write a regex Rule
  const regexRule = new RegExp('^[\s ,a-zA-Zéçè]+$')
  //split username 
  const tab = input.value.split(' ');
  if (param == 'username'){
    if (tab.length == 1 && tab[0].length >=1 ){
        return 'Write your fullname your name is incomplete !'
    }
  }
  if(param == 'username' || param == 'foldername') {
      //apply regex rule
      if (!regexRule.test(input.value)){
       return 'Only Alphabet character and space is authorised';       
     }
  }
  return ''
}
