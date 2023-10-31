    <script src="importants/js/jquery-3.3.1.slim.min.js"></script>
    <script src="importants/js/popper.min.js"></script>
    <script src="importants/js/bootstrap.min.js"></script>
    <script src="importants/js/jquery-3.3.1.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){
           $(".xp-menubar").on('click',function(){
             $("#sidebar").toggleClass('active');
             $("#content").toggleClass('active');
           });
           
           $('.xp-menubar,.body-overlay').on('click',function(){
              $("#sidebar,.body-overlay").toggleClass('show-nav');
           });
           
        });
   </script>

</body>
</html>