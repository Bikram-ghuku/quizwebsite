var data = document.getElementsByName("tid");

function check(){
    console.log("pressed");
    if(data.length<=0){
        alert("TestId cnnot be empty");
    }
}