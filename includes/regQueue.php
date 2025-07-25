<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include "lib.php";
    ?>
    <title>Document</title>
</head>

<body>

</body>

</html>
<script>
    $(document).ready(function() {
        // REFACTOR
        var dataArray = [];
        const Queue = async () => {
            try {
                const response = await fetch("../json/registration.json?timestamp=" + new Date().getTime());
                const data = await response.json();
                const datas = data.map((item) => {
                    dataArray.push(item);
                });
                console.log(data);
                const sendNext = setInterval(() => {
                    if (dataArray.length > 0) {
                        const dataToSend = dataArray.shift();
                        console.log(dataToSend);
                        $.ajax({
                            method: "post",
                            url: "../Actions/ApplicantRegistration.php?step=5",
                            data: dataToSend,
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    } else {
                        console.log("Stopped");
                        clearInterval(sendNext);
                    }
                }, 3000);

            } catch (error) {
                console.log(error);
            }
        }

        Queue();

    });
</script>