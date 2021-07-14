let errorEmailId = () => {
  let username = document.getElementById("email-for-change");
  let id = document.getElementById("unique-id");
  let desgn = document.getElementById("designation");
  username.classList = "form-control is-invalid";
  id.classList = "form-control is-invalid";
  desgn.classList = "form-control is-invalid";
};

let errorPassword = () => {
  let password = document.getElementById("reenter-new-password");
  password.classList = "form-control is-invalid";
};
