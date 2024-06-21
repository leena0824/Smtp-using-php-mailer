<?php session_start(); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How to send mail in PHP using PHPMailer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>How to send mail in PHP using PHPMailer</h4>
        </div>
        <div class="card-body">
            <form action="sendmail.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fullname">Full Name</label>
                    <input type="text" name="fullname" id="fullname" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="emailaddress">Email Address</label>
                    <input type="email" name="email" id="emailaddress"  class="form-control"required>
                </div>
                <div class="mb-3">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject"  class="form-control"required>
                </div>
                <div class="mb-3">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                     <label for="attachment">Attachment</label>
                     <input type="file" name="attachment" id="attachment" class="form-control"/>
                 </div>


                <div class="mb-3">
                    <button type="submit" name="submitContact" class="btn btn-primary">Send Mail</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
var messageText = "<?= $_SESSION['status'] ?? ''; ?>";
    if (messageText !== '') {
        swal({
            title: "Thank You!!",
            text: messageText,
            icon: "success",
            button: "Aww yiss!",
        });
        <?php unset($_SESSION['status']); ?>
    }
</script>
</body>
</html>
   


















    