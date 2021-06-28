/*class store{
  static getUpdates() {
    let news = [];
    if (localStorage.getItem("news") === null) {
      news = [];
    } else {
      news = JSON.parse(localStorage.getItem("news"));
    }
    return news;
  } 
  static removeElement(element) {
    let news = store.getUpdates();
    news.forEach((ele, index) => {
      if (ele.id === element.id) {
        news.splice(index, 1);
      }
    });
    localStorage.setItem("news", JSON.stringify(news));
  }
}
let removingUpdateOnDates = ()=>{
  let d1 = new Date();
  d1 = `${d1.getFullYear()}-${d1.getMonth()+1}-${d1.getDate()+9}`;
  let news = store.getUpdates();
  console.log(d1);
  news.forEach(element=>{
    //console.log(element);
    if(element.conferenceDate===d1){
      //console.log(element);
      store.removeElement(element);
    }
  })
}
removingUpdateOnDates();
let newsUpdate = store.getUpdates();
*/
announcement.forEach((ele, index) => {
  let section = document.createElement("div");
  section.className = `col-md-3 mb-3 announce`;
  section.dataset.selection = `${ele.conf_name}--${ele.topic_of_discussion}`;
  section.innerHTML = `<img src="${ele.image_url}" class="col-md-12 pb-1 announce-img" height="200px" >
    <h6 class="pt-1"  style="border-top: 1px solid #aaaaaa;">${ele.conf_name}--${ele.topic_of_discussion}</h6>`;
  section.style =
    "padding:0px; border: 1px solid #aaa; border-radius:10px; overflow:hidden; object-fit:cover;";
  $("#announce-container").append(section);
});

let news = document.querySelectorAll("[data-selection]");

console.log(announcement);
news.forEach((selected) => {
  selected.addEventListener("click", (e) => {
    e.preventDefault();
    let id = selected.dataset.selection;
    let a = announcement.find(
      (e) => `${e.conf_name}--${e.topic_of_discussion}` == id
    );
    //console.log(a);
    announceDisplayFunction(a);
  });
});

let announceDisplayFunction = (a) => {
  document.querySelector(
    "#announce-display"
  ).style = `height:400px; border: 1px solid black;`;
  document.querySelector("#announce-area").style = `height:400px;`;
  $("#img-area").html(
    `<img src="${a.image_url}" class="img-fluid" style="height:400px;">`
  );
  $("#announce-area").html(`
  <h3 class="pb-3 text-center" id="announce-title">${a.conf_name}</h3>
  <p><b>Topic of discussion:</b> ${a.topic_of_discussion}</p>
  <p><b>Last Date of Submission:</b> ${a.last_date_sub}</p>
<p><b>Date of conference:</b> ${a.date_of_conf}</p>
<p id="announce-summary"><b>Summary about topic:</b> ${a.summary}</p>
<p><b>Reviewer name:</b> ${a.name}</p>
<p><b>Publication Name:</b> ${a.publication_name} Publication</p>
<p><b>Organized by:</b> ${a.dept}</p>
`);
};

document.querySelector("#close-btn").addEventListener("click", (e) => {
  e.preventDefault();
  document.querySelector("#announce-display").style = `height:0px;`;
  document.querySelector("#announce-area").style = `height: 0px;`;
  $("#img-area").html(``);
  $("#announce-area").html(``);
});
