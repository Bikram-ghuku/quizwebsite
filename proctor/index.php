<!DOCTYPE HTML>


<?php
include('../mysqli_connect.php');
$tid=mysqli_real_escape_string($db,$_GET["tid"]);


$NAME=$_COOKIE["USER"];
echo"<html>
<head>\n\n";
echo"";
echo"<title>PROCTOR PORTAL</title>
<script src=\"https://cdn.socket.io/4.2.0/socket.io.min.js\" integrity=\"sha384-PiBR5S00EtOj2Lto9Uu81cmoyZqR57XcOna1oAuVuIEjzj0wpqDVfD0JA9eXlRsj\" crossorigin=\"anonymous\"></script>

<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<link rel=\"stylesheet\" href=\"../css/proctor.css\">
<link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF\" crossorigin=\"anonymous\">
</head>";
echo"<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ\" crossorigin=\"anonymous\"></script>";
$query="SELECT USERNAME FROM login WHERE ADMINNAME='$NAME'";
echo"";
$qu=mysqli_query($db,$query);
setcookie("tid", $tid);
//check if test exists
$query2="SELECT * FROM questions2 WHERE CNAME='$NAME' AND Tid='$tid'";
$qu2=mysqli_query($db,$query2);
$qu2=mysqli_fetch_array($qu2);

if($qu2["Tid"]!=null){
    echo"<body>
    <div class=\"stu_proc_box\">";
    while($q1=mysqli_fetch_array($qu)){
        
        echo"<div class=\"card\" style=\"width: 18rem;\">";
        echo"<label for=\"username\">".$q1["USERNAME"]."</label>";
        echo"<label for=\"timer\" id=\"".$q1["USERNAME"]."_timer_data\"></label>";
        echo"<video id=\"".$q1["USERNAME"]."\" class=\"student-video\" autoplay controls></video>";
        
        echo"<div class=\"button-group\">";
        echo"<button class=\"btn btn-primary\" onClick=\"open_chat('".$q1["USERNAME"]."')\" title=\"Chat With ".$q1["USERNAME"]."\">💬</button> ";
        echo" <button class=\"btn btn-danger\" onClick=\"terminate('".$q1["USERNAME"]."')\" title=\"Terminate test for ".$q1["USERNAME"]."\">❌</button> ";
        echo" <button class=\"btn btn-success\" title=\"Connect Voice With ".$q1["USERNAME"]."\">🔊</button>";
        echo" <input type=\"button\" class=\"btn btn-warning\" id=\"pr_btn_".$q1["USERNAME"]."\" onClick=\"pause('".$q1["USERNAME"]."')\" title=\"Pause and save test for ".$q1["USERNAME"]."\" value=\"⏸️\">";
        echo" <button class=\"btn btn-info\" onClick=\"viewLogs('".$q1["USERNAME"]."')\" title=\"View logs for ".$q1["USERNAME"]."\">📖</button> ";
        echo"</div>";
        echo"</div>";
        echo"<dialog id=\"".$q1["USERNAME"]."_dialogue\">
            <table id=\"".$q1["USERNAME"]."_logs\" class=\"table table-hover\">
                <th>Time</th><th>Type</th>
            </table>
            <menu>
                <button class=\"btn btn-danger\" onClick=\"closeDialog('".$q1["USERNAME"]."')\">Close</button>
            </menu>
        </dialog>";
    }
    echo"</div>
    <div class=\"chatbox\" id=\"myForm\" >
    <li>
    <form id=\"chat_form\" class=\"form_chat\">
        <input type=\"hidden\" id=\"username\">
        <input id=\"msg\" type=\"text\" class=\"chat_send_box\" placeholer=\"type message to send\"><br>
        <div class=\"btn_grp\">
        <input type=\"submit\" class=\"btn btn-primary btn-smol\" value=\"send\"><br>
        <button type=\"button\" class=\"btn btn-danger btn-smol\" onclick=\"closeForm()\">Close</button><br>
        </div>
    </form>
    </div>
    </body>";
}else{
    echo"TEST NOT FOUND";
}
?>
<script src="./proctro.js"></script>

<script>
    const chat_form = document.getElementById("chat_form");

    function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }   
    return "";
    }
    
    
    function open_chat(username){
        document.getElementById("myForm").style.display = "block";
        document.getElementById("username").value = username;
    }

    function closeForm(){
        document.getElementById("myForm").style.display = "none";
    }

    function terminate(username){
        var tid = '<?php echo $tid ?>';
        if(confirm("Do you want to terminate "+username+"'s test?") == true){
            socket.emit("terminate", {
                username: username,
                tid:tid
            })
            console.log(username)
        }
    }

    function pause(username){
        var tid = '<?php echo $tid ?>';
        console.log(tid)
        var pr_btn = document.getElementById("pr_btn_"+username).value;
        var type = (pr_btn == '⏸️')? true: false
        var data = type?"pause":"resume"
        if(confirm("Do you want to "+data+" "+username+"'s test?") == true){
            socket.emit("pause", {
                username: username,
                type: type,
                tid : tid
            })
            document.getElementById("pr_btn_"+username).value = type? "▶️":"⏸️"
            console.log(username)
            console.log(pr_btn+"type: "+type)
        }
    }

    chat_form.addEventListener('submit', (e)=>{
        e.preventDefault()
        var tid = '<?php echo $tid ?>';
        const msg = e.target.elements.msg.value;
        const user = e.target.elements.username.value;
        console.log('<?php echo $tid ?>')
        if(msg){
            socket.emit('chat', {
                recv: user,
                message: msg,
                tid: tid,
                from: getCookie("USER")
            })
            e.target.elements.msg.value = ""
        }else{
            alert("Message cannot be empty")
        }
    })

    function viewLogs(username){
        document.getElementById(username+"_dialogue").showModal()
    }

    function closeDialog(username){
        document.getElementById(username+"_dialogue").close()
    }

    socket.on("logs", (data)=>{
        console.log(data)
        if(getCookie("tid")==data.tid){
            console.log(data.username)
            var table_logs = document.getElementById(data.username+"_logs");
            var new_row = table_logs.insertRow(-1);
            var time_cell = new_row.insertCell(0);
            var data_cell = new_row.insertCell(-1);
            time_cell.innerHTML = data.time
            data_cell.innerHTML = data.type
        }
    });


    socket.on('timer_data', (message)=>{
        document.getElementById(message.username+"_timer_data").innerHTML = message.time
    })
</script>
</html>
