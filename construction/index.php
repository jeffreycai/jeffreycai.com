
<!DOCTYPE html>
	<head>
		<meta charset="utf-8" />

		<!-- Title -->
		<title>Under Maintainence! | Jeffrey Cai's Personal website</title>

		<!-- CSS -->
		<link rel="stylesheet" href="css/style.css" />


	</head>

    <body>

		<div id="wrapper">

			<!-- Header -->
			<div id="header">
				<h1>Jeffrey Cai</h1>
				<p>"PHP web developer in Sydney, Australia"</p>
			</div>

			<div id="content" class="clearfix">

				<!-- Main title -->
				<div id="title">
					<img src="images/helmet.png" alt="" />
					<h2>Oops! My site is currently</h2>
					<h3>Under Maintainence</h3>
				</div>


				<!-- Left-hand Column -->
				<div id="left">

					<h4>Count Down</h4>
					<p>I am doing my best and I will be back in:</p>
					<div id="countdown"></div>

					<h4>Contact Me</h4>
					<p>Please contact me by filling up the form below.</p>
					<form id="newsletter" action="#">
                        <div class="input">
                            <input id="name" type="text" name="name" title="Type your name please ..." />
                        </div>
                        <div class="input">
                            <input id="email" type="email" name="email" title="Type your email please ..." />
                        </div>
                        <div class="textarea">
                            <textarea id="message" name="message" title="Type your message please ..."></textarea>
                        </div>

                        <div class="submit">
                            <span>Submit</span>
                        <input type="image" src="images/newsletter_button.png" />
                        </div>
					</form>

				</div>

				<!-- Right-hand Column -->
				<div id="right">

					<h4>Twitter</h4>
					<p><a href="http://twitter.com/jeffreycai">Follow me</a>, or check our latest Tweet:</p>
					<div id="twitter">
						<span class="loading">Loading latest tweet...</span>
					</div>

                    
					<h4>Connect with me</h4>
					<p>Stay connected with me on the following sites:</p>
					<ul id="social">
						<li><a href="http://twitter.com/jeffreycai"><img src="images/twitter.png" alt="" /></a></li>
						<!-- <li><a href=""><img src="images/flickr.png" alt="" /></a></li> -->
						<li><a href="http://www.facebook.com/jeffreycaizhenyuan"><img src="images/facebook.png" alt="" /></a></li>
						<!-- <li><a href=""><img src="images/linkedin.png" alt="" /></a></li> -->
						<!-- <li><a href=""><img src="images/youtube.png" alt="" /></a></li> -->
					</ul>

				</div>

			</div>

			<!-- Footer -->

			<div id="footer" class="clearfix">
				<p>Copyright 2011 - Jeffrey Cai - All rights reserved</p>
			</div>

		</div>

		<!-- Scripts -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script src="http://twitterjs.googlecode.com/svn/trunk/src/twitter.min.js"></script>
		<script src="js/jquery.countdown.min.js"></script>
		<script>
			$(function () {

				// Countdown Timer

				$('#countdown').countdown({until: new Date(2011, 9, 15), format: 'odHM'});

				// Inline Labels

				$('input[title], textarea').each(function() {
					if($(this).val() === '') {
						$(this).val($(this).attr('title'));
					}

					$(this).focus(function() {
						if($(this).val() == $(this).attr('title')) {
							$(this).val('')
						}
					});
					$(this).blur(function() {
						if($(this).val() === '') {
							$(this).val($(this).attr('title'))
						}
					});
				});

                // Twitter
                getTwitters('twitter', {
                  id: 'jeffreycai',
                  count: 7,
                  enableLinks: true,
                  ignoreReplies: true,
                  clearContents: true,
                  template: '<img src="%user_profile_image_url%" width=30 />%text%" <a href="http://twitter.com/%user_screen_name%/statuses/%id_str%/">%time%</a>'
                });
			});
		</script>

        <script type="text/javascript">
            $(function(){
                // form validaton
                $('input[type=image]').click(function(){
                    var reg1 = /^type your/i;
                    var name = jQuery.trim($('#name').val());
                    var email = $('#email').val();
                    var message = jQuery.trim($('#message').val());
                    if (name == '' || name.match(reg1))
                    {
                        alert('Please enter your name');
                        return false;
                    }
                    reg2 = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                    if (!email.match(reg2))
                    {
                        alert('Please enter a valid email address');
                        return false;
                    }
                    if (message == '' || message.match(reg1))
                    {
                        alert('Please enter your message');
                        return false;
                    }
                    $('.submit span').html('Submitting ...');
                    $.post('contact.php', $('form').serialize(), function(data){
                        $('.submit span').html('Submit');
                        alert('Your contact has been succussfully submitted! Thank you!');
                    });
                    return false;
                });
            });
        </script>


		<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11630792-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

	</body>

</html>