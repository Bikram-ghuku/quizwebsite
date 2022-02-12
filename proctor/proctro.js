var socket;
socket = io.connect("https://openpocter-socketio.herokuapp.com/")

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

socket.on('offer', recv)

function recv(message){
    var peer_recv = new RTCPeerConnection()
    var vid = document.getElementById(message.user);
    console.log(message)
    peer_recv.setRemoteDescription(message.data)
    .then(() => peer_recv.createAnswer())
    .then((sdp)=>peer_recv.setLocalDescription(sdp))
    .then(()=>{
        socket.emit('answer', {
          data: peer_recv.localDescription,
          user: message.user,
          tid: getCookie("tid")
        })
        console.log(peer_recv.localDescription)
    })
    peer_recv.onicecandidate = (event)=> {
		if (event.candidate) {
			socket.emit('candidate',event.candidate);
		}
	};

  peer_recv.onaddstream = (e) =>{
    vid.srcObject = e.stream
    console.log("Got stream", message.user, message.tid)
}

  socket.on('candidate', (candidate) => {
    peer_recv.addIceCandidate(new RTCIceCandidate(candidate))
    .catch(e => console.error(e));
  });

}

