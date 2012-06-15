$(document).ready(function() {
    var params = { allowScriptAccess: "always" };
    var atts = { id: "myytplayer" };
    swfobject.embedSWF("http://www.youtube.com/apiplayer?enablejsapi=1&version=3&playerapiid=ytplayer",
                       "myytplayer", "425", "356", "8", null, null, params, atts);
});

function onYouTubePlayerReady(playerId) {
    ytplayer = document.getElementById("myytplayer");
    ytplayer.addEventListener("onStateChange", "onytplayerStateChange");
    ytplayer.addEventListener("onError", "onPlayerError");
    ytplayer.cueVideoById("CpE_2j-bZDw");
}

function onytplayerStateChange(newState) {
    console.log("Player's new state: " + newState);
    if(newState == 3 || newState == 5) {
        updateCurrent();
    }
}
 
function onPlayerError(error) {
    console.log("Error occured: " + error);
}