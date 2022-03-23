
// when ticketStart or ticketEnd is changed or number is typed, calculate the difference between them
document.getElementById('ticketStart').addEventListener('keyup', calculateDifference);
document.getElementById('ticketEnd').addEventListener('keyup', calculateDifference);
document.getElementById('ticketStart').addEventListener('change', calculateDifference);
document.getElementById('ticketEnd').addEventListener('change', calculateDifference);


function calculateDifference() {
    ticketStart = document.getElementById('ticketStart').value;
    ticketEnd = document.getElementById('ticketEnd').value;

    // convert to int
    ticketStart = parseInt(ticketStart);
    ticketEnd = parseInt(ticketEnd);

    // both numbers should be greater than 0
    if (ticketStart > 0 && ticketEnd > 0) {

        // calculate difference
        let difference = (ticketEnd - ticketStart) + 1;

        // difference should be greater than 0
        if (difference > 0) {
            // display difference
            document.getElementById('difference').innerHTML = difference;
        }
        else {
            // display error
            document.getElementById('difference').innerHTML = 'ERROR';
        }
    }
    else {
        // display error
        document.getElementById('difference').innerHTML = 'ERROR';
    }
}


let resultArray = [];

function myClick() {
    // get draws, ticketStart, ticketEnd
    let draws = document.getElementById('draws').value;
    let ticketStart = document.getElementById('ticketStart').value;
    let ticketEnd = document.getElementById('ticketEnd').value;

    // convert to int
    draws = parseInt(draws);
    ticketStart = parseInt(ticketStart);
    ticketEnd = parseInt(ticketEnd);

    if (draws == '' || draws == 0 || isNaN(draws) || draws < 0) {
        alert('ENTER NUMBER OF DRAWS')
        return false;
    }
    if (ticketStart == '' || isNaN(ticketStart) || ticketStart < 0) {
        alert('ENTER TICKET START NUMBER')
        return false;
    }
    if (ticketEnd == '' || isNaN(ticketEnd) || ticketEnd < 0) {
        alert('ENTER TICKET END NUMBER')
        return false;
    }

    // check if ticket start value is less than ticket end value
    if (ticketStart > ticketEnd) {
        // console.log("ticketStart", ticketStart);
        // console.log("ticketEnd", ticketEnd);
        alert('TICKET START NUMBER CANNOT BE GREATER THAN TICKET END NUMBER')
        return false;
    }

    if (draws >= '0') {
        let a = ticketStart;
        let b = ticketEnd;
        let cler = setInterval(() => {
            // get a random number exactly between a and b
            let randomNumber = Math.floor(Math.random() * (b - a + 1) + a);
            asad.innerHTML = randomNumber;
        }, 10)
        setTimeout(function () {
            clearInterval(cler);
            winnerTicket.style.display = 'block'
            // trophy.style.display = 'block'
            startAgain.style.display = 'block'
            document.getElementById('audio_play').play()

            resultArray.push(asad.innerHTML);
            $('#resultBox').html('');
            let position = draws;
            for (let i = 0; i < resultArray.length; i++) {
                if (position > i) {
                    if (position - i == 1) {
                        $('#resultBox').append(`
                            <div class="pr-2 " style="margin-bottom: 60px;">
                                <div class="boxes rounded d-flex justify-content-center align-items-center shadow-lg">
                                    ${resultArray[i]}
                                </div>
                                <div class="drawHeading" style="font-size:21px;">Draw ${position - i}</div>
                            </div>
                            `);
                        startAgain.innerHTML = `START AGAIN`;
                    } else {
                        $('#resultBox').append(`
                            <div class="pr-2 " style="margin-bottom: 60px;">
            <div style=""
                class="boxes rounded d-flex justify-content-center align-items-center shadow-lg">
                ${resultArray[i]}
            </div>
            <div class="drawHeading">Draw ${position - i}</div>
        </div>
                            `);

                        startAgain.innerHTML = `DRAW AGAIN`;
                    }
                }
            }

        }, 8000)
        topId.style.display = 'none'
        asad.style.display = 'block';
        document.getElementById('audio2_play').play()
    }



    // e.preventDefault()
}



const showAgain = () => {
    if (startAgain.innerHTML === `START AGAIN`) {
        window.location.reload();
    }
    if (document.getElementById('asad').style.display == 'block') {
        document.getElementById('asad').style.display = 'none';
    }
    winnerTicket.style.display = 'none'
    // trophy.style.display = 'none'
    topId.style.display = 'block'
    startAgain.style.display = 'none'

    myClick();
}

var animateButton = function (e) {

    e.preventDefault;
    //reset animation
    e.target.classList.remove('animate');

    e.target.classList.add('animate');
    setTimeout(function () {
        e.target.classList.remove('animate');
    }, 700);
};

    // var bubblyButtons = document.getElementsByClassName("bubbly-button");

    // for (var i = 0; i < bubblyButtons.length; i++) {
    //     bubblyButtons[i].addEventListener('click', animateButton, false);
    // }
    // for (var input = 100; input >= 1; input--) {
    //    let abcgh = Math.floor((Math.random() * input) + 1)
    //     var btn = document.createElement("div");
    //     btn.classList.add('boxes')
    //              btn.innerHTML=abcgh
    //             InnerDiv.append(btn)
    //     }