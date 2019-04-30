<footer class="footer">
    <div class="container">
        <p>&copy; Brandious 2019</p>
    </div>
</footer>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
  src="https://code.jquery.com/jquery-3.4.0.min.js"
  integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalTitle">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="alert alert-danger" id="loginAlert">
        </div>

        <form>
            <input type="hidden" name="loginActive" id="loginActive"  value="1">

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
      
        </form>
      </div>
      <div class="modal-footer">
        <a id="toggleLogin">Sign Up</a>
        <button type="submit" id="loginSignupButton" class="btn btn-primary">Login</button>

        <script>

            $('#toggleLogin').click(function() {
                if( $('#loginActive').val() == '1' )
                {
                    $("#loginActive").val("0");
                    $("#loginModalTitle").html("Sign Up");
                    $("#loginSignupButton").html("Sign up");
                    $('#toggleLogin').html("Login"); 
                }
                else 
                {
                    $("#loginActive").val("1");
                    $("#loginModalTitle").html("Login");
                    $("#loginSignupButton").html("Login");
                    $('#toggleLogin').html("Sign Up "); 
                }
            });
            
            $("#loginSignupButton").click(function() {
                  console.log("Clicked");
                  $.ajax({
                      type:"POST",
                      url: "actions.php?action=loginSignup",
                      data:"email=" + $("#email").val() +
                      "&password=" + $("#password").val() +
                      "&loginActive=" + $("#loginActive").val(),
                      success: function(result)
                      {
                          // console.log(result == " 1");
                          if(result == " 1")
                          { 
                             window.location.assign("/index.php");
                          }
                          else 
                          {
                              // console.log(result);
                              $("#loginAlert").html(result).show();
                          }
                      } 
                  });
            });

            $(".toggleFollow").click(function() {
              
              var id = $(this).attr("data-userID");
              $.ajax({
                      type:"POST",
                      url: "actions.php?action=toggleFollow",
                      data:"userid=" + $(this).attr("data-userID"),
                      success: function(result)
                      {
                          if(result  == " 1")
                          {
                              $("a[data-userid='" + id + "']").html("Follow");
                          }
                          else if(result ==" 2")
                          {
                            $("a[data-userid='" + id + "']").html("Unfollow");
                          }
                      } 
                  });
            });

            $("#postTweetButton").click(function() {
              
             
              $.ajax({
                      type:"POST",
                      url: "actions.php?action=postTweet",
                      data:"tweetContent=" + $("#tweetContent").val(),
                      success: function(result)
                      {
                          if(result == " 1")
                          {
                            $("#tweetSuccess").show();

                            $("#tweetFail").html(result).hide();

                          }
                          else if(result != "")
                          {
                            $("#tweetFail").html(result).show();

                            $("#tweetSuccess").hide();
                          }
                      } 
                  });

            })

        </script>    

      </div>
    </div>
  </div>
</div>

</body>
</html>