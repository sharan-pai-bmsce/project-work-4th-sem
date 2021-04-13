class Store{
    static getUpdate(){
        let contact = [];
        if(localStorage.getItem('contact')===null){
            contact = [];
        }else{
            contact = JSON.parse(localStorage.getItem('contact'));
        }
        return contact;
    }
    static addUpdate(news1){
        let contact = Store.getUpdate();
        contact.push(news1);
        localStorage.setItem('contact',JSON.stringify(contact));
    }
    static removeAll(){
        localStorage.setItem('contact',JSON.stringify([]));
    }
}
Store.removeAll();
document.getElementById('contact-form').addEventListener('submit',(e)=>{
    e.preventDefault();
    let name = document.getElementById('name');
    let email = document.getElementById('email');
    let subject = document.getElementById('subject');
    let message = document.getElementById('message');

    if(name.value!==""&&email.value!==""&&subject.value!==""&&message.value!==""){
        let id = Store.getUpdate().length+1;
        let contact = {
            id:id,
            name:name.value,
            email:email.value,
            subject:subject.value,
            message:message.value
        };
        //console.log(contact);
        Store.addUpdate(contact);
        name.value = "";
        email.value = "";
        subject.value = "";
        message.value = "";
        let msg = document.getElementById('msg-div');
        msg.innerHTML = `Message has been sent. It will be handled within 2-3 days`;
        window.scrollTo(0,0);
        msg.classList = "alert alert-success text-center";
        setTimeout(()=>{
            msg.innerHTML = "";
            msg.classList = "";
        },5000);
    }else{
        let msg = document.getElementById('msg-div');
        msg.innerHTML = `Kindly enter message field to send`;
        window.scrollTo(0,0);
        msg.classList = "alert alert-danger text-center";
        setTimeout(()=>{
            msg.innerHTML = "";
            msg.classList = "";
        },5000);
    }
});