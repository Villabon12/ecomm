

(function () {
    const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

    let today = new Date(),
        dd = String(today.getDate()).padStart(2, "0"),
        mm = String(today.getMonth() + 1).padStart(2, "0"),
        yyyy = today.getFullYear(),
        nextYear = yyyy + 1,
        dayMonth = "08/30/",
        cdown = dayMonth + yyyy;
    
    if (today > cdown) {
        cdown = dayMonth + nextYear;
    }
    //end
    
    const countDown = new Date(cdown).getTime(),
        x = setInterval(function() {    

            const now = new Date().getTime(),
                distance = countDown - now;

            document.getElementById("days").innerText,
            document.getElementById("hours").innerText,
            document.getElementById("minutes").innerText,
            document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

        }, 0)
}());