<?php
  require('include/header.php');
  $path = '/views/index-admin-home.php';
  $title = 'Admin Home';
?>
<link rel="stylesheet" href="../public/css/style-home-admin.css">
    <title>2020 ACADEMIC CONFERENCE</title>
  </head>

  <body style="background-color: white">
  <?php 
    require('include/navbar-admin.php');
  ?>
    <section class="background firstSection">
      <div class="box-main">
        <div class="firstHalf">
          <p class="text-big">2020 ACADEMIC CONFERENCE</p>
          <p class="text-small" style="text-align: justify">
            An efficient platform to share your ideas and widen your horizen.
            This is your step towards the future!
          </p>
        </div>
      </div>
    </section>
    <div class="container-1">
      <section class="section">
        <div class="paras">
          <p class="sectionTag text-big">Spark New Ideas</p>
          <p class="sectionSubTag text-small" style="text-align: justify">
            Conferences are a great way for employees to be inspired by fresh
            ideas, to start rethinking the status quo, and to hopefully leave
            ready to tackle business challenges in creative and innovative ways.
            Conferences also allow individuals to share their progress, hurdles
            they’ve come across, and techniques devised for solving them. After
            hearing from leading experts and visionaries on how they found
            success, attendees are inspired and encouraged to think outside the
            box, which leads to successful outcomes for the organization.
          </p>
        </div>
        <div class="thumbnail">
          <img
            src="https://source.unsplash.com/900x900/?coding,apple"
            alt="laptop image"
            class="imgFluid"
          />
        </div>
      </section>

      <section class="section section-left" id="about">
        <div class="paras">
          <p class="sectionTag text-big">Learning</p>
          <p class="sectionSubTag text-small" style="text-align: justify">
            Another advantage of conferences is that they provide a blended
            learning environment with multiple opportunities for individuals to
            learn and engage in a wide array of formats. Conferences typically
            provide special guest speakers, breakout sessions, one-on-one
            engagements, group outings, and events for social interaction. The
            learning facet of a conference can expose attendees to new ways of
            operating and can help them discover ways to be even more
            productive. Whichever way an individual learns best, there are
            multiple ways to learn something new and impactful.
          </p>
        </div>
        <div class="thumbnail">
          <img
            src="https://source.unsplash.com/900x900/?coding,apple,html"
            alt="laptop image"
            class="imgFluid"
          />
        </div>
      </section>
      <section class="section" id="services">
        <div class="paras">
          <p class="sectionTag text-big">Let's Grow Together</p>
          <p class="sectionSubTag text-small" style="text-align: justify">
            The role of a conference is to gather like-minded individuals from
            across the country or across the globe, to learn, discuss thoughts,
            network, share ideas, create new ideas, and to ignite motivation.
            The benefits of attending a conference are different for everyone.
          </p>
        </div>
        <div class="thumbnail">
          <img
            src="https://source.unsplash.com/900x900/?javascript,apple"
            alt="laptop image"
            class="imgFluid"
          />
        </div>
      </section>

      <section class="news container" id="news">
        <h1 class="text-center">News And Announcement</h1>
        <div id="msg-div"></div>
        <form id="form">
          <div class="form-group">
            <label for="heading" class="pl-1"><h5>Title:</h5></label>
            <input type="text" class="form-control" name="heading" id="name" />
          </div>
          <div class="form-group">
            <label for="heading" class="pl-1"
              ><h5>Last Date Of Submission:</h5></label
            >
            <input
              type="date"
              class="form-control"
              name="lastDateOfSubmission"
              id="lastDateOfSubmission"
            />
          </div>
          <div class="form-group">
            <label for="heading" class="pl-1"><h5>Conference Date:</h5></label>
            <input
              type="date"
              class="form-control"
              name="conferenceDate"
              id="conferenceDate"
            />
          </div>
          <div class="form-row">
            <label for="heading" class="pl-1"><h5>Summary:</h5></label>
            <textarea
              class="form-control"
              style="min-height: 150px"
              name="update"
              id="summary"
            ></textarea>
          </div>
          <div class="form-group">
            <label for="heading" class="pl-1"><h5>Link for image:</h5></label>
            <input
              type="text"
              class="form-control"
              name="imgLink"
              id="img-link"
            />
          </div>
          <div class="text-center">
            <input
              type="submit"
              class="btn btn-dark"
              style="margin: auto; width: 50%"
              id="submit"
              value="submit"
            />
          </div>
        </form>
      </section>
      <div class="container">
        <table
          id="announcements-list"
          style="
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial,
              sans-serif;
          "
          class="table"
        >
          <thead class="text-center">
            <th><h5>ID</h5></th>
            <th><h5>Title</h5></th>
            <th><h5>Last Date of Submission</h5></th>
            <th><h5>Conference Date</h5></th>
            <th><h5>Edit</h5></th>
            <th><h5>Cancel</h5></th>
          </thead>

          <tbody
            class="text-center"
            style="font-size: large"
            id="book-list"
          ></tbody>
        </table>
      </div>
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" id ="modal-edit" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                Editing/Deletion of Event
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="msg"></div>
            <div class="modal-body">
              <form action="">
                <div>
                  <span>Id:</span>
                  <input
                    type="number"
                    id="id-edit"
                    class="form-control"
                    disabled
                  />
                </div>
                <div class="mt-3">
                  <span>Conference Name:</span>
                  <input
                    type="text"
                    id="name-edit"
                    class="form-control"
                    disabled
                  />
                </div>
                <div class="mt-3">
                  <span>Last Date Of Submission:</span>
                  <input type="date" id="sub-date-edit" class="form-control" />
                </div>
                <div class="mt-3">
                  <span>Conference Date:</span>
                  <input type="date" id="conf-date-edit" class="form-control" />
                </div>
                <div class="mt-3">
                  <span>Summary:</span>
                  <textarea
                    name=""
                    id="summary-edit"
                    class="form-control"
                  ></textarea>
                </div>
                <div class="mt-3">
                  <span>Image Link:</span>
                  <input type="text" id="img-link-edit" class="form-control" />
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="save-changes">
                Save changes
              </button>
            </div>
          </div>
        </div>
      </div>
      <div style="margin-bottom: 400px"></div>
      <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"
      ></script>
      <script src="main-form.js"></script>
      <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"
      ></script>
    </div>
  </body>
</html>
