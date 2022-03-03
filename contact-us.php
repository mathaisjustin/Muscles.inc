<?php include('partials-front/menu.php') ?>  

    <!-- contact starts here -->
    <section class="contact">
        <div class="contact_data">
            <h1 class="contact_title">Contact Us...</h1>
        </div>
    </section>
    <!-- contact ends here -->

    <!-- form starts here -->
    <section class="Form">
        <div class="Form_data">
            <form action="https://formsubmit.co/mathaisjustin@gmail.com" method="POST" onsubmit="myFunction()">

                <!-- disable captcha -->
                <input type="hidden" name="_captcha" value="false">

                <input type="hidden" name="_next" value="https://mathaisjustin.github.io/Muscles.inc/index.html">

                <div class="Form_inputs">
                    <h3>Get in touch with us</h3>
                    <label for="name"></label>
                    <input type="text" placeholder="Name" name="name" class="Form_input">

                    <label for="phone"></label>
                    <input type="text" placeholder="Phone No." name="phone" class="Form_input">

                    <label for="email"></label>
                    <input type="text" placeholder="Email-Id" name="email" class="Form_input">

                    <label for="message"></label>
                    <textarea name="message" rows="5" cols="10" class="Form_input" placeholder="Message Details..."></textarea>
                    
                    <input type="submit" value="Send Message" class="Form_button" name="submit">
                </div>
            </form>
        </div>
    </section>
    <!-- form ends here -->

    <?php include('partials-front/footer.php') ?>

    <!-- scrpit -->
    <script>
        function myFunction() {
            alert("Your sure that you want to Submit?");
        }
    </script>
    <!-- scrpit ends here -->

</body>
</html>