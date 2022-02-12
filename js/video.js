var video = document.getElementById('video');
let configure = {
    iceServers:[
        {
            url:"stun:stun1.l.google.com:19302"
        }
    ]
}

//tfjs model load
let model;

const peer = new RTCPeerConnection(configure);
var socket;
socket = io.connect("https://openpocter-socketio.herokuapp.com/")
video.muted = true;

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




navigator.mediaDevices.getUserMedia({
    video: true,
    audio: true
})
.then(stream=>{

    video.srcObject = stream
    peer.addStream(stream)
    peer.createOffer()
    .then(sdp=>peer.setLocalDescription(sdp))
    .then(()=>{
        console.log(peer.localDescription)
        var x = setInterval(()=>{
            if(peer.connectionState != 'connected'){
                socket.emit('offer', {
                    data: peer.localDescription,
                    user: getCookie("USER"),
                    tid: getCookie("tid")
                })
            }
        }, 1000);

    }).catch(err=>{
        console.log(err)
    })
    peer.onicecandidate = (event)=> {
		if (event.candidate) {
			socket.emit('candidate', event.candidate);
		}
    };
})

socket.on('answer', (msg)=>{
    console.log(msg)
    if(getCookie("USER")==msg.user&&getCookie("tid")==msg.tid){
        peer.setRemoteDescription(msg.data)
    }
})

socket.on('candidate', (candidate) => {
	peer.addIceCandidate(new RTCIceCandidate(candidate));
})

socket.on('reset_ice', ()=>{
    peer.restartIce()
})

socket.on('chat', (message)=>{
    console.log(message.tid, getCookie("tid"))
    if(getCookie("USER")==message.recv&&getCookie("tid")==message.tid){
        alert("New message from procter: "+message.message)
    }
})

socket.on('terminate', (message)=>{
    console.log(message)
    if(getCookie("USER")==message.username&&getCookie("tid")==message.tid){
        //distance = -1;
        document.getElementById("myForm").submit();
    }
})

socket.on('pause', (message)=>{
    console.log(message)
    console.log(getCookie("tid"))
    if(getCookie("USER")==message.username&&getCookie("tid")==message.tid){
        //distance = -1;
        var f_option = document.getElementsByName("f");
        f_option.forEach(disable)
        var g_option = document.getElementsByName("g");
        g_option.forEach(disable)
        var h_option = document.getElementsByName("h");
        h_option.forEach(disable)
        var i_option = document.getElementsByName("i");
        i_option.forEach(disable)
        var j_option = document.getElementsByName("j");
        j_option.forEach(disable)
        var s_button = document.getElementById("something")
        s_button.disabled = message.type
        isPause = message.type
        function disable(item, index){
            item.disabled = message.type;
        }
        alert("Your test is paused by proctor")
    }
    })

    function anti_cheat(){
        var num_time = 0;
        var check = setInterval(function(){
		var elem_fulscreen = document.fullscreenElement || document.webkitFullscreenElement || document.msFullscreenElement;
        if(getCookie("refresh")==1){
            var d = new Date()
            console.log("Cookie: ",getCookie("refresh"),"Date: ", d.getDate()+":"+(d.getMonth()+1)+":"+d.getFullYear(), "Time: ",d.getHours()+"/"+d.getMinutes()+"/"+d.getSeconds())
            socket.emit("logs", {
                username : getCookie("USER"),
                date: d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear(),
                time: d.getHours()+":"+d.getMinutes()+":"+d.getSeconds(),
                type: "<p style=\"color: black;\">refresh</p>",
                tid: getCookie("tid")
            })
        }
		if(window.onfocus==false){
            num_time+=1
            console.log(num_time)
        }
        if(window.onfocus==true){
            if(num_time!=0){
                var d = new Date()
                socket.emit("logs", {
                    username : getCookie("USER"),
                    date: d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear(),
                    time: d.getHours()+":"+d.getMinutes()+":"+d.getSeconds(),
                    type: "<p style=\"color: red;\">tabswitch: "+num_time+"</p>",
                    num_time:num_time,
                    tid:getCookie("tid")
                })
                num_time=0;
            }
        }
		if(elem_fulscreen==null){
			var d = new Date()
            document.getElementById("modal_op").showModal()  
            socket.emit("logs", {
                username : getCookie("USER"),
                date: d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear(),
                time: d.getHours()+":"+d.getMinutes()+":"+d.getSeconds(),
                type: "<p style=\"color: yellow;\">exit_fullscreen</p>",
                tid:getCookie("tid")
            }) 
        }
    },100)


}

function fullScreenExit(){
    document.documentElement.requestFullscreen(); 
    document.getElementById("modal_op").close();
}

const detectFaces = async()=> {
    const prediction = await model.estimateFaces(video, false);
    console.log(prediction.length);
    document.getElementById("num_faces").innerHTML = prediction.length;
    if(prediction.length>=1){
        document.getElementById("myForm").submit();
    }

  };


video.addEventListener("loadeddata", async () => {
    // wait for blazeface model to load
    model = await blazeface.load();
    video.play();
    // call the function
    setInterval(detectFaces,1000);
    setInterval(view_cookie,1000)
  });