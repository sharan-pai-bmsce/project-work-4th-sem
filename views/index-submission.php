<?php

  require('include/header.php');
  $path = '/views/index-submission.php';
  $title = 'Submission Page';
?>
    <title>Submission Page</title>
    <link rel="stylesheet" href="../public/css/style-submission.css" />
  </head>
  <body style="background-color: #ddd">
    <?php
      require('include/navbar-user.php');
    ?>
      <div class="container pl-3 pr-3 pt-2" style="background-color: #eee">
      <div id="msg-div" class="mt-3"></div>
      <form id="submission-form">
        <h3 class="text-center author">Author's Information</h3>
        <hr />
        <br />
        <div class="form-row align-items-center">
          <div class="col-md-2">
            <label for="prefix" class="pl-2"
              >Prefix : <span class="text-danger">*</span></label
            >
            <select class="form-control" required id="prefix-input">
              <option value="Dr.">Dr.</option>
              <option value="Mr.">Mr.</option>
              <option value="Mrs.">Mrs.</option>
              <option value="Ms.">Ms.</option>
              <option value="Professor">Professor</option>
              <option value="Asst. Professor">Assistant Professor</option>
            </select>
          </div>
          <div class="col-md-5">
            <label for="first-name" class="pl-2"
              >First Name <span class="text-danger">*</span></label
            >
            <input
              type="text"
              class="form-control"
              id="first-name-input"
              placeholder="Enter your First Name"
              required
              maxlength="50"
              pattern="[A-Za-z]{1,}"
            />
          </div>
          <div class="col-md-5">
            <label for="last-name" class="pl-2"
              >Last Name <span class="text-danger">*</span></label
            >
            <input
              type="text"
              class="form-control"
              name="last-name"
              id="last-name-input"
              placeholder="Enter your Last Name"
              required
              pattern="[A-Za-z]{1,}"
              maxlength="50"
            />
          </div>
        </div>
        <div class="form-row align-items-center pt-3">
          <label for="conference-name" class="pl-2"
            >Conference Name <span class="text-danger">*</span></label
          >
          <input
            type="text"
            name="conference-name"
            id="conference-name-input"
            class="form-control"
            placeholder="Enter the Conference name"
            required
            pattern="[A-Z a-z]{4,}"
            maxlength="80"
          />
        </div>
        <div class="form-row align-items-center pt-3">
          <div class="col-md-4">
            <label for="Institution" class="pl-2"
              >Institution <span class="text-danger">*</span></label
            >
            <input
              type="text"
              name="Institution"
              id="institution-input"
              class="form-control"
              placeholder="Enter the institution"
              required
              pattern="[A-Z a-z]{3,}"
              maxlength="80"
            />
          </div>
          <div class="col-md-4">
            <label for="State" class="pl-2">State</label>
            <input
              type="text"
              name="State"
              id="state-input"
              class="form-control"
              placeholder="Enter the State"
            />
          </div>
          <div class="col-md-4">
            <label for="Nationality" class="pl-2"
              >Nationality : <span class="text-danger">*</span></label
            >
            <input
              type="text"
              name="Nationality"
              id="Nationality-input"
              class="form-control"
              placeholder="Enter the Nationality (Country)"
              required
              pattern="[A-Z a-z]{4,}"
              maxlength="80"
            />
          </div>
        </div>
        <div class="form-row align-items-center pt-3">
          <div class="col-md-6">
            <label for="E-mail" class="pl-2"
              >Author's Email Address <span class="text-danger">*</span></label
            >
            <input
              type="email"
              class="form-control"
              id="email-input"
              placeholder="Enter your email"
              required
              pattern="[a-z0-9.]+@[a-z0-9.-]+\.[a-z]{2,}"
              maxlength="80"
            />
          </div>
          <div class="col-md-6">
            <label for="Mobile-no" class="pl-2"
              >Mobile No. <span class="text-danger">*</span></label
            >
            <input
              type="text"
              pattern="[0-9]{10}"
              maxlength="10"
              minlength="10"
              name="State"
              id="mobile-input"
              class="form-control"
              placeholder="Enter the Mobile No."
            />
          </div>
        </div>
        <div class="form-row align-items-center pt-3">
          <div class="col-md-6">
            <label for="Address" class="pl-2"
              >Author's Address <span class="text-danger">*</span></label
            >
            <textarea
              class="form-control"
              name="address"
              id="address-input"
              required="max length exeeded"
              maxlength="100"
            ></textarea>
          </div>
          <div class="col-md-6">
            <label for="Co-authors" class="pl-2">Co-Authors (if any)</label>
            <textarea
              class="form-control"
              name="Co-authors"
              id="co-authors-input"
              placeholder="Enter the Co-author's name"
            ></textarea>
          </div>
        </div>
        <h3 class="text-center paper">Paper Information</h3>
        <hr />
        <br />
        <div class="form-row align-items-center">
          <label for="paper-title" class="pl-2"
            >Paper Title <span class="text-danger">*</span></label
          >
          <input
            type="text"
            name="paper-title"
            id="paper-title-input"
            class="form-control"
            required
            pattern="[A-Z a-z]{4,}"
            maxlength="80"
          />
        </div>
        <div class="form-row align-items-center pt-3">
          <label for="paper-abstract" class="pl-2"
            >Paper Abstract <span class="text-danger">*</span></label
          >
          <textarea
            name="paper-abstract"
            id="paper-abstract-input"
            class="form-control"
            style="min-height: 150px"
            required
            maxlength="100"
          ></textarea>
        </div>
        <div class="form-group pt-3">
          <label for="file-upload"
            >Paper Upload <span class="text-danger">*</span></label
          >
          <div class="custom-file">
            <input
              type="file"
              name="paper-upload"
              class="form-control-file"
              id="paper-upload-input"
              required
              accept=".pdf"
            />
          </div>
        </div>
        <div class="form-group pt-5">
          <h4 class="form-group">
            Terms and conditions <span class="text-danger">*</span>
          </h4>
          <div class="form-check">
            <input
              required
              type="checkbox"
              class="form-check-input mt-3"
              id="terms-condition"
            />
            <label for="terms-condition" class="pl-3 pr-3 form-check-label">
              I hereby agree with the <a href="#">terms and conditions</a>. I
              lay a copyright claim for the uploaded paper which will be
              presented in the conference. I pledge that this paper has been
              created by me and my team.
            </label>
          </div>
        </div>
        <div class="text-center col-md-12">
          <input type="submit" value="Submit" id="submit-btn" class="btn submit-btn btn-outline-dark">
        </div>
      </form>
      <div style="padding-bottom: 150px; margin-bottom: 50px;"></div>
    </div>
    <script src="main.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
