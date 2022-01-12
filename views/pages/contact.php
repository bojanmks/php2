<div class="d-flex align-items-center min-vh-100 py-5">
<div class="container mt-5 mt-md-0">
    <h2 class="font-xl text-center">Contact us</h2>
    <div class="underline mb-5"></div>
    <div class="row mt-5 mt-md-0 justify-content-between">
        <div class="col-12 col-md-6 mb-4 mb-md-0">
            <p class="font-small">If you wish to reach out to us, you can do so via social media, the information listed below, or by filling out the contact form.</p>
            <ul class="p-0">
                <li class="font-small"><i class="fas fa-phone me-1"></i>+381 60/123-4567</li>
                <li class="font-small"><i class="fas fa-envelope me-1"></i>bojan&#46;maxim075&#64;gmail&#46;com</li>
            </ul>
        </div>
        <div class="col-12 col-md-5">
            <h3 class="font-medium text-center mb-4">Contact form</h3>
            <form action="models/contact/send-message.php" method="POST">
                <div class="mb-2">
                    <label for="tbEmail">Email:</label>
                    <input type="email" name="email" id="tbEmail" class="form-control"/>
                    <label class="font-small error-message text-danger">examplename@example.com</label>
                </div>
                <div class="mb-2">
                    <label for="tbName">Name:</label>
                    <input type="text" name="name" id="tbName" class="form-control"/>
                    <label class="font-small error-message">
                        <ul class="p-0">
                            <li class="text-danger">- A name cannot have less than 3 characters</li>
                            <li class="text-danger">- Each word of your name must be capitalized</li>
                        </ul>
                    </label>
                </div>
                <div class="mb-3">
                    <label for="tbMessage">Message:</label>
                    <textarea name="message" id="tbMessage" class="form-control" style="resize: none; height: 200px;"></textarea>
                    <label class="font-small error-message text-danger">Your message (without spacing characters) cannot be shorter than 20 characters or longer than 500 characters in total.</label>
                </div>
                <div class="text-center mb-3">
                    <button id="btnSend" name="btnSend" class="py-1 px-3 rounded btn-primary"><i class="fas fa-paper-plane font-small"></i></button>
                </div>
                <?php
                    require_once('models/forms/functions.php');
                    displayMessages();
                ?>
            </form>
        </div>
    </div>
</div>
</div>
