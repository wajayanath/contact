<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jasny-bootstrap.min.js"></script>
    <script src="/assets/js/jquery.bxslider.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.bxslider').bxSlider({
                buildPager: function(slideIndex){
                switch(slideIndex){
                  case 0: return '<img src="../../images/icon_size/lighthouse.jpg">';
                  case 1: return '<img src="../../images/icon_size/penguins.jpg">';
                  case 2: return '<img src="../../images/icon_size/tulips.jpg">';
                  }
               }
            });
        });
    </script>
    

  </body>
</html>