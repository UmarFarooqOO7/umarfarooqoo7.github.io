<?php
require_once('./conn.php');
session_start();
if (empty($_SESSION['email']) && empty($_SESSION['name'])) {
    header("Location: ./login.php");
    die();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="./assets/bootstrap.style/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <style>
        .bi-power,
        .bi-people-fill {
            font-size: 28px;
            color: #fff;
        }

        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltiptext {
            width: 140px;
            visibility: hidden;

            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 7px 7px;
            position: absolute;
            z-index: 1;
            white-space: nowrap;
            bottom: 127%;
            left: 50%;
            margin-left: -70px;
        }

        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: black transparent transparent transparent;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
    </style>
</head>


<body>

    <audio id="audio_play" style="display: none;">
        <source src="./small-audience-weak-applause-521.mp3" type="audio/ogg">
    </audio>
    <audio id="audio2_play" style="display: none;">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-start-countdown-927.mp3" type="audio/ogg">
    </audio>

    <div class=" mt-4 mb-4" style="
    width: 100%;
    display: flex;
    justify-content: center;">
        <img src="./assets/images/West_Lakes_Golf_Club_a-removebg-preview.png" width="200" alt="logo">
    </div>

    <div class="wrapper">
        <div class="container" style="width: 630px;">
            <!-- <form action=""> -->
            <div id="topId">
                <label for="" style="color: #fff; text-align: center; display: block;">ENTER NUMBER OF TICKETS:</label>
                <div><input id="number" placeholder="ENTER NUMBER OF TICKETS" style=" text-align: center;" type="number" min="1"></div>
                <div class="text-center"><button onclick="myClick(this)" class="bubbly-button buttonAnimation">START</button>
                </div>
            </div>
            <div class="winnerTicket" id="winnerTicket" style="display: none;">The Winner ticket number is:</div>
            <!-- </form> -->
            <div id="asad"></div>
            <div id="trophy" style="text-align: center;display: none;">
                <img width="165" src="https://i.pinimg.com/originals/24/48/80/244880a0908584f0d4e5417190f74e23.png" alt="" srcset="">
            </div>

            <div style="text-align: center;"><button id="startAgain" class="startAgain" onclick="showAgain()" style="display: none;">START AGAIN</button></div>
        </div>
    </div>
    <div style="position:absolute;right:4%;bottom:6%;">
        <?php
        if ($_SESSION['type'] == "admin") {
            echo '<a class="tooltip" href="./user-management.php"><i class="bi bi-people-fill"></i><span class="tooltiptext">User Management</span></a>';
        }
        ?>
        <!-- <a style="color:white" class="px-3">Welcome <?php echo $_SESSION['name'] . ' !'; ?></a> -->
        <a class="tooltip mx-2" href="./logout.php"><i class="bi bi-power"></i><span class="tooltiptext">Logout</span></a></a>
    </div>
</body>
<script>
    const myClick = (e) => {
        if (number.value >= '0') {
            let a = number.value;

            let cler = setInterval(() => {
                asad.innerHTML = Math.floor((Math.random() * a) + 1)
            }, 10)
            setTimeout(function() {
                clearInterval(cler);
                winnerTicket.style.display = 'block'
                trophy.style.display = 'block'
                startAgain.style.display = 'block'
                document.getElementById('audio_play').play()

            }, 8000)
            topId.style.display = 'none'
            asad.style.display = 'block';
            document.getElementById('audio2_play').play()
        } else {
            alert('ENTER NUMBER OF TICKETS ')
        }
        // e.preventDefault()
    }

    const showAgain = () => {
        if (document.getElementById('asad').style.display == 'block') {
            document.getElementById('asad').style.display = 'none';
        }
        winnerTicket.style.display = 'none'
        trophy.style.display = 'none'
        topId.style.display = 'block'
        startAgain.style.display = 'none'
        number.value = ''
    }
</script>
<script>
    var animateButton = function(e) {

        e.preventDefault;
        //reset animation
        e.target.classList.remove('animate');

        e.target.classList.add('animate');
        setTimeout(function() {
            e.target.classList.remove('animate');
        }, 700);
    };

    var bubblyButtons = document.getElementsByClassName("bubbly-button");

    for (var i = 0; i < bubblyButtons.length; i++) {
        bubblyButtons[i].addEventListener('click', animateButton, false);
    }
</script>


</html>