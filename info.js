function buttonClick(buttonName, userID, eventID){
    
    xhttpReq = new XMLHttpRequest();
    xhttpReq.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(buttonName).innerHTML = this.responseText;
        }
    };
    if(buttonName == "btnBook"){
        xhttpReq.open("POST", "bookEvent.php", true);
        xhttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttpReq.send("userID=" + userID +"&eventID=" + eventID);
    }
    else{
        xhttpReq.open("POST", "likeEvent.php", true);
        xhttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttpReq.send("userID=" + userID +"&eventID=" + eventID);
    }
    

}