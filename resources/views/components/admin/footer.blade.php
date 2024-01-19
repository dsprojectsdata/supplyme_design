  </section>
  @yield('SaveDraft')
  </section>
  </section>
  <script type="text/javascript">
    var imgValid = '{{IMG_VALID}}';
    var videoValid = '{{VIDEO_VALID}}';
    var csrf = "{{ csrf_token() }}";
    var attachmentValid = '{{ATTACHMENT_VALID}}';
    var baseUrl = "{{ url('/') }}";
    let pusher_app_key = "{{ env('PUSHER_APP_KEY') }}";
    let pusher_cluster = "{{ env('PUSHER_APP_CLUSTER') }}";
    let imgDataTransfer = new DataTransfer();
    let videoDataTransfer = new DataTransfer();
    let attachmentDataTransfer = new DataTransfer();
    window.groups = JSON.parse(`@json(auth()->user()->chatGroups)`);
    let user_id = "{{auth()->id()}}";
  </script>
  <!--  Javascript file  link here -->
  <script src="{{asset('Admin/assets/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('Admin/assets/dist/js/jquery.js')}}"></script>
  <script src="{{asset('Admin/assets/dist/js/custom.js')}}"></script>
  <script src="{{asset('Admin/assets/dist/js/newsfeed/news.js')}}"></script>
  <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
  <script src="{{asset('js/app.js')}}"></script>
  <script src="{{asset('js/group-chat.js')}}"></script>
  <script>
    $(document).ready(function() {
      $(".menu").click(function() {
        $(".wrapper").toggleClass("sidebarToggle");
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $("#search").click(function() {
        $("#search").toggleClass("nav-fluid");
      });
    });

    Object.defineProperty(Number.prototype,'fileSize',{value:function(a,b,c,d){
    return (a=a?[1e3,'k','B']:[1024,'K','iB'],b=Math,c=b.log,
    d=c(this)/c(a[0])|0,this/b.pow(a[0],d)).toFixed(2)
    +' '+(d?(a[1]+'MGTPEZY')[--d]+a[2]:'Bytes');
    },writable:false,enumerable:false});

    function debounce(func, delay) {
      let timeoutId;
      return function() {
        const context = this;
        const args = arguments;
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() {
          func.apply(context, args);
        }, delay);
      };
    }
  </script>
  @stack('custom-script')
  </body>

  </html>