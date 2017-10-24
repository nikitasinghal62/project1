<!-- Footer -->
<footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 footer-copyright">
                        &copy; Copyright |<a href="#"> Wordopedia</a>
                    </div>
                </div>
            </div>
        </footer>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/waypoints.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="admin/js/jquery.tag-editor.js"></script>
      <script src="admin/js/jquery.caret.min.js"></script>
        <script>
      $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
      });
      </script>

        <!--[if lt IE 10]>
	            <script src="assets/js/placeholder.js"></script>
	            <![endif]-->
<script>
 $(document).ready(function() {
    $('#loading').hide();
            $('.searchButton').click(function() {
                var word=$("#word").val();
                $("#word").val('');
                if($.trim(word).length>0 ) {
                    $('#loading').show();
                    $.ajax({
                        type: "POST",
                        url: "fetchWord.php",
                        data: 'word='+word,  
                        cache: false,
                        success: function(data){
                            if(data) {
                                $('#resultArea').html(data);
                            } else {
                                console.log('error');
                            }
                        },
                        complete: function(){
                            $('#loading').hide();
                        }
                    });
                }
                return false;
            });
        });
</script>
<script>
    document.onkeydown=function(evt){
        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
        if(keyCode == 13)
        {
            var word=$("#word").val();
            $("#word").val('');
            if($.trim(word).length>0 ) {
                $('#loading').show();
                $.ajax({
                    type: "POST",
                    url: "fetchWord.php",
                    data: 'word='+word,  
                    cache: false,
                    success: function(data){
                        if(data) {
                            $('#resultArea').html(data);
                        } else {
                            console.log('error');
                        }
                    },
                    complete: function(){
                        $('#loading').hide();
                    }
                });
            }
            return false;
        }
    }
</script>
    </body>

    </html>