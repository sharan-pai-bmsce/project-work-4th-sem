let error = ()=>{
  let msg = document.getElementById("login-description");
  msg.innerHTML = `<h6>User-Name and Password don't match.</h6>`;
  msg.classList = `col-md-10 mb-2 alert alert-danger`;
  setTimeout(() => {
    msg.innerHTML = "";
    msg.classList = "";
  }, 5000);
  let username = document.getElementById('email');
  let password = document.getElementById('password');
  password.value = '';
  username.value = '';
  console.log("");
}

let perfect = ()=>{
  let username = document.getElementById('email');
  let password = document.getElementById('password');
  password.value = '';
  username.value = '';
}
