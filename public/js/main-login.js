let reload = ()=>{
  let username = document.getElementById('email');
  let password = document.getElementById("password");
  password.value = '';
  username.value = '';
}

let reload1 = ()=>{
  let username = document.getElementById('email-for-change');
  let password = document.getElementById("new-password");
  let reenter = document.getElementById('reenter-new-password');
  let id = document.getElementById('unique-id');
  password.value = '';
  username.value = '';
  reenter.value = '';
  id.value = '';
}

let error = ()=>{
  let password = document.getElementById("password");
  password.classList = `form-control is-invalid`;
  let username = document.getElementById('email');
  password.value = '';
  username.value = '';
}

let errorEmailId=()=>{
  let username = document.getElementById('email-for-change');
  let id = document.getElementById('unique-id');
  username.classList='form-control is-invalid';
  id.classList = 'form-control is-invalid';
  setTimeout(() => {
    username.innerHTML = "";
    username.classList = "form-control";
    id.innerHTML = "";
    id.classList = "form-control";
  }, 5000);
}

let errorPassword = ()=>{
  let password = document.getElementById('reenter-new-password');
  password.classList = 'form-control is-invalid';
  setTimeout(() => {
    password.innerHTML = "";
    password.classList = "form-control";
  }, 2000);
}


let perfect = ()=>{
  let username = document.getElementById('email');
  let password = document.getElementById('password');
  password.value = '';
  username.value = '';
}
