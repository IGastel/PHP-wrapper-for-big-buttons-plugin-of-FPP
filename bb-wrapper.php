<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden;
        background: black;
    }

    #unlockOverlay {
        position: fixed;
        top: 0; left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0,0,0,0.65);
        color: white;
        font-size: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        pointer-events: auto;
        transition: opacity 150ms linear;
        opacity: 1;
        user-select: none;
        -webkit-user-select: none;
    }

    iframe {
        width: 100vw;
        height: 100vh;
        border: none;
    }
</style>
</head>

<body>

<div id="unlockOverlay">Tap to Unlock</div>

<iframe src="/plugin.php?_menu=status&plugin=fpp-BigButtons&page=bigbuttons.php&nopage=1"></iframe>

<script>
(function() {

    const overlay = document.getElementById("unlockOverlay");

    // Overlay always starts ON after load (startup, refresh, wake, DPMS reload)
    let locked = true;

    function hideOverlay() {
        overlay.style.opacity = "0";
        overlay.style.pointerEvents = "none";
        locked = false;
    }

    overlay.addEventListener("touchstart", function(ev) {
        if (locked) {
            // Absorb the first tap
            ev.preventDefault();
            ev.stopPropagation();
            hideOverlay();
        }
    }, { passive: false });

    // If someone taps VERY fast after refresh, also block first click event
    overlay.addEventListener("click", function(ev) {
        if (locked) {
            ev.preventDefault();
            ev.stopPropagation();
            hideOverlay();
        }
    }, true);

    // ---------------------------------------------
    // NEW: Force a reload every 30 seconds
    // ---------------------------------------------
    setInterval(function() {
        window.location.reload(true);
    }, 30000);

})();
</script>

</body>
</html>
