let reload = () => {
  let username = document.getElementById("email");
  let password = document.getElementById("password");
  password.value = "";
  username.value = "";
};

let error = (stat) => {
  if (stat === "admin") {
    loginCall(stat);
    let password = document.getElementById("password-admin");
    password.classList = `form-control is-invalid`;
    let username = document.getElementById("email-admin");
    password.value = "";
    username.value = "";
  }else if(stat === "user"){
    loginCall(stat);
    let password = document.getElementById("password-user");
    password.classList = `form-control is-invalid`;
    let username = document.getElementById("email-user");
    password.value = "";
    username.value = "";
  }else if(stat === "reviewer"){
    loginCall(stat);
    let password = document.getElementById("password-reviewer");
    password.classList = `form-control is-invalid`;
    let username = document.getElementById("email-reviewer");
    password.value = "";
    username.value = "";
  }
};

let errorEmailId = () => {
  let username = document.getElementById("email-for-change");
  let id = document.getElementById("unique-id");
  username.classList = "form-control is-invalid";
  id.classList = "form-control is-invalid";
  setTimeout(() => {
    username.innerHTML = "";
    username.classList = "form-control";
    id.innerHTML = "";
    id.classList = "form-control";
  }, 5000);
};

let errorPassword = () => {
  let password = document.getElementById("reenter-new-password");
  password.classList = "form-control is-invalid";
  setTimeout(() => {
    password.innerHTML = "";
    password.classList = "form-control";
  }, 2000);
};

let perfect = (stat) => {
  let username = document.getElementById("email-admin");
  let password = document.getElementById("password-admin");
  password.value = "";
  username.value = "";
};

let loginCall = (stat) => {
  document.querySelector("#login-home-div").style.display = "none";
  document.querySelector("#login-home-img").style.display = "none";
  document.querySelector("#back-symbol").style.display = "";
  if (stat == "admin") {
    document.querySelector("#admin-login-div").style.display = "";
    document.querySelector("#admin-login-img").style.display = "";
  } else if (stat == "reviewer") {
    document.querySelector("#reviewer-login-div").style.display = "";
    document.querySelector("#reviewer-login-img").style.display = "";
  } else if (stat == "user") {
    document.querySelector("#user-login-div").style.display = "";
    document.querySelector("#user-login-img").style.display = "";
  } else {
    document.querySelector("#user-login-div").style.display = "none";
    document.querySelector("#user-login-img").style.display = "none";
    document.querySelector("#reviewer-login-div").style.display = "none";
    document.querySelector("#reviewer-login-img").style.display = "none";
    document.querySelector("#admin-login-div").style.display = "none";
    document.querySelector("#admin-login-img").style.display = "none";
    document.querySelector("#login-home-div").style.display = "";
    document.querySelector("#login-home-img").style.display = "";
    document.querySelector("#back-symbol").style.display = "none";
  }
};

let userLogin = document.querySelector("#user-btn");
let reviewerLogin = document.querySelector("#reviewer-btn");
let adminLogin = document.querySelector("#admin-btn");
let back = document.querySelector("#back-symbol");

userLogin.addEventListener("click", (e) => {
  // console.log("Hello User");
  loginCall("user");
});

reviewerLogin.addEventListener("click", (e) => {
  loginCall("reviewer");
});

adminLogin.addEventListener("click", (e) => {
  loginCall("admin");
});

back.addEventListener("click", (e) => {
  loginCall("back");
});
