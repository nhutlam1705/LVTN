<script src="../../../../plugins/jquery/jquery.min.js"></script>
<script src="../../../../plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="../../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../../plugins/chart.js/Chart.min.js"></script>
<script src="../../../../plugins/sparklines/sparkline.js"></script>
<script src="../../../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="../../../../plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="../../../../plugins/moment/moment.min.js"></script>
<script src="../../../../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../../../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../../../../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../../../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../../../../dist/js/adminlte.js"></script>
<script src="../../../../dist/js/demo.js"></script>
<script src="../../../../dist/js/pages/dashboard.js"></script>

<!-- DataTables  & Plugins -->
<script src="../../../../../../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../../../../../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../../../../../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../../../../../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../../../../../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../../../../../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../../../../../../plugins/jszip/jszip.min.js"></script>
<script src="../../../../../../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../../../../../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../../../../../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../../../../../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../../../../../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
  // Đợi trang tải xong
  window.onload = function() {
      // Lấy phần tử thông báo
      var alert = document.getElementById('success-alert');

      // Nếu thông báo tồn tại, hẹn giờ để ẩn nó sau 3 giây
      if (alert) {
          setTimeout(function() {
              alert.style.display = 'none'; // Ẩn thông báo
          }, 3000); // 3 giây = 3000 milliseconds
      }
  };
</script>

{{-- <script src="path/to/your/script.js"></script> --}}

{{-- <script>
  // Lấy các phần tử
  const openFormButton = document.getElementById('openFormButton');
  const closeFormButton = document.getElementById('closeFormButton');
  const addProductForm = document.getElementById('addProductForm');
  const overlay = document.getElementById('overlay');

  // Hiển thị form
  openFormButton.addEventListener('click', () => {
      addProductForm.style.display = 'block';
      overlay.style.display = 'block';
  });

  // Đóng form
  closeFormButton.addEventListener('click', () => {
      addProductForm.style.display = 'none';
      overlay.style.display = 'none';
  });

  // Đóng form khi nhấn vào overlay
  overlay.addEventListener('click', () => {
      addProductForm.style.display = 'none';
      overlay.style.display = 'none';
  });
</script> --}}

<script type="importmap">
  {
    "imports": {
      "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.js",
      "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.3.1/"
    }
  }
</script>
<script type="module">
  import {
    ClassicEditor,
    Essentials,
    Paragraph,
    Bold,
    Italic,
    Font, 
    Image, 
    ImageToolbar, 
    ImageUpload, 
    ImageCaption, 
    ImageResize, 
    Link 
  } from 'ckeditor5';
  ClassicEditor
    .create(document.querySelector('#codeEditor'), {
        plugins: [
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font,
            Image,
            ImageToolbar,
            ImageUpload,
            ImageCaption,
            ImageResize,
            Link
        ],
        toolbar: [
            'undo', 'redo', '|', 'bold', 'italic', '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
            'imageUpload', '|', 'link'
        ],
        image: {
            toolbar: [
                'imageTextAlternative', 
                '|', 
                'imageStyle:inline', 
                'imageStyle:block', 
                'imageStyle:side'
            ]
        },
        ckfinder: {
            uploadUrl: '/ckeditor/upload' // Đường dẫn upload
        }
    })
    .then(editor => {
        window.editor = editor;
    })
    .catch(error => {
        console.error(error);
    });
</script>
<!-- A friendly reminder to run on a server, remove this during the integration. -->
<script>
  window.onload = function() {
    if ( window.location.protocol === 'file:' ) {
      alert( 'This sample requires an HTTP server. Please serve this file with a web server.' );
    }
  };
</script>